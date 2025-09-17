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
        .select-field {
            transition: all 0.3s ease;
            border: 2px solid #e5e7eb;
        }
        .select-field:focus {
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
        .btn-secondary {
            transition: all 0.3s ease;
            color: #8b5cf6;
            border: 2px solid #8b5cf6;
        }
        .btn-secondary:hover {
            background-color: #8b5cf6;
            color: white;
            transform: translateY(-2px);
        }
        .form-card {
            transition: all 0.3s ease;
            border: 1px solid #f3e8ff;
            background: linear-gradient(135deg, #ffffff 0%, #faf5ff 100%);
        }
        .form-card:hover {
            box-shadow: 0 15px 35px rgba(139, 92, 246, 0.15);
            transform: translateY(-5px);
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
        .option-item {
            padding: 12px 16px;
            border-bottom: 1px solid #f3e8ff;
        }
        .option-item:last-child {
            border-bottom: none;
        }
        .option-item:hover {
            background-color: #faf5ff;
        }
    </style>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-purple-700 leading-tight slide-in">
                {{ __('Add Member to Project: ') }} <span class="text-purple-600">{{ $project->name }}</span>
            </h2>
        </x-slot>

        <div class="py-8 fade-in">
            <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
                <div class="form-card overflow-hidden rounded-2xl shadow-xl">
                    <div class="p-8">
                        <form method="POST" action="{{ route('projects.teams.storeMember', ['project' => $project]) }}" class="space-y-6">
                            @csrf

                            <!-- User Selection -->
                            <div class="mb-6">
                                <label for="user_id" class="block text-sm font-medium text-purple-800 mb-3">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        Select User to Add
                                    </span>
                                </label>
                                <select id="user_id" name="user_id" 
                                        class="select-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                                    <option value="" class="option-item">-- Select a user --</option>
                                    @foreach ($availableUsers as $user)
                                        <option value="{{ $user->id }}" class="option-item">
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t border-purple-100 space-x-4">
                                <a href="{{ route('projects.teams.index', $project) }}" 
                                   class="btn-secondary px-6 py-3 rounded-xl font-semibold transition-all duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Cancel
                                </a>

                                <button type="submit" 
                                        class="btn-primary px-6 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Add Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Animasi untuk form elements
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('user_id');
                const form = document.querySelector('form');
                
                // Animasi untuk form
                setTimeout(() => {
                    form.style.opacity = '1';
                    form.style.transform = 'translateY(0)';
                }, 100);
                
                // Focus effect untuk select
                if (select) {
                    select.addEventListener('focus', () => {
                        select.parentElement.classList.add('transform', 'translate-y-1');
                        select.classList.add('ring-2', 'ring-purple-300');
                    });
                    
                    select.addEventListener('blur', () => {
                        select.parentElement.classList.remove('transform', 'translate-y-1');
                        select.classList.remove('ring-2', 'ring-purple-300');
                    });
                }

                // Enhanced select styling
                const style = document.createElement('style');
                style.textContent = `
                    select option {
                        padding: 12px 16px;
                        border-bottom: 1px solid #f3e8ff;
                    }
                    select option:last-child {
                        border-bottom: none;
                    }
                    select option:hover {
                        background-color: #faf5ff !important;
                    }
                    select option:checked {
                        background-color: #8b5cf6 !important;
                        color: white !important;
                    }
                `;
                document.head.appendChild(style);
            });
        </script>
    </x-app-layout>