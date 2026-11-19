<?php
// Run through WP-CLI on a disposable preview site.
if (!defined('WP_CLI') || !WP_CLI) {
    exit;
}

$stage = rtrim($args[0] ?? '', '/');
if (!$stage || !is_file($stage . '/snapshot.json') || !is_dir($stage . '/uploads')) {
    WP_CLI::error('Pass the staging directory created by fetch-public.py.');
}
$source = 'https://dive.c365.jp';
$payload = json_decode(file_get_contents($stage . '/snapshot.json'), true, 512, JSON_THROW_ON_ERROR);
$uploads = wp_upload_dir();
$types = ['pages' => 'page', 'posts' => 'post', 'diving_blog' => 'diving_blog', 'news' => 'news', 'media' => 'attachment'];

foreach ($types as $kind => $type) {
    foreach ($payload[$kind] as $entry) {
        $id = (int) $entry['id'];
        $existing = get_post($id);
        if ($existing && get_post_meta($id, '_d365_preview_import', true) !== '1'
            && !($id === 2 && $existing->post_type === 'page' && $existing->post_name === 'sample-page'
                && $entry['slug'] === 'sample-page')) {
            WP_CLI::error("Existing local post #$id conflicts. Use a disposable preview database.");
        }
    }
}

function d365_import_copy(string $source, string $target): void {
    if (!is_dir(dirname($target)) && !wp_mkdir_p(dirname($target))) {
        WP_CLI::error("Could not create " . dirname($target));
    }
    if (is_file($target) && hash_file('sha256', $target) === hash_file('sha256', $source)) {
        return;
    }
    if (is_file($target)) {
        WP_CLI::error("Existing media conflicts with the source at $target.");
    }
    if (!copy($source, $target)) {
        WP_CLI::error("Could not copy $target.");
    }
}

$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($stage . '/uploads', FilesystemIterator::SKIP_DOTS));
foreach ($files as $file) {
    if ($file->isFile()) {
        $relative = substr($file->getPathname(), strlen($stage . '/uploads/'));
        d365_import_copy($file->getPathname(), $uploads['basedir'] . '/' . $relative);
    }
}

function d365_import_rewrite(string $value, string $source, string $upload_url): string {
    return str_replace(
        [$source . '/wp-content/uploads/', $source . '/?'],
        [trailingslashit($upload_url), trailingslashit(home_url()) . '?'],
        $value
    );
}

add_filter('wp_revisions_to_keep', '__return_zero');
$featured = [];
foreach ($types as $kind => $type) {
    foreach ($payload[$kind] as $entry) {
        $id = (int) $entry['id'];
        $attachment = $type === 'attachment';
        $record = [
            'post_type' => $type,
            'post_status' => $attachment ? 'inherit' : 'publish',
            'post_name' => $entry['slug'],
            'post_title' => html_entity_decode($entry['title']['rendered'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'post_date' => str_replace('T', ' ', $entry['date']),
            'post_date_gmt' => str_replace('T', ' ', $entry['date_gmt'] ?? $entry['date']),
            'post_content' => d365_import_rewrite($entry['content']['rendered'] ?? $entry['description']['rendered'] ?? '', $source, $uploads['baseurl']),
            'post_excerpt' => $attachment ? ($entry['caption']['rendered'] ?? '') : wp_strip_all_tags($entry['excerpt']['rendered'] ?? ''),
            'post_parent' => (int) ($entry['parent'] ?? $entry['post'] ?? 0),
            'comment_status' => 'closed',
            'meta_input' => ['_d365_preview_import' => '1'],
        ];
        if ($attachment) {
            $path = rawurldecode(substr(wp_parse_url($entry['source_url'], PHP_URL_PATH), strlen('/wp-content/uploads/')));
            $record['post_mime_type'] = $entry['mime_type'];
            $record['guid'] = d365_import_rewrite($entry['source_url'], $source, $uploads['baseurl']);
        }
        if (get_post($id)) {
            $record['ID'] = $id;
        } else {
            $record['import_id'] = $id;
        }
        $written = wp_insert_post(wp_slash($record), true);
        if (is_wp_error($written) || $written !== $id) {
            WP_CLI::error("Could not restore source ID $id" . (is_wp_error($written) ? ' ' . $written->get_error_message() : '.'));
        }
        if ($attachment) {
            update_post_meta($id, '_wp_attached_file', $path);
            update_post_meta($id, '_wp_attachment_image_alt', wp_slash($entry['alt_text'] ?? ''));
            $details = $entry['media_details'];
            if (is_array($details) && !empty($details)) {
                if (isset($details['sizes'])) {
                    $base = dirname($uploads['basedir'] . '/' . $path);
                    $details['sizes'] = array_filter($details['sizes'], static fn(array $size): bool => is_file($base . '/' . $size['file']));
                }
                wp_update_attachment_metadata($id, $details);
            }
        }
        if (!empty($entry['featured_media'])) {
            $featured[$id] = (int) $entry['featured_media'];
        }
    }
    WP_CLI::log($kind . ': ' . count($payload[$kind]));
}
foreach ($featured as $post => $image) {
    set_post_thumbnail($post, $image);
}
WP_CLI::success('Public preview content imported with the source IDs.');
