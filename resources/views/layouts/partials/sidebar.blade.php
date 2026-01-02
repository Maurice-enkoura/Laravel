<!-- Sidebar -->
<nav id="sidebar" class="active">
    <div class="sidebar-header">
        <h3>
            <i class="bi bi-hospital me-2"></i>
            <span>Medilab Admin</span>
        </h3>
    </div>

    <ul class="list-unstyled components">
        <li>
            <a href="{{ route('dashboard.admin') }}" class="{{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Tableau de bord</span>
            </a>
        </li>
        
        <li>
            <a href="#patientsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-people"></i>
                <span>Patients</span>
            </a>
            <ul class="collapse list-unstyled" id="patientsSubmenu">
                <li>
                    <a href="#"><i class="bi bi-plus-circle"></i> Ajouter patient</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-list-ul"></i> Liste des patients</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-clipboard-data"></i> Dossiers patients</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="#appointmentsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-calendar-check"></i>
                <span>Rendez-vous</span>
            </a>
            <ul class="collapse list-unstyled" id="appointmentsSubmenu">
                <li>
                    <a href="#"><i class="bi bi-calendar-plus"></i> Nouveau rendez-vous</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-calendar-week"></i> Planning du jour</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-calendar-month"></i> Vue calendrier</a>
                </li>
            </ul>
        </li>
        
        <!-- ... autres éléments du menu ... -->
    </ul>
    
    <div class="sidebar-footer mt-auto p-3">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1977cc&color=fff" alt="{{ Auth::user()->name }}" class="rounded-circle me-2" width="40">
            <div>
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <small class="text-muted">Administrateur</small>
            </div>
        </div>
    </div>
</nav>