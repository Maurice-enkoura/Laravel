@extends('layouts.app')

@section('title', $service->nom . ' - MediBook')

@push('styles')
<style>
    /* Variables CSS */
    :root {
        --primary: #2D6FF7;
        --primary-light: rgba(45, 111, 247, 0.1);
        --secondary: #4F83FF;
        --success: #10B981;
        --success-light: rgba(16, 185, 129, 0.1);
        --info: #3B82F6;
        --info-light: rgba(59, 130, 246, 0.1);
        --warning: #F59E0B;
        --warning-light: rgba(245, 158, 11, 0.1);
        --danger: #EF4444;
        --dark: #1F2937;
        --gray: #6B7280;
        --gray-light: #E5E7EB;
        --radius: 12px;
        --radius-lg: 16px;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Hero Section */
    .service-hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .service-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .service-header {
        position: relative;
        z-index: 1;
    }

    .service-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .service-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .service-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: center;
        margin-bottom: 2rem;
    }

    .service-meta .badge {
        font-size: 0.875rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
    }

    .service-description {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .service-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .service-hero-image {
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* Detail Items */
    .detail-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-light);
        transition: var(--transition);
        height: 100%;
    }

    .detail-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow);
        transform: translateY(-2px);
    }

    .detail-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 1.25rem;
        flex-shrink: 0;
    }

    .detail-content h6 {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray);
        margin-bottom: 0.25rem;
    }

    .detail-content h4 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .detail-content p {
        font-size: 0.875rem;
        color: var(--gray);
        margin-bottom: 0;
    }

    /* Doctor Profile */
    .doctor-avatar-lg {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        font-weight: 600;
        border: 4px solid white;
        box-shadow: var(--shadow);
        margin: 0 auto 1.5rem;
    }

    .qualification-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        border-radius: var(--radius);
        margin-bottom: 0.75rem;
        transition: var(--transition);
    }

    .qualification-item:hover {
        background: var(--gray-light);
    }

    .qualification-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1rem;
    }

    /* Quick Actions */
    .quick-action {
        display: flex;
        align-items: center;
        padding: 1.25rem;
        border: 1px solid var(--gray-light);
        border-radius: var(--radius);
        margin-bottom: 0.75rem;
        text-decoration: none;
        transition: var(--transition);
        background: white;
    }

    .quick-action:hover {
        border-color: var(--primary);
        background: var(--primary-light);
        transform: translateX(4px);
        text-decoration: none;
    }

    .quick-action.primary {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .quick-action.primary:hover {
        background: #2563EB;
        border-color: #2563EB;
    }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        font-size: 1.25rem;
    }

    .quick-action.primary .action-icon {
        background: rgba(255, 255, 255, 0.2);
    }

    .quick-action .action-content strong {
        font-size: 1rem;
        font-weight: 600;
        display: block;
        margin-bottom: 0.25rem;
    }

    .quick-action .action-content small {
        font-size: 0.875rem;
        opacity: 0.9;
    }

    /* Availability Cards */
    .availability-card {
        text-align: center;
        padding: 2rem;
        background: white;
        border: 1px solid var(--gray-light);
        border-radius: var(--radius);
        transition: var(--transition);
        height: 100%;
    }

    .availability-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow);
    }

    .availability-icon {
        width: 70px;
        height: 70px;
        background: var(--gray-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin: 0 auto 1.5rem;
    }

    .availability-card h4 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: var(--dark);
    }

    /* Additional Info */
    .additional-info {
        background: var(--primary-light);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-top: 2rem;
    }

    /* Card Styles */
    .card-header-custom {
        background: white;
        border-bottom: 2px solid var(--primary-light);
        padding: 1.25rem 1.5rem;
    }

    .card-header-custom h5 {
        display: flex;
        align-items: center;
        margin-bottom: 0;
        font-size: 1.125rem;
    }

    .card-header-custom i {
        margin-right: 0.75rem;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .status-badge.available {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .status-badge.unavailable {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .service-hero {
            padding: 3rem 0;
        }

        .service-title {
            font-size: 2rem;
        }

        .service-description {
            font-size: 1rem;
        }

        .service-actions {
            flex-direction: column;
        }

        .service-actions .btn {
            width: 100%;
            justify-content: center;
        }

        .detail-item {
            flex-direction: column;
            text-align: center;
            padding: 1.25rem;
        }

        .detail-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .service-meta {
            justify-content: center;
        }

        .quick-action {
            padding: 1rem;
        }

        .availability-card {
            margin-bottom: 1rem;
            padding: 1.5rem;
        }

        .page-header-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .page-header-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 992px) {
        .service-hero-image {
            margin-top: 2rem;
        }

        .service-hero-image img {
            max-height: 250px;
        }
    }

    /* Print Styles */
    @media print {
        .service-actions,
        .quick-action,
        .btn {
            display: none !important;
        }

        .service-hero {
            background: white !important;
            color: var(--dark) !important;
            padding: 1rem 0 !important;
        }

        .service-hero::before {
            display: none;
        }

        .service-icon {
            background: var(--gray-light) !important;
            color: var(--primary) !important;
        }

        .card {
            border: 1px solid var(--gray-light) !important;
            box-shadow: none !important;
        }
    }
</style>
@endpush

@section('page-header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="h2 fw-bold mb-2">{{ $service->nom }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">Accueil</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('services.index') }}" class="text-decoration-none">Services</a>
                    </li>
                    <li class="breadcrumb-item active text-primary">{{ Str::limit($service->nom, 30) }}</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2 page-header-actions">
            <a href="{{ route('services.index') }}" class="btn btn-outline-primary d-flex align-items-center">
                <i class="fas fa-arrow-left me-2"></i>
                <span class="d-none d-md-inline">Retour aux services</span>
            </a>
            @auth
                @if(auth()->user()->role === 'patient')
                    <a href="{{ route('reservations.create', $service->id) }}" 
                       class="btn btn-primary d-flex align-items-center">
                        <i class="fas fa-calendar-plus me-2"></i>
                        <span class="d-none d-md-inline">Prendre RDV</span>
                    </a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-0">

    <!-- Hero Section -->
    <section class="service-hero">
        <div class="container position-relative" style="z-index: 1;">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="service-header">
                        <div class="service-icon">
                            <i class="fas fa-stethoscope"></i>
                        </div>
                        <h1 class="service-title">{{ $service->nom }}</h1>
                        
                        <div class="service-meta">
                            <span class="status-badge {{ $service->statut == 'actif' ? 'available' : 'unavailable' }}">
                                <i class="fas fa-circle fa-xs me-1"></i>
                                {{ $service->statut == 'actif' ? 'Disponible' : 'Indisponible' }}
                            </span>
                            <span class="text-white opacity-90 d-flex align-items-center">
                                <i class="fas fa-user-md me-1"></i>
                                Dr. {{ $service->medecin->name ?? 'Non assigné' }}
                            </span>
                        </div>
                        
                        <p class="service-description">{{ $service->description }}</p>
                        
                        <div class="service-actions">
                            @auth
                                @if(auth()->user()->role === 'patient')
                                    <a href="{{ route('reservations.create', $service->id) }}" 
                                       class="btn btn-light btn-lg px-4 d-flex align-items-center">
                                        <i class="fas fa-calendar-plus me-2"></i>Prendre rendez-vous
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" 
                                   class="btn btn-light btn-lg px-4 d-flex align-items-center">
                                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter pour réserver
                                </a>
                            @endauth
                            <a href="{{ route('services.index') }}" 
                               class="btn btn-outline-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-arrow-left me-2"></i>Retour aux services
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="service-hero-image text-center">
                        <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" 
                             alt="{{ $service->nom }}" 
                             class="img-fluid"
                             style="max-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="row g-4">
            <!-- Left Column - Service Details -->
            <div class="col-lg-8">
                <!-- Service Information Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-info-circle text-primary"></i>
                            Informations détaillées
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Doctor Information -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-icon bg-primary-light text-primary">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6>Médecin responsable</h6>
                                        <h4>Dr. {{ $service->medecin->name ?? 'Non assigné' }}</h4>
                                        @if($service->medecin->specialite ?? false)
                                            <p>{{ $service->medecin->specialite }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Price Information -->
                            @if($service->tarif)
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-icon bg-success-light text-success">
                                        <i class="fas fa-euro-sign"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6>Tarif de consultation</h6>
                                        <h4 class="text-success">{{ $service->tarif }} €</h4>
                                        <p>Honoraires standards</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Duration Information -->
                            @if($service->duree_consultation)
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-icon bg-info-light text-info">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6>Durée moyenne</h6>
                                        <h4>{{ $service->duree_consultation }} minutes</h4>
                                        <p>Temps de consultation estimé</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Availability Information -->
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <div class="detail-icon bg-warning-light text-warning">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="detail-content">
                                        <h6>Disponibilité</h6>
                                        <h4>Sur rendez-vous</h4>
                                        <p>Réservation en ligne 24/7</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        @if($service->informations_supplementaires)
                        <div class="additional-info">
                            <h5 class="fw-bold mb-3 d-flex align-items-center">
                                <i class="fas fa-file-medical me-2"></i>
                                Informations complémentaires
                            </h5>
                            <p class="mb-0">{{ $service->informations_supplementaires }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Availability Section -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-calendar-alt text-primary"></i>
                            Disponibilités
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="availability-card">
                                    <div class="availability-icon bg-success-light text-success">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                    <h4>Prochaine disponibilité</h4>
                                    <p class="text-muted mb-3" id="next-availability">Demain, 9h00</p>
                                    @auth
                                        @if(auth()->user()->role === 'patient')
                                        <a href="{{ route('reservations.create', $service->id) }}" 
                                           class="btn btn-success btn-sm">
                                            <i class="fas fa-clock me-1"></i>Réserver ce créneau
                                        </a>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="availability-card">
                                    <div class="availability-icon bg-primary-light text-primary">
                                        <i class="fas fa-user-clock"></i>
                                    </div>
                                    <h4>Temps d'attente moyen</h4>
                                    <p class="text-muted mb-3">3 jours</p>
                                    <small class="text-muted d-block">Pour un rendez-vous</small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="availability-card">
                                    <div class="availability-icon bg-info-light text-info">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <h4>Horaires de consultation</h4>
                                    <p class="text-muted mb-1">Lun-Ven: 8h-19h</p>
                                    <p class="text-muted mb-0">Sam: 8h-12h</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Sidebar -->
            <div class="col-lg-4">
                <!-- Doctor Profile Card -->
                @if($service->medecin)
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-user-md text-primary"></i>
                            Médecin responsable
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <div class="doctor-avatar-lg">
                                {{ strtoupper(substr($service->medecin->name, 0, 1)) }}
                            </div>
                            <h4 class="fw-bold mb-1">Dr. {{ $service->medecin->name }}</h4>
                            <p class="text-muted mb-3">Médecin spécialiste</p>
                            <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
                                <span class="badge bg-success">Expérimenté</span>
                                <span class="badge bg-primary">Disponible</span>
                                <span class="badge bg-warning">4.8/5</span>
                            </div>
                        </div>
                        
                        <div class="doctor-qualifications">
                            <div class="qualification-item">
                                <div class="qualification-icon bg-primary-light text-primary">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Diplômé en médecine</strong>
                                    <small class="text-muted">Spécialisation confirmée</small>
                                </div>
                            </div>
                            <div class="qualification-item">
                                <div class="qualification-icon bg-warning-light text-warning">
                                    <i class="fas fa-award"></i>
                                </div>
                                <div>
                                    <strong class="d-block">15+ ans d'expérience</strong>
                                    <small class="text-muted">Expert reconnu</small>
                                </div>
                            </div>
                            <div class="qualification-item">
                                <div class="qualification-icon bg-success-light text-success">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div>
                                    <strong class="d-block">Consultations complètes</strong>
                                    <small class="text-muted">Suivi personnalisé</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Quick Actions Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-bolt text-warning"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        @auth
                            @if(auth()->user()->role === 'patient')
                            <a href="{{ route('reservations.create', $service->id) }}" 
                               class="quick-action primary mb-3">
                                <div class="action-icon">
                                    <i class="fas fa-calendar-plus"></i>
                                </div>
                                <div class="action-content">
                                    <strong>Réserver maintenant</strong>
                                    <small>Prendre rendez-vous en ligne</small>
                                </div>
                            </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" 
                               class="quick-action primary mb-3">
                                <div class="action-icon">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <div class="action-content">
                                    <strong>Se connecter</strong>
                                    <small>Pour réserver ce service</small>
                                </div>
                            </a>
                        @endauth
                        
                        <a href="{{ route('services.index') }}" 
                           class="quick-action mb-3">
                            <div class="action-icon bg-primary-light text-primary">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="action-content">
                                <strong>Autres services</strong>
                                <small class="text-muted">Découvrir nos spécialités</small>
                            </div>
                        </a>
                        
                        <button class="quick-action w-100 text-start" onclick="window.print()">
                            <div class="action-icon bg-secondary-light text-secondary">
                                <i class="fas fa-print"></i>
                            </div>
                            <div class="action-content">
                                <strong>Imprimer</strong>
                                <small class="text-muted">Informations du service</small>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Share functionality
        const shareBtn = document.getElementById('shareBtn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async function() {
                if (navigator.share) {
                    try {
                        await navigator.share({
                            title: document.title,
                            text: 'Découvrez ce service médical sur MediBook',
                            url: window.location.href
                        });
                    } catch (err) {
                        console.log('Error sharing:', err);
                    }
                } else {
                    // Fallback for browsers that don't support Web Share API
                    try {
                        await navigator.clipboard.writeText(window.location.href);
                        showToast('Lien copié dans le presse-papier !', 'success');
                    } catch (err) {
                        console.log('Error copying:', err);
                    }
                }
            });
        }

        // Check availability
        async function checkAvailability() {
            try {
                const response = await fetch(`/api/services/{{ $service->id }}/availability`);
                const data = await response.json();
                
                if (data.available) {
                    const nextAvailability = document.getElementById('next-availability');
                    if (nextAvailability && data.next_available) {
                        nextAvailability.textContent = data.next_available;
                    }
                    
                    // Update status badge if needed
                    const statusBadge = document.querySelector('.status-badge');
                    if (statusBadge && data.status === 'available') {
                        statusBadge.classList.remove('unavailable');
                        statusBadge.classList.add('available');
                        statusBadge.innerHTML = '<i class="fas fa-circle fa-xs me-1"></i>Disponible';
                    }
                }
            } catch (error) {
                console.error('Error checking availability:', error);
            }
        }

        // Check availability on load and every 30 seconds
        checkAvailability();
        setInterval(checkAvailability, 30000);

        // Print functionality
        document.querySelector('[onclick="window.print()"]')?.addEventListener('click', function(e) {
            e.preventDefault();
            window.print();
        });

        // Toast notification function
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `toast align-items-center text-white bg-${type} border-0 position-fixed`;
            toast.style.cssText = `
                bottom: 20px;
                right: 20px;
                z-index: 9999;
            `;
            
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">${message}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            
            document.body.appendChild(toast);
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            toast.addEventListener('hidden.bs.toast', function () {
                document.body.removeChild(toast);
            });
        }

        // Load more info if needed
        const loadMoreBtn = document.getElementById('loadMoreInfo');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', async function() {
                try {
                    const response = await fetch(`/api/services/{{ $service->id }}/details`);
                    const data = await response.json();
                    
                    // Process and display additional data
                    if (data.success) {
                        showToast('Informations supplémentaires chargées', 'success');
                    }
                } catch (error) {
                    console.error('Error loading more info:', error);
                    showToast('Erreur lors du chargement', 'danger');
                }
            });
        }
    });
</script>
@endpush