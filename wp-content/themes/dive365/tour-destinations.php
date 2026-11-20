<?php
defined('ABSPATH') || exit;

function d365_tour_destinations(): array {
    return [
        'miura-zushi-hayama' => [
            'name' => ['逗子・葉山・城ヶ島', 'Zushi, Hayama & Jogashima'],
            'headline' => ['週末は、神奈川の海へ。', 'A weekend on the Kanagawa coast.'],
            'description' => [
                '城ヶ島の入り組んだ岩場、小坪沖の華やかな魚群、葉山の浅瀬。近場の海で、今日の「見たい」を見つけよう。',
                'Explore the rocky reefs of Jogashima, schools of fish off Kotsubo and the shores of Hayama. Find a dive to match your mood close to Yokohama.',
            ],
            'photo' => 'tour-miura.webp',
            'photo_caption' => ['城ヶ島', 'Jogashima'],
            'spots' => [
                'jogashima' => [
                    'name' => ['城ヶ島', 'Jogashima'], 'location' => ['神奈川県三浦市', 'Miura, Kanagawa'],
                    'feature' => ['地形・マクロ', 'Rock formations & macro'], 'photo' => 'tour-miura.webp',
                    'description' => [
                        '岩の割れ目をのぞくと、小さな生き物の世界。岩礁に沿って泳ぎながら、季節の魚やウミウシを探すのが楽しい海です。',
                        'Peer into the cracks of rocky reefs for a tiny world of marine life. Look for seasonal fish and nudibranchs as you explore the varied terrain.',
                    ],
                    'highlights' => [
                        '岩棚の上では海藻の間を小魚が行き来し、すき間をじっと見ていると、岩の色に溶け込む生き物が見えてきます。ウミウシや小さな魚を探すのが好きな方に。地形を広く眺めたい日は、海況や経験に合わせて潜り方を相談できます。',
                        'Small fish slip through the seaweed on the ledges, while camouflaged creatures come into focus if you pause and look into the cracks. It’s a good choice for nudibranchs and other small finds. Ask about wider reef views if you’d rather take in the terrain.',
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
                    'highlights' => [
                        '水中の根を少し離れて眺めると、色の違うソフトコーラルと、その上を行き来する魚の群れを一緒に楽しめます。近づいて細部を見るのも、少し引いて根の全体を見渡すのも面白いところ。ボートが初めてなら、参加経験を添えてご相談ください。',
                        'Step back from a reef outcrop for a view of soft corals in several colors, with schools passing overhead. Move closer for the details or stay back to appreciate the whole reef. If this would be your first boat dive, tell us about your experience when you ask.',
                    ],
                    'point' => [35.29983, 139.56210], 'offset' => [-17, -12],
                ],
                'hayama' => [
                    'name' => ['葉山', 'Hayama'], 'location' => ['神奈川県葉山町', 'Hayama, Kanagawa'],
                    'feature' => ['ビーチ・ボート', 'Shore & boat diving'], 'photo' => 'tour-hayama.webp',
                    'description' => [
                        'ビーチでは浅瀬の岩場や海藻の間で、小魚やウミウシなど季節の生き物を探せます。ボートでは沖のポイントへ出て、岩礁や魚の群れを楽しめます。',
                        'On a shore dive, look for small fish, nudibranchs and other seasonal life among shallow rocks and seaweed. On a boat dive, head offshore to explore reefs and look for schools of fish.',
                    ],
                    'highlights' => [
                        '浅い場所でじっくり観察したい方はビーチへ、沖の地形を広く眺めたい方はボートへ。ご希望とダイビング経験をお知らせください。風やうねりに合わせて、その日のポイントをご案内します。',
                        'Choose a shore dive for a closer look at life in the shallows or a boat dive for a wider view of the offshore reefs. Tell us what you’d like to see and share your diving experience. We’ll suggest a site based on wind and swell.',
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
            'photo_caption' => ['大瀬崎', 'Osezaki'],
            'spots' => [
                'osezaki' => [
                    'name' => ['大瀬崎', 'Osezaki'], 'location' => ['静岡県沼津市', 'Numazu, Shizuoka'],
                    'feature' => ['湾内・生き物探し', 'Sheltered bay & marine life'], 'photo' => 'tour-izu.webp',
                    'description' => [
                        '岬に囲まれた湾内で、小魚や季節の生き物をじっくり観察。湾内・先端・外海で水中の景色が変わるので、何度潜っても楽しみが見つかります。',
                        'The sheltered bay is a rewarding place to look for small fish and seasonal visitors. The bay, headland and seaward sites each show a different side of Osezaki.',
                    ],
                    'highlights' => [
                        '湾内の砂地と岩場は、ゆっくり進むだけでも見える生き物が変わります。小さな被写体を探す日には湾内、違う地形や魚の群れが見たい日には条件に合う場所を選ぶ、という楽しみ方も。久しぶりの方は湾内からのんびり始めるプランをご相談ください。',
                        'Even a short swim between the sandy and rocky areas in the bay changes what you can spot. Focus on small subjects inside the bay or choose a site with different terrain and schools of fish, when conditions allow. Ask about starting in the bay if you’re coming back after a break.',
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
                    'highlights' => [
                        '砂地では遠くまで見渡せることもあり、岩や海藻の周りでは小魚が行き来します。泳ぎ回るより、浅い場所で器材や浮力の感覚を取り戻しながら生き物も見たい日に向いています。ゆっくり潜りたい方は、久しぶりであることや気になる点を教えてください。',
                        'The sand can offer open views, and small fish gather around the rocks and seaweed. It’s a good place to ask about easing back into equipment and buoyancy in shallow water while still seeing marine life. Tell us how long it has been since your last dive and what you’d like to work on.',
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
                    'highlights' => [
                        '外海の根は、地形を背景に色鮮やかな魚の群れをワイドに眺めたい人におすすめです。湾内ではサンゴの周りにいる小魚を探しながら、より落ち着いた景色を楽しめます。ポイントで潮の流れも違うので、海況とボートダイブの経験に合わせて選びます。',
                        'The offshore pinnacles are a great backdrop for wide-angle views of colorful schools of fish. Inside the bay, slow down and look for little fish around the corals. Currents differ across sites, so we’ll consider sea conditions and your boat diving experience.',
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
                    'highlights' => [
                        '大きな岩が重なってできた通り道を外側から見るだけでも、岩の影と青い海の境目がきれいです。岩の表面にいる小さな生き物や、すき間に集まる魚にも注目。通り方や潜る範囲は、海況や地形ダイブの経験に合わせてご案内します。',
                        'Even from outside, the gaps formed by overlapping rocks make a striking frame for the blue water. Look closely at the rock surfaces and the fish gathering in the crevices. We’ll choose a route and range that suit conditions and your experience around this terrain.',
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
                    'highlights' => [
                        '砂地では底に隠れている魚を探し、岩場では小魚の群れや季節の生き物を観察できます。砂地と岩場が近いので、ひと潜りで違う景色を楽しみたい方におすすめ。水中写真が好きなら、海況に合わせてゆっくり被写体を探すプランも相談できます。',
                        'Look for fish hiding in the sand, then explore the rocky areas for schooling fish and seasonal visitors. With the two habitats close together, one dive can offer very different views. If you like underwater photography, ask for a route with time to look for subjects when conditions allow.',
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
                    'highlights' => [
                        '離島の周りには沖の根が続き、流れの中を回遊魚の群れが横切ることがあります。大物の姿は潮や季節次第。流れのあるボートダイブへの慣れが必要なので、検討している方は認定資格やログ本数、最近のダイビング経験を先にお知らせください。',
                        'Offshore reefs surround the island, and schools of open-water fish may pass in the current. Encounters depend on the season and tide. This is for divers comfortable with current and boat diving, so share your certification, logged dives and recent experience before making plans.',
                    ],
                    'point' => [34.57504, 138.94193],
                ],
            ],
        ],
        'hatsushima' => [
            'name' => ['初島・熱海', 'Hatsushima & Atami'],
            'booking_destination' => 'hatsushima-atami',
            'headline' => ['初島の岩礁、熱海の沈船。', 'Reefs off Hatsushima, wreck diving in Atami.'],
            'description' => [
                '初島では岸から海に入り、岩礁や砂地で季節の生き物を探します。熱海ではボートで沖へ出て、魚の群れが集まる沈船や岩礁を潜ります。',
                'Explore rocky reefs and sandy seabeds on a shore dive off Hatsushima, or take a boat out from Atami to dive reefs and look for schools of fish around the wreck.',
            ],
            'photo' => 'tour-hatsushima.webp',
            'photo_caption' => ['沖から見た初島', 'Hatsushima from the water'],
            'access' => [
                '横浜の Diving Shop C365 に集合し、無料送迎で熱海へ。熱海で潜る場合は現地でダイビングボートに乗り、初島で潜る場合は熱海港から約30分の定期船で初島港へ渡ります。',
                'Meet at Diving Shop C365 in Yokohama for the free shuttle to Atami. For Atami dives, board the dive boat locally. For Hatsushima, take the ferry from Atami Port to the island, about 30 minutes away.',
            ],
            'access_url' => 'https://www.hatsushima.jp/access/',
            'map_url' => 'https://www.google.com/maps/search/?api=1&query=Hatsushima%2C%20Atami',
            'spots' => [
                'hatsushima' => [
                    'name' => ['初島', 'Hatsushima'], 'location' => ['静岡県熱海市', 'Atami, Shizuoka'],
                    'feature' => ['ビーチ・岩礁と砂地', 'Shore diving, reef & sand'],
                    'photo' => 'tour-hatsushima.webp',
                    'description' => [
                        '代表的なビーチポイントのフタツネでは、岩場を行き来する魚の群れを眺めたり、岩のすき間や砂地にいる生き物を探したりできます。',
                        'At Futatsune, one of the island’s main shore dive sites, watch schools of fish move over the rocks and look for smaller creatures in crevices and across the sand.',
                    ],
                    'highlights' => [
                        '同じポイントでも、季節や潮で出会う生き物が変わります。魚の群れを広く眺めたい方も、水中写真を撮りながらゆっくり巡りたい方も、ご希望をお聞かせください。潜る場所や深さは、当日の海況と経験に合わせてご案内します。',
                        'What you see varies with the season and the tide. Let us know if you’d like to look for schools of fish or take your time with underwater photography. We’ll choose the site and depth according to sea conditions and your experience.',
                    ],
                    'point' => [35.0403, 139.1695], 'offset' => [12, 0],
                ],
                'atami' => [
                    'name' => ['熱海', 'Atami'], 'location' => ['静岡県熱海市', 'Atami, Shizuoka'],
                    'feature' => ['沈船・ボート', 'Wreck & boat diving'], 'photo' => 'tour-atami.webp',
                    'description' => [
                        '海底に眠る大きな沈船と、そのまわりに集まる魚。ソフトコーラルに彩られた地形も見どころです。沈船は資格・経験に応じてご案内します。',
                        'A large wreck rests on the seabed with schools of fish gathering around it. Soft corals add color to the rocky sites. Ask which sites suit your certification and experience.',
                    ],
                    'highlights' => [
                        '沈んだ「旭16号」は全長約81m。船体の輪郭が見えてくると、その大きさを実感できます。周りの魚や、岩に付くソフトコーラルも写真に収めたくなる景色です。沈船周辺と岩礁のどちらを楽しめるか、深度や経験を踏まえて相談しましょう。',
                        'The wreck of the Asahi Maru No. 16 was about 81 meters long. Its scale becomes clear as the outline comes into view. Fish around the wreck and soft corals on rocky sites offer very different sights. Ask which fits your certification, experience and depth range.',
                    ],
                    'point' => [35.09433, 139.07947],
                ],
            ],
        ],
    ];
}
