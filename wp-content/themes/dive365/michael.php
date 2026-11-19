<?php
get_header();
$english = d365_is_english();
$home = d365_home($english);
$story = [
    ['calendar', '「やってみたい」が出発点', 'It started with “I want to try”',
        '新しいことを見つけると、じっとしていられないマイケル君。ある日、水面がきらきら光るのを眺めて、「この青い水の下には何があるんだろう？」。次の日には、ダイビングのことを聞きに出かけました。',
        'When Michael discovers something new, he can hardly sit still. One day, watching the sunlight sparkle on the ocean, he wondered what was beneath all that blue. The very next day he went to ask about diving.'],
    ['mask', 'ドキドキしながら、ひと呼吸', 'A little nervous, one breath at a time',
        '初めての器材に、ちょっぴり緊張。インストラクターと陸の上で使い方を練習してから、ゆっくり海へ。水の中で初めて呼吸ができたときは、まだ海の入口なのに、もう大冒険をしたみたいでした。',
        'The unfamiliar gear made him a little nervous. He practiced on land with an instructor, then took his time getting into the water. That first breath underwater felt like an adventure all by itself.'],
    ['fish', '次は、どんな海かな？', 'Where to next?',
        '吐いた息が泡になって水面へ。目の前を小さな魚がすっと横切って、見上げると光がゆらゆら。海から上がるころには、「次はどんな魚に会えるかな？」と、もう次のチャレンジを考えていました。',
        'His bubbles rose to the surface, a little fish darted by, and sunlight rippled above him. By the time he got out, he was already wondering what he might see on his next dive.'],
];
?>
<main id="main" class="michael-page">
    <section class="tour-banner michael-banner">
        <div class="wrap tour-banner-inner">
            <div>
                <p class="tour-kicker"><?php d365_label('Diving Shop C365のキャラクター', 'The Diving Shop C365 mascot'); ?></p>
                <h1><?php d365_label('マイケル君', 'Meet Michael'); ?></h1>
                <p class="michael-subtitle"><?php d365_label('ふわふわにあこがれて。', 'Dreaming of being fluffy.'); ?><br><?php d365_label('今日も、新しいことに挑戦。', 'Always ready to try something new.'); ?></p>
                <p class="tour-intro"><?php d365_label('カシミヤヤギのやわらかい毛並みにあこがれるヤギ。新しいことにチャレンジするのが大好きで、今度はスキューバダイビングを始めました。', 'Michael is a goat who wishes he were as fluffy as a cashmere goat. He loves a new challenge, and his latest adventure is learning to scuba dive.'); ?></p>
                <div class="tour-actions">
                    <a class="button" href="#michael-story"><?php d365_label('初めての海のお話', 'Read about his first dive'); ?> <span aria-hidden="true">↓</span></a>
                </div>
            </div>
            <figure class="michael-portrait">
                <img src="<?= esc_url(d365_asset('michael-diver.webp')) ?>" alt="<?= esc_attr(d365_text('ダイビング姿で手を振るマイケル君', 'Michael waves in his scuba gear')) ?>" width="720" height="807" fetchpriority="high">
            </figure>
        </div>
    </section>
    <section id="michael-story" class="section michael-story">
        <div class="wrap">
            <h2><?php d365_label('マイケル君、初めての海へ', 'Michael’s first dive'); ?></h2>
            <ol class="michael-story-grid">
                <?php foreach ($story as [$illustration, $ja, $en, $ja_body, $en_body]): ?>
                    <li>
                        <img src="<?= esc_url(d365_asset('first-dive-' . $illustration . '.webp')) ?>" alt="" width="112" height="112" loading="lazy">
                        <h3><?= esc_html(d365_text($ja, $en)) ?></h3>
                        <p><?= esc_html(d365_text($ja_body, $en_body)) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>
    <section class="michael-end">
        <div class="wrap">
            <div>
                <h2><?php d365_label('あなたも、初めての海へ', 'Ready for your first dive?'); ?></h2>
                <p><?php d365_label('マイケル君のように「やってみたい」と思ったら、体験ダイビングの流れをのぞいてみてください。', 'If Michael’s story makes you want to try, see how your first dive works.'); ?></p>
            </div>
            <a class="button" href="<?= esc_url($home . '#first-dive') ?>"><?php d365_label('初めての方へ', 'Your first dive'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
