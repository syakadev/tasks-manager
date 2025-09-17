<x-guest-layout>
<head>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #6d28d9 0%, #9333ea 50%, #a855f7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            box-shadow: 0 10px 40px rgba(109, 40, 217, 0.2);
            border-radius: 20px;
            backdrop-filter: blur(8px);
            transition: all 0.3s ease;
        }
        .login-container:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 50px rgba(147, 51, 234, 0.3);
        }
        .btn-login {
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(147, 51, 234, 0.4);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus {
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.4);
            border-color: #9333ea;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <div class="text-center mb-8">
    <a href="/">
        <h1 class="text-4xl font-extrabold text-white drop-shadow-[0_2px_6px_rgba(147,51,234,0.6)] tracking-wide">
            LOGIN
        </h1>
    </a>
    <p class="text-purple-100 mt-2">Hello Everyone</p>
    <p class="text-purple-200">Login your Account to get full time Experience</p>
</div>


        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/90 shadow-lg overflow-hidden rounded-2xl login-container">
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-purple-700 mb-2">Email</label>
                    <input id="email" 
                           class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus 
                           autocomplete="username" 
                           placeholder="Enter your email" />
                    @error('email')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-purple-700 mb-2">Password</label>
                    <input id="password" 
                           class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password" 
                           placeholder="Enter your password" />
                    @error('password')
                        <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" 
                               name="remember">
                        <label for="remember_me" class="ml-2 text-sm text-gray-700">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-purple-600 hover:text-purple-800 font-medium" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <div class="flex items-center justify-center">
                    <button type="submit" class="btn-login w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg font-semibold hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        {{ __('Log in') }}
                    </button>
                </div>
            </form>
            <div class="mt-6 text-center">
                <span class="text-gray-700 text-sm">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-medium ml-1">
                    Register
                </a>
            </div>
        </div>
    </div>
</body>
</x-guest-layout>
