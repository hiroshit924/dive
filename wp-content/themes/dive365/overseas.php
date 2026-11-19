<?php
get_header();
$english = d365_is_english();
$destinations = d365_overseas_destinations();
?>
<main id="main" class="tour-page overseas-page">
    <section class="tour-banner overseas-banner">
        <div class="wrap tour-banner-inner">
            <div>
                <a class="text-link tour-back" href="<?= esc_url(d365_experience_url('tour', $english)) ?>">← <?php d365_label('国内ツアー', 'Japan dive trips'); ?></a>
                <p class="tour-kicker"><?php d365_label('海外ダイビングツアー・不定期開催', 'Overseas dive trips · occasional departures'); ?></p>
                <h1><?php d365_label('次は、海を越えて。', 'Let’s go a little farther.'); ?></h1>
                <p class="tour-intro"><?php d365_label('パラオの外洋、プーケットの島々。いつもの仲間と、まだ潜ったことのない海へ。Diving Shop C365の海外ツアーは不定期で開催しています。', 'From Palau’s open ocean to the islands off Phuket, discover a new dive with familiar faces. Diving Shop C365 runs overseas trips from time to time.'); ?></p>
                <div class="tour-actions">
                    <a class="button" href="#overseas-destinations"><?php d365_label('行き先を見る', 'Explore destinations'); ?> <span aria-hidden="true">↓</span></a>
                    <a class="text-link" href="<?= esc_url(d365_tour_booking_url('overseas')) ?>"><?php d365_label('海外ツアーを相談する', 'Ask about a trip'); ?> <span aria-hidden="true">↗</span></a>
                </div>
            </div>
            <figure class="tour-banner-photo">
                <img src="<?= esc_url(d365_asset('overseas-palau.webp')) ?>" alt="" width="1280" height="850" fetchpriority="high">
                <figcaption><?php d365_label('パラオ・ロックアイランド', 'Rock Islands, Palau'); ?></figcaption>
            </figure>
        </div>
    </section>
    <section class="section overseas-destinations" id="overseas-destinations">
        <div class="wrap">
            <h2><?php d365_label('潜ってみたい海を探そう', 'Find a dive worth traveling for'); ?></h2>
            <div class="overseas-grid">
                <?php foreach ($destinations as $id => $destination): ?>
                    <article class="tour-spot overseas-card <?= in_array($id, ['palau', 'phuket'], true) ? 'is-featured' : '' ?>" id="<?= esc_attr($id) ?>">
                        <img src="<?= esc_url(d365_asset('overseas-' . $id . '.webp')) ?>" alt="" width="1280" height="800" loading="lazy">
                        <div class="tour-spot-body">
                            <h3><?= esc_html(d365_text(...$destination['name'])) ?></h3>
                            <p><?= esc_html(d365_text(...$destination['description'])) ?></p>
                            <dl>
                                <?php foreach ($destination['points'] as [$name, $description]): ?>
                                    <dt><?= esc_html(d365_text(...$name)) ?></dt>
                                    <dd><?= esc_html(d365_text(...$description)) ?></dd>
                                <?php endforeach; ?>
                            </dl>
                            <a class="text-link" href="<?= esc_url(d365_tour_booking_url($id)) ?>"
                                aria-label="<?= esc_attr($english ? 'Ask about ' . $destination['name'][1] : $destination['name'][0] . 'ツアーを相談する') ?>">
                                <?php d365_label('この旅を相談する', 'Ask about this trip'); ?> <span aria-hidden="true">↗</span>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="course-note"><?php d365_label('開催時期・料金・参加条件はツアーごとにご案内します。海況や経験によって、潜るポイントは変わります。', 'Dates, prices and requirements are announced for each trip. Sites depend on sea conditions and divers’ experience.'); ?></p>
            <details class="overseas-credits">
                <summary><?php d365_label('写真クレジット', 'Photo credits'); ?></summary>
                <ul>
                    <?php foreach ($destinations as $destination):
                        [$artist, $license, $file, $license_url] = $destination['credit'];
                        ?>
                        <li><a href="<?= esc_url('https://commons.wikimedia.org/wiki/File:' . rawurlencode(str_replace(' ', '_', $file))) ?>"><?= esc_html(d365_text(...$destination['name'])) ?> · <?= esc_html($artist) ?></a>
                        <?php if ($license_url): ?>
                            (<a href="<?= esc_url($license_url) ?>"><?= esc_html($license) ?></a> · <?php d365_label('縮小・表示時にトリミング', 'resized and cropped for display'); ?>)
                        <?php else: ?>
                            (<?= esc_html($license) ?>)
                        <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </details>
        </div>
    </section>
    <section class="tour-cta">
        <div class="wrap">
            <div>
                <h2><?php d365_label('行ってみたい海を教えてください', 'Tell us where you’d love to go'); ?></h2>
                <p><?php d365_label('気になる行き先や時期を、予約・相談フォームからお知らせください。', 'Use the booking request form to tell us the destination and time of year you have in mind.'); ?></p>
            </div>
            <a class="button" href="<?= esc_url(d365_tour_booking_url('overseas')) ?>"><?php d365_label('海外ツアーを相談する', 'Ask about an overseas trip'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
