<?php
defined('ABSPATH') || exit;

if (!function_exists('d365_text')) {
    function d365_text(string $ja, string $en): string {
        return $ja;
    }

    function d365_is_english(): bool {
        return false;
    }

    function d365_home(bool $english): string {
        return home_url('/');
    }
}

function d365_asset(string $file): string {
    return get_theme_file_uri('assets/' . $file);
}

function d365_label(string $ja, string $en): void {
    echo esc_html(d365_text($ja, $en));
}

function d365_archive_url(string $type): string {
    return get_post_type_archive_link($type) ?: home_url('/?post_type=' . $type);
}

function d365_is_courses(): bool {
    return is_page(44) || (get_query_var('d365_courses') === '1' && !is_admin());
}

function d365_courses_url(bool $english): string {
    if ($english && get_option('permalink_structure')) {
        return home_url('/en/courses/');
    }
    if (!$english && get_post_type(44) === 'page' && get_post_status(44) === 'publish') {
        return get_permalink(44);
    }
    return add_query_arg('d365_courses', '1', d365_home($english));
}

function d365_experience(): string {
    if (is_page(47)) {
        return 'trial';
    }
    if (is_page(14)) {
        return 'tour';
    }
    $requested = get_query_var('d365_experience');
    return in_array($requested, ['trial', 'tour'], true) ? $requested : '';
}

function d365_experience_url(string $type, bool $english): string {
    if ($english && get_option('permalink_structure')) {
        return home_url($type === 'trial' ? '/en/discover-scuba/' : '/en/dive-trips/');
    }
    $page = $type === 'trial' ? 47 : 14;
    if (!$english && get_post_type($page) === 'page' && get_post_status($page) === 'publish') {
        return get_permalink($page);
    }
    return add_query_arg('d365_experience', $type, d365_home($english));
}

function d365_landing_url(bool $english): string {
    if (d365_is_courses()) {
        return d365_courses_url($english);
    }
    $type = d365_experience();
    return $type ? d365_experience_url($type, $english) : d365_home($english);
}

add_filter('template_include', static function (string $template): string {
    if (d365_is_courses()) {
        return get_theme_file_path('courses.php');
    }
    return d365_experience() ? get_theme_file_path('experiences.php') : $template;
});

add_action('after_setup_theme', static function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
});
add_action('wp_enqueue_scripts', static function (): void {
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('dive365', get_stylesheet_uri(), [], $version);
    wp_enqueue_script('dive365', d365_asset('site.js'), [], $version, ['in_footer' => true, 'strategy' => 'defer']);
});
add_filter('language_attributes', static function (string $attributes): string {
    return d365_is_english() ? 'lang="en"' : 'lang="ja"';
});
add_filter('pre_get_document_title', static function (string $title): string {
    if (d365_is_courses()) {
        return d365_text('PADI講習・スキルアップ｜Dive 365', 'PADI Courses & Skills | Dive 365');
    }
    $titles = [
        'trial' => d365_text('横浜から体験ダイビング｜Dive 365', 'Discover Scuba Diving from Yokohama | Dive 365'),
        'tour' => d365_text('逗子・葉山・伊豆のダイビングツアー｜Dive 365', 'Dive Trips to Zushi, Hayama and Izu | Dive 365'),
    ];
    if (isset($titles[d365_experience()])) {
        return $titles[d365_experience()];
    }
    return is_front_page() ? d365_text('Dive 365｜横浜のダイビングショップ', 'Dive 365 | Scuba Diving in Yokohama') : $title;
});
add_action('wp_head', static function (): void {
    if ((is_front_page() || d365_is_courses() || d365_experience()) && function_exists('d365_show_booking')) {
        foreach (['ja' => d365_landing_url(false), 'en' => d365_landing_url(true), 'x-default' => d365_landing_url(false)] as $lang => $url) {
            printf('<link rel="alternate" hreflang="%s" href="%s">' . "\n", esc_attr($lang), esc_url($url));
        }
    }
});
require get_theme_file_path('seo.php');
