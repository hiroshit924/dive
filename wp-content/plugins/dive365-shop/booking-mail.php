<?php
defined('ABSPATH') || exit;

function d365_send_booking_mail(int $id, string $kind): void {
    $name = (string) get_post_meta($id, '_d365_name', true);
    $email = (string) get_post_meta($id, '_d365_email', true);
    $english = $kind !== 'staff' && get_post_meta($id, '_d365_language', true) === 'English';
    $service = (string) get_post_meta($id, '_d365_service', true);
    $other = $service === 'other';
    if ($other && $kind !== 'received' && $kind !== 'staff') {
        return;
    }
    $session = (string) get_post_meta($id, '_d365_session_title', true);
    $period = d365_booking_period($id);
    $tour_location = (string) get_post_meta($id, '_d365_tour_location', true);
    $people = (int) get_post_meta($id, '_d365_people', true);

    $details = [($english ? 'Inquiry topic: ' : 'ご相談内容：') . (d365_inquiry_topics($english)[$service] ?? $service)];
    if ($session !== '') {
        $details[] = ($english ? 'Requested session: ' : '申込日程：') . $session;
    }
    if ($period !== '') {
        $label = $session !== '' || (int) get_post_meta($id, '_d365_session', true) > 0
            ? ($english ? 'Session dates (Japan time): ' : '開催日程（日本時間）：')
            : ($english ? 'Requested date (Japan time): ' : '希望日（日本時間）：');
        $details[] = $label . $period;
    }
    if ($tour_location !== '') {
        $details[] = ($english ? 'Preferred destination: ' : '行ってみたい場所：') . $tour_location;
    }
    if (!$other) {
        $details[] = ($english ? 'Guests: ' : '参加人数：') . $people;
    }

    $headers = ['From: Diving Shop C365 <dive@c365.jp>'];
    if ($kind === 'staff') {
        $recipient = (string) get_option('admin_email');
        $subject = '【Diving Shop C365】' . ($other ? '新しいお問い合わせ' : '新しいダイビング予約リクエスト');
        $notes = (string) get_post_meta($id, '_d365_message', true);
        $language = (string) get_post_meta($id, '_d365_language', true);
        $body = ($other ? 'お問い合わせを受け付けました。' : 'ダイビング予約リクエストを受け付けました。') . "\n\n"
            . "【申請内容】\nお名前：$name\nメールアドレス：$email\n言語：$language\n"
            . implode("\n", $details)
            . "\n\n【連絡事項】\n" . ($notes !== '' ? $notes : '記入なし')
            . "\n\nWordPress管理画面で申請を開く\n" . admin_url('post.php?post=' . $id . '&action=edit');
        if (is_email($email)) {
            $headers[] = 'Reply-To: ' . $email;
        }
    } else {
        $recipient = $email;
        $headers[] = 'Reply-To: dive@c365.jp';
        $copy = [
            'received' => [
                ['予約リクエストを受け付けました', 'We received your booking request'],
                ['このたびは、Diving Shop C365へお申し込みいただき、誠にありがとうございます。下記の内容で予約リクエストを承りました。スタッフが日程や空き状況を確認し、ご入力いただいたメールアドレスへ改めてご案内いたします。ご予約は確定のご連絡をもって成立します。', 'Thank you for contacting Diving Shop C365. We have received the booking request below. Our team will check the details and availability, then contact you at the email address you provided. Your booking is confirmed once you receive our confirmation.'],
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
        if ($kind === 'received' && $other) {
            $title = ['お問い合わせを受け付けました', 'We received your inquiry'];
            $message = [
                'Diving Shop C365へお問い合わせいただきありがとうございます。スタッフが内容を確認し、ご入力いただいたメールアドレスへご連絡いたします。',
                'Thank you for contacting Diving Shop C365. Our team will review your inquiry and reply to the email address you provided.',
            ];
        }
        $locale = $english ? 1 : 0;
        $subject = 'Diving Shop C365 | ' . $title[$locale];
        $body = $english ? "Dear $name," : "$name 様";
        $body .= "\n\n" . $message[$locale];
        $body .= "\n\n" . ($english ? 'Your request' : '【お申し込み内容】') . "\n" . implode("\n", $details);
        if ($kind === 'received') {
            $reply = $other
                ? ['補足やご質問があれば、このメールにご返信ください。', 'Please reply to this email if you have anything to add.']
                : ['お申し込み内容の変更やご不明点がございましたら、このメールにご返信ください。スタッフ一同、海でお会いできることを楽しみにしております。', 'If you would like to change any details or have a question before your dive, please reply to this email. We look forward to hearing from you.'];
            $body .= "\n\n" . $reply[$locale];
        }
        $body .= "\n\nDiving Shop C365\ndive@c365.jp\n045-273-5496";
    }

    $sent = is_email($recipient) && wp_mail($recipient, $subject, $body, $headers);
    update_post_meta($id, '_d365_mail_' . $kind, $sent ? 'sent' : 'failed');
}
