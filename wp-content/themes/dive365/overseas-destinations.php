<?php
defined('ABSPATH') || exit;

function d365_overseas_destinations(): array {
    return [
        'palau' => [
            'name' => ['パラオ', 'Palau'],
            'description' => [
                '魚の群れが視界いっぱいに広がる外洋と、島々に囲まれた青い海。潮の流れや経験に合わせて、狙いたいポイントを選びます。',
                'Picture schools of fish filling your field of view offshore, then blue water dotted with islands on the boat ride back. Sites depend on currents and experience.',
            ],
            'points' => [
                [['ブルーコーナー', 'Blue Corner'], ['潮が当たる岬の先端。魚群や外洋の生き物を狙う、潮流のあるポイントです。', 'A current-swept reef corner where divers look for schools of fish and pelagic life.']],
                [['ジャーマンチャネル', 'German Channel'], ['水路周辺のクリーニングステーションで、マンタの目撃例も。', 'Manta rays are sometimes seen at cleaning stations near this channel.']],
                [['ブルーホール', 'Blue Holes'], ['リーフの開口部から光が差し込む地形。海況と経験に合わせてご案内します。', 'Light streams through openings in the reef. Suitability depends on conditions and experience.']],
            ],
        ],
        'phuket' => [
            'name' => ['プーケット', 'Phuket'],
            'description' => [
                'タイ・アンダマン海へ。ラチャ諸島の砂地とリーフ、ピピ諸島の石灰岩の地形。ボートで違う景色を見に行くのが楽しいエリアです。',
                'Head out into Thailand’s Andaman Sea for sandy slopes and reefs around the Racha Islands, or the limestone scenery of the Phi Phi Islands.',
            ],
            'points' => [
                [['ラチャヤイ島', 'Racha Yai'], ['湾内の砂地とリーフが見どころ。比較的落ち着いたポイントから相談できます。', 'Sandy bays and reefs offer options for a more relaxed dive when conditions allow.']],
                [['ラチャノイ島', 'Racha Noi'], ['外洋に近い青い海と岩の地形。潮や経験に合わせてポイントを選びます。', 'Blue offshore water and rocky terrain. Sites are chosen to match currents and experience.']],
                [['ピピ諸島', 'Phi Phi Islands'], ['石灰岩の島々の周りをボートで巡り、岩礁に集まる魚たちを探します。', 'Look for fish gathering around the reefs beneath limestone island scenery.']],
            ],
        ],
        'saipan' => [
            'name' => ['サイパン', 'Saipan'],
            'description' => [
                '青い光の地形派ポイントと、ゆっくり生き物を探せるビーチの両方が楽しめる島。',
                'An island of blue-lit rock formations and beach dives where you can slow down and look for marine life.',
            ],
            'points' => [
                [['グロット', 'The Grotto'], ['海につながる岩の開口部に青い光が差し込む名所。海況や参加条件は事前に確認します。', 'Blue light pours through openings to the sea. We check conditions and eligibility before planning a dive here.']],
                [['ラウラウビーチ', 'Lau Lau Bay'], ['ビーチから入る湾。リーフや砂地を巡り、魚の群れや小さな生き物を探します。', 'A shore-entry bay with reef, sand, schooling fish and smaller marine life.']],
            ],
        ],
        'bali' => [
            'name' => ['バリ', 'Bali'],
            'description' => [
                'ビーチから見に行ける沈船、のんびり巡るリーフ、流れのある離島。エリアごとに景色ががらりと変わります。',
                'A shore-accessible wreck, relaxed reefs and offshore sites with stronger currents make for very different dives around Bali.',
            ],
            'points' => [
                [['トランベン', 'Tulamben'], ['海岸から入ってリバティ号の沈船へ。船体を覆う生き物や周りを泳ぐ小魚が見どころです。', 'Enter from shore to see the USAT Liberty wreck, with marine life growing over the hull and small fish swimming around it.']],
                [['アメッド', 'Amed'], ['リーフや砂地をゆっくり巡り、色鮮やかな生き物を探します。', 'Take a slower dive along reefs and sand to look for colorful marine life.']],
                [['ヌサペニダ', 'Nusa Penida'], ['マンタの目撃例がある海域。ポイントによって潮流が強まるため、経験や海況を見てご案内します。', 'Mantas are sometimes seen here. Currents can be strong at some sites, so plans depend on experience and conditions.']],
            ],
        ],
    ];
}
