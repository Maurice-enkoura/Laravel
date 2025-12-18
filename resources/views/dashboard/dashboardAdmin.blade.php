@extends('layouts.admin')

@section('title', 'Tableau de Bord Administrateur')

@section('content')
<!-- Contenu du Tableau de Bord -->
<div class="container-fluid">
    <!-- En-tête de Page -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Tableau de Bord</h1>
            <p class="text-muted mb-0">Bienvenue, Administrateur</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Nouveau Patient
            </button>
        </div>
    </div>

    <!-- Cartes de Statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon primary">
                    <i class="bi bi-people"></i>
                </div>
                <h3>1 254</h3>
                <p>Patients Totaux</p>
                <div class="card-footer">
                    <span class="text-success"><i class="bi bi-arrow-up"></i> +12%</span> depuis le mois dernier
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon success">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h3>48</h3>
                <p>Rendez-vous Aujourd'hui</p>
                <div class="card-footer">
                    <span class="text-danger"><i class="bi bi-clock"></i> 5 en attente</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon warning">
                    <i class="bi bi-capsule"></i>
                </div>
                <h3>12 580 €</h3>
                <p>Revenu Pharmacie</p>
                <div class="card-footer">
                    <span class="text-success"><i class="bi bi-arrow-up"></i> +8%</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon danger">
                    <i class="bi bi-clipboard-pulse"></i>
                </div>
                <h3>237</h3>
                <p>Analyses en Attente</p>
                <div class="card-footer">
                    <span class="text-warning"><i class="bi bi-exclamation-triangle"></i> Attention requise</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques et Données -->
    <div class="row g-4 mb-4">
        <!-- Graphique des Rendez-vous -->
        <div class="col-lg-8">
            <div class="chart-container">
                <h5 class="mb-4">Aperçu des Rendez-vous</h5>
                <canvas id="appointmentsChart"></canvas>
            </div>
        </div>
        
        <!-- Activités Récentes -->
        <div class="col-lg-4">
            <div class="chart-container">
                <h5 class="mb-4">Activités Récentes</h5>
                <div class="activity-list">
                    <div class="activity-item d-flex">
                        <div class="activity-icon appointment">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Nouveau Rendez-vous</h6>
                            <p class="mb-0 text-muted">Jean Dupont - Cardiologie</p>
                            <small class="activity-time">Il y a 10 minutes</small>
                        </div>
                    </div>
                    
                    <div class="activity-item d-flex">
                        <div class="activity-icon patient">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Nouveau Patient Enregistré</h6>
                            <p class="mb-0 text-muted">Marie Dubois</p>
                            <small class="activity-time">Il y a 1 heure</small>
                        </div>
                    </div>
                    
                    <div class="activity-item d-flex">
                        <div class="activity-icon payment">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Paiement Reçu</h6>
                            <p class="mb-0 text-muted">Facture #FAC-00123 - 450 €</p>
                            <small class="activity-time">Il y a 2 heures</small>
                        </div>
                    </div>
                    
                    <div class="activity-item d-flex">
                        <div class="activity-icon appointment">
                            <i class="bi bi-calendar-x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Rendez-vous Annulé</h6>
                            <p class="mb-0 text-muted">Pierre Martin - Neurologie</p>
                            <small class="activity-time">Il y a 3 heures</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="chart-container">
                <h5 class="mb-4">Actions Rapides</h5>
                <div class="row g-3">
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-person-plus"></i>
                            <span>Ajouter Patient</span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-calendar-plus"></i>
                            <span>Nouveau RDV</span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-prescription"></i>
                            <span>Ordonnance</span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Générer Rapport</span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-printer"></i>
                            <span>Imprimer</span>
                        </a>
                    </div>
                    <div class="col-md-2 col-sm-4 col-6">
                        <a href="#" class="quick-action-btn">
                            <i class="bi bi-gear"></i>
                            <span>Paramètres</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des Patients Récents -->
    <div class="row">
        <div class="col-12">
            <div class="dataTables_wrapper">
                <h5 class="mb-4">Patients Récents</h5>
                <table id="patientsTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID Patient</th>
                            <th>Nom</th>
                            <th>Âge</th>
                            <th>Genre</th>
                            <th>Téléphone</th>
                            <th>Dernière Visite</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PT001</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Jean+Dupont&background=1977cc&color=fff" alt="Jean Dupont" class="rounded-circle me-2" width="30">
                                    <span>Jean Dupont</span>
                                </div>
                            </td>
                            <td>45</td>
                            <td>Masculin</td>
                            <td>01 23 45 67 89</td>
                            <td>15/01/2024</td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#PT002</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Marie+Dubois&background=dc3545&color=fff" alt="Marie Dubois" class="rounded-circle me-2" width="30">
                                    <span>Marie Dubois</span>
                                </div>
                            </td>
                            <td>32</td>
                            <td>Féminin</td>
                            <td>06 12 34 56 78</td>
                            <td>14/01/2024</td>
                            <td><span class="badge bg-warning">En attente</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#PT003</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Pierre+Martin&background=28a745&color=fff" alt="Pierre Martin" class="rounded-circle me-2" width="30">
                                    <span>Pierre Martin</span>
                                </div>
                            </td>
                            <td>58</td>
                            <td>Masculin</td>
                            <td>07 89 01 23 45</td>
                            <td>13/01/2024</td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#PT004</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Sophie+Laurent&background=6f42c1&color=fff" alt="Sophie Laurent" class="rounded-circle me-2" width="30">
                                    <span>Sophie Laurent</span>
                                </div>
                            </td>
                            <td>28</td>
                            <td>Féminin</td>
                            <td>06 54 32 10 98</td>
                            <td>12/01/2024</td>
                            <td><span class="badge bg-danger">Inactif</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>#PT005</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name=Thomas+Petit&background=fd7e14&color=fff" alt="Thomas Petit" class="rounded-circle me-2" width="30">
                                    <span>Thomas Petit</span>
                                </div>
                            </td>
                            <td>65</td>
                            <td>Masculin</td>
                            <td>01 98 76 54 32</td>
                            <td>11/01/2024</td>
                            <td><span class="badge bg-success">Actif</span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" title="Voir">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning" title="Modifier">
                                    <i class="bi bi-pencil"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Section des Rapports -->
    <div class="row g-4 mt-4">
        <div class="col-lg-6">
            <div class="chart-container">
                <h5 class="mb-4">Statistiques Mensuelles</h5>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-primary">
                                <i class="bi bi-hospital"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-value">156</h4>
                                <p class="stat-label">Nouveaux Patients</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-success">
                                <i class="bi bi-cash-stack"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-value">42 850 €</h4>
                                <p class="stat-label">Revenu Total</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-info">
                                <i class="bi bi-prescription"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-value">324</h4>
                                <p class="stat-label">Ordonnances</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-warning">
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-value">89%</h4>
                                <p class="stat-label">Satisfaction</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-6">
            <div class="chart-container">
                <h5 class="mb-4">Prochains Événements</h5>
                <div class="events-list">
                    <div class="event-item">
                        <div class="event-date">
                            <span class="event-day">18</span>
                            <span class="event-month">JAN</span>
                        </div>
                        <div class="event-details">
                            <h6 class="event-title">Réunion du Personnel</h6>
                            <p class="event-time"><i class="bi bi-clock me-1"></i> 09:00 - 10:30</p>
                            <p class="event-location"><i class="bi bi-geo-alt me-1"></i> Salle de Conférence</p>
                        </div>
                    </div>
                    <div class="event-item">
                        <div class="event-date bg-warning">
                            <span class="event-day">20</span>
                            <span class="event-month">JAN</span>
                        </div>
                        <div class="event-details">
                            <h6 class="event-title">Formation Logiciel</h6>
                            <p class="event-time"><i class="bi bi-clock me-1"></i> 14:00 - 16:00</p>
                            <p class="event-location"><i class="bi bi-geo-alt me-1"></i> Salle de Formation</p>
                        </div>
                    </div>
                    <div class="event-item">
                        <div class="event-date bg-success">
                            <span class="event-day">25</span>
                            <span class="event-month">JAN</span>
                        </div>
                        <div class="event-details">
                            <h6 class="event-title">Audit Qualité</h6>
                            <p class="event-time"><i class="bi bi-clock me-1"></i> Toute la journée</p>
                            <p class="event-location"><i class="bi bi-geo-alt me-1"></i> Tout l'établissement</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Cartes de statistiques */
    .dashboard-card {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    
    .dashboard-card h3 {
        font-size: 32px;
        font-weight: 700;
        margin: 12px 0 4px;
        color: #2c3e50;
    }
    
    .dashboard-card p {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 12px;
        font-weight: 500;
    }
    
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 28px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .card-icon.primary { background: linear-gradient(135deg, #007bff, #0056b3); }
    .card-icon.success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    .card-icon.warning { background: linear-gradient(135deg, #ffc107, #e0a800); }
    .card-icon.danger { background: linear-gradient(135deg, #dc3545, #c82333); }
    
    .card-footer {
        font-size: 13px;
        padding-top: 12px;
        border-top: 1px solid #f0f0f0;
        margin-top: 12px;
    }
    
    /* Conteneurs de graphiques */
    .chart-container {
        background: white;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .chart-container h5 {
        color: #2c3e50;
        font-weight: 600;
        font-size: 18px;
    }
    
    /* Liste d'activités */
    .activity-list .activity-item {
        padding: 16px;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }
    
    .activity-list .activity-item:hover {
        background-color: #f8f9fa;
    }
    
    .activity-list .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 18px;
    }
    
    .activity-icon.appointment { background: #e8f4fd; color: #007bff; }
    .activity-icon.patient { background: #e8f5e9; color: #28a745; }
    .activity-icon.payment { background: #fff3cd; color: #ffc107; }
    
    .activity-time {
        font-size: 12px;
        color: #6c757d;
    }
    
    /* Boutons d'action rapide */
    .quick-action-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 20px 12px;
        background: white;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        text-decoration: none;
        color: #495057;
        transition: all 0.3s;
        height: 100%;
    }
    
    .quick-action-btn:hover {
        background: linear-gradient(135deg, #007bff, #0056b3);
        border-color: #007bff;
        color: white;
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(0,123,255,0.2);
    }
    
    .quick-action-btn i {
        font-size: 28px;
        margin-bottom: 12px;
    }
    
    .quick-action-btn span {
        font-size: 13px;
        font-weight: 500;
        text-align: center;
    }
    
    /* Tableau */
    #patientsTable {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        overflow: hidden;
    }
    
    #patientsTable thead {
        background: #f8f9fa;
    }
    
    #patientsTable th {
        font-weight: 600;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }
    
    /* Cartes de statistiques supplémentaires */
    .stat-card {
        display: flex;
        align-items: center;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        border: 1px solid #f0f0f0;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        color: white;
        font-size: 22px;
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 13px;
        color: #6c757d;
        margin: 0;
    }
    
    /* Liste des événements */
    .events-list .event-item {
        display: flex;
        padding: 20px;
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s;
    }
    
    .events-list .event-item:hover {
        background-color: #f8f9fa;
    }
    
    .events-list .event-item:last-child {
        border-bottom: none;
    }
    
    .event-date {
        min-width: 60px;
        height: 60px;
        background: #007bff;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 16px;
    }
    
    .event-day {
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
    }
    
    .event-month {
        font-size: 12px;
        opacity: 0.9;
    }
    
    .event-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 6px;
    }
    
    .event-time, .event-location {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 4px;
    }
    
    /* Badges */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-card {
            padding: 20px;
        }
        
        .quick-action-btn {
            padding: 16px 8px;
        }
        
        .quick-action-btn i {
            font-size: 24px;
        }
        
        .stat-card {
            padding: 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialisation DataTable
        $('#patientsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/fr-FR.json'
            },
            responsive: true,
            pageLength: 10,
            order: [[5, 'desc']]
        });
        
        // Graphique Chart.js
        var ctx = document.getElementById('appointmentsChart').getContext('2d');
        var appointmentsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Rendez-vous',
                    data: [65, 59, 80, 81, 56, 55, 70, 75, 85, 90, 78, 82],
                    borderColor: 'rgb(0, 123, 255)',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de Rendez-vous'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Mois'
                        }
                    }
                }
            }
        });
        
        // Animation des cartes au scroll
        $(window).scroll(function() {
            $('.dashboard-card').each(function() {
                var elementTop = $(this).offset().top;
                var elementBottom = elementTop + $(this).outerHeight();
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                
                if (elementBottom > viewportTop && elementTop < viewportBottom) {
                    $(this).addClass('animated');
                }
            });
        });
    });
</script>
@endpush