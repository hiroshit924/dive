<?php
defined('ABSPATH') || exit;
?>
<a class="instagram-link" href="<?= esc_url(d365_instagram_url()) ?>">
    <span class="instagram-icon" aria-hidden="true"><span></span></span>
    <span>Instagram<?php if (!empty($args['show_handle'])): ?> <span class="instagram-handle">@c365_marine</span><?php endif; ?></span>
</a>
