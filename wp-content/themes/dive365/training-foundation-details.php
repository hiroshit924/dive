<?php
defined('ABSPATH') || exit;

function d365_foundation_course_details(): array {
    return [
        'open-water' => [
            'sections' => [
                [
                    ['受講前の学科と予習', 'Studying before training'],
                    [
                        ['教材で、水圧が体や器材にどう影響するか、耳抜きの考え方、バディとの合図、潜る前の確認事項を学びます。章ごとの問題に取り組み、わかりにくかったところはインストラクターと確認します。学科の最終テストで理解度を確かめます。', 'Use your course materials to learn how water pressure affects your body and gear, how equalization works, and how to communicate with your buddy and prepare for a dive. Work through the review questions, bring anything you’re unsure about to your instructor and check your understanding on the final knowledge exam.'],
                        ['日程を組むときに、希望日と水泳や健康面で気になることをお知らせください。事前学習の進め方と、実習までに必要な準備をご案内します。', 'When you ask about dates, let us know about any concerns with swimming or health. We’ll go over the study plan and what you need before the in-water sessions.'],
                    ],
                ],
                [
                    ['限定水域でのスキル練習', 'Confined-water practice'],
                    [
                        ['プールや穏やかな浅場で、器材の組み立てとバディチェックから始めます。水中での呼吸や耳抜き、マスクに入った水を出す練習、レギュレーターを探してくわえ直す練習を一つずつ進めます。', 'Start in a pool or calm, shallow water by assembling your gear and doing a buddy check. Then practice breathing and equalizing underwater, clearing water from your mask, and recovering your regulator.'],
                        ['浮力調整装置（BCD）を使った浮力の調整や、潜降・浮上、バディと予備の空気源を使う練習も行います。海に出る前に、わからない動作を繰り返して確かめられます。', 'You’ll also practice controlling buoyancy with your BCD, descending and ascending, and sharing an alternate air source with your buddy. You can repeat unfamiliar skills with your instructor before taking them into the sea.'],
                    ],
                ],
                [
                    ['海洋実習の1・2本目', 'Open-water dives 1 and 2'],
                    [
                        ['当日の海況と出入りの方法を確認し、インストラクターと海に入ります。バディと合図を交わしながら、耳抜きや浮力調整など、浅場で覚えた動きを海で練習します。', 'Your instructor will brief you on the conditions and how to enter and exit before you get in. Check in with your buddy using hand signals as you practice equalizing and adjusting your buoyancy in the sea.'],
                        ['陸に戻ったら、潜った深さや時間、できたことを振り返ります。次のダイブで意識したいことをインストラクターと整理します。', 'After the dive, review your depth, time and how the skills went. Your instructor will help you decide what to focus on during the next dive.'],
                    ],
                ],
                [
                    ['海洋実習の3・4本目と認定', 'Open-water dives 3 and 4'],
                    [
                        ['実習の後半は、バディとダイブの計画を確認し、深度や残圧を見ながら泳ぎます。浮力や方向の確認など、それまで練習してきたスキルを一つのダイブの中で使います。', 'On the later dives, review the plan with your buddy and monitor your depth and remaining air as you swim. Put the skills you’ve practiced so far together, including buoyancy and keeping track of where you are.'],
                        ['C365では全体で3〜4日が目安です。例えば学科と限定水域の練習を進めたあと、海洋実習の1日目に2本、2日目に2本潜ります。習熟度や海況に合わせて日程を調整し、学科と必要な実技を修了するとPADIオープン・ウォーター・ダイバーに認定されます。', 'Allow 3–4 days with C365. A typical schedule starts with knowledge development and confined-water practice, followed by two open-water dives on each of the two remaining days. The schedule can vary with your progress and sea conditions. Once you complete the required knowledge and in-water skills, you earn your PADI Open Water Diver certification.'],
                    ],
                ],
            ],
            'checklist' => [
                ['水着、タオル、ビーチサンダル、着替え', 'Swimwear, towel, sandals and a change of clothes'],
                ['案内された教材と学科の解答、筆記用具', 'Course materials, completed study work and something to write with'],
                ['記入済みの健康チェック用紙と、必要な場合は医師の診断書', 'Completed medical questionnaire and physician clearance if required'],
                ['飲み水、海から上がった後に羽織れる上着', 'Drinking water and a warm layer for after the dive'],
            ],
            'faq' => [
                [
                    ['どれくらい泳げれば参加できますか？', 'How well do I need to swim?'],
                    ['PADIの水泳確認では、続けて200m泳ぐか、マスク・スノーケル・フィンを使って300m泳ぎます。制限時間はありません。別に、10分間浮くか立ち泳ぎをする確認もあります。泳ぎに不安がある方は、予約前にご相談ください。', 'The PADI swim assessment is a continuous 200 m swim or a 300 m swim with a mask, snorkel and fins. There’s no time limit. You’ll also float or tread water for 10 minutes. If you’re unsure about your swimming, talk with us before booking.'],
                ],
                [
                    ['自分のダイビング器材は必要ですか？', 'Do I need to own scuba gear?'],
                    ['C365の受講料には器材レンタル代が含まれます。度付きマスクの希望や、普段使うマスクなどの持ち込みがあれば、日程を相談するときにお知らせください。', 'Equipment rental is included in the C365 course fee. When you ask about dates, let us know if you need a prescription mask or want to bring a mask or other gear you already use.'],
                ],
                [
                    ['Cカードを取ったら、どこまで潜れますか？', 'What can I do with my certification?'],
                    ['認定後は、講習で経験した範囲に近い条件で、バディとレクリエーショナルダイビングを楽しめます。最大水深の目安は18mです。久しぶりのダイビングや、慣れていない場所で潜るときは、現地のスタッフに経験を伝えて相談しましょう。', 'You can dive with a buddy in conditions similar to those in which you trained, within the 18 m depth limit. If you’re returning after a break or trying an unfamiliar site, tell the local dive team about your experience and discuss the conditions with them.'],
                ],
            ],
        ],
        'advanced' => [
            'sections' => [
                [
                    ['5ダイブに向けた準備', 'Preparing for your five dives'],
                    [
                        ['水中ナビゲーションとディープの2本に、興味に合わせた選択ダイブ3本を加えます。今のCカード、最近潜った時期、できるようになりたいことを伝えると、インストラクターと実習内容を相談しやすくなります。', 'The course combines two required dives, underwater navigation and deep diving, with three electives. Share your certification, when you last dived, and what you’d like to get better at so your instructor can help choose the dives.'],
                        ['実習前に各テーマの教材を読み、知識の復習を進めます。当日は器材や海況に応じた注意点と、各ダイブで練習する内容を確認します。', 'Before the in-water sessions, study the materials and complete the knowledge reviews for your topics. At the site, your instructor will brief you on the equipment, conditions and skills for each dive.'],
                    ],
                ],
                [
                    ['必須の水中ナビゲーション', 'Underwater navigation'],
                    [
                        ['陸上でコンパスの使い方を確認してから、水中で進む方向を決め、行きと帰りのコースを練習します。岩や砂地の境目なども目印にし、バディと現在地や進む方向を確かめます。', 'Rehearse with a compass on land, then use it underwater to set a heading and follow a route out and back. Use landmarks such as rocks or the edge of a sandy area, and check your position and direction with your buddy.'],
                        ['ダイブ後は、どの目印が役立ったか、どこで方向がわかりにくくなったかを振り返ります。初めてのポイントでブリーフィングを聞くときにも役立つスキルです。', 'Afterwards, review which landmarks helped and where it was harder to keep your bearings. You’ll use those same skills when you listen to a briefing at a new site.'],
                    ],
                ],
                [
                    ['必須のディープダイブ', 'Deep diving'],
                    [
                        ['オープン・ウォーターの範囲より深い水域へ、インストラクターと潜ります。深くなると色の見え方や空気の消費がどう変わるかを観察し、予定の最大深度と時間、残圧を確認しながら潜ります。', 'Dive beyond the Open Water depth range with your instructor. Observe how depth changes the appearance of colors and affects air consumption while monitoring your depth, time and remaining air against the dive plan.'],
                        ['より深い海での潜降・浮上や、バディとの合図を練習します。15歳以上の認定後は、30mを上限に、ディープの実習で到達した深度までが目安です。実習の深度はポイントや海況、経験に合わせて決めます。', 'Practice descents, ascents and buddy communication on a deeper dive. Once certified, divers aged 15 and up can dive to the depth reached on their Deep Adventure Dive, up to 30 m. Your instructor sets the training depth based on the site, conditions and your experience.'],
                    ],
                ],
                [
                    ['3つの選択ダイブ', 'Choosing three elective dives'],
                    [
                        ['中性浮力を練習するピーク・パフォーマンス・ボイヤンシーでは、ウエイトの量と位置、泳ぐ姿勢を見直します。水中写真では、浮力を保ちながら被写体に近づき、撮影の基本を試します。', 'Peak Performance Buoyancy gives you practice with weighting, weight placement and body position. Underwater photography introduces basic camera skills while you maintain buoyancy and approach a subject carefully.'],
                        ['PADIの選択ダイブには、ボート、ナイト、水中ナチュラリストなどもあります。例えば水中ナチュラリストでは、生き物が暮らす場所や行動を観察します。当日の海況や開催ポイントに合わせて、実施できるテーマをご案内します。', 'Other PADI electives include boat diving, night diving and underwater naturalist. On a naturalist dive, for example, you observe marine life, its habitat and how it behaves. Ask which topics are available for the site and conditions on your dates.'],
                    ],
                ],
                [
                    ['海洋実習の2日間', 'A sample two-day schedule'],
                    [
                        ['例えば1日目に3本、2日目に2本の実習を行います。毎回、陸上でそのダイブの目標と手順を確認してから潜り、終わったらうまくいったことや次に練習したいことをログにまとめます。', 'A sample schedule is three dives on day one and two on day two. Each dive starts with a briefing on the goal and plan. Afterwards, log what went well and what you want to work on next.'],
                        ['潜る順番や本数の配分は、海況や選んだテーマに合わせて決めます。必須2本と選択3本の知識学習・実技を修了すると、PADIアドヴァンスド・オープン・ウォーター・ダイバーに認定されます。', 'The sequence and number of dives each day depend on conditions and the topics you choose. Complete the knowledge reviews and in-water skills for both required dives and all three electives to earn your PADI Advanced Open Water Diver certification.'],
                    ],
                ],
            ],
            'checklist' => [
                ['現在のCカードとログブック、またはアプリなどで確認できるログ', 'Your current certification card and a logbook or digital dive log'],
                ['案内された教材と各テーマの解答、筆記用具', 'Course materials, completed reviews for your dive topics and something to write with'],
                ['水着、タオル、ビーチサンダル、着替え、飲み水', 'Swimwear, towel, sandals, a change of clothes and drinking water'],
                ['使用するダイビング器材。レンタルやテーマごとの追加器材は事前に確認', 'The dive gear you’ll use. Check rentals and any gear needed for your electives in advance.'],
                ['記入済みの健康チェック用紙と、必要な場合は医師の診断書', 'Completed medical questionnaire and physician clearance if required'],
            ],
            'faq' => [
                [
                    ['オープン・ウォーターを取ったばかりでも受講できますか？', 'Can I enroll just after getting my Open Water certification?'],
                    ['はい。オープン・ウォーター認定後、すぐに受講できます。C365では、15歳以上でPADIオープン・ウォーター・ダイバーまたは同等資格をお持ちの方が対象です。', 'Yes, you can enroll as soon as you complete your Open Water certification. At C365 you can apply from age 15 with a PADI Open Water Diver certification or a qualifying equivalent.'],
                ],
                [
                    ['他の認定団体のCカードでも参加できますか？', 'Can I enroll with a card from another agency?'],
                    ['同等の認定資格で受講できます。お申し込み前に、認定団体とカードに表示された資格名をお知らせください。ログとあわせて参加条件を確認します。', 'A qualifying equivalent certification can meet the prerequisite. Send us the agency and certification name shown on your card so we can check the requirements with you and review your dive log.'],
                ],
                [
                    ['選択ダイブはスペシャルティにつながりますか？', 'Can an elective count toward a specialty?'],
                    ['PADIのアドベンチャー・ダイブは、対応するスペシャルティ・コースの最初のダイブに充当できる場合があります。続けて受講したいテーマがあれば、インストラクターにお知らせください。', 'A PADI Adventure Dive may count as the first dive in the corresponding Specialty Diver course. Tell your instructor if you’d like to continue with that topic.'],
                ],
            ],
        ],
    ];
}
