<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            background-image: url("{{ asset('images/bg.jpg') }}");
            /* Tambahkan properti tambahan untuk mengatur background */
            background-size: cover; /* Agar gambar menutupi seluruh area */
            background-position: center; /* Posisi gambar di tengah */
            background-repeat: no-repeat; /* Agar gambar tidak berulang */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.5);
        }
        

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 400px;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 2rem;
            color: #333;
        }

        .welcome-text h2 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            color: #666;
            font-size: 0.9rem;
        }

        .input-group {
            margin-bottom: 1.5rem;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-size: 0.9rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e1e1e1;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            border-color: #2193b0;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .forgot-password {
            color: #2193b0;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #1a7089;
        }

        .login-btn {
            width: 100%;
            padding: 0.8rem;
            background: #2193b0;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s ease;
        }

        .login-btn:hover {
            background: #1a7089;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.5rem;
            }

            .welcome-text h2 {
                font-size: 1.5rem;
            }
        }
    </style>
    <link rel="icon" href="{{ asset('images/lightweight_.png')}}">
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <!-- Ganti src dengan path logo perusahaan Anda -->
            <img src="{{ asset('images/logo-hwi.png')}}" alt="Company Logo" class="logo">
        </div>
        <div class="welcome-text">
            <h2>Welcome Back!</h2>
            <p>Please enter your credentials to access your account</p>
        </div>
        <form action="{{route('login')}}" method="POST">
            @csrf
            <div class="input-group">
                <x-input-label for="email" :value="__('Username')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="input-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>
                {{-- <a href="#" class="forgot-password">Forgot Password?</a> --}}
            </div>
            <button type="submit" class="login-btn">Log In</button>
        </form>
    </div>
</body>
</html>