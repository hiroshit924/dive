<?php
get_header();
$english = d365_is_english();
$courses = d365_training_courses();
$course_id = d365_current_course();
$course = $courses[$course_id] ?? null;
$book = d365_course_booking_url($course_id);
$availability = d365_text('開催・料金は要相談', 'Ask about dates and pricing');
$overview = d365_courses_url($english);
?>
<main id="main" class="course-page training-page">
    <section class="training-hero">
        <div class="wrap training-hero-grid">
            <div>
                <?php if ($course): ?>
                    <a class="text-link training-back" href="<?= esc_url($overview) ?>">← <?php d365_label('講習・スキルアップ', 'All scuba courses'); ?></a>
                <?php endif; ?>
                <p class="hero-location"><span aria-hidden="true"></span><?php d365_label('Diving Shop C365のPADI講習', 'PADI training at Diving Shop C365'); ?></p>
                <h1><?= esc_html($course ? d365_text(...$course['name']) : d365_text('講習・スキルアップ', 'Scuba courses & skills')) ?></h1>
                <p class="training-lead"><?= esc_html($course ? d365_text(...$course['lead']) : d365_text('初めてのCカードから、次に見たい海まで。今の経験と、やってみたいことに合わせて講習を選べます。', 'From your first certification to the dives you dream about, find the training that fits your experience and interests.')) ?></p>
                <div class="tour-actions">
                    <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('講習を相談する', 'Ask about training'); ?> <span aria-hidden="true">↗</span></a>
                    <a class="text-link" href="<?= $course ? '#course-details' : '#course-options' ?>"><?= esc_html($course ? d365_text('講習内容を見る', 'See course details') : d365_text('コースを比べる', 'Compare courses')) ?> <span aria-hidden="true">↓</span></a>
                </div>
            </div>
            <img src="<?= esc_url(d365_asset('course.jpg')) ?>" alt="" width="768" height="576" fetchpriority="high">
        </div>
    </section>
    <?php if ($course): ?>
        <?php get_template_part('template-parts/training-detail', null, [
            'course' => $course,
            'course_id' => $course_id,
            'availability' => $availability,
        ]); ?>
    <?php else: ?>
        <section class="section training-section" id="course-options">
            <div class="wrap">
                <h2><?php d365_label('コースを選ぶ', 'Choose a course'); ?></h2>
                <div class="course-grid training-cards">
                    <?php foreach ($courses as $slug => $entry): ?>
                        <article class="course-card" id="<?= esc_attr($slug) ?>">
                            <h3><a href="<?= esc_url(d365_course_url($slug, $english)) ?>"><?= esc_html(d365_text(...$entry['name'])) ?></a></h3>
                            <p><?= esc_html(d365_text(...$entry['lead'])) ?></p>
                            <?php if (isset($entry['price'])): ?>
                                <p class="course-price"><?= esc_html($entry['price']) ?> <small><?php d365_label('税込', 'tax included'); ?> · <?= esc_html(d365_text(...$entry['duration'])) ?></small></p>
                            <?php else: ?>
                                <p class="training-availability"><?= esc_html($availability) ?></p>
                            <?php endif; ?>
                            <a class="text-link" aria-label="<?= esc_attr(d365_text($entry['name'][0] . 'の詳細', 'Details for ' . $entry['name'][1])) ?>" href="<?= esc_url(d365_course_url($slug, $english)) ?>"><?php d365_label('講習の詳細を見る', 'Course details'); ?> <span aria-hidden="true">↗</span></a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <section class="section training-practice">
            <div class="wrap training-detail-grid">
                <h2><?php d365_label('講習前によくある質問', 'Questions before you start'); ?></h2>
                <div>
                    <details><summary><?php d365_label('Cカードって何ですか？', 'What is a dive certification card?'); ?></summary><p><?php d365_label('講習を修了し、定められた知識とスキルを身につけたことを示す認定カードです。初めて取るならオープン・ウォーター・ダイバーから始めます。', 'It shows that you have completed training and met the required knowledge and skill standards. Start with Open Water Diver if you’re new to scuba.'); ?></p></details>
                    <details><summary><?php d365_label('仕事や学校の予定と合わせられますか？', 'Can I fit training around work or school?'); ?></summary><p><?php d365_label('空いている日をいくつか教えてください。講習に必要な日数をもとに、日程の組み方をご相談いただけます。', 'Share a few dates you’re free. We can discuss how to schedule the training around the days the course requires.'); ?></p></details>
                    <details><summary><?php d365_label('いきなり講習を申し込むのが不安です', 'What if I’m not ready to commit to a course?'); ?></summary><p><?php d365_label('まずは体験ダイビングで器材や水中での呼吸に慣れてから、Cカードを検討することもできます。', 'Try an introductory dive to get a feel for the gear and breathing underwater before deciding on certification.'); ?> <?php if (function_exists('d365_show_booking')): ?><a href="<?= esc_url(d365_experience_url('trial', $english)) ?>"><?php d365_label('体験ダイビングを見る', 'See introductory dives'); ?></a><?php endif; ?></p></details>
                </div>
            </div>
        </section>
    <?php endif; ?>
    <section class="michael-end">
        <div class="wrap">
            <div>
                <h2><?php d365_label('次のお休み、海で練習しよう。', 'Make your next day off a dive day.'); ?></h2>
                <p><?php d365_label('希望の日程や今の経験を教えてください。横浜・桜木町のスタッフと、無理のない進め方を相談できます。', 'Tell our Yokohama team your dates and experience. We’ll discuss a training plan that suits you.'); ?></p>
                <?php if ($course): ?><a class="text-link" href="<?= esc_url($overview) ?>">← <?php d365_label('すべての講習を見る', 'See all courses'); ?></a><?php endif; ?>
            </div>
            <a class="button" href="<?= esc_url($book) ?>"><?php d365_label('講習を相談する', 'Ask about training'); ?> <span aria-hidden="true">↗</span></a>
        </div>
    </section>
</main>
<?php get_footer(); ?>
