<?php
defined('ABSPATH') || exit;

function d365_send_booking_mail(int $id, string $kind): void {
    if ($kind === 'staff') {
        $recipient = (string) get_option('admin_email');
        $subject = '【Diving Shop C365】新しいダイビング予約リクエスト';
        $body = "ダイビング予約リクエストを受け付けました。\n\n"
            . "WordPress管理画面で申請内容を確認してください。\n"
            . admin_url('post.php?post=' . $id . '&action=edit');
    } else {
        $recipient = (string) get_post_meta($id, '_d365_email', true);
        $english = get_post_meta($id, '_d365_language', true) === 'English';
        $copy = [
            'received' => [
                ['予約リクエストを受け付けました', 'We received your booking request'],
                ['スタッフが日程と空き状況を確認し、ご連絡します。', 'Our team will check availability and contact you to confirm your booking.'],
            ],
            'confirmed' => [
                ['ご予約が確定しました', 'Your booking is confirmed'],
                ['スタッフがご予約を確定しました。集合場所や持ち物など、ご不明点はショップまでお問い合わせください。', 'Our team has confirmed your booking. Contact the shop if you have questions about where to meet or what to bring.'],
            ],
            'declined' => [
                ['予約リクエストについて', 'An update about your booking request'],
                ['今回はご予約をお受けできませんでした。別の日程をご希望の場合はショップへご相談ください。', 'We were unable to accept this request. Please contact the shop if you’d like to discuss another date.'],
            ],
            'cancelled' => [
                ['ご予約のキャンセルについて', 'Your booking was cancelled'],
                ['ご予約はキャンセルとなりました。お心当たりがない場合はショップにご連絡ください。', 'Your booking has been cancelled. Contact the shop if you did not expect this change.'],
            ],
        ];
        [$title, $message] = $copy[$kind];
        $locale = $english ? 1 : 0;
        $subject = 'Diving Shop C365 | ' . $title[$locale];
        $name = (string) get_post_meta($id, '_d365_name', true);
        $service = (string) get_post_meta($id, '_d365_service', true);
        $session = (string) get_post_meta($id, '_d365_session_title', true);
        $date = (string) get_post_meta($id, '_d365_session_date', true);
        $people = (int) get_post_meta($id, '_d365_people', true);
        $body = $english ? "Hi $name," : "$name 様";
        $body .= "\n\n" . $message[$locale];
        $body .= "\n\n" . ($english ? 'Course: ' : 'コース：') . (d365_services($english)[$service] ?? $service);
        if ($session !== '') {
            $body .= "\n" . ($english ? 'Requested session: ' : '申込日程：') . $session;
        }
        if ($date !== '') {
            $body .= "\n" . ($english ? 'Requested date (Japan time): ' : '申込時の日付（日本時間）：') . $date;
        }
        $body .= "\n" . ($english ? 'Guests: ' : '参加人数：') . $people;
        $body .= "\n\nDiving Shop C365\n045-273-5496";
    }

    $sent = is_email($recipient) && wp_mail($recipient, $subject, $body);
    update_post_meta($id, '_d365_mail_' . $kind, $sent ? 'sent' : 'failed');
}
