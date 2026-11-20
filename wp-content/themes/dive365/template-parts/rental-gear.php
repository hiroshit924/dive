<?php
$gear = [
    ['set', 8800, ['フルレンタル', 'Full equipment rental'], ['重器材・軽器材のセット。セット内容やスーツの手配はご予約時にご確認ください。', 'A set of major equipment and personal gear. Ask the shop about the exact items and suit rental when booking.']],
    ['regulator', 2200, ['レギュレーター', 'Regulator'], ['水中で呼吸するための器材。', 'Your breathing equipment underwater.']],
    ['bcd', 2200, ['BCD', 'BCD'], ['タンクを背負い、浮力を調整するベスト。', 'The vest that holds your tank and helps you control buoyancy.']],
    ['wetsuit', 2200, ['ウェットスーツ', 'Wetsuit'], ['水中で体温を保つためのスーツ。', 'Helps keep you warm in the water.']],
    ['drysuit', 5500, ['ドライスーツ', 'Drysuit'], ['水の侵入を抑える、冷たい海向けのスーツ。', 'A suit designed to keep water out in colder conditions.']],
    ['mask', 1100, ['マスク＆シュノーケル', 'Mask and snorkel'], ['水中を見るマスクと、水面で呼吸するためのシュノーケル。', 'A mask to see underwater and a snorkel to breathe at the surface.']],
    ['fins', 1100, ['フィン', 'Fins'], ['水中を進むための足ひれ。', 'Footwear that helps you move through the water.']],
    ['boots', 1100, ['ブーツ', 'Dive boots'], ['足の保護と保温に使います。', 'Help protect your feet and keep them warm.']],
    ['gloves', 550, ['グローブ', 'Gloves'], ['手の保護と保温に使います。', 'Help protect your hands and keep them warm.']],
    ['light', 2200, ['水中ライト', 'Dive light'], ['水中で岩陰などを照らすライト。', 'A light for looking into shaded areas underwater.']],
    ['camera', 3300, ['水中カメラ', 'Underwater camera'], ['出会った魚や景色を写真に残せます。', 'Capture the fish and scenery you see on your dive.']],
    ['computer', 2200, ['ダイブコンピューター', 'Dive computer'], ['深度や潜水時間を確認する器材。', 'Displays depth and dive time.']],
    ['float', 550, ['シグナルフロート', 'Surface marker buoy'], ['水面で自分の位置を知らせる目印。', 'A visible marker that indicates your position at the surface.']],
    ['weights', 550, ['ウエイト', 'Dive weights'], ['浮力のバランスを取るためのおもり。', 'Weights used to help balance buoyancy.']],
];
?>
<section id="rental-gear" class="section rental-gear">
    <div class="wrap">
        <h2><?php d365_label('器材レンタル', 'Equipment rental'); ?></h2>
        <p class="dive-section-lead"><?php d365_label('ファンダイブツアーで借りられる器材です。必要なものを選んで、ツアーのご相談時にお知らせください。料金は税込です。', 'Choose the gear you need for your fun dive and let us know when you inquire. Prices include tax.'); ?></p>
        <ul class="rental-grid">
            <?php foreach ($gear as [$key, $price, $name, $description]): ?>
                <li class="rental-card<?php if ($key === 'set'): ?> rental-card-set<?php endif; ?>">
                    <img src="<?= esc_url(d365_asset('rental-gear/' . $key . '.png')) ?>" width="112" height="112" alt="" loading="lazy">
                    <div>
                        <h3><?= esc_html(d365_text(...$name)) ?></h3>
                        <p><?= esc_html(d365_text(...$description)) ?></p>
                        <p class="rental-price"><?= esc_html($key === 'camera'
                            ? d365_text('¥' . number_format($price) . '〜', 'From ¥' . number_format($price))
                            : '¥' . number_format($price)) ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="rental-note"><?php d365_label('スーツ・ブーツ・フィンなどはサイズによりご用意できない場合があります。必要な器材とサイズは事前にショップへご相談ください。', 'Please check sizes and availability with the shop in advance, especially for suits, boots and fins.'); ?></p>
    </div>
</section>
