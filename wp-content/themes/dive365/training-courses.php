<?php
defined('ABSPATH') || exit;

function d365_training_courses(): array {
    return [
        'open-water' => [
            'name' => ['オープン・ウォーター・ダイバー', 'Open Water Diver'],
            'lead' => ['初めてのCカード。器材の扱い方から、自分のペースで海に慣れていきます。', 'Earn your first certification and get comfortable underwater at your own pace.'],
            'price' => '¥79,000',
            'duration' => ['3〜4日が目安', 'Allow 3–4 days'],
            'requirements' => [
                ['15歳以上。ダイビングの経験やCカードがなくても参加できます。', 'Age 15 or above. You don’t need dive experience or a certification.'],
                ['水泳・浮力に関する確認があります。泳ぎに不安があれば、お申し込み前にご相談ください。', 'The course includes a swimming and floating assessment. Talk to us beforehand if you are unsure about your swimming.'],
            ],
            'steps' => [
                [['学科講習', 'Learn the basics'], ['器材の役割や、潜る前に知っておきたいルールを学びます。', 'Learn what the gear does and the safety concepts you need before diving.']],
                [['限定水域で練習', 'Practice in confined water'], ['プールや穏やかな浅場で、呼吸、耳抜き、器材の扱い、中性浮力などを練習します。', 'Practice breathing, equalization, equipment use and buoyancy in a pool or sheltered shallow water.']],
                [['海洋実習で4ダイブ', 'Four open-water dives'], ['練習したスキルを海で使い、インストラクターと一緒に実習を進めます。必要な課題を修了すると認定です。', 'Use what you’ve learned in the sea with your instructor. Certification follows when you complete the required skills.']],
            ],
            'includes' => ['講習料、施設使用料、教材費、器材レンタル代、タンク代、申請料', 'Instruction, facility fees, learning materials, equipment rental, tanks and the certification application fee'],
            'note' => ['成人の認定後の最大水深の目安は18mです。', 'The maximum depth for certified adult Open Water Divers is 18 m.'],
            'padi' => 'open-water-diver',
        ],
        'advanced' => [
            'name' => ['アドヴァンスド・オープン・ウォーター・ダイバー', 'Advanced Open Water Diver'],
            'lead' => ['Cカードを取ったその先へ。水中で行きたい場所、やってみたいことを増やす講習です。', 'Build on your first certification and discover new ways to enjoy the dives you want to do.'],
            'price' => '¥50,000',
            'duration' => ['2日が目安', 'Allow 2 days'],
            'requirements' => [
                ['15歳以上。PADIオープン・ウォーター・ダイバー、または同等資格が必要です。', 'Age 15 or above with a PADI Open Water Diver certification or a qualifying equivalent.'],
                ['認定団体や、最後に潜った時期に不安がある場合は、先にスタッフへご相談ください。', 'Ask us first if you are unsure about your certification equivalency or haven’t dived recently.'],
            ],
            'steps' => [
                [['潜り方を計画', 'Plan your dives'], ['興味のあるテーマと海況をもとに、選択ダイブを相談します。', 'Discuss which elective dives suit your interests and the conditions.']],
                [['必須の2ダイブ', 'Two required dives'], ['水中ナビゲーションとディープ。方向を見つけるスキルと、深度に合わせた計画・確認を学びます。', 'Underwater navigation and deep diving are required. Practice finding your way underwater and planning for depth.']],
                [['選択の3ダイブ', 'Three elective dives'], ['中性浮力や水中写真など、当日の条件や開催内容に合わせたテーマで、全部で5ダイブを行います。', 'Choose three electives, such as buoyancy or underwater photography, where conditions and local offerings allow, for five dives in total.']],
            ],
            'includes' => ['講習料、施設使用料、教材費、タンク代、申請料', 'Instruction, facility fees, learning materials, tanks and the certification application fee'],
            'note' => ['器材レンタルをご希望の方は、日程を相談する際にお知らせください。', 'Let us know when requesting dates if you would like to rent equipment.'],
            'padi' => 'advanced-open-water',
        ],
        'specialties' => [
            'name' => ['スペシャルティ', 'Specialty courses'],
            'lead' => ['「もっと楽に浮きたい」「行ける海を増やしたい」。興味のあるテーマをひとつ選んで、じっくり練習します。', 'Pick a skill that matters to you, whether it’s floating more comfortably or exploring different environments.'],
            'requirements' => [
                ['必要な資格・年齢・実習本数はコースによって異なります。興味のあるテーマと現在のCカードを添えてご相談ください。', 'Prerequisites, minimum ages and training dives vary by course. Tell us what you want to try and which certification you hold.'],
            ],
            'topics' => [
                [['ピーク・パフォーマンス・ボイヤンシー', 'Peak Performance Buoyancy'], ['ウエイトや姿勢を見直し、中性浮力を保ちやすくします。', 'Refine your weighting and body position so neutral buoyancy feels more natural.'], 'peak-performance-buoyancy'],
                [['水中ナビゲーション', 'Underwater Navigator'], ['コンパスや地形の目印を使って、水中で方向をつかみます。', 'Use a compass and natural landmarks to find your way underwater.'], 'underwater-navigator'],
                [['ドライスーツ', 'Dry Suit Diver'], ['ドライスーツの着方を覚え、スーツ内の空気と浮力を管理する練習をします。', 'Learn how to wear a dry suit and practice managing the air and buoyancy inside it.'], 'dry-suit-diver'],
                [['ボート・ダイバー', 'Boat Diver'], ['ボートで潜る日の準備や、船ごとに異なる乗り降りの流れに慣れていきます。', 'Get familiar with preparing for a boat dive and the entry and exit procedures used on different boats.'], 'boat-diver'],
                [['ディープ・ダイバー', 'Deep Diver'], ['深度に応じた計画と確認を、講習で少しずつ身につけます。', 'Learn how to plan and monitor dives at greater depths with an instructor.'], 'deep-diver'],
                [['エンリッチド・エア', 'Enriched Air Diver'], ['ナイトロックスの特徴と、使用前に必要な酸素濃度の確認などを学びます。', 'Learn how nitrox differs from air and what to check before using it.'], 'enriched-air-diver'],
            ],
        ],
        'efr' => [
            'name' => ['エマージェンシー・ファースト・レスポンス（EFR）', 'Emergency First Response (EFR)'],
            'lead' => ['海でも日常でも、もしものときに動けるように。応急手当を陸上で練習します。', 'Practice first aid on land so you can better respond to emergencies around diving and in everyday life.'],
            'requirements' => [
                ['ダイビング資格がなくても受講できるプログラムです。C365での開催方法・日程はお問い合わせください。', 'You can take this program without a dive certification. Contact C365 for scheduling and availability.'],
            ],
            'steps' => [
                [['一次ケア', 'Primary care'], ['緊急時の安全確認や、心肺蘇生（CPR）を練習します。', 'Practice assessing scene safety and performing CPR in training.']],
                [['二次ケア', 'Secondary care'], ['けがや体調不良に対するファーストエイドを学びます。', 'Learn first aid for injuries and illnesses.']],
                [['シナリオ練習', 'Scenario practice'], ['場面に応じて、声かけや応急手当を組み合わせて練習します。', 'Put communication and first-aid skills together in practice scenarios.']],
            ],
            'padi' => 'emergency-first-response-primary-and-secondary-care',
        ],
        'rescue' => [
            'name' => ['レスキュー・ダイバー', 'Rescue Diver'],
            'lead' => ['自分のことに慣れてきたら、仲間にも目を向ける練習を。トラブルの予防と対応を学びます。', 'Once you feel comfortable with your own diving, learn to spot problems early and help your buddy when needed.'],
            'requirements' => [
                ['認定には、水中ナビゲーション実習を修了したPADIアドベンチャー・ダイバー以上、または相当する資格が必要です。', 'Certification requires PADI Adventure Diver or higher with the underwater navigation dive completed, or a qualifying equivalent.'],
                ['認定には過去24か月以内のCPRとファーストエイド講習が必要です。EFRの受講についても相談できます。', 'Certification also requires CPR and first aid training completed within the past 24 months. Ask us about EFR if you need it.'],
            ],
            'steps' => [
                [['サインに気づく', 'Recognize the signs'], ['疲れやストレスのサインを知り、潜る前からトラブルを減らす方法を考えます。', 'Learn to recognize fatigue or stress and reduce problems before the dive begins.']],
                [['自分と仲間への対応', 'Self-rescue and buddy assistance'], ['自分が落ち着くためのスキルと、仲間を支える基本を練習します。', 'Practice self-rescue and the fundamentals of helping another diver.']],
                [['シナリオで実践', 'Rescue scenarios'], ['想定した場面を通して、状況の判断や周りとの連携を練習します。', 'Practice assessing situations and working with others in simulated scenarios.']],
            ],
            'padi' => 'rescue-diver',
        ],
        'divemaster' => [
            'name' => ['ダイブマスター', 'Divemaster'],
            'lead' => ['海の楽しさを、仲間と分かち合う側へ。ダイバーを支えるリーダーを目指すプロコースです。', 'Learn to support and lead other divers in PADI’s first professional-level course.'],
            'requirements' => [
                ['18歳以上。PADIレスキュー・ダイバーまたは同等資格が必要です。', 'Age 18 or above, with PADI Rescue Diver certification or a qualifying equivalent.'],
                ['ログは受講開始時に40本、認定時に60本以上。過去24か月以内のCPR・ファーストエイド講習と、過去12か月以内の医師のダイビング許可が必要です。', 'You need at least 40 logged dives to start and 60 for certification, current CPR and first aid within 24 months, and medical clearance within 12 months.'],
            ],
            'steps' => [
                [['知識と技術を深める', 'Build professional knowledge and skills'], ['ダイビングの知識を整理し、基本スキルの実演や水中での対応力を高めます。', 'Deepen your diving knowledge and work on demonstrating core skills and responding underwater.']],
                [['ダイバーをサポート', 'Support other divers'], ['ブリーフィング、引率、インストラクターのアシストを実習で学びます。', 'Practice briefing and leading divers and assisting an instructor.']],
            ],
            'padi' => 'divemaster',
        ],
    ];
}

function d365_padi_course_url(string $slug): string {
    return 'https://www.padi.com/ja/courses/' . $slug;
}
