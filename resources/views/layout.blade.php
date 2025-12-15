<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CREC - Campus Resource & Equipment Centre</title>
    
    <!-- Fonts: Inter (Clean, Modern, Academic) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-color: #0f172a; /* Deep Navy (Academic/Professional) */
            --accent-color: #3b82f6;  /* Bright Blue (Action) */
            --bg-color: #f8fafc;      /* Very Light Blue-Grey (Clean) */
            --text-color: #334155;    /* Slate Grey (Easy reading) */
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
        }

        /* Minimal Navbar */
        .navbar {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color) !important;
            letter-spacing: -0.5px;
        }
        .nav-link {
            font-weight: 500;
            color: #64748b;
        }
        .nav-link:hover {
            color: var(--accent-color);
        }

        /* Modern Cards */
        .card {
            border: none;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            overflow: hidden;
        }
        /* Hover effect for students browsing gear */
        .gear-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        /* Buttons & Badges */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-weight: 500;
        }
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }
        .btn-primary:hover {
            background-color: #1e293b;
        }
        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
            border-radius: 6px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-box-seam me-2 text-primary"></i>CREC
            </a>
            
            <div class="d-flex align-items-center gap-3">
                @auth
                    <!-- Admin Links -->
                    @if(auth()->user()->role === 'approver')
                        <div class="d-none d-md-flex gap-2">
                            <a href="{{ route('approvals') }}" class="btn btn-outline-warning btn-sm border-0">
                                <i class="bi bi-inbox me-1"></i> Requests
                            </a>
                            <a href="{{ route('active.loans') }}" class="btn btn-outline-info btn-sm border-0">
                                <i class="bi bi-arrow-repeat me-1"></i> Returns
                            </a>
                            <a href="{{ route('history') }}" class="btn btn-outline-secondary btn-sm border-0">
                                <i class="bi bi-clock-history me-1"></i> Reports
                            </a>
                        </div>
                        <div class="vr mx-2 text-muted"></div>
                    @endif

                    <!-- User Profile -->
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 32px; height: 32px; font-size: 14px;">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <span class="d-none d-sm-inline small">{{ auth()->user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow mt-2">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container py-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS for Dropdowns -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>