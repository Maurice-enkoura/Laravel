@extends('layouts.app')

@section('title', 'Gestion des Utilisateurs - Admin')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h2 mb-0">
                <i class="fas fa-users me-2"></i>Gestion des Utilisateurs
            </h1>
            <p class="text-muted mb-0">Gérez les comptes utilisateurs, médecins et administrateurs</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                <i class="fas fa-user-plus me-1"></i>Nouvel Utilisateur
            </button>
        </div>
    </div>

    <!-- Filtres et Recherche -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Rechercher</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Nom, email, téléphone...">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Rôle</label>
                    <select class="form-select">
                        <option value="">Tous les rôles</option>
                        <option value="admin">Administrateur</option>
                        <option value="medecin">Médecin</option>
                        <option value="patient">Patient</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select class="form-select">
                        <option value="">Tous les statuts</option>
                        <option value="active">Actif</option>
                        <option value="inactive">Inactif</option>
                        <option value="pending">En attente</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn btn-outline-primary w-100">
                        <i class="fas fa-filter me-1"></i>Filtrer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Liste des Utilisateurs</h5>
            <span class="badge bg-primary">{{ count($users ?? []) }} utilisateurs</span>
        </div>
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Utilisateur</th>
                        <th>Rôle</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Statut</th>
                        <th>Inscription</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Exemple de données statiques -->
                    <tr>
                        <td>1</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3">
                                    JD
                                </div>
                                <div>
                                    <strong>Jean Dupont</strong>
                                    <div class="text-muted small">ID: USR001</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">Admin</span>
                        </td>
                        <td>jean.dupont@email.com</td>
                        <td>+33 6 12 34 56 78</td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>15/01/2024</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
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
                                <div class="user-avatar me-3" style="background: linear-gradient(135deg, #10B981, #34D399);">
                                    MS
                                </div>
                                <div>
                                    <strong>Dr. Marie Sanchez</strong>
                                    <div class="text-muted small">ID: MED001</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-success">Médecin</span>
                        </td>
                        <td>marie.sanchez@clinique.fr</td>
                        <td>+33 6 23 45 67 89</td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>20/01/2024</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-info" title="Planning">
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="user-avatar me-3" style="background: linear-gradient(135deg, #F59E0B, #FBBF24);">
                                    PM
                                </div>
                                <div>
                                    <strong>Paul Martin</strong>
                                    <div class="text-muted small">ID: PAT001</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">Patient</span>
                        </td>
                        <td>paul.martin@email.com</td>
                        <td>+33 6 34 56 78 90</td>
                        <td>
                            <span class="badge bg-success">Actif</span>
                        </td>
                        <td>25/01/2024</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" title="Voir">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-warning" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-secondary" title="Historique">
                                    <i class="fas fa-history"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <nav aria-label="Navigation des pages">
                <ul class="pagination justify-content-center mb-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Précédent</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Suivant</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary-light); color: var(--primary);">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="h2 mb-1">24</h3>
                <p class="text-muted mb-0">Utilisateurs totaux</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #D1FAE5; color: #10B981;">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3 class="h2 mb-1">8</h3>
                <p class="text-muted mb-0">Médecins</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEF3C7; color: #F59E0B;">
                    <i class="fas fa-user-injured"></i>
                </div>
                <h3 class="h2 mb-1">15</h3>
                <p class="text-muted mb-0">Patients</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background: #FEE2E2; color: #EF4444;">
                    <i class="fas fa-user-slash"></i>
                </div>
                <h3 class="h2 mb-1">1</h3>
                <p class="text-muted mb-0">Comptes inactifs</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Création Utilisateur -->
<div class="modal fade" id="createUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Nouvel Utilisateur
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nom complet *</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rôle *</label>
                            <select class="form-select" required>
                                <option value="">Sélectionner un rôle</option>
                                <option value="admin">Administrateur</option>
                                <option value="medecin">Médecin</option>
                                <option value="patient">Patient</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mot de passe *</label>
                            <input type="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Confirmer le mot de passe *</label>
                            <input type="password" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <button type="submit" form="createUserForm" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>Créer l'utilisateur
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la création d'utilisateur
        const createUserForm = document.getElementById('createUserForm');
        if (createUserForm) {
            createUserForm.addEventListener('submit', function(e) {
                e.preventDefault();
                // Ici, vous ajouteriez l'appel AJAX pour créer l'utilisateur
                alert('Fonctionnalité de création d\'utilisateur à implémenter');
                bootstrap.Modal.getInstance(document.getElementById('createUserModal')).hide();
            });
        }
    });
</script>
@endpush
@endsection