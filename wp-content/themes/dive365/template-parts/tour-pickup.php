<?php defined('ABSPATH') || exit; ?>
<p class="tour-pickup">
    <span class="tour-pickup-icon" aria-hidden="true">🚐</span>
    <span class="tour-pickup-copy">
        <strong><?php d365_label('すべてのツアーに無料送迎付き', 'Free shuttle service on every trip'); ?></strong>
        <?php d365_label('集合場所：', 'Meet at '); ?><a href="<?= esc_url(d365_home(d365_is_english()) . '#access') ?>"><?php d365_label('横浜の店舗 Diving Shop C365', 'Diving Shop C365 in Yokohama'); ?></a>
    </span>
</p>
