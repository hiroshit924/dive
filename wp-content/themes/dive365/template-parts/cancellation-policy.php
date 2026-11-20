<?php
$fees = [
    [['10日以上前', '10 or more days before'], ['無料', 'Free']],
    [['5〜9日前', '5–9 days before'], ['2,200円', '¥2,200']],
    [['2〜4日前', '2–4 days before'], ['3,300円', '¥3,300']],
    [['前日', 'The day before'], ['5,500円', '¥5,500']],
    [['当日', 'On the day'], ['代金の100％', '100% of the price']],
    [['連絡なしの不参加', 'No-show without notice'], ['代金の100％', '100% of the price']],
];
?>
<section class="section dive-cancellation" id="cancellation-policy">
    <div class="wrap">
        <h2><?php d365_label('キャンセルポリシー', 'Cancellation policy'); ?></h2>
        <p class="dive-section-lead"><?php d365_label('国内ツアー・体験ダイビングの日程変更やキャンセルは、分かり次第ショップへご連絡ください。', 'For changes or cancellations to a domestic trip or introductory dive, contact the shop as soon as you know your plans have changed.'); ?></p>
        <div class="dive-policy-grid">
            <article class="dive-policy-fees">
                <h3 id="cancellation-fees"><?php d365_label('お客様都合のキャンセル料', 'Cancellation fees'); ?></h3>
                <p><?php d365_label('お客様都合によるキャンセルにつきましては、以下のキャンセル料が発生しますので、ご了承ください。', 'The following fees apply when you cancel a booking for personal reasons.'); ?></p>
                <table aria-labelledby="cancellation-fees">
                    <thead>
                        <tr>
                            <th scope="col"><?php d365_label('キャンセルの時期', 'When you cancel'); ?></th>
                            <th scope="col"><?php d365_label('キャンセル料', 'Fee'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fees as [$timing, $fee]): ?>
                            <tr>
                                <th scope="row"><?= esc_html(d365_text(...$timing)) ?></th>
                                <td><?= esc_html(d365_text(...$fee)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p><?php d365_label('※夏季期間の宿泊費については上記期間前からかかる場合がございますので、お申し込み時にご確認ください。遠征ツアーに関しては旅行会社規定によるキャンセルチャージとなります。', 'Summer accommodation charges may apply earlier than the time frames above. Please check when you book. For expedition tours, the travel agency’s cancellation terms apply.'); ?></p>
            </article>
            <article>
                <h3><?php d365_label('変更・キャンセルのご連絡', 'How to make a change'); ?></h3>
                <p><?php d365_label('予約確定メールに返信するか、電話で「お名前・参加予定日・プログラム名」をお知らせください。開催日が近い場合は、お電話でのご連絡をお願いします。受付結果はスタッフからご案内します。', 'Reply to your booking confirmation or call us with your name, planned date and program. If the date is approaching, please call. Our team will confirm the outcome with you.'); ?></p>
                <div class="dive-policy-contact">
                    <a href="tel:+81452735496">045-273-5496</a>
                    <a href="mailto:dive@c365.jp">dive@c365.jp</a>
                </div>
            </article>
            <article>
                <h3><?php d365_label('天候・海況で変更や中止になる場合', 'Changes due to weather or sea conditions'); ?></h3>
                <p><?php d365_label('天候や海況によって、開催場所や日程が変わったり、開催が中止になったりすることがあります。変更・中止が決まり次第、ショップからご連絡し、振替日やお支払いの扱いをご案内します。', 'Weather and sea conditions can lead to a change of venue or date, or to a cancellation. If that happens, the shop will contact you about alternative dates and how any payment will be handled.'); ?></p>
            </article>
        </div>
    </div>
</section>
