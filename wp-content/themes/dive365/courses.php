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
        <section class="section training-practice">
            <div class="wrap">
                <?php if (isset($course['topics'])): ?>
                    <h2><?php d365_label('テーマから選ぶ', 'Explore specialty topics'); ?></h2>
                    <div class="course-grid">
                        <?php foreach ($course['topics'] as [$name, $detail, $slug]): ?>
                            <article class="course-card">
                                <h3><?= esc_html(d365_text(...$name)) ?></h3>
                                <p><?= esc_html(d365_text(...$detail)) ?></p>
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
                <?php if ($course_id === 'open-water' || $course_id === 'advanced'): ?>
                    <p class="course-note"><?php d365_label('水着やタオルなどの持ち物と集合場所は、日程が決まり次第ご案内します。', 'Once your dates are set, we’ll send the meeting point and a list of what to bring, such as swimwear and a towel.'); ?></p>
                <?php endif; ?>
            </div>
        </section>
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
