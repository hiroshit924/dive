<?php
defined('ABSPATH') || exit;

$english = d365_is_english();
$today = d365_now();
$today_start = $today->setTime(0, 0);
$current = $today->modify('first day of this month')->setTime(0, 0);
$published = [];
$months = [$current->format('Y-m') => $current];
foreach (d365_sessions() as $session) {
    [$start, $end] = d365_session_dates($session->ID);
    if (!$start) {
        continue;
    }
    $published[] = [$session, $start, $end];
    for ($cursor = $start->modify('first day of this month'); $cursor <= $end; $cursor = $cursor->modify('+1 month')) {
        $months[$cursor->format('Y-m')] = $cursor;
    }
}
ksort($months);
$earliest = reset($months);
$latest = max(end($months), $current->modify('+12 months'));
$selected = d365_date(d365_input($_GET, 'dive_month'), 'Y-m');
$first = $selected && $selected >= $earliest && $selected <= $latest ? $selected : $current;
$month = $first->format('Y-m');
$last = $first->modify('last day of this month');
$month_url = static fn (DateTimeImmutable $date): string => d365_home($english, ['dive_month' => $date->format('Y-m')]) . '#calendar';
$month_format = $english ? 'F Y' : 'Y年n月';
$next_with_sessions = null;
foreach ($months as $candidate) {
    if ($candidate > $first && $candidate != $current) {
        $next_with_sessions = $candidate;
        break;
    }
}
$months[$month] = $first;
ksort($months);
$sessions = [];
$requested_session = d365_input($_GET, 'dive_session');
$chosen_session = d365_open_booking_session($requested_session);
$preferred_service = $chosen_session ? (string) get_post_meta($chosen_session->ID, '_d365_service', true) : d365_input($_GET, 'dive_service');
$show_tour_location = $preferred_service === 'tour';
$show_people = $preferred_service !== 'other';
$topics = $chosen_session ? d365_services() : d365_inquiry_topics();
$days = $english ? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] : ['月', '火', '水', '木', '金', '土', '日'];
$days_with_sessions = [];
$open_by_day = [];
foreach ($published as [$session, $start, $end]) {
    if ($end < $first || $start > $last) {
        continue;
    }
    $open = d365_session_open($session);
    $sessions[] = [$session, $start, $end, $open];
    $first_day = (int) max($start, $first)->format('j');
    $last_day = (int) min($end, $last)->format('j');
    for ($day = $first_day; $day <= $last_day; $day++) {
        $days_with_sessions[$day][] = $session->ID;
        if ($open) {
            $open_by_day[$day][] = $session->ID;
        }
    }
}
$format_period = static function (DateTimeImmutable $start, DateTimeImmutable $end, bool $show_year = false) use ($english): string {
    $show_year = $show_year || $start->format('Y') !== $end->format('Y');
    $format = $show_year ? ($english ? 'M j, Y' : 'Y年n月j日') : ($english ? 'M j' : 'n月j日');
    return $start->format($format) . ($end > $start ? ($english ? ' – ' : '〜') . $end->format($format) : '');
};
$session_link = static fn (int $id): string => d365_home($english, ['dive_month' => $month, 'dive_session' => $id]) . '#booking';
$schedule_link = static fn (int $id): string => '#dive-session-' . $id;
$dive_icon = get_theme_file_uri('assets/first-dive-mask.webp');
$status = static fn (bool $open, DateTimeImmutable $end): string => $open
    ? d365_text('受付中', 'Booking open')
    : ($end < $today_start ? d365_text('開催済み', 'Completed') : d365_text('受付終了', 'Booking closed'));
$result = d365_input($_GET, 'booking');
if ($result === '' && $requested_session !== '' && !$chosen_session) {
    $result = 'closed';
}
?>
<section id="calendar" class="section calendar">
    <div class="wrap">
        <h2><?= esc_html(d365_text('ダイビングカレンダー', 'Dive calendar')) ?></h2>
        <div class="schedule-grid">
            <div class="calendar-card">
                <div class="month-nav">
                    <?php if ($first > $earliest): ?>
                        <a aria-label="<?= esc_attr(d365_text('前の月', 'Previous month')) ?>" href="<?= esc_url($month_url($first->modify('-1 month'))) ?>">←</a>
                    <?php else: ?><span></span><?php endif; ?>
                    <strong><?= esc_html($first->format($month_format)) ?></strong>
                    <?php if ($first < $latest): ?>
                        <a aria-label="<?= esc_attr(d365_text('次の月', 'Next month')) ?>" href="<?= esc_url($month_url($first->modify('+1 month'))) ?>">→</a>
                    <?php else: ?><span></span><?php endif; ?>
                </div>
                <?php if (count($months) > 1): ?>
                    <details class="calendar-months">
                        <summary><?= esc_html(d365_text('表示する月を選ぶ', 'Choose a month')) ?></summary>
                        <ul>
                            <?php foreach ($months as $candidate): ?>
                                <li><?php if ($candidate == $first): ?>
                                    <strong aria-current="true"><?= esc_html($candidate->format($month_format)) ?></strong>
                                <?php else: ?>
                                    <a class="calendar-month-link" href="<?= esc_url($month_url($candidate)) ?>"><?= esc_html($candidate->format($month_format)) ?></a>
                                <?php endif; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </details>
                <?php endif; ?>
                <table>
                    <caption class="screen-reader-text"><?= esc_html($first->format($month_format)) ?></caption>
                    <thead><tr><?php foreach ($days as $day): ?><th scope="col"><?= esc_html($day) ?></th><?php endforeach; ?></tr></thead>
                    <tbody>
                    <?php $offset = (int) $first->format('N') - 1;
                    $total = (int) $last->format('j');
                    for ($week = 0; $week < (int) ceil(($total + $offset) / 7); $week++): ?>
                        <?php $week_start = $week * 7 - $offset + 1; ?>
                        <tr class="calendar-dates"><?php for ($col = 0; $col < 7; $col++):
                            $day = $week_start + $col; ?>
                            <td><?php if ($day >= 1 && $day <= $total):
                                if (isset($days_with_sessions[$day])):
                                    $available_today = $open_by_day[$day] ?? [];
                                    $direct = $available_today && count($days_with_sessions[$day]) === 1;
                                    $label = $first->setDate((int) $first->format('Y'), (int) $first->format('n'), $day)->format($english ? 'F j' : 'n月j日');
                                    $label .= ' · ' . ($direct
                                        ? d365_text('参加をリクエスト', 'Request a spot')
                                        : d365_text('開催日程を見る', 'View sessions'));
                                    ?>
                                    <a class="<?= $available_today ? 'calendar-day-open' : 'calendar-day-closed' ?>" href="<?= esc_url($direct ? $session_link($available_today[0]) : $schedule_link($days_with_sessions[$day][0])) ?>" aria-label="<?= esc_attr($label) ?>"><?= esc_html((string) $day) ?></a>
                                <?php elseif ($first->format('Y-m') === $today->format('Y-m') && $day === (int) $today->format('j')): ?>
                                    <span aria-current="date"><?= esc_html((string) $day) ?></span>
                                <?php else: echo esc_html((string) $day); endif;
                            endif; ?></td>
                        <?php endfor; ?></tr>
                        <?php
                        // Each lane holds sessions in date order without overlap.
                        $lanes = [];
                        $lane_ends = [];
                        foreach ($sessions as [$session, $start, $end, $open]) {
                            $start_col = max((int) max($start, $first)->format('j') - $week_start, 0);
                            $end_col = min((int) min($end, $last)->format('j') - $week_start, 6);
                            if ($start_col > $end_col) {
                                continue;
                            }
                            $lane = 0;
                            while (($lane_ends[$lane] ?? -1) >= $start_col) {
                                $lane++;
                            }
                            $lanes[$lane][] = [$session, $start, $end, $open, $start_col, $end_col];
                            $lane_ends[$lane] = $end_col;
                        }
                        foreach ($lanes as $lane): ?>
                            <tr class="calendar-bands">
                                <?php $next_col = 0; foreach ($lane as [$session, $start, $end, $open, $start_col, $end_col]):
                                    if ($start_col > $next_col): ?><td colspan="<?= esc_attr((string) ($start_col - $next_col)) ?>"></td><?php endif;
                                    $title = d365_session_title($session);
                                    $description = $title . ' · ' . $format_period($start, $end, true) . ' · ' . $status($open, $end);
                                    $show_icon = $start >= $first && (int) $start->format('j') === $week_start + $start_col;
                                    ?>
                                    <td colspan="<?= esc_attr((string) ($end_col - $start_col + 1)) ?>">
                                        <a class="calendar-band <?= $open ? 'calendar-band-open' : 'calendar-band-closed' ?>" href="<?= esc_url($open ? $session_link($session->ID) : $schedule_link($session->ID)) ?>" title="<?= esc_attr($description) ?>" aria-label="<?= esc_attr($description) ?>"><?php if ($show_icon): ?><img src="<?= esc_url($dive_icon) ?>" width="17" height="17" alt=""> <?php endif; ?><?= esc_html($title) ?></a>
                                    </td>
                                    <?php $next_col = $end_col + 1; ?>
                                <?php endforeach;
                                if ($next_col < 7): ?><td colspan="<?= esc_attr((string) (7 - $next_col)) ?>"></td><?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                    </tbody>
                </table>
                <?php if ($sessions): ?>
                    <p class="calendar-legend">
                        <span class="calendar-legend-open"><?= esc_html(d365_text('受付中', 'Booking open')) ?></span>
                        <span class="calendar-legend-closed"><?= esc_html(d365_text('受付終了・開催済み', 'Booking closed or completed')) ?></span>
                    </p>
                <?php endif; ?>
            </div>
            <div class="calendar-schedule">
                <h3><?= esc_html(d365_text($first->format($month_format) . 'の開催日程', 'Sessions in ' . $first->format($month_format))) ?></h3>
                <?php if (!$sessions): ?><p><?= esc_html(d365_text('この月の開催日程はまだ掲載されていません。', 'No sessions have been posted for this month.')) ?></p><?php endif; ?>
                <?php foreach ($sessions as [$session, $start, $end, $open]):
                    $service = d365_services()[get_post_meta($session->ID, '_d365_service', true)] ?? '';
                    ?>
                    <article class="session-item" id="dive-session-<?= esc_attr((string) $session->ID) ?>">
                        <div class="session-item-main">
                            <img class="session-item-icon" src="<?= esc_url(d365_session_icon_url(d365_session_icon($session->ID))) ?>" width="42" height="42" alt="">
                            <div>
                                <span><?= esc_html($format_period($start, $end)) ?></span>
                                <strong><?= esc_html(d365_session_title($session)) ?></strong>
                                <small><?= esc_html($service) ?></small>
                            </div>
                        </div>
                        <?php if ($open): ?>
                            <a href="<?= esc_url($session_link($session->ID)) ?>"><?= esc_html(d365_text('参加をリクエスト', 'Request a spot')) ?></a>
                        <?php else: ?><span><?= esc_html($status($open, $end)) ?></span><?php endif; ?>
                    </article>
                <?php endforeach; ?>
                <?php if ($next_with_sessions): ?>
                    <a class="text-link calendar-month-link" href="<?= esc_url($month_url($next_with_sessions)) ?>"><?= esc_html(d365_text($next_with_sessions->format($month_format) . 'の開催日程を見る', 'See sessions in ' . $next_with_sessions->format($month_format))) ?> →</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="section booking" id="booking">
    <div class="wrap booking-grid">
        <div>
            <h2><?= esc_html(d365_text('予約・問い合わせ', 'Booking and inquiries')) ?></h2>
            <p><?= esc_html(d365_text('カレンダーの日程から参加を申し込むか、ご相談内容をお知らせください。スタッフが確認し、ご連絡します。', 'Request a spot from the calendar or tell us what you’d like to discuss. Our team will follow up to confirm your booking.')) ?></p>
            <p><a href="tel:+81452735496">045-273-5496</a></p>
        </div>
        <div>
                <form class="d365-booking-form" method="post" action="<?= esc_url(admin_url('admin-post.php')) ?>" data-submit-error="<?= esc_attr(d365_text('送信結果を確認できませんでした。再送する前にショップへお問い合わせください。', 'We couldn’t verify the result. Contact the shop before sending another request.')) ?>">
                    <input type="hidden" name="action" value="d365_book">
                    <input type="hidden" name="language" value="<?= $english ? 'en' : 'ja' ?>">
                    <?php wp_nonce_field('d365_book', 'd365_nonce', false); ?>
                    <div hidden aria-hidden="true"><label>Company <input type="text" name="company" tabindex="-1" autocomplete="off"></label></div>
                    <?php if ($chosen_session):
                        [$chosen_start, $chosen_end] = d365_session_dates($chosen_session->ID); ?>
                        <input type="hidden" name="session" value="<?= esc_attr((string) $chosen_session->ID) ?>">
                        <p class="booking-session">
                            <?= esc_html($format_period($chosen_start, $chosen_end, true)) ?>
                            · <strong><?= esc_html(d365_session_title($chosen_session)) ?></strong>
                            <a href="<?= esc_url(d365_home($english, ['dive_month' => $month]) . '#calendar') ?>"><?= esc_html(d365_text('日程を選び直す', 'Change date')) ?></a>
                        </p>
                    <?php endif; ?>
                    <label for="d365_service"><?= esc_html(d365_text('ご相談内容', 'Inquiry topic')) ?></label>
                    <select id="d365_service" name="service" <?= $chosen_session ? 'disabled' : 'required' ?>>
                        <option value=""><?= esc_html(d365_text('ご相談内容を選んでください', 'Select a topic')) ?></option>
                        <?php foreach ($topics as $key => $label): ?>
                            <option value="<?= esc_attr($key) ?>" <?php selected($preferred_service, $key); ?>><?= esc_html($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="booking-tour-location" <?= $show_tour_location ? '' : 'hidden' ?>>
                        <label for="d365_tour_location"><?= esc_html(d365_text('行ってみたい場所（任意）', 'Where would you like to dive? (optional)')) ?></label>
                        <input id="d365_tour_location" name="tour_location" maxlength="100" value="<?= esc_attr($show_tour_location ? apply_filters('d365_booking_tour_location_default', '') : '') ?>" <?= $show_tour_location ? '' : 'disabled' ?>>
                    </div>
                    <label for="d365_guest_name"><?= esc_html(d365_text('お名前', 'Name')) ?></label>
                    <input id="d365_guest_name" name="guest_name" maxlength="100" autocomplete="name" required>
                    <label for="d365_guest_email"><?= esc_html(d365_text('メールアドレス', 'Email address')) ?></label>
                    <input id="d365_guest_email" type="email" name="guest_email" maxlength="254" autocomplete="email" required>
                    <div class="booking-people" <?= $show_people ? '' : 'hidden' ?>>
                        <label for="d365_people"><?= esc_html(d365_text('参加人数', 'Number of guests')) ?></label>
                        <input id="d365_people" type="number" name="people" value="1" min="1" max="10" <?= $show_people ? 'required' : 'disabled' ?>>
                    </div>
                    <label for="d365_message"><?= esc_html(d365_text('連絡事項（任意）', 'Additional notes (optional)')) ?></label>
                    <textarea id="d365_message" name="message" rows="3" maxlength="1000" aria-describedby="d365_notes_help"><?= esc_textarea(apply_filters('d365_booking_notes_default', '')) ?></textarea>
                    <small id="d365_notes_help"><?= esc_html(d365_text('健康情報の記入はお控えください。', 'Please leave out any medical information.')) ?></small>
                    <label class="consent"><input type="checkbox" name="consent" value="1" required>
                        <span><?= esc_html(d365_text('入力した情報を予約・お問い合わせへの対応と連絡に使用することに同意します。', 'I agree that my details may be used to handle my request and contact me about it.')) ?>
                            <?php if (get_privacy_policy_url()): ?> <a href="<?= esc_url(get_privacy_policy_url()) ?>"><?= esc_html(d365_text('プライバシーポリシー', 'Privacy policy')) ?></a><?php endif; ?>
                        </span>
                    </label>
                    <p class="form-notice <?= $result === 'received' ? 'success' : 'error' ?>" role="status" tabindex="-1"><?= esc_html(d365_booking_feedback($result, $english, !$show_people)) ?></p>
                    <button class="button" type="submit"><?= esc_html(d365_text('送信する', 'Send request')) ?> <span aria-hidden="true">→</span></button>
                </form>
        </div>
    </div>
</section>
