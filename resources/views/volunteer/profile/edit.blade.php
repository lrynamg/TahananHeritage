<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Tahanan Heritage</title>
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
            color: var(--cream);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header a { color: var(--cream); margin: 0 1rem; text-decoration: none; font-weight: 600; }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(197, 92, 44, 0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--primary-brown);
        }
        
        input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: "Instrument Sans", sans-serif;
            font-size: 1rem;
            color: var(--primary-brown);
        }
        
        input:focus {
            outline: none;
            border-color: var(--heritage-orange);
            box-shadow: 0 0 0 3px rgba(197, 92, 44, 0.1);
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-family: "Instrument Sans", sans-serif;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 1rem;
            margin-top: 1rem;
        }
        
        .btn-heritage {
            background-color: var(--heritage-orange);
            color: white;
        }
        
        .btn-heritage:hover {
            background-color: #a24a20;
        }
        
        .btn-secondary {
            background-color: var(--cream);
            color: var(--heritage-orange);
            border: 2px solid var(--heritage-orange);
        }
        
        .btn-secondary:hover {
            background-color: var(--heritage-orange);
            color: white;
        }
        
        .error-text {
            color: #721c24;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }
        
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
        <div class="card">
            <h1 style="margin-bottom: 2rem;">Edit Your Profile</h1>
            
            @if (\->any())
                <div class="alert-error">
                    @foreach (\->all() as \Could not find a part of the path 'C:\Users\LAURYAN AMIGO\Documents\TahananHeritage\resources\views\volunteer\dashboard.blade.php'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'.)
                        <div>{{ \Could not find a part of the path 'C:\Users\LAURYAN AMIGO\Documents\TahananHeritage\resources\views\volunteer\dashboard.blade.php'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. A parameter cannot be found that matches parameter name 'Chord'. }}</div>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('volunteer.profile.update') }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', \->first_name ?? '') }}" required>
                    @error('first_name')
                        <div class="error-text">{{ \ }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', \->last_name ?? '') }}" required>
                    @error('last_name')
                        <div class="error-text">{{ \ }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', \->email ?? '') }}" required>
                    @error('email')
                        <div class="error-text">{{ \ }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', \->phone_number ?? '') }}" required>
                    @error('phone_number')
                        <div class="error-text">{{ \ }}</div>
                    @enderror
                </div>
                
                <div>
                    <button type="submit" class="btn btn-heritage">Save Changes</button>
                    <a href="{{ route('volunteer.profile.show') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
