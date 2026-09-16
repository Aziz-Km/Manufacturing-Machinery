<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jowfe Maintenance') }}</title>

    <!-- Fonts & Icons -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css">
    
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            border-bottom: 3px solid #d4af37; /* Gold color from logo */
        }
        .navbar-brand {
            font-weight: 800;
            color: #333 !important;
        }
        .text-gold {
            color: #d4af37;
        }
        .bg-gold {
            background-color: #d4af37;
            color: #fff;
        }
        .btn-primary {
            background-color: #d4af37;
            border-color: #d4af37;
        }
        .btn-primary:hover {
            background-color: #b3932f;
            border-color: #b3932f;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('logo.png') }}" alt="الشعار" style="height: 55px; width: auto; margin-left: 15px; object-fit: contain;">
                    منظومة الصيانة - الجوف
                </a>
                <div class="d-flex align-items-center">
                    @auth
                        <a class="btn btn-sm btn-outline-danger fw-bold me-3" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form-main').submit();">
                            <i class="fas fa-sign-out-alt"></i> خروج
                        </a>
                        <form id="logout-form-main" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endauth
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar (which is Right in RTL) -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @can('manage_factories')
                            <li class="nav-item">
                                <a class="nav-link fw-bold mx-2 {{ request()->routeIs('factories.*') ? 'active text-gold' : 'text-dark' }}" href="{{ route('factories.index') }}">
                                    <i class="fas fa-industry"></i> المصانع
                                </a>
                            </li>
                            @endcan
                            
                            @can('manage_machines')
                            <li class="nav-item">
                                <a class="nav-link fw-bold mx-2 {{ request()->routeIs('machines.*') ? 'active text-gold' : 'text-dark' }}" href="{{ route('machines.index') }}">
                                    <i class="fas fa-cogs"></i> الآلات
                                </a>
                            </li>
                            @endcan
                            
                            @can('manage_engineers')
                            <li class="nav-item">
                                <a class="nav-link fw-bold mx-2 {{ request()->routeIs('engineers.*') ? 'active text-gold' : 'text-dark' }}" href="{{ route('engineers.index') }}">
                                    <i class="fas fa-users-cog"></i> المهندسين
                                </a>
                            </li>
                            @endcan
                            
                            @can('manage_catalogs')
                            <li class="nav-item">
                                <a class="nav-link fw-bold mx-2 {{ request()->routeIs('catalogs.*') ? 'active text-gold' : 'text-dark' }}" href="{{ route('catalogs.index') }}">
                                    <i class="fas fa-list-check"></i> كتالوج المهام
                                </a>
                            </li>
                            @endcan
                            
                            @can('manage_tasks')
                            <li class="nav-item">
                                <a class="nav-link fw-bold mx-2 {{ request()->routeIs('tasks.*') ? 'active text-gold' : 'text-dark' }}" href="{{ route('tasks.index') }}">
                                    <i class="fas fa-tools"></i> أوامر الصيانة
                                </a>
                            </li>
                            @endcan
                            
                            @can('manage_users')
                            <li class="nav-item">
                                <a class="nav-link text-danger fw-bold mx-2 {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                    <i class="fas fa-shield-alt"></i> الصلاحيات
                                </a>
                            </li>
                            @endcan
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar (which is Left in RTL) -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">تسجيل الدخول</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item d-flex align-items-center">
                                <span class="nav-link text-muted fw-bold me-3">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </span>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
