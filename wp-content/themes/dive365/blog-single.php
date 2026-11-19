<?php get_header(); ?>
<main id="main" class="blog-page blog-single">
    <?php while (have_posts()): the_post(); ?>
        <article <?php post_class('blog-article'); ?>>
            <header class="blog-banner">
                <div class="wrap blog-reading">
                    <a class="text-link" href="<?= esc_url(d365_archive_url('diving_blog')) ?>">← ダイビングブログ一覧</a>
                    <h1><?php the_title(); ?></h1>
                    <time datetime="<?= esc_attr(get_the_date(DATE_W3C)) ?>"><?= esc_html(get_the_date('Y年n月j日')) ?></time>
                </div>
            </header>
            <div class="wrap blog-reading">
                <?php if (has_post_thumbnail() && !post_password_required()): ?>
                    <?php $featured = get_post_thumbnail_id(); ?>
                    <?php if (!preg_match('/\bwp-image-' . (int) $featured . '\b/', get_post_field('post_content', get_the_ID()))): ?>
                        <figure class="blog-cover"><?php the_post_thumbnail('large'); ?></figure>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="blog-content">
                    <?php the_content(); wp_link_pages(); ?>
                </div>
                <?php if (comments_open() || get_comments_number()) { comments_template(); } ?>
                <a class="button outline blog-article-nav" href="<?= esc_url(d365_archive_url('diving_blog')) ?>">← ダイビングブログ一覧</a>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
