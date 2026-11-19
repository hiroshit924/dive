<?php
get_header();
$english = d365_is_english();
$book = function_exists('d365_show_booking') ? d365_home($english, ['dive_service' => 'trial']) . '#booking' : 'tel:+81452735496';
$timeline = [
    [
        'photo' => ['tour-hayama.webp', 768, 432, '青い海が広がる葉山の海岸', 'Blue water along the Hayama coast'],
        'title' => ['集合して、海を見る', 'Meet your instructor'],
        'body' => ['まずはインストラクターと顔合わせ。健康チェックと当日の説明を済ませたら、海を見ながら今日の流れを確認します。緊張していることや気になることは、最初に話しておいて大丈夫です。', 'Meet your instructor, fill out a health questionnaire and go over the plan for the day. If you feel nervous or have questions, this is a good time to talk them through.'],
        'michael' => ['ぼくは海が見えたら、ドキドキがちょっと楽しみに変わったよ。', 'Seeing the sea turned some of my nerves into excitement.'],
    ],
    [
        'photo' => ['michael-diary/boat-gear.webp', 1280, 966, 'タンクやフィンを眺めるマイケル君', 'Michael takes a look at the tanks and fins'],
        'title' => ['器材を合わせて、使い方を知る', 'Get fitted and meet your gear'],
        'body' => ['スーツやマスクを合わせ、呼吸に使う器材や水中での合図を確認します。重そうに見える器材も、インストラクターと一緒にひとつずつ慣れていきましょう。', 'Try on your suit and mask, then get familiar with your breathing equipment and hand signals. Your instructor will walk you through each piece of gear.'],
        'michael' => ['このフィンで泳ぐの？ ぼくの足が急に長くなったみたい！', 'So these are my fins? My feet suddenly look a lot longer!'],
    ],
    [
        'photo' => ['michael-diary/water-surface.webp', 1280, 966, 'ダイバーたちと一緒に水面に浮かぶマイケル君', 'Michael floats at the surface with other divers'],
        'title' => ['浅いところで、水に慣れる', 'Start in shallow water'],
        'body' => ['水面や浅い場所で、器材を使った呼吸や耳抜きをインストラクターと確認します。慣れるまで時間をかけて、落ち着いてから次へ進みます。', 'Practice breathing through your gear and equalizing with your instructor at the surface or in shallow water. Take your time and move on when you feel comfortable.'],
        'michael' => ['最初はちょっと不思議。ひと息つけたら、もうひと息。', 'The first breath feels a little strange. Then comes the next one.'],
    ],
    [
        'photo' => ['tour.jpg', 768, 1024, '青緑の海の中を泳ぐ魚の群れ', 'A school of fish in blue-green water'],
        'title' => ['インストラクターと水中散歩', 'Explore underwater together'],
        'body' => ['インストラクターのそばで、魚の動きや光のゆらぎを眺めます。その日に出会える景色は、季節や海況によってさまざま。目の前の海をゆっくり味わいましょう。', 'Stay close to your instructor as you watch fish and sunlight moving through the water. What you see will vary with the season and sea conditions.'],
        'michael' => ['魚が目の前をすーっと通った。水族館のガラスの向こうに来たみたい！', 'A fish glided right past me. It felt like being on the other side of the aquarium glass!'],
    ],
    [
        'photo' => ['michael-diary/boat-break.webp', 966, 1280, '海を眺めながらひと休みするマイケル君', 'Michael takes a break by the sea'],
        'title' => ['着替えて、今日の海を振り返る', 'Change and share your favorite moments'],
        'body' => ['海から上がったら着替えて、インストラクターと今日のダイビングを振り返ります。見かけた魚の名前や、気になったことも聞いてみてください。', 'Back on land, change out of your gear and talk through the dive with your instructor. Ask about the fish you spotted or anything else you’re curious about.'],
        'michael' => ['今日の海、帰り道でも思い出しちゃいそう。', 'I have a feeling I’ll still be thinking about that dive on the way home.'],
    ],
];
$questions = [
    [['ライセンスがなくても参加できますか？', 'Do I need a scuba certification?'], ['体験ダイビングは、初めての方もご参加いただけます。器材の使い方から、インストラクターと一緒に確認します。', 'You can join us for your first dive. Your instructor will walk you through the gear and guide you in the water.']],
    [['泳ぎに自信がなくても相談できますか？', 'Can I get in touch if I’m a nervous swimmer?'], ['はい。水や泳ぎへの不安があれば、お申し込みの際にお知らせください。当日の流れや参加についてご相談いただけます。', 'Yes. Tell us when you inquire if you are nervous about the water. We can talk through what to expect and whether the experience is right for you.']],
    [['ひとりでも申し込めますか？', 'Can I book on my own?'], ['おひとりからご相談いただけます。お友達と参加したい方は、フォームに人数をご入力ください。', 'Solo guests are welcome to inquire. If you’re coming with friends, enter the group size on the form.']],
    [['集合場所と所要時間はいつ分かりますか？', 'When will I know where to meet and how long it takes?'], ['開催場所や当日の流れに合わせて、予約のご案内時にお伝えします。帰りの時間に希望がある方は、事前にご相談ください。', 'We’ll share the meeting point and approximate duration when we coordinate your booking. Let us know in advance if you need to be back by a certain time.']],
    [['体調や服薬について確認したいときは？', 'Who should I contact with health or medication questions?'], ['参加前に健康チェックがあります。体調や服薬について確認したいことがあれば、予約フォームに健康情報を記入せず、ショップへお電話ください。55〜60歳の方には医師の診断書が必要です。', 'A health check is required. Please call the shop about health or medication questions and leave medical details out of the booking form. Guests aged 55–60 need a medical certificate.']],
];
?>
<main id="main" class="trial-page">
    <header class="trial-hero">
        <div class="wrap trial-hero-layout">
            <div class="trial-hero-copy">
                <h1><?php d365_label('体験ダイビング', 'Discover Scuba Diving'); ?></h1>
                <p class="trial-tagline"><?php d365_label('はじめての海、マイケル君と予習しよう。', 'Curious about your first dive?'); ?></p>
                <p><?php d365_label('横浜のDiving Shop C365から、次のお休みに海へ。器材を合わせるところから水中での呼吸まで、インストラクターがそばでサポートします。', 'Make your next day off a dive day with Diving Shop C365 in Yokohama. Your instructor will be beside you from your first gear fitting to your first breaths underwater.'); ?></p>
                <div class="trial-actions">
                    <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('体験日程を相談する', 'Ask about a dive date'); ?> <span aria-hidden="true">↗</span></a>
                    <a class="button outline" href="#trial-day"><?php d365_label('当日の流れを見る', 'See how the day goes'); ?> <span aria-hidden="true">↓</span></a>
                </div>
            </div>
            <figure class="trial-hero-art">
                <img class="trial-hero-photo" src="<?= esc_url(d365_asset('trial.jpg')) ?>" width="768" height="576" alt="<?= esc_attr(d365_text('青い海の中で手を振るダイバー', 'A scuba diver waves underwater')) ?>" fetchpriority="high">
                <img class="trial-hero-michael" src="<?= esc_url(d365_asset('michael-diver.webp')) ?>" width="720" height="807" alt="">
                <figcaption><?php d365_label('ぼくが案内するよ！', 'Come dive with me!'); ?></figcaption>
            </figure>
        </div>
        <div class="wrap">
            <ul class="trial-facts">
                <li><img src="<?= esc_url(d365_asset('first-dive-mask.webp')) ?>" width="48" height="48" alt=""><div><strong><?php d365_label('ライセンス不要', 'No certification needed'); ?></strong><span><?php d365_label('初めての方も、おひとりでも', 'First-timers and solo guests welcome'); ?></span></div></li>
                <li><img src="<?= esc_url(d365_asset('first-dive-fish.webp')) ?>" width="48" height="48" alt=""><div><strong><?php d365_label('インストラクター同行', 'Dive with an instructor'); ?></strong><span><?php d365_label('器材の使い方からゆっくり', 'Start by getting to know your gear'); ?></span></div></li>
                <li><img src="<?= esc_url(d365_asset('first-dive-calendar.webp')) ?>" width="48" height="48" alt=""><div><a href="#trial-price"><strong><?php d365_label('¥18,000／1名', '¥18,000 per person'); ?></strong></a><span><?php d365_label('器材レンタル込み', 'Equipment rental included'); ?></span></div></li>
            </ul>
        </div>
    </header>
    <section class="section trial-day" id="trial-day">
        <div class="wrap">
            <div class="trial-section-intro">
                <h2><?php d365_label('マイケル君と見る、体験ダイビングの一日', 'A first dive day with Michael'); ?></h2>
                <p><?php d365_label('集合から着替えまで、海の一日を写真でご紹介。写真はイメージです。当日の順番や集合場所、所要時間は開催場所・海況に合わせてご案内します。', 'Follow the day from meeting your instructor to getting changed afterward. The photos give you a feel for the experience. The order, meeting point and duration depend on the location and sea conditions.'); ?></p>
            </div>
            <ol class="trial-timeline">
                <?php foreach ($timeline as $index => $step):
                    [$photo, $width, $height, $alt_ja, $alt_en] = $step['photo']; ?>
                    <li class="trial-step">
                        <img class="trial-step-photo" src="<?= esc_url(d365_asset($photo)) ?>" width="<?= esc_attr((string) $width) ?>" height="<?= esc_attr((string) $height) ?>" alt="<?= esc_attr(d365_text($alt_ja, $alt_en)) ?>" loading="lazy" decoding="async">
                        <div class="trial-step-copy">
                            <span class="trial-step-number" aria-hidden="true"><?= esc_html(sprintf('%02d', $index + 1)) ?></span>
                            <h3><?= esc_html(d365_text(...$step['title'])) ?></h3>
                            <p><?= esc_html(d365_text(...$step['body'])) ?></p>
                            <p class="trial-quote"><strong><?php d365_label('マイケル君', 'Michael'); ?></strong> <?= esc_html(d365_text(...$step['michael'])) ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <section class="section trial-practical" id="trial-price">
        <div class="wrap">
            <h2><?php d365_label('料金・参加条件・持ち物', 'Price, eligibility and what to bring'); ?></h2>
            <div class="trial-practical-grid">
                <article class="trial-info trial-info-price">
                    <h3><?php d365_label('体験ダイビング料金', 'Introductory dive'); ?></h3>
                    <p><strong>¥18,000</strong> <?php d365_label('／1名', 'per person'); ?></p>
                    <p><?php d365_label('施設使用料、器材レンタル、レクチャー、保険料を含みます。', 'Includes facility fees, gear rental, instruction and insurance.'); ?></p>
                    <a class="text-link" href="<?= esc_url(d365_experience_url('tour', $english) . '#rental-gear') ?>"><?php d365_label('器材のイラストを見る', 'See the equipment guide'); ?> <span aria-hidden="true">↗</span></a>
                </article>
                <article class="trial-info">
                    <h3><?php d365_label('参加できる方', 'Who can join'); ?></h3>
                    <ul>
                        <li><?php d365_label('10〜60歳の方', 'Ages 10–60'); ?></li>
                        <li><?php d365_label('参加前に健康チェックがあります。', 'A health check is required before your dive.'); ?></li>
                        <li><?php d365_label('55〜60歳の方は医師の診断書が必要です。', 'Guests aged 55–60 need a medical certificate.'); ?></li>
                    </ul>
                </article>
                <article class="trial-info">
                    <h3><?php d365_label('持ち物', 'What to pack'); ?></h3>
                    <ul>
                        <li><?php d365_label('水着', 'Swimwear'); ?></li>
                        <li><?php d365_label('タオル', 'Towel'); ?></li>
                        <li><?php d365_label('サンダル', 'Sandals'); ?></li>
                    </ul>
                </article>
            </div>
        </div>
    </section>
    <section class="section trial-faq" id="trial-faq">
        <div class="wrap trial-faq-grid">
            <h2><?php d365_label('初めての方からよくある質問', 'First-dive questions'); ?></h2>
            <div>
                <?php foreach ($questions as [$question, $answer]): ?>
                    <details>
                        <summary><?= esc_html(d365_text(...$question)) ?></summary>
                        <p><?= esc_html(d365_text(...$answer)) ?></p>
                    </details>
                <?php endforeach; ?>
                <a class="text-link" href="#cancellation-policy"><?php d365_label('変更・キャンセルのご案内', 'Changes and cancellations'); ?> <span aria-hidden="true">↓</span></a>
            </div>
        </div>
    </section>
    <?php get_template_part('template-parts/cancellation-policy'); ?>
    <section class="trial-final">
        <div class="wrap">
            <img src="<?= esc_url(d365_asset('michael-diver.webp')) ?>" width="720" height="807" loading="lazy" alt="">
            <div>
                <h2><?php d365_label('次のお休み、海に行ってみる？', 'Ready to see what’s under the surface?'); ?></h2>
                <p><?php d365_label('行けそうな日や気になることをお聞かせください。スタッフが日程や当日の流れをご案内します。', 'Tell us when you’re free and what you’d like to know. We’ll help you find a date and explain what to expect.'); ?></p>
                <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('体験日程を相談する', 'Ask about a dive date'); ?> <span aria-hidden="true">↗</span></a>
                <?php if (function_exists('d365_show_booking')): ?>
                    <a class="text-link" href="<?= esc_url(d365_michael_url($english)) ?>"><?php d365_label('マイケル君の海日記を見る', 'Read Michael’s dive diary'); ?> <span aria-hidden="true">→</span></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
