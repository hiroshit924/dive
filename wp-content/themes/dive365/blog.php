<?php
defined('ABSPATH') || exit;

function d365_imported_diary_id(): int {
    $post = get_page_by_path('michael-first-dive-diary', OBJECT, ['diving_blog']);
    return $post && get_post_meta($post->ID, '_d365_michael_diary', true) === '1' ? $post->ID : 0;
}

add_action('pre_get_posts', static function (WP_Query $query): void {
    if (!is_admin() && $query->is_main_query() && $query->is_post_type_archive('diving_blog') && ($diary = d365_imported_diary_id())) {
        $excluded = (array) $query->get('post__not_in');
        $excluded[] = $diary;
        $query->set('post__not_in', $excluded);
    }
});

add_filter('wp_sitemaps_posts_query_args', static function (array $args, string $type): array {
    if ($type === 'diving_blog' && ($diary = d365_imported_diary_id())) {
        $args['post__not_in'][] = $diary;
    }
    return $args;
}, 10, 2);

add_action('template_redirect', static function (): void {
    if (is_singular('diving_blog') && get_queried_object_id() === d365_imported_diary_id()) {
        wp_safe_redirect(d365_michael_url(false) . '#michael-diary', 301);
        exit;
    }
}, 9);

add_filter('template_include', static function (string $template): string {
    if (is_singular(['diving_blog', 'post'])) {
        return get_theme_file_path('blog-single.php');
    }
    if (is_post_type_archive('diving_blog') || (is_home() && !is_front_page() && !d365_is_courses()
        && !d365_is_michael() && !d365_experience())) {
        return get_theme_file_path('blog-archive.php');
    }
    return $template;
}, 20);

function d365_blog_thumbnail(): string {
    if (post_password_required()) {
        return '';
    }
    if (has_post_thumbnail()) {
        return get_the_post_thumbnail(null, 'medium_large', ['alt' => '', 'loading' => 'lazy']);
    }

    $content = new WP_HTML_Tag_Processor(get_the_content());
    while ($content->next_tag('img')) {
        $src = esc_url((string) $content->get_attribute('src'));
        if ($src !== '') {
            return '<img src="' . $src . '" alt="" loading="lazy" decoding="async">';
        }
    }

    return '';
}
