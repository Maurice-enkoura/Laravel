@extends('layouts.app')

@section('title', 'Gestion des Réservations - MediBook')

@push('styles')
<style>
    :root {
        --primary: #2D6FF7;
        --primary-light: rgba(45, 111, 247, 0.1);
        --primary-gradient: linear-gradient(135deg, #2D6FF7 0%, #4F83FF 100%);
        --secondary: #4F83FF;
        --success: #10B981;
        --success-light: rgba(16, 185, 129, 0.1);
        --success-gradient: linear-gradient(135deg, #10B981 0%, #34D399 100%);
        --warning: #F59E0B;
        --warning-light: rgba(245, 158, 11, 0.1);
        --danger: #EF4444;
        --danger-light: rgba(239, 68, 68, 0.1);
        --info: #3B82F6;
        --info-light: rgba(59, 130, 246, 0.1);
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

    /* Page Header */
    .page-header {
        background: var(--success-gradient);
        color: white;
        padding: 3rem 0;
        border-radius: var(--radius-lg);
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .header-content {
        position: relative;
        z-index: 1;
    }

    .header-image {
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

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        margin-bottom: 2rem;
    }

    .filter-header {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--primary-light);
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
    }

    .filter-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
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
        padding: 1.5rem;
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
        margin-bottom: 1rem;
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
        margin-bottom: 0;
    }

    /* Reservations Table */
    .reservations-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        overflow: hidden;
    }

    .table-header {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid var(--gray-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h5 {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-body {
        padding: 0;
    }

    .reservations-table {
        margin: 0;
        width: 100%;
    }

    .reservations-table thead th {
        background: var(--light);
        border-bottom: 2px solid var(--gray-light);
        font-weight: 600;
        color: var(--dark);
        padding: 1rem 1.5rem;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .reservations-table tbody td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--gray-light);
    }

    .reservations-table tbody tr {
        transition: var(--transition);
    }

    .reservations-table tbody tr:hover {
        background: var(--primary-light);
    }

    /* Patient Avatar */
    .patient-avatar {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: var(--primary-gradient);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.3px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-pending {
        background: var(--warning-light);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .status-confirmed {
        background: var(--success-light);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-cancelled {
        background: var(--danger-light);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-completed {
        background: var(--info-light);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    /* Date Cell */
    .date-cell {
        min-width: 120px;
    }

    .date-value {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .time-badge {
        background: var(--primary-light);
        color: var(--primary);
        padding: 0.25rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }

    /* Contact Buttons */
    .contact-buttons {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .contact-btn {
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

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.25rem;
        justify-content: flex-end;
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

    .action-btn.view:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .action-btn.edit:hover {
        background: var(--success);
        color: white;
        border-color: var(--success);
    }

    .action-btn.cancel:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
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

    /* Pagination */
    .pagination-container {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-top: 1px solid var(--gray-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination-info {
        color: var(--gray);
        font-size: 0.875rem;
    }

    /* Export Dropdown */
    .export-dropdown .dropdown-menu {
        min-width: 200px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-light);
        border-radius: var(--radius);
    }

    .export-dropdown .dropdown-item {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
    }

    .export-dropdown .dropdown-item:hover {
        background: var(--primary-light);
        color: var(--primary);
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
        .page-header {
            padding: 2rem 1.5rem;
            text-align: center;
        }

        .page-header .row {
            flex-direction: column;
        }

        .header-image {
            margin-top: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .filter-body .row>div {
            margin-bottom: 1rem;
        }

        .filter-body .row>div:last-child {
            margin-bottom: 0;
        }

        .table-header {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }

        .reservations-table {
            display: block;
            overflow-x: auto;
        }

        .reservations-table thead {
            display: none;
        }

        .reservations-table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid var(--gray-light);
            border-radius: var(--radius);
            padding: 1rem;
        }

        .reservations-table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: none;
            padding: 0.75rem 0;
        }

        .reservations-table tbody td::before {
            content: attr(data-label);
            font-weight: 600;
            color: var(--dark);
            margin-right: 1rem;
            min-width: 100px;
        }

        .contact-buttons,
        .action-buttons {
            justify-content: flex-end;
        }

        .pagination-container {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .filter-body .row>div {
            margin-bottom: 1rem;
        }

        .table-header .btn-group {
            width: 100%;
            justify-content: space-between;
        }

        .table-header .btn-group .btn {
            flex: 1;
            justify-content: center;
        }
    }

    /* Print Styles */
    @media print {

        .page-header,
        .filter-card,
        .stats-grid,
        .table-header .btn-group,
        .action-btn,
        .pagination-container,
        .contact-btn {
            display: none !important;
        }

        .reservations-card {
            border: none;
            box-shadow: none;
        }

        .reservations-table {
            border: 1px solid var(--gray-light);
        }

        .reservations-table thead th {
            background: white !important;
            color: var(--dark) !important;
        }
    }

    /* Loading Overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .loading-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .loading-spinner {
        width: 50px;
        height: 50px;
        border: 3px solid var(--gray-light);
        border-top-color: var(--primary);
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">

    <!-- Page Header -->
    <div class="container">
        <div class="page-header fade-in">
            <div class="header-content">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h1 class="display-5 fw-bold mb-3">Gestion des Réservations 🩺</h1>
                        <p class="lead mb-4 opacity-90">
                            Gérez vos consultations, confirmez les rendez-vous et suivez vos patients.
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#today" class="btn btn-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-calendar-day me-2"></i>Aujourd'hui
                            </a>
                            <button class="btn btn-outline-light btn-lg px-4 d-flex align-items-center" onclick="printSchedule()">
                                <i class="fas fa-print me-2"></i>Imprimer l'agenda
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end d-none d-lg-block">
                        <div class="header-image">
                            <img src="https://cdn-icons-png.flaticon.com/512/2785/2785482.png"
                                alt="Planning médical"
                                class="img-fluid"
                                style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="container fade-in" data-aos-delay="100">
        <div class="filter-card">
            <div class="filter-header">
                <h5 class="mb-0 d-flex align-items-center">
                    <i class="fas fa-filter me-2 text-primary"></i>
                    Filtres de recherche
                </h5>
            </div>
            <div class="filter-body">
                <form method="GET" id="filterForm" class="row g-3">
                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select" id="statusFilter">
                            <option value="">Tous les statuts</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="confirmée" {{ request('statut') == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                            <option value="annulée" {{ request('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                            <option value="effectuée" {{ request('statut') == 'effectuée' ? 'selected' : '' }}>Effectuée</option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Service</label>
                        <select name="service_id" class="form-select" id="serviceFilter">
                            <option value="">Tous les services</option>
                            @foreach(auth()->user()->services ?? [] as $service)
                            <option value="{{ $service->id }}" {{ request('service_id') == $service->id ? 'selected' : '' }}>
                                {{ $service->nom }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <label class="form-label">Date de début</label>
                        <input type="date" name="date_debut" class="form-control"
                            value="{{ request('date_debut') }}"
                            id="dateDebut">
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <label class="form-label">Date de fin</label>
                        <input type="date" name="date_fin" class="form-control"
                            value="{{ request('date_fin') }}"
                            id="dateFin">
                    </div>

                    <div class="col-lg-1 col-md-12 d-flex align-items-end">
                        <div class="d-flex gap-2 w-100">
                            <button type="submit" class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
                                <i class="fas fa-search"></i>
                            </button>
                            <a href="{{ route('medecin.reservations') }}"
                                class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                                style="width: 45px;">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="container fade-in" data-aos-delay="200">
        <div class="stats-grid">
            @php
            $totalReservations = $reservations->count();
            $pendingReservations = $reservations->where('statut', 'en_attente')->count();
            $confirmedReservations = $reservations->where('statut', 'confirmée')->count();
            $completedReservations = $reservations->where('statut', 'effectuée')->count();
            @endphp

            <!-- Total Reservations -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-primary-light text-primary">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <span class="badge bg-primary">Total</span>
                </div>
                <div class="stat-value">{{ number_format($totalReservations) }}</div>
                <div class="stat-label">Réservations totales</div>
            </div>

            <!-- Pending Reservations -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-warning-light text-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                    <span class="badge bg-warning">À traiter</span>
                </div>
                <div class="stat-value">{{ number_format($pendingReservations) }}</div>
                <div class="stat-label">En attente</div>
            </div>

            <!-- Confirmed Reservations -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-success-light text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="badge bg-success">Confirmées</span>
                </div>
                <div class="stat-value">{{ number_format($confirmedReservations) }}</div>
                <div class="stat-label">Réservations confirmées</div>
            </div>

            <!-- Completed Reservations -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-info-light text-info">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <span class="badge bg-info">Terminées</span>
                </div>
                <div class="stat-value">{{ number_format($completedReservations) }}</div>
                <div class="stat-label">Consultations effectuées</div>
            </div>
        </div>
    </div>

    <!-- Reservations Table -->
    <div class="container fade-in" data-aos-delay="300">
        <div class="reservations-card">
            <div class="table-header">
                <div>
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fas fa-list me-2 text-primary"></i>
                        Liste des réservations
                    </h5>
                    <p class="text-muted mb-0 small">{{ $totalReservations }} réservation(s) trouvée(s)</p>
                </div>
                <div class="d-flex gap-2">
                    <div class="dropdown export-dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-file-export me-1"></i>Exporter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToExcel()">
                                    <i class="fas fa-file-excel text-success me-2"></i>Excel (.xlsx)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToPDF()">
                                    <i class="fas fa-file-pdf text-danger me-2"></i>PDF (.pdf)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="exportToCSV()">
                                    <i class="fas fa-file-csv text-info me-2"></i>CSV (.csv)
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog me-1"></i>Actions
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#" onclick="confirmAllPending()">
                                    <i class="fas fa-check-circle me-2 text-success"></i>Tout confirmer
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="sendReminders()">
                                    <i class="fas fa-bell me-2 text-warning"></i>Envoyer rappels
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('medecin.reservations') }}">
                                    <i class="fas fa-sync me-2 text-primary"></i>Actualiser
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="table-body">
                @if($reservations->count() > 0)
                <div class="table-responsive">
                    <table class="table reservations-table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Patient</th>
                                <th>Service</th>
                                <th>Date & Heure</th>
                                <th>Contact</th>
                                <th>Statut</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reservations as $reservation)
                            <tr class="reservation-row" data-status="{{ $reservation->statut }}">
                                <td class="text-center" data-label="ID">
                                    <div class="reservation-id fw-bold">
                                        #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}
                                    </div>
                                </td>
                                <td data-label="Patient">
                                    <div class="d-flex align-items-center">
                                        <div class="patient-avatar me-3">
                                            {{ strtoupper(substr($reservation->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <strong class="d-block">{{ $reservation->user->name }}</strong>
                                            <small class="text-muted">{{ $reservation->user->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Service">
                                    <strong>{{ $reservation->service->nom }}</strong>
                                    @if($reservation->service->tarif)
                                    <div class="text-success fw-bold">
                                        {{ $reservation->service->tarif }} €
                                    </div>
                                    @endif
                                    @if($reservation->service->duree_consultation)
                                    <small class="text-muted d-block">
                                        {{ $reservation->service->duree_consultation }} min
                                    </small>
                                    @endif
                                </td>
                                <td data-label="Date & Heure" class="date-cell">
                                    <div class="date-value">
                                        {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}
                                    </div>
                                    <div class="time-badge">
                                        <i class="fas fa-clock fa-xs"></i>
                                        {{ $reservation->heure_reservation }}
                                    </div>
                                </td>
                                <td data-label="Contact">
                                    <div class="contact-buttons">
                                        @if($reservation->user->telephone)
                                        <a href="tel:{{ $reservation->user->telephone }}"
                                            class="contact-btn phone"
                                            title="Appeler">
                                            <i class="fas fa-phone"></i>
                                        </a>
                                        <a href="https://wa.me/{{ $reservation->user->telephone }}"
                                            target="_blank"
                                            class="contact-btn whatsapp"
                                            title="WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <small class="text-muted d-none d-md-inline">
                                            {{ $reservation->user->telephone }}
                                        </small>
                                        @else
                                        <span class="text-muted">Non renseigné</span>
                                        @endif
                                    </div>
                                </td>
                                <td data-label="Statut">
                                    @php
                                    $statusClass = match($reservation->statut) {
                                    'en_attente' => 'status-pending',
                                    'confirmée' => 'status-confirmed',
                                    'annulée' => 'status-cancelled',
                                    'effectuée' => 'status-completed',
                                    default => 'status-pending'
                                    };
                                    $statusIcon = match($reservation->statut) {
                                    'en_attente' => 'clock',
                                    'confirmée' => 'check-circle',
                                    'annulée' => 'times-circle',
                                    'effectuée' => 'clipboard-check',
                                    default => 'question-circle'
                                    };
                                    @endphp
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="fas fa-{{ $statusIcon }}"></i>
                                        {{ ucfirst($reservation->statut) }}
                                    </span>
                                </td>
                                <td data-label="Actions" class="text-end">
                                    <div class="action-buttons">
                                        <button type="button"
                                            class="action-btn view"
                                            data-bs-toggle="modal"
                                            data-bs-target="#detailsModal{{ $reservation->id }}"
                                            title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button type="button"
                                            class="action-btn edit"
                                            data-bs-toggle="modal"
                                            data-bs-target="#statusModal{{ $reservation->id }}"
                                            {{ $reservation->statut == 'annulée' ? 'disabled' : '' }}
                                            title="Modifier statut">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        @if($reservation->statut == 'en_attente')
                                        <button type="button"
                                            class="action-btn cancel"
                                            onclick="confirmCancel()"
                                            title="Annuler">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
               


                @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h4 class="text-muted mb-3">Aucune réservation trouvée</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['statut', 'service_id', 'date_debut', 'date_fin']))
                        Aucun rendez-vous ne correspond à vos critères de recherche.
                        @else
                        Vous n'avez pas encore de réservations.
                        @endif
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        @if(request()->hasAny(['statut', 'service_id', 'date_debut', 'date_fin']))
                        <a href="{{ route('medecin.reservations') }}" class="btn btn-primary">
                            <i class="fas fa-redo me-2"></i>Réinitialiser les filtres
                        </a>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->


<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Auto-submit filters on change
        const statusFilter = document.getElementById('statusFilter');
        const serviceFilter = document.getElementById('serviceFilter');
        const dateDebut = document.getElementById('dateDebut');
        const dateFin = document.getElementById('dateFin');
        const filterForm = document.getElementById('filterForm');

        // Validate date range
        function validateDateRange() {
            if (dateDebut.value && dateFin.value && dateDebut.value > dateFin.value) {
                Swal.fire({
                    title: 'Dates invalides',
                    text: 'La date de début ne peut pas être après la date de fin.',
                    icon: 'error',
                    confirmButtonColor: '#2D6FF7'
                });
                return false;
            }
            return true;
        }

        // Submit filter form
        filterForm.addEventListener('submit', function(event) {
            if (!validateDateRange()) {
                event.preventDefault();
                return false;
            }

            // Show loading
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');
        });

        // Auto-filter on select change
        [statusFilter, serviceFilter].forEach(select => {
            select.addEventListener('change', function() {
                if (validateDateRange()) {
                    filterForm.submit();
                }
            });
        });

        // Filter reservations by status in the table
        function filterTableByStatus(status) {
            const rows = document.querySelectorAll('.reservation-row');

            rows.forEach(row => {
                if (status === 'all' || row.getAttribute('data-status') === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Confirm cancellation
        async function confirmCancel(reservationId) {
            const {
                value: confirmed
            } = await Swal.fire({
                title: 'Annuler la réservation',
                text: 'Êtes-vous sûr de vouloir annuler cette réservation ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Oui, annuler',
                cancelButtonText: 'Non, garder',
                reverseButtons: true
            });

            if (confirmed) {
                const loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.add('active');

                try {
                    const response = await fetch(`/medecin/reservations/${reservationId}/cancel`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Succès',
                            text: 'La réservation a été annulée.',
                            icon: 'success',
                            confirmButtonColor: '#2D6FF7'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Erreur lors de l\'annulation');
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Erreur',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#2D6FF7'
                    });
                } finally {
                    loadingOverlay.classList.remove('active');
                }
            }
        }

        // Confirm all pending reservations
        async function confirmAllPending() {
            const {
                value: confirmed
            } = await Swal.fire({
                title: 'Confirmer toutes les réservations',
                text: 'Êtes-vous sûr de vouloir confirmer toutes les réservations en attente ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#10B981',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Oui, confirmer tout',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            });

            if (confirmed) {
                const loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.add('active');

                try {
                    const response = await fetch('/medecin/reservations/confirm-all', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Succès',
                            text: `${data.confirmed} réservation(s) confirmée(s).`,
                            icon: 'success',
                            confirmButtonColor: '#2D6FF7'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Erreur lors de la confirmation');
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Erreur',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#2D6FF7'
                    });
                } finally {
                    loadingOverlay.classList.remove('active');
                }
            }
        }

        // Send reminders
        async function sendReminders() {
            const {
                value: confirmed
            } = await Swal.fire({
                title: 'Envoyer des rappels',
                html: `
                    <p>Voulez-vous envoyer des rappels aux patients ?</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reminderTomorrow" checked>
                        <label class="form-check-label" for="reminderTomorrow">
                            Rappel pour demain
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="reminderToday">
                        <label class="form-check-label" for="reminderToday">
                            Rappel pour aujourd'hui
                        </label>
                    </div>
                `,
                showCancelButton: true,
                confirmButtonColor: '#3B82F6',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Envoyer les rappels',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            });

            if (confirmed) {
                const loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.add('active');

                try {
                    const response = await fetch('/medecin/reservations/send-reminders', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            reminder_tomorrow: document.getElementById('reminderTomorrow').checked,
                            reminder_today: document.getElementById('reminderToday').checked
                        })
                    });

                    const data = await response.json();

                    if (data.success) {
                        Swal.fire({
                            title: 'Rappels envoyés',
                            text: `${data.sent} rappel(s) envoyé(s) avec succès.`,
                            icon: 'success',
                            confirmButtonColor: '#2D6FF7'
                        });
                    } else {
                        throw new Error(data.message || 'Erreur lors de l\'envoi des rappels');
                    }
                } catch (error) {
                    Swal.fire({
                        title: 'Erreur',
                        text: error.message,
                        icon: 'error',
                        confirmButtonColor: '#2D6FF7'
                    });
                } finally {
                    loadingOverlay.classList.remove('active');
                }
            }
        }

        // Export functions
        function exportToExcel() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');

            // Simulate export process
            setTimeout(() => {
                loadingOverlay.classList.remove('active');
                Swal.fire({
                    title: 'Export Excel',
                    text: 'L\'exportation a été générée avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#2D6FF7'
                });
            }, 1500);
        }

        function exportToPDF() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');

            // Simulate export process
            setTimeout(() => {
                loadingOverlay.classList.remove('active');
                Swal.fire({
                    title: 'Export PDF',
                    text: 'Le fichier PDF a été généré avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#2D6FF7'
                });
            }, 1500);
        }

        function exportToCSV() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');

            // Simulate export process
            setTimeout(() => {
                loadingOverlay.classList.remove('active');
                Swal.fire({
                    title: 'Export CSV',
                    text: 'Le fichier CSV a été généré avec succès.',
                    icon: 'success',
                    confirmButtonColor: '#2D6FF7'
                });
            }, 1500);
        }

        // Print schedule
        function printSchedule() {
            window.print();
        }

        // Real-time updates
        function checkNewReservations() {
            setInterval(async () => {
                try {
                    const response = await fetch('/api/medecin/reservations/updates');
                    const data = await response.json();

                    if (data.hasNewReservations) {
                        // Show notification
                        if (Notification.permission === "granted") {
                            new Notification("Nouvelle réservation", {
                                body: data.message,
                                icon: "https://cdn-icons-png.flaticon.com/512/2785/2785482.png"
                            });
                        }

                        // Update badge
                        const badge = document.querySelector('.badge.bg-warning');
                        if (badge) {
                            const count = parseInt(badge.textContent.match(/\d+/)[0]) || 0;
                            badge.textContent = `${count + 1} nouveaux`;
                        }

                        // Show toast notification
                        showToast('Nouvelle réservation reçue', 'info');
                    }
                } catch (error) {
                    console.error('Error checking new reservations:', error);
                }
            }, 60000); // Check every minute
        }

        // Initialize real-time updates if notifications are allowed
        if (Notification.permission === "granted") {
            checkNewReservations();
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
@endsection