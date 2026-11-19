<?php get_header(); ?>
<main id="main" class="blog-page blog-archive">
    <header class="blog-banner">
        <div class="wrap">
            <h1>ダイビングブログ</h1>
            <p>Diving Shop C365の海日記。ツアーや講習で出会った海の景色を、写真と一緒にお届けします。</p>
        </div>
    </header>
    <div class="wrap blog-list">
        <?php if (have_posts()): ?>
            <div class="blog-card-grid">
                <?php while (have_posts()): the_post(); ?>
                    <article <?php post_class('blog-card'); ?>>
                        <a href="<?php the_permalink(); ?>">
                            <div class="blog-card-media">
                                <?php $image = d365_blog_thumbnail(); ?>
                                <?php if ($image): ?>
                                    <?= $image // The thumbnail helper returns escaped image markup. ?>
                                <?php else: ?>
                                    <img class="blog-card-emblem" src="<?= esc_url(d365_asset('c365-deep-diving.webp')) ?>" alt="" width="90" height="96" loading="lazy">
                                <?php endif; ?>
                            </div>
                            <div class="blog-card-text">
                                <time datetime="<?= esc_attr(get_the_date(DATE_W3C)) ?>"><?= esc_html(get_the_date('Y年n月j日')) ?></time>
                                <h2><?php the_title(); ?></h2>
                                <p><?= esc_html(wp_html_excerpt(wp_strip_all_tags(get_the_excerpt(), true), 90, '…')) ?></p>
                            </div>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
            <?php the_posts_pagination(['prev_text' => '前へ', 'next_text' => '次へ', 'screen_reader_text' => 'ブログ記事一覧のページ移動']); ?>
        <?php else: ?>
            <p>現在表示できる記事はありません。</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
