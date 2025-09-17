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
        .input-field:read-only {
            background-color: #f3e8ff;
            color: #6b7280;
            cursor: not-allowed;
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
        .user-readonly {
            background-color: #faf5ff;
            border-color: #ddd6fe;
            color: #6b7280;
        }
    </style>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-purple-700 leading-tight slide-in">
                {{ __('Edit Task') }} - <span class="text-purple-600">{{ $task->name }}</span>
            </h2>
        </x-slot>

        <div class="py-8 fade-in">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="form-card overflow-hidden rounded-2xl shadow-xl">
                    <div class="p-8">
                        <form method="POST" action="{{ route('projects.tasks.update', [$project->id, $task->id]) }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="name" class="block text-sm font-medium text-purple-800 mb-3">
                                    {{ __('Task Name') }}
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name', $task->name) }}"
                                    required
                                    @if(Auth::user()->role === 'user')
                                        readonly
                                        class="input-field user-readonly w-full px-4 py-3 rounded-xl"
                                    @else
                                        autofocus
                                        class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                    @endif
                                >
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                                @if(Auth::user()->role === 'user')
                                    <p class="mt-2 text-sm text-purple-600">Only admin can edit the task name</p>
                                @endif
                            </div>

                            <div class="mb-6">
                                <label for="description" class="block text-sm font-medium text-purple-800 mb-3">
                                    {{ __('Description') }}
                                </label>
                                <textarea
                                    name="description"
                                    id="description"
                                    rows="4"
                                    class="input-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                >{{ old('description', $task->description) }}</textarea>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="status" class="block text-sm font-medium text-purple-800 mb-3">
                                    {{ __('Status') }}
                                </label>
                                <select
                                    name="status"
                                    id="status"
                                    class="select-field w-full px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500"
                                >
                                    <option value="no" {{ old('status', $task->status) == 'no' ? 'selected' : '' }} class="py-2">❌ No</option>
                                    <option value="yes" {{ old('status', $task->status) == 'yes' ? 'selected' : '' }} class="py-2">✅ Yes</option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600 animate-pulse">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-end mt-8 pt-6 border-t border-purple-100">
                                <button type="submit" 
                                        class="btn-primary px-8 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ __('Update Task') }}
                                    </span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const inputs = document.querySelectorAll('.input-field, .select-field');
                const form = document.querySelector('form');
                
                setTimeout(() => {
                    form.style.opacity = '1';
                    form.style.transform = 'translateY(0)';
                }, 100);
                
                inputs.forEach(input => {
                    if (!input.readOnly) {
                        input.addEventListener('focus', () => {
                            input.parentElement.classList.add('transform', 'translate-y-1');
                        });
                        
                        input.addEventListener('blur', () => {
                            input.parentElement.classList.remove('transform', 'translate-y-1');
                        });
                    }
                });
                
                const statusSelect = document.getElementById('status');
                if (statusSelect) {
                    statusSelect.addEventListener('focus', () => {
                        statusSelect.classList.add('ring-2', 'ring-purple-300');
                    });
                    statusSelect.addEventListener('blur', () => {
                        statusSelect.classList.remove('ring-2', 'ring-purple-300');
                    });
                }
            });
        </script>
    </x-app-layout>