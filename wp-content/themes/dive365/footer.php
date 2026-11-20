<footer class="site-footer">
    <div class="wrap footer-wrap">
        <a class="wordmark footer-brand" href="<?= esc_url(d365_home(d365_is_english())) ?>">
            <img src="<?= esc_url(d365_asset('c365-deep-diving.webp')) ?>" alt="" width="50" height="53" loading="lazy">
            <span>Diving Shop <strong>C365</strong></span>
        </a>
        <div class="footer-links">
            <?php if (function_exists('d365_show_booking')): ?><a href="<?= esc_url(d365_michael_url(d365_is_english())) ?>"><?php d365_label('マイケル君', 'Meet Michael'); ?></a><?php endif; ?>
            <?php get_template_part('template-parts/instagram'); ?>
            <a href="<?= esc_url(d365_experience_url('tour', d365_is_english()) . '#cancellation-policy') ?>"><?php d365_label('キャンセルポリシー', 'Cancellation policy'); ?></a>
            <?php if (get_privacy_policy_url()): ?><a href="<?= esc_url(get_privacy_policy_url()) ?>"><?php d365_label('プライバシーポリシー', 'Privacy policy'); ?></a><?php endif; ?>
        </div>
        <small>© <?= esc_html(wp_date('Y')) ?> Diving Shop C365</small>
    </div>
    <?php get_template_part('template-parts/booking-link', null, ['class' => 'floating-book']); ?>
</footer>
<?php wp_footer(); ?>
</body>
</html>
