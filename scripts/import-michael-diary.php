<?php
// Import the approved photo diary with WP-CLI on the target WordPress site.
if (!defined('WP_CLI') || !WP_CLI) {
    exit;
}

$directory = rtrim($args[0] ?? '', '/');
$slug = 'michael-first-dive-diary';
$title = 'マイケル君の海日記｜ボートから、はじめての海へ';
$photos = [
    'water-surface' => 'ダイビングの仲間たちと海面に浮かぶマイケル君',
    'boat-gear' => 'ボートの上でタンクやフィンに囲まれたマイケル君',
    'underwater-story' => '海の中でウミウシを指さすダイビング姿のマイケル君',
    'boat-break' => 'ボートに座ってソフトクリームを持つマイケル君と足元のカニ',
];
if (!$directory || !post_type_exists('diving_blog')) {
    WP_CLI::error('Activate Dive 365 Shop and pass the diary photo directory.');
}

foreach (array_keys($photos) as $photo) {
    if (!is_readable("$directory/$photo.webp")) {
        WP_CLI::error("Missing diary photo: $photo.webp");
    }
}

$post = get_page_by_path($slug, OBJECT, ['diving_blog']);
if ($post && get_post_meta($post->ID, '_d365_michael_diary', true) !== '1') {
    WP_CLI::error('A different post is already using the diary slug.');
}
if ($post && $post->post_status === 'publish') {
    WP_CLI::success('The diary is already published at ' . get_permalink($post));
    return;
}

$id = $post ? $post->ID : wp_insert_post([
    'post_type' => 'diving_blog',
    'post_name' => $slug,
    'post_title' => $title,
    'post_status' => 'draft',
    'comment_status' => 'closed',
    'meta_input' => ['_d365_michael_diary' => '1'],
], true);
if (is_wp_error($id) || !$id) {
    WP_CLI::error('Could not create the diary draft.');
}

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

$attachments = [];
foreach ($photos as $photo => $alt) {
    $matches = get_posts([
        'post_type' => 'attachment', 'post_parent' => $id, 'post_status' => 'inherit',
        'meta_key' => '_d365_diary_photo', 'meta_value' => $photo, 'fields' => 'ids', 'numberposts' => 1,
    ]);
    if ($matches) {
        $attachments[$photo] = $matches[0];
        continue;
    }

    $filename = "michael-diary-$photo.webp";
    $temporary = wp_tempnam($filename);
    if (!$temporary || !copy("$directory/$photo.webp", $temporary)) {
        WP_CLI::error("Could not stage $filename.");
    }
    $attachment = media_handle_sideload(['name' => $filename, 'tmp_name' => $temporary], $id, $alt);
    if (is_wp_error($attachment)) {
        wp_delete_file($temporary);
        WP_CLI::error($attachment->get_error_message());
    }
    update_post_meta($attachment, '_wp_attachment_image_alt', $alt);
    update_post_meta($attachment, '_d365_diary_photo', $photo);
    $attachments[$photo] = $attachment;
}

function d365_diary_figure(int $attachment, string $caption, bool $portrait = false): string {
    $class = $portrait ? ' diary-portrait' : '';
    $image = wp_get_attachment_image_src($attachment, 'large');
    $alt = get_post_meta($attachment, '_wp_attachment_image_alt', true);
    return sprintf(
        '<figure class="wp-block-image size-large michael-diary-photo%s"><img src="%s" alt="%s" class="wp-image-%d" width="%d" height="%d"><figcaption>%s</figcaption></figure>',
        $class, esc_url($image[0]), esc_attr($alt), $attachment, $image[1], $image[2], esc_html($caption)
    );
}

$sections = [
    ['ボートの上は、大きな器材がいっぱい', 'タンクがずらり。フィンを近くで見ると、ぼくの足よりずっと大きい！ みんなが器材を整えるのを見ながら、いよいよ海に入るんだなって、わくわくしてきた。', 'boat-gear', 'ボートの上で、タンクやフィンを見学。'],
    ['海の中では、どんな出会いがあるんだろう？', '水面に浮かんで下をのぞいたら、青がずっと続いていたよ。もし海の中で小さなウミウシに会えたら、きっとこんなふうに見つめ合っちゃうな。', 'underwater-story', 'マイケル君が思い描く水中のひとこま。岩の上にはカラフルなウミウシ。'],
    ['最後は、ソフトクリームでひと休み', 'ボートに戻って、ソフトクリームを持ってにっこり。足元には小さなカニも。海の中もボートの上も、見たことのないものだらけだったよ。今度はどんな海に行こうかな？', 'boat-break', 'ボートでひと休み。足元のカニにも注目。'],
];
$content = '<p>こんにちは、マイケルです。今日はダイビングのみんなとボートへ。海の近くは風までちょっとしょっぱく感じるね。初めてのことばかりでドキドキしたけど、海に浮かんでみたら、もっと先をのぞいてみたくなったよ。</p>';
foreach ($sections as [$heading, $copy, $photo, $caption]) {
    $content .= "\n\n<h2>" . esc_html($heading) . '</h2><p>' . esc_html($copy) . '</p>' . d365_diary_figure($attachments[$photo], $caption, $photo === 'boat-break');
}

set_post_thumbnail($id, $attachments['water-surface']);
$result = wp_update_post(wp_slash([
    'ID' => $id,
    'post_content' => $content,
    'post_excerpt' => 'ボートで見つけた大きなフィン、青い海、そしてソフトクリーム。初めての海をマイケル君の目線でつづりました。',
    'post_status' => 'publish',
]), true);
if (is_wp_error($result) || !$result) {
    WP_CLI::error('Could not publish the diary.');
}
WP_CLI::success('Published the diary at ' . get_permalink($id));
