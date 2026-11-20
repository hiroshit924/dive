<?php
defined('ABSPATH') || exit;

if (!function_exists('d365_show_booking')) {
    return;
}
?>
<a class="button booking-link <?= esc_attr($args['class']) ?>" href="<?= esc_url(d365_home(d365_is_english()) . '#booking') ?>">
    <span class="booking-icon" aria-hidden="true"></span>
    <span><?php d365_label('予約・問い合わせ', 'Book or inquire'); ?></span>
</a>
