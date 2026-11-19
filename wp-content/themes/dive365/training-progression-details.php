<?php
defined('ABSPATH') || exit;

function d365_progression_course_details(): array {
    return [
        'specialties' => [
            'topic_details' => [
                'peak-performance-buoyancy' => ['2本の実習でウエイトの量と位置を調整し、水平な姿勢や、同じ深さで止まる練習をします。水底に触れずに生き物を観察したい方にも役立ちます。', 'On two training dives, fine-tune your weighting and practice holding depth in a horizontal position. These skills help you observe marine life without touching the bottom.'],
                'underwater-navigator' => ['まず水面でコンパスを練習します。3本の実習では、進んだ距離を見積もり、地形を観察しながらボートや岸へ戻る練習をします。', 'Start with compass practice at the surface. On three training dives, estimate the distance you travel and use natural landmarks to find your way back to the boat or shore.'],
                'dry-suit-diver' => ['インナーの選び方や、スーツの手入れも学びます。限定水域で基本操作を練習し、2本の海洋実習で潜降・浮上に応用します。', 'Learn about choosing undergarments and caring for your suit. Practice the basic skills in confined water, then use them during descents and ascents on two open-water dives.'],
                'boat-diver' => ['2本のボートダイブで、船上での器材の置き方や船ごとのマナーを確認します。潜降ラインや、水面で位置を知らせるブイの使い方も練習します。', 'On two boat dives, learn where to stow your gear and follow the boat’s etiquette. Practice using descent lines and a surface marker buoy.'],
                'deep-diver' => ['PADIの条件は15歳以上で、アドベンチャー・ダイバーまたは同等資格が必要です。4本の実習でガス管理、窒素酔いへの対応や安全停止を学びます。講習の最大水深は40mです。', 'PADI requires divers to be at least 15 and hold Adventure Diver or a qualifying equivalent. Over four dives, work on gas management, responding to nitrogen narcosis and safety stops. The course depth limit is 40 m.'],
                'enriched-air-diver' => ['学科では、酸素の割合に応じた深度制限と潜水計画を学びます。実技で酸素濃度を測って記録し、ダイブコンピューターに設定します。PADIでは海洋ダイブはオプションです。', 'The theory covers planning and depth limits for a given oxygen blend. In hands-on training, analyze a cylinder, record its oxygen content and set your dive computer. Open-water dives are optional in the PADI course.'],
            ],
            'sections' => [
                [
                    ['伸ばしたいスキルを選ぶ', 'Choose a skill to develop'],
                    [
                        ['「写真を撮るときに姿勢が崩れる」「ボートから潜る日も落ち着いて準備したい」など、普段のダイビングで上達したい場面を考えてみましょう。テーマが決まったら、Cカードと最近のログをもとに参加条件を確認します。', 'Think of a situation where you want to improve, such as holding your position while taking photos or getting ready for a boat dive without feeling rushed. Once you choose a topic, check the prerequisites against your certification and recent dives.'],
                    ],
                ],
                [
                    ['教材で予習する', 'Study before training'],
                    [
                        ['指定の教材で、選んだコースに必要な知識を学びます。実習前にインストラクターと疑問点を確認し、器材の使い方や、その日に練習する内容を確認します。', 'Use the assigned materials to study the theory for your course. Before practice, go over your questions with your instructor and review the gear and skills you will use that day.'],
                    ],
                ],
                [
                    ['器材と海況に合わせて練習する', 'Practice with the right equipment and conditions'],
                    [
                        ['海洋実習では、うねりや視界、エントリーの方法を確認してから潜ります。新しい器材を使うコースでは、事前にサイズや操作を確かめます。コースによっては、陸上や限定水域での実技から始めます。', 'Before open-water training, review the swell, visibility and entry procedure. If the course uses new gear, check how it fits and operates before the dive. Some courses begin with practical work on land or in confined water.'],
                    ],
                ],
                [
                    ['実習の振り返りと認定', 'Debrief and certification'],
                    [
                        ['実習でできたことと、次のダイビングで意識することを振り返ります。選んだコースで定められた学科と実技を修了すると、そのスペシャルティの認定を受けられます。', 'Review what went well and what to work on during your next dive. You earn that specialty certification once you complete its required knowledge and practical work.'],
                    ],
                ],
            ],
            'checklist' => [
                ['興味のあるスペシャルティと、講習でできるようになりたいこと。', 'The specialty you are interested in and the skills you want to develop.'],
                ['Cカードとログブック。関連するアドベンチャー・ダイブを行った記録があれば、その記録もご用意ください。', 'Your certification card and logbook, including any relevant Adventure Dives you have completed.'],
                ['現在お持ちの器材とレンタルの希望。ドライスーツの場合は、試着やサイズについてもご相談ください。', 'The equipment you own and anything you would like to rent. For dry suits, ask about fitting and sizes.'],
            ],
            'faq' => [
                [
                    ['オープン・ウォーターのCカードで受講できますか？', 'Can I start with an Open Water Diver certification?'],
                    ['中性浮力、水中ナビゲーション、ボートなどは、PADIオープン・ウォーター・ダイバーから進めます。必要な資格や年齢はテーマごとに異なるため、ご希望の講習とCカードをお知らせください。', 'Open Water Divers can progress to specialties such as buoyancy, underwater navigation and boat diving. Minimum age and certification requirements vary, so tell us which course you want to take and what certification you hold.'],
                ],
                [
                    ['アドヴァンスド講習で似たテーマを選びました。実習はもう一度必要ですか？', 'I tried a related dive in Advanced Open Water. Can it count toward a specialty?'],
                    ['アドベンチャー・ダイブが、同じテーマのスペシャルティ実習の一部として認められる場合があります。該当するダイブのログをお持ちいただければ、インストラクターが確認します。', 'An Adventure Dive may count toward the corresponding specialty. Bring the dive record so your instructor can confirm whether it applies.'],
                ],
            ],
        ],
        'efr' => [
            'sections' => [
                [
                    ['事前学習と対面の練習', 'Independent study and hands-on practice'],
                    [
                        ['指定の教材で、救急隊が到着するまでにできるケアや、助けを呼ぶ際の基本を確認します。対面ではインストラクターの実演を見てから、練習用の器材を使って一つずつ練習します。', 'Use the assigned materials to review how to call for help and what care you can provide until emergency services arrive. In person, watch your instructor demonstrate each skill and then try it with training equipment.'],
                    ],
                ],
                [
                    ['一次ケア（CPR）', 'Primary Care (CPR)'],
                    [
                        ['命に関わる場面を想定し、現場の安全を確認して助けを呼ぶことから始めます。練習用のマネキンで心肺蘇生を練習し、窒息や大量出血、脊椎のけがが疑われる場合の対応も学びます。AEDの実習をご希望の方は、講習内容をお問い合わせください。', 'For potentially life-threatening emergencies, start by assessing scene safety and calling for help. Practice CPR with a manikin and learn to respond to choking, serious bleeding and suspected spinal injury. If you want hands-on AED training, ask whether it is included.'],
                    ],
                ],
                [
                    ['二次ケア（ファーストエイド）', 'Secondary Care (first aid)'],
                    [
                        ['けがをした人や体調を崩した人から話を聞き、様子を見て状態を把握します。包帯の使い方や、骨折・脱臼が疑われる場合の副木の扱いを練習します。', 'Practice asking an injured or ill person what happened and assessing their condition. Learn how to apply a bandage and use a splint when you suspect a fracture or dislocation.'],
                    ],
                ],
                [
                    ['場面を想定して練習', 'Practice in scenarios'],
                    [
                        ['倒れた人やけが人がいる場面を想定し、状況に合ったケアを選びます。声をかける、周りの人に協力を頼む、気づいたことを伝えるといったやり取りも練習します。', 'Work through scenarios involving someone who has collapsed or been injured and decide what care fits the situation. Practice speaking to the person, asking bystanders to help and communicating what you have observed.'],
                    ],
                ],
                [
                    ['修了後の復習と次の講習', 'Refreshing your skills after the course'],
                    [
                        ['EFRでは、スキルを保つために24か月ごとの復習を勧めています。レスキュー・ダイバーやダイブマスターに進む方は、CPRとファーストエイドの修了日を確認しておくと、手続きがスムーズです。', 'EFR recommends refreshing your skills every 24 months. If you plan to take Rescue Diver or Divemaster, check the completion date on your CPR and first aid record before enrolling.'],
                    ],
                ],
            ],
            'checklist' => [
                ['案内された教材で、対面講習の前に事前学習を済ませておきましょう。', 'Complete the assigned study before the in-person training.'],
                ['実技では床にひざをつく場面があるため、動きやすい服装でご参加ください。', 'Wear clothes you can move and kneel in for the practical exercises.'],
                ['更新やレスキュー講習の準備で受講する方は、前回の修了証や受講日がわかる記録。', 'If you are refreshing your skills or preparing for Rescue Diver, have your previous completion record or course date handy.'],
            ],
            'faq' => [
                [
                    ['ダイバー以外の人も受講できますか？', 'Can I take EFR if I don’t dive?'],
                    ['はい。CPRやファーストエイドを陸上で練習する講習で、ダイビングの経験やCカードは不要です。', 'Yes. You practice CPR and first aid on land, and you can take the course without any scuba experience or certification.'],
                ],
                [
                    ['他の団体の救急法講習を受けました。レスキューの条件に使えますか？', 'Will first aid training from another organization count toward Rescue Diver?'],
                    ['過去24か月以内に修了したCPRとファーストエイドの講習で、PADIの条件を満たすものは使えます。講習名・修了日・受講内容が確認できる資料をお知らせください。', 'Qualifying CPR and first aid training from another organization can count if completed in the past 24 months. Share a record that shows the course name, completion date and what it covered.'],
                ],
            ],
        ],
        'rescue' => [
            'sections' => [
                [
                    ['事前学習とトラブルの予防', 'Study and preventing problems'],
                    [
                        ['事前学習では、疲れや器材の違和感、ストレスなどのサインと、緊急時に必要な情報を整理します。実習ではバディ同士の声かけや事前の確認を通じて、問題が小さいうちに対応する練習をします。', 'During independent study, learn to recognize signs of fatigue, equipment trouble and stress and identify the information you need in an emergency. In practice, use buddy communication and pre-dive checks to deal with problems early.'],
                    ],
                ],
                [
                    ['セルフレスキューと水面でのアシスト', 'Self-rescue and surface assistance'],
                    [
                        ['水面で自分の浮力を確保するなど、まず落ち着いて行動する練習をします。そのうえで、疲れたダイバーやパニックを起こしたダイバーの様子を見て、自分の安全を保ちながら助ける方法を学びます。', 'Start by practicing how to stay calm and establish your own buoyancy at the surface. Then learn to assess a tired or panicked diver and help while maintaining your own safety.'],
                    ],
                ],
                [
                    ['水中での捜索と救助', 'Underwater search and rescue'],
                    [
                        ['行方がわからないダイバーを想定した捜索や、反応のないダイバーを水中で発見したときの対応を、インストラクターと練習します。水面での対応や、陸やボートへ引き上げる場面も扱います。', 'With your instructor, practice searching for a missing diver and responding when you find an unresponsive diver underwater. Training also covers surface care and getting the diver onto shore or a boat.'],
                    ],
                ],
                [
                    ['緊急アシストプランとシナリオ', 'Emergency assistance plan and scenarios'],
                    [
                        ['ダイブサイトで誰に連絡するか、救急隊にどこへ来てもらうか、使える器材は何かを整理します。PADIの講習では、セルフレスキューの復習と10項目の救助練習を行い、海洋での2つのシナリオで判断、連絡、救助、応急手当を組み合わせます。', 'For a dive site, work out whom to contact, where emergency services should meet you and what equipment is available. The PADI course includes a self-rescue review and 10 rescue exercises, followed by two open-water scenarios that bring together assessment, communication, rescue and first aid.'],
                    ],
                ],
                [
                    ['実習に進むための条件と認定', 'Eligibility for open-water training and certification'],
                    [
                        ['PADI（ジュニア）オープン・ウォーター・ダイバーは、学科と限定水域での練習から始められます。海洋での実習には、水中ナビゲーションのアドベンチャー・ダイブを含む所定の資格・実習記録が必要です。認定には講習課題の修了と、過去24か月以内に修了した所定のCPR・ファーストエイド講習が必要です。', 'PADI (Junior) Open Water Divers can begin the knowledge and confined-water exercises. For open-water rescue training, you need the qualifying certification and training record, including the Underwater Navigation Adventure Dive. For certification, complete the course skills and have qualifying CPR and first aid training from the past 24 months.'],
                    ],
                ],
            ],
            'checklist' => [
                ['Cカードとログブック。水中ナビゲーションのアドベンチャー・ダイブ、または同等の実習を確認できる記録。', 'Your certification card and logbook, including a record of the Underwater Navigation Adventure Dive or qualifying equivalent training.'],
                ['CPR・ファーストエイド講習の修了日と内容がわかる記録。必要な場合はEFRの受講もご相談ください。', 'A record showing the date and content of your CPR and first aid training. Ask about EFR if you need to complete it.'],
                ['指定された教材と、お持ちのダイビング器材。レンタルが必要なものは事前にお知らせください。', 'The assigned materials and the dive gear you own. Let us know in advance what you need to rent.'],
            ],
            'faq' => [
                [
                    ['どんなダイバーに向いていますか？', 'Who is Rescue Diver for?'],
                    ['バディと潜るときに、トラブルを予防し、困っている仲間をサポートしたい方に向いています。ダイブマスターに進む場合にも必要となるスキルを学べます。', 'It suits divers who want to prevent problems and support their buddies. The skills also prepare you for Divemaster if you decide to continue.'],
                ],
                [
                    ['CPRとファーストエイドを受けたのが2年以上前です。', 'What if I took CPR and first aid more than two years ago?'],
                    ['認定を受けるまでに、過去24か月以内の修了記録が必要です。お手持ちの記録と希望時期をお知らせいただければ、EFRの再受講も含めてご相談いただけます。', 'By certification, you need a record of qualifying CPR and first aid training completed within the previous 24 months. Share your record and preferred timing so we can discuss options, including an EFR refresher.'],
                ],
            ],
        ],
        'divemaster' => [
            'sections' => [
                [
                    ['ダイビングの知識を深める', 'Deepen your dive knowledge'],
                    [
                        ['潜水の物理・生理、器材や潜水計画について学び直し、ダイバーに説明できるよう理解を深めます。ダイブサイトでの安全管理や、ダイブマスターとして担当する役割も扱います。', 'Revisit dive physics and physiology, equipment and dive planning so you can explain them clearly to other divers. Study site safety and the responsibilities of a Divemaster.'],
                    ],
                ],
                [
                    ['水中での技能とデモンストレーション', 'Water skills and demonstrations'],
                    [
                        ['水泳や立ち泳ぎなどの水中能力、救助の技能、スクーバの基本スキルを確認します。器材の使い方などを、初めて見る人にも動きがわかるように実演する練習をします。', 'Work on water skills such as swimming and treading water, along with rescue and core scuba skills. Practice demonstrating skills, including equipment use, clearly enough for someone seeing them for the first time to follow.'],
                    ],
                ],
                [
                    ['ダイブサイトの準備とガイド実習', 'Dive site preparation and guiding practice'],
                    [
                        ['ダイブサイトの見取り図や緊急アシストプランを作り、ブリーフィングでルート、出入りの方法、安全上の注意点を伝える練習をします。ガイド実習では、ダイバーの様子と海況を確認し、グループ全体に目を配ります。', 'Map a dive site, prepare an emergency assistance plan and practice briefing divers on the route, entry and exit, and safety considerations. While guiding, monitor conditions and keep track of how the group is doing.'],
                    ],
                ],
                [
                    ['インストラクターのアシスト', 'Assisting an instructor'],
                    [
                        ['講習の準備や器材の確認を手伝い、インストラクターの指示のもとで受講者をサポートします。実習後は、どの場面で声をかけると伝わりやすかったか、次はどこに注意を向けるかを振り返ります。', 'Help prepare for training and check equipment, then support students under an instructor’s direction. Afterwards, review how you communicated with students and where to focus your attention next time.'],
                    ],
                ],
                [
                    ['ログと認定要件', 'Logged dives and certification'],
                    [
                        ['受講を始めるには40本、認定には60本以上の記録が必要です。認定に向けては、ログ本数に加え、学科、水中技能、ワークショップ、実習で定められた要件を満たします。開始前に現在のログを確認し、必要な経験と実習の進め方を相談しましょう。', 'You need at least 40 logged dives to start and 60 for certification. Certification also requires meeting the course standards for dive theory, water skills, workshops and practical assessments. Review your log with your instructor before starting to plan the experience and training you still need.'],
                    ],
                ],
            ],
            'checklist' => [
                ['レスキュー・ダイバーまたは同等資格のCカードとログブック。', 'Your Rescue Diver certification or qualifying equivalent and your logbook.'],
                ['過去24か月以内のCPR・ファーストエイド講習の修了記録と、過去12か月以内の医師によるダイビング許可。', 'Proof of CPR and first aid training within the past 24 months and physician clearance for diving within the past 12 months.'],
                ['お持ちの器材、今後積みたい経験、実習に参加できる時期。', 'A list of your gear, the experience you want to gain and when you are available to train.'],
            ],
            'faq' => [
                [
                    ['ダイビングの仕事をする予定がなくても受講できますか？', 'Can I enroll if I have no plans to work in diving?'],
                    ['はい。趣味で潜り続けながら、ダイブサイトの計画、グループの引率、スキルの実演などを学びたい方にも向いています。', 'Yes. It also suits recreational divers who want to learn how to plan dives at a site, lead groups and demonstrate skills.'],
                ],
                [
                    ['認定後はどんな活動につながりますか？', 'What can I do after certification?'],
                    ['ダイバーのガイドやインストラクターのアシストにつながる、PADIのプロ資格です。活動に必要な登録や条件は、予定している活動に合わせて確認しましょう。インストラクターを目指す場合は、次のプロ講習へのステップになります。', 'It is a PADI professional qualification that can lead to guiding certified divers and assisting instructors. Check the registration and other requirements for the work you plan to do. The certification also prepares you for further training if you want to become an instructor.'],
                ],
            ],
        ],
    ];
}
