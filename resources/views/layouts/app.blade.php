<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'URL Shortener')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
            /* Adjust for navbar */
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">URL Shortener</a>
            @if (auth()->check())
                <p>Hiii ,{{ auth()->user()->name }}</p>
            @endif


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Navigation for Super Admin -->
                    @if (auth()->check() && auth()->user()->role_id == 1)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('superadmin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('superAdmin.urls.index') }}">System URLs</a>
                        </li>
                    @endif

                    <!-- Navigation for Admin -->
                    @if (auth()->check() && auth()->user()->role_id == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard.team') }}">Team Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.urls.index.team') }}">Team URLs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.urls.index.single') }}">My URLs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.urls.create') }}">Create URLs</a>
                        </li>
                    @endif

                    <!-- Navigation for Member -->
                    @if (auth()->check() && auth()->user()->role_id == 3)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('member.urls.index') }}">My URLs</a>
                        </li>
                    @endif

                    <!-- Authentication Links -->
                    @if (auth()->check())
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container">
        <div class="m-3">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        @yield('content')
    </main>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page Specific Scripts -->
    @yield('scripts')
</body>

</html>
