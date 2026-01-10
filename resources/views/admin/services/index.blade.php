@extends('layouts.app')

@section('title', 'Gestion des Services - Admin')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-0">
                <i class="fas fa-stethoscope me-2"></i>Gestion des Services
            </h1>
            <p class="text-muted mb-0">Gérez les services médicaux proposés par la clinique</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('services.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i>Nouveau Service
            </a>
        </div>
    </div>

    <!-- Cartes des Services -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card h-100 border-primary">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-heartbeat fa-3x text-primary"></i>
                    </div>
                    <h4 class="card-title">Cardiologie</h4>
                    <p class="card-text text-muted">Consultations cardiaques, ECG, échographies</p>
                    <div class="mt-3">
                        <span class="badge bg-primary me-2">5 médecins</span>
                        <span class="badge bg-success">Disponible</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">À partir de</span>
                        <strong class="text-primary">85€</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-success">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-brain fa-3x text-success"></i>
                    </div>
                    <h4 class="card-title">Neurologie</h4>
                    <p class="card-text text-muted">Troubles neurologiques, EEG, IRM</p>
                    <div class="mt-3">
                        <span class="badge bg-primary me-2">3 médecins</span>
                        <span class="badge bg-success">Disponible</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">À partir de</span>
                        <strong class="text-primary">120€</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 border-warning">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="fas fa-tooth fa-3x text-warning"></i>
                    </div>
                    <h4 class="card-title">Dentisterie</h4>
                    <p class="card-text text-muted">Soins dentaires, détartrage, implants</p>
                    <div class="mt-3">
                        <span class="badge bg-primary me-2">4 médecins</span>
                        <span class="badge bg-success">Disponible</span>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">À partir de</span>
                        <strong class="text-primary">65€</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des Services -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Tous les Services</h5>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-download me-1"></i>Exporter
                </button>
                <button class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-print me-1"></i>Imprimer
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Service</th>
                        <th>Description</th>
                        <th>Médecins</th>
                        <th>Prix</th>
                        <th>Statut</th>
                        <th>Réservations</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-heartbeat text-primary"></i>
                                </div>
                                <div>
                                    <strong>Cardiologie</strong>
                                    <div class="text-muted small">Service ID: SVC001</div>
                                </div>
                            </div>
                        </td>
                        <td>Consultations et examens cardiaques</td>
                        <td>
                            <span class="badge bg-primary">5 médecins</span>
                        </td>
                        <td>
                            <strong>85€ - 250€</strong>
                        </td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>
                            <span class="badge bg-info">24 ce mois</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Statistiques">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Désactiver">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-brain text-success"></i>
                                </div>
                                <div>
                                    <strong>Neurologie</strong>
                                    <div class="text-muted small">Service ID: SVC002</div>
                                </div>
                            </div>
                        </td>
                        <td>Troubles neurologiques et examens</td>
                        <td>
                            <span class="badge bg-primary">3 médecins</span>
                        </td>
                        <td>
                            <strong>120€ - 350€</strong>
                        </td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>
                            <span class="badge bg-info">18 ce mois</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Statistiques">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Désactiver">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-tooth text-warning"></i>
                                </div>
                                <div>
                                    <strong>Dentisterie</strong>
                                    <div class="text-muted small">Service ID: SVC003</div>
                                </div>
                            </div>
                        </td>
                        <td>Soins dentaires complets</td>
                        <td>
                            <span class="badge bg-primary">4 médecins</span>
                        </td>
                        <td>
                            <strong>65€ - 500€</strong>
                        </td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>
                            <span class="badge bg-info">32 ce mois</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Statistiques">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Désactiver">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <i class="fas fa-eye text-info"></i>
                                </div>
                                <div>
                                    <strong>Ophtalmologie</strong>
                                    <div class="text-muted small">Service ID: SVC004</div>
                                </div>
                            </div>
                        </td>
                        <td>Examens de la vue et corrections</td>
                        <td>
                            <span class="badge bg-primary">2 médecins</span>
                        </td>
                        <td>
                            <strong>75€ - 300€</strong>
                        </td>
                        <td>
                            <span class="badge bg-warning">Limité</span>
                        </td>
                        <td>
                            <span class="badge bg-info">15 ce mois</span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Statistiques">
                                    <i class="fas fa-chart-bar"></i>
                                </button>
                                <button class="btn btn-outline-danger" title="Désactiver">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showInactive">
                        <label class="form-check-label" for="showInactive">
                            Afficher les services inactifs
                        </label>
                    </div>
                </div>
                <div class="col-md-6 text-end">
                    <nav aria-label="Navigation des pages">
                        <ul class="pagination justify-content-end mb-0">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">
                    <i class="fas fa-stethoscope"></i>
                </div>
                <h3 class="h2 mb-1">12</h3>
                <p class="text-muted mb-0">Services actifs</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #D1FAE5; color: #10B981;">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="h2 mb-1">24</h3>
                <p class="text-muted mb-0">Médecins total</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h3 class="h2 mb-1">89</h3>
                <p class="text-muted mb-0">Réservations/mois</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #E0E7FF; color: #6366F1;">
                    <i class="fas fa-euro-sign"></i>
                </div>
                <h3 class="h2 mb-1">15.2k€</h3>
                <p class="text-muted mb-0">Chiffre/mois</p>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des actions sur les services
        document.querySelectorAll('.btn-group .btn').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.title;
                const serviceName = this.closest('tr').querySelector('strong').textContent;
                
                switch(action) {
                    case 'Voir':
                        alert(`Voir les détails du service: ${serviceName}`);
                        break;
                    case 'Modifier':
                        alert(`Modifier le service: ${serviceName}`);
                        break;
                    case 'Statistiques':
                        alert(`Voir les statistiques de: ${serviceName}`);
                        break;
                    case 'Désactiver':
                        if (confirm(`Désactiver le service ${serviceName} ?`)) {
                            alert(`Service ${serviceName} désactivé`);
                        }
                        break;
                }
            });
        });
    });
</script>
@endpush
@endsection