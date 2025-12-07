// js/script.js

// DOM Elements
const menuItems = document.querySelectorAll('.menu-item');
const filterBtns = document.querySelectorAll('.filter-btn');
const cartItems = document.getElementById('cart-items');
const emptyCartMessage = document.getElementById('empty-cart-message');
const cartTotal = document.getElementById('cart-total');
const checkoutBtn = document.getElementById('checkout-btn');
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');

// Cart state
let cart = [];

// Filter menu items
filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        filterBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const filter = btn.getAttribute('data-filter');

        menuItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
});

// Add to cart functionality
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('add-to-cart')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        const name = e.target.getAttribute('data-name');
        const price = parseInt(e.target.getAttribute('data-price'));

        addToCart(id, name, price);
    }
});

// Add item to cart
function addToCart(id, name, price) {
    const existingItem = cart.find(item => item.id === id);

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id,
            name,
            price,
            quantity: 1
        });
    }

    updateCart();
    showNotification(`${name} ditambahkan ke keranjang`);
}

// Remove item from cart
function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCart();
}

// Update quantity
function updateQuantity(id, change) {
    const item = cart.find(item => item.id === id);

    if (item) {
        item.quantity += change;

        if (item.quantity <= 0) {
            removeFromCart(id);
        } else {
            updateCart();
        }
    }
}

// Update cart display
function updateCart() {
    cartItems.innerHTML = '';

    if (cart.length === 0) {
        emptyCartMessage.style.display = 'block';
        checkoutBtn.disabled = true;
        // RESET total jika kosong
        if (cartTotal) {
            cartTotal.innerHTML = 'Total: Rp 0';
        }
    } else {
        emptyCartMessage.style.display = 'none';
        checkoutBtn.disabled = false;

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            cartItem.innerHTML = `
                <div class="cart-item-info">
                    <h4>${item.name}</h4>
                    <p>Rp ${formatPrice(item.price)}</p>
                </div>
                <div class="cart-item-controls">
                    <button class="quantity-btn minus" data-id="${item.id}">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn plus" data-id="${item.id}">+</button>
                    <button class="remove-item" data-id="${item.id}">Hapus</button>
                </div>
            `;
            cartItems.appendChild(cartItem);
        });

        const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        cartTotal.innerHTML = `Total: Rp ${formatPrice(total)}`;
    }
}

// Format price with thousand separators
function formatPrice(price) {
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background-color: var(--primary-color);
        color: white;
        padding: 15px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.3s ease;
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Checkout functionality
if (checkoutBtn) {
    checkoutBtn.addEventListener('click', () => {
        if (cart.length > 0) {
            const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            const orderDetails = cart.map(item =>
                `${item.name} (${item.quantity}x) - Rp ${formatPrice(item.price * item.quantity)}`
            ).join('\n');

            alert(
                `Pesanan Anda:\n\n${orderDetails}\n\nTotal: Rp ${formatPrice(total)}\n\nTerima kasih atas pesanan Anda!`
            );

            // Clear cart & reset total
            cart = [];
            updateCart();
        }
    });
}

// Event delegation for cart controls
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('minus')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        updateQuantity(id, -1);
    }

    if (e.target.classList.contains('plus')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        updateQuantity(id, 1);
    }

    if (e.target.classList.contains('remove-item')) {
        const id = parseInt(e.target.getAttribute('data-id'));
        removeFromCart(id);
    }
});

// Mobile menu toggle
if (hamburger && navMenu) {
    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('active');
        navMenu.classList.toggle('active');
    });
}

// Close mobile menu when clicking on a link
document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
        if (hamburger && navMenu) {
            hamburger.classList.remove('active');
            navMenu.classList.remove('active');
        }
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        const targetId = this.getAttribute('href');
        if (targetId === '#') return;

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', () => {
    updateCart();
});
