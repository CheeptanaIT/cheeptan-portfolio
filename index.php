<?php
require __DIR__ . '/includes/lang.php';
$lang = resolve_site_language();
$all = require __DIR__ . '/config.php';
$data = $all[$lang];
$ui = $data['ui'];
$currentPage = 'home';
require __DIR__ . '/includes/icons.php';
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
                <a class="btn btn-primary" href="#achievements"><?= htmlspecialchars($data['hero']['cta_primary']) ?></a>
                <a class="btn btn-outline" href="#contact"><?= htmlspecialchars($data['hero']['cta_secondary']) ?></a>
            </div>
        </div>
        <div class="hero-photo-wrap">
            <div class="hero-photo-frame">
                <img src="assets/img/profile.jpg" alt="<?= htmlspecialchars($data['hero']['name']) ?>">
            </div>
            <span class="hero-badge"><?= htmlspecialchars($data['hero']['badge']) ?></span>
        </div>
    </div>
    <div class="hero-stats-bar">
        <div class="container hero-stats">
            <?php foreach ($data['hero']['stats'] as $stat): ?>
                <div class="hero-stat">
                    <span class="hero-stat-value"><?= htmlspecialchars($stat['value']) ?></span>
                    <span class="hero-stat-label"><?= htmlspecialchars($stat['label']) ?></span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="about">
    <div class="container about-grid">
        <div>
            <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_about']) ?></span>
            <h2 class="section-title"><?= htmlspecialchars($ui['about_title']) ?></h2>
            <p><?= nl2br(htmlspecialchars($data['about']['text'])) ?></p>
        </div>
        <dl class="about-facts reveal">
            <dt><?= htmlspecialchars($ui['about_label_position']) ?></dt>
            <dd><?= htmlspecialchars($data['about']['position']) ?></dd>
            <dt><?= htmlspecialchars($ui['about_label_company']) ?></dt>
            <dd><?= htmlspecialchars($data['about']['company']) ?> (<?= htmlspecialchars($data['about']['period']) ?>)</dd>
        </dl>
    </div>
</section>

<section id="education">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_education']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['education_title']) ?></h2>
        <div class="education-grid">
            <?php foreach ($data['education'] as $i => $edu): ?>
                <div class="education-card reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                    <h3 class="education-title"><?= htmlspecialchars($edu['title']) ?></h3>
                    <p class="education-institution"><?= htmlspecialchars($edu['institution']) ?></p>
                    <p class="education-period"><?= htmlspecialchars($edu['period']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="competencies">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_competencies']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['competencies_title']) ?></h2>
        <div class="competency-rows">
            <?php foreach ($data['competencies'] as $i => $group): ?>
                <div class="competency-row reveal" style="--reveal-delay: <?= $i * 90 ?>ms">
                    <div class="competency-icon"><?= icon($group['icon']) ?></div>
                    <div class="competency-body">
                        <h3 class="competency-group-title"><?= htmlspecialchars($group['group']) ?></h3>
                        <ul class="competency-list">
                            <?php foreach ($group['items'] as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cta-banner">
    <img class="cta-banner-image" src="assets/img/server-room.jpg" alt="<?= htmlspecialchars($data['banner']['image_alt']) ?>">
    <div class="cta-banner-overlay"></div>
    <div class="container cta-banner-inner">
        <div class="cta-content">
            <h2><?= htmlspecialchars($data['banner']['title']) ?></h2>
            <p><?= htmlspecialchars($data['banner']['text']) ?></p>
            <a class="btn btn-primary" href="<?= htmlspecialchars($data['banner']['cta_link']) ?>"><?= htmlspecialchars($data['banner']['cta_label']) ?></a>
        </div>
    </div>
    <p class="cta-banner-credit"><?= htmlspecialchars($ui['image_credit_prefix']) ?> <a href="https://commons.wikimedia.org/wiki/File:Cern_datacenter.jpg" target="_blank" rel="noopener">Hugovanmeijeren</a>, <a href="https://creativecommons.org/licenses/by-sa/3.0" target="_blank" rel="noopener">CC BY-SA 3.0</a></p>
</section>

<section id="achievements" class="section-alt">
    <div class="container">
        <span class="section-eyebrow"><?= htmlspecialchars($ui['eyebrow_achievements']) ?></span>
        <h2 class="section-title"><?= htmlspecialchars($ui['achievements_title']) ?></h2>
        <div class="achievements-grid">
            <?php foreach ($data['achievements'] as $i => $achievement): ?>
                <div class="achievement-card reveal<?= $i === 0 ? ' achievement-card--featured' : '' ?>" style="--reveal-delay: <?= $i * 90 ?>ms">
                    <h3 class="achievement-title"><?= htmlspecialchars($achievement['title']) ?></h3>
                    <p class="achievement-desc"><?= htmlspecialchars($achievement['description']) ?></p>
                </div>
            <?php endforeach; ?>
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
                <h2 class="contact-info-title"><?= htmlspecialchars($data['cta_strip']['title']) ?></h2>
                <p class="contact-info-sub"><?= htmlspecialchars($data['cta_strip']['text']) ?></p>
                <dl class="contact-info-list">
                    <div>
                        <dt><?= htmlspecialchars($ui['about_label_email']) ?></dt>
                        <dd><?= htmlspecialchars($data['about']['email']) ?></dd>
                    </div>
                    <div>
                        <dt><?= htmlspecialchars($ui['about_label_phone']) ?></dt>
                        <dd><?= htmlspecialchars($data['about']['phone']) ?></dd>
                    </div>
                    <div>
                        <dt><?= htmlspecialchars($ui['about_label_location']) ?></dt>
                        <dd><?= htmlspecialchars($data['about']['location']) ?></dd>
                    </div>
                </dl>
                <div class="contact-info-follow">
                    <span class="contact-info-follow-label"><?= htmlspecialchars($ui['follow_label']) ?></span>
                    <div class="social-badges social-badges--sm">
                        <?php foreach ($data['socials'] as $social): ?>
                            <a class="social-badge" href="<?= htmlspecialchars($social['url']) ?>" target="_blank" rel="noopener" aria-label="<?= htmlspecialchars($social['label']) ?>">
                                <?php if (!empty($social['icon'])): ?>
                                    <?= icon($social['icon']) ?>
                                <?php else: ?>
                                    <span><?= htmlspecialchars($social['short']) ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="contact-form-col">
                <form id="contact-form" data-sending-text="<?= htmlspecialchars($ui['form_sending']) ?>" data-submit-text="<?= htmlspecialchars($ui['form_submit']) ?>" data-error-text="<?= htmlspecialchars($ui['form_error']) ?>">
                    <input type="hidden" name="lang" value="<?= htmlspecialchars($lang) ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name"><?= htmlspecialchars($ui['form_label_name']) ?></label>
                            <input type="text" id="name" name="name" placeholder="<?= htmlspecialchars($ui['form_placeholder_name']) ?>" required maxlength="100">
                        </div>
                        <div class="form-group">
                            <label for="email"><?= htmlspecialchars($ui['form_label_email']) ?></label>
                            <input type="email" id="email" name="email" placeholder="<?= htmlspecialchars($ui['form_placeholder_email']) ?>" required maxlength="150">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message"><?= htmlspecialchars($ui['form_label_message']) ?></label>
                        <textarea id="message" name="message" placeholder="<?= htmlspecialchars($ui['form_placeholder_message']) ?>" required maxlength="2000"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><?= htmlspecialchars($ui['form_submit']) ?></button>
                    <p id="form-note" class="form-note"></p>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
