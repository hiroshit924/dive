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
    return in_array($requested, ['trial', 'tour', 'overseas'], true) ? $requested : '';
}

function d365_experience_url(string $type, bool $english): string {
    if ($type === 'overseas') {
        if (get_option('permalink_structure')) {
            return home_url(($english ? '/en' : '') . '/dive-trips/overseas/');
        }
        return add_query_arg('d365_experience', $type, d365_home($english));
    }
    if ($english && get_option('permalink_structure')) {
        return home_url($type === 'trial' ? '/en/discover-scuba/' : '/en/dive-trips/');
    }
    $page = $type === 'trial' ? 47 : 14;
    if (!$english && get_post_type($page) === 'page' && get_post_status($page) === 'publish') {
        return get_permalink($page);
    }
    return add_query_arg('d365_experience', $type, d365_home($english));
}

require get_theme_file_path('tour-destinations.php');
require get_theme_file_path('overseas-destinations.php');

function d365_tour_area(): string {
    $area = get_query_var('d365_tour_area');
    return is_string($area) && isset(d365_tour_destinations()[$area]) && d365_experience() === 'tour' ? $area : '';
}

function d365_tour_area_url(string $area, bool $english): string {
    if (get_option('permalink_structure')) {
        return home_url(($english ? '/en' : '') . '/dive-trips/' . $area . '/');
    }
    return add_query_arg('d365_tour_area', $area, d365_experience_url('tour', $english));
}

function d365_tour_booking_url(string $destination = ''): string {
    if (!function_exists('d365_show_booking')) {
        return 'tel:+81452735496';
    }
    $args = ['dive_service' => 'tour'];
    if ($destination !== '') {
        $args['dive_destination'] = $destination;
    }
    return d365_home(d365_is_english(), $args) . '#booking';
}

add_filter('d365_booking_notes_default', static function (string $notes): string {
    $destination = d365_input($_GET, 'dive_destination');
    if ($destination === 'overseas') {
        return d365_text('海外ツアーについて相談したい', 'I am interested in an overseas dive trip');
    }
    $overseas = d365_overseas_destinations()[$destination] ?? null;
    if ($overseas) {
        return d365_text('海外ツアーの希望先：', 'Preferred overseas destination: ') . d365_text(...$overseas['name']);
    }
    foreach (d365_tour_destinations() as $id => $area) {
        $place = $destination === $id ? $area : ($area['spots'][$destination] ?? null);
        if ($place) {
            return d365_text('希望のエリア：', 'Preferred destination: ') . d365_text(...$place['name']);
        }
    }
    return $notes;
});

function d365_is_michael(): bool {
    return get_query_var('d365_michael') === '1';
}

function d365_michael_url(bool $english): string {
    if (get_option('permalink_structure')) {
        return home_url(($english ? '/en' : '') . '/michael/');
    }
    return add_query_arg('d365_michael', '1', d365_home($english));
}

function d365_landing_url(bool $english): string {
    if (d365_is_michael()) {
        return d365_michael_url($english);
    }
    if ($area = d365_tour_area()) {
        return d365_tour_area_url($area, $english);
    }
    if (d365_is_courses()) {
        return d365_courses_url($english);
    }
    $type = d365_experience();
    return $type ? d365_experience_url($type, $english) : d365_home($english);
}

add_filter('template_include', static function (string $template): string {
    if (d365_is_michael()) {
        return get_theme_file_path('michael.php');
    }
    if (d365_is_courses()) {
        return get_theme_file_path('courses.php');
    }
    return match (d365_experience()) {
        'tour' => get_theme_file_path('tour.php'),
        'overseas' => get_theme_file_path('overseas.php'),
        'trial' => get_theme_file_path('experiences.php'),
        default => $template,
    };
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
    if (d365_is_michael()) {
        return d365_text('マイケル君の紹介｜Diving Shop C365', 'Meet Michael | Diving Shop C365');
    }
    if (d365_is_courses()) {
        return d365_text('PADI講習・スキルアップ｜Diving Shop C365', 'PADI Courses & Skills | Diving Shop C365');
    }
    if ($area = d365_tour_area()) {
        $name = d365_text(...d365_tour_destinations()[$area]['name']);
        return $name . d365_text('のダイビングスポット｜Diving Shop C365', ' Dive Spots | Diving Shop C365');
    }
    $titles = [
        'trial' => d365_text('横浜から体験ダイビング｜Diving Shop C365', 'Discover Scuba Diving from Yokohama | Diving Shop C365'),
        'overseas' => d365_text('海外ダイビングツアー｜パラオ・プーケット・サイパン・バリ｜Diving Shop C365', 'Overseas Dive Trips to Palau, Phuket, Saipan & Bali | Diving Shop C365'),
        'tour' => d365_text('三浦・逗子・葉山・伊豆のダイビングツアー｜Diving Shop C365', 'Miura, Zushi, Hayama & Izu Dive Trips | Diving Shop C365'),
    ];
    if (isset($titles[d365_experience()])) {
        return $titles[d365_experience()];
    }
    return is_front_page() ? d365_text('Diving Shop C365｜横浜のダイビングショップ', 'Diving Shop C365 | Scuba Diving in Yokohama') : $title;
});
add_action('wp_head', static function (): void {
    if ((is_front_page() || d365_is_michael() || d365_is_courses() || d365_experience()) && function_exists('d365_show_booking')) {
        foreach (['ja' => d365_landing_url(false), 'en' => d365_landing_url(true), 'x-default' => d365_landing_url(false)] as $lang => $url) {
            printf('<link rel="alternate" hreflang="%s" href="%s">' . "\n", esc_attr($lang), esc_url($url));
        }
    }
});
require get_theme_file_path('seo.php');
