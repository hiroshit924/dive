<?php
defined('ABSPATH') || exit;

$english = d365_is_english();
$today = d365_now();
$current = $today->modify('first day of this month')->setTime(0, 0);
$selected = d365_date(d365_input($_GET, 'dive_month'), 'Y-m');
$first = $selected && $selected >= $current && $selected <= $current->modify('+12 months') ? $selected : $current;
$month = $first->format('Y-m');
$last = $first->modify('last day of this month');
$sessions = d365_sessions($first->format('Y-m-d'), $last->format('Y-m-d'));
$open_sessions = array_filter(d365_sessions($today->format('Y-m-d'), $current->modify('+12 months')->modify('last day of this month')->format('Y-m-d')), 'd365_session_open');
$preferred_service = d365_input($_GET, 'dive_service');
$chosen = absint(d365_input($_GET, 'dive_session'));
$days = $english ? ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] : ['月', '火', '水', '木', '金', '土', '日'];
$days_with_sessions = [];
$open_by_day = [];
foreach ($sessions as $session) {
    $day = (int) substr(get_post_meta($session->ID, '_d365_date', true), -2);
    $days_with_sessions[$day] = true;
    if (d365_session_open($session)) {
        $open_by_day[$day][] = $session->ID;
    }
}
$session_link = static fn (int $id): string => d365_home($english, ['dive_month' => $month, 'dive_session' => $id]) . '#booking';
$feedback = [
    'received' => d365_text('予約リクエストを受け付けました。スタッフからのご連絡をお待ちください。', 'We received your request. Our team will contact you to confirm availability.'),
    'invalid' => d365_text('入力内容を確認して、もう一度お試しください。', 'Please check your details and try again.'),
    'closed' => d365_text('この日程は受付を終了しました。別の日程をお選びください。', 'This session is closed. Please select another date.'),
    'error' => d365_text('送信できませんでした。時間をおいて再度お試しください。', 'Your request could not be saved. Please try again shortly.'),
];
$result = d365_input($_GET, 'booking');
?>
<section id="calendar" class="section calendar">
    <div class="wrap">
        <h2><?= esc_html(d365_text('ダイビングカレンダー', 'Dive calendar')) ?></h2>
        <div class="schedule-grid">
            <div class="calendar-card">
                <div class="month-nav">
                    <?php if ($first > $current): ?>
                        <a aria-label="<?= esc_attr(d365_text('前の月', 'Previous month')) ?>" href="<?= esc_url(d365_home($english, ['dive_month' => $first->modify('-1 month')->format('Y-m')]) . '#calendar') ?>">←</a>
                    <?php else: ?><span></span><?php endif; ?>
                    <strong><?= esc_html($first->format($english ? 'F Y' : 'Y年n月')) ?></strong>
                    <?php if ($first < $current->modify('+12 months')): ?>
                        <a aria-label="<?= esc_attr(d365_text('次の月', 'Next month')) ?>" href="<?= esc_url(d365_home($english, ['dive_month' => $first->modify('+1 month')->format('Y-m')]) . '#calendar') ?>">→</a>
                    <?php else: ?><span></span><?php endif; ?>
                </div>
                <table>
                    <caption class="screen-reader-text"><?= esc_html($first->format($english ? 'F Y' : 'Y年n月')) ?></caption>
                    <thead><tr><?php foreach ($days as $day): ?><th scope="col"><?= esc_html($day) ?></th><?php endforeach; ?></tr></thead>
                    <tbody>
                    <?php $offset = (int) $first->format('N') - 1;
                    $total = (int) $last->format('j');
                    for ($week = 0; $week < (int) ceil(($total + $offset) / 7); $week++): ?>
                        <tr><?php for ($col = 0; $col < 7; $col++):
                            $day = $week * 7 + $col - $offset + 1; ?>
                            <td><?php if ($day >= 1 && $day <= $total):
                                if (isset($days_with_sessions[$day])):
                                    $available_today = $open_by_day[$day] ?? [];
                                    $direct = count($available_today) === 1;
                                    $label = $first->setDate((int) $first->format('Y'), (int) $first->format('n'), $day)->format($english ? 'F j' : 'n月j日');
                                    $label .= ' · ' . ($direct
                                        ? d365_text('参加をリクエスト', 'Request a spot')
                                        : d365_text('開催日程を見る', 'View sessions'));
                                    ?>
                                    <a class="<?= $available_today ? 'calendar-day-open' : 'calendar-day-closed' ?>" href="<?= esc_url($direct ? $session_link($available_today[0]) : '#dives-' . $day) ?>" aria-label="<?= esc_attr($label) ?>"><?= esc_html((string) $day) ?></a>
                                <?php elseif ($first->format('Y-m') === $today->format('Y-m') && $day === (int) $today->format('j')): ?>
                                    <span aria-current="date"><?= esc_html((string) $day) ?></span>
                                <?php else: echo esc_html((string) $day); endif;
                            endif; ?></td>
                        <?php endfor; ?></tr>
                    <?php endfor; ?>
                    </tbody>
                </table>
                <?php if ($open_by_day): ?>
                    <p class="calendar-legend"><?= esc_html(d365_text('青い日付から参加をリクエストできます。', 'Select a blue date to request a spot.')) ?></p>
                <?php endif; ?>
            </div>
            <div class="calendar-schedule">
                <h3><?= esc_html(d365_text('今月の開催日程', 'Sessions this month')) ?></h3>
                <?php if (!$sessions): ?><p><?= esc_html(d365_text('この月の開催日程はまだ掲載されていません。', 'No sessions have been posted for this month.')) ?></p><?php endif; ?>
                <?php $previous_day = 0; foreach ($sessions as $session):
                    $date = d365_date((string) get_post_meta($session->ID, '_d365_date', true));
                    if (!$date) { continue; }
                    $day = (int) $date->format('j');
                    $service = d365_services()[get_post_meta($session->ID, '_d365_service', true)] ?? '';
                    ?>
                    <article class="session-item" <?php if ($day !== $previous_day): ?>id="dives-<?= esc_attr((string) $day) ?>"<?php endif; ?>>
                        <div><time datetime="<?= esc_attr($date->format('Y-m-d')) ?>"><?= esc_html($date->format($english ? 'M j' : 'n月j日')) ?></time>
                        <strong><?= esc_html(d365_session_title($session)) ?></strong>
                        <small><?= esc_html($service) ?></small></div>
                        <?php if (d365_session_open($session)): ?>
                            <a href="<?= esc_url($session_link($session->ID)) ?>"><?= esc_html(d365_text('参加をリクエスト', 'Request a spot')) ?></a>
                        <?php else: ?><span><?= esc_html(d365_text('受付終了', 'Closed')) ?></span><?php endif; ?>
                    </article>
                    <?php $previous_day = $day; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<section class="section booking" id="booking">
    <div class="wrap booking-grid">
        <div>
            <h2><?= esc_html(d365_text('ダイビングを予約', 'Request a dive')) ?></h2>
            <p><?= esc_html(d365_text('開催日程を選ぶか、希望日をお知らせください。予約の確定はスタッフからご連絡します。', 'Choose a scheduled dive or tell us your preferred date. Our team will contact you to confirm your booking.')) ?></p>
            <p><a href="tel:+81452735496">045-273-5496</a></p>
        </div>
        <div>
            <?php if (isset($feedback[$result])): ?>
                <p class="form-notice <?= $result === 'received' ? 'success' : 'error' ?>" role="status"><?= esc_html($feedback[$result]) ?></p>
            <?php endif; ?>

                <form class="d365-booking-form" method="post" action="<?= esc_url(admin_url('admin-post.php')) ?>">
                    <input type="hidden" name="action" value="d365_book">
                    <input type="hidden" name="language" value="<?= $english ? 'en' : 'ja' ?>">
                    <?php wp_nonce_field('d365_book', 'd365_nonce', false); ?>
                    <div hidden aria-hidden="true"><label>Company <input type="text" name="company" tabindex="-1" autocomplete="off"></label></div>
                    <label for="d365_session_id"><?= esc_html(d365_text('開催日程', 'Session')) ?></label>
                    <select id="d365_session_id" name="session">
                        <option value=""><?= esc_html(d365_text('希望日を相談する', 'Discuss another date')) ?></option>
                        <?php foreach ($open_sessions as $session): ?>
                            <option value="<?= esc_attr((string) $session->ID) ?>" <?php selected($chosen, $session->ID); ?>><?= esc_html(get_post_meta($session->ID, '_d365_date', true) . ' — ' . d365_session_title($session)) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="d365_service"><?= esc_html(d365_text('希望のコース', 'Preferred dive or course')) ?></label>
                    <select id="d365_service" name="service">
                        <option value=""><?= esc_html(d365_text('コースを選ぶ（日程を相談する場合）', 'Select a course if discussing a date')) ?></option>
                        <?php foreach (d365_services() as $key => $label): ?>
                            <option value="<?= esc_attr($key) ?>" <?php selected($preferred_service, $key); ?>><?= esc_html($label) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <label for="d365_preferred_date"><?= esc_html(d365_text('希望日（日程を相談する場合・任意）', 'Preferred date (optional when discussing a date)')) ?></label>
                    <input id="d365_preferred_date" type="date" name="preferred_date" min="<?= esc_attr($today->format('Y-m-d')) ?>">
                    <label for="d365_guest_name"><?= esc_html(d365_text('お名前', 'Name')) ?></label>
                    <input id="d365_guest_name" name="guest_name" maxlength="100" autocomplete="name" required>
                    <label for="d365_guest_email"><?= esc_html(d365_text('メールアドレス', 'Email address')) ?></label>
                    <input id="d365_guest_email" type="email" name="guest_email" maxlength="254" autocomplete="email" required>
                    <label for="d365_people"><?= esc_html(d365_text('参加人数', 'Number of guests')) ?></label>
                    <input id="d365_people" type="number" name="people" value="1" min="1" max="10" required>
                    <label for="d365_message"><?= esc_html(d365_text('連絡事項（任意）', 'Additional notes (optional)')) ?></label>
                    <textarea id="d365_message" name="message" rows="3" maxlength="1000" aria-describedby="d365_notes_help"><?= esc_textarea(apply_filters('d365_booking_notes_default', '')) ?></textarea>
                    <small id="d365_notes_help"><?= esc_html(d365_text('健康情報の記入はお控えください。', 'Please leave out any medical information.')) ?></small>
                    <label class="consent"><input type="checkbox" name="consent" value="1" required>
                        <span><?= esc_html(d365_text('入力した情報を予約対応と連絡に使用することに同意します。', 'I agree that my details may be used to handle my request and contact me about it.')) ?>
                            <?php if (get_privacy_policy_url()): ?> <a href="<?= esc_url(get_privacy_policy_url()) ?>"><?= esc_html(d365_text('プライバシーポリシー', 'Privacy policy')) ?></a><?php endif; ?>
                        </span>
                    </label>
                    <button class="button" type="submit"><?= esc_html(d365_text('予約リクエストを送信', 'Send booking request')) ?> <span aria-hidden="true">→</span></button>
                </form>
        </div>
    </div>
</section>
