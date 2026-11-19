<?php get_header(); ?>
<main id="main" class="section">
    <div class="wrap reading">
        <?php if (is_archive()): ?><h1><?= wp_kses_post(get_the_archive_title()) ?></h1><?php endif; ?>
        <?php if (is_home()): ?><h1>ブログ</h1><?php endif; ?>
        <?php if (!have_posts()): ?>
            <h1>ページが見つかりませんでした</h1>
            <p><a href="<?= esc_url(home_url('/')) ?>">トップへ戻る</a></p>
        <?php endif; ?>
        <?php while (have_posts()): the_post(); ?>
            <article <?php post_class(); ?>>
                <?php if (is_singular()): ?>
                    <h1><?php the_title(); ?></h1>
                    <?php if (!is_page()): ?><time datetime="<?= esc_attr(get_the_date(DATE_W3C)) ?>"><?php echo esc_html(get_the_date()); ?></time><?php endif; ?>
                    <?php if (has_post_thumbnail()) { the_post_thumbnail('large'); } ?>
                    <?php the_content(); wp_link_pages(); ?>
                    <?php if (is_page(9) && function_exists('d365_show_booking')) { d365_show_booking(); } ?>
                <?php else: ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <time datetime="<?= esc_attr(get_the_date(DATE_W3C)) ?>"><?php echo esc_html(get_the_date()); ?></time>
                    <?php the_excerpt(); ?>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
        <?php if (!is_singular()) { the_posts_pagination(); } ?>
        <?php if (is_singular() && (comments_open() || get_comments_number())) { comments_template(); } ?>
    </div>
</main>
<?php get_footer(); ?>
