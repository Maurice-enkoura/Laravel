@extends('layouts.app')

@section('title', 'Rapports et Statistiques - Admin')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-0">
                <i class="fas fa-chart-bar me-2"></i>Rapports et Statistiques
            </h1>
            <p class="text-muted mb-0">Analyses et statistiques complètes de la plateforme</p>
        </div>
        <div class="col-md-4 text-end">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i>Exporter
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-pdf me-2"></i>PDF</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-excel me-2"></i>Excel</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-file-csv me-2"></i>CSV</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Filtres de Période -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary active" data-period="today">Aujourd'hui</button>
                        <button type="button" class="btn btn-outline-primary" data-period="week">Cette semaine</button>
                        <button type="button" class="btn btn-outline-primary" data-period="month">Ce mois</button>
                        <button type="button" class="btn btn-outline-primary" data-period="quarter">Ce trimestre</button>
                        <button type="button" class="btn btn-outline-primary" data-period="year">Cette année</button>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        <span class="input-group-text">à</span>
                        <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- KPI Principaux -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Réservations totales</h6>
                            <h3 class="h2 mb-0">1,248</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>12.5%
                            </span>
                        </div>
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Revenus totaux</h6>
                            <h3 class="h2 mb-0">89.5k€</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>8.3%
                            </span>
                        </div>
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; background: #D1FAE5; color: #10B981;">
                            <i class="fas fa-euro-sign"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Patients actifs</h6>
                            <h3 class="h2 mb-0">428</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>5.2%
                            </span>
                        </div>
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; background: #FEF3C7; color: #F59E0B;">
                            <i class="fas fa-user-injured"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-1">Satisfaction</h6>
                            <h3 class="h2 mb-0">4.7/5</h3>
                            <span class="text-success small">
                                <i class="fas fa-arrow-up me-1"></i>0.3
                            </span>
                        </div>
                        <div class="stat-icon" style="width: 48px; height: 48px; margin: 0; background: #E0E7FF; color: #6366F1;">
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-line me-2"></i>Réservations par mois
                    </h5>
                    <select class="form-select form-select-sm w-auto">
                        <option>2024</option>
                        <option>2023</option>
                        <option>2022</option>
                    </select>
                </div>
                <div class="card-body">
                    <div class="text-center p-5">
                        <!-- Ici, vous intégreriez un graphique Chart.js ou similaire -->
                        <img src="https://via.placeholder.com/600x300?text=Graphique+des+R%C3%A9servations+par+Mois" 
                             alt="Graphique des réservations" 
                             class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-pie me-2"></i>Répartition par service
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <!-- Ici, vous intégreriez un graphique circulaire -->
                        <img src="https://via.placeholder.com/300x300?text=Graphique+Circulaire+Services" 
                             alt="Graphique circulaire" 
                             class="img-fluid rounded">
                    </div>
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Cardiologie</span>
                            <strong class="text-primary">35%</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Dentisterie</span>
                            <strong class="text-success">25%</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Neurologie</span>
                            <strong class="text-warning">20%</strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Autres</span>
                            <strong class="text-info">20%</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableaux détaillés -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-user-md me-2"></i>Top 5 Médecins
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Médecin</th>
                                <th>Service</th>
                                <th>Réservations</th>
                                <th>Taux de satisfaction</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2">
                                            MS
                                        </div>
                                        <div>
                                            <strong>Dr. Marie Sanchez</strong>
                                            <div class="text-muted small">Cardiologie</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Cardiologie</td>
                                <td>
                                    <strong>156</strong>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fas fa-star"></i> 4.9/5
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="background: linear-gradient(135deg, #F59E0B, #FBBF24);">
                                            LB
                                        </div>
                                        <div>
                                            <strong>Dr. Léa Bernard</strong>
                                            <div class="text-muted small">Dentisterie</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Dentisterie</td>
                                <td>
                                    <strong>128</strong>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar bg-warning" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fas fa-star"></i> 4.7/5
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="user-avatar me-2" style="background: linear-gradient(135deg, #10B981, #34D399);">
                                            JD
                                        </div>
                                        <div>
                                            <strong>Dr. Jean Dupont</strong>
                                            <div class="text-muted small">Neurologie</div>
                                        </div>
                                    </div>
                                </td>
                                <td>Neurologie</td>
                                <td>
                                    <strong>98</strong>
                                    <div class="progress mt-1" style="height: 5px;">
                                        <div class="progress-bar bg-success" style="width: 53%"></div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-warning">
                                        <i class="fas fa-star"></i> 4.8/5
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-chart-area me-2"></i>Métriques Clés
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-4">
                            <div class="mb-2">
                                <div class="stat-icon" style="width: 50px; height: 50px; margin: 0 auto;">
                                    <i class="fas fa-user-clock"></i>
                                </div>
                            </div>
                            <h4 class="h3 mb-1">24min</h4>
                            <p class="text-muted mb-0">Temps d'attente moyen</p>
                        </div>
                        <div class="col-6 mb-4">
                            <div class="mb-2">
                                <div class="stat-icon" style="width: 50px; height: 50px; margin: 0 auto; background: #D1FAE5; color: #10B981;">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                            </div>
                            <h4 class="h3 mb-1">92%</h4>
                            <p class="text-muted mb-0">Taux de ponctualité</p>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <div class="stat-icon" style="width: 50px; height: 50px; margin: 0 auto; background: #FEF3C7; color: #F59E0B;">
                                    <i class="fas fa-redo"></i>
                                </div>
                            </div>
                            <h4 class="h3 mb-1">42%</h4>
                            <p class="text-muted mb-0">Taux de fidélisation</p>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <div class="stat-icon" style="width: 50px; height: 50px; margin: 0 auto; background: #E0E7FF; color: #6366F1;">
                                    <i class="fas fa-mobile-alt"></i>
                                </div>
                            </div>
                            <h4 class="h3 mb-1">78%</h4>
                            <p class="text-muted mb-0">Réservations mobile</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Rapports téléchargeables -->
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-file-alt me-2"></i>Rapports disponibles
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-file-invoice-dollar fa-3x text-primary"></i>
                            </div>
                            <h5>Rapport financier</h5>
                            <p class="text-muted small">Revenus, dépenses et marges</p>
                            <div class="mt-3">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download me-1"></i>Télécharger
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-users fa-3x text-success"></i>
                            </div>
                            <h5>Rapport patients</h5>
                            <p class="text-muted small">Démographie et comportements</p>
                            <div class="mt-3">
                                <button class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-download me-1"></i>Télécharger
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <i class="fas fa-chart-bar fa-3x text-warning"></i>
                            </div>
                            <h5>Rapport performances</h5>
                            <p class="text-muted small">Indicateurs et tendances</p>
                            <div class="mt-3">
                                <button class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-download me-1"></i>Télécharger
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .progress {
        background-color: var(--gray-light);
    }
    
    .card.border-primary {
        border-color: var(--primary) !important;
    }
    
    .card.border-success {
        border-color: var(--success) !important;
    }
    
    .card.border-warning {
        border-color: var(--warning) !important;
    }
    
    .card.border-info {
        border-color: #6366F1 !important;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des périodes
        const periodButtons = document.querySelectorAll('[data-period]');
        periodButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Retirer la classe active de tous les boutons
                periodButtons.forEach(btn => btn.classList.remove('active'));
                // Ajouter la classe active au bouton cliqué
                this.classList.add('active');
                
                const period = this.getAttribute('data-period');
                // Ici, vous pourriez charger les données pour la période sélectionnée
                console.log(`Chargement des données pour: ${period}`);
            });
        });

        // Téléchargement des rapports
        document.querySelectorAll('.btn-outline-primary, .btn-outline-success, .btn-outline-warning').forEach(button => {
            if (button.textContent.includes('Télécharger')) {
                button.addEventListener('click', function() {
                    const reportType = this.closest('.card-body').querySelector('h5').textContent;
                    alert(`Téléchargement du rapport: ${reportType}`);
                });
            }
        });
    });
</script>
@endpush
@endsection