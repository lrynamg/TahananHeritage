<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tahanan Heritage</title>
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
        
        .login-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .login-banner {
            flex: 1;
            background: linear-gradient(135deg, #c55c2c 0%, #a24a20 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #f3e9dc;
        }
        
        .login-banner h1 {
            font-family: "Instrument Serif", serif;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            line-height: 1.2;
        }
        
        .login-banner p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-bottom: 1rem;
        }
        
        .login-form-section {
            flex: 1;
            padding: 3rem;
        }
        
        .login-form-section h2 {
            font-family: "Instrument Serif", serif;
            font-size: 2rem;
            color: #523121;
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
        
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #c55c2c;
            box-shadow: 0 0 0 3px rgba(197, 92, 44, 0.1);
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.5rem 0;
            font-size: 0.9rem;
        }
        
        .form-options a {
            color: #c55c2c;
            text-decoration: none;
            font-weight: 500;
        }
        
        .form-options a:hover {
            text-decoration: underline;
        }
        
        .btn-login {
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
        
        .btn-login:hover {
            background-color: #a24a20;
            box-shadow: 0 4px 12px rgba(197, 92, 44, 0.3);
        }
        
        .signup-link {
            text-align: center;
            color: #523121;
        }
        
        .signup-link a {
            color: #c55c2c;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signup-link a:hover {
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
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-banner {
                padding: 2rem;
                min-height: 200px;
            }
            
            .login-form-section {
                padding: 2rem;
            }
            
            .login-banner h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-banner">
            <h1>Welcome Back</h1>
            <p>Login to manage and preserve Philippine heritage homes.</p>
            <p style="margin-top: 2rem; font-size: 0.9rem; opacity: 0.8;">Don't have an account? <a href="{{ route("register") }}" style="color: #f3e9dc; text-decoration: underline;">Create one</a></p>
        </div>
        
        <div class="login-form-section">
            <h2>Login</h2>
            
            @if (session("success"))
                <div class="alert-success">
                    {{ session("success") }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="error-message">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form method="POST" action="{{ route("login") }}">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" value="{{ old("email") }}" required autofocus />
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                </div>
                
                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember" /> Remember me
                    </label>
                    <a href="{{ route("password.request") }}">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn-login">Sign In</button>
                
                <div class="signup-link">
                    Don't have an account? <a href="{{ route("register") }}">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
