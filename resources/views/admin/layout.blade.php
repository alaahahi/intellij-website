<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة التحكم')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,.1);
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 1.5rem;
            background: rgba(0,0,0,.2);
            color: white;
            text-align: center;
        }
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar-menu li {
            border-bottom: 1px solid rgba(255,255,255,.1);
        }
        .sidebar-menu a {
            display: block;
            padding: 1rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255,255,255,.2);
            padding-right: 2rem;
        }
        .sidebar-menu a i {
            width: 20px;
            margin-left: 10px;
        }
        .sidebar-menu button {
            width: 100%;
            text-align: right;
        }
        .main-content {
            margin-right: 250px;
            min-height: 100vh;
        }
        .top-navbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
            padding: 1rem 2rem;
            margin-bottom: 2rem;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
                transition: transform 0.3s;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-right: 0;
            }
        }
        
        /* Pagination RTL Fix */
        .pagination {
            direction: rtl;
        }
        .pagination .page-link {
            text-align: center;
            min-width: 40px;
        }
        .pagination .page-item:first-child .page-link {
            border-top-left-radius: 0;
            border-top-right-radius: 0.375rem;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0.375rem;
        }
        .pagination .page-item:last-child .page-link {
            border-top-right-radius: 0;
            border-top-left-radius: 0.375rem;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0.375rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h4 class="mb-0">
                <i class="fas fa-chart-line"></i> لوحة التحكم
            </h4>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> الرئيسية
                </a>
            </li>
            <li>
                <a href="{{ route('admin.visits.index') }}" class="{{ request()->routeIs('admin.visits.*') ? 'active' : '' }}">
                    <i class="fas fa-eye"></i> الزيارات (تقليدي)
                </a>
            </li>
            <li>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> المستخدمين
                </a>
            </li>
            <li>
                <a href="{{ route('admin.contact-requests.index') }}" class="{{ request()->routeIs('admin.contact-requests.*') ? 'active' : '' }}">
                    <i class="fas fa-envelope"></i> طلبات الاتصال
                    @php
                        $newRequestsCount = \App\Models\ContactRequest::where('status', 'new')->count();
                    @endphp
                    @if($newRequestsCount > 0)
                        <span class="badge bg-danger ms-2">{{ $newRequestsCount }}</span>
                    @endif
                </a>
            </li>
            <li>
                <a href="{{ route('admin.cache.index') }}" class="{{ request()->routeIs('admin.cache.*') ? 'active' : '' }}">
                    <i class="fas fa-broom"></i> مسح الكاش
                </a>
            </li>
            <li>
                <a href="{{ route('admin.videos.index') }}" class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                    <i class="fas fa-video"></i> إدارة الفيديوهات
                </a>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> الملف الشخصي
                </a>
            </li>
            <li>
                <a href="{{ route('home') }}">
                    <i class="fas fa-globe"></i> الموقع الرئيسي
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-white text-start w-100 p-0" style="padding: 1rem 1.5rem !important; border: none; background: none;">
                        <i class="fas fa-sign-out-alt"></i> تسجيل الخروج
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-primary d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a href="{{ route('admin.contact-requests.index') }}" class="btn btn-outline-primary position-relative">
                        <i class="fas fa-envelope"></i> طلبات الاتصال
                        @php
                            $newRequestsCount = \App\Models\ContactRequest::where('status', 'new')->count();
                        @endphp
                        @if($newRequestsCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $newRequestsCount }}
                            </span>
                        @endif
                    </a>
                </div>
                <div class="user-menu">
                    <span class="text-muted">{{ Auth::user()->name }}</span>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">الملف الشخصي</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">تسجيل الخروج</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="container-fluid px-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('show');
        }
    </script>
    
    @stack('scripts')
</body>
</html>

