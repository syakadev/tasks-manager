<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Register</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #faf5ff 0%, #e9d5ff 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            box-shadow: 0 20px 40px rgba(139, 92, 246, 0.15);
            border-radius: 20px;
            transition: all 0.3s ease;
            border: 1px solid #e9d5ff;
        }
        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(139, 92, 246, 0.2);
        }
        .btn-register {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        }
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .input-field:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
        }
        .text-link {
            transition: all 0.3s ease;
            color: #8b5cf6;
        }
        .text-link:hover {
            color: #6d28d9;
            transform: translateY(-1px);
        }
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(30px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <div class="text-center mb-8 fade-in">
            <a href="/">
                <h1 class="text-4xl font-bold text-purple-800">REGISTER</h1>
            </a>
            <p class="text-purple-600 mt-3 text-lg">Create your Account</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white overflow-hidden rounded-2xl register-container fade-in">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-purple-800 mb-3">Name</label>
                    <input id="name" 
                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           type="text" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus 
                           autocomplete="name" 
                           placeholder="Enter your name" />
                    @error('name')
                        <p class="text-sm text-red-600 mt-2 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-purple-800 mb-3">Email</label>
                    <input id="email" 
                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           type="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autocomplete="username" 
                           placeholder="Enter your email" />
                    @error('email')
                        <p class="text-sm text-red-600 mt-2 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-purple-800 mb-3">Register as</label>
                    <select id="role"
                            name="role"
                            class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required>
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Select role</option>
                        <option value="admin" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager Proyek</option>
                        <option value="user" {{ old('role') == 'member' ? 'selected' : '' }}>Anggota Proyek</option>
                    </select>
                    @error('role')
                        <p class="text-sm text-red-600 mt-2 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-purple-800 mb-3">Password</label>
                    <input id="password" 
                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password" 
                           placeholder="Enter your password" />
                    @error('password')
                        <p class="text-sm text-red-600 mt-2 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-medium text-purple-800 mb-3">Confirm Password</label>
                    <input id="password_confirmation" 
                           class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password" 
                           placeholder="Confirm your password" />
                    @error('password_confirmation')
                        <p class="text-sm text-red-600 mt-2 animate-pulse">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between mt-8 pt-6 border-t border-purple-100">
                    <a class="text-link text-sm font-medium" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="btn-register py-3 px-8 text-white rounded-xl font-semibold">
                        {{ __('Register') }}
                    </button>
                </div>
            
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.input-field');
            const form = document.querySelector('form');

            setTimeout(() => {
                form.style.opacity = '1';
                form.style.transform = 'translateY(0)';
            }, 100);

            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    input.parentElement.classList.add('transform', 'translate-y-1');
                });
                
                input.addEventListener('blur', () => {
                    input.parentElement.classList.remove('transform', 'translate-y-1');
                });
            });
        });
    </script>
</body>
</html>