@extends('layouts.app')

@section('title', 'MediBook - Plateforme de Réservation Médicale')

@section('styles')
<style>
    /* Variables CSS */
    :root {
        --primary: #2D6FF7;
        --primary-light: #E8F1FF;
        --secondary: #4F83FF;
        --dark: #1F2937;
        --gray: #6B7280;
        --gray-light: #E5E7EB;
        --radius: 12px;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
        color: white;
        padding: 6rem 0 4rem;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .hero-content p {
        font-size: 1.25rem;
        margin-bottom: 2rem;
        opacity: 0.9;
        max-width: 90%;
    }

    .hero-image {
        position: relative;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    /* Statistics */
    .stats-section {
        padding: 4rem 0;
        background: white;
        position: relative;
        z-index: 10;
    }

    .stat-item {
        text-align: center;
        padding: 1.5rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .stat-label {
        color: var(--gray);
        font-weight: 500;
        font-size: 0.95rem;
    }

    /* Features Section */
    .features-section {
        padding: 5rem 0;
        background-color: #F9FAFB;
    }

    .section-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    .section-title p {
        color: var(--gray);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .feature-card {
        background: white;
        border-radius: var(--radius);
        padding: 2.5rem 2rem;
        height: 100%;
        text-align: center;
        box-shadow: var(--shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--primary);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon {
        background: var(--primary);
        color: white;
        transform: rotateY(180deg);
    }

    .feature-card h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: var(--dark);
        font-weight: 600;
    }

    .feature-card p {
        color: var(--gray);
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* How It Works */
    .how-it-works {
        padding: 5rem 0;
        background: white;
    }

    .step-card {
        position: relative;
        padding: 2rem;
        text-align: center;
    }

    .step-number {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.5rem;
        margin: 0 auto 1.5rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(45, 111, 247, 0.3);
    }

    .step-line {
        position: absolute;
        top: 30px;
        left: 60%;
        right: -40%;
        height: 2px;
        background: linear-gradient(90deg, var(--primary-light), var(--primary));
        z-index: 1;
        opacity: 0.5;
    }

    .step-card:last-child .step-line {
        display: none;
    }

    .step-card h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: var(--dark);
        font-weight: 600;
    }

    .step-card p {
        color: var(--gray);
        line-height: 1.6;
    }

    /* Services Preview */
    .services-preview {
        padding: 5rem 0;
        background: linear-gradient(135deg, #F9FAFB 0%, #E8F1FF 100%);
    }

    .service-card {
        background: white;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        border: 1px solid transparent;
    }

    .service-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .service-image {
        height: 200px;
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .service-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, transparent, rgba(0,0,0,0.1));
    }

    .service-card .card-body {
        padding: 1.5rem;
    }

    .service-card .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--dark);
    }

    .service-card .card-text {
        color: var(--gray);
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .service-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--primary);
        color: white;
        padding: 0.25rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .service-badge.bg-warning {
        background: #F59E0B;
    }

    /* CTA Section */
    .cta-section {
        background: linear-gradient(135deg, var(--dark), #374151);
        color: white;
        padding: 6rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .cta-section h2 {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        font-weight: 700;
        position: relative;
        z-index: 1;
    }

    .cta-section p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
        z-index: 1;
    }

    /* Button Styles */
    .btn-light {
        background: white;
        color: var(--primary);
        border: none;
        font-weight: 600;
    }

    .btn-light:hover {
        background: #f8f9fa;
        color: var(--primary);
    }

    .btn-outline-light:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 600;
        padding: 0.75rem 2rem;
    }

    .btn-primary:hover {
        background: #2563EB;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(45, 111, 247, 0.3);
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .hero-section {
            padding: 4rem 0 3rem;
        }

        .hero-content h1 {
            font-size: 2.5rem;
        }

        .hero-content p {
            font-size: 1.125rem;
            max-width: 100%;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .step-line {
            display: none;
        }

        .step-card {
            margin-bottom: 2rem;
        }

        .feature-card {
            margin-bottom: 1.5rem;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 1rem !important;
        }

        .hero-buttons .btn {
            width: 100%;
        }

        .cta-buttons {
            flex-direction: column;
            gap: 1rem;
        }

        .cta-buttons .btn {
            width: 100%;
        }

        .stat-number {
            font-size: 2rem;
        }

        .service-card {
            margin-bottom: 1.5rem;
        }
    }

    @media (max-width: 992px) {
        .hero-image img {
            max-height: 400px;
            margin-top: 2rem;
        }
    }

    /* Text Colors */
    .text-gray {
        color: var(--gray) !important;
    }

    .text-primary {
        color: var(--primary) !important;
    }

    /* Animation for AOS */
    [data-aos] {
        opacity: 0;
        transition-property: transform, opacity;
    }

    [data-aos].aos-animate {
        opacity: 1;
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container position-relative" style="z-index: 1;">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right" data-aos-duration="800">
                <div class="hero-content">
                    <h1>Prenez rendez-vous médical en quelques clics</h1>
                    <p>Simplifiez votre parcours de santé avec MediBook. Réservez vos consultations en ligne, gérez vos rendez-vous et accédez à vos résultats facilement.</p>
                    <div class="d-flex gap-3 flex-wrap hero-buttons">
                        @auth
                            @if(auth()->user()->role === 'patient')
                                <a href="{{ route('services.index') }}" class="btn btn-light btn-lg">
                                    <i class="fas fa-calendar-plus me-2"></i>Prendre RDV
                                </a>
                                <a href="{{ route('dashboard.patient') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                                </a>
                            @elseif(auth()->user()->role === 'medecin')
                                <a href="{{ route('dashboard.medecin') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                                </a>
                            @elseif(auth()->user()->role === 'admin')
                                <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-light btn-lg">
                                    <i class="fas fa-tachometer-alt me-2"></i>Tableau de bord
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-light btn-lg">
                                <i class="fas fa-user-plus me-2"></i>S'inscrire gratuitement
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="hero-image text-center">
                    <img src="https://cdn.pixabay.com/photo/2017/10/04/09/56/laboratory-2815641_1280.jpg"
                        alt="MediBook Interface"
                        class="img-fluid rounded-3 shadow-lg"
                        style="max-height: 500px; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Statistics -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-item">
                    <div class="stat-number" data-count="1500">0</div>
                    <div class="stat-label">Patients satisfaits</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-item">
                    <div class="stat-number" data-count="200">0</div>
                    <div class="stat-label">Professionnels</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-item">
                    <div class="stat-number" data-count="50">0</div>
                    <div class="stat-label">Spécialités</div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-item">
                    <div class="stat-number" data-count="24">0</div>
                    <div class="stat-label">Heures d'ouverture</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Pourquoi choisir MediBook ?</h2>
            <p>Une expérience de prise de rendez-vous médical simplifiée et efficace</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Réservation rapide</h3>
                    <p class="text-gray">Prenez rendez-vous en quelques clics, 24h/24 et 7j/7</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Rappels automatiques</h3>
                    <p class="text-gray">Notifications par email et SMS pour ne manquer aucun rendez-vous</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <h3>Dossier médical</h3>
                    <p class="text-gray">Accédez à votre historique médical et résultats d'analyses en ligne</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Sécurité des données</h3>
                    <p class="text-gray">Vos informations médicales sont protégées et chiffrées</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section class="how-it-works">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Comment ça marche ?</h2>
            <p>Trois étapes simples pour prendre rendez-vous</p>
        </div>

        <div class="row">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="step-card">
                    <div class="step-line d-none d-lg-block"></div>
                    <div class="step-number">1</div>
                    <h3>Choisissez un service</h3>
                    <p>Parcourez nos spécialités médicales et trouvez le professionnel qui correspond à vos besoins</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="step-card">
                    <div class="step-line d-none d-lg-block"></div>
                    <div class="step-number">2</div>
                    <h3>Sélectionnez un créneau</h3>
                    <p>Consultez les disponibilités en temps réel et réservez le créneau qui vous convient</p>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3>Confirmez votre RDV</h3>
                    <p>Recevez une confirmation immédiate et des rappels avant votre consultation</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="services-preview">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Nos principales spécialités</h2>
            <p>Accédez à un large choix de services médicaux</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="service-card">
                    <div class="service-image"
                        style="background-image: url('https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                        <span class="service-badge">Disponible</span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Médecine Générale</h4>
                        <p class="card-text text-gray">Consultations générales, bilans de santé et suivi médical</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">À partir de 25€</span>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-alt me-1"></i>Réserver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="service-card">
                    <div class="service-image"
                        style="background-image: url('https://images.unsplash.com/photo-1582750433449-648ed127bb54?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                        <span class="service-badge">Disponible</span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Dentisterie</h4>
                        <p class="card-text text-gray">Soins dentaires, détartrage et consultations spécialisées</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">À partir de 30€</span>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-calendar-alt me-1"></i>Réserver
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="service-card">
                    <div class="service-image"
                        style="background-image: url('https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                        <span class="service-badge bg-warning">Bientôt</span>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Dermatologie</h4>
                        <p class="card-text text-gray">Diagnostic et traitement des maladies de la peau</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-primary fw-bold">À partir de 40€</span>
                            <a href="{{ route('services.index') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-info-circle me-1"></i>Détails
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-search me-2"></i>Voir tous les services
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section" data-aos="fade-up">
    <div class="container position-relative" style="z-index: 1;">
        <h2>Prêt à simplifier votre santé ?</h2>
        <p>Rejoignez des milliers de patients qui font déjà confiance à MediBook pour leurs rendez-vous médicaux</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap cta-buttons">
            @auth
                @if(auth()->user()->role === 'patient')
                    <a href="{{ route('services.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-calendar-plus me-2"></i>Prendre un RDV maintenant
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-user-plus me-2"></i>Créer un compte gratuit
                </a>
                <a href="{{ route('services.index') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-stethoscope me-2"></i>Découvrir les services
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate statistics counter
        const animateCounter = () => {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const increment = target / 50;
                let current = 0;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.floor(current);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                // Start counter when element is in viewport
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            updateCounter();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5,
                    rootMargin: '0px 0px -50px 0px'
                });
                
                observer.observe(counter);
            });
        };
        
        // Smooth scroll for anchor links
        const initSmoothScroll = () => {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const target = document.querySelector(targetId);
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        };
        
        // Initialize AOS (Animate On Scroll) if library is loaded
        const initAOS = () => {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    once: true,
                    offset: 100
                });
            }
        };
        
        // Initialize everything
        animateCounter();
        initSmoothScroll();
        initAOS();
        
        // Add hover effect for cards
        const cards = document.querySelectorAll('.feature-card, .service-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
            });
        });
    });
</script>

@if(config('app.env') === 'production')
<!-- AOS Library for animations -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
@endif
@endsection