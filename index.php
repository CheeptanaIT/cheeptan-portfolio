<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();
$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$currentPage = 'home';
require __DIR__ . '/includes/icons.php';

// ซ่อนปุ่ม Download CV ถ้ายังไม่มีไฟล์ PDF ที่ path ใน config
$cvFile = $data['hero']['cv_file'] ?? '';
$cvAvailable = $cvFile !== '' && is_file(__DIR__ . '/' . $cvFile);

$caseStudies = $data['case_studies'] ?? [];
$skillsCore = $data['skills']['core'] ?? [];
$skillsWorking = $data['skills']['working'] ?? [];
$certifications = $data['certifications'] ?? [];
$tldr = $data['tldr'] ?? [];

require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <div class="container hero-inner">
        <div class="hero-content">
            <span class="hero-role"><?= htmlspecialchars($data['hero']['role']) ?></span>
            <h1><?= htmlspecialchars($data['hero']['name']) ?></h1>
            <?php if (!empty($data['hero']['name_th'])): ?>
                <p class="hero-name-th"><?= htmlspecialchars($data['hero']['name_th']) ?></p>
            <?php endif; ?>
            <p class="tagline"><?= htmlspecialchars($data['hero']['tagline']) ?></p>
            <div class="hero-actions">
                <?php if ($cvAvailable): ?>
                    <a class="btn btn-primary" href="<?= htmlspecialchars($cvFile) ?>" download><?= icon('download') ?><?= htmlspecialchars($data['hero']['cta_cv']) ?></a>
                <?php endif; ?>
                <a class="btn btn-outline" href="#case-studies"><?= htmlspecialchars($data['hero']['cta_cases']) ?></a>
            </div>
            <div class="social-badges hero-socials" role="list" aria-label="<?= htmlspecialchars($ui['hero_socials_label']) ?>">
                <?php foreach ($data['socials'] as $social): ?>
                    <a class="social-badge" role="listitem" href="<?= htmlspecialchars($social['url']) ?>" target="_blank" rel="noopener" aria-label="<?= htmlspecialchars($social['label']) ?>">
                        <?= icon($social['icon']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?php if (!empty($tldr)): ?>
<div class="container tldr-wrap">
    <h2 class="sr-only"><?= htmlspecialchars($ui['tldr_title']) ?></h2>
    <ul class="tldr-card">
        <?php foreach ($tldr as $i => $item): ?>
            <li class="tldr-item reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                <span class="tldr-label"><?= htmlspecialchars($item['label']) ?></span>
                <strong class="tldr-value"><?= htmlspecialchars($item['value']) ?></strong>
                <?php if (!empty($item['note'])): ?>
                    <span class="tldr-note"><?= htmlspecialchars($item['note']) ?></span>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<?php if (!empty($caseStudies)): ?>
<section id="case-studies">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_case_studies']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['case_studies_title']) ?></h2>
        <div class="case-list">
            <?php foreach ($caseStudies as $i => $case): ?>
                <article id="<?= htmlspecialchars($case['id']) ?>" class="case-card reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                    <h3 class="case-title"><?= htmlspecialchars($case['title']) ?></h3>
                    <?php if (!empty($case['tags'])): ?>
                        <ul class="case-tags">
                            <?php foreach ($case['tags'] as $tag): ?>
                                <li><?= htmlspecialchars($tag) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <dl class="case-steps">
                        <div class="case-step">
                            <dt><?= htmlspecialchars($ui['case_label_problem']) ?></dt>
                            <dd><?= htmlspecialchars($case['problem']) ?></dd>
                        </div>
                        <div class="case-step">
                            <dt><?= htmlspecialchars($ui['case_label_action']) ?></dt>
                            <dd><?= htmlspecialchars($case['action']) ?></dd>
                        </div>
                        <div class="case-step">
                            <dt><?= htmlspecialchars($ui['case_label_result']) ?></dt>
                            <dd><?= htmlspecialchars($case['result']) ?></dd>
                        </div>
                    </dl>
                    <?php if (!empty($case['metrics'])): ?>
                        <div class="case-metrics">
                            <?php foreach ($case['metrics'] as $metric): ?>
                                <div>
                                    <span class="case-metric-value"><?= htmlspecialchars($metric['value']) ?></span>
                                    <span class="case-metric-label"><?= htmlspecialchars($metric['label']) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($case['diagram'])): ?>
                        <figure class="case-diagram">
                            <img src="<?= htmlspecialchars($case['diagram']) ?>" alt="<?= htmlspecialchars($case['diagram_alt']) ?>" loading="lazy">
                        </figure>
                    <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if (!empty($skillsCore) || !empty($skillsWorking)): ?>
<section id="skills">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_skills']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['skills_title']) ?></h2>
        <div class="skills-grid">
            <?php if (!empty($skillsCore)): ?>
                <div class="skills-col reveal">
                    <h3 class="skills-col-title"><?= htmlspecialchars($ui['skills_core_title']) ?></h3>
                    <p class="skills-col-hint"><?= htmlspecialchars($ui['skills_core_hint']) ?></p>
                    <ul class="skill-list">
                        <?php foreach ($skillsCore as $skill): ?>
                            <li class="skill-item">
                                <span><?= htmlspecialchars($skill['name']) ?></span>
                                <?php if (!empty($skill['evidence'])): ?>
                                    <a class="skill-evidence" href="<?= htmlspecialchars($skill['evidence']) ?>"><?= htmlspecialchars($ui['skills_evidence_label']) ?></a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if (!empty($skillsWorking)): ?>
                <div class="skills-col reveal" style="--reveal-delay: 90ms">
                    <h3 class="skills-col-title"><?= htmlspecialchars($ui['skills_working_title']) ?></h3>
                    <p class="skills-col-hint"><?= htmlspecialchars($ui['skills_working_hint']) ?></p>
                    <ul class="skill-tags">
                        <?php foreach ($skillsWorking as $skill): ?>
                            <li><?= htmlspecialchars($skill) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section id="experience">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_experience']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['experience_title']) ?></h2>

        <?php if (!empty($data['experience'])): ?>
            <h3 class="sub-title"><?= htmlspecialchars($ui['experience_work_title']) ?></h3>
            <ol class="timeline">
                <?php foreach ($data['experience'] as $job): ?>
                    <li class="timeline-item reveal">
                        <div class="timeline-head">
                            <div>
                                <h4><?= htmlspecialchars($job['role']) ?></h4>
                                <p class="timeline-company"><?= htmlspecialchars($job['company']) ?></p>
                            </div>
                            <span class="timeline-period"><?= htmlspecialchars($job['period']) ?></span>
                        </div>
                        <?php if (!empty($job['points'])): ?>
                            <ul class="timeline-points">
                                <?php foreach ($job['points'] as $point): ?>
                                    <li><?= htmlspecialchars($point) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

        <?php if (!empty($data['education'])): ?>
            <h3 class="sub-title"><?= htmlspecialchars($ui['experience_education_title']) ?></h3>
            <div class="education-grid">
                <?php foreach ($data['education'] as $i => $edu): ?>
                    <div class="education-card reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                        <h4 class="education-title"><?= htmlspecialchars($edu['title']) ?></h4>
                        <p class="education-institution"><?= htmlspecialchars($edu['institution']) ?></p>
                        <p class="education-period"><?= htmlspecialchars($edu['period']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($certifications)): ?>
            <h3 class="sub-title"><?= htmlspecialchars($ui['experience_certs_title']) ?></h3>
            <ul class="cert-list">
                <?php foreach ($certifications as $i => $cert): ?>
                    <li class="cert-item reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                        <div>
                            <p class="cert-name"><?= htmlspecialchars($cert['name']) ?></p>
                            <p class="cert-meta"><?= htmlspecialchars(trim(($cert['issuer'] ?? '') . ' ' . ($cert['date'] ?? ''))) ?></p>
                        </div>
                        <?php if (!empty($cert['verify_url'])): ?>
                            <a class="btn btn-outline btn-sm" href="<?= htmlspecialchars($cert['verify_url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars($ui['cert_verify_label']) ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</section>

<section id="about">
    <div class="container about-grid">
        <figure class="about-photo reveal">
            <div class="about-photo-frame">
                <img src="assets/img/profile.jpg" alt="<?= htmlspecialchars($ui['photo_alt']) ?>" loading="lazy">
            </div>
        </figure>
        <div>
            <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_about']) ?></span>
            <h2 class="section-title"><?= htmlspecialchars($ui['about_title']) ?></h2>
            <p class="about-intro"><?= htmlspecialchars($data['about']['text']) ?></p>
            <?php if (!empty($data['about']['principles'])): ?>
                <ul class="principles">
                    <?php foreach ($data['about']['principles'] as $principle): ?>
                        <li><?= htmlspecialchars($principle) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>

<section id="contact" class="contact-section">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_contact']) ?></span>
    </div>
    <div class="container">
        <div class="contact-panel">
            <div class="contact-info">
                <h2 class="contact-info-title"><?= htmlspecialchars($data['contact']['title']) ?></h2>
                <p class="contact-info-sub"><?= htmlspecialchars($data['contact']['text']) ?></p>
                <dl class="contact-info-list">
                    <div>
                        <dt><?= htmlspecialchars($ui['about_label_email']) ?></dt>
                        <dd><a href="mailto:<?= htmlspecialchars($data['about']['email']) ?>"><?= htmlspecialchars($data['about']['email']) ?></a></dd>
                    </div>
                    <div>
                        <dt><?= htmlspecialchars($ui['about_label_location']) ?></dt>
                        <dd><?= htmlspecialchars($data['about']['location']) ?></dd>
                    </div>
                </dl>
                <?php if (!empty($data['contact']['booking_url'])): ?>
                    <a class="btn btn-outline btn-block contact-booking" href="<?= htmlspecialchars($data['contact']['booking_url']) ?>" target="_blank" rel="noopener"><?= icon('calendar') ?><?= htmlspecialchars($data['contact']['booking_label']) ?></a>
                <?php endif; ?>
            </div>
            <div class="contact-form-col">
                <form id="contact-form" data-sending-text="<?= htmlspecialchars($ui['form_sending']) ?>" data-submit-text="<?= htmlspecialchars($ui['form_submit']) ?>" data-error-text="<?= htmlspecialchars($ui['form_error']) ?>">
                    <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
                    <input type="hidden" name="form_ts" value="<?= time() ?>">
                    <div class="hp-field" aria-hidden="true">
                        <input type="text" name="hp_website" tabindex="-1" autocomplete="off">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name"><?= htmlspecialchars($ui['form_label_name']) ?></label>
                            <input type="text" id="name" name="name" placeholder="<?= htmlspecialchars($ui['form_placeholder_name']) ?>" required maxlength="100" autocomplete="name">
                        </div>
                        <div class="form-group">
                            <label for="email"><?= htmlspecialchars($ui['form_label_email']) ?></label>
                            <input type="email" id="email" name="email" placeholder="<?= htmlspecialchars($ui['form_placeholder_email']) ?>" required maxlength="150" autocomplete="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message"><?= htmlspecialchars($ui['form_label_message']) ?></label>
                        <textarea id="message" name="message" placeholder="<?= htmlspecialchars($ui['form_placeholder_message']) ?>" required maxlength="2000"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><?= htmlspecialchars($ui['form_submit']) ?></button>
                    <p id="form-note" class="form-note" role="status" aria-live="polite"></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
