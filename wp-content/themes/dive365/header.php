<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open();
$root = d365_home(d365_is_english());
?>
<a class="screen-reader-text skip-link" href="#main"><?php d365_label('本文へ移動', 'Skip to content'); ?></a>
<header class="site-header">
    <div class="header-wrap">
        <a class="wordmark" href="<?= esc_url($root) ?>" aria-label="Dive 365">
            <img src="<?= esc_url(d365_asset('logo-alt.png')) ?>" width="38" height="38" alt="">
            <span>DIVE<span class="brand-accent">365</span><small>YOKOHAMA</small></span>
        </a>
        <nav aria-label="<?= esc_attr(d365_text('メインメニュー', 'Main menu')) ?>">
            <a href="<?= esc_url($root . '#services') ?>"><?php d365_label('ダイビングメニュー', 'Diving'); ?></a>
            <?php if (function_exists('d365_show_booking')): ?><a href="<?= esc_url(d365_courses_url(d365_is_english())) ?>"><?php d365_label('講習・スキルアップ', 'PADI courses'); ?></a><a href="<?= esc_url($root . '#calendar') ?>"><?php d365_label('カレンダー', 'Calendar'); ?></a><?php endif; ?>
            <a href="<?= esc_url(d365_archive_url('diving_blog')) ?>"><?php d365_label('ブログ', 'Blog'); ?></a>
            <a href="<?= esc_url($root . '#access') ?>"><?php d365_label('アクセス', 'Access'); ?></a>
        </nav>
        <div class="header-actions">
            <?php if (function_exists('d365_show_booking')): ?>
                <a class="language" lang="<?= d365_is_english() ? 'ja' : 'en' ?>" href="<?= esc_url(d365_landing_url(!d365_is_english())) ?>" aria-label="<?= esc_attr(d365_text('English site', '日本語サイト')) ?>"><?= d365_is_english() ? 'JP' : 'EN' ?></a>
                <a class="button header-book" href="<?= esc_url($root . '#booking') ?>"><?php d365_label('予約する', 'Book a dive'); ?> <span aria-hidden="true">↗</span></a>
            <?php endif; ?>
        </div>
    </div>
</header>
