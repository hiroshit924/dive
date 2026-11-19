<?php
get_header();
$english = d365_is_english();
$book = function_exists('d365_show_booking') ? d365_home($english, ['dive_service' => 'course']) . '#booking' : 'tel:+81452735496';
$available = [
    [
        'open-water', 'オープン・ウォーター・ダイバー', 'Open Water Diver', '¥79,000',
        '初めてCカードを取得する方向け。学科、限定水域でのスキル練習、4回の海洋実習を順に進めます。成人の認定後の最大水深は18mです。',
        'Earn your first scuba certification through knowledge development, confined-water practice and four open-water dives. The maximum depth for certified adult Open Water Divers is 18 m.',
        ['店舗参加条件は15歳以上', '目安は3〜4日', '講習料・施設・教材・器材レンタル・タンク・申請料込み'],
        ['Diving Shop C365 accepts participants aged 15 and above', 'Allow 3–4 days', 'Includes instruction, facility fees, materials, rental equipment, tanks and certification application fees'],
        'https://www.padi.com/courses/open-water-diver',
    ],
    [
        'advanced', 'アドヴァンスド・オープン・ウォーター・ダイバー', 'Advanced Open Water Diver', '¥50,000',
        '水中ナビゲーションとディープの必須2ダイブに、海況や興味に合わせた選択3ダイブを加え、計5回の海洋実習を行います。',
        'Complete five adventure dives, including deep diving and underwater navigation, plus three electives chosen for the conditions and your interests.',
        ['PADIオープン・ウォーター・ダイバーまたは同等資格、15歳以上', '目安は2日', '講習料・施設・教材・タンク・申請料込み'],
        ['PADI Open Water Diver or qualifying equivalent, age 15+', 'Allow 2 days', 'Includes instruction, facility fees, materials, tanks and certification application fees'],
        'https://www.padi.com/courses/advanced-open-water',
    ],
];
$options = [
    ['ピーク・パフォーマンス・ボイヤンシー', 'Peak Performance Buoyancy', '中性浮力、姿勢、ウエイト調整を練習するPADIスペシャルティです。', 'A specialty focused on neutral buoyancy, trim and correct weighting.', 'https://www.padi.com/courses/peak-performance-buoyancy'],
    ['エマージェンシー・ファースト・レスポンス（EFR）', 'Emergency First Response (EFR)', '一次ケア（CPR）と二次ケア（ファーストエイド）を学びます。', 'Learn primary care (CPR) and secondary care (first aid).', 'https://www.padi.com/courses/emergency-first-response-primary-and-secondary-care'],
    ['レスキュー・ダイバー', 'Rescue Diver', 'トラブルの予防と対応を練習します。受講には所定のダイバー資格・水中ナビゲーション経験が必要で、認定には過去24か月以内のCPR・ファーストエイド講習が必要です。', 'Practice preventing and responding to dive emergencies. The course has certification and underwater navigation prerequisites. CPR and first aid training must be current within 24 months for certification.', 'https://www.padi.com/courses/rescue-diver'],
    ['ダイブマスター', 'Divemaster', 'ダイブリーダーを目指すプロコースです。レスキュー・ダイバーまたは同等資格、年齢・ログ本数・健康書類などの要件があります。', 'PADI professional training for aspiring dive leaders. Entry requirements include Rescue Diver or a qualifying equivalent, minimum age, logged dives and medical clearance.', 'https://www.padi.com/courses/divemaster'],
];
?>
<main id="main" class="course-page">
    <div class="course-hero">
        <div class="wrap">
            <p class="hero-location"><span></span>PADI SCUBA TRAINING</p>
            <h1><?php d365_label('講習・スキルアップ', 'Scuba courses & skills'); ?></h1>
            <p><?php d365_label('最初のCカードから、次の海を楽しむためのスキルまで。今の経験に合う講習を見つけましょう。', 'Find the right training for your experience, from your first certification to the skills you need for the dives you want to do.'); ?></p>
            <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('講習を申し込む・相談する', 'Request training') ?> <span aria-hidden="true">↗</span></a>
        </div>
    </div>
    <section class="section">
        <div class="wrap">
            <h2><?php d365_label('Diving Shop C365の講習', 'Courses at Diving Shop C365'); ?></h2>
            <div class="course-grid">
                <?php foreach ($available as [$id, $ja, $en, $price, $ja_body, $en_body, $ja_facts, $en_facts, $source]): ?>
                    <article class="course-card" id="<?= esc_attr($id) ?>">
                        <h3><?= esc_html(d365_text($ja, $en)) ?></h3>
                        <p class="course-price"><?= esc_html($price) ?> <small><?php d365_label('税込', 'tax included'); ?></small></p>
                        <p><?= esc_html(d365_text($ja_body, $en_body)) ?></p>
                        <ul><?php foreach ($english ? $en_facts : $ja_facts as $fact): ?><li><?= esc_html($fact) ?></li><?php endforeach; ?></ul>
                        <a class="text-link" href="<?= esc_url($source) ?>"><?php d365_label('PADIカリキュラムを見る', 'See the PADI curriculum'); ?> ↗</a>
                    </article>
                <?php endforeach; ?>
            </div>
            <p class="course-note"><?php d365_label('参加前に健康チェックを行います。ショップでは60歳以上の方に医師の診断書をお願いしています。', 'We review your health questionnaire before training. Diving Shop C365 requires a medical certificate for participants aged 60 and above.'); ?></p>
        </div>
    </section>
    <section class="section first-dive">
        <div class="wrap">
            <div class="section-heading">
                <h2><?php d365_label('次のスキルを選ぶ', 'Choose your next skill'); ?></h2>
                <p><?php d365_label('PADIのステップアップコースです。店舗での開催可否や費用は、お申し込み前にお問い合わせください。', 'These are PADI progression options. Ask us about local availability and pricing before making plans.'); ?></p>
            </div>
            <div class="course-grid">
                <?php foreach ($options as [$ja, $en, $ja_body, $en_body, $source]): ?>
                    <article class="course-card">
                        <h3><?= esc_html(d365_text($ja, $en)) ?></h3>
                        <p><?= esc_html(d365_text($ja_body, $en_body)) ?></p>
                        <a class="text-link" href="<?= esc_url($source) ?>"><?php d365_label('PADI公式の詳細を見る', 'See course details from PADI'); ?> ↗</a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
