@extends('layouts.app')

@section('title', 'Gestion des Réservations - Admin')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-0">
                <i class="fas fa-calendar-alt me-2"></i>Gestion des Réservations
            </h1>
            <p class="text-muted mb-0">Suivez et gérez toutes les réservations du système</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-plus-circle me-1"></i>Actions
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-plus me-2"></i>Nouvelle réservation</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Exporter les données</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Imprimer planning</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="confirmed">Confirmé</option>
                        <option value="pending">En attente</option>
                        <option value="cancelled">Annulé</option>
                        <option value="completed">Terminé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Service</label>
                    <select class="form-select">
                        <option value="">Tous les services</option>
                        <option value="cardio">Cardiologie</option>
                        <option value="neuro">Neurologie</option>
                        <option value="dental">Dentisterie</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Médecin</label>
                    <select class="form-select">
                        <option value="">Tous les médecins</option>
                        <option value="dr1">Dr. Marie Sanchez</option>
                        <option value="dr2">Dr. Jean Dupont</option>
                    </select>
                </div>
                <div class="col-12 text-end">
                    <button class="btn btn-outline-primary me-2">
                        <i class="fas fa-sync-alt me-1"></i>Actualiser
                    </button>
                    <button class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i>Appliquer les filtres
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Vue Calendrier et Liste -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#listView">
                                <i class="fas fa-list me-1"></i>Liste
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#calendarView">
                                <i class="fas fa-calendar me-1"></i>Calendrier
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="listView">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Réservation</th>
                                            <th>Patient</th>
                                            <th>Service</th>
                                            <th>Médecin</th>
                                            <th>Date & Heure</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <strong>#RES001</strong>
                                                <div class="text-muted small">15 min</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-2">
                                                        PM
                                                    </div>
                                                    <div>
                                                        <strong>Paul Martin</strong>
                                                        <div class="text-muted small">+33 6 34 56 78 90</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">
                                                    <i class="fas fa-heartbeat me-1"></i>Cardiologie
                                                </span>
                                            </td>
                                            <td>Dr. Marie Sanchez</td>
                                            <td>
                                                <strong>25 Jan 2024</strong>
                                                <div class="text-muted small">14:30 - 14:45</div>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">Confirmé</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-outline-warning">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>#RES002</strong>
                                                <div class="text-muted small">30 min</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-2" style="background: linear-gradient(135deg, #10B981, #34D399);">
                                                        SM
                                                    </div>
                                                    <div>
                                                        <strong>Sophie Martin</strong>
                                                        <div class="text-muted small">+33 6 45 67 89 01</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">
                                                    <i class="fas fa-brain me-1"></i>Neurologie
                                                </span>
                                            </td>
                                            <td>Dr. Jean Dupont</td>
                                            <td>
                                                <strong>25 Jan 2024</strong>
                                                <div class="text-muted small">15:00 - 15:30</div>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">En attente</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-outline-success">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>#RES003</strong>
                                                <div class="text-muted small">45 min</div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="user-avatar me-2" style="background: linear-gradient(135deg, #F59E0B, #FBBF24);">
                                                        TD
                                                    </div>
                                                    <div>
                                                        <strong>Thomas Dubois</strong>
                                                        <div class="text-muted small">+33 6 56 78 90 12</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning">
                                                    <i class="fas fa-tooth me-1"></i>Dentisterie
                                                </span>
                                            </td>
                                            <td>Dr. Léa Bernard</td>
                                            <td>
                                                <strong>26 Jan 2024</strong>
                                                <div class="text-muted small">09:00 - 09:45</div>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">Annulé</span>
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <button class="btn btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-outline-secondary">
                                                        <i class="fas fa-redo"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="calendarView">
                            <div id="calendar" class="p-3 text-center">
                                <!-- Ici, vous intégreriez un calendrier comme FullCalendar -->
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Vue calendrier à intégrer avec FullCalendar.js
                                </div>
                                <img src="https://via.placeholder.com/600x300?text=Vue+Calendrier+des+R%C3%A9servations" 
                                     alt="Calendrier" 
                                     class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Statistiques -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Aujourd'hui
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <div class="stat-card border-0 shadow-none p-2">
                                <div class="stat-icon" style="width: 40px; height: 40px; margin: 0 auto 0.5rem;">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <h4 class="h3 mb-1">8</h4>
                                <p class="text-muted mb-0">Réservations</p>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="stat-card border-0 shadow-none p-2">
                                <div class="stat-icon" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; background: #D1FAE5; color: #10B981;">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <h4 class="h3 mb-1">6</h4>
                                <p class="text-muted mb-0">Confirmées</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card border-0 shadow-none p-2">
                                <div class="stat-icon" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; background: #FEF3C7; color: #F59E0B;">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4 class="h3 mb-1">2</h4>
                                <p class="text-muted mb-0">En attente</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card border-0 shadow-none p-2">
                                <div class="stat-icon" style="width: 40px; height: 40px; margin: 0 auto 0.5rem; background: #FEE2E2; color: #EF4444;">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h4 class="h3 mb-1">1</h4>
                                <p class="text-muted mb-0">Annulées</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-exclamation-circle me-2"></i>Réservations urgentes
                    </h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>#RES008</strong>
                                <div class="text-muted small">Cardiologie - Urgent</div>
                            </div>
                            <span class="badge bg-danger">URGENT</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>#RES012</strong>
                                <div class="text-muted small">Douleur aiguë</div>
                            </div>
                            <span class="badge bg-warning">PRIORITAIRE</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                            <div>
                                <strong>#RES015</strong>
                                <div class="text-muted small">Suivi post-opératoire</div>
                            </div>
                            <span class="badge bg-info">SUIVI</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques détaillées -->
    <div class="row">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="h2 mb-1">156</h3>
                <p class="text-muted mb-0">Réservations ce mois</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #D1FAE5; color: #10B981;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3 class="h2 mb-1">89%</h3>
                <p class="text-muted mb-0">Taux de confirmation</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEE2E2; color: #EF4444;">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h3 class="h2 mb-1">7%</h3>
                <p class="text-muted mb-0">Taux d'annulation</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #E0E7FF; color: #6366F1;">
                    <i class="fas fa-euro-sign"></i>
                </div>
                <h3 class="h2 mb-1">12.8k€</h3>
                <p class="text-muted mb-0">Revenus ce mois</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .nav-tabs .nav-link {
        border: none;
        color: var(--gray);
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--primary);
        border-bottom: 3px solid var(--primary);
    }
    
    .list-group-item {
        border-color: var(--gray-light);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des onglets
        const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-bs-target');
                // Ici, vous pourriez charger dynamiquement le contenu
            });
        });

        // Actions sur les réservations
        document.querySelectorAll('.btn-group .btn').forEach(button => {
            button.addEventListener('click', function() {
                const reservationId = this.closest('tr').querySelector('strong').textContent;
                
                if (this.querySelector('.fa-eye')) {
                    alert(`Voir la réservation ${reservationId}`);
                } else if (this.querySelector('.fa-edit')) {
                    alert(`Modifier la réservation ${reservationId}`);
                } else if (this.querySelector('.fa-times')) {
                    if (confirm(`Annuler la réservation ${reservationId} ?`)) {
                        alert(`Réservation ${reservationId} annulée`);
                    }
                } else if (this.querySelector('.fa-check')) {
                    if (confirm(`Confirmer la réservation ${reservationId} ?`)) {
                        alert(`Réservation ${reservationId} confirmée`);
                    }
                }
            });
        });
    });
</script>
@endpush
@endsection