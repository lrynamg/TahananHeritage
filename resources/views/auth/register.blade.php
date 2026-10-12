<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tahanan Heritage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #fffdfa 0%, #f3e9dc 100%);
            font-family: "Instrument Sans", sans-serif;
            color: #523121;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .register-container {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            padding: 3rem;
        }
        
        .register-container h1 {
            font-family: "Instrument Serif", serif;
            font-size: 2rem;
            color: #523121;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .register-container p {
            text-align: center;
            color: #666;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #523121;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-family: "Instrument Sans", sans-serif;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #c55c2c;
            box-shadow: 0 0 0 3px rgba(197, 92, 44, 0.1);
        }
        
        .btn-register {
            width: 100%;
            padding: 0.75rem 1.5rem;
            background-color: #c55c2c;
            color: #f3e9dc;
            border: none;
            border-radius: 8px;
            font-family: "Instrument Sans", sans-serif;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }
        
        .btn-register:hover {
            background-color: #a24a20;
            box-shadow: 0 4px 12px rgba(197, 92, 44, 0.3);
        }
        
        .login-link {
            text-align: center;
            color: #523121;
        }
        
        .login-link a {
            color: #c55c2c;
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-link a:hover {
            text-decoration: underline;
        }
        
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Create Account</h1>
        <p>Join us to help preserve Philippine heritage</p>
        
        @if ($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route("register") }}">
            @csrf
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old("name") }}" required autofocus />
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old("email") }}" required />
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required />
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required />
            </div>
            
            <button type="submit" class="btn-register">Create Account</button>
            
            <div class="login-link">
                Already have an account? <a href="{{ route("login") }}">Sign in</a>
            </div>
        </form>
    </div>
</body>
</html>
