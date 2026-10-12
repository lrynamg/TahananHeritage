<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tahanan Heritage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-brown: #523121;
            --heritage-orange: #c55c2c;
            --cream: #f3e9dc;
            --bg-light: #fffdfa;
        }
        
        * { margin: 0; padding: 0; }
        
        body {
            background-color: var(--bg-light);
            font-family: "Instrument Sans", sans-serif;
            color: var(--primary-brown);
        }
        
        h1, h2 { font-family: "Instrument Serif", serif; }
        
        .header {
            background: linear-gradient(135deg, var(--heritage-orange) 0%, #a24a20 100%);
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            color: var(--cream);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header a { color: var(--cream); margin: 0 1rem; text-decoration: none; font-weight: 600; }
        .header a:hover { opacity: 0.8; }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(197, 92, 44, 0.1);
            margin-bottom: 2rem;
        }
        
        .btn-heritage {
            background-color: var(--heritage-orange);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-family: "Instrument Sans", sans-serif;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }
        
        .btn-heritage:hover {
            background-color: #a24a20;
            box-shadow: 0 4px 12px rgba(197, 92, 44, 0.3);
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <div style="font-family: 'Instrument Serif', serif; font-size: 1.3rem;">Tahanan Heritage</div>
        <div>
            <a href="{{ route('volunteer.dashboard') }}">Dashboard</a>
            <a href="{{ route('volunteer.profile.show') }}">My Profile</a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: none; border: none; color: var(--cream); cursor: pointer; font-weight: 600;">Logout</button>
            </form>
        </div>
    </div>
    
    <div class="container">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif
        
        <div class="card">
            <h1 style="margin-bottom: 1rem;">Welcome, {{ auth()->user()->name }}!</h1>
            <p style="font-size: 1.1rem; margin-bottom: 2rem; color: var(--heritage-orange);">You are a Tahanan Heritage Volunteer</p>
            
            <div style="background: linear-gradient(135deg, var(--cream) 0%, rgba(243, 233, 220, 0.5) 100%); padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1rem;">About Tahanan Heritage</h2>
                <p>We are dedicated to preserving and celebrating the ancestral houses of the Philippines. As a volunteer, you are part of this important mission.</p>
            </div>
            
            <div>
                <h3 style="margin-bottom: 1rem;">Quick Links</h3>
                <a href="{{ route('volunteer.profile.show') }}" class="btn-heritage">View Your Profile</a>
                <a href="{{ route('volunteer.profile.edit') }}" class="btn-heritage" style="margin-left: 1rem;">Edit Profile</a>
            </div>
        </div>
    </div>
</body>
</html>
