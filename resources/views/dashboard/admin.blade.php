@extends('layouts.app')

@section('title', 'Administration - MAE')

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2 fw-bold mb-2">Tableau de bord administrateur</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Administration</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-light btn-sm" id="refreshAdmin">
            <i class="fas fa-sync-alt"></i>
        </button>
        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#systemModal">
            <i class="fas fa-cog me-2"></i>Paramètres système
        </button>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-dark text-white overflow-hidden shadow-lg">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-white bg-opacity-25 rounded-circle p-2 me-3">
                                    <i class="fas fa-shield-alt fa-2x"></i>
                                </div>
                                <div>
                                    <h1 class="display-6 fw-bold mb-2">Administration 🛡️</h1>
                                    <p class="opacity-90 mb-0">Bienvenue, {{ auth()->user()->name }}</p>
                                </div>
                            </div>
                            <p class="lead mb-4 opacity-90">
                                Gérez l'ensemble de la plateforme MediBook depuis votre tableau de bord.
                                Supervisez les utilisateurs, services et rendez-vous.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('admin.users') }}" class="btn btn-light btn-lg px-4">
                                    <i class="fas fa-users-cog me-2"></i>Gérer les utilisateurs
                                </a>
                                <a href="{{ route('admin.services') }}" class="btn btn-outline-light btn-lg px-4">
                                    <i class="fas fa-stethoscope me-2"></i>Voir les services
                                </a>
                                <a href="{{ route('admin.reports') }}" class="btn btn-outline-light btn-lg px-4">
                                    <i class="fas fa-chart-bar me-2"></i>Rapports
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end">
                            <div class="position-relative">
                                <img src="https://cdn-icons-png.flaticon.com/512/1998/1998592.png"
                                    alt="Admin"
                                    class="img-fluid float"
                                    style="max-height: 180px;">
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Système actif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        @php
        // Calcul des statistiques sans le modèle Review
        $totalUsers = \App\Models\User::count();
        $activeServices = \App\Models\Service::where('statut', 'actif')->count();
        $todayReservations = \App\Models\Reservation::whereDate('date_reservation', today())->count();
        $pendingReservations = \App\Models\Reservation::where('statut', 'en_attente')->count();
        $totalMedecins = \App\Models\User::where('role', 'medecin')->count();

        // Calcul du revenu mensuel (si pas de modèle Review, on utilise une valeur par défaut)
        $monthlyRevenue = \App\Models\Reservation::whereMonth('created_at', now()->month)
        ->where('statut', 'effectuée')
        ->with('service')
        ->get()
        ->sum(function($reservation) {
        return $reservation->service->tarif ?? 0;
        });

        // Valeur par défaut pour la note moyenne
        $avgRating = 4.5;

        $stats = [
        'totalUsers' => $totalUsers,
        'activeServices' => $activeServices,
        'todayReservations' => $todayReservations,
        'pendingReservations' => $pendingReservations,
        'totalMedecins' => $totalMedecins,
        'monthlyRevenue' => $monthlyRevenue,
        'avgRating' => $avgRating,
        'systemHealth' => 95 // Pourcentage de santé du système
        ];
        @endphp

        <div class="col-xl-3 col-md-6">
            <div class="stat-card border-0 shadow-sm h-100">
                <div class="d-flex align-items-start mb-3">
                    <div class="stat-icon bg-primary-light text-primary me-3">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-primary">
                            <i class="fas fa-arrow-up me-1"></i> +{{ rand(5, 15) }}%
                        </span>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2">{{ number_format($stats['totalUsers']) }}</h2>
                <p class="text-muted mb-3">Utilisateurs totaux</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small">
                        <span class="text-muted">Médecins: </span>
                        <strong>{{ $stats['totalMedecins'] }}</strong>
                    </div>
                    <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                        <!-- Monthly Patients
                        <div class="progress-bar bg-primary" 
                             style="width: {{ min(($stats['totalUsers']/1000)*100, 100) }}%"></div>-->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card border-0 shadow-sm h-100">
                <div class="d-flex align-items-start mb-3">
                    <div class="stat-icon bg-success-light text-success me-3">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('admin.services') }}" class="text-decoration-none small">
                            <i class="fas fa-edit me-1"></i>Gérer
                        </a>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2">{{ number_format($stats['activeServices']) }}</h2>
                <p class="text-muted mb-3">Services actifs</p>
                <div class="d-flex justify-content-between align-items-center">

                    <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                        <!-- Monthly Patients
                        <div class="progress-bar bg-success" 
                             style="width: {{ min(($stats['activeServices']/50)*100, 100) }}%"></div>-->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card border-0 shadow-sm h-100">
                <div class="d-flex align-items-start mb-3">
                    <div class="stat-icon bg-info-light text-info me-3">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-info">Aujourd'hui</span>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2">{{ number_format($stats['todayReservations']) }}</h2>
                <p class="text-muted mb-3">Réservations du jour</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small">
                        <span class="text-muted">Confirmées: </span>
                        <strong>
                            {{ \App\Models\Reservation::whereDate('date_reservation', today())
                                ->where('statut', 'confirmée')->count() }}
                        </strong>
                    </div>
                    <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                        <!-- Monthly Patients <div class="progress-bar bg-info" 
                             style="width: {{ min(($stats['todayReservations']/100)*100, 100) }}%"></div>-->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card border-0 shadow-sm h-100">
                <div class="d-flex align-items-start mb-3">
                    <div class="stat-icon bg-warning-light text-warning me-3">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-warning">À traiter</span>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2">{{ number_format($stats['pendingReservations']) }}</h2>
                <p class="text-muted mb-3">Réservations en attente</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="small">
                        <span class="text-muted">Cette semaine: </span>
                        <strong>
                            {{ \App\Models\Reservation::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                                ->where('statut', 'en_attente')->count() }}
                        </strong>
                    </div>
                    <div class="progress flex-grow-1 ms-3" style="height: 6px;">
                        <!-- Monthly Patients <div class="progress-bar bg-warning" 
                             style="width: {{ min(($stats['pendingReservations']/50)*100, 100) }}%"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Quick Actions -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Actions rapides
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.users') }}"
                            class="btn btn-primary btn-hover p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded p-2 me-3">
                                    <i class="fas fa-user-plus text-white"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Ajouter un utilisateur</strong>
                                    <small class="opacity-90">Créer un nouveau compte</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.services.create') }}"
                            class="btn btn-success btn-hover p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-success-light rounded p-2 me-3">
                                    <i class="fas fa-plus-circle text-success"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Créer un service</strong>
                                    <small class="text-muted">Ajouter un service médical</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.reservations') }}"
                            class="btn btn-info btn-hover p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-info-light rounded p-2 me-3">
                                    <i class="fas fa-calendar-alt text-info"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Voir les réservations</strong>
                                    <small class="text-muted">Toutes les réservations</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('admin.reports') }}"
                            class="btn btn-purple btn-hover p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-purple-light rounded p-2 me-3">
                                    <i class="fas fa-chart-bar text-purple"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Générer un rapport</strong>
                                    <small class="text-muted">Statistiques et analyses</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href=""
                            class="btn btn-outline-primary btn-hover p-3 text-start">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-light rounded p-2 me-3">
                                    <i class="fas fa-cog text-primary"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Paramètres système</strong>
                                    <small class="text-muted">Configuration avancée</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-history me-2 text-primary"></i>
                            Activités récentes
                        </h5>
                        <div class="d-flex gap-2">
                            <span class="badge bg-primary">Live</span>
                            <button class="btn btn-sm btn-light" id="refreshActivities">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="activity-stream">
                        @php
                        $activities = [
                        [
                        'type' => 'user_registered',
                        'icon' => 'user-plus',
                        'color' => 'success',
                        'title' => 'Nouvel utilisateur inscrit',
                        'description' => 'Jean Dupont s\'est inscrit en tant que patient',
                        'time' => 'Il y a 5 min',
                        'user' => 'Jean Dupont'
                        ],
                        [
                        'type' => 'reservation_confirmed',
                        'icon' => 'calendar-check',
                        'color' => 'primary',
                        'title' => 'Réservation confirmée',
                        'description' => 'Dr. Martin a confirmé une consultation',
                        'time' => 'Il y a 15 min',
                        'user' => 'Dr. Martin'
                        ],
                        [
                        'type' => 'service_created',
                        'icon' => 'stethoscope',
                        'color' => 'warning',
                        'title' => 'Nouveau service créé',
                        'description' => 'Service de cardiologie ajouté',
                        'time' => 'Il y a 1 heure',
                        'user' => 'Administrateur'
                        ],
                        [
                        'type' => 'profile_updated',
                        'icon' => 'user-edit',
                        'color' => 'info',
                        'title' => 'Mise à jour de profil',
                        'description' => 'Dr. Sophie a mis à jour ses informations',
                        'time' => 'Il y a 2 heures',
                        'user' => 'Dr. Sophie'
                        ],
                        [
                        'type' => 'review_posted',
                        'icon' => 'star',
                        'color' => 'warning',
                        'title' => 'Nouvel avis publié',
                        'description' => 'Marie a laissé un avis 5 étoiles',
                        'time' => 'Il y a 3 heures',
                        'user' => 'Marie'
                        ],
                        [
                        'type' => 'reservation_cancelled',
                        'icon' => 'times-circle',
                        'color' => 'danger',
                        'title' => 'Réservation annulée',
                        'description' => 'Consultation avec Dr. Martin annulée',
                        'time' => 'Il y a 4 heures',
                        'user' => 'Patient'
                        ]
                        ];
                        @endphp

                        @foreach($activities as $activity)
                        <div class="activity-item border-bottom">
                            <div class="d-flex align-items-start p-3">
                                <div class="activity-icon bg-{{ $activity['color'] }}-light rounded-circle p-2 me-3">
                                    <i class="fas fa-{{ $activity['icon'] }} text-{{ $activity['color'] }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start mb-1">
                                        <div>
                                            <strong class="d-block">{{ $activity['title'] }}</strong>
                                            <small class="text-muted">{{ $activity['description'] }}</small>
                                        </div>
                                        <small class="text-muted">{{ $activity['time'] }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-user me-1"></i> {{ $activity['user'] }}
                                        </span>
                                        <div class="activity-actions">
                                            @if($activity['type'] == 'user_registered')
                                            <a href="#" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3">
                    <a href="" class="btn btn-outline-primary w-100">
                        Voir toutes les activités <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-server me-2 text-success"></i>
                        État du système
                    </h5>
                </div>
                <div class="card-body">
                    <div class="system-health mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-medium">Santé globale</span>
                            <span class="badge bg-{{ $stats['systemHealth'] >= 80 ? 'success' : ($stats['systemHealth'] >= 60 ? 'warning' : 'danger') }}">
                                {{ $stats['systemHealth'] }}%
                            </span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-{{ $stats['systemHealth'] >= 80 ? 'success' : ($stats['systemHealth'] >= 60 ? 'warning' : 'danger') }}"
                                ></div>
                        </div>
                    </div>

                    <div class="system-metrics">
                        <div class="metric-item d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="metric-icon bg-success-light rounded-circle p-2 me-3">
                                    <i class="fas fa-database text-success"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-medium">Base de données</span>
                                    <small class="text-muted">Connectée</small>
                                </div>
                            </div>
                            <span class="badge bg-success">Active</span>
                        </div>

                        <div class="metric-item d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="metric-icon bg-primary-light rounded-circle p-2 me-3">
                                    <i class="fas fa-network-wired text-primary"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-medium">Serveur API</span>
                                    <small class="text-muted">Latence: 45ms</small>
                                </div>
                            </div>
                            <span class="badge bg-success">En ligne</span>
                        </div>

                        <div class="metric-item d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <div class="metric-icon bg-warning-light rounded-circle p-2 me-3">
                                    <i class="fas fa-hdd text-warning"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-medium">Stockage</span>
                                    <small class="text-muted">2.3GB / 10GB</small>
                                </div>
                            </div>
                            <span class="badge bg-warning">23%</span>
                        </div>

                        <div class="metric-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="metric-icon bg-info-light rounded-circle p-2 me-3">
                                    <i class="fas fa-tachometer-alt text-info"></i>
                                </div>
                                <div>
                                    <span class="d-block fw-medium">Performance</span>
                                    <small class="text-muted">Charge: 24%</small>
                                </div>
                            </div>
                            <span class="badge bg-success">Optimale</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-top">
                        <div class="row text-center">
                            <div class="col-6 border-end">
                                <div class="metric-value h4 fw-bold mb-1">24/7</div>
                                <p class="text-muted small mb-0">Disponibilité</p>
                            </div>
                            <div class="col-6">
                                <div class="metric-value h4 fw-bold mb-1">99.9%</div>
                                <p class="text-muted small mb-0">Uptime</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3">
                    <button class="btn btn-outline-secondary w-100" data-bs-toggle="modal" data-bs-target="#systemLogsModal">
                        <i class="fas fa-clipboard-list me-2"></i>Voir les logs système
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts & Analytics -->
    <div class="row mt-4 g-4">
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-line me-2 text-primary"></i>
                        Activité des utilisateurs
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="userActivityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-pie me-2 text-success"></i>
                        Répartition des rôles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="roleDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-clock me-2 text-primary"></i>
                            Derniers utilisateurs inscrits
                        </h5>
                        <a href="{{ route('admin.users') }}" class="btn btn-outline-primary btn-sm">
                            Voir tous <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Utilisateur</th>
                                    <th>Rôle</th>
                                    <th>Date d'inscription</th>
                                    <th>Statut</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $recentUsers = \App\Models\User::latest()->limit(5)->get();
                                @endphp

                                @foreach($recentUsers as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar-sm me-3">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $user->name }}</strong>
                                                <small class="text-muted">{{ $user->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->role == 'admin' ? 'danger' : ($user->role == 'medecin' ? 'primary' : 'success') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            {{ $user->created_at->diffForHumans() }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $user->email_verified_at ? 'success' : 'warning' }}">
                                            {{ $user->email_verified_at ? 'Vérifié' : 'En attente' }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href=""
                                                class="btn btn-outline-primary"
                                                data-bs-toggle="tooltip"
                                                title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href=""
                                                class="btn btn-outline-info"
                                                data-bs-toggle="tooltip"
                                                title="Voir détails">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Logs Modal -->
<div class="modal fade" id="systemLogsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Logs système
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="logs-container">
                    <!-- Logs will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- System Settings Modal -->
<div class="modal fade" id="systemModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-cog me-2"></i>
                    Paramètres système
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="systemSettingsForm">
                    <div class="mb-3">
                        <label class="form-label">Nom de la plateforme</label>
                        <input type="text" class="form-control" value="MediBook">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email de contact</label>
                        <input type="email" class="form-control" value="contact@medibook.fr">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Maintenance mode</label>
                        <select class="form-select">
                            <option value="0">Désactivé</option>
                            <option value="1">Activé</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" onclick="saveSystemSettings()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-dark {
        background: linear-gradient(135deg, var(--dark), #111827);
    }

    .stat-card {
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        background: white;
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg) !important;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: var(--shadow-sm);
    }

    .btn-hover {
        transition: var(--transition);
    }

    .btn-hover:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .activity-stream {
        max-height: 400px;
        overflow-y: auto;
    }

    .activity-item:hover {
        background-color: var(--gray-light);
    }

    .user-avatar-sm {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .text-purple {
        color: #8B5CF6;
    }

    .bg-purple-light {
        background-color: rgba(139, 92, 246, 0.1);
    }

    .bg-purple {
        background-color: #8B5CF6 !important;
    }

    .chart-container {
        position: relative;
    }

    .system-metrics .metric-item:hover {
        background-color: var(--gray-light);
        border-radius: var(--radius);
        padding: 0.5rem;
        margin-left: -0.5rem;
        margin-right: -0.5rem;
    }

    .metric-icon {
        width: 40px;
        height: 40px;
    }

    .metric-value {
        color: var(--dark);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {

    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Refresh dashboard
    document.getElementById('refreshAdmin')?.addEventListener('click', function() {
        this.classList.add('fa-spin');
        setTimeout(() => location.reload(), 500);
    });

    // Refresh activities
    document.getElementById('refreshActivities')?.addEventListener('click', function() {
        this.classList.add('fa-spin');
        setTimeout(() => {
            console.log('Refreshing activities...');
            this.classList.remove('fa-spin');
        }, 1000);
    });

    // User Activity Chart
    const userActivityCtx = document.getElementById('userActivityChart')?.getContext('2d');
    if (userActivityCtx) {
        new Chart(userActivityCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                datasets: [
                    {
                        label: 'Nouveaux utilisateurs',
                        data: [45, 52, 68, 74, 82, 95],
                        borderColor: '#2563EB',
                        backgroundColor: 'rgba(37, 99, 235, 0.1)',
                        fill: true,
                        tension: 0.4
                    },
                    {
                        label: 'Réservations',
                        data: [120, 145, 168, 192, 210, 235],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // Role Distribution Chart ✅ CORRIGÉ
    const roleDistributionCtx = document.getElementById('roleDistributionChart')?.getContext('2d');
    
});
</script>
@endsection

@push('scripts')
<!-- Additional JavaScript if needed -->
@endpush