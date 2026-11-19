<?php
get_header();
$book = function_exists('d365_show_booking') ? d365_home(d365_is_english(), ['dive_service' => 'trial']) . '#booking' : 'tel:+81452735496';
?>
<main id="main" class="course-page">
    <div class="course-hero trial-hero">
        <div class="wrap">
            <h1><?php d365_label('体験ダイビング', 'Discover Scuba Diving'); ?></h1>
            <p><?php d365_label('ライセンスがなくても、インストラクターと一緒に海へ。水面で呼吸と耳抜きを確認してから潜ります。', 'Try scuba without a certification. Your instructor will help you practice breathing and equalizing at the surface before you go underwater.'); ?></p>
            <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('日程を相談する', 'Request a date'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </div>
    <section class="section">
        <div class="wrap">
            <h2><?php d365_label('料金・参加条件', 'Price and eligibility'); ?></h2>
            <article class="course-card">
                <h3>¥18,000</h3>
                <ul>
                    <li><?php d365_label('施設使用料、器材、レクチャー、保険料込み', 'Includes facility fees, equipment, instruction and insurance'); ?></li>
                    <li><?php d365_label('10〜60歳。健康チェックがあり、55歳以上は医師の診断書が必要です。', 'Ages 10–60. A health check is required, and guests aged 55 or older need a medical certificate.'); ?></li>
                    <li><?php d365_label('持ち物は水着、タオル、サンダルです。', 'Bring swimwear, a towel and sandals.'); ?></li>
                </ul>
            </article>
        </div>
    </section>
</main>
<?php get_footer(); ?>
