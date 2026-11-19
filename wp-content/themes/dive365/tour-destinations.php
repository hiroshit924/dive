<?php
defined('ABSPATH') || exit;

function d365_tour_destinations(): array {
    return [
        'miura-zushi-hayama' => [
            'name' => ['三浦・逗子・葉山', 'Miura, Zushi & Hayama'],
            'headline' => ['週末は、神奈川の海へ。', 'A weekend on the Kanagawa coast.'],
            'description' => [
                '城ヶ島の入り組んだ岩場、小坪沖の華やかな魚群、葉山の浅瀬。近場の海で、今日の「見たい」を見つけよう。',
                'Explore the rocky reefs of Jogashima, schools of fish off Kotsubo and the shores of Hayama. Find a dive to match your mood close to Yokohama.',
            ],
            'photo' => 'tour-miura.webp',
            'spots' => [
                'jogashima' => [
                    'name' => ['城ヶ島', 'Jogashima'], 'location' => ['神奈川県三浦市', 'Miura, Kanagawa'],
                    'feature' => ['地形・マクロ', 'Rock formations & macro'], 'photo' => 'tour-miura.webp',
                    'description' => [
                        '岩の割れ目をのぞくと、小さな生き物の世界。岩礁に沿って泳ぎながら、季節の魚やウミウシを探すのが楽しい海です。',
                        'Peer into the cracks of rocky reefs for a tiny world of marine life. Look for seasonal fish and nudibranchs as you explore the varied terrain.',
                    ],
                    'point' => [35.13516, 139.61622],
                ],
                'kotsubo' => [
                    'name' => ['小坪', 'Kotsubo'], 'location' => ['神奈川県逗子市', 'Zushi, Kanagawa'],
                    'feature' => ['ボート・ソフトコーラル', 'Boat diving & soft coral'], 'photo' => 'tour-zushi.webp',
                    'description' => [
                        '小坪の港からボートで逗子沖へ。岩礁を彩るソフトコーラルの上を、魚の群れが流れていく。湘南の海をワイドに楽しみたい日に。',
                        'Take a boat from Kotsubo to the reefs off Zushi, where schools of fish sweep over colorful soft corals. A good pick for wide-angle views.',
                    ],
                    'point' => [35.29983, 139.56210], 'offset' => [-17, -12],
                ],
                'hayama' => [
                    'name' => ['葉山', 'Hayama'], 'location' => ['神奈川県葉山町', 'Hayama, Kanagawa'],
                    'feature' => ['ビーチ・季節の生き物', 'Shore diving & seasonal life'], 'photo' => 'tour-hayama.webp',
                    'description' => [
                        '浅瀬の岩場や海藻の間をゆっくり。小魚やウミウシを探しながら、季節ごとに表情が変わる海を楽しめます。',
                        'Take your time over shallow rocky reefs and through patches of seaweed. Small fish and nudibranchs reward a closer look, with something different each season.',
                    ],
                    'point' => [35.27500, 139.56565], 'offset' => [15, 14],
                ],
            ],
        ],
        'izu' => [
            'name' => ['伊豆', 'Izu'],
            'headline' => ['伊豆で、次の冒険を。', 'Find your next adventure in Izu.'],
            'description' => [
                '穏やかな湾で生き物探しも、魚群に包まれるボートダイブも。地形や沈船、外洋まで、潜るたびに違う景色が待っています。',
                'Look for tiny creatures in sheltered bays, swim past schools of fish, or explore rock formations and wrecks. The Izu Peninsula has a different dive around every bend.',
            ],
            'photo' => 'tour-izu.webp',
            'spots' => [
                'osezaki' => [
                    'name' => ['大瀬崎', 'Osezaki'], 'location' => ['静岡県沼津市', 'Numazu, Shizuoka'],
                    'feature' => ['湾内・生き物探し', 'Sheltered bay & marine life'], 'photo' => 'tour-izu.webp',
                    'description' => [
                        '岬に囲まれた湾内で、小魚や季節の生き物をじっくり観察。湾内・先端・外海で水中の景色が変わるので、何度潜っても楽しみが見つかります。',
                        'The sheltered bay is a rewarding place to look for small fish and seasonal visitors. The bay, headland and seaward sites each show a different side of Osezaki.',
                    ],
                    'point' => [35.03052, 138.78838], 'offset' => [-8, -11],
                ],
                'hirasawa' => [
                    'name' => ['平沢', 'Hirasawa'], 'location' => ['静岡県沼津市', 'Numazu, Shizuoka'],
                    'feature' => ['浅場・ビーチ', 'Shallows & shore diving'],
                    'description' => [
                        '奥駿河湾の比較的穏やかな浅場。砂地や岩場をゆっくり巡りたい日や、久しぶりのダイビングにも相談しやすい海です。',
                        'A relatively sheltered stretch of inner Suruga Bay with shallow sand and reefs. Ask us about it if you want an easy pace or are getting back into diving.',
                    ],
                    'point' => [35.01815, 138.84147], 'offset' => [10, 17],
                ],
                'tago' => [
                    'name' => ['田子', 'Tago'], 'location' => ['静岡県西伊豆町', 'Nishiizu, Shizuoka'],
                    'feature' => ['魚群・ボート', 'Schooling fish & boat diving'],
                    'description' => [
                        '外海には大きな根がそびえ、キンギョハナダイなどの群れが集まります。湾内のサンゴを眺めるダイブと、雰囲気の違いを楽しめるのも魅力です。',
                        'Offshore pinnacles draw schools of anthias and other fish. In the bay, coral communities make for a completely different dive.',
                    ],
                    'point' => [34.80145, 138.75665],
                ],
                'kumomi' => [
                    'name' => ['雲見', 'Kumomi'], 'location' => ['静岡県松崎町', 'Matsuzaki, Shizuoka'],
                    'feature' => ['岩のアーチ・ボート', 'Rock arches & boat diving'], 'photo' => 'tour-kumomi.webp',
                    'description' => [
                        '牛着岩の周りには、岩のアーチや入り組んだ地形。水面から差す光が岩の間に伸びる瞬間は、雲見ならではの見どころです。',
                        'Explore the sculpted rocks and arches around Ushitsuki-iwa. On a bright day shafts of sunlight between the rocks are a highlight.',
                    ],
                    'point' => [34.72524, 138.74592],
                ],
                'futo' => [
                    'name' => ['富戸', 'Futo'], 'location' => ['静岡県伊東市', 'Ito, Shizuoka'],
                    'feature' => ['ビーチ・砂地と岩礁', 'Shore diving, sand & reef'], 'photo' => 'tour-futo.webp',
                    'description' => [
                        'ヨコバマの砂地と岩場を巡りながら、季節の魚を探します。ワイドな景色も足元の小さな生き物も楽しみたい人に。',
                        'Look for seasonal fish as you move between sand and reef at Yokobama. There is plenty to see whether you prefer wide views or small creatures.',
                    ],
                    'point' => [34.89895, 139.13328],
                ],
                'mikomoto' => [
                    'name' => ['神子元島', 'Mikomoto Island'], 'location' => ['静岡県下田市沖', 'Off Shimoda, Shizuoka'],
                    'feature' => ['外洋・経験者向け', 'Open ocean · experienced divers'],
                    'description' => [
                        '黒潮の影響を受ける外洋で、回遊魚やハンマーヘッドシャークの目撃例も。潮流を伴う経験者向けのボートダイブで、経験本数や参加条件は事前にご確認ください。',
                        'Pelagic fish and hammerhead sharks are sometimes seen in these Kuroshio-influenced waters. This is a boat dive with currents for experienced divers. Ask about logged dives and requirements.',
                    ],
                    'point' => [34.57504, 138.94193],
                ],
                'atami' => [
                    'name' => ['熱海', 'Atami'], 'location' => ['静岡県熱海市', 'Atami, Shizuoka'],
                    'feature' => ['沈船・ボート', 'Wreck & boat diving'], 'photo' => 'tour-atami.webp',
                    'description' => [
                        '海底に眠る大きな沈船と、そのまわりに集まる魚。ソフトコーラルに彩られた地形も見どころです。沈船は資格・経験に応じてご案内します。',
                        'A large wreck rests on the seabed with schools of fish gathering around it. Soft corals add color to the rocky sites. Ask which sites suit your certification and experience.',
                    ],
                    'point' => [35.09433, 139.07947],
                ],
            ],
        ],
    ];
}
