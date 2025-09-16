<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .input-field {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .input-field:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
            transform: translateY(-2px);
        }
        .btn-primary {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .form-card {
            transition: all 0.3s ease;
            border: 1px solid #f3e8ff;
        }
        .form-card:hover {
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.15);
        }
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
        @keyframes fadeIn {
            from { 
                opacity: 0; 
                transform: translateY(20px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }
        .slide-in {
            animation: slideIn 0.8s ease-out;
        }
        @keyframes slideIn {
            from { 
                opacity: 0; 
                transform: translateX(-20px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-purple-700 leading-tight slide-in">
                {{ __('Create New Project') }}
            </h2>
        </x-slot>

        <div class="py-8 fade-in">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden form-card rounded-2xl shadow-lg">
                    <div class="p-8">
                        <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-purple-800 mb-3">Project Name</label>
                                <input type="text" name="name" id="name"
                                class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required autofocus placeholder="Enter project name">
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-purple-800 mb-3">Description</label>
                                <textarea name="description" id="description" rows="5" 
                                class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                required placeholder="Describe your project..."></textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div class="mb-6">
                                <label for="end_date" class="block text-sm font-medium text-purple-800 mb-3">End Date</label>
                                <input type="date" name="end_date" id="end_date"
                                class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                placeholder="Select end date">
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t border-purple-100">
                                <button type="submit" class="btn-primary px-8 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Create Project
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Animasi untuk input fields
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.input-field');
                const form = document.querySelector('form');
                
                // Animasi untuk form elements
                setTimeout(() => {
                    form.style.opacity = '1';
                    form.style.transform = 'translateY(0)';
                }, 100);
                
                // Focus effect untuk inputs
                inputs.forEach(input => {
                    input.addEventListener('focus', () => {
                        input.parentElement.classList.add('transform', 'translate-y-1');
                    });
                    
                    input.addEventListener('blur', () => {
                        input.parentElement.classList.remove('transform', 'translate-y-1');
                    });
                });
                
                // Date input styling
                const dateInput = document.getElementById('end_date');
                if (dateInput) {
                    dateInput.addEventListener('focus', () => {
                        dateInput.classList.add('ring-2', 'ring-purple-300');
                    });
                    dateInput.addEventListener('blur', () => {
                        dateInput.classList.remove('ring-2', 'ring-purple-300');
                    });
                }
            });
        </script>
    </x-app-layout>
</body>
</html>