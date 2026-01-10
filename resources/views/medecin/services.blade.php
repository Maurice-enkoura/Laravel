@extends('layouts.app')

@section('title', 'Mes Services - MediBook')

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
        background: var(--primary-gradient);
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
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
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
        font-size: 2rem;
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

    /* Services Grid */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .services-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Service Card */
    .service-card {
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
        transition: var(--transition);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .service-card.active {
        border-left: 4px solid var(--success);
    }

    .service-card.inactive {
        border-left: 4px solid var(--warning);
    }

    .service-header {
        background: var(--light);
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--gray-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .service-title {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .service-icon {
        width: 50px;
        height: 50px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .service-icon.active {
        background: var(--success-light);
        color: var(--success);
    }

    .service-icon.inactive {
        background: var(--warning-light);
        color: var(--warning);
    }

    .service-info h5 {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--dark);
        line-height: 1.3;
    }

    .service-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-active {
        background: var(--success-light);
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-inactive {
        background: var(--warning-light);
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    /* Service Body */
    .service-body {
        padding: 1.5rem;
        flex: 1;
    }

    .service-description {
        color: var(--gray);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .service-details {
        background: var(--light);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
    }

    .detail-item:not(:last-child) {
        border-bottom: 1px solid rgba(229, 231, 235, 0.5);
    }

    .detail-label {
        color: var(--gray);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-value {
        font-weight: 600;
        color: var(--dark);
    }

    .detail-value.price {
        color: var(--success);
        font-size: 1.125rem;
    }

    .additional-info {
        background: var(--info-light);
        border-radius: var(--radius);
        padding: 1rem;
        margin-top: 1.5rem;
        border-left: 3px solid var(--info);
    }

    .additional-info h6 {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--info);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .additional-info p {
        font-size: 0.875rem;
        color: var(--gray);
        margin: 0;
        line-height: 1.5;
    }

    /* Service Footer */
    .service-footer {
        background: white;
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--gray-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .service-id {
        color: var(--gray);
        font-size: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .service-actions {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
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

    .action-btn.edit:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .action-btn.toggle:hover {
        background: var(--warning);
        color: white;
        border-color: var(--warning);
    }

    .action-btn.toggle.active:hover {
        background: var(--success);
        border-color: var(--success);
    }

    .action-btn.delete:hover {
        background: var(--danger);
        color: white;
        border-color: var(--danger);
    }

    /* Service Dropdown */
    .service-dropdown .dropdown-menu {
        min-width: 200px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-light);
        border-radius: var(--radius);
        padding: 0.5rem;
    }

    .service-dropdown .dropdown-item {
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: var(--transition);
        border-radius: 6px;
    }

    .service-dropdown .dropdown-item:hover {
        background: var(--primary-light);
        color: var(--primary);
    }

    .service-dropdown .dropdown-item.delete:hover {
        background: var(--danger-light);
        color: var(--danger);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow);
        border: 1px solid var(--gray-light);
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: var(--light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--gray);
        margin: 0 auto 1.5rem;
    }

    /* Modal Styles */
    .service-modal .modal-content {
        border-radius: var(--radius-lg);
        border: none;
        box-shadow: var(--shadow-lg);
    }

    .service-modal .modal-header {
        background: var(--primary-gradient);
        color: white;
        border-radius: var(--radius-lg) var(--radius-lg) 0 0;
        padding: 1.5rem;
    }

    .service-modal .modal-body {
        padding: 1.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--primary);
    }

    .form-control, .form-select {
        border: 1px solid var(--gray-light);
        border-radius: var(--radius);
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
        outline: none;
    }

    .input-group {
        border-radius: var(--radius);
        overflow: hidden;
    }

    .input-group .form-control {
        border-right: none;
    }

    .input-group .input-group-text {
        background: var(--light);
        border: 1px solid var(--gray-light);
        border-left: none;
        color: var(--gray);
        font-weight: 500;
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

        .page-buttons {
            flex-direction: column;
            gap: 0.75rem;
        }

        .page-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .service-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .service-actions {
            width: 100%;
            justify-content: flex-end;
        }
    }

    @media (max-width: 576px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .service-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .service-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
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
        to { transform: rotate(360deg); }
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
                        <h1 class="display-5 fw-bold mb-3">Mes Services Médicaux 🩺</h1>
                        <p class="lead mb-4 opacity-90">
                            Gérez vos spécialités et services médicaux. 
                            <br>Créez, modifiez et organisez vos consultations.
                        </p>
                        <div class="d-flex flex-wrap gap-3 page-buttons">
                            <button class="btn btn-light btn-lg px-4 d-flex align-items-center" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#addServiceModal">
                                <i class="fas fa-plus-circle me-2"></i>Nouveau service
                            </button>
                            <a href="{{ route('medecin.reservations') }}" 
                               class="btn btn-outline-light btn-lg px-4 d-flex align-items-center">
                                <i class="fas fa-calendar-alt me-2"></i>Voir le planning
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 text-lg-end d-none d-lg-block">
                        <div class="header-image">
                            <img src="https://cdn-icons-png.flaticon.com/512/2966/2966327.png" 
                                 alt="Services médicaux" 
                                 class="img-fluid" 
                                 style="max-height: 200px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="container fade-in" data-aos-delay="100">
        <div class="stats-grid">
            @php
                $activeServices = $services->where('statut', 'actif')->count();
                $inactiveServices = $services->where('statut', 'inactif')->count();
                $averagePrice = $services->avg('tarif') ?? 0;
                $totalServices = $services->count();
            @endphp

            <!-- Total Services -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-primary-light text-primary">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <span class="badge bg-primary">Total</span>
                </div>
                <div class="stat-value">{{ number_format($totalServices) }}</div>
                <div class="stat-label">Services créés</div>
            </div>

            <!-- Active Services -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-success-light text-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <span class="badge bg-success">Actifs</span>
                </div>
                <div class="stat-value">{{ number_format($activeServices) }}</div>
                <div class="stat-label">Services actifs</div>
            </div>

            <!-- Inactive Services -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-warning-light text-warning">
                        <i class="fas fa-pause-circle"></i>
                    </div>
                    <span class="badge bg-warning">Inactifs</span>
                </div>
                <div class="stat-value">{{ number_format($inactiveServices) }}</div>
                <div class="stat-label">Services inactifs</div>
            </div>

            <!-- Average Price -->
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon bg-info-light text-info">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <span class="badge bg-info">Moyenne</span>
                </div>
                <div class="stat-value">{{ number_format($averagePrice, 0) }}€</div>
                <div class="stat-label">Tarif moyen</div>
            </div>
        </div>
    </div>

    <!-- Services Grid -->
    <div class="container fade-in" data-aos-delay="200">
        @if($services->count() > 0)
            <div class="services-grid">
                @foreach($services as $service)
                    <div class="service-card {{ $service->statut == 'actif' ? 'active' : 'inactive' }}">
                        <!-- Service Header -->
                        <div class="service-header">
                            <div class="service-title">
                                <div class="service-icon {{ $service->statut }}">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="service-info">
                                    <h5>{{ $service->nom }}</h5>
                                    <span class="service-status status-{{ $service->statut }}">
                                        {{ $service->statut == 'actif' ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                            </div>
                            <div class="service-dropdown">
                                <button class="btn btn-link text-dark p-0" 
                                        type="button" 
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button class="dropdown-item" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editServiceModal{{ $service->id }}">
                                            <i class="fas fa-edit me-2 text-primary"></i>Modifier
                                        </button>
                                    </li>
                                    <li>
                                        <form action="" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-{{ $service->statut == 'actif' ? 'pause' : 'play' }} me-2 text-warning"></i>
                                                {{ $service->statut == 'actif' ? 'Désactiver' : 'Activer' }}
                                            </button>
                                        </form>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="" 
                                              method="POST" 
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="dropdown-item delete"
                                                    onclick="return confirmDelete(event)">
                                                <i class="fas fa-trash me-2 text-danger"></i>Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Service Body -->
                        <div class="service-body">
                            <p class="service-description">{{ $service->description }}</p>
                            
                            <div class="service-details">
                                @if($service->tarif)
                                    <div class="detail-item">
                                        <span class="detail-label">
                                            <i class="fas fa-money-bill-wave"></i>Tarif
                                        </span>
                                        <span class="detail-value price">{{ $service->tarif }} €</span>
                                    </div>
                                @endif
                                
                                @if($service->duree_consultation)
                                    <div class="detail-item">
                                        <span class="detail-label">
                                            <i class="fas fa-clock"></i>Durée
                                        </span>
                                        <span class="detail-value">{{ $service->duree_consultation }} minutes</span>
                                    </div>
                                @endif
                                
                                <div class="detail-item">
                                    <span class="detail-label">
                                        <i class="fas fa-calendar-alt"></i>Créé le
                                    </span>
                                    <span class="detail-value">{{ $service->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                            
                            @if($service->informations_supplementaires)
                                <div class="additional-info">
                                    <h6>
                                        <i class="fas fa-info-circle"></i>Informations supplémentaires
                                    </h6>
                                    <p>{{ Str::limit($service->informations_supplementaires, 150) }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Service Footer -->
                        <div class="service-footer">
                            <div class="service-id">
                                <i class="fas fa-id-badge"></i>
                                #{{ str_pad($service->id, 4, '0', STR_PAD_LEFT) }}
                            </div>
                            <div class="service-actions">
                                <button class="action-btn edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editServiceModal{{ $service->id }}"
                                        title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="action-btn toggle {{ $service->statut == 'actif' ? 'active' : '' }}"
                                            title="{{ $service->statut == 'actif' ? 'Désactiver' : 'Activer' }}">
                                        <i class="fas fa-{{ $service->statut == 'actif' ? 'pause' : 'play' }}"></i>
                                    </button>
                                </form>
                                
                                <form action="" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="action-btn delete"
                                            onclick="return confirmDelete(event)"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Service Modal -->
                    <div class="modal fade service-modal" id="editServiceModal{{ $service->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title d-flex align-items-center">
                                        <i class="fas fa-edit me-2"></i>
                                        Modifier le service
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <form method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-tag"></i>Nom du service *
                                                </label>
                                                <input type="text" 
                                                       class="form-control" 
                                                       name="nom" 
                                                       value="{{ $service->nom }}" 
                                                       required
                                                       placeholder="Ex: Consultation générale">
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-align-left"></i>Description *
                                                </label>
                                                <textarea class="form-control" 
                                                          name="description" 
                                                          rows="4" 
                                                          required
                                                          placeholder="Décrivez votre service en détail...">{{ $service->description }}</textarea>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-money-bill-wave"></i>Tarif (€)
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" 
                                                           class="form-control" 
                                                           name="tarif" 
                                                           value="{{ $service->tarif }}" 
                                                           step="0.01"
                                                           min="0"
                                                           placeholder="50.00">
                                                    <span class="input-group-text">€</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-clock"></i>Durée (minutes)
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" 
                                                           class="form-control" 
                                                           name="duree_consultation" 
                                                           value="{{ $service->duree_consultation }}"
                                                           min="1"
                                                           placeholder="30">
                                                    <span class="input-group-text">min</span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-info-circle"></i>Informations supplémentaires
                                                </label>
                                                <textarea class="form-control" 
                                                          name="informations_supplementaires" 
                                                          rows="3"
                                                          placeholder="Conditions particulières, préparation nécessaire...">{{ $service->informations_supplementaires }}</textarea>
                                            </div>
                                            
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-toggle-on"></i>Statut
                                                </label>
                                                <select class="form-select" name="statut">
                                                    <option value="actif" {{ $service->statut == 'actif' ? 'selected' : '' }}>Actif</option>
                                                    <option value="inactif" {{ $service->statut == 'inactif' ? 'selected' : '' }}>Inactif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            <i class="fas fa-times me-1"></i>Annuler
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Mettre à jour
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="empty-state fade-in">
                <div class="empty-icon">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="text-muted mb-3">Aucun service créé</h3>
                <p class="text-muted mb-4">Commencez par ajouter vos premiers services médicaux.</p>
                <button class="btn btn-primary btn-lg d-flex align-items-center mx-auto" 
                        data-bs-toggle="modal" 
                        data-bs-target="#addServiceModal">
                    <i class="fas fa-plus-circle me-2"></i>Ajouter mon premier service
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade service-modal" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center">
                    <i class="fas fa-plus-circle me-2"></i>
                    Nouveau service médical
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-tag"></i>Nom du service *
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   name="nom" 
                                   placeholder="Ex: Consultation générale" 
                                   required>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-align-left"></i>Description *
                            </label>
                            <textarea class="form-control" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Décrivez votre service en détail..." 
                                      required></textarea>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-money-bill-wave"></i>Tarif (€)
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control" 
                                       name="tarif" 
                                       step="0.01"
                                       min="0"
                                       placeholder="50.00">
                                <span class="input-group-text">€</span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-clock"></i>Durée de consultation (minutes)
                            </label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control" 
                                       name="duree_consultation" 
                                       min="1"
                                       placeholder="30">
                                <span class="input-group-text">min</span>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-info-circle"></i>Informations supplémentaires
                            </label>
                            <textarea class="form-control" 
                                      name="informations_supplementaires" 
                                      rows="3"
                                      placeholder="Conditions particulières, préparation nécessaire..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Annuler
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Créer le service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

@push('scripts')
