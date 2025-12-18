<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medilab Admin - Dashboard</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    
    <!-- Custom CSS -->
      <link href="assets/css/main.css" rel="stylesheet">
</head>
<body>
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
                <a href="#" class="active">
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
            
            <li>
                <a href="#">
                    <i class="bi bi-person-badge"></i>
                    <span>Doctors</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class="bi bi-capsule"></i>
                    <span>Pharmacy</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class="bi bi-cash-stack"></i>
                    <span>Billing</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class="bi bi-clipboard-pulse"></i>
                    <span>Lab Reports</span>
                </a>
            </li>
            
            <li>
                <a href="#">
                    <i class="bi bi-bar-chart"></i>
                    <span>Reports</span>
                </a>
            </li>
            
            <li>
                <a href="#settingsSubmenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="bi bi-gear"></i>
                    <span>Settings</span>
                </a>
                <ul class="collapse list-unstyled" id="settingsSubmenu">
                    <li>
                        <a href="#"><i class="bi bi-person-circle"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-shield-check"></i> Security</a>
                    </li>
                    <li>
                        <a href="#"><i class="bi bi-sliders"></i> Preferences</a>
                    </li>
                </ul>
            </li>
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

    <!-- Main Content -->
    <div id="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <button class="toggle-btn" id="sidebarCollapse">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="d-flex align-items-center ms-auto">
                    <div class="navbar-search me-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
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
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=1977cc&color=fff" alt="Admin" class="rounded-circle" width="40">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Dashboard Content -->
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Dashboard</h1>
                    <p class="text-muted mb-0">Welcome back, Administrator</p>
                </div>
                <div>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i> Add New Patient
                    </button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-icon primary">
                            <i class="bi bi-people"></i>
                        </div>
                        <h3>1,254</h3>
                        <p>Total Patients</p>
                        <div class="card-footer">
                            <span class="text-success"><i class="bi bi-arrow-up"></i> 12% increase</span> from last month
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-icon success">
                            <i class="bi bi-calendar-check"></i>
                        </div>
                        <h3>48</h3>
                        <p>Today's Appointments</p>
                        <div class="card-footer">
                            <span class="text-danger"><i class="bi bi-clock"></i> 5 pending</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-icon warning">
                            <i class="bi bi-capsule"></i>
                        </div>
                        <h3>$12,580</h3>
                        <p>Pharmacy Revenue</p>
                        <div class="card-footer">
                            <span class="text-success"><i class="bi bi-arrow-up"></i> 8% increase</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-xl-3 col-md-6">
                    <div class="dashboard-card">
                        <div class="card-icon danger">
                            <i class="bi bi-clipboard-pulse"></i>
                        </div>
                        <h3>237</h3>
                        <p>Pending Lab Tests</p>
                        <div class="card-footer">
                            <span class="text-warning"><i class="bi bi-exclamation-triangle"></i> Needs attention</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Data Section -->
            <div class="row g-4 mb-4">
                <!-- Appointment Chart -->
                <div class="col-lg-8">
                    <div class="chart-container">
                        <h5 class="mb-4">Appointments Overview</h5>
                        <canvas id="appointmentsChart"></canvas>
                    </div>
                </div>
                
                <!-- Recent Activities -->
                <div class="col-lg-4">
                    <div class="chart-container">
                        <h5 class="mb-4">Recent Activities</h5>
                        <div class="activity-list">
                            <div class="activity-item d-flex">
                                <div class="activity-icon appointment">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New Appointment Scheduled</h6>
                                    <p class="mb-0 text-muted">John Doe - Cardiology</p>
                                    <small class="activity-time">10 minutes ago</small>
                                </div>
                            </div>
                            
                            <div class="activity-item d-flex">
                                <div class="activity-icon patient">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">New Patient Registered</h6>
                                    <p class="mb-0 text-muted">Sarah Johnson</p>
                                    <small class="activity-time">1 hour ago</small>
                                </div>
                            </div>
                            
                            <div class="activity-item d-flex">
                                <div class="activity-icon payment">
                                    <i class="bi bi-credit-card"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Payment Received</h6>
                                    <p class="mb-0 text-muted">Invoice #INV-00123 - $450</p>
                                    <small class="activity-time">2 hours ago</small>
                                </div>
                            </div>
                            
                            <div class="activity-item d-flex">
                                <div class="activity-icon appointment">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">Appointment Cancelled</h6>
                                    <p class="mb-0 text-muted">Michael Brown - Neurology</p>
                                    <small class="activity-time">3 hours ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-4 mb-4">
                <div class="col-12">
                    <div class="chart-container">
                        <h5 class="mb-4">Quick Actions</h5>
                        <div class="row g-3">
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-person-plus"></i>
                                    <span>Add Patient</span>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-calendar-plus"></i>
                                    <span>New Appointment</span>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-prescription"></i>
                                    <span>Write Prescription</span>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-file-earmark-text"></i>
                                    <span>Generate Report</span>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-printer"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4 col-6">
                                <a href="#" class="quick-action-btn">
                                    <i class="bi bi-gear"></i>
                                    <span>Settings</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Patients Table -->
            <div class="row">
                <div class="col-12">
                    <div class="dataTables_wrapper">
                        <h5 class="mb-4">Recent Patients</h5>
                        <table id="patientsTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Patient ID</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Last Visit</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#PT001</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=John+Doe&background=1977cc&color=fff" alt="John Doe" class="rounded-circle me-2" width="30">
                                            <span>John Doe</span>
                                        </div>
                                    </td>
                                    <td>45</td>
                                    <td>Male</td>
                                    <td>(555) 123-4567</td>
                                    <td>2024-01-15</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#PT002</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Sarah+Smith&background=dc3545&color=fff" alt="Sarah Smith" class="rounded-circle me-2" width="30">
                                            <span>Sarah Smith</span>
                                        </div>
                                    </td>
                                    <td>32</td>
                                    <td>Female</td>
                                    <td>(555) 987-6543</td>
                                    <td>2024-01-14</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#PT003</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson&background=28a745&color=fff" alt="Mike Johnson" class="rounded-circle me-2" width="30">
                                            <span>Mike Johnson</span>
                                        </div>
                                    </td>
                                    <td>58</td>
                                    <td>Male</td>
                                    <td>(555) 456-7890</td>
                                    <td>2024-01-13</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#PT004</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=Emma+Wilson&background=6f42c1&color=fff" alt="Emma Wilson" class="rounded-circle me-2" width="30">
                                            <span>Emma Wilson</span>
                                        </div>
                                    </td>
                                    <td>28</td>
                                    <td>Female</td>
                                    <td>(555) 321-0987</td>
                                    <td>2024-01-12</td>
                                    <td><span class="badge bg-danger">Inactive</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#PT005</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://ui-avatars.com/api/?name=David+Brown&background=fd7e14&color=fff" alt="David Brown" class="rounded-circle me-2" width="30">
                                            <span>David Brown</span>
                                        </div>
                                    </td>
                                    <td>65</td>
                                    <td>Male</td>
                                    <td>(555) 654-3210</td>
                                    <td>2024-01-11</td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            @include('layouts.partials.footer')

        </div>
    </div>

    
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom JavaScript -->
        <script src="assets/js/main.js"></script>
</body>
</html>