(function () {
    var CART_KEY = 'cheeptan_cart_v1';

    function getCart() {
        try {
            var raw = localStorage.getItem(CART_KEY);
            var parsed = raw ? JSON.parse(raw) : [];
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function saveCart(cart) {
        try {
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
        } catch (e) {
            // localStorage อาจใช้ไม่ได้ (private mode/ปิด storage) — ปล่อยผ่าน ตะกร้าแค่ไม่จำข้ามหน้า
        }
        updateCartBadge();
    }

    function addToCart(id, qty) {
        qty = qty || 1;
        var cart = getCart();
        var existing = null;
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id === id) {
                existing = cart[i];
                break;
            }
        }
        if (existing) {
            existing.qty += qty;
        } else {
            cart.push({ id: id, qty: qty });
        }
        saveCart(cart);
    }

    function removeFromCart(id) {
        saveCart(getCart().filter(function (item) { return item.id !== id; }));
    }

    function setQty(id, qty) {
        qty = Math.max(1, Math.min(99, parseInt(qty, 10) || 1));
        var cart = getCart();
        for (var i = 0; i < cart.length; i++) {
            if (cart[i].id === id) {
                cart[i].qty = qty;
                break;
            }
        }
        saveCart(cart);
    }

    function clearCart() {
        saveCart([]);
    }

    function cartCount() {
        return getCart().reduce(function (sum, item) { return sum + item.qty; }, 0);
    }

    function updateCartBadge() {
        var badge = document.querySelector('.cart-badge');
        if (!badge) return;
        var count = cartCount();
        badge.textContent = String(count);
        badge.hidden = count === 0;
    }

    window.CheeptanCart = {
        get: getCart,
        add: addToCart,
        remove: removeFromCart,
        setQty: setQty,
        clear: clearCart,
        updateBadge: updateCartBadge
    };

    function renderCartPage(root) {
        var products = window.SHOP_PRODUCTS || {};
        var strings = window.SHOP_STRINGS || {};
        var emptyState = document.getElementById('cart-empty');
        var layout = document.getElementById('cart-layout');
        var itemsEl = document.getElementById('cart-items');
        var totalEl = document.getElementById('cart-total');
        var itemsInput = document.getElementById('cart-items-input');

        function render() {
            var cart = getCart().filter(function (item) { return products[item.id]; });
            if (cart.length === 0) {
                emptyState.hidden = false;
                layout.hidden = true;
                return;
            }
            emptyState.hidden = true;
            layout.hidden = false;

            var total = 0;
            itemsEl.innerHTML = '';

            cart.forEach(function (item) {
                var product = products[item.id];
                var lineTotal = product.price * item.qty;
                total += lineTotal;

                var row = document.createElement('div');
                row.className = 'cart-row';
                row.innerHTML =
                    '<div class="cart-row-info">' +
                        '<p class="cart-row-title"></p>' +
                        '<p class="cart-row-price"></p>' +
                    '</div>' +
                    '<div class="cart-row-controls">' +
                        '<label class="cart-qty-label"></label>' +
                        '<input type="number" class="cart-qty-input" min="1" max="99" step="1">' +
                        '<button type="button" class="cart-remove-btn"></button>' +
                    '</div>';

                row.querySelector('.cart-row-title').textContent = product.title;
                row.querySelector('.cart-row-price').textContent =
                    lineTotal.toLocaleString() + ' ' + (strings.currency || '');
                row.querySelector('.cart-qty-label').textContent = strings.qtyLabel || 'Qty';
                row.querySelector('.cart-remove-btn').textContent = strings.removeLabel || 'Remove';

                var qtyInput = row.querySelector('.cart-qty-input');
                qtyInput.value = item.qty;
                qtyInput.addEventListener('change', function () {
                    setQty(item.id, qtyInput.value);
                    render();
                });

                row.querySelector('.cart-remove-btn').addEventListener('click', function () {
                    removeFromCart(item.id);
                    render();
                });

                itemsEl.appendChild(row);
            });

            totalEl.textContent = total.toLocaleString() + ' ' + (strings.currency || '');
            itemsInput.value = JSON.stringify(cart.map(function (item) {
                return { id: item.id, qty: item.qty };
            }));
        }

        render();

        var form = document.getElementById('checkout-form');
        if (!form) return;

        var note = document.getElementById('checkout-note-msg');
        var submitBtn = form.querySelector('button[type="submit"]');
        var sendingText = form.dataset.sendingText || submitBtn.textContent;
        var submitText = form.dataset.submitText || submitBtn.textContent;
        var errorText = form.dataset.errorText || 'Something went wrong. Please try again.';

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (getCart().length === 0) return;

            note.textContent = '';
            note.className = 'form-note';
            submitBtn.disabled = true;
            submitBtn.textContent = sendingText;

            fetch('order-handler.php', {
                method: 'POST',
                body: new FormData(form),
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    note.textContent = data.message;
                    note.classList.add(data.success ? 'success' : 'error');
                    if (data.success) {
                        clearCart();
                        form.reset();
                        render();
                    }
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
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateCartBadge();

        document.querySelectorAll('.add-to-cart-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                addToCart(btn.dataset.id, 1);
                var original = btn.textContent;
                btn.textContent = btn.dataset.addedText || original;
                btn.classList.add('is-added');
                window.setTimeout(function () {
                    btn.textContent = original;
                    btn.classList.remove('is-added');
                }, 1200);
            });
        });

        var cartRoot = document.getElementById('cart-app');
        if (cartRoot) {
            renderCartPage(cartRoot);
        }
    });
})();
