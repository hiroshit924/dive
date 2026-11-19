<?php
defined('ABSPATH') || exit;
$english = d365_is_english();
$overseas = d365_experience() === 'overseas';
?>
<nav class="tour-navigation" aria-label="<?= esc_attr(d365_text('ツアーの種類', 'Tour destinations')) ?>">
    <div class="wrap tour-navigation-links">
        <a href="<?= esc_url(d365_experience_url('tour', $english)) ?>" <?php if (!$overseas): ?>aria-current="true"<?php endif; ?>><?php d365_label('国内ツアー', 'Japan dive trips'); ?></a>
        <a href="<?= esc_url(d365_experience_url('overseas', $english)) ?>" <?php if ($overseas): ?>aria-current="true"<?php endif; ?>><?php d365_label('海外ツアー', 'Overseas dive trips'); ?></a>
    </div>
</nav>
