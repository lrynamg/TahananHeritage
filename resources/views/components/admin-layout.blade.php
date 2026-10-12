<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - Tahanan Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Instrument Sans", sans-serif;
            background-color: #fffdfa;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: "Instrument Serif", serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, #c55c2c 0%, #a24a20 100%);
        }
        
        .navbar-brand {
            font-family: "Instrument Serif", serif;
            font-size: 1.5rem;
            font-weight: bold;
            color: #f3e9dc !important;
        }
        
        .navbar a {
            color: #f3e9dc !important;
        }
        
        .btn-logout {
            background-color: rgba(255, 255, 255, 0.2);
            color: #f3e9dc;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .btn-logout:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #f3e9dc;
        }
        
        .sidebar {
            background-color: #f3e9dc;
            border-right: 3px solid #c55c2c;
            min-height: calc(100vh - 70px);
        }
        
        .sidebar-nav a {
            color: #523121;
            text-decoration: none;
            padding: 1rem 1.5rem;
            display: block;
            border-left: 4px solid transparent;
            transition: all 0.3s;
        }
        
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background-color: rgba(197, 92, 44, 0.1);
            border-left-color: #c55c2c;
            color: #c55c2c;
        }
        
        .main-content {
            padding: 2rem;
            background-color: #fffdfa;
        }
        
        .btn-primary {
            background-color: #c55c2c;
            border-color: #c55c2c;
        }
        
        .btn-primary:hover {
            background-color: #a24a20;
            border-color: #a24a20;
        }
        
        .table thead {
            background-color: #c55c2c;
            color: white;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(197, 92, 44, 0.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
            <span class="navbar-brand">Tahanan Heritage Admin</span>
            <div class="ms-auto d-flex gap-3 align-items-center">
                <a href="/admin" class="text-decoration-none" style="color: #f3e9dc;">Dashboard</a>
                <form action="/logout" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    
    <div class="d-flex" style="min-height: calc(100vh - 70px);">
        <nav class="sidebar">
            <div class="sidebar-nav">
                <a href="/admin"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a href="/admin/volunteers"><i class="fas fa-users"></i> Volunteers</a>
                <a href="/admin/founders"><i class="fas fa-landmark"></i> Founders</a>
                <a href="/admin/homes"><i class="fas fa-home"></i> Homes</a>
            </div>
        </nav>
        
        <main class="main-content flex-grow-1">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Errors:</strong>
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            
            @if (session("success"))
                <div class="alert alert-success">
                    <i class="fas fa-check"></i> {{ session("success") }}
                </div>
            @endif
            
            {{ $slot }}
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
