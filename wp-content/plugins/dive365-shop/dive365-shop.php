<?php
/**
 * Plugin Name: Dive 365 Shop
 * Description: Bilingual dive calendar, booking requests, and legacy post type support for Dive 365.
 * Version: 1.2.0
 * Requires PHP: 8.1
 */

defined('ABSPATH') || exit;

function d365_is_english(): bool {
    return get_query_var('d365_lang') === 'en';
}

function d365_text(string $ja, string $en): string {
    return d365_is_english() ? $en : $ja;
}

function d365_home(bool $english, array $args = []): string {
    if ($english) {
        if (get_option('permalink_structure')) {
            return add_query_arg($args, home_url('/en/'));
        }
        $args['d365_lang'] = 'en';
    }
    return add_query_arg($args, home_url('/'));
}

function d365_register(): void {
    add_rewrite_rule('^en/discover-scuba/?$', 'index.php?d365_lang=en&d365_experience=trial', 'top');
    add_rewrite_rule('^en/dive-trips/overseas/?$', 'index.php?d365_lang=en&d365_experience=overseas', 'top');
    add_rewrite_rule('^dive-trips/overseas/?$', 'index.php?d365_experience=overseas', 'top');
    add_rewrite_rule('^en/dive-trips/(miura-zushi-hayama|izu)/?$', 'index.php?d365_lang=en&d365_experience=tour&d365_tour_area=$matches[1]', 'top');
    add_rewrite_rule('^dive-trips/(miura-zushi-hayama|izu)/?$', 'index.php?d365_experience=tour&d365_tour_area=$matches[1]', 'top');
    add_rewrite_rule('^en/dive-trips/?$', 'index.php?d365_lang=en&d365_experience=tour', 'top');
    add_rewrite_rule('^en/courses/?$', 'index.php?d365_lang=en&d365_courses=1', 'top');
    add_rewrite_rule('^en/?$', 'index.php?d365_lang=en', 'top');

    // Preserve the post types and query URLs used by the previous theme.
    foreach (['diving_blog' => 'ダイビングブログ', 'news' => 'お知らせ'] as $type => $label) {
        if (!post_type_exists($type)) {
            register_post_type($type, [
                'label' => $label, 'public' => true, 'has_archive' => true,
                'show_in_rest' => true, 'rewrite' => ['slug' => $type],
                'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'author', 'comments', 'revisions', 'custom-fields'],
            ]);
        }
    }

    register_post_type('d365_session', [
        'label' => 'ダイビング日程', 'show_ui' => true, 'public' => false,
        'supports' => ['title'], 'menu_icon' => 'dashicons-calendar-alt',
        'labels' => ['add_new_item' => 'ダイビング日程を追加', 'edit_item' => 'ダイビング日程を編集'],
    ]);

    register_post_type('d365_booking', [
        'label' => 'ダイビング予約', 'show_ui' => true, 'public' => false,
        'supports' => ['title'], 'menu_icon' => 'dashicons-clipboard',
        'capability_type' => ['d365_booking', 'd365_bookings'], 'map_meta_cap' => true,
        'capabilities' => [
            'create_posts' => 'do_not_allow',
            'edit_posts' => 'manage_options',
            'edit_others_posts' => 'manage_options',
            'edit_published_posts' => 'manage_options',
            'edit_private_posts' => 'manage_options',
            'read_private_posts' => 'manage_options',
            'delete_posts' => 'manage_options',
            'delete_others_posts' => 'manage_options',
            'delete_published_posts' => 'manage_options',
            'delete_private_posts' => 'manage_options',
        ],
    ]);
}
add_action('init', 'd365_register', 20);
function d365_refresh_rewrite_rules(): void {
    if (get_option('d365_rewrite_version') !== '3') {
        flush_rewrite_rules(false);
        update_option('d365_rewrite_version', '3');
    }
}
add_action('wp_loaded', 'd365_refresh_rewrite_rules');
register_activation_hook(__FILE__, static function (): void {
    d365_register();
    flush_rewrite_rules(false);
    update_option('d365_rewrite_version', '3');
});
add_filter('query_vars', static function (array $vars): array {
    $vars[] = 'd365_lang';
    $vars[] = 'd365_courses';
    $vars[] = 'd365_experience';
    $vars[] = 'd365_tour_area';
    return $vars;
});
add_filter('request', static function (array $vars): array {
    if (($vars['d365_lang'] ?? '') === 'en' && count($vars) === 1 && get_option('show_on_front') === 'page') {
        $vars['page_id'] = (int) get_option('page_on_front');
    }
    return $vars;
});
add_filter('redirect_canonical', static function ($redirect) {
    return ((d365_is_english() && is_front_page()) || get_query_var('d365_courses') === '1' || in_array(get_query_var('d365_experience'), ['trial', 'tour', 'overseas'], true)) ? false : $redirect;
});

function d365_now(): DateTimeImmutable {
    return new DateTimeImmutable('now', new DateTimeZone('Asia/Tokyo'));
}

function d365_date(string $value, string $format = 'Y-m-d'): ?DateTimeImmutable {
    $date = DateTimeImmutable::createFromFormat('!' . $format, $value, d365_now()->getTimezone());
    return $date && $date->format($format) === $value ? $date : null;
}

function d365_input(array $input, string $key): string {
    return isset($input[$key]) && is_string($input[$key]) ? wp_unslash($input[$key]) : '';
}

function d365_services(): array {
    return [
        'trial' => d365_text('体験ダイビング', 'Discover Scuba Diving'),
        'course' => d365_text('ライセンス講習', 'Scuba Certification'),
        'tour' => d365_text('ファンダイブツアー', 'Fun Dive Trips'),
    ];
}

function d365_statuses(): array {
    return ['pending' => '未対応', 'confirmed' => '確定', 'declined' => '受付不可', 'cancelled' => 'キャンセル'];
}

function d365_session_title(WP_Post $event): string {
    $translation = (string) get_post_meta($event->ID, '_d365_en', true);
    return d365_is_english() && $translation !== '' ? $translation : $event->post_title;
}

function d365_sessions(string $from, string $to = ''): array {
    $dates = ['key' => '_d365_date', 'value' => $from, 'compare' => '>='];
    if ($to !== '') {
        $dates['value'] = [$from, $to];
        $dates['compare'] = 'BETWEEN';
    }
    return get_posts([
        'post_type' => 'd365_session', 'post_status' => 'publish', 'posts_per_page' => -1,
        'meta_key' => '_d365_date', 'orderby' => ['meta_value' => 'ASC', 'ID' => 'ASC'],
        'meta_query' => [$dates],
    ]);
}

function d365_session_open(WP_Post $event): bool {
    $date = (string) get_post_meta($event->ID, '_d365_date', true);
    return $event->post_type === 'd365_session' && $event->post_status === 'publish'
        && d365_date($date) && $date >= d365_now()->format('Y-m-d')
        && get_post_meta($event->ID, '_d365_availability', true) === 'open';
}

add_action('add_meta_boxes', static function (): void {
    add_meta_box('d365_session', '開催日程の設定', 'd365_session_box', 'd365_session');
    add_meta_box('d365_booking', '予約申請の詳細', 'd365_booking_box', 'd365_booking');
});

function d365_session_box(WP_Post $post): void {
    wp_nonce_field('d365_save_session', 'd365_session_nonce');
    $date = get_post_meta($post->ID, '_d365_date', true);
    $english = get_post_meta($post->ID, '_d365_en', true);
    $availability = get_post_meta($post->ID, '_d365_availability', true);
    $service = get_post_meta($post->ID, '_d365_service', true);
    ?>
    <p><label for="d365_date">開催日（日本時間）</label><br><input type="date" id="d365_date" name="d365_date" value="<?= esc_attr($date) ?>"></p>
    <p><label for="d365_en">英語でのイベント名</label><br><input class="widefat" id="d365_en" name="d365_en" value="<?= esc_attr($english) ?>"></p>
    <p><label for="d365_service">コース</label><br><select id="d365_service" name="d365_service">
        <?php foreach (d365_services() as $key => $label): ?>
            <option value="<?= esc_attr($key) ?>" <?php selected($service, $key); ?>><?= esc_html($label) ?></option>
        <?php endforeach; ?>
    </select></p>
    <p><label for="d365_availability">予約受付</label><br><select id="d365_availability" name="d365_availability">
        <option value="closed" <?php selected($availability !== 'open'); ?>>受付終了</option>
        <option value="open" <?php selected($availability, 'open'); ?>>受付中</option>
    </select></p>
    <?php
}

add_action('save_post_d365_session', static function (int $id): void {
    if (wp_is_post_revision($id) || wp_is_post_autosave($id) || !current_user_can('edit_post', $id)
        || !wp_verify_nonce(d365_input($_POST, 'd365_session_nonce'), 'd365_save_session')) {
        return;
    }
    $date = d365_input($_POST, 'd365_date');
    $service = d365_input($_POST, 'd365_service');
    update_post_meta($id, '_d365_date', d365_date($date) ? $date : '');
    update_post_meta($id, '_d365_en', sanitize_text_field(d365_input($_POST, 'd365_en')));
    update_post_meta($id, '_d365_service', array_key_exists($service, d365_services()) ? $service : 'trial');
    update_post_meta($id, '_d365_availability', d365_input($_POST, 'd365_availability') === 'open' ? 'open' : 'closed');
});

function d365_booking_box(WP_Post $post): void {
    wp_nonce_field('d365_save_booking', 'd365_booking_nonce');
    $labels = [
        'name' => 'お名前', 'email' => 'メール', 'people' => '人数',
        'session_title' => '申込時の日程名', 'session_date' => '開催日・希望日', 'service' => 'コース',
        'language' => '言語', 'message' => '連絡事項',
    ];
    ?>
    <dl>
        <?php foreach ($labels as $key => $label): ?>
            <dt><strong><?= esc_html($label) ?></strong></dt>
            <?php $value = (string) get_post_meta($post->ID, '_d365_' . $key, true); ?>
            <dd><?= nl2br(esc_html($key === 'service' ? (d365_services()[$value] ?? $value) : $value)) ?></dd>
        <?php endforeach; ?>
    </dl>
    <p><label for="d365_status">対応状況</label><br><select id="d365_status" name="d365_status">
        <?php foreach (d365_statuses() as $key => $label): ?>
            <option value="<?= esc_attr($key) ?>" <?php selected(get_post_meta($post->ID, '_d365_status', true), $key); ?>><?= esc_html($label) ?></option>
        <?php endforeach; ?>
    </select></p>
    <?php
}

add_action('save_post_d365_booking', static function (int $id): void {
    if (!current_user_can('edit_post', $id) || wp_is_post_revision($id) || wp_is_post_autosave($id)
        || !wp_verify_nonce(d365_input($_POST, 'd365_booking_nonce'), 'd365_save_booking')) {
        return;
    }
    $status = d365_input($_POST, 'd365_status');
    if (array_key_exists($status, d365_statuses())) {
        update_post_meta($id, '_d365_status', $status);
    }
});

add_filter('manage_d365_booking_posts_columns', static function (array $columns): array {
    return array_merge(array_diff_key($columns, ['date' => true]), ['session' => '開催日程', 'status' => '対応状況', 'date' => '受信日']);
});
add_action('manage_d365_booking_posts_custom_column', static function (string $column, int $id): void {
    if ($column === 'session') {
        echo esc_html(get_post_meta($id, '_d365_session_date', true) . ' ' . get_post_meta($id, '_d365_session_title', true));
    } elseif ($column === 'status') {
        $status = get_post_meta($id, '_d365_status', true);
        echo esc_html(d365_statuses()[$status] ?? '未対応');
    }
}, 10, 2);
add_filter('manage_d365_session_posts_columns', static function (array $columns): array {
    return array_merge(array_diff_key($columns, ['date' => true]), ['session_date' => '開催日', 'availability' => '予約受付']);
});
add_action('manage_d365_session_posts_custom_column', static function (string $column, int $id): void {
    if ($column === 'session_date') {
        echo esc_html(get_post_meta($id, '_d365_date', true));
    } elseif ($column === 'availability') {
        echo d365_session_open(get_post($id)) ? '受付中' : '受付終了';
    }
}, 10, 2);

add_action('admin_post_nopriv_d365_book', 'd365_submit_booking');
add_action('admin_post_d365_book', 'd365_submit_booking');
function d365_submit_booking(): void {
    $english = d365_input($_POST, 'language') === 'en';
    $result = d365_record_booking($_POST, $english);
    wp_safe_redirect(d365_home($english, ['booking' => $result]) . '#booking', 303);
    exit;
}

function d365_record_booking(array $input, bool $english): string {
    if (!wp_verify_nonce(d365_input($input, 'd365_nonce'), 'd365_book')
        || d365_input($input, 'company') !== '') {
        return 'invalid';
    }

    $session = d365_input($input, 'session');
    $service = d365_input($input, 'service');
    $date = d365_input($input, 'preferred_date');
    $event = null;
    if ($session !== '') {
        $id = filter_var($session, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $event = $id ? get_post($id) : null;
        if (!$event || !d365_session_open($event)) {
            return 'closed';
        }
        $service = (string) get_post_meta($event->ID, '_d365_service', true);
        $date = (string) get_post_meta($event->ID, '_d365_date', true);
    }
    if (!isset(d365_services()[$service]) || ($date !== '' && (!d365_date($date) || $date < d365_now()->format('Y-m-d')))) {
        return 'invalid';
    }

    $name = sanitize_text_field(d365_input($input, 'guest_name'));
    $raw_email = trim(d365_input($input, 'guest_email'));
    $email = sanitize_email($raw_email);
    $people = filter_var(d365_input($input, 'people'), FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 10]]);
    $message = sanitize_textarea_field(d365_input($input, 'message'));
    if ($name === '' || strlen($name) > 400 || !is_email($email) || $email !== $raw_email || strlen($email) > 254
        || !$people || strlen($message) > 4000 || d365_input($input, 'consent') !== '1') {
        return 'invalid';
    }

    $event_en = $event ? (string) get_post_meta($event->ID, '_d365_en', true) : '';
    $booking = wp_insert_post([
        'post_type' => 'd365_booking', 'post_status' => 'private', 'post_title' => '予約申請 ' . wp_generate_uuid4(),
        'meta_input' => [
            '_d365_name' => $name, '_d365_email' => $email, '_d365_people' => $people,
            '_d365_message' => $message, '_d365_language' => $english ? 'English' : '日本語',
            '_d365_session' => $event->ID ?? 0, '_d365_session_title' => $english && $event_en !== '' ? $event_en : ($event->post_title ?? ''),
            '_d365_session_date' => $date, '_d365_service' => $service, '_d365_status' => 'pending',
        ],
    ], true);
    return $booking && !is_wp_error($booking) ? 'received' : 'error';
}

function d365_show_booking(): void {
    require __DIR__ . '/calendar.php';
}
