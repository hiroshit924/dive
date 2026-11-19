<?php
defined('ABSPATH') || exit;

$pin = 0;
?>
<section id="tour-map" class="section tour-map-section">
    <div class="wrap">
        <div class="section-heading">
            <h2><?php d365_label('地図から海を選ぶ', 'Find your dive on the map'); ?></h2>
            <p><?php d365_label('気になる場所をタップすると、その海の見どころが見られます。地図のピンはエリアの目安です。', 'Select a pin to explore that spot. Pins show approximate dive areas.'); ?></p>
        </div>
        <div class="tour-map-grid">
            <figure class="tour-map-figure">
                <div class="tour-map-canvas">
                    <img src="<?= esc_url(d365_asset('tour-map.webp')) ?>" alt="" width="779" height="756" loading="lazy">
                    <span class="tour-map-label" style="--x:25%;--y:54%"><?php d365_label('伊豆半島', 'Izu Peninsula'); ?></span>
                    <span class="tour-map-label" style="--x:90%;--y:7%"><?php d365_label('三浦半島', 'Miura Peninsula'); ?></span>
                    <span class="tour-map-label sea" style="--x:67%;--y:34%"><?php d365_label('相模湾', 'Sagami Bay'); ?></span>
                    <?php foreach ($destinations as $region => $group): ?>
                        <?php foreach ($group['spots'] as $slug => $spot):
                            // This drawing uses the same Web Mercator extent as the GSI source tiles at zoom 10.
                            [$lat, $lon] = $spot['point'];
                            $x = ((($lon + 180) / 360 * 262144) - 232041) / 779 * 100;
                            $y = (((1 - asinh(tan(deg2rad($lat))) / M_PI) * 131072) - 103509) / 756 * 100;
                            [$dx, $dy] = $spot['offset'] ?? [0, 0];
                            $position = sprintf('--x:%.3F%%;--y:%.3F%%;--dx:%dpx;--dy:%dpx;--leader:%.2Fpx;--angle:%.2Fdeg', $x, $y, $dx, $dy, hypot($dx, $dy), rad2deg(atan2($dy, $dx)));
                            ++$pin;
                            ?>
                            <div class="tour-pin-anchor <?= $region === 'izu' ? 'is-izu' : '' ?>" style="<?= esc_attr($position) ?>">
                                <a class="tour-pin" href="<?= esc_url(d365_tour_area_url($region, $english) . '#' . $slug) ?>"
                                   aria-label="<?= esc_attr($pin . '. ' . d365_text(...$spot['name'])) ?>"><?= esc_html((string) $pin) ?></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <figcaption><a href="https://maps.gsi.go.jp/development/ichiran.html"><?php d365_label('地理院タイルをもとに作成', 'Illustrated from GSI map tiles'); ?></a></figcaption>
            </figure>
            <div class="tour-map-index">
                <?php $number = 0; foreach ($destinations as $region => $group): ?>
                    <section class="tour-map-group <?= $region === 'izu' ? 'is-izu' : '' ?>">
                        <h3><?= esc_html(d365_text(...$group['name'])) ?></h3>
                        <ul>
                            <?php foreach ($group['spots'] as $slug => $spot): ?>
                                <li><a href="<?= esc_url(d365_tour_area_url($region, $english) . '#' . $slug) ?>">
                                    <span class="tour-pin-number" aria-hidden="true"><?= esc_html((string) ++$number) ?></span>
                                    <span><?= esc_html(d365_text(...$spot['name'])) ?></span>
                                    <span class="tour-map-feature"><?= esc_html(d365_text(...$spot['feature'])) ?></span>
                                </a></li>
                            <?php endforeach; ?>
                        </ul>
                    </section>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
