@extends('layouts.app')

@section('title', 'Créer un Service - Admin')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">
                                <i class="fas fa-plus-circle me-2"></i>Créer un Nouveau Service
                            </h4>
                            <p class="text-muted mb-0 small">Remplissez les informations pour créer un nouveau service médical</p>
                        </div>
                        <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" id="createServiceForm">
                        @csrf

                        <!-- Informations de base -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-info-circle me-2"></i>Informations de base
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nom du service *</label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required
                                           placeholder="Ex: Cardiologie">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">Slug (URL) *</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug') }}" 
                                           required
                                           placeholder="Ex: cardiologie">
                                    <div class="form-text small">Identifiant unique pour l'URL</div>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3" 
                                          required
                                          placeholder="Décrivez le service...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Détails du service -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-cogs me-2"></i>Détails du service
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="icon" class="form-label">Icône</label>
                                    <select class="form-select @error('icon') is-invalid @enderror" 
                                            id="icon" 
                                            name="icon">
                                        <option value="">Choisir une icône</option>
                                        <option value="fa-heartbeat" {{ old('icon') == 'fa-heartbeat' ? 'selected' : '' }}>❤️ Cardiologie</option>
                                        <option value="fa-brain" {{ old('icon') == 'fa-brain' ? 'selected' : '' }}>🧠 Neurologie</option>
                                        <option value="fa-tooth" {{ old('icon') == 'fa-tooth' ? 'selected' : '' }}>🦷 Dentisterie</option>
                                        <option value="fa-eye" {{ old('icon') == 'fa-eye' ? 'selected' : '' }}>👁️ Ophtalmologie</option>
                                        <option value="fa-lungs" {{ old('icon') == 'fa-lungs' ? 'selected' : '' }}>🫁 Pneumologie</option>
                                        <option value="fa-stomach" {{ old('icon') == 'fa-stomach' ? 'selected' : '' }}>👃 Oto-rhino</option>
                                    </select>
                                    <div class="form-text small">Icône représentative du service</div>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="color" class="form-label">Couleur</label>
                                    <input type="color" 
                                           class="form-control form-control-color @error('color') is-invalid @enderror" 
                                           id="color" 
                                           name="color" 
                                           value="{{ old('color', '#2D6FF7') }}"
                                           title="Choisissez une couleur">
                                    @error('color')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="duration" class="form-label">Durée moyenne *</label>
                                    <select class="form-select @error('duration') is-invalid @enderror" 
                                            id="duration" 
                                            name="duration" 
                                            required>
                                        <option value="15" {{ old('duration') == '15' ? 'selected' : '' }}>15 minutes</option>
                                        <option value="30" {{ old('duration') == '30' ? 'selected' : '' }}>30 minutes</option>
                                        <option value="45" {{ old('duration') == '45' ? 'selected' : '' }}>45 minutes</option>
                                        <option value="60" {{ old('duration') == '60' ? 'selected' : '' }}>1 heure</option>
                                        <option value="90" {{ old('duration') == '90' ? 'selected' : '' }}>1 heure 30</option>
                                        <option value="120" {{ old('duration') == '120' ? 'selected' : '' }}>2 heures</option>
                                    </select>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tarification -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-euro-sign me-2"></i>Tarification
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="price" class="form-label">Prix de base (€) *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">€</span>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price') }}" 
                                               required
                                               min="0" 
                                               step="0.01"
                                               placeholder="Ex: 85.00">
                                    </div>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price_range_min" class="form-label">Prix minimum (€)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">€</span>
                                        <input type="number" 
                                               class="form-control @error('price_range_min') is-invalid @enderror" 
                                               id="price_range_min" 
                                               name="price_range_min" 
                                               value="{{ old('price_range_min') }}"
                                               min="0" 
                                               step="0.01"
                                               placeholder="Ex: 65.00">
                                    </div>
                                    @error('price_range_min')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price_range_max" class="form-label">Prix maximum (€)</label>
                                    <div class="input-group">
                                        <span class="input-group-text">€</span>
                                        <input type="number" 
                                               class="form-control @error('price_range_max') is-invalid @enderror" 
                                               id="price_range_max" 
                                               name="price_range_max" 
                                               value="{{ old('price_range_max') }}"
                                               min="0" 
                                               step="0.01"
                                               placeholder="Ex: 250.00">
                                    </div>
                                    @error('price_range_max')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_urgent" 
                                       name="is_urgent" 
                                       value="1"
                                       {{ old('is_urgent') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_urgent">
                                    Service urgent (tarification spéciale)
                                </label>
                            </div>
                        </div>

                        <!-- Configuration -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-sliders-h me-2"></i>Configuration
                            </h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="max_daily_appointments" class="form-label">Réservations max par jour</label>
                                    <input type="number" 
                                           class="form-control @error('max_daily_appointments') is-invalid @enderror" 
                                           id="max_daily_appointments" 
                                           name="max_daily_appointments" 
                                           value="{{ old('max_daily_appointments', 20) }}"
                                           min="1" 
                                           max="100">
                                    <div class="form-text small">Nombre maximum de réservations par jour pour ce service</div>
                                    @error('max_daily_appointments')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="advance_booking_days" class="form-label">Réservation à l'avance (jours)</label>
                                    <input type="number" 
                                           class="form-control @error('advance_booking_days') is-invalid @enderror" 
                                           id="advance_booking_days" 
                                           name="advance_booking_days" 
                                           value="{{ old('advance_booking_days', 30) }}"
                                           min="1" 
                                           max="365">
                                    <div class="form-text small">Nombre de jours maximum pour réserver à l'avance</div>
                                    @error('advance_booking_days')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Statut</label>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="status" 
                                               id="status_active" 
                                               value="active"
                                               {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                                        <label class="form-check-label text-success" for="status_active">
                                            <i class="fas fa-check-circle me-1"></i>Actif
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="radio" 
                                               name="status" 
                                               id="status_inactive" 
                                               value="inactive"
                                               {{ old('status') == 'inactive' ? 'checked' : '' }}>
                                        <label class="form-check-label text-danger" for="status_inactive">
                                            <i class="fas fa-times-circle me-1"></i>Inactif
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Visibilité</label>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="is_featured" 
                                               name="is_featured" 
                                               value="1"
                                               {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">
                                            Service en vedette
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="requires_specialist" 
                                               name="requires_specialist" 
                                               value="1"
                                               {{ old('requires_specialist') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="requires_specialist">
                                            Nécessite un spécialiste
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contenu détaillé -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-file-alt me-2"></i>Contenu détaillé
                            </h5>
                            <div class="mb-3">
                                <label for="detailed_description" class="form-label">Description détaillée</label>
                                <textarea class="form-control @error('detailed_description') is-invalid @enderror" 
                                          id="detailed_description" 
                                          name="detailed_description" 
                                          rows="5"
                                          placeholder="Description complète du service...">{{ old('detailed_description') }}</textarea>
                                <div class="form-text small">Cette description apparaîtra sur la page dédiée du service</div>
                                @error('detailed_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="instructions" class="form-label">Instructions pour les patients</label>
                                <textarea class="form-control @error('instructions') is-invalid @enderror" 
                                          id="instructions" 
                                          name="instructions" 
                                          rows="3"
                                          placeholder="Ex: Venir à jeun, apporter les anciens examens...">{{ old('instructions') }}</textarea>
                                @error('instructions')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="mb-4">
                            <h5 class="mb-3 border-bottom pb-2">
                                <i class="fas fa-images me-2"></i>Images
                            </h5>
                            <div class="mb-3">
                                <label for="cover_image" class="form-label">Image de couverture</label>
                                <input type="file" 
                                       class="form-control @error('cover_image') is-invalid @enderror" 
                                       id="cover_image" 
                                       name="cover_image"
                                       accept="image/*">
                                <div class="form-text small">Image principale du service (recommandé: 800x400px)</div>
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="gallery_images" class="form-label">Galerie d'images</label>
                                <input type="file" 
                                       class="form-control @error('gallery_images') is-invalid @enderror" 
                                       id="gallery_images" 
                                       name="gallery_images[]"
                                       multiple
                                       accept="image/*">
                                <div class="form-text small">Vous pouvez sélectionner plusieurs images</div>
                                @error('gallery_images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Validation -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Les champs marqués d'un * sont obligatoires.
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="fas fa-redo me-1"></i>Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Créer le service
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Aperçu en temps réel -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-eye me-2"></i>Aperçu du service
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div class="mb-3" id="previewIcon">
                                        <i class="fas fa-heartbeat fa-3x text-primary"></i>
                                    </div>
                                    <h4 id="previewName" class="card-title">Nom du service</h4>
                                    <p id="previewDescription" class="card-text text-muted">Description du service</p>
                                    <div class="mt-3">
                                        <span class="badge bg-primary me-2" id="previewDuration">30 min</span>
                                        <strong id="previewPrice" class="text-primary">85€</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h6>Détails du service:</h6>
                            <p id="previewDetailedDescription">Description détaillée apparaîtra ici...</p>
                            
                            <h6 class="mt-3">Instructions:</h6>
                            <p id="previewInstructions">Instructions pour les patients...</p>
                            
                            <div class="mt-3">
                                <span class="badge bg-success me-2" id="previewStatus">Actif</span>
                                <span class="badge bg-info" id="previewFeatured">En vedette</span>
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
    .form-control-color {
        height: 38px;
        padding: 2px;
    }
    
    .preview-card {
        transition: all 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Génération automatique du slug
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        nameInput.addEventListener('input', function() {
            const name = this.value;
            const slug = name
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '') // Supprime les caractères spéciaux
                .replace(/\s+/g, '-')         // Remplace les espaces par des tirets
                .replace(/-+/g, '-')          // Supprime les tirets multiples
                .trim();
            
            slugInput.value = slug;
            updatePreview();
        });

        // Mise à jour de l'aperçu en temps réel
        const formInputs = document.querySelectorAll('#createServiceForm input, #createServiceForm select, #createServiceForm textarea');
        formInputs.forEach(input => {
            input.addEventListener('input', updatePreview);
            input.addEventListener('change', updatePreview);
        });

        function updatePreview() {
            // Nom et description
            document.getElementById('previewName').textContent = 
                document.getElementById('name').value || 'Nom du service';
            
            document.getElementById('previewDescription').textContent = 
                document.getElementById('description').value || 'Description du service';
            
            // Icône
            const iconSelect = document.getElementById('icon');
            const selectedIcon = iconSelect.options[iconSelect.selectedIndex];
            const previewIcon = document.getElementById('previewIcon');
            
            if (selectedIcon.value) {
                previewIcon.innerHTML = `<i class="fas ${selectedIcon.value} fa-3x" style="color: ${document.getElementById('color').value}"></i>`;
            }
            
            // Durée
            const duration = document.getElementById('duration').value;
            document.getElementById('previewDuration').textContent = duration ? `${duration} min` : 'Durée';
            
            // Prix
            const price = document.getElementById('price').value;
            document.getElementById('previewPrice').textContent = price ? `${price}€` : 'Prix';
            
            // Description détaillée
            document.getElementById('previewDetailedDescription').textContent = 
                document.getElementById('detailed_description').value || 
                'Description détaillée apparaîtra ici...';
            
            // Instructions
            document.getElementById('previewInstructions').textContent = 
                document.getElementById('instructions').value || 
                'Instructions pour les patients...';
            
            // Statut
            const statusActive = document.getElementById('status_active').checked;
            document.getElementById('previewStatus').textContent = statusActive ? 'Actif' : 'Inactif';
            document.getElementById('previewStatus').className = statusActive ? 
                'badge bg-success me-2' : 'badge bg-danger me-2';
            
            // En vedette
            const isFeatured = document.getElementById('is_featured').checked;
            const featuredBadge = document.getElementById('previewFeatured');
            if (isFeatured) {
                featuredBadge.textContent = 'En vedette';
                featuredBadge.style.display = 'inline-block';
            } else {
                featuredBadge.style.display = 'none';
            }
        }

        // Initialiser l'aperçu
        updatePreview();

        // Gestion de la soumission du formulaire
        const createServiceForm = document.getElementById('createServiceForm');
        createServiceForm.addEventListener('submit', function(e) {
            // Vous pouvez ajouter ici une validation JavaScript supplémentaire
            const name = document.getElementById('name').value.trim();
            if (!name) {
                e.preventDefault();
                alert('Veuillez saisir un nom pour le service');
                document.getElementById('name').focus();
                return;
            }
            
            // Afficher un indicateur de chargement
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Création en cours...';
            submitButton.disabled = true;
        });
    });
</script>
@endpush
@endsection