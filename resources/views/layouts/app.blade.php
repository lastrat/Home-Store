<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Home Store - Chic Living, votre boutique de mode et décoration haut de gamme">
    <title>@yield('title', 'Home Store - Chic Living')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/modern.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gold: {
                            50: '#fdf8f0',
                            100: '#f9efd9',
                            200: '#f0d9a8',
                            300: '#e0c78a',
                            400: '#d4b370',
                            500: '#c9a96e',
                            600: '#a88b4a',
                            700: '#8b6f3a',
                            800: '#6b5530',
                            900: '#4a3a22',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="antialiased">
    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <div id="toast-container" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3"></div>

    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            function showToast(message, type = 'success') {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = `px-4 py-3 rounded-xl text-sm font-medium shadow-lg transform transition-all duration-300 translate-y-4 opacity-0 ${type === 'success' ? 'bg-gray-900 text-white' : 'bg-red-600 text-white'}`;
                toast.textContent = message;
                container.appendChild(toast);

                requestAnimationFrame(() => {
                    toast.classList.remove('translate-y-4', 'opacity-0');
                });

                setTimeout(() => {
                    toast.classList.add('translate-y-4', 'opacity-0');
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            async function updateCartCount() {
                try {
                    const response = await fetch(`{{ route('ajax.cart.count') }}`, {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                        credentials: 'same-origin',
                    });
                    const data = await response.json();
                    const badges = document.querySelectorAll('[data-cart-count]');
                    badges.forEach(badge => {
                        badge.textContent = data.count;
                        badge.style.display = data.count > 0 ? 'flex' : 'none';
                    });
                } catch (e) {
                    console.error('Failed to update cart count', e);
                }
            }

            document.addEventListener('click', async (e) => {
                const cartBtn = e.target.closest('.cart-add-btn');
                if (cartBtn) {
                    e.preventDefault();
                    const productId = cartBtn.dataset.productId;
                    const qtyInput = document.getElementById(`qty-${productId}`);
                    const quantity = qtyInput ? parseInt(qtyInput.value) : 1;
                    try {
                        const response = await fetch(`{{ route('ajax.cart.add', ['product' => '__ID__']) }}`.replace('__ID__', productId) + `?quantity=${quantity}`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        });
                        const data = await response.json();
                        if (data.success) {
                            showToast(data.message);
                            updateCartCount();
                        } else {
                            showToast(data.message, 'error');
                        }
                    } catch (err) {
                        showToast('Erreur lors de l\'ajout au panier.', 'error');
                    }
                }

                const wishlistBtn = e.target.closest('.wishlist-toggle-btn');
                if (wishlistBtn) {
                    e.preventDefault();
                    const productId = wishlistBtn.dataset.productId;
                    try {
                        const response = await fetch(`{{ route('ajax.wishlist.toggle', ['product' => '__ID__']) }}`.replace('__ID__', productId), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        });
                        const data = await response.json();
                        if (data.success) {
                            showToast(data.message);
                            const svg = wishlistBtn.querySelector('svg');
                            if (data.active) {
                                wishlistBtn.classList.remove('btn-outline');
                                wishlistBtn.classList.add('btn-primary');
                                svg.setAttribute('fill', 'currentColor');
                            } else {
                                wishlistBtn.classList.remove('btn-primary');
                                wishlistBtn.classList.add('btn-outline');
                                svg.setAttribute('fill', 'none');
                            }
                        }
                    } catch (err) {
                        showToast('Erreur lors de la mise à jour des coups de cœur.', 'error');
                    }
                }

                const alertBtn = e.target.closest('.stock-alert-btn');
                if (alertBtn) {
                    e.preventDefault();
                    const productId = alertBtn.dataset.productId;
                    try {
                        const response = await fetch(`{{ route('ajax.stock.alert.toggle', ['product' => '__ID__']) }}`.replace('__ID__', productId), {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                            credentials: 'same-origin',
                        });
                        const data = await response.json();
                        if (data.success) {
                            showToast(data.message);
                        } else {
                            showToast(data.message, 'error');
                        }
                    } catch (err) {
                        showToast('Erreur lors de la mise à jour de l\'alerte.', 'error');
                    }
                }
            });
        });
    </script>
</body>
</html>
