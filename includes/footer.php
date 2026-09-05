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
                    <?php if (!empty($features['portfolio_enabled'])): ?>
                    <a href="portfolio.php"><?= htmlspecialchars($ui['nav_portfolio']) ?></a>
                    <?php endif; ?>
                    <?php if (!empty($features['blog_enabled'])): ?>
                    <a href="blog.php"><?= htmlspecialchars($ui['nav_blog']) ?></a>
                    <?php endif; ?>
                    <?php if (!empty($features['services_enabled'])): ?>
                    <a href="services.php"><?= htmlspecialchars($ui['nav_services']) ?></a>
                    <?php endif; ?>
                    <?php if (!empty($features['shop_enabled'])): ?>
                    <a href="shop.php"><?= htmlspecialchars($ui['nav_shop']) ?></a>
                    <?php endif; ?>
                    <a href="index.php#contact"><?= htmlspecialchars($ui['nav_contact']) ?></a>
                </nav>
            </div>
        </div>
        <div class="container footer-bottom">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($data['site_name']) ?>. <?= htmlspecialchars($ui['footer_rights']) ?></p>
            <a class="footer-admin-link" href="admin/">Admin</a>
        </div>
    </div>
</footer>
<script src="assets/js/main.js<?= asset_v('assets/js/main.js') ?>"></script>
<script src="assets/js/shop.js<?= asset_v('assets/js/shop.js') ?>"></script>
</body>
</html>
