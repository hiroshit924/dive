<?php
get_header();
$english = d365_is_english();
$destinations = d365_tour_destinations();
$area_id = d365_tour_area();
$area = $destinations[$area_id] ?? null;
$tour_url = d365_experience_url('tour', $english);
?>
<main id="main" class="tour-page">
    <?php get_template_part('template-parts/tour-navigation'); ?>
    <section class="tour-banner">
        <div class="wrap tour-banner-inner">
            <div>
                <?php if ($area): ?>
                    <a class="text-link tour-back" href="<?= esc_url($tour_url) ?>">← <?php d365_label('ツアー情報', 'All dive trips'); ?></a>
                    <p class="tour-kicker"><?= esc_html(d365_text(...$area['name'])) ?></p>
                    <h1><?= esc_html(d365_text(...$area['headline'])) ?></h1>
                    <p class="tour-intro"><?= esc_html(d365_text(...$area['description'])) ?></p>
                    <div class="tour-actions">
                        <a class="button" href="#spots"><?php d365_label('スポットを見る', 'Explore dive spots'); ?> <span aria-hidden="true">↓</span></a>
                        <a class="text-link" href="<?= esc_url($tour_url . '#tour-map') ?>"><?php d365_label('地図を見る', 'View map'); ?> <span aria-hidden="true">↗</span></a>
                    </div>
                <?php else: ?>
                    <p class="tour-kicker"><?php d365_label('横浜発のファンダイブツアー', 'Fun dives from Yokohama'); ?></p>
                    <h1><?php d365_label('週末、どの海へ行こう。', 'Where shall we dive this weekend?'); ?></h1>
                    <p class="tour-intro"><?php d365_label('近場の海で小さな生き物を探したり、伊豆で魚の群れに出会ったり。次に潜ってみたい海を、ここから見つけよう。', 'Look for tiny marine life close to home or find yourself surrounded by fish in Izu. Your next favorite dive starts here.'); ?></p>
                    <div class="tour-actions">
                        <a class="button" href="#tour-map"><?php d365_label('地図で行き先を探す', 'Explore the map'); ?> <span aria-hidden="true">↓</span></a>
                        <a class="text-link" href="<?= esc_url(d365_tour_booking_url()) ?>"><?php d365_label('日程を相談する', 'Request a date'); ?> <span aria-hidden="true">↗</span></a>
                        <a class="text-link" href="#rental-gear"><?php d365_label('器材レンタル', 'Equipment rental'); ?> <span aria-hidden="true">↓</span></a>
                    </div>
                <?php endif; ?>
            </div>
            <figure class="tour-banner-photo">
                <img src="<?= esc_url(d365_asset($area['photo'] ?? 'tour-izu.webp')) ?>" alt="" width="768" height="576" fetchpriority="high">
                <figcaption><?= esc_html(d365_text(...($area['photo_caption'] ?? ['大瀬崎', 'Osezaki']))) ?></figcaption>
            </figure>
        </div>
    </section>
    <?php if ($area): ?>
        <section id="spots" class="section tour-spots">
            <div class="wrap">
                <h2><?php d365_label('このエリアで潜るなら', 'Explore the dive spots'); ?></h2>
                <div class="tour-spot-grid">
                    <?php foreach ($area['spots'] as $slug => $spot): ?>
                        <article class="tour-spot" id="<?= esc_attr($slug) ?>" tabindex="-1">
                            <?php if (isset($spot['photo'])): ?>
                                <img src="<?= esc_url(d365_asset($spot['photo'])) ?>" alt="" width="768" height="480" loading="lazy">
                            <?php endif; ?>
                            <div class="tour-spot-body">
                                <p class="tour-location"><?= esc_html(d365_text(...$spot['location'])) ?></p>
                                <h3><?= esc_html(d365_text(...$spot['name'])) ?></h3>
                                <p class="tour-tag"><?= esc_html(d365_text(...$spot['feature'])) ?></p>
                                <p><?= esc_html(d365_text(...$spot['description'])) ?></p>
                                <p><?= esc_html(d365_text(...$spot['highlights'])) ?></p>
                                <a class="text-link" href="<?= esc_url(d365_tour_booking_url($slug)) ?>"
                                   aria-label="<?= esc_attr($english ? 'Ask about diving in ' . $spot['name'][1] : $spot['name'][0] . 'のツアーを相談する') ?>">
                                    <?php d365_label('この海を相談する', 'Ask about this dive'); ?> <span aria-hidden="true">↗</span>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
                <p class="course-note"><?php d365_label('開催場所・日程は海況や経験に合わせてご案内します。生き物は季節やその日の海況によって変わります。', 'We’ll suggest sites and dates based on conditions and your experience. Wildlife varies with the season and the day.'); ?></p>
            </div>
        </section>
        <section class="tour-next">
            <div class="wrap">
                <h2><?= esc_html(d365_text(...$destinations[$area_id === 'izu' ? 'miura-zushi-hayama' : 'izu']['name'])) ?></h2>
                <a class="text-link" href="<?= esc_url(d365_tour_area_url($area_id === 'izu' ? 'miura-zushi-hayama' : 'izu', $english)) ?>"><?php d365_label('こちらのエリアも見る', 'Explore this area too'); ?> <span aria-hidden="true">→</span></a>
            </div>
        </section>
    <?php else: ?>
        <section class="section tour-regions">
            <div class="wrap">
                <h2><?php d365_label('エリアから選ぶ', 'Explore by region'); ?></h2>
                <div class="tour-region-grid">
                    <?php foreach ($destinations as $slug => $region): ?>
                        <a class="tour-region-card" href="<?= esc_url(d365_tour_area_url($slug, $english)) ?>">
                            <img src="<?= esc_url(d365_asset($region['photo'])) ?>" alt="" width="768" height="420" loading="lazy">
                            <div>
                                <h3><?= esc_html(d365_text(...$region['name'])) ?></h3>
                                <p><?= esc_html(d365_text(...$region['description'])) ?></p>
                                <span class="text-link"><?php d365_label('このエリアを見る', 'Explore this area'); ?> <span aria-hidden="true">→</span></span>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php require __DIR__ . '/tour-map.php'; ?>
    <?php endif; ?>
    <?php if (!$area): ?>
        <section id="tour-prices" class="section">
            <div class="wrap">
                <h2><?php d365_label('ツアー料金・持ち物', 'Trip prices and what to bring'); ?></h2>
                <div class="course-grid">
                    <article class="course-card">
                        <h3><?php d365_label('逗子・葉山', 'Zushi and Hayama'); ?></h3>
                        <p class="course-price">¥29,000</p>
                        <p><?php d365_label('ガイド、施設、タンク、保険料込み。城ヶ島の料金はお問い合わせください。', 'Includes a guide, facility fees, tanks and insurance. Ask us for Jogashima pricing.'); ?></p>
                    </article>
                    <article class="course-card">
                        <h3><?php d365_label('伊豆方面', 'Izu'); ?></h3>
                        <p class="course-price"><?php d365_label('¥36,000〜', 'From ¥36,000'); ?></p>
                        <p><?php d365_label('水着、器材、タオル、サンダルをご用意ください。', 'Bring swimwear, dive equipment, a towel and sandals.'); ?></p>
                    </article>
                </div>
                <p class="course-note"><?php d365_label('海況によって日程や行き先が変わる場合があります。器材レンタルは別料金です。', 'Routes and dates may change depending on conditions. Rental equipment is charged separately.'); ?></p>
            </div>
        </section>
    <?php endif; ?>
    <?php if (!$area): ?>
        <?php get_template_part('template-parts/rental-gear'); ?>
        <?php get_template_part('template-parts/cancellation-policy'); ?>
    <?php endif; ?>
    <section class="tour-cta">
        <div class="wrap">
            <div>
                <h2><?php d365_label('次に潜りたい海、決まった？', 'Found a spot you’d love to dive?'); ?></h2>
                <p><?php d365_label('行ってみたい場所や希望日を教えてください。経験や海況に合わせてご提案します。', 'Tell us where and when you’d like to dive. We’ll help you find a trip that matches your experience and the conditions.'); ?></p>
                <?php if ($area): ?>
                    <a class="text-link" href="<?= esc_url($tour_url . '#rental-gear') ?>"><?php d365_label('器材レンタル料金を見る', 'See rental equipment prices'); ?> <span aria-hidden="true">↗</span></a>
                <?php endif; ?>
            </div>
            <a class="button" href="<?= esc_url(d365_tour_booking_url($area_id)) ?>"><?php d365_label('ツアーを相談する', 'Plan a dive trip'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
