</main>
<footer class="site-footer-wrap">
    <div class="footer-main">
        <div class="container footer-columns">
            <div class="footer-col">
                <h3 class="footer-brand"><?= htmlspecialchars($data['site_name']) ?></h3>
                <p><?= htmlspecialchars($data['footer_about']) ?></p>
            </div>
            <div class="footer-col">
                <h3 class="footer-col-title"><?= htmlspecialchars($ui['footer_menu_title']) ?></h3>
                <nav class="footer-nav">
                    <a href="index.php#about"><?= htmlspecialchars($ui['nav_about']) ?></a>
                    <a href="index.php#competencies"><?= htmlspecialchars($ui['nav_competencies']) ?></a>
                    <a href="index.php#achievements"><?= htmlspecialchars($ui['nav_achievements']) ?></a>
                    <?php /* hidden for now: portfolio.php nav link (placeholder content) */ ?>
                    <a href="blog.php"><?= htmlspecialchars($ui['nav_blog']) ?></a>
                    <a href="index.php#contact"><?= htmlspecialchars($ui['nav_contact']) ?></a>
                </nav>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($data['site_name']) ?>. <?= htmlspecialchars($ui['footer_rights']) ?></p>
        </div>
    </div>
</footer>
<script src="assets/js/main.js"></script>
</body>
</html>
