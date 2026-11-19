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
$steps = [
    ['calendar', '予約・相談', 'Request a date', '希望日や気になることをお知らせください。スタッフが参加条件や持ち物をご案内します。', 'Tell us your preferred date and ask us anything. We’ll explain the requirements and what to bring.'],
    ['mask', '陸上で練習', 'Practice on land', 'まずは器材の使い方と呼吸の仕方を練習。準備ができたら水面へ。', 'Get familiar with your gear and practice breathing before you get in the water.'],
    ['fish', 'インストラクターと海へ', 'Dive with your instructor', '少人数で、インストラクターと一緒に潜ります。自分のペースで海の中を楽しみましょう。', 'Explore in a small group with an instructor. Take it at your own pace and enjoy what you see.'],
];
$trial_booking = function_exists('d365_show_booking')
    ? d365_home(d365_is_english(), ['dive_service' => 'trial']) . '#booking'
    : 'tel:+81452735496';
$news = get_posts(['post_type' => 'news', 'numberposts' => 4]);
$shop_map_query = '神奈川県横浜市中区福富町西通44-2 Speranza Sakuragicho 1F';
$shop_map_embed = add_query_arg(['q' => rawurlencode($shop_map_query), 'output' => 'embed'], 'https://maps.google.com/maps');
$shop_map_link = add_query_arg(['api' => '1', 'query' => rawurlencode($shop_map_query)], 'https://www.google.com/maps/search/');
?>
<main id="main">
    <section class="hero">
        <div class="wrap hero-layout">
            <div class="hero-content">
                <p class="hero-location"><span aria-hidden="true"></span><?php d365_label('横浜・桜木町のダイビングショップ', 'Your dive shop in Yokohama'); ?></p>
                <?php if (d365_is_english()): ?>
                    <h1>Day off?<br><em>Let’s go diving.</em></h1>
                <?php else: ?>
                    <h1>次の休み、<br><em>海に潜ろう。</em></h1>
                <?php endif; ?>
                <p class="hero-copy"><?php d365_label('仕事や授業から少し離れて、海の中でひと息。横浜・桜木町のショップが、逗子・葉山や伊豆の海へ少人数でご案内します。初めての方も、おひとりでの参加も歓迎です。', 'Take a break from work or classes and spend a little time underwater. Our dive shop in Sakuragicho, Yokohama, takes small groups to dive sites in Zushi, Hayama and Izu. First-time and solo divers are welcome.'); ?></p>
                <div class="hero-actions">
                    <a class="button" href="<?= esc_url($trial_booking) ?>"><?php d365_label('体験ダイビングを相談する', 'Ask about a first dive'); ?> <span aria-hidden="true">↗</span></a>
                    <a class="button outline" href="#first-dive"><?php d365_label('初めての方へ', 'Your first dive'); ?> <span aria-hidden="true">↓</span></a>
                </div>
                <?php if (function_exists('d365_show_booking')): ?>
                    <ul class="hero-services">
                        <li><a href="<?= esc_url(d365_experience_url('trial', d365_is_english())) ?>"><?php d365_label('体験ダイビング', 'Discover scuba'); ?></a></li>
                        <li><a href="<?= esc_url(d365_courses_url(d365_is_english())) ?>"><?php d365_label('PADI講習', 'PADI courses'); ?></a></li>
                        <li><a href="<?= esc_url(d365_experience_url('tour', d365_is_english())) ?>"><?php d365_label('ツアー', 'Dive trips'); ?></a></li>
                    </ul>
                <?php endif; ?>
            </div>
            <div class="hero-art">
                <div class="hero-media">
                    <img class="hero-image" src="<?= esc_url(d365_asset('hero.jpg')) ?>" alt="<?= esc_attr(d365_text('海に浮かんで手を振るダイビングの参加者', 'Divers wave from the water')); ?>" width="1900" height="1425" fetchpriority="high">
                    <video class="hero-video" muted playsinline preload="none" aria-hidden="true" data-src="<?= esc_url(d365_asset('coast.mp4')) ?>"></video>
                </div>
                <figure class="hero-michael">
                    <img src="<?= esc_url(d365_asset('michael-diver.webp')) ?>" alt="<?= esc_attr(d365_text('ダイビング姿で手を振るマイケル君', 'Michael waves in his scuba gear')); ?>" width="720" height="807" decoding="async">
                    <figcaption>
                        <?php if (function_exists('d365_show_booking')): ?>
                            <a href="<?= esc_url(d365_michael_url(d365_is_english())) ?>"><?php d365_label('マイケル君の紹介', 'Meet Michael'); ?> <span aria-hidden="true">↗</span></a>
                        <?php else: ?>
                            <?php d365_label('マイケル君', 'Michael'); ?>
                        <?php endif; ?>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>
    <section class="section first-steps" id="first-dive">
        <div class="wrap">
            <div class="section-heading steps-heading">
                <h2><?php d365_label('海までの3ステップ', 'Three steps to your first dive'); ?></h2>
                <?php if (function_exists('d365_show_booking')): ?>
                    <a class="text-link" href="<?= esc_url(d365_experience_url('trial', d365_is_english())) ?>"><?php d365_label('料金・参加条件を見る', 'See prices and requirements'); ?> <span aria-hidden="true">↗</span></a>
                <?php endif; ?>
            </div>
            <ol class="first-steps-grid">
                <?php foreach ($steps as [$icon, $ja, $en, $ja_body, $en_body]): ?>
                    <li>
                        <img src="<?= esc_url(d365_asset('first-dive-' . $icon . '.webp')) ?>" alt="" width="112" height="112" loading="lazy">
                        <div><h3><?= esc_html(d365_text($ja, $en)) ?></h3><p><?= esc_html(d365_text($ja_body, $en_body)) ?></p></div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
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
            <?php if (function_exists('d365_show_booking')): ?>
                <a class="text-link" href="<?= esc_url(d365_experience_url('overseas', d365_is_english())) ?>"><?php d365_label('海外ダイビングツアー', 'Overseas dive trips'); ?> <span aria-hidden="true">↗</span></a>
            <?php endif; ?>
        </div>
    </section>
    <?php if (function_exists('d365_show_booking')) { d365_show_booking(); } ?>
    <section class="section first-dive" id="faq">
        <div class="wrap section-heading">
            <h2><?php d365_label('初めての方からよくある質問', 'First-dive questions'); ?></h2>
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
                    <?php foreach ($news as $item): ?>
                        <li><time datetime="<?= esc_attr(get_the_date('Y-m-d', $item)) ?>"><?= esc_html(get_the_date('Y.m.d', $item)) ?></time> <a href="<?= esc_url(get_permalink($item)) ?>"><?= esc_html(get_the_title($item)) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
    <section class="section access" id="access">
        <div class="wrap section-heading">
            <div>
                <h2><?php d365_label('ショップ・アクセス', 'Find us in Yokohama'); ?></h2>
                <address>Diving Shop C365<br><?php d365_label($shop_map_query, 'Speranza Sakuragicho 1F, 44-2 Fukutomicho Nishidori, Naka-ku, Yokohama, Kanagawa'); ?></address>
                <p><a href="tel:+81452735496">045-273-5496</a></p>
                <p><?php d365_label('10:00–17:00（日曜・月曜・祝日 定休）', '10:00–17:00. Closed Sundays, Mondays and public holidays.'); ?></p>
                <?php get_template_part('template-parts/instagram', null, ['show_handle' => true]); ?>
                <div class="access-map">
                    <iframe src="<?= esc_url($shop_map_embed) ?>" title="<?= esc_attr(d365_text('Diving Shop C365の地図', 'Map of Diving Shop C365')) ?>" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
                    <a class="text-link" href="<?= esc_url($shop_map_link) ?>"><?php d365_label('Google マップで開く', 'Open in Google Maps'); ?> <span aria-hidden="true">↗</span></a>
                </div>
            </div>
            <img src="<?= esc_url(d365_asset('shop-new.jpg')) ?>" alt="<?= esc_attr(d365_text('Diving Shop C365 店舗外観', 'Diving Shop C365 storefront')) ?>" width="640" height="420" loading="lazy">
        </div>
    </section>
</main>
<?php get_footer(); ?>
