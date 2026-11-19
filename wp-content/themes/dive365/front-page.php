<?php
get_header();
$services = [
    ['体験ダイビング', 'Discover Scuba Diving', '器材の使い方から水中での呼吸まで。インストラクターと一緒に、初めての海へ。', 'Make your first dive with an instructor beside you, from using your gear to breathing underwater.', '¥18,000 / 1名', '¥18,000 per person', 47, 'trial.jpg'],
    ['ライセンス講習', 'Scuba Certification', 'PADI基準のカリキュラムで、海を安全に楽しむスキルを身につけます。', 'Build your skills and confidence underwater with a PADI certification course.', '¥50,000〜 / コース', 'From ¥50,000 per course', 44, 'course.jpg'],
    ['ファンダイブツアー', 'Fun Dive Trips', 'ダイナミックな地形から小さな生き物まで。季節に合わせたおすすめの海へ。', 'Explore seasonal dive sites with a guide, from dramatic underwater terrain to tiny marine life.', '¥29,000〜', 'From ¥29,000', 14, 'tour.jpg'],
];
$staff = [
    ['平丸 聖弥', 'Seiya Hiramaru', 'メインインストラクター', 'Lead Instructor', 'PADIインストラクター、潜水士、2級小型船舶、特殊・特定小型船舶、赤十字救急法救急員。沖縄で約2年半、グラスボートやシュノーケリングなどのマリン業務に従事。', 'PADI instructor, licensed commercial diver and Red Cross first aider, with around two and a half years of marine guiding experience in Okinawa.', 'instructor2.jpg'],
    ['益田 真緒', 'Mao Masuda', '非常勤インストラクター', 'Part-time Instructor', 'NAUIインストラクター、潜水士、小型船舶1級、特殊小型船舶。沖縄・慶良間・残波やパラオでガイドを経験。ドリフトからマクロまで対応します。', 'NAUI instructor and licensed commercial diver, with guiding experience in Okinawa, the Kerama Islands, Zanpa and Palau, from drift dives to macro life.', 'instructor1.jpg'],
    ['水越 真彩', 'Maaya Mizukoshi', '非常勤インストラクター', 'Part-time Instructor', 'PADIインストラクター、2級小型船舶。宮崎でガイド・ツアー・ライセンス講習を担当。', 'PADI instructor and licensed boat operator, with experience guiding dives and teaching certification courses in Miyazaki.', 'instructor3.jpg'],
];
$news = get_posts(['post_type' => 'news', 'numberposts' => 4]);
?>
<main id="main">
    <section class="hero">
        <img class="hero-image" src="<?= esc_url(d365_asset('hero.jpg')) ?>" alt="" fetchpriority="high">
        <video class="hero-video" muted loop playsinline preload="none" aria-hidden="true" data-src="<?= esc_url(d365_asset('coast.mp4')) ?>"></video>
        <div class="wrap hero-content">
            <p class="hero-location"><span></span><?php d365_label('横浜のダイビングショップ', 'Yokohama Diving Shop'); ?></p>
            <?php if (d365_is_english()): ?>
                <h1>Let’s dive<br> <em>together.</em></h1>
            <?php else: ?>
                <h1>一緒に、<br><em>海へ。</em></h1>
            <?php endif; ?>
            <p class="hero-copy"><?php d365_label('ひとりでの参加も、初めてのダイビングも。横浜から、少人数で海を楽しみませんか。', 'Joining solo or trying scuba for the first time? Come explore the ocean with a small group and a friendly dive team from Yokohama.'); ?></p>
            <div class="hero-actions">
                <a class="button" href="<?= function_exists('d365_show_booking') ? '#booking' : 'tel:+81452735496' ?>"><?php d365_label('ダイビングを予約', 'Book a dive'); ?> <span aria-hidden="true">↗</span></a>
                <a class="button outline" href="<?= function_exists('d365_show_booking') ? '#calendar' : '#services' ?>"><?php d365_label('開催日程を見る', 'View calendar'); ?> <span aria-hidden="true">↓</span></a>
            </div>
        </div>
        <button type="button" hidden class="motion-toggle" data-play="<?= esc_attr(d365_text('動画を再生', 'Play video')) ?>" data-pause="<?= esc_attr(d365_text('動画を停止', 'Pause video')) ?>" aria-label="<?= esc_attr(d365_text('動画を停止', 'Pause video')) ?>">Ⅱ</button>
        <a class="hero-scroll" href="#services" aria-label="<?= esc_attr(d365_text('サービスへ移動', 'Explore diving services')) ?>">↓</a>
    </section>
    <section class="section services" id="services">
        <div class="wrap">
            <div class="section-heading">
                <h2><?php d365_label('海への入り口。', 'Find your next dive.'); ?></h2>
                <p><?php d365_label('はじめての体験から、資格を取って海を巡るツアーまで。経験と目的に合わせてお選びください。', 'Take your first dive, earn your certification, or explore new sites with a guide.'); ?></p>
            </div>
            <div class="cards">
                <?php foreach ($services as [$ja, $en, $ja_body, $en_body, $ja_price, $en_price, $page_id, $image]): ?>
                    <article class="dive-card">
                        <img src="<?= esc_url(d365_asset($image)) ?>" alt="" width="640" height="420" loading="lazy">
                        <div>
                            <h3><?= esc_html(d365_text($ja, $en)) ?></h3>
                            <p><?= esc_html(d365_text($ja_body, $en_body)) ?></p>
                            <p class="price"><?= esc_html(d365_text($ja_price, $en_price)) ?></p>
                            <?php if ($page_id === 44 && function_exists('d365_show_booking')): ?>
                                <a class="text-link" href="<?= esc_url(d365_courses_url(d365_is_english())) ?>"><?php d365_label('講習・スキルアップを見る', 'Explore PADI courses'); ?> <span aria-hidden="true">↗</span></a>
                            <?php elseif ($page_id !== 44 && function_exists('d365_show_booking')): ?>
                                <a class="text-link" href="<?= esc_url(d365_experience_url($page_id === 47 ? 'trial' : 'tour', d365_is_english())) ?>" aria-label="<?= esc_attr(d365_text($ja . 'の詳細', 'More about ' . $en)) ?>"><?php d365_label('詳細を見る', 'Learn more'); ?> <span aria-hidden="true">↗</span></a>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php if (function_exists('d365_show_booking')) { d365_show_booking(); } ?>
    <section class="section first-dive" id="first-dive">
        <div class="wrap section-heading">
            <h2><?php d365_label('初めての方へ', 'Your first dive'); ?></h2>
            <div>
                <details><summary><?php d365_label('初めてでも参加できますか？', 'Can I join if I’ve never dived before?'); ?></summary><p><?php d365_label('体験ダイビングは初めての方向けです。陸上で練習してから、インストラクターと一緒に入水します。', 'Discover Scuba Diving is designed for beginners. You’ll practice on land before entering the water with an instructor.'); ?></p></details>
                <details><summary><?php d365_label('持ち物や参加条件はどこで確認できますか？', 'How do I find out what to bring and who can join?'); ?></summary><p><?php d365_label('スタッフが参加条件、当日の流れ、持ち物、体調チェックについて事前にご案内します。気になる点はお申し込み時にご相談ください。', 'Before the dive, our team will explain the requirements, what to bring, what to expect and the health check. Include any questions with your request.'); ?></p></details>
                <details><summary><?php d365_label('予約はいつ確定しますか？', 'When is my reservation confirmed?'); ?></summary><p><?php d365_label('予約リクエストの受付後、スタッフからのご連絡をもって確定します。', 'Your reservation is confirmed when our team contacts you to confirm your place.'); ?></p></details>
            </div>
        </div>
    </section>
    <section class="section staff">
        <div class="wrap">
            <h2><?php d365_label('インストラクター', 'Meet your instructors'); ?></h2>
            <div class="cards">
                <?php foreach ($staff as [$ja, $en, $ja_role, $en_role, $ja_body, $en_body, $image]): ?>
                    <article class="staff-card">
                        <img src="<?= esc_url(d365_asset($image)) ?>" alt="<?= esc_attr(d365_text($ja, $en)) ?>" width="640" height="420" loading="lazy">
                        <h3><?= esc_html(d365_text($ja, $en)) ?></h3>
                        <p class="staff-role"><?= esc_html(d365_text($ja_role, $en_role)) ?></p>
                        <p><?= esc_html(d365_text($ja_body, $en_body)) ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php if ($news): ?>
        <section class="section news" id="news">
            <div class="wrap">
                <h2><?php d365_label('お知らせ', 'Shop news'); ?></h2>
                <ul lang="ja">
                    <?php foreach ($news as $post): ?>
                        <li><time datetime="<?= esc_attr(get_the_date('Y-m-d', $post)) ?>"><?= esc_html(get_the_date('Y.m.d', $post)) ?></time> <a href="<?= esc_url(get_permalink($post)) ?>"><?= esc_html(get_the_title($post)) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
    <section class="section access" id="access">
        <div class="wrap section-heading">
            <div>
                <h2><?php d365_label('ショップ・アクセス', 'Find us in Yokohama'); ?></h2>
                <address>Diving Shop C365<br><?php d365_label('神奈川県横浜市中区福富町西通44-2 Speranza Sakuragicho 1F', 'Speranza Sakuragicho 1F, 44-2 Fukutomicho Nishidori, Naka-ku, Yokohama, Kanagawa'); ?></address>
                <p><a href="tel:+81452735496">045-273-5496</a></p>
                <p><?php d365_label('10:00–17:00（日曜・月曜・祝日 定休）', '10:00–17:00. Closed Sundays, Mondays and public holidays.'); ?></p>
            </div>
            <img src="<?= esc_url(d365_asset('shop-new.jpg')) ?>" alt="<?= esc_attr(d365_text('Diving Shop C365 店舗外観', 'Diving Shop C365 storefront')) ?>" width="640" height="420" loading="lazy">
        </div>
    </section>
</main>
<?php get_footer(); ?>
