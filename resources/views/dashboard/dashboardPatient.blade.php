@extends('layouts.admin')

@section('title', 'Mon Espace Patient')

@section('content')
<!-- Espace Patient -->
<div class="container-fluid">
    <!-- En-tête Personnel -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Mon Espace Santé</h1>
            <p class="text-muted mb-0">Bonjour, {{ Auth::user()->name ?? 'Patient' }}</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="bi bi-calendar-plus me-2"></i> Prendre Rendez-vous
            </button>
        </div>
    </div>

    <!-- Mes Indicateurs -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon primary">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h3>3</h3>
                <p>RDV à Venir</p>
                <div class="card-footer">
                    <span class="text-info"><i class="bi bi-clock-history me-1"></i> Prochain: Aujourd'hui 14:30</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon success">
                    <i class="bi bi-file-text"></i>
                </div>
                <h3>12</h3>
                <p>Ordonnances</p>
                <div class="card-footer">
                    <span class="text-success"><i class="bi bi-check-circle me-1"></i> Dernière: Hier</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon warning">
                    <i class="bi bi-clipboard-pulse"></i>
                </div>
                <h3>8</h3>
                <p>Résultats d'Analyses</p>
                <div class="card-footer">
                    <span class="text-warning"><i class="bi bi-hourglass me-1"></i> 2 en attente</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon danger">
                    <i class="bi bi-credit-card"></i>
                </div>
                <h3>420 €</h3>
                <p>Factures en Attente</p>
                <div class="card-footer">
                    <span class="text-danger"><i class="bi bi-exclamation-circle me-1"></i> À payer avant 30/01</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Prochain RDV & Santé -->
    <div class="row g-4 mb-4">
        <!-- Prochain Rendez-vous -->
        <div class="col-lg-6">
            <div class="chart-container">
                <h5 class="mb-4">Mon Prochain Rendez-vous</h5>
                <div class="appointment-card featured">
                    <div class="d-flex align-items-center mb-3">
                        <div class="doctor-avatar me-3">
                            <img src="https://ui-avatars.com/api/?name=Dr+Martin&background=1977cc&color=fff" 
                                 alt="Dr. Martin" class="rounded-circle" width="70">
                        </div>
                        <div>
                            <h6 class="mb-1">Dr. Martin Dupont</h6>
                            <p class="text-muted mb-0">Cardiologue</p>
                            <div class="rating">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-half text-warning"></i>
                                <span class="ms-2">4.5/5</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="appointment-details">
                        <div class="row">
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="bi bi-calendar text-primary"></i>
                                    <span>Aujourd'hui</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="bi bi-clock text-primary"></i>
                                    <span>14:30 - 15:00</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="bi bi-geo-alt text-primary"></i>
                                    <span>Cabinet A, Étage 2</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="detail-item">
                                    <i class="bi bi-telephone text-primary"></i>
                                    <span>01 23 45 67 89</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="appointment-actions mt-3 pt-3 border-top">
                        <button class="btn btn-sm btn-primary me-2">
                            <i class="bi bi-camera-video me-1"></i> Visioconférence
                        </button>
                        <button class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-info-circle me-1"></i> Détails
                        </button>
                        <button class="btn btn-sm btn-outline-danger float-end">
                            <i class="bi bi-x-circle me-1"></i> Annuler
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mon Suivi Santé -->
        <div class="col-lg-6">
            <div class="chart-container">
                <h5 class="mb-4">Mon Suivi Santé</h5>
                <div class="health-metrics">
                    <div class="metric-item">
                        <div class="metric-header">
                            <span class="metric-label">Tension Artérielle</span>
                            <span class="metric-time">Mesurée: 08:00</span>
                        </div>
                        <div class="metric-value">120/80</div>
                        <div class="metric-progress">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="metric-status text-success">
                            <i class="bi bi-check-circle me-1"></i> Normale
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-header">
                            <span class="metric-label">Glycémie</span>
                            <span class="metric-time">À jeun</span>
                        </div>
                        <div class="metric-value">0.95 g/L</div>
                        <div class="metric-progress">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-warning" style="width: 65%"></div>
                            </div>
                        </div>
                        <div class="metric-status text-warning">
                            <i class="bi bi-exclamation-circle me-1"></i> À surveiller
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-header">
                            <span class="metric-label">Poids</span>
                            <span class="metric-time">Évolution mensuelle</span>
                        </div>
                        <div class="metric-value">72 kg</div>
                        <div class="metric-progress">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-info" style="width: 70%"></div>
                            </div>
                        </div>
                        <div class="metric-status text-info">
                            <i class="bi bi-arrow-down me-1"></i> -2 kg ce mois
                        </div>
                    </div>
                    
                    <div class="metric-item">
                        <div class="metric-header">
                            <span class="metric-label">Fréquence Cardiaque</span>
                            <span class="metric-time">Au repos</span>
                        </div>
                        <div class="metric-value">72 bpm</div>
                        <div class="metric-progress">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                        </div>
                        <div class="metric-status text-success">
                            <i class="bi bi-check-circle me-1"></i> Normale
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Historique & Documents -->
    <div class="row g-4">
        <!-- Mes Rendez-vous Passés -->
        <div class="col-lg-8">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Historique de Mes Consultations</h5>
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-download me-1"></i> Exporter
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Médecin</th>
                                <th>Spécialité</th>
                                <th>Type</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/01/2024</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Dr+Martin&background=1977cc&color=fff" 
                                             alt="Dr. Martin" class="rounded-circle me-2" width="30">
                                        <span>Dr. Martin Dupont</span>
                                    </div>
                                </td>
                                <td>Cardiologie</td>
                                <td><span class="badge bg-info">Consultation</span></td>
                                <td><span class="badge bg-success">Terminé</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Voir compte-rendu">
                                        <i class="bi bi-file-text"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>10/01/2024</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Dr+Sophie&background=6f42c1&color=fff" 
                                             alt="Dr. Sophie" class="rounded-circle me-2" width="30">
                                        <span>Dr. Sophie Laurent</span>
                                    </div>
                                </td>
                                <td>Dermatologie</td>
                                <td><span class="badge bg-warning">Suivi</span></td>
                                <td><span class="badge bg-success">Terminé</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Voir compte-rendu">
                                        <i class="bi bi-file-text"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>05/01/2024</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=Dr+Robert&background=28a745&color=fff" 
                                             alt="Dr. Robert" class="rounded-circle me-2" width="30">
                                        <span>Dr. Robert Chen</span>
                                    </div>
                                </td>
                                <td>Ophtalmologie</td>
                                <td><span class="badge bg-primary">Examen</span></td>
                                <td><span class="badge bg-success">Terminé</span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" title="Voir compte-rendu">
                                        <i class="bi bi-file-text"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Mes Documents -->
        <div class="col-lg-4">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Mes Documents</h5>
                    <span class="badge bg-primary">8 fichiers</span>
                </div>
                <div class="documents-list">
                    <div class="document-item">
                        <div class="document-icon bg-primary">
                            <i class="bi bi-file-earmark-medical"></i>
                        </div>
                        <div class="document-info">
                            <h6>Ordonnance - Cardiologie</h6>
                            <small class="text-muted">Dr. Martin Dupont • 15/01/2024</small>
                        </div>
                        <div class="document-actions">
                            <button class="btn btn-sm btn-outline-primary" title="Télécharger">
                                <i class="bi bi-download"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon bg-success">
                            <i class="bi bi-clipboard-data"></i>
                        </div>
                        <div class="document-info">
                            <h6>Résultats d'Analyses</h6>
                            <small class="text-muted">Laboratoire Central • 12/01/2024</small>
                        </div>
                        <div class="document-actions">
                            <button class="btn btn-sm btn-outline-primary" title="Télécharger">
                                <i class="bi bi-download"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon bg-warning">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <div class="document-info">
                            <h6>Facture #FAC-00123</h6>
                            <small class="text-muted">Montant: 150 € • 10/01/2024</small>
                        </div>
                        <div class="document-actions">
                            <button class="btn btn-sm btn-outline-primary" title="Télécharger">
                                <i class="bi bi-download"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="document-item">
                        <div class="document-icon bg-info">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="document-info">
                            <h6>Compte Rendu Médical</h6>
                            <small class="text-muted">Dr. Sophie Laurent • 05/01/2024</small>
                        </div>
                        <div class="document-actions">
                            <button class="btn btn-sm btn-outline-primary" title="Télécharger">
                                <i class="bi bi-download"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary w-100">
                        <i class="bi bi-folder me-2"></i> Voir tous mes documents
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mes Médicaments -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="chart-container">
                <h5 class="mb-4">Mes Traitements en Cours</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="medication-card">
                            <div class="medication-header">
                                <h6>Atorvastatine 20mg</h6>
                                <span class="badge bg-primary">Cholestérol</span>
                            </div>
                            <div class="medication-details">
                                <p><i class="bi bi-calendar me-2"></i>Durée: 30 jours</p>
                                <p><i class="bi bi-clock me-2"></i>Posologie: 1 comprimé/jour</p>
                                <p><i class="bi bi-person me-2"></i>Prescrit par: Dr. Martin</p>
                            </div>
                            <div class="medication-progress">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: 60%"></div>
                                </div>
                                <small class="text-muted">15 jours restants</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medication-card">
                            <div class="medication-header">
                                <h6>Metformine 850mg</h6>
                                <span class="badge bg-warning">Diabète</span>
                            </div>
                            <div class="medication-details">
                                <p><i class="bi bi-calendar me-2"></i>Durée: 90 jours</p>
                                <p><i class="bi bi-clock me-2"></i>Posologie: 2 comprimés/jour</p>
                                <p><i class="bi bi-person me-2"></i>Prescrit par: Dr. Martin</p>
                            </div>
                            <div class="medication-progress">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" style="width: 30%"></div>
                                </div>
                                <small class="text-muted">63 jours restants</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="medication-card">
                            <div class="medication-header">
                                <h6>Oméprazole 20mg</h6>
                                <span class="badge bg-info">Estomac</span>
                            </div>
                            <div class="medication-details">
                                <p><i class="bi bi-calendar me-2"></i>Durée: 14 jours</p>
                                <p><i class="bi bi-clock me-2"></i>Posologie: 1 comprimé/jour</p>
                                <p><i class="bi bi-person me-2"></i>Prescrit par: Dr. Sophie</p>
                            </div>
                            <div class="medication-progress">
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-warning" style="width: 85%"></div>
                                </div>
                                <small class="text-muted">2 jours restants</small>
                            </div>
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
    /* Cartes patient */
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
        color: white;
    }
    
    .card-icon.primary { background: linear-gradient(135deg, #007bff, #0056b3); }
    .card-icon.success { background: linear-gradient(135deg, #28a745, #1e7e34); }
    .card-icon.warning { background: linear-gradient(135deg, #ffc107, #e0a800); }
    .card-icon.danger { background: linear-gradient(135deg, #dc3545, #c82333); }
    
    /* Carte de rendez-vous */
    .appointment-card.featured {
        border: 2px solid #007bff;
        background: linear-gradient(to bottom, #ffffff, #f8fbff);
    }
    
    .doctor-avatar img {
        border: 3px solid #007bff;
    }
    
    .rating {
        font-size: 14px;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .detail-item i {
        margin-right: 10px;
        font-size: 18px;
    }
    
    /* Suivi santé */
    .health-metrics .metric-item {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 15px;
        border-left: 4px solid #007bff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .metric-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    
    .metric-label {
        font-weight: 600;
        color: #495057;
    }
    
    .metric-time {
        font-size: 12px;
        color: #6c757d;
    }
    
    .metric-value {
        font-size: 28px;
        font-weight: 700;
        color: #2c3e50;
        margin: 8px 0;
    }
    
    .metric-status {
        font-size: 13px;
        margin-top: 8px;
    }
    
    /* Documents */
    .documents-list .document-item {
        display: flex;
        align-items: center;
        padding: 16px;
        background: white;
        border-radius: 10px;
        margin-bottom: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .documents-list .document-item:hover {
        border-color: #007bff;
        box-shadow: 0 4px 12px rgba(0,123,255,0.1);
    }
    
    .document-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 16px;
        font-size: 24px;
        color: white;
    }
    
    .document-info {
        flex-grow: 1;
    }
    
    .document-info h6 {
        margin-bottom: 4px;
        color: #2c3e50;
    }
    
    /* Médicaments */
    .medication-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        height: 100%;
    }
    
    .medication-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .medication-header h6 {
        font-weight: 600;
        color: #2c3e50;
        margin: 0;
    }
    
    .medication-details p {
        font-size: 13px;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .medication-progress {
        margin-top: 15px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-card {
            padding: 20px;
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            font-size: 24px;
        }
        
        .document-item {
            padding: 12px;
        }
        
        .medication-card {
            margin-bottom: 15px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Animation des cartes
        $('.dashboard-card').hover(
            function() {
                $(this).addClass('animated');
            },
            function() {
                $(this).removeClass('animated');
            }
        );
        
        // Gestion des boutons de téléchargement
        $('.document-actions .btn').click(function(e) {
            e.preventDefault();
            var documentName = $(this).closest('.document-item').find('h6').text();
            alert('Téléchargement de: ' + documentName);
        });
        
        // Affichage de l'heure actuelle
        function updateTime() {
            var now = new Date();
            var timeString = now.toLocaleTimeString('fr-FR', { 
                hour: '2-digit', 
                minute: '2-digit' 
            });
            $('.current-time').text(timeString);
        }
        
        setInterval(updateTime, 60000);
        updateTime();
    });
</script>
@endpush