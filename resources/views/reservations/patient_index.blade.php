@extends('layouts.app')

@section('title', 'Mes Réservations - MediBook')

@push('styles')
<style>
    :root {
        --primary: #2D6FF7;
        --primary-light: rgba(45, 111, 247, 0.1);
        --success: #10B981;
        --success-light: rgba(16, 185, 129, 0.1);
        --warning: #F59E0B;
        --warning-light: rgba(245, 158, 11, 0.1);
        --danger: #EF4444;
        --danger-light: rgba(239, 68, 68, 0.1);
        --info: #3B82F6;
        --info-light: rgba(59, 130, 246, 0.1);
        --secondary: #6B7280;
        --secondary-light: rgba(107, 114, 128, 0.1);
        --dark: #1F2937;
        --light: #F9FAFB;
        --radius: 12px;
        --radius-lg: 16px;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, var(--primary), var(--info));
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: var(--radius);
        position: relative;
        overflow: hidden;
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

    .header-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1rem;
    }

    /* Filter Card */
    .filter-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        background: white;
    }

    .filter-header {
        background: var(--light);
        border-bottom: 1px solid var(--secondary-light);
        padding: 1rem 1.5rem;
        border-radius: var(--radius) var(--radius) 0 0;
    }

    .filter-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        color: var(--dark);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    /* Status Badges */
    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.3px;
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

    .status-annulée {
        background: var(--danger-light);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .status-effectuée {
        background: var(--info-light);
        color: var(--info);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    /* Reservation Card */
    .reservation-card {
        border: 1px solid var(--secondary-light);
        border-radius: var(--radius);
        margin-bottom: 1rem;
        transition: var(--transition);
        background: white;
    }

    .reservation-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow);
        transform: translateY(-2px);
    }

    .reservation-header {
        background: var(--light);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--secondary-light);
        border-radius: var(--radius) var(--radius) 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .reservation-body {
        padding: 1.5rem;
    }

    .reservation-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
    }

    .detail-label {
        font-size: 0.75rem;
        color: var(--secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }

    .detail-value {
        font-weight: 500;
        color: var(--dark);
        font-size: 0.95rem;
    }

    .detail-value.doctor {
        color: var(--primary);
        font-weight: 600;
    }

    .reservation-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .action-btn:hover {
        transform: translateY(-2px);
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
        color: var(--secondary);
        margin: 0 auto 1.5rem;
    }

    /* Modal Styles */
    .modal-content {
        border-radius: var(--radius-lg);
        border: none;
        box-shadow: var(--shadow-lg);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--primary), var(--info));
        color: white;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        padding: 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-detail {
        margin-bottom: 1.5rem;
    }

    .modal-detail:last-child {
        margin-bottom: 0;
    }

    .modal-detail strong {
        display: block;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-detail p {
        color: var(--dark);
        margin-bottom: 0;
        padding: 0.75rem;
        background: var(--light);
        border-radius: var(--radius);
        border-left: 3px solid var(--primary);
    }

    .comment-box {
        background: var(--light);
        border-radius: var(--radius);
        padding: 1rem;
        border-left: 3px solid var(--info);
    }

    /* Statistics */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        padding: 1.5rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .stat-card:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 1rem;
    }

    .stat-number {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--secondary);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem 0;
            margin-bottom: 1.5rem;
        }

        .header-content h1 {
            font-size: 1.5rem;
        }

        .reservation-details {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .reservation-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .reservation-actions {
            width: 100%;
            justify-content: flex-end;
        }

        .filter-body .row > div {
            margin-bottom: 1rem;
        }

        .filter-body .row > div:last-child {
            margin-bottom: 0;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .reservation-header .d-flex {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }
    }

    /* Button Styles */
    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background: #2563EB;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
        font-weight: 500;
    }

    .btn-outline-primary:hover {
        background: var(--primary);
        color: white;
    }

    /* Animation */
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

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    /* Loading State */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        border-radius: var(--radius);
        z-index: 10;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="container">
        <div class="page-header">
            <div class="header-content">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="header-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <h1 class="h3 fw-bold mb-1">Mes Réservations</h1>
                            <p class="opacity-90 mb-0">Gérez et suivez vos rendez-vous médicaux</p>
                        </div>
                    </div>
                    <div class="header-actions">
                        <a href="{{ route('services.index') }}" class="btn btn-light d-flex align-items-center">
                            <i class="fas fa-plus-circle me-2"></i>
                            <span class="d-none d-md-inline">Nouvelle réservation</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    @if($reservations->count() > 0)
    <div class="container mb-4">
        <div class="stats-grid">
            @php
                $stats = [
                    'total' => $reservations->count(),
                    'confirmed' => $reservations->where('statut', 'confirmée')->count(),
                    'pending' => $reservations->where('statut', 'en_attente')->count(),
                    'completed' => $reservations->where('statut', 'effectuée')->count(),
                ];
            @endphp
            
            <div class="stat-card">
                <div class="stat-icon bg-primary-light text-primary">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">Total réservations</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon bg-success-light text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $stats['confirmed'] }}</div>
                <div class="stat-label">Confirmées</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon bg-warning-light text-warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $stats['pending'] }}</div>
                <div class="stat-label">En attente</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon bg-info-light text-info">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="stat-number">{{ $stats['completed'] }}</div>
                <div class="stat-label">Effectuées</div>
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <!-- Success Alert -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <div class="flex-grow-1">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Filter Card -->
        <div class="filter-card">
            <div class="filter-header">
                <h6 class="mb-0 fw-bold">
                    <i class="fas fa-filter me-2"></i>Filtrer les réservations
                </h6>
            </div>
            <div class="filter-body">
                <form method="GET" id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select" id="statusFilter">
                                <option value="">Tous les statuts</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="confirmée" {{ request('statut') == 'confirmée' ? 'selected' : '' }}>Confirmée</option>
                                <option value="annulée" {{ request('statut') == 'annulée' ? 'selected' : '' }}>Annulée</option>
                                <option value="effectuée" {{ request('statut') == 'effectuée' ? 'selected' : '' }}>Effectuée</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date de début</label>
                            <input type="date" name="date_debut" class="form-control" 
                                   value="{{ request('date_debut') }}" 
                                   id="dateDebut">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Date de fin</label>
                            <input type="date" name="date_fin" class="form-control" 
                                   value="{{ request('date_fin') }}" 
                                   id="dateFin">
                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <div class="d-flex gap-2 w-100">
                                <button type="submit" class="btn btn-primary flex-grow-1 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-search me-2"></i>Filtrer
                                </button>
                                <a href="{{ route('reservations.my') }}" 
                                   class="btn btn-outline-secondary d-flex align-items-center justify-content-center"
                                   style="width: 45px;">
                                    <i class="fas fa-redo"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reservations List -->
        @if($reservations->count() > 0)
            <div class="reservations-list">
                @foreach($reservations as $reservation)
                <div class="reservation-card fade-in" data-status="{{ $reservation->statut }}">
                    <div class="reservation-header">
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <div>
                                <strong class="d-block">Réservation #{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</strong>
                                <small class="text-muted">
                                    Créée le {{ $reservation->created_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                            <span class="status-badge status-{{ str_replace('é', 'e', $reservation->statut) }}">
                                {{ ucfirst($reservation->statut) }}
                            </span>
                        </div>
                        <div class="reservation-actions">
                            <button type="button"
                                    class="action-btn btn btn-outline-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#detailsModal{{ $reservation->id }}"
                                    title="Voir les détails">
                                <i class="fas fa-eye"></i>
                            </button>

                            @if($reservation->statut == 'en_attente')
                            <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirmCancel(event)">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="action-btn btn btn-outline-danger"
                                        title="Annuler la réservation">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <div class="reservation-body">
                        <div class="reservation-details">
                            <div class="detail-item">
                                <span class="detail-label">Service</span>
                                <span class="detail-value">{{ $reservation->service->nom }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Médecin</span>
                                <span class="detail-value doctor">Dr. {{ $reservation->service->medecin->name ?? 'Non assigné' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Date</span>
                                <span class="detail-value">{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Heure</span>
                                <span class="detail-value">{{ $reservation->heure_reservation }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details Modal -->
                <div class="modal fade" id="detailsModal{{ $reservation->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Détails de la réservation
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-detail">
                                    <strong>Référence</strong>
                                    <p>#{{ str_pad($reservation->id, 6, '0', STR_PAD_LEFT) }}</p>
                                </div>
                                
                                <div class="modal-detail">
                                    <strong>Service</strong>
                                    <p>{{ $reservation->service->nom }}</p>
                                </div>
                                
                                <div class="modal-detail">
                                    <strong>Médecin</strong>
                                    <p>Dr. {{ $reservation->service->medecin->name ?? 'Non assigné' }}</p>
                                </div>
                                
                                <div class="modal-detail">
                                    <strong>Date et heure</strong>
                                    <p>
                                        {{ \Carbon\Carbon::parse($reservation->date_reservation)->format('d/m/Y') }} 
                                        à {{ $reservation->heure_reservation }}
                                    </p>
                                </div>
                                
                                <div class="modal-detail">
                                    <strong>Statut</strong>
                                    <p>
                                        <span class="status-badge status-{{ str_replace('é', 'e', $reservation->statut) }}">
                                            {{ ucfirst($reservation->statut) }}
                                        </span>
                                    </p>
                                </div>
                                
                                @if($reservation->commentaire)
                                <div class="modal-detail">
                                    <strong>Commentaire</strong>
                                    <div class="comment-box">
                                        {{ $reservation->commentaire }}
                                    </div>
                                </div>
                                @endif
                                
                                <div class="modal-detail">
                                    <strong>Créée le</strong>
                                    <p>{{ $reservation->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                                
                                <div class="modal-detail">
                                    <strong>Dernière mise à jour</strong>
                                    <p>{{ $reservation->updated_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                @if($reservation->statut == 'en_attente')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                      method="POST"
                                      class="me-auto"
                                      onsubmit="return confirmCancel(event)">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-times me-1"></i>Annuler
                                    </button>
                                </form>
                                @endif
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-1"></i>Fermer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination Info -->
            @if($reservations->total() > $reservations->perPage())
            <div class="alert alert-info mt-4 d-flex align-items-center justify-content-between">
                <div>
                    <i class="fas fa-info-circle me-2"></i>
                    Affichage de {{ $reservations->firstItem() }} à {{ $reservations->lastItem() }} 
                    sur {{ $reservations->total() }} réservation(s)
                </div>
                <div>
                    {{ $reservations->links() }}
                </div>
            </div>
            @endif
        @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <h4 class="text-muted mb-2">Aucune réservation trouvée</h4>
                    <p class="text-muted mb-4">
                        @if(request()->hasAny(['statut', 'date_debut', 'date_fin']))
                        Aucune réservation ne correspond à vos critères de recherche.
                        @else
                        Vous n'avez pas encore de réservations.
                        @endif
                    </p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('services.index') }}" class="btn btn-primary">
                            <i class="fas fa-search me-2"></i>Rechercher un service
                        </a>
                        @if(request()->hasAny(['statut', 'date_debut', 'date_fin']))
                        <a href="{{ route('reservations.my') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-2"></i>Réinitialiser les filtres
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Confirm cancellation
        function confirmCancel(event) {
            event.preventDefault();
            
            Swal.fire({
                title: 'Annuler la réservation',
                text: 'Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.',
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

        // Attach confirm cancellation to all cancel buttons
        document.querySelectorAll('form[onsubmit="return confirmCancel(event)"]').forEach(form => {
            form.addEventListener('submit', confirmCancel);
        });

        // Auto-submit filters on change
        const statusFilter = document.getElementById('statusFilter');
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
            
            // Add loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Filtrage...';
            submitBtn.classList.add('disabled');
        });

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[title]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Filter by status if present in URL
        const urlParams = new URLSearchParams(window.location.search);
        const statusParam = urlParams.get('statut');
        
        if (statusParam) {
            const statusBadge = document.querySelector(`.status-badge.status-${statusParam}`);
            if (statusBadge) {
                statusBadge.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }

        // Countdown for upcoming appointments
        function updateUpcomingAppointments() {
            const now = new Date();
            const reservationCards = document.querySelectorAll('.reservation-card');
            
            reservationCards.forEach(card => {
                const status = card.getAttribute('data-status');
                if (status === 'confirmée' || status === 'en_attente') {
                    const dateText = card.querySelector('.detail-value:nth-child(3)').textContent;
                    const timeText = card.querySelector('.detail-value:nth-child(4)').textContent;
                    
                    // Parse date (format: dd/mm/yyyy)
                    const [day, month, year] = dateText.split('/');
                    const [hours, minutes] = timeText.split(':');
                    
                    const appointmentDate = new Date(year, month - 1, day, hours, minutes);
                    const diffTime = appointmentDate - now;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    
                    if (diffDays >= 0 && diffDays <= 7) {
                        // Add upcoming indicator
                        if (!card.querySelector('.upcoming-indicator')) {
                            const indicator = document.createElement('div');
                            indicator.className = 'upcoming-indicator bg-warning text-white px-3 py-1 rounded-pill';
                            indicator.style.fontSize = '0.75rem';
                            indicator.innerHTML = `<i class="fas fa-clock me-1"></i>Dans ${diffDays} jour${diffDays > 1 ? 's' : ''}`;
                            card.querySelector('.reservation-header').appendChild(indicator);
                        }
                    }
                }
            });
        }

        // Initialize upcoming appointments check
        updateUpcomingAppointments();
        setInterval(updateUpcomingAppointments, 60000); // Update every minute

        // Export functionality (optional)
        const exportBtn = document.getElementById('exportBtn');
        if (exportBtn) {
            exportBtn.addEventListener('click', function() {
                // Implement export functionality here
                console.log('Export clicked');
            });
        }
    });
</script>

<!-- SweetAlert2 for better confirmations -->
@if(config('app.env') === 'production')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endpush