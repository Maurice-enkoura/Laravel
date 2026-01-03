<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicae - Accueil Client</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .service-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 p-2 rounded-lg">
                        <i class="fas fa-heartbeat text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Medicae</h1>
                        <p class="text-sm text-gray-600">Plateforme de santé</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ route('accueil') }}" class="text-blue-600 font-semibold">
                        <i class="fas fa-home mr-2"></i>Accueil
                    </a>
                    <a href="#services" class="text-gray-700 hover:text-blue-600 transition">
                        <i class="fas fa-stethoscope mr-2"></i>Services
                    </a>
                    
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">
                            <i class="fas fa-user mr-2"></i>Mon compte
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" 
                               class="px-4 py-2 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 transition">
                                <i class="fas fa-sign-in-alt mr-2"></i>Connexion
                            </a>
                            <a href="{{ route('register') }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-user-plus mr-2"></i>Inscription
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Votre santé, <span class="text-yellow-300">notre priorité</span>
                </h1>
                <p class="text-xl mb-8 opacity-90">
                    Prenez rendez-vous en ligne avec les meilleurs professionnels de santé.
                    Simple, rapide et sécurisé.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#services" 
                       class="px-8 py-4 bg-white text-blue-600 rounded-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 text-center">
                        <i class="fas fa-search mr-2"></i>Voir nos services
                    </a>
                    @guest
                    <a href="{{ route('register') }}" 
                       class="px-8 py-4 bg-yellow-400 text-gray-800 rounded-lg font-semibold text-lg hover:bg-yellow-300 transition duration-300 text-center">
                        <i class="fas fa-user-plus mr-2"></i>Créer un compte
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Nos Services Médicaux
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Découvrez nos services de santé de qualité, assurés par des professionnels expérimentés
                </p>
            </div>
            
            @if($services->count() > 0)
                <!-- Cartes de services -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($services as $service)
                    <div class="service-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="bg-blue-100 p-3 rounded-lg">
                                    @php
                                        // Icône selon le type de service
                                        $icon = 'fa-stethoscope';
                                        $color = 'blue';
                                        if (str_contains(strtolower($service->titre), 'cardio')) {
                                            $icon = 'fa-heart';
                                            $color = 'red';
                                        } elseif (str_contains(strtolower($service->titre), 'pédia')) {
                                            $icon = 'fa-child';
                                            $color = 'green';
                                        } elseif (str_contains(strtolower($service->titre), 'derma')) {
                                            $icon = 'fa-allergies';
                                            $color = 'purple';
                                        } elseif (str_contains(strtolower($service->titre), 'gynéco')) {
                                            $icon = 'fa-female';
                                            $color = 'pink';
                                        } elseif (str_contains(strtolower($service->titre), 'ophtal')) {
                                            $icon = 'fa-eye';
                                            $color = 'indigo';
                                        } elseif (str_contains(strtolower($service->titre), 'dent')) {
                                            $icon = 'fa-tooth';
                                            $color = 'teal';
                                        } elseif (str_contains(strtolower($service->titre), 'urgence')) {
                                            $icon = 'fa-ambulance';
                                            $color = 'red';
                                        } elseif (str_contains(strtolower($service->titre), 'vaccin')) {
                                            $icon = 'fa-syringe';
                                            $color = 'green';
                                        } elseif (str_contains(strtolower($service->titre), 'chirurg')) {
                                            $icon = 'fa-scalpel';
                                            $color = 'orange';
                                        } elseif (str_contains(strtolower($service->titre), 'psycho')) {
                                            $icon = 'fa-brain';
                                            $color = 'purple';
                                        } elseif (str_contains(strtolower($service->titre), 'kinési')) {
                                            $icon = 'fa-hands-helping';
                                            $color = 'blue';
                                        } elseif (str_contains(strtolower($service->titre), 'travail')) {
                                            $icon = 'fa-briefcase-medical';
                                            $color = 'gray';
                                        }
                                    @endphp
                                    <i class="fas {{ $icon }} text-{{ $color }}-600 text-2xl"></i>
                                </div>
                                <span class="{{ $service->statut === 'actif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} text-xs font-semibold px-3 py-1 rounded-full">
                                    {{ $service->statut === 'actif' ? 'Disponible' : 'Indisponible' }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">{{ $service->titre }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($service->description, 100) }}</p>
                            
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-clock text-blue-500 mr-2"></i>
                                    <span class="text-sm">Durée : {{ $service->duree }} minutes</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-user-md text-blue-500 mr-2"></i>
                                    <span class="text-sm">
                                        Médecin : 
                                        @if($service->medecin)
                                            Dr. {{ $service->medecin->name ?? 'Non spécifié' }}
                                        @else
                                            Non spécifié
                                        @endif
                                    </span>
                                </div>
                                @if($service->date)
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                                    <span class="text-sm">Date : {{ \Carbon\Carbon::parse($service->date)->format('d/m/Y') }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-blue-600">{{ number_format($service->prix, 0, ',', ' ') }} FCFA</span>
                                
                                @if($service->statut === 'actif')
                                    @auth
                                        <form action="{{ route('reservations.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="service_id" value="{{ $service->id }}">
                                            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
                                                <i class="fas fa-calendar-check mr-2"></i> RÉSERVER
                                            </button>
                                        </form>
                                    @else
                                        <button onclick="showLoginAlert()" 
                                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center">
                                            <i class="fas fa-calendar-check mr-2"></i> RÉSERVER
                                        </button>
                                    @endauth
                                @else
                                    <button disabled 
                                            class="px-6 py-2 bg-gray-400 text-white rounded-lg cursor-not-allowed flex items-center">
                                        <i class="fas fa-times mr-2"></i> INDISPONIBLE
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($services->hasPages())
                <div class="mt-10 flex justify-center">
                    <div class="flex space-x-2">
                        @if($services->onFirstPage())
                            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                                <i class="fas fa-chevron-left mr-2"></i> Précédent
                            </span>
                        @else
                            <a href="{{ $services->previousPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <i class="fas fa-chevron-left mr-2"></i> Précédent
                            </a>
                        @endif
                        
                        @foreach(range(1, $services->lastPage()) as $page)
                            @if($page == $services->currentPage())
                                <span class="px-4 py-2 bg-blue-700 text-white rounded-lg">{{ $page }}</span>
                            @else
                                <a href="{{ $services->url($page) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">{{ $page }}</a>
                            @endif
                        @endforeach
                        
                        @if($services->hasMorePages())
                            <a href="{{ $services->nextPageUrl() }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                Suivant <i class="fas fa-chevron-right ml-2"></i>
                            </a>
                        @else
                            <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                                Suivant <i class="fas fa-chevron-right ml-2"></i>
                            </span>
                        @endif
                    </div>
                </div>
                @endif
                
            @else
                <!-- Message si aucun service -->
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-2xl p-8 max-w-md mx-auto">
                        <i class="fas fa-clipboard-list text-5xl text-gray-400 mb-4"></i>
                        <h3 class="text-xl font-bold text-gray-700 mb-2">Aucun service disponible</h3>
                        <p class="text-gray-600">Aucun service médical n'est actuellement disponible.</p>
                        <p class="text-gray-600 mt-2">Revenez plus tard ou contactez-nous.</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Comment ça marche -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    Comment ça marche ?
                </h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    3 étapes simples pour prendre rendez-vous
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">1</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Choisissez un service</h3>
                    <p class="text-gray-600">
                        Parcourez notre catalogue de services médicaux et sélectionnez celui qui vous convient.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">2</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Connectez-vous</h3>
                    <p class="text-gray-600">
                        Créez un compte ou connectez-vous pour accéder à notre plateforme de réservation.
                    </p>
                </div>
                
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <div class="bg-blue-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold">3</div>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Confirmez le rendez-vous</h3>
                    <p class="text-gray-600">
                        Sélectionnez la date et l'horaire qui vous conviennent et confirmez votre rendez-vous.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-blue-500 p-2 rounded-lg">
                            <i class="fas fa-heartbeat text-white text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">Medicae</h2>
                    </div>
                    <p class="text-gray-400">
                        Votre plateforme de santé en ligne. Prenez rendez-vous facilement avec les meilleurs professionnels.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Liens rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('accueil') }}" class="text-gray-400 hover:text-white transition">Accueil</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-white transition">Services</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">À propos</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-envelope mr-3"></i> contact@medicae.com
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-phone mr-3"></i> +221 33 123 45 67
                        </li>
                        <li class="flex items-center text-gray-400">
                            <i class="fas fa-map-marker-alt mr-3"></i> Dakar, Sénégal
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-4">Statistiques</h3>
                    <ul class="space-y-2">
                        <li class="text-gray-400">
                            <i class="fas fa-user-md mr-2"></i> {{ $services->total() }} services disponibles
                        </li>
                        <li class="text-gray-400">
                            <i class="fas fa-users mr-2"></i> Professionnels qualifiés
                        </li>
                        <li class="text-gray-400">
                            <i class="fas fa-calendar-check mr-2"></i> Réservation 24/7
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Medicae. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function showLoginAlert() {
            const isConfirmed = confirm("Pour réserver un service, vous devez être connecté.\n\nSouhaitez-vous vous connecter maintenant ?");
            if (isConfirmed) {
                window.location.href = "{{ route('login') }}";
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const serviceCards = document.querySelectorAll('.service-card');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, { threshold: 0.1 });
            
            serviceCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
        });
    </script>
</body>
</html>