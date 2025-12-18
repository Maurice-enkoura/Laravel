@extends('layouts.admin')

@section('title', 'Espace Médecin')

@section('content')
<!-- Espace Médecin -->
<div class="container-fluid">
    <!-- En-tête Professionnel -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Espace Médecin</h1>
            <p class="text-muted mb-0">Bonjour, Dr. {{ Auth::user()->name ?? 'Médecin' }}</p>
        </div>
        <div>
            <span class="badge bg-success me-3">
                <i class="bi bi-circle-fill me-1"></i> En ligne
            </span>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i> Nouveau Patient
            </button>
        </div>
    </div>

    <!-- Tableau de Bord Médical -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon primary">
                    <i class="bi bi-people"></i>
                </div>
                <h3>156</h3>
                <p>Patients Actifs</p>
                <div class="card-footer">
                    <span class="text-success">+12 ce mois</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon success">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h3>18</h3>
                <p>RDV Aujourd'hui</p>
                <div class="card-footer">
                    <span class="text-danger"><i class="bi bi-clock me-1"></i> 3 en attente</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon warning">
                    <i class="bi bi-prescription"></i>
                </div>
                <h3>24</h3>
                <p>Ordonnances à Rédiger</p>
                <div class="card-footer">
                    <span class="text-warning">Échéance: Aujourd'hui</span>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="dashboard-card">
                <div class="card-icon danger">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <h3>8</h3>
                <p>Messages non lus</p>
                <div class="card-footer">
                    <span class="text-info"><i class="bi bi-envelope me-1"></i> 3 urgents</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Planning & Salle d'Attente -->
    <div class="row g-4 mb-4">
        <!-- Planning Journalier -->
        <div class="col-lg-7">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Planning d'Aujourd'hui</h5>
                    <div class="d-flex align-items-center">
                        <button class="btn btn-sm btn-outline-primary me-2">
                            <i class="bi bi-arrow-left"></i>
                        </button>
                        <span class="fw-bold">Lundi 15 Janvier 2024</span>
                        <button class="btn btn-sm btn-outline-primary ms-2">
                            <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <div class="schedule-timeline">
                    @for($i = 8; $i <= 18; $i++)
                        @php
                            $hasAppointment = in_array($i, [9, 10, 11, 14, 15, 16]);
                            $isNow = $i == 14;
                            $timeSlot = sprintf('%02d:00', $i);
                        @endphp
                        
                        <div class="time-slot {{ $isNow ? 'current' : '' }}">
                            <div class="time-label">{{ $timeSlot }}</div>
                            <div class="time-content">
                                @if($hasAppointment)
                                    @if($i == 9)
                                    <div class="appointment-slot booked">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <img src="https://ui-avatars.com/api/?name=Marie+Dubois&background=28a745&color=fff" 
                                                         alt="Marie Dubois" class="rounded-circle me-2" width="30">
                                                    <h6 class="mb-0">Marie Dubois</h6>
                                                </div>
                                                <small class="text-muted">Consultation - Suivi</small>
                                            </div>
                                            <span class="badge bg-success">Confirmé</span>
                                        </div>
                                        <div class="appointment-info">
                                            <small><i class="bi bi-clock me-1"></i>09:00 - 09:30</small>
                                            <small><i class="bi bi-clipboard me-1 ms-3"></i>#DOS-00123</small>
                                        </div>
                                        <div class="appointment-actions mt-2">
                                            <button class="btn btn-sm btn-outline-primary btn-sm">
                                                Dossier
                                            </button>
                                            <button class="btn btn-sm btn-success btn-sm ms-2">
                                                Accueillir
                                            </button>
                                        </div>
                                    </div>
                                    @elseif($i == 10)
                                    <div class="appointment-slot booked urgent">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <img src="https://ui-avatars.com/api/?name=Jean+Martin&background=dc3545&color=fff" 
                                                         alt="Jean Martin" class="rounded-circle me-2" width="30">
                                                    <h6 class="mb-0">Jean Martin</h6>
                                                </div>
                                                <small class="text-muted">Urgence - Douleur thoracique</small>
                                            </div>
                                            <span class="badge bg-danger">Urgent</span>
                                        </div>
                                        <div class="appointment-info">
                                            <small><i class="bi bi-clock me-1"></i>10:00 - 10:45</small>
                                            <small><i class="bi bi-clipboard me-1 ms-3"></i>#DOS-00124</small>
                                        </div>
                                        <div class="appointment-actions mt-2">
                                            <button class="btn btn-sm btn-danger btn-sm">
                                                Priorité
                                            </button>
                                        </div>
                                    </div>
                                    @elseif($i == 14)
                                    <div class="appointment-slot booked current-slot">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="d-flex align-items-center mb-1">
                                                    <img src="https://ui-avatars.com/api/?name=Pierre+Bernard&background=ffc107&color=000" 
                                                         alt="Pierre Bernard" class="rounded-circle me-2" width="30">
                                                    <h6 class="mb-0">Pierre Bernard</h6>
                                                </div>
                                                <small class="text-muted">Consultation téléphonique</small>
                                            </div>
                                            <span class="badge bg-warning">En cours</span>
                                        </div>
                                        <div class="appointment-info">
                                            <small><i class="bi bi-clock me-1"></i>14:00 - 14:30</small>
                                            <small><i class="bi bi-phone me-1 ms-3"></i>Téléconsultation</small>
                                        </div>
                                        <div class="appointment-actions mt-2">
                                            <button class="btn btn-sm btn-primary me-2">
                                                <i class="bi bi-camera-video me-1"></i> Démarrer
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-file-text me-1"></i> Notes
                                            </button>
                                        </div>
                                    </div>
                                    @else
                                    <div class="appointment-slot booked">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">Patient #{{ $i }}</h6>
                                                <small class="text-muted">Consultation</small>
                                            </div>
                                            <span class="badge bg-success">Confirmé</span>
                                        </div>
                                        <div class="appointment-info">
                                            <small><i class="bi bi-clock me-1"></i>{{ $timeSlot }} - {{ sprintf('%02d:30', $i) }}</small>
                                        </div>
                                    </div>
                                    @endif
                                @elseif($i == 12 || $i == 13)
                                    <div class="appointment-slot break">
                                        <div class="text-center py-3">
                                            <i class="bi bi-cup display-6 text-muted"></i>
                                            <h6 class="mt-2 text-muted">Pause Déjeuner</h6>
                                        </div>
                                    </div>
                                @else
                                    <div class="appointment-slot available">
                                        <div class="text-center py-4">
                                            <button class="btn btn-outline-primary">
                                                <i class="bi bi-plus me-1"></i> Ajouter RDV
                                            </button>
                                            <p class="text-muted mt-2 mb-0">Créneau disponible</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        
        <!-- Salle d'Attente -->
        <div class="col-lg-5">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Salle d'Attente</h5>
                    <span class="badge bg-primary">4 patients</span>
                </div>
                <div class="waiting-room">
                    <div class="waiting-patient active">
                        <div class="patient-status-indicator"></div>
                        <div class="patient-avatar">
                            <img src="https://ui-avatars.com/api/?name=Lucie+Moreau&background=28a745&color=fff" 
                                 alt="Lucie Moreau" class="rounded-circle" width="50">
                        </div>
                        <div class="patient-info">
                            <h6 class="mb-1">Lucie Moreau</h6>
                            <small class="text-muted">#PAT-0045 • RDV: 15:00</small>
                            <div class="patient-details">
                                <span class="badge bg-info">Nouveau patient</span>
                                <small class="text-muted ms-2"><i class="bi bi-clock me-1"></i>Attente: 5 min</small>
                            </div>
                        </div>
                        <div class="patient-actions">
                            <button class="btn btn-sm btn-primary">
                                <i class="bi bi-check-lg me-1"></i> Accueillir
                            </button>
                        </div>
                    </div>
                    
                    <div class="waiting-patient">
                        <div class="patient-status-indicator"></div>
                        <div class="patient-avatar">
                            <img src="https://ui-avatars.com/api/?name=Thomas+Petit&background=6c757d&color=fff" 
                                 alt="Thomas Petit" class="rounded-circle" width="50">
                        </div>
                        <div class="patient-info">
                            <h6 class="mb-1">Thomas Petit</h6>
                            <small class="text-muted">#PAT-0123 • RDV: 15:30</small>
                            <div class="patient-details">
                                <span class="badge bg-secondary">Suivi régulier</span>
                                <small class="text-muted ms-2">Arrive dans 30 min</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="waiting-patient">
                        <div class="patient-status-indicator"></div>
                        <div class="patient-avatar">
                            <img src="https://ui-avatars.com/api/?name=Julie+Leroy&background=007bff&color=fff" 
                                 alt="Julie Leroy" class="rounded-circle" width="50">
                        </div>
                        <div class="patient-info">
                            <h6 class="mb-1">Julie Leroy</h6>
                            <small class="text-muted">#PAT-0089 • RDV: 16:00</small>
                            <div class="patient-details">
                                <span class="badge bg-warning">À rappeler</span>
                                <small class="text-muted ms-2">Attente des analyses</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="waiting-patient urgent">
                        <div class="patient-status-indicator"></div>
                        <div class="patient-avatar">
                            <img src="https://ui-avatars.com/api/?name=Marc+Dubois&background=dc3545&color=fff" 
                                 alt="Marc Dubois" class="rounded-circle" width="50">
                        </div>
                        <div class="patient-info">
                            <h6 class="mb-1">Marc Dubois</h6>
                            <small class="text-muted">#PAT-0034 • Sans RDV</small>
                            <div class="patient-details">
                                <span class="badge bg-danger">Urgence</span>
                                <small class="text-danger ms-2"><i class="bi bi-thermometer-high me-1"></i>Fièvre élevée</small>
                            </div>
                        </div>
                        <div class="patient-actions">
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-exclamation-triangle me-1"></i> Priorité
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Statistiques de Consultation -->
                <div class="consultation-stats mt-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-value">78%</div>
                                <div class="stat-label">Taux de Présence</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-value">22 min</div>
                                <div class="stat-label">Durée Moyenne</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-value">94%</div>
                                <div class="stat-label">Satisfaction</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item">
                                <div class="stat-value">5 min</div>
                                <div class="stat-label">Retard Moyen</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ordonnances & Communication -->
    <div class="row g-4">
        <!-- Ordonnances en Attente -->
        <div class="col-lg-6">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Ordonnances à Rédiger</h5>
                    <span class="badge bg-warning">2 urgentes</span>
                </div>
                <div class="prescriptions-list">
                    <div class="prescription-item priority">
                        <div class="prescription-header">
                            <div class="patient-info-small">
                                <img src="https://ui-avatars.com/api/?name=Marie+Dubois&background=28a745&color=fff" 
                                     alt="Marie Dubois" class="rounded-circle me-2" width="40">
                                <div>
                                    <h6 class="mb-0">Marie Dubois</h6>
                                    <small class="text-muted">Consultation: 09:00 • #DOS-00123</small>
                                </div>
                            </div>
                            <span class="badge bg-danger">À faire aujourd'hui</span>
                        </div>
                        <div class="prescription-body">
                            <p class="mb-2"><strong>Diagnostic:</strong> Infection urinaire non compliquée</p>
                            <div class="medication-preview">
                                <span class="badge bg-light text-dark me-2">Ciprofloxacin 500mg</span>
                                <span class="badge bg-light text-dark">Paracétamol 1g</span>
                                <span class="badge bg-light text-dark">Phloroglucinol 80mg</span>
                            </div>
                        </div>
                        <div class="prescription-actions">
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil me-1"></i> Rédiger
                            </button>
                            <button class="btn btn-outline-secondary btn-sm ms-2">
                                <i class="bi bi-clock-history me-1"></i> Reporter
                            </button>
                        </div>
                    </div>
                    
                    <div class="prescription-item">
                        <div class="prescription-header">
                            <div class="patient-info-small">
                                <img src="https://ui-avatars.com/api/?name=Jean+Martin&background=007bff&color=fff" 
                                     alt="Jean Martin" class="rounded-circle me-2" width="40">
                                <div>
                                    <h6 class="mb-0">Jean Martin</h6>
                                    <small class="text-muted">Urgence: 10:00 • #DOS-00124</small>
                                </div>
                            </div>
                            <span class="badge bg-warning">À faire cette semaine</span>
                        </div>
                        <div class="prescription-body">
                            <p class="mb-2"><strong>Diagnostic:</strong> Douleurs articulaires chroniques</p>
                            <div class="medication-preview">
                                <span class="badge bg-light text-dark me-2">Ibuprofène 400mg</span>
                                <span class="badge bg-light text-dark">Paracétamol 1g</span>
                            </div>
                        </div>
                        <div class="prescription-actions">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-pencil me-1"></i> Rédiger
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-3">
                    <button class="btn btn-outline-primary w-100">
                        <i class="bi bi-prescription me-2"></i> Voir toutes les ordonnances
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Messagerie Professionnelle -->
        <div class="col-lg-6">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Messagerie Professionnelle</h5>
                    <span class="badge bg-primary">8 messages</span>
                </div>
                <div class="messages-list">
                    <div class="message-item unread">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=Dr+Sophie+L&background=6f42c1&color=fff" 
                                 alt="Dr. Sophie L" class="rounded-circle" width="45">
                        </div>
                        <div class="message-content">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Dr. Sophie Laurent</h6>
                                <small class="text-muted">Il y a 10 min</small>
                            </div>
                            <p class="mb-1">Demande de consultation conjointe pour le patient #PAT-0045...</p>
                            <small class="text-primary"><i class="bi bi-envelope me-1"></i> Demande professionnelle</small>
                        </div>
                    </div>
                    
                    <div class="message-item">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=Laboratoire+Central&background=fd7e14&color=fff" 
                                 alt="Laboratoire" class="rounded-circle" width="45">
                        </div>
                        <div class="message-content">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Laboratoire Central</h6>
                                <small class="text-muted">Il y a 2 heures</small>
                            </div>
                            <p class="mb-1">Résultats d'analyses disponibles pour 3 patients...</p>
                            <small class="text-success"><i class="bi bi-clipboard-check me-1"></i> Résultats disponibles</small>
                        </div>
                    </div>
                    
                    <div class="message-item unread urgent">
                        <div class="message-avatar">
                            <img src="https://ui-avatars.com/api/?name=Marie+Dubois&background=28a745&color=fff" 
                                 alt="Marie Dubois" class="rounded-circle" width="45">
                        </div>
                        <div class="message-content">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-1">Marie Dubois</h6>
                                <small class="text-muted">Il y a 3 heures</small>
                            </div>
                            <p class="mb-1">Effets secondaires suite au traitement, besoin de conseil urgent...</p>
                            <small class="text-danger"><i class="bi bi-exclamation-triangle me-1"></i> Urgent</small>
                        </div>
                    </div>
                </div>
                
                <div class="new-message mt-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Écrire un message...">
                        <button class="btn btn-primary" type="button">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mes Patients -->
    <div class="row g-4 mt-4">
        <div class="col-12">
            <div class="chart-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Mes Patients Récemment Vus</h5>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-search me-2"></i> Rechercher un patient
                    </button>
                </div>
                <div class="row g-3">
                    @foreach([
                        ['name' => 'Marie Dubois', 'last_visit' => '15/01/2024', 'next_visit' => '15/02/2024', 'status' => 'success', 'specialty' => 'Cardiologie'],
                        ['name' => 'Jean Martin', 'last_visit' => '14/01/2024', 'next_visit' => '28/01/2024', 'status' => 'warning', 'specialty' => 'Médecine Générale'],
                        ['name' => 'Thomas Petit', 'last_visit' => '13/01/2024', 'next_visit' => '27/01/2024', 'status' => 'success', 'specialty' => 'Médecine Générale'],
                        ['name' => 'Sophie Laurent', 'last_visit' => '12/01/2024', 'next_visit' => '26/01/2024', 'status' => 'danger', 'specialty' => 'Dermatologie'],
                        ['name' => 'Pierre Bernard', 'last_visit' => '11/01/2024', 'next_visit' => '25/01/2024', 'status' => 'success', 'specialty' => 'Médecine Générale'],
                        ['name' => 'Julie Leroy', 'last_visit' => '10/01/2024', 'next_visit' => '24/01/2024', 'status' => 'info', 'specialty' => 'Pédiatrie']
                    ] as $patient)
                    <div class="col-md-4">
                        <div class="patient-card">
                            <div class="patient-header">
                                <div class="patient-avatar">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($patient['name']) }}&background=1977cc&color=fff" 
                                         alt="{{ $patient['name'] }}" class="rounded-circle" width="50">
                                </div>
                                <div class="patient-basic">
                                    <h6 class="mb-1">{{ $patient['name'] }}</h6>
                                    <small class="text-muted">{{ $patient['specialty'] }}</small>
                                </div>
                                <span class="badge bg-{{ $patient['status'] }}">●</span>
                            </div>
                            <div class="patient-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar"></i>
                                    <div>
                                        <small>Dernière visite</small>
                                        <p class="mb-0">{{ $patient['last_visit'] }}</p>
                                    </div>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-calendar-check"></i>
                                    <div>
                                        <small>Prochain RDV</small>
                                        <p class="mb-0">{{ $patient['next_visit'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="patient-actions">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-chat"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Cartes médecin */
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
    
    /* Planning */
    .schedule-timeline {
        background: white;
        border-radius: 12px;
        padding: 20px;
        max-height: 600px;
        overflow-y: auto;
    }
    
    .time-slot {
        display: flex;
        border-bottom: 1px solid #f0f0f0;
        padding: 16px 0;
    }
    
    .time-slot.current {
        background: #fff9e6;
        border-radius: 8px;
        margin: 0 -10px;
        padding: 16px 10px;
        border-left: 4px solid #ffc107;
    }
    
    .time-label {
        width: 80px;
        font-weight: 700;
        color: #495057;
        font-size: 15px;
        flex-shrink: 0;
    }
    
    .appointment-slot {
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 12px;
        width: 100%;
    }
    
    .appointment-slot.booked {
        background: #f0f8ff;
        border-left: 4px solid #007bff;
    }
    
    .appointment-slot.urgent {
        background: #fff5f5;
        border-left: 4px solid #dc3545;
    }
    
    .appointment-slot.current-slot {
        background: #fff9e6;
        border-left: 4px solid #ffc107;
    }
    
    .appointment-slot.break {
        background: #f8f9fa;
        border-left: 4px solid #6c757d;
    }
    
    .appointment-slot.available {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
    }
    
    .appointment-info {
        display: flex;
        margin-top: 8px;
    }
    
    /* Salle d'attente */
    .waiting-room {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .waiting-patient {
        display: flex;
        align-items: center;
        padding: 16px;
        background: white;
        border-radius: 10px;
        margin-bottom: 12px;
        border: 1px solid #e9ecef;
        position: relative;
        transition: all 0.3s;
    }
    
    .waiting-patient.active {
        border-left: 4px solid #28a745;
    }
    
    .waiting-patient.urgent {
        border-left: 4px solid #dc3545;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
        70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
    }
    
    .patient-status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #28a745;
        position: absolute;
        left: 8px;
        top: 50%;
        transform: translateY(-50%);
    }
    
    .waiting-patient.urgent .patient-status-indicator {
        background: #dc3545;
        animation: blink 1s infinite;
    }
    
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    
    .patient-info {
        flex-grow: 1;
        margin: 0 16px;
    }
    
    .patient-details {
        display: flex;
        gap: 12px;
        margin-top: 6px;
    }
    
    /* Statistiques */
    .consultation-stats .stat-item {
        text-align: center;
        padding: 16px;
        background: white;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: #007bff;
        margin-bottom: 4px;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6c757d;
        text-transform: uppercase;
        font-weight: 500;
    }
    
    /* Ordonnances */
    .prescription-item {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 16px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .prescription-item.priority {
        border-left: 4px solid #dc3545;
        background: #fff9f9;
    }
    
    .prescription-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 12px;
    }
    
    .patient-info-small {
        display: flex;
        align-items: center;
    }
    
    .medication-preview {
        margin-top: 12px;
    }
    
    /* Messagerie */
    .messages-list {
        max-height: 300px;
        overflow-y: auto;
    }
    
    .message-item {
        display: flex;
        padding: 16px;
        background: white;
        border-radius: 10px;
        margin-bottom: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .message-item.unread {
        background: #f0f8ff;
        border-left: 4px solid #007bff;
    }
    
    .message-item.urgent {
        background: #fff5f5;
        border-left: 4px solid #dc3545;
    }
    
    .message-content {
        flex-grow: 1;
        margin-left: 16px;
    }
    
    /* Cartes patients */
    .patient-card {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.3s;
    }
    
    .patient-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .patient-header {
        display: flex;
        align-items: center;
        margin-bottom: 16px;
    }
    
    .patient-basic {
        flex-grow: 1;
        margin: 0 12px;
    }
    
    .patient-details .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 12px;
    }
    
    .patient-details .detail-item i {
        margin-right: 12px;
        font-size: 18px;
        color: #007bff;
    }
    
    .patient-actions {
        display: flex;
        gap: 8px;
        justify-content: center;
        margin-top: 16px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .time-slot {
            flex-direction: column;
        }
        
        .time-label {
            width: 100%;
            margin-bottom: 12px;
        }
        
        .waiting-patient {
            flex-wrap: wrap;
        }
        
        .patient-actions {
            width: 100%;
            margin-top: 12px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Gestion du planning
        $('.appointment-slot .btn').click(function(e) {
            e.stopPropagation();
            var patientName = $(this).closest('.appointment-slot').find('h6').text();
            alert('Action pour: ' + patientName);
        });
        
        // Gestion de la salle d'attente
        $('.waiting-patient .btn').click(function(e) {
            e.stopPropagation();
            var patientName = $(this).closest('.waiting-patient').find('h6').text();
            var action = $(this).text().trim();
            alert(action + ' - ' + patientName);
        });
        
        // Animation des cartes
        $('.dashboard-card, .patient-card').hover(
            function() {
                $(this).addClass('hover-effect');
            },
            function() {
                $(this).removeClass('hover-effect');
            }
        );
        
        // Simulation de notifications
        setInterval(function() {
            if (Math.random() > 0.7) {
                showNotification('Nouveau patient en salle d\'attente');
            }
        }, 30000);
        
        function showNotification(message) {
            // Créer une notification toast
            var toast = $('<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">' +
                '<div class="toast-header">' +
                '<i class="bi bi-bell text-primary me-2"></i>' +
                '<strong class="me-auto">Notification</strong>' +
                '<small>À l\'instant</small>' +
                '<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>' +
                '</div>' +
                '<div class="toast-body">' + message + '</div>' +
                '</div>');
            
            $('.toast-container').append(toast);
            new bootstrap.Toast(toast[0]).show();
        }
    });
</script>
@endpush