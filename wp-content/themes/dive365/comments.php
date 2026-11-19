<?php if (!post_password_required()): ?>
    <?php if (have_comments()): ?>
        <h2>コメント</h2>
        <ol><?php wp_list_comments(['style' => 'ol']); ?></ol>
        <?php the_comments_pagination(); ?>
    <?php endif; ?>
    <?php comment_form(); ?>
<?php endif; ?>
