<?php
defined('ABSPATH') || exit;

require_once get_theme_file_path('training-foundation-details.php');
require_once get_theme_file_path('training-progression-details.php');

$course = $args['course'];
$course_id = $args['course_id'];
$availability = $args['availability'];
$details = (d365_foundation_course_details() + d365_progression_course_details())[$course_id];
$photo = [
    'open-water' => ['tour-futo.webp', '富戸での体験ダイビング・オープンウォーター講習', 'Introductory diving and Open Water training at Futo', 768, 576],
    'advanced' => ['training-advanced.webp', 'Diving Shop C365のアドヴァンスド講習', 'Advanced Open Water training with Diving Shop C365', 768, 1024],
][$course_id] ?? null;
$links = [
    'course-details' => ['参加条件・料金', 'Requirements and price'],
    'course-flow' => isset($course['topics']) ? ['テーマを選ぶ', 'Specialty topics'] : ['講習の流れ', 'Training sequence'],
    'course-guide' => ['学ぶこと', 'What you’ll learn'],
    'course-prep' => ['事前準備・持ち物', 'Preparation and what to bring'],
    'course-faq' => ['よくある質問', 'FAQs'],
];
?>
<nav class="training-contents" aria-label="<?= esc_attr(d365_text('この講習の案内', 'On this course page')) ?>">
    <ul class="wrap">
        <?php foreach ($links as $anchor => $label): ?>
            <li><a href="#<?= esc_attr($anchor) ?>"><?= esc_html(d365_text(...$label)) ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<section class="section training-section" id="course-details">
    <div class="wrap training-detail-grid">
        <div>
            <h2><?php d365_label('参加条件', 'Requirements'); ?></h2>
            <ul class="training-requirements">
                <?php foreach ($course['requirements'] as $requirement): ?><li><?= esc_html(d365_text(...$requirement)) ?></li><?php endforeach; ?>
            </ul>
            <?php if (isset($course['price'])): ?>
                <p class="course-note"><?php d365_label('参加前に健康状態を確認します。C365では60歳以上の方に医師の診断書をお願いしています。', 'We check your health questionnaire before training. C365 asks participants aged 60 and above to provide medical clearance.'); ?></p>
            <?php endif; ?>
        </div>
        <aside class="course-card training-price">
            <h2><?php d365_label('料金・日数', 'Price and duration'); ?></h2>
            <?php if (isset($course['price'])): ?>
                <p class="course-price"><?= esc_html($course['price']) ?> <small><?php d365_label('税込', 'tax included'); ?></small></p>
                <p><?= esc_html(d365_text(...$course['duration'])) ?></p>
                <h3><?php d365_label('料金に含まれるもの', 'What is included'); ?></h3>
                <p><?= esc_html(d365_text(...$course['includes'])) ?></p>
                <p class="course-note"><?= esc_html(d365_text(...$course['note'])) ?></p>
            <?php else: ?>
                <p class="course-price"><?= esc_html($availability) ?></p>
                <p><?php d365_label('C365での開催可否、日数、費用はコースごとにご案内します。', 'Contact C365 for local availability, duration and a price for your course.'); ?></p>
            <?php endif; ?>
            <?php if (isset($course['padi'])): ?>
                <a class="text-link" href="<?= esc_url(d365_padi_course_url($course['padi'])) ?>"><?php d365_label('PADI公式のコース案内', 'Official PADI course (Japanese)'); ?> <span aria-hidden="true">↗</span></a>
            <?php endif; ?>
        </aside>
    </div>
</section>
<section class="section training-practice" id="course-flow">
    <div class="wrap">
        <?php if (isset($course['topics'])): ?>
            <h2><?php d365_label('テーマから選ぶ', 'Explore specialty topics'); ?></h2>
            <div class="course-grid">
                <?php foreach ($course['topics'] as [$name, $detail, $slug]): ?>
                    <article class="course-card">
                        <h3><?= esc_html(d365_text(...$name)) ?></h3>
                        <p><?= esc_html(d365_text(...$detail)) ?></p>
                        <?php if (isset($details['topic_details'][$slug])): ?>
                            <p><?= esc_html(d365_text(...$details['topic_details'][$slug])) ?></p>
                        <?php endif; ?>
                        <a class="text-link" href="<?= esc_url(d365_padi_course_url($slug)) ?>"><?php d365_label('PADI公式の詳細', 'PADI details (Japanese)'); ?> <span aria-hidden="true">↗</span></a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h2><?php d365_label('講習の流れ', 'How the course works'); ?></h2>
            <ol class="training-steps">
                <?php foreach ($course['steps'] as [$name, $detail]): ?>
                    <li class="course-card">
                        <h3><?= esc_html(d365_text(...$name)) ?></h3>
                        <p><?= esc_html(d365_text(...$detail)) ?></p>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
    </div>
</section>

<section class="section training-section" id="course-guide" aria-labelledby="course-guide-title">
    <div class="wrap">
        <h2 id="course-guide-title"><?php d365_label('この講習で学ぶこと', 'What you’ll learn'); ?></h2>
        <div class="training-guide-layout <?= $photo ? 'has-course-photo' : '' ?>">
            <div class="training-chapters">
                <?php foreach ($details['sections'] as [$heading, $paragraphs]): ?>
                    <section class="training-chapter">
                        <h3><?= esc_html(d365_text(...$heading)) ?></h3>
                        <?php foreach ($paragraphs as $paragraph): ?><p><?= esc_html(d365_text(...$paragraph)) ?></p><?php endforeach; ?>
                    </section>
                <?php endforeach; ?>
            </div>
            <?php if ($photo): ?>
                <figure class="training-field-photo">
                    <img src="<?= esc_url(d365_asset($photo[0])) ?>" alt="" width="<?= esc_attr((string) $photo[3]) ?>" height="<?= esc_attr((string) $photo[4]) ?>" loading="lazy" decoding="async">
                    <figcaption><?php d365_label($photo[1], $photo[2]); ?></figcaption>
                </figure>
            <?php endif; ?>
        </div>
    </div>
</section>
<section class="section training-practice" id="course-prep" aria-labelledby="course-prep-title">
    <div class="wrap training-detail-grid">
        <h2 id="course-prep-title"><?php d365_label('事前準備・持ち物', 'Preparation and what to bring'); ?></h2>
        <ul class="training-checklist">
            <?php foreach ($details['checklist'] as $item): ?><li><?= esc_html(d365_text(...$item)) ?></li><?php endforeach; ?>
        </ul>
    </div>
</section>
<section class="section training-section" id="course-faq" aria-labelledby="course-faq-title">
    <div class="wrap training-detail-grid">
        <h2 id="course-faq-title"><?php d365_label('この講習のよくある質問', 'Questions about this course'); ?></h2>
        <div class="training-faq">
            <?php foreach ($details['faq'] as [$question, $answer]): ?>
                <details>
                    <summary><?= esc_html(d365_text(...$question)) ?></summary>
                    <p><?= esc_html(d365_text(...$answer)) ?></p>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
