<?php
get_header();
$trial = d365_experience() === 'trial';
$title = $trial ? d365_text('体験ダイビング', 'Discover Scuba Diving') : d365_text('ファンダイブツアー', 'Fun Dive Trips');
$intro = $trial
    ? d365_text('ライセンスがなくても、インストラクターと一緒に海へ。水面で呼吸と耳抜きを確認してから潜ります。', 'Try scuba without a certification. Your instructor will help you practice breathing and equalizing at the surface before you go underwater.')
    : d365_text('逗子・葉山を中心に、季節に合わせて伊豆方面へもご案内します。希望日や行ってみたい場所をご相談ください。', 'Join us in Zushi and Hayama, or head to Izu depending on the season. Tell us when and where you’d like to dive.');
$book = function_exists('d365_show_booking') ? d365_home(d365_is_english(), ['dive_service' => d365_experience()]) . '#booking' : 'tel:+81452735496';
?>
<main id="main" class="course-page">
    <div class="course-hero <?= $trial ? 'trial-hero' : 'tour-hero' ?>">
        <div class="wrap">
            <h1><?= esc_html($title) ?></h1>
            <p><?= esc_html($intro) ?></p>
            <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('日程を相談する', 'Request a date'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </div>
    <section class="section">
        <div class="wrap">
            <?php if ($trial): ?>
                <h2><?php d365_label('料金・参加条件', 'Price and eligibility'); ?></h2>
                <article class="course-card">
                    <h3>¥18,000</h3>
                    <ul>
                        <li><?php d365_label('施設使用料、器材、レクチャー、保険料込み', 'Includes facility fees, equipment, instruction and insurance'); ?></li>
                        <li><?php d365_label('10〜60歳。健康チェックがあり、55歳以上は医師の診断書が必要です。', 'Ages 10–60. A health check is required, and guests aged 55 or older need a medical certificate.'); ?></li>
                        <li><?php d365_label('持ち物は水着、タオル、サンダルです。', 'Bring swimwear, a towel and sandals.'); ?></li>
                    </ul>
                </article>
            <?php else: ?>
                <h2><?php d365_label('行き先・料金', 'Destinations and prices'); ?></h2>
                <div class="course-grid">
                    <article class="course-card">
                        <h3><?php d365_label('逗子・葉山', 'Zushi and Hayama'); ?></h3>
                        <p class="course-price">¥29,000</p>
                        <p><?php d365_label('ガイド、施設、タンク、保険料込み。', 'Includes a guide, facility fees, tanks and insurance.'); ?></p>
                    </article>
                    <article class="course-card">
                        <h3><?php d365_label('伊豆方面', 'Izu'); ?></h3>
                        <p class="course-price"><?php d365_label('¥36,000〜', 'From ¥36,000'); ?></p>
                        <p><?php d365_label('水着、器材、タオル、サンダルをご用意ください。', 'Bring swimwear, dive equipment, a towel and sandals.'); ?></p>
                    </article>
                </div>
                <p class="course-note"><?php d365_label('海況によって日程や行き先が変わる場合があります。器材レンタルは別料金です。', 'Routes and dates may change depending on conditions. Rental equipment is charged separately.'); ?></p>
                <details>
                    <summary><?php d365_label('器材レンタル料金', 'Equipment rental prices'); ?></summary>
                    <ul>
                        <li><?php d365_label('軽器材 ¥1,500', 'Mask, snorkel and fins ¥1,500'); ?></li>
                        <li><?php d365_label('レギュレーター ¥2,000', 'Regulator ¥2,000'); ?></li>
                        <li>BCD ¥2,000</li>
                        <li><?php d365_label('ウェットスーツ ¥1,500', 'Wetsuit ¥1,500'); ?></li>
                        <li><?php d365_label('ドライスーツ ¥4,000', 'Drysuit ¥4,000'); ?></li>
                    </ul>
                </details>
            <?php endif; ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
