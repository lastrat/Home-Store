<footer class="bg-brand-dark text-white mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-20 w-20">
                        <img src="{{ asset('logo/blznc@3x-8.png') }}" alt="Home Store" class="h-full w-full object-cover">
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                    Votre destination mode et décoration haut de gamme. Découvrez notre collection exclusive et vivez l'expérience shopping chic.
                </p>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gold-400 uppercase tracking-wider mb-4">Navigation</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Accueil</a></li>
                    <li><a href="{{ route('concept') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Notre Concept</a></li>
                    <li><a href="{{ route('activities') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Nos Activités</a></li>
                    <li><a href="{{ route('boutique') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Notre Boutique</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-gold-400 text-sm transition-colors">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-sm font-semibold text-gold-400 uppercase tracking-wider mb-4">Contact</h4>
                <ul class="space-y-3">
                    <li class="flex items-start gap-2 text-sm text-gray-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-400 mt-0.5 flex-shrink-0">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        +225 01 00 00 00 00
                    </li>
                    <li class="flex items-start gap-2 text-sm text-gray-400">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-gold-400 mt-0.5 flex-shrink-0">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        contact@homestore.ci
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 mt-12 pt-8 text-center">
            <p class="text-sm text-gray-500">© {{ date('Y') }} Home Store - Chic Living. Tous droits réservés.</p>
        </div>
    </div>
</footer>

