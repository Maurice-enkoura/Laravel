@extends('layouts.app')

@section('title', 'Services Médicaux - MediBook')

@push('styles')
<style>
    /* Variables CSS */
    :root {
        --radius: 0.5rem;
        --radius-lg: 0.75rem;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.05);
        --shadow: 0 4px 6px rgba(0,0,0,0.07);
        --shadow-lg: 0 10px 25px rgba(0,0,0,0.1);
        --transition: all 0.3s ease;
        --primary: #4a6cf7;
        --secondary: #6a11cb;
        --dark: #1e293b;
    }

    /* Card Styles */
    .stat-card {
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        background: white;
        transition: var(--transition);
        border: 1px solid #e5e7eb;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg) !important;
        border-color: var(--primary-light);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: var(--shadow-sm);
    }

    .bg-primary-light { background-color: rgba(74, 108, 247, 0.1); }
    .bg-success-light { background-color: rgba(34, 197, 94, 0.1); }
    .bg-info-light { background-color: rgba(14, 165, 233, 0.1); }
    .bg-warning-light { background-color: rgba(245, 158, 11, 0.1); }

    /* Service Cards */
    .service-card {
        border: 1px solid #e5e7eb;
        transition: var(--transition);
        height: 100%;
        border-radius: var(--radius-lg);
    }

    .service-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg) !important;
        transform: translateY(-4px);
    }

    .doctor-avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .feature-badge {
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 0.4rem 0.75rem;
        font-size: 0.85rem;
    }

    /* Star Rating */
    .star-rating {
        color: #fbbf24;
    }

    .star-rating .text-muted {
        color: #d1d5db !important;
    }

    /* Animations */
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    /* Hero Gradient */
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
    }

    .bg-gradient-dark {
        background: linear-gradient(135deg, var(--dark), #111827);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .stat-card {
            padding: 1rem;
        }
        
        .hero-buttons {
            flex-direction: column;
            gap: 0.5rem !important;
        }
        
        .hero-buttons .btn {
            width: 100%;
        }
        
        .filter-section .row > div {
            margin-bottom: 0.75rem;
        }
        
        .filter-section .btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('page-header')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h2 fw-bold mb-2 text-dark">Nos services médicaux</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Accueil</a></li>
                    <li class="breadcrumb-item active text-primary">Services</li>
                </ol>
            </nav>
        </div>
        @auth
            @if(auth()->user()->role === 'patient')
            <a href="{{ route('reservations.my') }}" class="btn btn-outline-primary d-flex align-items-center">
                <i class="fas fa-calendar-alt me-2"></i>
                <span class="d-none d-md-inline">Mes rendez-vous</span>
            </a>
            @endif
        @endauth
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid px-0">

    <!-- Hero Section -->
    <section class="hero-section mb-5">
        <div class="container">
            <div class="card border-0 bg-gradient-primary text-white overflow-hidden shadow-lg">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-8">
                            <h1 class="display-6 fw-bold mb-3">Soins d'excellence à portée de clic</h1>
                            <p class="lead mb-4 opacity-90">
                                Découvrez notre réseau de médecins spécialistes et réservez 
                                votre consultation en ligne en toute simplicité.
                            </p>
                            <div class="d-flex flex-wrap gap-3 hero-buttons">
                                <a href="#services-grid" class="btn btn-light btn-lg px-4 d-flex align-items-center">
                                    <i class="fas fa-search me-2"></i>Explorer les spécialités
                                </a>
                                @auth
                                    @if(auth()->user()->role === 'patient')
                                    <a href="{{ route('dashboard.patient') }}" 
                                       class="btn btn-outline-light btn-lg px-4 d-flex align-items-center">
                                        <i class="fas fa-tachometer-alt me-2"></i>Mon espace
                                    </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="col-lg-4 text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3069/3069172.png" 
                                 alt="Services médicaux" 
                                 class="img-fluid float-animation"
                                 style="max-height: 180px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section mb-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-start mb-3">
                            <div class="stat-icon bg-primary-light text-primary me-3">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                        </div>
                        <h2 class="h1 fw-bold mb-2">{{ number_format($services->count()) }}</h2>
                        <p class="text-muted mb-0">Spécialités médicales</p>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-start mb-3">
                            <div class="stat-icon bg-success-light text-success me-3">
                                <i class="fas fa-user-md"></i>
                            </div>
                        </div>
                        <h2 class="h1 fw-bold mb-2">{{ number_format($services->pluck('medecin_id')->unique()->count()) }}</h2>
                        <p class="text-muted mb-0">Experts médicaux</p>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-start mb-3">
                            <div class="stat-icon bg-info-light text-info me-3">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <h2 class="h1 fw-bold mb-2">24/7</h2>
                        <p class="text-muted mb-0">Réservation disponible</p>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="stat-card">
                        <div class="d-flex align-items-start mb-3">
                            <div class="stat-icon bg-warning-light text-warning me-3">
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                        <h2 class="h1 fw-bold mb-2">98%</h2>
                        <p class="text-muted mb-0">Satisfaction patients</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section mb-5">
        <div class="container">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Trouvez le spécialiste qu'il vous faut</h5>
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" 
                                       class="form-control border-start-0" 
                                       placeholder="Rechercher une spécialité..." 
                                       id="serviceSearch">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-select" id="specialityFilter">
                                <option value="">Toutes les spécialités</option>
                                @php
                                    $specialities = $services->pluck('nom')->unique()->sort();
                                @endphp
                                @foreach($specialities as $speciality)
                                    <option value="{{ strtolower($speciality) }}">{{ $speciality }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select class="form-select" id="priceFilter">
                                <option value="">Tous les tarifs</option>
                                <option value="0-50">Moins de 50€</option>
                                <option value="50-100">50€ - 100€</option>
                                <option value="100+">Plus de 100€</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-primary w-100 d-flex align-items-center justify-content-center" 
                                    onclick="applyFilters()">
                                <i class="fas fa-sliders-h me-2"></i>Filtrer
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="services-section mb-5" id="services-grid">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h3 class="fw-bold mb-2">Nos spécialités médicales</h3>
                            <p class="text-muted mb-0" id="services-count">
                                {{ $services->count() }} services disponibles
                            </p>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle d-flex align-items-center" 
                                    type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-sort me-1"></i>Trier par
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" data-sort="name">Nom (A-Z)</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="price-low">Prix croissant</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="price-high">Prix décroissant</a></li>
                                <li><a class="dropdown-item" href="#" data-sort="availability">Disponibilité</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" id="services-container">
                @forelse($services as $service)
                <div class="col-xl-4 col-lg-6 col-md-6 mb-4 service-item">
                    <div class="card service-card shadow-sm">
                        <div class="card-header bg-white border-0 pb-0 pt-3 px-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <span class="badge bg-{{ $service->statut == 'actif' ? 'success' : 'warning' }} px-3 py-2">
                                    <i class="fas fa-circle fa-xs me-1"></i>
                                    {{ $service->statut == 'actif' ? 'Disponible' : 'Indisponible' }}
                                </span>
                                @if($service->tarif)
                                <span class="badge bg-primary px-3 py-2">
                                    {{ $service->tarif }}€
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="card-body px-3 pb-3">
                            <h5 class="card-title fw-bold mb-3">{{ $service->nom }}</h5>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="doctor-avatar-sm me-3">
                                    {{ strtoupper(substr($service->medecin->name ?? 'D', 0, 1)) }}
                                </div>
                                <div>
                                    <strong class="d-block">Dr. {{ $service->medecin->name ?? 'Non assigné' }}</strong>
                                    <small class="text-muted">Médecin spécialiste</small>
                                </div>
                            </div>
                            
                            <p class="card-text text-muted mb-4">
                                {{ Str::limit($service->description, 100) }}
                            </p>
                            
                            <div class="row g-2 mb-3">
                                @if($service->duree_consultation)
                                <div class="col-6">
                                    <div class="feature-badge text-center">
                                        <i class="fas fa-clock text-primary me-1"></i>
                                        <small>{{ $service->duree_consultation }} min</small>
                                    </div>
                                </div>
                                @endif
                                <div class="col-6">
                                    <div class="feature-badge text-center">
                                        <i class="fas fa-calendar-check text-success me-1"></i>
                                        <small>Réservation rapide</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Note du médecin -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="star-rating small me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= 4.5 ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <small class="text-muted">4.5/5 (124 avis)</small>
                            </div>
                        </div>
                        
                        <div class="card-footer bg-white border-0 pt-0 px-3 pb-3">
                            <div class="d-flex justify-content-between gap-2">
                                <a href="{{ route('services.show', $service->id) }}" 
                                   class="btn btn-outline-primary btn-sm flex-grow-1 d-flex align-items-center justify-content-center">
                                    <i class="fas fa-eye me-1"></i>Détails
                                </a>
                                @auth
                                    @if(auth()->user()->role === 'patient')
                                    <a href="{{ route('reservations.create', $service->id) }}" 
                                       class="btn btn-primary btn-sm flex-grow-1 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-calendar-plus me-1"></i>Réserver
                                    </a>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" 
                                       class="btn btn-primary btn-sm flex-grow-1 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-sign-in-alt me-1"></i>Connecter
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-stethoscope fa-4x text-muted opacity-50"></i>
                            </div>
                            <h4 class="text-muted mb-3">Aucun service disponible</h4>
                            <p class="text-muted mb-4">Les services seront bientôt disponibles.</p>
                            @auth
                            <a href="{{ route('dashboard.patient') }}" 
                               class="btn btn-primary">
                                <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($services->hasPages())
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            {{ $services->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="card border-0 bg-gradient-dark text-white">
                <div class="card-body p-4 p-lg-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8 mb-4 mb-lg-0">
                            <h3 class="fw-bold mb-3">Prêt à prendre soin de votre santé ?</h3>
                            <p class="opacity-90 mb-0">
                                Rejoignez des milliers de patients qui font confiance à nos médecins.
                            </p>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            @auth
                                @if(auth()->user()->role === 'patient')
                                <a href="{{ route('reservations.my') }}" 
                                   class="btn btn-light btn-lg px-4 d-inline-flex align-items-center">
                                    <i class="fas fa-calendar-alt me-2"></i>Mes rendez-vous
                                </a>
                                @endif
                            @else
                                <a href="{{ route('register') }}" 
                                   class="btn btn-light btn-lg px-4 d-inline-flex align-items-center">
                                    <i class="fas fa-user-plus me-2"></i>S'inscrire gratuitement
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter elements
        const searchInput = document.getElementById('serviceSearch');
        const specialityFilter = document.getElementById('specialityFilter');
        const priceFilter = document.getElementById('priceFilter');
        const serviceItems = document.querySelectorAll('.service-item');
        const servicesCount = document.getElementById('services-count');

        // Apply filters function
        window.applyFilters = function() {
            const searchTerm = searchInput.value.toLowerCase();
            const speciality = specialityFilter.value;
            const price = priceFilter.value;

            let visibleCount = 0;

            serviceItems.forEach(item => {
                const serviceName = item.querySelector('.card-title').textContent.toLowerCase();
                const servicePriceText = item.querySelector('.badge.bg-primary')?.textContent;
                const servicePrice = servicePriceText ? parseFloat(servicePriceText.replace('€', '')) : 0;
                const serviceSpeciality = serviceName;

                let show = true;

                // Search filter
                if (searchTerm && !serviceName.includes(searchTerm)) {
                    show = false;
                }

                // Speciality filter
                if (speciality && !serviceSpeciality.includes(speciality)) {
                    show = false;
                }

                // Price filter
                if (price) {
                    if (price === '0-50' && servicePrice > 50) show = false;
                    if (price === '50-100' && (servicePrice < 50 || servicePrice > 100)) show = false;
                    if (price === '100+' && servicePrice < 100) show = false;
                }

                // Show/hide with animation
                if (show) {
                    item.style.display = 'block';
                    visibleCount++;
                    setTimeout(() => {
                        item.style.opacity = '1';
                        item.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    item.style.opacity = '0';
                    item.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        item.style.display = 'none';
                    }, 300);
                }
            });

            // Update count
            if (servicesCount) {
                servicesCount.textContent = `${visibleCount} services disponibles`;
            }
        };

        // Event listeners for filters
        searchInput.addEventListener('input', applyFilters);
        specialityFilter.addEventListener('change', applyFilters);
        priceFilter.addEventListener('change', applyFilters);

        // Sorting functionality
        document.querySelectorAll('[data-sort]').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const sortBy = this.getAttribute('data-sort');
                sortServices(sortBy);
            });
        });

        // Sort services function
        function sortServices(sortBy) {
            const container = document.getElementById('services-container');
            const items = Array.from(container.querySelectorAll('.service-item'));

            items.sort((a, b) => {
                const nameA = a.querySelector('.card-title').textContent.toLowerCase();
                const nameB = b.querySelector('.card-title').textContent.toLowerCase();
                const priceA = parseFloat(a.querySelector('.badge.bg-primary')?.textContent.replace('€', '')) || 0;
                const priceB = parseFloat(b.querySelector('.badge.bg-primary')?.textContent.replace('€', '')) || 0;
                const statusA = a.querySelector('.badge').classList.contains('bg-success');
                const statusB = b.querySelector('.badge').classList.contains('bg-success');

                switch (sortBy) {
                    case 'name':
                        return nameA.localeCompare(nameB);
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    case 'availability':
                        return (statusB ? 1 : 0) - (statusA ? 1 : 0);
                    default:
                        return 0;
                }
            });

            // Reorder items with animation
            items.forEach((item, index) => {
                setTimeout(() => {
                    container.appendChild(item);
                }, index * 50);
            });
        }

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
</script>
@endpush