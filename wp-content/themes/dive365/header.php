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
        <a class="wordmark" href="<?= esc_url($root) ?>" aria-label="Diving Shop C365">
            <img src="<?= esc_url(d365_asset('c365-brand.webp')) ?>" width="38" height="38" alt="">
            <span>Diving Shop <strong>C365</strong></span>
        </a>
        <button type="button" class="menu-toggle" aria-controls="site-navigation" aria-expanded="false" hidden>
            <span class="menu-icon" aria-hidden="true"></span>
            <span class="screen-reader-text"><?php d365_label('メニュー', 'Menu'); ?></span>
        </button>
        <nav id="site-navigation" aria-label="<?= esc_attr(d365_text('メインメニュー', 'Main menu')) ?>">
            <a href="<?= esc_url($root . '#first-dive') ?>"><?php d365_label('初めての方へ', 'First dive'); ?></a>
            <a href="<?= esc_url($root . '#services') ?>"><?php d365_label('ダイビングメニュー', 'Diving'); ?></a>
            <?php if (function_exists('d365_show_booking')): ?><a href="<?= esc_url(d365_experience_url('tour', d365_is_english())) ?>"><?php d365_label('ツアー', 'Trips'); ?></a><?php endif; ?>
            <?php if (function_exists('d365_show_booking')): ?><a href="<?= esc_url(d365_courses_url(d365_is_english())) ?>"><?php d365_label('講習・スキルアップ', 'PADI courses'); ?></a><a href="<?= esc_url($root . '#calendar') ?>"><?php d365_label('カレンダー', 'Calendar'); ?></a><?php endif; ?>
            <a href="<?= esc_url(d365_archive_url('diving_blog')) ?>"><?php d365_label('ブログ', 'Blog'); ?></a>
            <a href="<?= esc_url($root . '#access') ?>"><?php d365_label('アクセス', 'Access'); ?></a>
            <?php get_template_part('template-parts/booking-link', null, ['class' => 'menu-book']); ?>
        </nav>
        <div class="header-actions">
            <?php if (function_exists('d365_show_booking')): ?>
                <a class="language" lang="<?= d365_is_english() ? 'ja' : 'en' ?>" href="<?= esc_url(d365_landing_url(!d365_is_english())) ?>" aria-label="<?= esc_attr(d365_text('English site', '日本語サイト')) ?>"><?= d365_is_english() ? 'JP' : 'EN' ?></a>
                <?php get_template_part('template-parts/booking-link', null, ['class' => 'header-book']); ?>
            <?php endif; ?>
        </div>
    </div>
</header>
