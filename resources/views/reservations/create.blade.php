@extends('layouts.app')

@section('title', 'Nouvelle Réservation - MediBook')

@push('styles')
<style>
    :root {
        --primary: #2D6FF7;
        --primary-light: rgba(45, 111, 247, 0.1);
        --secondary: #4F83FF;
        --success: #10B981;
        --warning: #F59E0B;
        --warning-light: rgba(245, 158, 11, 0.1);
        --info: #3B82F6;
        --info-light: rgba(59, 130, 246, 0.1);
        --danger: #EF4444;
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
        background: linear-gradient(135deg, var(--primary), var(--secondary));
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

    /* Service Info Card */
    .service-info-card {
        border: none;
        border-radius: var(--radius);
        background: linear-gradient(135deg, var(--primary-light), white);
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
        overflow: hidden;
        border-left: 4px solid var(--primary);
    }

    .service-info-header {
        background: var(--primary);
        color: white;
        padding: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .service-info-body {
        padding: 1.5rem;
    }

    .service-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .service-detail-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: white;
        border-radius: var(--radius);
        border: 1px solid var(--gray-light);
        transition: var(--transition);
    }

    .service-detail-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow);
    }

    .service-detail-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-light);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        color: var(--primary);
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .service-detail-content h6 {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--gray);
        margin-bottom: 0.25rem;
    }

    .service-detail-content p {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0;
        font-size: 1rem;
    }

    .price-badge {
        background: var(--success);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.875rem;
    }

    /* Form Card */
    .form-card {
        border: none;
        border-radius: var(--radius);
        box-shadow: var(--shadow-lg);
        background: white;
        margin-bottom: 2rem;
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: white;
        padding: 1.5rem;
        border-radius: var(--radius) var(--radius) 0 0;
    }

    .form-body {
        padding: 2rem;
    }

    /* Form Styles */
    .form-label {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
    }

    .form-label i {
        margin-right: 0.5rem;
        color: var(--primary);
    }

    .form-control, .form-select {
        border: 1px solid var(--gray-light);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: var(--transition);
        background: white;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-light);
        outline: none;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger);
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25);
    }

    .invalid-feedback {
        font-size: 0.875rem;
        margin-top: 0.25rem;
        color: var(--danger);
    }

    /* Time Slots */
    .time-slots {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .time-slot {
        border: 2px solid var(--gray-light);
        border-radius: 8px;
        padding: 0.75rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: white;
        font-weight: 500;
    }

    .time-slot:hover {
        border-color: var(--primary);
        background: var(--primary-light);
    }

    .time-slot.selected {
        border-color: var(--primary);
        background: var(--primary);
        color: white;
    }

    .time-slot.unavailable {
        background: var(--gray-light);
        color: var(--gray);
        cursor: not-allowed;
        opacity: 0.6;
        text-decoration: line-through;
    }

    /* Warning Alert */
    .warning-alert {
        background: var(--warning-light);
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-left: 4px solid var(--warning);
        border-radius: var(--radius);
        padding: 1.25rem;
        margin: 2rem 0;
    }

    .warning-alert i {
        color: var(--warning);
        font-size: 1.25rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--gray-light);
    }

    /* Calendar Styles */
    .calendar-container {
        position: relative;
    }

    .calendar-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray);
        pointer-events: none;
    }

    /* Availability Status */
    .availability-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
    }

    .availability-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
    }

    .available {
        background: var(--success);
    }

    .limited {
        background: var(--warning);
    }

    .unavailable {
        background: var(--danger);
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

    /* Responsive Design */
    @media (max-width: 768px) {
        .page-header {
            padding: 1.5rem 0;
            margin-bottom: 1.5rem;
        }

        .header-content h1 {
            font-size: 1.5rem;
        }

        .form-body {
            padding: 1.5rem;
        }

        .service-details {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .service-detail-item {
            padding: 0.75rem;
        }

        .time-slots {
            grid-template-columns: repeat(3, 1fr);
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .form-actions .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .time-slots {
            grid-template-columns: repeat(2, 1fr);
        }

        .service-info-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }

    /* Animations */
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

    /* Button Styles */
    .btn-primary {
        background: var(--primary);
        border: none;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: #2563EB;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-outline-secondary {
        border: 1px solid var(--gray);
        color: var(--gray);
        font-weight: 500;
        padding: 0.75rem 2rem;
        border-radius: 8px;
    }

    .btn-outline-secondary:hover {
        background: var(--gray-light);
        color: var(--dark);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-0">
    <!-- Page Header -->
    <div class="container">
        <div class="page-header">
            <div class="header-content">
                <div class="d-flex align-items-center gap-3">
                    <div class="header-icon">
                        <i class="fas fa-calendar-plus"></i>
                    </div>
                    <div>
                        <h1 class="h3 fw-bold mb-1">Nouvelle Réservation</h1>
                        <p class="opacity-90 mb-0">Prenez rendez-vous avec votre médecin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Service Information -->
        <div class="service-info-card fade-in">
            <div class="service-info-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="service-icon">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <div>
                        <h4 class="mb-1">{{ $service->nom }}</h4>
                        <p class="mb-0 opacity-90">Service médical sélectionné</p>
                    </div>
                </div>
                @if($service->tarif)
                <div class="price-badge">
                    {{ $service->tarif }} €
                </div>
                @endif
            </div>
            <div class="service-info-body">
                <div class="service-details">
                    <div class="service-detail-item">
                        <div class="service-detail-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="service-detail-content">
                            <h6>Médecin</h6>
                            <p>Dr. {{ $service->medecin->name ?? 'Non assigné' }}</p>
                        </div>
                    </div>
                    
                    @if($service->duree_consultation)
                    <div class="service-detail-item">
                        <div class="service-detail-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="service-detail-content">
                            <h6>Durée</h6>
                            <p>{{ $service->duree_consultation }} minutes</p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="service-detail-item">
                        <div class="service-detail-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="service-detail-content">
                            <h6>Type</h6>
                            <p>Consultation en cabinet</p>
                        </div>
                    </div>
                </div>
                
                @if($service->description)
                <div class="mt-4 pt-3 border-top">
                    <h6 class="text-muted mb-2">Description du service</h6>
                    <p class="mb-0">{{ $service->description }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Reservation Form -->
        <div class="form-card fade-in">
            <div class="form-header">
                <h4 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Détails du rendez-vous
                </h4>
            </div>
            
            <div class="form-body">
                <form method="POST" action="{{ route('reservations.store') }}" id="reservationForm">
                    @csrf
                    
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    
                    <!-- Date Selection -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="date_reservation" class="form-label">
                                <i class="fas fa-calendar-day"></i>Date du rendez-vous *
                            </label>
                            <div class="calendar-container">
                                <input type="date" 
                                       class="form-control @error('date_reservation') is-invalid @enderror" 
                                       id="date_reservation" 
                                       name="date_reservation" 
                                       value="{{ old('date_reservation') }}"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       required
                                       onchange="checkAvailability()">
                                <i class="fas fa-calendar calendar-icon"></i>
                                @error('date_reservation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="availability-status" id="dateStatus">
                                <span class="availability-dot available"></span>
                                <span>Sélectionnez une date</span>
                            </div>
                        </div>
                        
                        <!-- Time Selection -->
                        <div class="col-md-6">
                            <label class="form-label">
                                <i class="fas fa-clock"></i>Heure du rendez-vous *
                            </label>
                            <div class="time-slots" id="timeSlotsContainer">
                                <!-- Time slots will be populated by JavaScript -->
                                @foreach(['09:00', '10:00', '11:00', '14:00', '15:00', '16:00', '17:00'] as $heure)
                                    <div class="time-slot" 
                                         data-time="{{ $heure }}"
                                         onclick="selectTimeSlot(this)">
                                        {{ $heure }}
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" 
                                   id="heure_reservation" 
                                   name="heure_reservation" 
                                   value="{{ old('heure_reservation') }}"
                                   required>
                            @error('heure_reservation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Additional Information -->
                    <div class="mb-4">
                        <label for="commentaire" class="form-label">
                            <i class="fas fa-comment-medical"></i>Informations complémentaires
                        </label>
                        <textarea class="form-control @error('commentaire') is-invalid @enderror" 
                                  id="commentaire" 
                                  name="commentaire" 
                                  rows="4" 
                                  placeholder="Décrivez vos symptômes, précisez vos besoins particuliers ou toute autre information utile pour votre consultation...">{{ old('commentaire') }}</textarea>
                        <div class="form-text">
                            Ces informations aideront le médecin à mieux préparer votre consultation.
                        </div>
                        @error('commentaire')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Terms and Conditions -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror" 
                                   type="checkbox" 
                                   id="terms" 
                                   name="terms" 
                                   value="1" 
                                   {{ old('terms') ? 'checked' : '' }}
                                   required>
                            <label class="form-check-label" for="terms">
                                J'accepte les 
                                <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#termsModal">
                                    conditions générales de réservation
                                </a>
                                *
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Important Notice -->
                    <div class="warning-alert">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-exclamation-triangle me-3 mt-1"></i>
                            <div>
                                <h6 class="fw-bold mb-2">Informations importantes</h6>
                                <p class="mb-0">
                                    Votre réservation sera en statut "en attente" jusqu'à confirmation par le médecin. 
                                    Vous recevrez une notification par email dès que votre rendez-vous sera confirmé.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ route('services.show', $service->id) }}" 
                           class="btn btn-outline-secondary d-flex align-items-center">
                            <i class="fas fa-arrow-left me-2"></i>
                            <span class="d-none d-md-inline">Retour au service</span>
                        </a>
                        
                        <button type="submit" 
                                class="btn btn-primary d-flex align-items-center"
                                id="submitBtn">
                            <i class="fas fa-check-circle me-2"></i>
                            <span>Confirmer la réservation</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-file-contract me-2"></i>
                    Conditions générales de réservation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <h6 class="fw-bold mb-3">1. Confirmation des rendez-vous</h6>
                <p class="mb-3">
                    Toutes les réservations sont soumises à confirmation par le médecin. 
                    Vous recevrez une notification dès que votre rendez-vous sera confirmé.
                </p>
                
                <h6 class="fw-bold mb-3">2. Annulation et modification</h6>
                <p class="mb-3">
                    Les rendez-vous peuvent être annulés jusqu'à 24 heures avant l'heure prévue. 
                </p>
                
                <h6 class="fw-bold mb-3">3. Paiement</h6>
                <p class="mb-3">
                    Le paiement s'effectue directement au cabinet médical lors de votre consultation.
                </p>
                
                <h6 class="fw-bold mb-3">4. Retard</h6>
                <p class="mb-0">
                    En cas de retard supérieur à 15 minutes, votre rendez-vous pourra être annulé et reporté.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                    J'ai compris
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize date picker
        const dateInput = document.getElementById('date_reservation');
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        
        // Set minimum date to tomorrow
        const minDate = tomorrow.toISOString().split('T')[0];
        dateInput.min = minDate;
        
        // If no date is selected, set to tomorrow
        if (!dateInput.value) {
            dateInput.value = minDate;
        }
        
        // Time slot selection
        const timeSlots = document.querySelectorAll('.time-slot');
        const heureInput = document.getElementById('heure_reservation');
        
        // Select initial time slot if exists
        if (heureInput.value) {
            timeSlots.forEach(slot => {
                if (slot.dataset.time === heureInput.value) {
                    selectTimeSlot(slot);
                }
            });
        }
        
        // Check availability on page load
        checkAvailability();
    });
    
    function selectTimeSlot(element) {
        // Skip if unavailable
        if (element.classList.contains('unavailable')) return;
        
        // Remove selected class from all slots
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('selected');
        });
        
        // Add selected class to clicked slot
        element.classList.add('selected');
        
        // Update hidden input
        document.getElementById('heure_reservation').value = element.dataset.time;
        
        // Remove error state
        const heureInput = document.getElementById('heure_reservation');
        heureInput.classList.remove('is-invalid');
    }
    
    async function checkAvailability() {
        const dateInput = document.getElementById('date_reservation');
        const dateStatus = document.getElementById('dateStatus');
        const submitBtn = document.getElementById('submitBtn');
        const loadingOverlay = document.getElementById('loadingOverlay');
        
        if (!dateInput.value) return;
        
        // Show loading
        loadingOverlay.classList.add('active');
        
        try {
            // Simulate API call for availability
            await new Promise(resolve => setTimeout(resolve, 500));
            
            // In a real application, you would make an API call here
            // const response = await fetch(`/api/availability?service_id={{ $service->id }}&date=${dateInput.value}`);
            // const data = await response.json();
            
            // For demo purposes, we'll simulate availability
            const selectedDate = new Date(dateInput.value);
            const dayOfWeek = selectedDate.getDay();
            const today = new Date();
            const isToday = selectedDate.toDateString() === today.toDateString();
            const isPast = selectedDate < today;
            
            if (isPast || isToday) {
                updateDateStatus('Cette date n\'est pas disponible', 'unavailable');
                disableTimeSlots();
                submitBtn.disabled = true;
                return;
            }
            
            // Check if it's a weekend
            if (dayOfWeek === 0 || dayOfWeek === 6) {
                updateDateStatus('Le cabinet est fermé le weekend', 'unavailable');
                disableTimeSlots();
                submitBtn.disabled = true;
                return;
            }
            
            // Update status and enable slots
            updateDateStatus('Date disponible', 'available');
            updateTimeSlotsAvailability();
            submitBtn.disabled = false;
            
        } catch (error) {
            console.error('Error checking availability:', error);
            updateDateStatus('Erreur de vérification', 'unavailable');
            disableTimeSlots();
            submitBtn.disabled = true;
        } finally {
            loadingOverlay.classList.remove('active');
        }
    }
    
    function updateDateStatus(message, status) {
        const dateStatus = document.getElementById('dateStatus');
        const dot = dateStatus.querySelector('.availability-dot');
        const text = dateStatus.querySelector('span:last-child');
        
        dot.className = 'availability-dot ' + status;
        text.textContent = message;
    }
    
    function disableTimeSlots() {
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.add('unavailable');
            slot.onclick = null;
        });
        
        // Clear selected time
        document.getElementById('heure_reservation').value = '';
        document.querySelectorAll('.time-slot.selected').forEach(slot => {
            slot.classList.remove('selected');
        });
    }
    
    function updateTimeSlotsAvailability() {
        // In a real application, you would get actual availability from the API
        // For demo, we'll simulate some slots as unavailable
        
        document.querySelectorAll('.time-slot').forEach(slot => {
            slot.classList.remove('unavailable');
            
            // Simulate random unavailable slots (for demo)
            const isUnavailable = Math.random() < 0.3; // 30% chance of being unavailable
            if (isUnavailable) {
                slot.classList.add('unavailable');
            } else {
                slot.onclick = function() { selectTimeSlot(this); };
            }
        });
    }
    
    // Form validation
    document.getElementById('reservationForm').addEventListener('submit', function(event) {
        const heureInput = document.getElementById('heure_reservation');
        const termsCheckbox = document.getElementById('terms');
        
        // Validate time slot
        if (!heureInput.value) {
            event.preventDefault();
            heureInput.classList.add('is-invalid');
            
            Swal.fire({
                title: 'Heure manquante',
                text: 'Veuillez sélectionner une heure pour votre rendez-vous.',
                icon: 'warning',
                confirmButtonColor: '#2D6FF7'
            });
            return false;
        }
        
        // Validate terms
        if (!termsCheckbox.checked) {
            event.preventDefault();
            termsCheckbox.classList.add('is-invalid');
            
            Swal.fire({
                title: 'Conditions non acceptées',
                text: 'Vous devez accepter les conditions générales pour continuer.',
                icon: 'warning',
                confirmButtonColor: '#2D6FF7'
            });
            return false;
        }
        
        // Show confirmation dialog
        event.preventDefault();
        
        Swal.fire({
            title: 'Confirmer la réservation',
            html: `
                <div class="text-start">
                    <p><strong>Service:</strong> {{ $service->nom }}</p>
                    <p><strong>Date:</strong> ${document.getElementById('date_reservation').value}</p>
                    <p><strong>Heure:</strong> ${heureInput.value}</p>
                    <p><strong>Médecin:</strong> Dr. {{ $service->medecin->name ?? 'Non assigné' }}</p>
                </div>
            `,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2D6FF7',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Confirmer',
            cancelButtonText: 'Annuler',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Show loading
                const loadingOverlay = document.getElementById('loadingOverlay');
                loadingOverlay.classList.add('active');
                
                // Submit form
                event.target.submit();
            }
        });
    });
    
    // Show available time slots on date selection
    document.getElementById('date_reservation').addEventListener('change', function() {
        // Clear previous selection
        document.getElementById('heure_reservation').value = '';
        document.querySelectorAll('.time-slot.selected').forEach(slot => {
            slot.classList.remove('selected');
        });
    });
</script>

<!-- SweetAlert2 for better confirmations -->
@if(config('app.env') === 'production')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endif
@endpush