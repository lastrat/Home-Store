<nav class="fixed top-0 left-0 right-0 z-50 bg-brand-dark transition-all duration-500" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="h-12 w-12">
                    <img src="{{ asset('logo/blznc@3x-8.png') }}" alt="Home Store" class="h-full w-full object-cover">
                </div>
            </a>

            <div class="hidden md:flex items-center gap-1">
                <a href="{{ route('home') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-colors rounded-full hover:bg-white/5">Accueil</a>
                <a href="{{ route('concept') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-colors rounded-full hover:bg-white/5">Concept</a>
                <a href="{{ route('activities') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-colors rounded-full hover:bg-white/5">Activités</a>
                <a href="{{ route('boutique') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-colors rounded-full hover:bg-white/5">Boutique</a>
                <a href="{{ route('contact') }}" class="nav-link px-4 py-2 text-sm font-medium text-white/80 hover:text-gold-400 transition-colors rounded-full hover:bg-white/5">Contact</a>
            </div>

            <div class="hidden md:flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-ghost text-white text-sm">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-primary text-sm">Accéder au Catalogue</a>
                @else
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary text-sm">Mon Catalogue</a>
                    <a href="{{ route('cart.index') }}" class="relative btn btn-ghost text-white p-2">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        @php
                            $cartCount = auth()->user()->cart?->items_count ?? 0;
                        @endphp
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-gold-500 text-black text-xs font-bold rounded-full flex items-center justify-center {{ $cartCount > 0 ? '' : 'hidden' }}" data-cart-count>{{ $cartCount }}</span>
                    </a>
                    <div class="relative group">
                        <button class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-white/5 transition-colors">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold-400 to-gold-600 flex items-center justify-center text-black font-bold text-sm">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </button>
                        <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                            <a href="{{ route('account.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50 first:rounded-t-2xl">Mon Compte</a>
                            <a href="{{ route('account.orders') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">Mes Commandes</a>
                            <a href="{{ route('account.wishlists') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">Mes Coups de Cœur</a>
                            <a href="{{ route('account.alerts') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">Mes Alertes</a>
                            @if(auth()->user()->is_admin)
                                <div class="border-t border-gray-100"></div>
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm text-gold-700 hover:bg-gold-50 font-medium">Admin</a>
                            @endif
                            <div class="border-t border-gray-100"></div>
                            <form method="POST" action="{{ route('logout') }}" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 last:rounded-b-2xl">Déconnexion</button>
                            </form>
                        </div>
                    </div>
                @endguest
            </div>

            <button class="md:hidden text-white p-2" id="mobile-menu-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <div class="md:hidden hidden bg-brand-dark/95 backdrop-blur-xl border-t border-white/10" id="mobile-menu">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Accueil</a>
            <a href="{{ route('concept') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Concept</a>
            <a href="{{ route('activities') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Activités</a>
            <a href="{{ route('boutique') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Boutique</a>
            <a href="{{ route('contact') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Contact</a>
            <div class="border-t border-white/10 my-2"></div>
            @guest
                <a href="{{ route('login') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Connexion</a>
                <a href="{{ route('register') }}" class="block px-4 py-3 text-gold-400 font-medium rounded-xl hover:bg-white/5">Accéder au Catalogue</a>
            @else
                <a href="{{ route('catalog.index') }}" class="block px-4 py-3 text-gold-400 font-medium rounded-xl hover:bg-white/5">Mon Catalogue</a>
                <a href="{{ route('cart.index') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Mon Panier</a>
                <a href="{{ route('account.index') }}" class="block px-4 py-3 text-white rounded-xl hover:bg-white/5">Mon Compte</a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-red-400 rounded-xl hover:bg-white/5">Déconnexion</button>
                </form>
            @endguest
        </div>
    </div>

    <script>
        const navbar = document.getElementById('navbar');
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-brand-dark/80', 'backdrop-blur-xl', 'shadow-lg', 'border-b', 'border-white/5');
            } else {
                navbar.classList.remove('bg-brand-dark/80', 'backdrop-blur-xl', 'shadow-lg', 'border-b', 'border-white/5');
            }
        });

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</nav>
