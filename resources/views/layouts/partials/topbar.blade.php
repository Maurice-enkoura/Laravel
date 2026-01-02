<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="toggle-btn" id="sidebarCollapse">
            <i class="bi bi-list"></i>
        </button>

        <div class="d-flex align-items-center ms-auto">
            <div class="navbar-search me-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Rechercher...">
                    <button class="btn" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <div class="navbar-icons">
                <a href="#" class="position-relative">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-danger">3</span>
                </a>
                <a href="#" class="position-relative">
                    <i class="bi bi-envelope"></i>
                    <span class="badge bg-primary">5</span>
                </a>
                <a href="#">
                    <i class="bi bi-question-circle"></i>
                </a>
            </div>

            <div class="dropdown ms-3">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1977cc&color=fff" alt="{{ Auth::user()->name }}" class="rounded-circle" width="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profil</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Paramètres</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left;">
                                <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>