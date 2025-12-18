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
                <span>Dashboard</span>
            </a>
        </li>
        
        <li>
            <a href="#patientsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-people"></i>
                <span>Patients</span>
            </a>
            <ul class="collapse list-unstyled" id="patientsSubmenu">
                <li>
                    <a href="#"><i class="bi bi-plus-circle"></i> Add Patient</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-list-ul"></i> Patient List</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-clipboard-data"></i> Patient Records</a>
                </li>
            </ul>
        </li>
        
        <li>
            <a href="#appointmentsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                <i class="bi bi-calendar-check"></i>
                <span>Appointments</span>
            </a>
            <ul class="collapse list-unstyled" id="appointmentsSubmenu">
                <li>
                    <a href="#"><i class="bi bi-calendar-plus"></i> New Appointment</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-calendar-week"></i> Today's Schedule</a>
                </li>
                <li>
                    <a href="#"><i class="bi bi-calendar-month"></i> Calendar View</a>
                </li>
            </ul>
        </li>
        
        <!-- ... autres éléments du menu ... -->
    </ul>
    
    <div class="sidebar-footer mt-auto p-3">
        <div class="d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name=Admin+User&background=1977cc&color=fff" alt="Admin" class="rounded-circle me-2" width="40">
            <div>
                <h6 class="mb-0">Admin User</h6>
                <small class="text-muted">Administrator</small>
            </div>
        </div>
    </div>
</nav>