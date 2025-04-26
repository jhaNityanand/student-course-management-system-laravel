<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Student Course Management System') }}</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            .sidebar {
                min-height: 100vh;
                background: #2c3e50;
                color: #fff;
            }
            .sidebar .nav-link {
                color: #fff;
                padding: 0.8rem 1rem;
                margin: 0.2rem 0;
                border-radius: 0.25rem;
            }
            .sidebar .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
            }
            .sidebar .nav-link.active {
                background: #3498db;
            }
            .sidebar .nav-link i {
                width: 25px;
            }
            .main-content {
                background: #f8f9fa;
            }
            .card {
                border: none;
                box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            }
            .table th {
                background: #f8f9fa;
                font-weight: 600;
            }
            .btn-primary {
                background: #3498db;
                border-color: #3498db;
            }
            .btn-primary:hover {
                background: #2980b9;
                border-color: #2980b9;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 col-lg-2 px-0 sidebar">
                    <div class="p-3">
                        <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-white text-decoration-none">
                            <i class="fas fa-graduation-cap fa-2x me-2"></i>
                            <span class="fs-4">{{ config('app.name', 'SCMS') }}</span>
                        </a>
                    </div>
                    
                    <hr class="text-white-50">
                    
                    <ul class="nav flex-column px-3">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                                <i class="fas fa-user-graduate"></i> Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('courses.index') }}" class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                                <i class="fas fa-book"></i> Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('instructors.index') }}" class="nav-link {{ request()->routeIs('instructors.*') ? 'active' : '' }}">
                                <i class="fas fa-chalkboard-teacher"></i> Instructors
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('enrollments.index') }}" class="nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                                <i class="fas fa-user-plus"></i> Enrollments
                            </a>
                        </li>
                    </ul>

                    <hr class="text-white-50 mt-4">
                    
                    <ul class="nav flex-column px-3">
                        <li class="nav-item">
                            <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                                <i class="fas fa-user-cog"></i> Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link border-0 bg-transparent text-white w-100 text-start">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Main Content -->
                <div class="col-md-9 col-lg-10 main-content">
                    <!-- Top Navigation -->
                    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                        <div class="container-fluid">
                            <h1 class="navbar-brand mb-0 h1">@yield('title', 'Dashboard')</h1>
                            <div class="d-flex align-items-center">
                                <span class="text-muted me-3">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </nav>

                    <!-- Page Content -->
                    <div class="container-fluid py-4">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        @stack('scripts')
    </body>
</html>
