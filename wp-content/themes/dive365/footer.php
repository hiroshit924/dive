<footer class="site-footer">
    <div class="wrap footer-wrap">
        <a class="wordmark" href="<?= esc_url(d365_home(d365_is_english())) ?>">DIVE<span class="brand-accent">365</span></a>
        <div><a href="https://www.instagram.com/c365_marine/">Instagram ↗</a>
            <?php if (get_privacy_policy_url()): ?><a href="<?= esc_url(get_privacy_policy_url()) ?>"><?php d365_label('プライバシーポリシー', 'Privacy policy'); ?></a><?php endif; ?>
        </div>
        <small>© <?= esc_html(wp_date('Y')) ?> Diving Shop C365</small>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
