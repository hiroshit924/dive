<?php
defined('ABSPATH') || exit;

$photos = [
    ['boat-gear', 'ボートの上でタンクやフィンに囲まれたマイケル君', 'Michael on the boat next to tanks and fins', '「フィンが、ぼくの足より大きい！」', '“These fins are bigger than my feet!”', 1280, 966],
    ['water-surface', '仲間と海面に浮かぶマイケル君', 'Michael floats in the water with other divers', 'みんなと一緒に、海の中をのぞいてみたよ。', 'I took a peek beneath the surface with the others.', 1280, 966],
    ['underwater-story', '水中でウミウシを指さすマイケル君', 'Michael points at a nudibranch underwater', 'ウミウシに会えたら、きっとこんな感じ。マイケル君が思い描く水中のひとこま。', 'What meeting a nudibranch might look like, as imagined by Michael.', 1280, 853],
    ['boat-break', 'ソフトクリームを持つマイケル君と足元のカニ', 'Michael holds a soft-serve cone with a crab nearby', 'ボートでひと休み。足元にはカニも！', 'A break on the boat, with a crab for company!', 966, 1280],
];
?>
<section class="section michael-diary" id="michael-diary">
    <div class="wrap">
        <div class="michael-diary-panel">
            <h2><?php d365_label('マイケル君の海日記', 'Michael’s dive diary'); ?></h2>
            <p><?php d365_label('こんにちは、マイケルです。今日はダイビングのみんなとボートへ。はじめはちょっとドキドキしたけど、海に浮かんでみたら、もっと先をのぞいてみたくなったよ。', 'Hi, Michael here. Today I went out on the boat with the divers. I was a little nervous at first, but once I floated in the sea, I wanted to see what was farther down.'); ?></p>
            <div class="michael-diary-photos">
                <?php foreach ($photos as [$file, $alt_ja, $alt_en, $caption_ja, $caption_en, $width, $height]): ?>
                    <figure>
                        <img src="<?= esc_url(d365_asset('michael-diary/' . $file . '.webp')) ?>" alt="<?= esc_attr(d365_text($alt_ja, $alt_en)) ?>" width="<?= esc_attr((string) $width) ?>" height="<?= esc_attr((string) $height) ?>" loading="lazy" decoding="async">
                        <figcaption><?php d365_label($caption_ja, $caption_en); ?></figcaption>
                    </figure>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
