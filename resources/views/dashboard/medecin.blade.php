@extends('layouts.app')

@section('title', 'Tableau de bord Médecin - MediBook')

@push('styles')
<style>
    :root {
        --primary: #2D6FF7;
        --primary-light: rgba(45, 111, 247, 0.1);
        --primary-gradient: linear-gradient(135deg, #2D6FF7 0%, #4F83FF 100%);
        --secondary: #4F83FF;
        --success: #10B981;
        --success-light: rgba(16, 185, 129, 0.1);
        --warning: #F59E0B;
        --warning-light: rgba(245, 158, 11, 0.1);
        --danger: #EF4444;
        --danger-light: rgba(239, 68, 68, 0.1);
        --info: #3B82F6;
        --info-light: rgba(59, 130, 246, 0.1);
        --purple: #8B5CF6;
        --purple-light: rgba(139, 92, 246, 0.1);
        --orange: #F97316;
        --orange-light: rgba(249, 115, 22, 0.1);
        --dark: #1F2937;
        --gray: #6B7280;
        --gray-light: #E5E7EB;
        --light: #F9FAFB;
        --radius: 12px;
        --radius-lg: 16px;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Welcome Banner */
    .welcome-banner {
        background: var(--primary-gradient);
        color: white;
        padding: 3rem 2rem;
        border-radius: var(--radius-lg);
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .doctor-icon {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-right: 1.5rem;
    }

    .welcome-image {
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        box-shadow: var(--shadow);
        transition: var(--transition);
        border: 1px solid var(--gray-light);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.25rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: var(--shadow);
    }

    .stat-trend {
        font-size: 0.75rem;
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-weight: 600;
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 700;
        line-height: 1;
        margin-bottom: 0.5rem;
        color: var(--dark);
        font-family: 'Inter', sans-serif;
    }

    .stat-label {
        color: var(--gray);
        font-weight: 500;
        margin-bottom: 0.75rem;
    }

    .stat-progress {
        height: 6px;
        background: var(--gray-light);
        border-radius: 3px;
        overflow: hidden;
    }

    .stat-progress-bar {
        height: 100%;
        border-radius: 3px;
        transition: width 1s ease;
    }

    /* Day Schedule */
    .schedule-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        overflow: hidden;
        height: 100%;
    }

    .schedule-header {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--primary-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .schedule-header h5 {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .date-navigation {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 1rem;
        padding: 1rem;
        background: var(--light);
        border-radius: var(--radius);
    }

    .date-display {
        text-align: center;
        flex: 1;
    }

    .date-display h6 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
    }

    .date-display small {
        color: var(--gray);
        font-size: 0.875rem;
    }

    .nav-btn {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: 1px solid var(--gray-light);
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        transition: var(--transition);
    }

    .nav-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: scale(1.05);
    }

    /* Day Schedule Items */
    .day-schedule {
        max-height: 500px;
        overflow-y: auto;
        padding: 1rem;
    }

    .schedule-item {
        background: white;
        border: 1px solid var(--gray-light);
        border-left: 4px solid var(--primary);
        border-radius: var(--radius);
        padding: 1rem;
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }

    .schedule-item:hover {
        transform: translateX(4px);
        box-shadow: var(--shadow);
        border-left-color: var(--primary);
    }

    .schedule-item.confirmée {
        border-left-color: var(--success);
    }

    .schedule-item.en_attente {
        border-left-color: var(--warning);
    }

    .schedule-item.effectuée {
        border-left-color: var(--info);
    }

    .schedule-time {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--gray-light);
    }

    .schedule-time .time {
        font-weight: 600;
        color: var(--dark);
        font-size: 1.125rem;
    }

    .schedule-time .duration {
        font-size: 0.875rem;
        color: var(--gray);
        background: var(--gray-light);
        padding: 0.25rem 0.5rem;
        border-radius: 12px;
    }

    /* Patient Avatar */
    .patient-avatar {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: var(--primary-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.125rem;
        flex-shrink: 0;
    }

    .patient-avatar-sm {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: var(--primary-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    .status-confirmée {
        background: var(--success-light);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-en_attente {
        background: var(--warning-light);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-effectuée {
        background: var(--info-light);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    /* Appointment Actions */
    .appointment-actions {
        display: flex;
        gap: 0.5rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--gray-light);
        background: white;
        color: var(--gray);
        transition: var(--transition);
        font-size: 0.875rem;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .action-btn.primary:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .action-btn.success:hover {
        background: var(--success);
        color: white;
        border-color: var(--success);
    }

    .action-btn.info:hover {
        background: var(--info);
        color: white;
        border-color: var(--info);
    }

    /* Appointments Table */
    .appointments-table {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        overflow: hidden;
        height: 100%;
    }

    .appointments-table .table {
        margin: 0;
    }

    .appointments-table thead th {
        background: var(--light);
        border-bottom: 2px solid var(--gray-light);
        font-weight: 600;
        color: var(--dark);
        padding: 1rem 1.5rem;
        white-space: nowrap;
    }

    .appointments-table tbody td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-light);
    }

    .appointments-table tbody tr {
        transition: var(--transition);
    }

    .appointments-table tbody tr:hover {
        background: var(--light);
    }

    /* Contact Buttons */
    .contact-buttons {
        display: flex;
        gap: 0.25rem;
    }

    .contact-btn {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--gray-light);
        background: white;
        color: var(--gray);
        transition: var(--transition);
        font-size: 0.875rem;
    }

    .contact-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow);
    }

    .contact-btn.phone:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .contact-btn.whatsapp:hover {
        background: #25D366;
        color: white;
        border-color: #25D366;
    }

    .contact-btn.email:hover {
        background: var(--info);
        color: white;
        border-color: var(--info);
    }

    /* Quick Actions */
    .quick-actions-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .quick-action {
        display: flex;
        align-items: center;
        padding: 1.25rem 1.5rem;
        text-decoration: none;
        color: inherit;
        border-bottom: 1px solid var(--gray-light);
        transition: var(--transition);
    }

    .quick-action:last-child {
        border-bottom: none;
    }

    .quick-action:hover {
        background: var(--primary-light);
        text-decoration: none;
        transform: translateX(4px);
    }

    .quick-action.primary {
        background: var(--primary);
        color: white;
    }

    .quick-action.primary:hover {
        background: #2563EB;
    }

    .action-icon-wrapper {
        width: 50px;
        height: 50px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .quick-action.primary .action-icon-wrapper {
        background: rgba(255, 255, 255, 0.2);
    }

    .quick-action:not(.primary) .action-icon-wrapper {
        background: var(--primary-light);
        color: var(--primary);
    }

    .quick-action.success .action-icon-wrapper {
        background: var(--success-light);
        color: var(--success);
    }

    .quick-action.info .action-icon-wrapper {
        background: var(--info-light);
        color: var(--info);
    }

    .quick-action.purple .action-icon-wrapper {
        background: var(--purple-light);
        color: var(--purple);
    }

    .action-content {
        flex: 1;
    }

    .action-content strong {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .action-content small {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    .quick-action .arrow {
        color: var(--gray);
        font-size: 0.875rem;
        opacity: 0.7;
    }

    .quick-action.primary .arrow {
        color: white;
    }

    /* Activity Chart */
    .activity-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        overflow: hidden;
    }

    .activity-chart-container {
        padding: 1.5rem;
        height: 150px;
    }

    .activity-stats {
        padding: 1.5rem;
        border-top: 1px solid var(--gray-light);
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--gray-light);
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-item i {
        width: 20px;
        text-align: center;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: var(--gray);
        margin: 0 auto 1.5rem;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeIn 0.6s ease-out;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .welcome-banner {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .welcome-content .d-flex {
            flex-direction: column;
            text-align: center;
        }

        .doctor-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .welcome-buttons {
            flex-direction: column;
            gap: 0.5rem;
        }

        .welcome-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .schedule-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .date-navigation {
            width: 100%;
        }

        .appointments-table {
            display: block;
            overflow-x: auto;
        }

        .appointments-table thead {
            display: none;
        }

        .appointments-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--gray-light);
            border-radius: var(--radius);
            padding: 1rem;
        }

        .appointments-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
            padding: 0.75rem 0;
        }

        .appointments-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--dark);
            margin-right: 1rem;
        }

        .contact-buttons {
            justify-content: flex-end;
        }

        .quick-action {
            padding: 1rem;
        }

        .action-icon-wrapper {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }

    @media (max-width: 992px) {
        .welcome-image {
            margin-top: 2rem;
        }
    }

    /* Custom Colors */
    .text-purple {
        color: var(--purple);
    }

    .bg-purple-light {
        background: var(--purple-light);
    }

    .bg-purple {
        background: var(--purple);
    }

    .text-orange {
        color: var(--orange);
    }

    .bg-orange-light {
        background: var(--orange-light);
    }

    .bg-orange {
        background: var(--orange);
    }

    /* Chart.js Customization */
    .chart-container {
        position: relative;
        height: 100px;
        margin: -1rem -1.5rem;
        padding: 1rem 1.5rem;
    }
</style>
@endpush

@section('page-header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h2 fw-bold mb-2 text-dark">Tableau de bord médecin</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">Accueil</a>
                    </li>
                    <li class="breadcrumb-item active text-primary">Médecin</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary d-flex align-items-center" id="refreshDashboard">
                <i class="fas fa-sync-alt me-2"></i>
                <span class="d-none d-md-inline">Actualiser</span>
            </button>
            <button class="btn btn-primary d-flex align-items-center"
                data-bs-toggle="modal"
                data-bs-target="#quickReservationModal">
                <i class="fas fa-plus me-2"></i>
                <span class="d-none d-md-inline">Nouveau RDV</span>
            </button>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-0">

    <!-- Welcome Banner -->
    <section class="welcome-banner fade-in">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="welcome-content">
                        <div class="d-flex align-items-center mb-3">
                            <div class="doctor-icon">
                                <i class="fas fa-user-md"></i>
                            </div>
                            <div>
                                <h1 class="display-6 fw-bold mb-2">Dr. {{ auth()->user()->name }} 👨‍⚕️</h1>
                                <p class="opacity-90 mb-0">Bienvenue sur votre espace médecin</p>
                            </div>
                        </div>
                        <p class="lead mb-4 opacity-90">
                            Gérez vos consultations, vos patients et votre planning médical.
                            Votre expertise, notre plateforme.
                        </p>
                        <div class="d-flex flex-wrap gap-3 welcome-buttons">
                            <a href="{{ route('medecin.reservations') }}"
                                class="btn btn-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2"></i>Voir le planning
                            </a>
                            <a href="{{ route('medecin.services') }}"
                                class="btn btn-outline-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-stethoscope me-2"></i>Mes services
                            </a>
                            <a href=""
                                class="btn btn-outline-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-users me-2"></i>Mes patients
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="welcome-image text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/3059/3059518.png"
                            alt="Médecin"
                            class="img-fluid"
                            style="max-height: 200px;">
                        <div class="mt-3">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-check me-1"></i>
                                Médecin actif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Overview -->
    <section class="stats-section fade-in">
        <div class="container">
            @php
            // Calculate statistics
            $userId = auth()->id();

            $todayAppointments = \App\Models\Reservation::whereHas('service', function ($q) use ($userId) {
            $q->where('medecin_id', $userId);
            })
            ->whereDate('date_reservation', today())
            ->where('statut', '!=', 'annulée')
            ->count();

            $pendingAppointments = \App\Models\Reservation::whereHas('service', function ($q) use ($userId) {
            $q->where('medecin_id', $userId);
            })
            ->where('statut', 'en_attente')
            ->count();

            $myServices = \App\Models\Service::where('medecin_id', $userId)
            ->where('statut', 'actif')
            ->count();

            $monthlyPatients = \App\Models\Reservation::whereHas('service', function ($q) use ($userId) {
            $q->where('medecin_id', $userId);
            })
            ->whereMonth('created_at', now()->month)
            ->distinct('user_id')
            ->count('user_id');

            $monthRevenue = \App\Models\Reservation::whereHas('service', function ($q) use ($userId) {
            $q->where('medecin_id', $userId);
            })
            ->whereMonth('created_at', now()->month)
            ->where('statut', 'effectuée')
            ->with('service')
            ->get()
            ->sum(function($reservation) {
            return $reservation->service->tarif ?? 0;
            });

            $avgRating = 4.7;
            @endphp

            <div class="stats-grid">
                <!-- Today's Appointments -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon bg-primary-light text-primary">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                        <span class="stat-trend bg-primary text-white">
                            <i class="fas fa-arrow-up me-1"></i> +{{ rand(5, 15) }}%
                        </span>
                    </div>
                    <div class="stat-value">{{ $todayAppointments }}</div>
                    <div class="stat-label">RDV aujourd'hui</div>
                    <div class="stat-progress">
                        <!-- Monthly Patients 
                        <div class="stat-progress-bar bg-primary"
                            style="width: {{ min($todayAppointments * 20, 100) }}%"></div>-->
                    </div>
                </div>

                <!-- Pending Appointments -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon bg-warning-light text-warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <span class="stat-trend bg-warning text-dark">À confirmer</span>
                    </div>
                    <div class="stat-value">{{ $pendingAppointments }}</div>
                    <div class="stat-label">En attente</div>
                    <div class="stat-progress">
                    <!-- Monthly Patients 
                        <div class="stat-progress-bar bg-warning"
                            style="width: {{ min($pendingAppointments * 20, 100) }}%"></div>-->
                    </div>
                </div>

                <!-- Active Services -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon bg-success-light text-success">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <a href="{{ route('medecin.services') }}"
                            class="text-decoration-none small text-success">
                            <i class="fas fa-edit me-1"></i>Gérer
                        </a>
                    </div>
                    <div class="stat-value">{{ $myServices }}</div>
                    <div class="stat-label">Services actifs</div>
                    <div class="stat-progress">
                        <!-- Monthly Patients 
                        <div class="stat-progress-bar bg-success"
                            style="width: {{ min($myServices * 25, 100) }}%"></div>-->
                    </div>
                </div>

                <!-- Monthly Patients -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon bg-info-light text-info">
                            <i class="fas fa-user-injured"></i>
                        </div>
                        <span class="stat-trend bg-info text-white">Ce mois</span>
                    </div>
                    <div class="stat-value">{{ $monthlyPatients }}</div>
                    <div class="stat-label">Nouveaux patients</div>
                    <div class="stat-progress">
                        
                <!-- Monthly Patients
                        <div class="stat-progress-bar bg-info"
                            style="width: {{ min($monthlyPatients * 10, 100) }}%"></div>
                    </div>
                     -->
                </div>

                <!-- Monthly Revenue -->
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon bg-purple-light text-purple">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                        <span class="stat-trend bg-purple text-white">
                            <i class="fas fa-chart-line me-1"></i> +{{ rand(5, 12) }}%
                        </span>
                    </div>
                    <div class="stat-value">{{ number_format($monthRevenue, 0, ',', ' ') }}€</div>
                    <div class="stat-label">Revenu mensuel</div>
                    <div class="stat-progress">
<!--
                        <div class="stat-progress-bar bg-purple"
                            style="width: {{ min(($monthRevenue / 1000) * 100, 100) }}%">
                        </div>
                        
                     Satisfaction Rating -->

                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon bg-orange-light text-orange">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="star-rating small">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $avgRating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($avgRating, 1) }}/5</div>
                        <div class="stat-label">Satisfaction</div>
                        <div class="stat-progress">
                             <!-- Monthly Patients
                            <div class="stat-progress-bar bg-orange"
                            
                                style="width: {{ $avgRating * 20 }}%">
                                
                            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row g-4">
            <!-- Today's Schedule -->
            <div class="col-xl-4">
                <div class="schedule-card fade-in">
                    <div class="schedule-header">
                        <h5>
                            <i class="fas fa-calendar-day text-primary"></i>
                            Agenda du jour
                        </h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle d-flex align-items-center"
                                type="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-1"></i>
                                <span class="d-none d-md-inline">Filtrer</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item filter-item active" href="#" data-filter="all">Tous</a></li>
                                <li><a class="dropdown-item filter-item" href="#" data-filter="confirmée">Confirmés</a></li>
                                <li><a class="dropdown-item filter-item" href="#" data-filter="en_attente">En attente</a></li>
                                <li><a class="dropdown-item filter-item" href="#" data-filter="effectuée">Effectués</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="date-navigation">
                        <button class="nav-btn" id="prevDay" title="Jour précédent">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div class="date-display">
                            <h6 id="currentDate">{{ now()->translatedFormat('l d F Y') }}</h6>
                            <small id="relativeDate">{{ now()->diffForHumans() }}</small>
                        </div>
                        <button class="nav-btn" id="nextDay" title="Jour suivant">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="day-schedule" id="daySchedule">
                        @php
                        $todayReservations = \App\Models\Reservation::with(['user', 'service'])
                        ->whereHas('service', function ($q) use ($userId) {
                        $q->where('medecin_id', $userId);
                        })
                        ->whereDate('date_reservation', today())
                        ->where('statut', '!=', 'annulée')
                        ->orderBy('heure_reservation', 'asc')
                        ->get();
                        @endphp

                        @if($todayReservations->count() > 0)
                        @foreach($todayReservations as $appointment)
                        <div class="schedule-item {{ $appointment->statut }}"
                            data-appointment-id="{{ $appointment->id }}"
                            data-status="{{ $appointment->statut }}">
                            <div class="schedule-time">
                                <span class="time">{{ $appointment->heure_reservation }}</span>
                                <span class="duration">{{ $appointment->service->duree_consultation ?? 30 }} min</span>
                            </div>
                            <div class="schedule-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="patient-avatar">
                                            {{ strtoupper(substr($appointment->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $appointment->user->name }}</h6>
                                            <small class="text-muted">{{ $appointment->service->nom }}</small>
                                        </div>
                                    </div>
                                    <span class="status-badge status-{{ $appointment->statut }}">
                                        {{ ucfirst($appointment->statut) }}
                                    </span>
                                </div>
                                <div class="appointment-actions">
                                    <button class="action-btn primary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewAppointmentModal{{ $appointment->id }}"
                                        title="Voir détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @if($appointment->statut != 'effectuée')
                                    <button class="action-btn success"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateStatusModal{{ $appointment->id }}"
                                        title="Mettre à jour">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @endif
                                    @if($appointment->user->telephone)
                                    <a href="tel:{{ $appointment->user->telephone }}"
                                        class="action-btn"
                                        title="Appeler">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="https://wa.me/{{ $appointment->user->telephone }}"
                                        target="_blank"
                                        class="action-btn"
                                        title="WhatsApp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h6 class="text-muted mb-3">Aucun rendez-vous aujourd'hui</h6>
                            <p class="text-muted small mb-4">Profitez-en pour mettre à jour vos dossiers</p>
                            <button class="btn btn-primary btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#quickReservationModal">
                                <i class="fas fa-plus me-2"></i>Ajouter un RDV
                            </button>
                        </div>
                        @endif
                    </div>

                    <div class="schedule-header border-top">
                        <a href="{{ route('medecin.reservations') }}"
                            class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Voir planning complet
                        </a>
                    </div>
                </div>
            </div>

            <!-- Upcoming Appointments -->
            <div class="col-xl-5">
                <div class="appointments-table fade-in">
                    <div class="schedule-header">
                        <h5>
                            <i class="fas fa-calendar-check text-primary"></i>
                            Prochains rendez-vous
                        </h5>
                        <div class="d-flex gap-2">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text"
                                    class="form-control"
                                    placeholder="Rechercher..."
                                    id="appointmentSearch">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Patient</th>
                                    <th>Date & Heure</th>
                                    <th>Service</th>
                                    <th>Contact</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="appointmentsTableBody">
                                @php
                                $upcomingReservations = \App\Models\Reservation::with(['service', 'user'])
                                ->whereHas('service', function ($q) use ($userId) {
                                $q->where('medecin_id', $userId);
                                })
                                ->where('statut', '!=', 'annulée')
                                ->whereDate('date_reservation', '>=', now())
                                ->orderBy('date_reservation', 'asc')
                                ->orderBy('heure_reservation', 'asc')
                                ->limit(10)
                                ->get();
                                @endphp

                                @foreach($upcomingReservations as $appointment)
                                <tr class="appointment-row"
                                    data-status="{{ $appointment->statut }}"
                                    data-patient="{{ strtolower($appointment->user->name) }}"
                                    data-date="{{ $appointment->date_reservation }}">
                                    <td data-label="Patient">
                                        <div class="d-flex align-items-center">
                                            <div class="patient-avatar-sm me-3">
                                                {{ strtoupper(substr($appointment->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <strong class="d-block">{{ $appointment->user->name }}</strong>
                                                <small class="text-muted">
                                                    {{ $appointment->user->email }}
                                                    @if($appointment->user->telephone)
                                                    <br>{{ $appointment->user->telephone }}
                                                    @endif
                                                </small>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Date & Heure">
                                        <div class="d-flex flex-column">
                                            <strong>{{ \Carbon\Carbon::parse($appointment->date_reservation)->format('d/m/Y') }}</strong>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>{{ $appointment->heure_reservation }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="far fa-calendar me-1"></i>
                                                {{ \Carbon\Carbon::parse($appointment->date_reservation)->diffForHumans() }}
                                            </small>
                                        </div>
                                    </td>
                                    <td data-label="Service">
                                        <span class="badge bg-light text-dark">
                                            {{ $appointment->service->nom }}
                                        </span>
                                        @if($appointment->service->tarif)
                                        <small class="d-block text-muted">
                                            {{ $appointment->service->tarif }}€
                                        </small>
                                        @endif
                                        @if($appointment->service->duree_consultation)
                                        <small class="d-block text-muted">
                                            {{ $appointment->service->duree_consultation }} min
                                        </small>
                                        @endif
                                    </td>
                                    <td data-label="Contact">
                                        <div class="contact-buttons">
                                            @if($appointment->user->telephone)
                                            <a href="tel:{{ $appointment->user->telephone }}"
                                                class="contact-btn phone"
                                                title="Appeler">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                            <a href="https://wa.me/{{ $appointment->user->telephone }}"
                                                target="_blank"
                                                class="contact-btn whatsapp"
                                                title="WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                            @endif
                                            <a href="mailto:{{ $appointment->user->email }}"
                                                class="contact-btn email"
                                                title="Email">
                                                <i class="fas fa-envelope"></i>
                                            </a>
                                        </div>
                                    </td>
                                    <td data-label="Actions" class="text-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light dropdown-toggle"
                                                type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#viewAppointmentModal{{ $appointment->id }}">
                                                        <i class="fas fa-eye me-2"></i>Voir détails
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateStatusModal{{ $appointment->id }}">
                                                        <i class="fas fa-edit me-2"></i>Modifier statut
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-file-medical me-2"></i>Dossier médical
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-prescription me-2"></i>Ordonnance
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-comment-medical me-2"></i>Ajouter note
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <form action=""
                                                        method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                            class="dropdown-item text-danger"
                                                            onclick="return confirmCancel(event, '{{ $appointment->id }}')">
                                                            <i class="fas fa-times me-2"></i>Annuler RDV
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="schedule-header border-top">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span class="text-muted small">
                                {{ $upcomingReservations->count() }} rendez-vous à venir
                            </span>
                            <a href="{{ route('medecin.reservations') }}"
                                class="btn btn-outline-primary btn-sm d-flex align-items-center">
                                Voir tout <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Stats -->
            <div class="col-xl-3">
                <!-- Quick Actions -->
                <div class="quick-actions-card fade-in">
                    <div class="schedule-header">
                        <h5>
                            <i class="fas fa-bolt text-warning"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <a href="{{ route('medecin.reservations.create') }}"
                        class="quick-action primary">
                        <div class="action-icon-wrapper">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="action-content">
                            <strong>Nouveau rendez-vous</strong>
                            <small>Planifier une consultation</small>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href=""
                        class="quick-action success">
                        <div class="action-icon-wrapper">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="action-content">
                            <strong>Mes patients</strong>
                            <small>Liste et historique</small>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href=""
                        class="quick-action info">
                        <div class="action-icon-wrapper">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div class="action-content">
                            <strong>Nouveau service</strong>
                            <small>Ajouter une spécialité</small>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href=""
                        class="quick-action purple">
                        <div class="action-icon-wrapper">
                            <i class="fas fa-prescription"></i>
                        </div>
                        <div class="action-content">
                            <strong>Ordonnances</strong>
                            <small>Gérer les prescriptions</small>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>

                    <a href=""
                        class="quick-action">
                        <div class="action-icon-wrapper">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <div class="action-content">
                            <strong>Paramètres</strong>
                            <small>Profil et préférences</small>
                        </div>
                        <div class="arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </a>
                </div>

                <!-- Monthly Activity -->
                <div class="activity-card fade-in">
                    <div class="schedule-header">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <h5>
                                <i class="fas fa-chart-line text-success"></i>
                                Activité du mois
                            </h5>
                            <span class="badge bg-success">85%</span>
                        </div>
                    </div>
                    <div class="activity-chart-container">
                        <canvas id="activityChart"></canvas>
                    </div>
                    <div class="activity-stats">
                        <div class="stat-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <span class="text-muted">RDV effectués</span>
                            </div>
                            <strong class="text-success">
                                {{ \App\Models\Reservation::whereHas('service', function ($q) use ($userId) {
                                    $q->where('medecin_id', $userId);
                                })
                                ->whereMonth('created_at', now()->month)
                                ->where('statut', 'effectuée')
                                ->count() }}
                            </strong>
                        </div>
                        <div class="stat-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-user-plus text-primary me-2"></i>
                                <span class="text-muted">Nouveaux patients</span>
                            </div>
                            <strong class="text-primary">{{ $monthlyPatients }}</strong>
                        </div>
                        <div class="stat-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clock text-info me-2"></i>
                                <span class="text-muted">Heures travaillées</span>
                            </div>
                            <strong class="text-info">{{ rand(50, 80) }}h</strong>
                        </div>
                        <div class="stat-item">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-percentage text-warning me-2"></i>
                                <span class="text-muted">Taux de remplissage</span>
                            </div>
                            <strong class="text-warning">85%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Appointment Modal -->


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Refresh dashboard
        const refreshBtn = document.getElementById('refreshDashboard');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                this.querySelector('i').classList.add('fa-spin');
                setTimeout(() => {
                    location.reload();
                }, 500);
            });
        }

        // Date navigation
        let currentDate = new Date();

        document.getElementById('prevDay')?.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() - 1);
            updateDateDisplay();
            loadDaySchedule(currentDate);
        });

        document.getElementById('nextDay')?.addEventListener('click', function() {
            currentDate.setDate(currentDate.getDate() + 1);
            updateDateDisplay();
            loadDaySchedule(currentDate);
        });

        function updateDateDisplay() {
            const options = {
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };
            const relativeOptions = {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            };

            const formattedDate = currentDate.toLocaleDateString('fr-FR', options);
            const today = new Date();
            let relativeText = '';

            if (currentDate.toDateString() === today.toDateString()) {
                relativeText = "Aujourd'hui";
            } else if (currentDate.toDateString() === new Date(today.setDate(today.getDate() + 1)).toDateString()) {
                relativeText = "Demain";
            } else if (currentDate.toDateString() === new Date(today.setDate(today.getDate() - 1)).toDateString()) {
                relativeText = "Hier";
            } else {
                relativeText = currentDate.toLocaleDateString('fr-FR', relativeOptions);
            }

            document.getElementById('currentDate').textContent = formattedDate;
            document.getElementById('relativeDate').textContent = relativeText;
        }

        async function loadDaySchedule(date) {
            const formattedDate = date.toISOString().split('T')[0];

            try {
                const response = await fetch(`/api/medecin/schedule?date=${formattedDate}`);
                const data = await response.json();

                const scheduleContainer = document.getElementById('daySchedule');
                scheduleContainer.innerHTML = '';

                if (data.appointments && data.appointments.length > 0) {
                    data.appointments.forEach(appointment => {
                        const scheduleItem = createScheduleItem(appointment);
                        scheduleContainer.appendChild(scheduleItem);
                    });
                } else {
                    scheduleContainer.innerHTML = `
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-calendar-times"></i>
                            </div>
                            <h6 class="text-muted mb-3">Aucun rendez-vous ce jour</h6>
                            <p class="text-muted small mb-4">Profitez-en pour mettre à jour vos dossiers</p>
                            <button class="btn btn-primary btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#quickReservationModal">
                                <i class="fas fa-plus me-2"></i>Ajouter un RDV
                            </button>
                        </div>
                    `;
                }

                // Reinitialize tooltips
                const newTooltips = [].slice.call(scheduleContainer.querySelectorAll('[title]'));
                newTooltips.forEach(el => new bootstrap.Tooltip(el));

            } catch (error) {
                console.error('Error loading schedule:', error);
                showToast('Erreur lors du chargement du planning', 'error');
            }
        }

        function createScheduleItem(appointment) {
            const div = document.createElement('div');
            div.className = `schedule-item ${appointment.statut}`;
            div.setAttribute('data-appointment-id', appointment.id);
            div.setAttribute('data-status', appointment.statut);

            const statusClass = `status-${appointment.statut}`;
            const statusText = appointment.statut.charAt(0).toUpperCase() + appointment.statut.slice(1);

            div.innerHTML = `
                <div class="schedule-time">
                    <span class="time">${appointment.heure_reservation}</span>
                    <span class="duration">${appointment.service?.duree_consultation || 30} min</span>
                </div>
                <div class="schedule-content">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center gap-3">
                            <div class="patient-avatar">
                                ${appointment.user?.name?.charAt(0).toUpperCase() || 'P'}
                            </div>
                            <div>
                                <h6 class="mb-0">${appointment.user?.name || 'Patient'}</h6>
                                <small class="text-muted">${appointment.service?.nom || 'Consultation'}</small>
                            </div>
                        </div>
                        <span class="status-badge ${statusClass}">
                            ${statusText}
                        </span>
                    </div>
                    <div class="appointment-actions">
                        <button class="action-btn primary" 
                                data-bs-toggle="modal" 
                                data-bs-target="#viewAppointmentModal${appointment.id}"
                                title="Voir détails">
                            <i class="fas fa-eye"></i>
                        </button>
                        ${appointment.statut !== 'effectuée' ? `
                            <button class="action-btn success"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateStatusModal${appointment.id}"
                                    title="Mettre à jour">
                                <i class="fas fa-edit"></i>
                            </button>
                        ` : ''}
                        ${appointment.user?.telephone ? `
                            <a href="tel:${appointment.user.telephone}" 
                               class="action-btn" 
                               title="Appeler">
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="https://wa.me/${appointment.user.telephone}" 
                               target="_blank"
                               class="action-btn" 
                               title="WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        ` : ''}
                    </div>
                </div>
            `;

            return div;
        }

        // Schedule filtering
        document.querySelectorAll('.filter-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const filter = this.getAttribute('data-filter');

                // Update active state
                document.querySelectorAll('.filter-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Filter items
                document.querySelectorAll('.schedule-item').forEach(appointment => {
                    if (filter === 'all' || appointment.getAttribute('data-status') === filter) {
                        appointment.style.display = 'flex';
                    } else {
                        appointment.style.display = 'none';
                    }
                });
            });
        });

        // Appointment search
        const searchInput = document.getElementById('appointmentSearch');
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                document.querySelectorAll('.appointment-row').forEach(row => {
                    const patientName = row.getAttribute('data-patient');
                    const appointmentDate = row.getAttribute('data-date');

                    if (patientName.includes(searchTerm) ||
                        appointmentDate.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Initialize activity chart
        const ctx = document.getElementById('activityChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
                    datasets: [{
                        label: 'Rendez-vous',
                        data: [12, 19, 8, 15],
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 2,
                        pointBackgroundColor: '#10B981',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleColor: '#ffffff',
                            bodyColor: '#ffffff',
                            padding: 12,
                            cornerRadius: 6
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            },
                            ticks: {
                                display: false
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Confirm cancellation
        function confirmCancel(event, appointmentId) {
            event.preventDefault();

            Swal.fire({
                title: 'Annuler le rendez-vous',
                text: 'Êtes-vous sûr de vouloir annuler ce rendez-vous ? Cette action est irréversible.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Oui, annuler',
                cancelButtonText: 'Non, garder',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit();
                }
            });
        }

        // Real-time updates
        function checkNewAppointments() {
            // In a real app, you would use WebSockets or Server-Sent Events
            // For now, we'll simulate with setInterval

            setInterval(async () => {
                try {
                    const response = await fetch('/api/medecin/appointments/new');
                    const data = await response.json();

                    if (data.hasNewAppointments) {
                        // Show notification
                        if (Notification.permission === "granted") {
                            new Notification("Nouveau rendez-vous", {
                                body: data.message,
                                icon: "https://cdn-icons-png.flaticon.com/512/3059/3059518.png"
                            });
                        }

                        // Update stats
                        updateStats();
                    }
                } catch (error) {
                    console.error('Error checking new appointments:', error);
                }
            }, 60000); // Check every minute
        }

        async function updateStats() {
            try {
                const response = await fetch('/api/medecin/dashboard/stats');
                const data = await response.json();

                // Update stats cards
                document.querySelectorAll('.stat-value').forEach((el, index) => {
                    if (index === 0) el.textContent = data.todayAppointments || 0;
                    if (index === 1) el.textContent = data.pendingAppointments || 0;
                    if (index === 2) el.textContent = data.myServices || 0;
                    if (index === 3) el.textContent = data.monthlyPatients || 0;
                    if (index === 4) el.textContent = `${data.monthRevenue?.toLocaleString('fr-FR') || 0}€`;
                    if (index === 5) el.textContent = data.avgRating ? `${data.avgRating.toFixed(1)}/5` : '4.7/5';
                });
            } catch (error) {
                console.error('Error updating stats:', error);
            }
        }

        // Initialize real-time updates if notifications are allowed
        if (Notification.permission === "granted") {
            checkNewAppointments();
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            const toastEl = document.createElement('div');
            toastEl.className = `toast align-items-center text-white bg-${type} border-0`;
            toastEl.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 9999;
            `;

            toastEl.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;

            document.body.appendChild(toastEl);
            const toast = new bootstrap.Toast(toastEl);
            toast.show();

            toastEl.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toastEl);
            });
        }
    });
</script>

<!-- SweetAlert2 for better confirmations -->
@if(config('app.env') === 'production')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endpush