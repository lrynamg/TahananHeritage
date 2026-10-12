<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Tahanan Heritage</title>
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
        
        .profile-field {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }
        
        .profile-field:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .field-label {
            font-weight: 600;
            color: var(--heritage-orange);
            font-size: 0.9rem;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .field-value {
            font-size: 1.1rem;
            color: var(--primary-brown);
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
            margin-top: 1rem;
        }
        
        .btn-heritage:hover {
            background-color: #a24a20;
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
            <h1 style="margin-bottom: 2rem;">Your Profile</h1>
            
            @if (\)
                <div class="profile-field">
                    <div class="field-label">First Name</div>
                    <div class="field-value">{{ \->first_name }}</div>
                </div>
                
                <div class="profile-field">
                    <div class="field-label">Last Name</div>
                    <div class="field-value">{{ \->last_name }}</div>
                </div>
                
                <div class="profile-field">
                    <div class="field-label">Email</div>
                    <div class="field-value">{{ \->email }}</div>
                </div>
                
                <div class="profile-field">
                    <div class="field-label">Phone Number</div>
                    <div class="field-value">{{ \->phone_number }}</div>
                </div>
                
                <div class="profile-field">
                    <div class="field-label">Joined</div>
                    <div class="field-value">{{ \->created_at->format('F d, Y') }}</div>
                </div>
                
                <a href="{{ route('volunteer.profile.edit') }}" class="btn-heritage">Edit Profile</a>
            @else
                <p>No profile information found.</p>
            @endif
        </div>
    </div>
</body>
</html>
