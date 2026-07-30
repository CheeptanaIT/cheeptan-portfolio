document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.nav-toggle');
    var links = document.querySelector('.nav-links');

    if (toggle && links) {
        toggle.addEventListener('click', function () {
            var isOpen = links.classList.toggle('open');
            toggle.setAttribute('aria-expanded', String(isOpen));
        });

        links.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function () {
                links.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    var revealEls = document.querySelectorAll('.reveal');
    if (revealEls.length && 'IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });

        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        revealEls.forEach(function (el) {
            el.classList.add('is-visible');
        });
    }

    var filterBtns = document.querySelectorAll('.filter-btn');
    var portfolioCards = document.querySelectorAll('.portfolio-card');
    if (filterBtns.length && portfolioCards.length) {
        filterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                filterBtns.forEach(function (b) { b.classList.remove('is-active'); });
                btn.classList.add('is-active');

                var filter = btn.dataset.filter;
                portfolioCards.forEach(function (card) {
                    var show = filter === 'all' || card.dataset.type === filter;
                    card.classList.toggle('is-hidden', !show);
                });
            });
        });
    }

    var form = document.getElementById('contact-form');
    if (!form) return;

    var note = document.getElementById('form-note');
    var submitBtn = form.querySelector('button[type="submit"]');
    var sendingText = form.dataset.sendingText || submitBtn.textContent;
    var submitText = form.dataset.submitText || submitBtn.textContent;
    var errorText = form.dataset.errorText || 'Something went wrong. Please try again.';

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        note.textContent = '';
        note.className = 'form-note';
        submitBtn.disabled = true;
        submitBtn.textContent = sendingText;

        fetch('contact-handler.php?debug=contact1', {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.debug) console.log('contact form debug:', data.debug);
                note.textContent = data.message;
                note.classList.add(data.success ? 'success' : 'error');
                if (data.success) form.reset();
            })
            .catch(function () {
                note.textContent = errorText;
                note.classList.add('error');
            })
            .finally(function () {
                submitBtn.disabled = false;
                submitBtn.textContent = submitText;
            });
    });
});
