<?php
defined('ABSPATH') || exit;

add_action('wp', static function (): void {
    if (is_front_page() || d365_is_courses() || d365_experience()) {
        remove_action('wp_head', 'rel_canonical');
    }
});

add_action('wp_head', static function (): void {
    if (!is_front_page() && !d365_is_courses() && !d365_experience()) {
        return;
    }

    $course = d365_is_courses();
    $english = d365_is_english();
    $description = $course
        ? d365_text('横浜のDiving Shop C365でPADIのダイビング講習。オープン・ウォーター、アドヴァンスド講習の料金・参加条件と、次のスキルアップコースをご案内します。', 'Explore PADI scuba training at Dive 365 in Yokohama, including Open Water and Advanced Open Water courses, prices, requirements and skill progression.')
        : d365_text('横浜・桜木町のダイビングショップ Dive 365。初めての体験ダイビング、PADIライセンス講習、逗子・葉山・伊豆のファンダイブ。開催日程と予約はこちら。', 'Dive 365 is a scuba diving shop in Yokohama offering beginner dives, PADI certification and guided dive trips in Zushi, Hayama and Izu. View dates and request a booking.');
    $experience = d365_experience();
    if ($experience === 'trial') {
        $description = d365_text('横浜のDive 365で初めての体験ダイビング。料金、参加条件、持ち物を確認し、開催日程や希望日からお申し込みください。', 'Try scuba diving with Dive 365 in Yokohama. See what is included, check participation requirements and request a date.');
    } elseif ($experience === 'tour') {
        $description = d365_text('横浜のDive 365が案内する逗子・葉山・伊豆のファンダイブ。ツアー料金、器材レンタル、日程と予約をご案内します。', 'Join Dive 365 in Yokohama for guided dives in Zushi, Hayama and Izu. See trip prices, rental options and booking information.');
    }
    $url = d365_landing_url($english);
    $image = d365_asset($experience ? $experience . '.jpg' : ($course ? 'course.jpg' : 'hero.jpg'));
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'SportsActivityLocation',
        '@id' => d365_home(false) . '#dive365-shop',
        'name' => 'Diving Shop C365',
        'alternateName' => 'Dive 365',
        'url' => d365_home(false),
        'image' => d365_asset('shop-new.jpg'),
        'logo' => d365_asset('logo-alt.png'),
        'telephone' => '+81-45-273-5496',
        'sport' => 'Scuba diving',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '福富町西通44-2 Speranza Sakuragicho 1F',
            'addressLocality' => '横浜市中区',
            'addressRegion' => '神奈川県',
            'addressCountry' => 'JP',
        ],
        'openingHoursSpecification' => [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            'opens' => '10:00',
            'closes' => '17:00',
        ],
        'sameAs' => ['https://www.instagram.com/c365_marine/'],
    ];
    ?>
    <link rel="canonical" href="<?= esc_url($url) ?>">
    <meta name="description" content="<?= esc_attr($description) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= esc_attr(wp_get_document_title()) ?>">
    <meta property="og:description" content="<?= esc_attr($description) ?>">
    <meta property="og:url" content="<?= esc_url($url) ?>">
    <meta property="og:image" content="<?= esc_url($image) ?>">
    <meta property="og:locale" content="<?= $english ? 'en_US' : 'ja_JP' ?>">
    <meta name="twitter:card" content="summary_large_image">
    <script type="application/ld+json"><?= wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?></script>
    <?php
}, 8);

add_action('init', static function (): void {
    if (!function_exists('d365_show_booking') || !class_exists('WP_Sitemaps_Provider')) {
        return;
    }
    wp_register_sitemap_provider('diveshop', new class extends WP_Sitemaps_Provider {
        public function __construct() {
            $this->name = 'diveshop';
            $this->object_type = 'diveshop';
        }

        public function get_url_list($page_num, $object_subtype = '') {
            if ((int) $page_num !== 1) {
                return [];
            }
            $urls = [d365_home(true), d365_courses_url(true), d365_experience_url('trial', true), d365_experience_url('tour', true)];
            if (get_option('show_on_front') !== 'page') {
                $urls[] = d365_home(false);
            }
            if (get_post_type(44) !== 'page' || get_post_status(44) !== 'publish') {
                $urls[] = d365_courses_url(false);
            }
            foreach (['trial' => 47, 'tour' => 14] as $type => $id) {
                if (get_post_type($id) !== 'page' || get_post_status($id) !== 'publish') {
                    $urls[] = d365_experience_url($type, false);
                }
            }
            return array_map(static fn(string $url): array => ['loc' => $url], $urls);
        }

        public function get_max_num_pages($object_subtype = '') {
            return 1;
        }
    });
}, 30);
