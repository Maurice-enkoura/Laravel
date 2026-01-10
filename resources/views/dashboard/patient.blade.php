@extends('layouts.app')

@section('title', 'Tableau de bord Patient - MAE')

@section('page-header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h2 mb-2">Tableau de bord</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                <li class="breadcrumb-item active">Tableau de bord</li>
            </ol>
        </nav>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-primary" id="refreshBtn">
            <i class="fas fa-sync-alt"></i>
        </button>
        <a href="{{ route('services.index') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Nouveau rendez-vous
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Welcome Banner -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 bg-gradient-primary text-white overflow-hidden shadow-lg">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="display-6 fw-bold mb-2">Bonjour, {{ auth()->user()->name }} 👋</h1>
                            <p class="lead mb-4 opacity-90">
                                Gérez facilement vos rendez-vous médicaux en ligne.
                                <br>Votre santé, notre priorité.
                            </p>
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ route('services.index') }}" class="btn btn-light btn-lg px-4">
                                    <i class="fas fa-search me-2"></i>Trouver un médecin
                                </a>
                                <a href="{{ route('reservations.my') }}" class="btn btn-outline-light btn-lg px-4">
                                    <i class="fas fa-calendar-alt me-2"></i>Mes rendez-vous
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end">
                            <div class="position-relative">
                                <img src="https://cdn-icons-png.flaticon.com/512/3063/3063812.png"
                                    alt="Patient"
                                    class="img-fluid float"
                                    style="max-height: 180px;">
                                <div class="position-absolute top-0 end-0">
                                    <span class="badge bg-success px-3 py-2">
                                        <i class="fas fa-check me-1"></i>
                                        Patient actif
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
        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-primary-light text-primary">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-link text-muted p-0 border-0" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('reservations.my') }}">Voir tous</a></li>
                        </ul>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2" id="upcomingCount">
                    @php
                    $upcoming = isset($nextAppointments) ? $nextAppointments->count() : 0;
                    @endphp
                    {{ $upcoming }}
                </h2>
                <p class="text-muted mb-2">Rendez-vous à venir</p>
                <div class="progress" style="height: 6px;">
                    
                </div>  


            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-success-light text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="badge bg-success">+2 cette semaine</span>
                </div>
                <h2 class="h1 fw-bold mb-2" id="confirmedCount">
                    {{ isset($nextAppointments) ? $nextAppointments->where('statut', 'confirmée')->count() : 0 }}
                </h2>
                <p class="text-muted mb-2">Confirmés</p>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: 75%"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-warning-light text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span class="badge bg-warning">En attente</span>
                </div>
                <h2 class="h1 fw-bold mb-2" id="pendingCount">
                    {{ isset($nextAppointments) ? $nextAppointments->where('statut', 'en_attente')->count() : 0 }}
                </h2>
                <p class="text-muted mb-2">En attente</p>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-warning" style="width: 40%"></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card h-100">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="stat-icon bg-info-light text-info">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="text-end">
                        <small class="text-muted d-block">Ce mois</small>
                    </div>
                </div>
                <h2 class="h1 fw-bold mb-2" id="pastCount">0</h2>
                <p class="text-muted mb-2">Consultations passées</p>
                <div class="progress" style="height: 6px;">
                    <div class="progress-bar bg-info" style="width: 60%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row g-4">
        <!-- Upcoming Appointments -->
        <div class="col-xl-8">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center bg-white border-0 py-3">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            Mes prochains rendez-vous
                        </h4>
                        <p class="text-muted mb-0 small">Vos 5 prochaines consultations</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-secondary btn-sm" id="prevAppointments">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="btn btn-outline-secondary btn-sm" id="nextAppointments">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <a href="{{ route('reservations.my') }}" class="btn btn-outline-primary">
                            <i class="fas fa-eye me-1"></i>Tout voir
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @php
                    if (!isset($nextAppointments)) {
                    $nextAppointments = \App\Models\Reservation::with(['service', 'service.medecin'])
                    ->where('user_id', auth()->id())
                    ->where('statut', '!=', 'annulée')
                    ->whereDate('date_reservation', '>=', now())
                    ->orderBy('date_reservation', 'asc')
                    ->orderBy('heure_reservation', 'asc')
                    ->limit(5)
                    ->get();
                    }
                    @endphp

                    @if($nextAppointments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Service</th>
                                    <th>Médecin</th>
                                    <th>Date & Heure</th>
                                    <th>Statut</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($nextAppointments as $reservation)
                                <tr class="border-bottom">
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary-light rounded p-2 me-3">
                                                <i class="fas fa-stethoscope text-primary"></i>
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $reservation->service->nom }}</strong>
                                                <small class="text-muted">
                                                    {{ $reservation->service->tarif ? $reservation->service->tarif . '€' : 'Gratuit' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle-sm bg-gradient-primary text-white me-3">
                                                {{ strtoupper(substr($reservation->service->medecin->name ?? 'D', 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block">Dr. {{ $reservation->service->medecin->name ?? 'Non spécifié' }}</strong>
                                                <small class="text-muted">Médecin</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <strong class="d-block">
                                                {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                            </strong>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>{{ $reservation->heure_reservation }}
                                            </small>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        $statusConfig = [
                                        'en_attente' => ['color' => 'warning', 'icon' => 'clock'],
                                        'confirmée' => ['color' => 'success', 'icon' => 'check-circle'],
                                        'annulée' => ['color' => 'danger', 'icon' => 'times-circle'],
                                        'effectuée' => ['color' => 'info', 'icon' => 'history']
                                        ];
                                        $config = $statusConfig[$reservation->statut] ?? ['color' => 'secondary', 'icon' => 'circle'];
                                        @endphp
                                        <span class="badge bg-{{ $config['color'] }}-light text-{{ $config['color'] }} px-3 py-2">
                                            <i class="fas fa-{{ $config['icon'] }} fa-xs me-1"></i>
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group" role="group">
                                            <a href=""
                                                class="btn btn-sm btn-outline-primary border-end-0"
                                                data-bs-toggle="tooltip"
                                                title="Détails du rendez-vous">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if($reservation->statut == 'en_attente')
                                            <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                                method="POST"
                                                class="d-inline"
                                                onsubmit="return confirmAction('Annuler ce rendez-vous ?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger border-start-0"
                                                    data-bs-toggle="tooltip"
                                                    title="Annuler le rendez-vous">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @if($reservation->statut == 'confirmée')
                                            <a href="#"
                                                class="btn btn-sm btn-outline-success"
                                                data-bs-toggle="tooltip"
                                                title="Recevoir un rappel">
                                                <i class="fas fa-bell"></i>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-calendar-plus fa-4x text-muted opacity-50"></i>
                        </div>
                        <h5 class="text-muted mb-3">Aucun rendez-vous à venir</h5>
                        <p class="text-muted mb-4">Prenez rendez-vous avec un de nos spécialistes.</p>
                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Rechercher un service
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-xl-4">
            <!-- Quick Actions -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Actions rapides
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-3">
                        <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg text-start p-3 border-0 shadow-sm">
                            <div class="d-flex align-items-center">
                                <div class="bg-white bg-opacity-25 rounded p-2 me-3">
                                    <i class="fas fa-search text-white"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Prendre rendez-vous</strong>
                                    <small class="opacity-90">Trouvez un médecin disponible</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('reservations.my') }}" class="btn btn-outline-primary btn-lg text-start p-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-light rounded p-2 me-3">
                                    <i class="fas fa-calendar-alt text-primary"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Mes rendez-vous</strong>
                                    <small class="text-muted">Gérer mes consultations</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>

                        <a href="" class="btn btn-outline-primary btn-lg text-start p-3">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-light rounded p-2 me-3">
                                    <i class="fas fa-user-edit text-primary"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Mon profil</strong>
                                    <small class="text-muted">Mettre à jour mes informations</small>
                                </div>
                                <div class="ms-auto">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Health Tips -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger-light rounded-circle p-2 me-3">
                            <i class="fas fa-heart text-danger"></i>
                        </div>
                        <div>
                            <h6 class="mb-0">Conseil santé du jour</h6>
                            <small class="text-muted">Mis à jour aujourd'hui</small>
                        </div>
                    </div>
                    <p class="mb-3">
                        Hydratez-vous régulièrement. Boire au moins 1.5L d'eau par jour
                        aide à maintenir une bonne santé et à prévenir de nombreuses maladies.
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-info">
                            <i class="fas fa-tag me-1"></i> Nutrition
                        </span>
                        <button class="btn btn-sm btn-link text-decoration-none">
                            <i class="fas fa-share-alt me-1"></i> Partager
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recommended Doctors -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-star me-2 text-warning"></i>
                        Médecins recommandés
                    </h5>
                </div>
                <div class="card-body p-3">
                    @php
                    $recommendedDoctors = [
                    ['name' => 'Dr. Marie Laurent', 'specialty' => 'Médecin généraliste', 'rating' => 4.8, 'icon' => 'user-md'],
                    ['name' => 'Dr. Pierre Martin', 'specialty' => 'Cardiologue', 'rating' => 4.9, 'icon' => 'heartbeat'],
                    ['name' => 'Dr. Sophie Bernard', 'specialty' => 'Ophtalmologue', 'rating' => 4.7, 'icon' => 'eye']
                    ];
                    @endphp

                    @foreach($recommendedDoctors as $doctor)
                    <div class="card border mb-3 hover-shadow">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="bg-primary-light rounded p-2 me-3">
                                    <i class="fas fa-{{ $doctor['icon'] }} text-primary"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">{{ $doctor['name'] }}</h6>
                                    <p class="text-muted small mb-2">{{ $doctor['specialty'] }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <=floor($doctor['rating']))
                                                <i class="fas fa-star fa-xs"></i>
                                                @elseif($i - 0.5 <= $doctor['rating'])
                                                    <i class="fas fa-star-half-alt fa-xs"></i>
                                                    @else
                                                    <i class="far fa-star fa-xs"></i>
                                                    @endif
                                                    @endfor
                                                    <small class="ms-1">{{ $doctor['rating'] }}</small>
                                        </div>
                                        <a href="{{ route('services.index') }}" class="btn btn-sm btn-outline-primary">
                                            Consulter
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Calendar Widget -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-calendar me-2 text-primary"></i>
                        Calendrier des rendez-vous
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="appointmentsCalendar"></div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mb-3">Rendez-vous du mois</h6>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-3">
                                            <i class="fas fa-calendar text-white fa-sm"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Aujourd'hui</small>
                                            <div class="fw-bold">Consultation générale</div>
                                        </div>
                                        <span class="ms-auto badge bg-success">14:30</span>
                                    </div>
                                </div>
                                <div class="list-group-item border-0 px-0">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning rounded-circle p-2 me-3">
                                            <i class="fas fa-calendar text-white fa-sm"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted">Demain</small>
                                            <div class="fw-bold">Ophtalmologie</div>
                                        </div>
                                        <span class="ms-auto badge bg-info">10:00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-circle-sm {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: var(--shadow-sm);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
    }

    .bg-primary-light {
        background-color: var(--primary-light);
    }

    .bg-success-light {
        background-color: #D1FAE5;
    }

    .bg-warning-light {
        background-color: #FEF3C7;
    }

    .bg-info-light {
        background-color: #E0F2FE;
    }

    .bg-danger-light {
        background-color: #FEE2E2;
    }

    .hover-shadow {
        transition: var(--transition);
    }

    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    #appointmentsCalendar {
        min-height: 300px;
        background: var(--gray-light);
        border-radius: var(--radius);
        padding: 1rem;
    }

    .card {
        border-radius: var(--radius-lg);
    }

    .stat-card {
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        background: white;
        box-shadow: var(--shadow);
        border: 1px solid rgba(229, 231, 235, 0.5);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: var(--shadow-sm);
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
    }

    .breadcrumb-item+.breadcrumb-item::before {
        content: "›";
        color: var(--gray);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Refresh button
        document.getElementById('refreshBtn').addEventListener('click', function() {
            this.classList.add('fa-spin');
            setTimeout(() => {
                location.reload();
            }, 500);
        });

        // Initialize calendar
        if (document.getElementById('appointmentsCalendar')) {
            var calendar = new FullCalendar.Calendar(document.getElementById('appointmentsCalendar'), {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                events: [{
                        title: 'Consultation générale',
                        start: new Date(),
                        backgroundColor: 'var(--primary)',
                        borderColor: 'var(--primary)'
                    },
                    {
                        title: 'Ophtalmologie',
                        start: new Date(new Date().setDate(new Date().getDate() + 1)),
                        backgroundColor: 'var(--info)',
                        borderColor: 'var(--info)'
                    }
                ],
                height: 'auto',
                locale: 'fr'
            });
            calendar.render();
        }

        // Appointment navigation
        let currentAppointmentPage = 0;
        const appointmentsPerPage = 5;

        document.getElementById('nextAppointments')?.addEventListener('click', function() {
            currentAppointmentPage++;
            loadAppointments();
        });

        document.getElementById('prevAppointments')?.addEventListener('click', function() {
            if (currentAppointmentPage > 0) {
                currentAppointmentPage--;
                loadAppointments();
            }
        });

        function loadAppointments() {
            // In a real app, you would make an AJAX request here
            console.log('Loading page:', currentAppointmentPage);
        }

        // Set up reminder functionality
        document.querySelectorAll('[data-reminder]').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Ask for notification permission if not already granted
                if (!("Notification" in window)) {
                    alert("Ce navigateur ne supporte pas les notifications");
                    return;
                }

                if (Notification.permission === "granted") {
                    scheduleReminder();
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            scheduleReminder();
                        }
                    });
                }
            });
        });

        function scheduleReminder() {
            // Schedule reminder for 1 hour before appointment
            setTimeout(() => {
                new Notification("Rappel de rendez-vous MediBook", {
                    body: "Vous avez un rendez-vous dans 1 heure",
                    icon: "https://cdn-icons-png.flaticon.com/512/3063/3063812.png"
                });
            }, 1000); // 1 second for demo, should be appropriate time

            // Show confirmation
            const toast = new bootstrap.Toast(document.getElementById('reminderToast'));
            toast.show();
        }

        // Auto-update stats every 30 seconds
        setInterval(() => {
            // In a real app, you would fetch updated data from the server
            console.log('Auto-refreshing stats...');
        }, 30000);
    });

    // Toast notification for reminders
    const reminderToastHTML = `
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="reminderToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <i class="fas fa-bell me-2"></i>
                    <strong class="me-auto">Rappel programmé</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    Vous recevrez une notification 1 heure avant votre rendez-vous.
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', reminderToastHTML);
</script>
@endsection