<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MediBook - Réservation Médicale')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary: #2D6FF7;
            --primary-light: #E8F1FF;
            --secondary: #10B981;
            --accent: #F59E0B;
            --dark: #1F2937;
            --light: #F9FAFB;
            --gray: #6B7280;
            --gray-light: #E5E7EB;
            --danger: #EF4444;
            --success: #10B981;
            --warning: #F59E0B;
            --radius: 12px;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark);
            background-color: var(--light);
            line-height: 1.6;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        /* Navigation */
        .navbar {
            background: white;
            box-shadow: var(--shadow);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: var(--dark);
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 0.25rem;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--primary-light);
            color: var(--primary);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Cards */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .card-header {
            background: white;
            border-bottom: 2px solid var(--primary-light);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.625rem 1.25rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), #4F83FF);
            box-shadow: 0 4px 12px rgba(45, 111, 247, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(45, 111, 247, 0.35);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
        }

        /* Badges */
        .badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.75rem;
        }

        /* Tables */
        .table {
            border-radius: var(--radius);
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-light);
            border: none;
            font-weight: 600;
            color: var(--dark);
            padding: 1rem;
        }

        .table tbody tr {
            transition: background-color 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: var(--light);
        }

        /* Forms */
        .form-control,
        .form-select {
            border-radius: 8px;
            border: 2px solid var(--gray-light);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(45, 111, 247, 0.1);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }

        /* Alerts */
        .alert {
            border-radius: var(--radius);
            border: none;
            padding: 1rem 1.25rem;
        }

        /* Stats Cards */
        .stat-card {
            background: white;
            border-radius: var(--radius);
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border-left: 4px solid var(--primary);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: white;
            margin-top: 4rem;
            padding: 3rem 0 1.5rem;
        }

        footer a {
            color: var(--gray-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: white;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar-nav {
                margin-top: 1rem;
            }
                                                                                                                                                                      
            .stat-card {
                margin-bottom: 1rem;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1E40AF;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-heartbeat"></i>
                <span>MediBook</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    @auth

                    {{-- DASHBOARD --}}
                    <li class="nav-item">
                        @if(auth()->user()->role === 'patient')
                        <a class="nav-link {{ request()->routeIs('dashboard.patient') ? 'active' : '' }}"
                            href="{{ route('dashboard.patient') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord
                        </a>

                        @elseif(auth()->user()->role === 'medecin')
                        <a class="nav-link {{ request()->routeIs('dashboard.medecin') ? 'active' : '' }}"
                            href="{{ route('dashboard.medecin') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord
                        </a>

                        @elseif(auth()->user()->role === 'admin')
                        <a class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}"
                            href="{{ route('dashboard.admin') }}">
                            <i class="fas fa-tachometer-alt me-1"></i>Tableau de bord
                        </a>
                        @endif
                    </li>

                    {{-- PATIENT --}}
                    @if(auth()->user()->role === 'patient')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}"
                            href="{{ route('services.index') }}">
                            <i class="fas fa-stethoscope me-1"></i>Services
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reservations.*') ? 'active' : '' }}"
                            href="{{ route('reservations.my') }}">
                            <i class="fas fa-calendar-alt me-1"></i>Mes Rendez-vous
                        </a>
                    </li>
                    @endif

                    {{-- MEDECIN --}}
                    @if(auth()->user()->role === 'medecin')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('medecin.*') ? 'active' : '' }}"
                            href="{{ route('medecin.reservations') }}">
                            <i class="fas fa-calendar-check me-1"></i>Planning
                        </a>
                    </li>
                    @endif

                    @else
                    {{-- VISITEUR --}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('services.index') }}">
                            <i class="fas fa-stethoscope me-1"></i>Services
                        </a>
                    </li>
                    @endauth
                </ul>



                <ul class="navbar-nav">
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center"
                            href="#"
                            role="button"
                            data-bs-toggle="dropdown">
                            <div class="user-avatar me-2">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                            <li>
                                <a class="dropdown-item" href="">
                                    <i class="fas fa-user-edit me-2"></i>Mon Profil
                                </a>
                            </li>
                            @if(auth()->user()->role === 'patient')
                            <li>
                                <a class="dropdown-item" href="{{ route('reservations.my') }}">
                                    <i class="fas fa-history me-2"></i>Historique
                                </a>
                            </li>
                            @endif
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <a class="dropdown-item text-danger"
                                        href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>Déconnexion
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-1"></i>Connexion
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-1"></i>Inscription
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="fade-in">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h4 class="mb-3">
                        <i class="fas fa-heartbeat me-2"></i>MediBook
                    </h4>
                    <p class="text-gray-300 mb-0">
                        Votre plateforme de réservation médicale simple, rapide et sécurisée.
                    </p>
                </div>
                <div class="col-lg-2 col-md-4 mb-4">
                    <h5 class="mb-3">Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="{{ route('services.index') }}">Services</a></li>
                        @auth
                        @if(auth()->user()->role === 'admin')
                        <li class="mb-2"><a href="{{ route('dashboard.admin') }}">Tableau de bord</a></li>
                        @elseif(auth()->user()->role === 'medecin')
                        <li class="mb-2"><a href="{{ route('dashboard.medecin') }}">Tableau de bord</a></li>
                        @else
                        <li class="mb-2"><a href="{{ route('dashboard.patient') }}">Tableau de bord</a></li>
                        @endif

                        @else
                        <li class="mb-2"><a href="{{ route('login') }}">Connexion</a></li>
                        <li class="mb-2"><a href="{{ route('register') }}">Inscription</a></li>
                        @endauth
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5 class="mb-3">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="fas fa-phone me-2"></i>+33 1 23 45 67 89
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-envelope me-2"></i>contact@medibook.fr
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt me-2"></i>Paris, France
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-4">
                    <h5 class="mb-3">Suivez-nous</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-gray-700">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-gray-300">
                        &copy; {{ date('Y') }} MediBook. Tous droits réservés.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-gray-300 me-3">Mentions légales</a>
                    <a href="#" class="text-gray-300">Politique de confidentialité</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            once: true
        });

        // Auto-dismiss alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert:not(.alert-permanent)');
            alerts.forEach(function(alert) {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });

        // Confirm actions
        function confirmAction(message = 'Êtes-vous sûr ?') {
            return confirm(message);
        }
    </script>

    @stack('scripts')
</body>

</html>