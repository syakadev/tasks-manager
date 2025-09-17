    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(128, 90, 213, 0.15);
        }
        .btn-transition {
            transition: all 0.2s ease;
        }
        .btn-transition:hover {
            transform: scale(1.05);
        }
        .status-badge {
            transition: all 0.3s ease;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        .slide-in {
            animation: slideIn 0.6s ease-out;
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
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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
        .table-row {
            transition: all 0.3s ease;
        }
        .table-row:hover {
            background-color: #faf5ff;
            transform: translateX(5px);
        }
    </style>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-purple-700 leading-tight slide-in">
                {{ __('Tasks for Project: ') }}<span class="text-purple-600">{{ $project->name }}</span>
            </h2>
        </x-slot>

        <!-- Project Description Card -->
        <div class="py-6 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl card-hover border-l-4 border-purple-500">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-purple-800 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Project Description
                        </h3>
                        <p class="text-gray-700 bg-purple-50 p-4 rounded-lg border border-purple-100">
                            {{ $project->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks Section -->
        <div class="pb-12 fade-in">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl">
                    <div class="p-6">
                        <!-- Header dengan Tombol Create New Task -->
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-purple-800 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                    TASKS
                                </h1>
                                <p class="text-purple-600 mt-2">Manage tasks for this project</p>
                            </div>
                            
                            <!-- Tombol Create New Task (Hanya untuk Admin) -->
                            @if(Auth::user()->role === 'admin')
                            <a href="{{ route('tasks.create', $project->id) }}" 
                               class="btn-primary px-6 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Create New Task
                            </a>
                            @endif
                        </div>

                        @if ($tasks->isEmpty())
                            <div class="text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-purple-900">No tasks yet</h3>
                                <p class="mt-2 text-sm text-purple-600">Get started by creating your first task.</p>
                                @if(Auth::user()->role === 'admin')
                                <div class="mt-6">
                                    <a href="{{ route('tasks.create', $project->id) }}" 
                                       class="btn-primary px-6 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300 inline-flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Create Your First Task
                                    </a>
                                </div>
                                @endif
                            </div>
                        @else
                            <div class="overflow-x-auto rounded-2xl shadow-lg">
                                <table class="min-w-full divide-y divide-purple-200">
                                    <thead class="bg-purple-700">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                    </svg>
                                                    Name
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Description
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Status
                                                </div>
                                            </th>
                                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-white uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-purple-100">
                                        @foreach ($tasks as $task)
                                            <tr class="table-row fade-in">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-purple-900">{{ $task->name }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-sm text-gray-600 max-w-md truncate">{{ $task->description }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'todo' => 'bg-purple-100 text-purple-800',
                                                            'doing' => 'bg-blue-100 text-blue-800',
                                                            'done' => 'bg-green-100 text-green-800',
                                                            'completed' => 'bg-green-100 text-green-800',
                                                            'in progress' => 'bg-yellow-100 text-yellow-800',
                                                            'pending' => 'bg-orange-100 text-orange-800'
                                                        ];
                                                        $color = $statusColors[strtolower($task->status)] ?? 'bg-gray-100 text-gray-800';
                                                    @endphp
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full status-badge {{ $color }}">
                                                        {{ $task->status }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div class="flex justify-end space-x-3">
                                                        <a href="{{ route('projects.tasks.edit', ['project' => $project->id, 'task' => $task->id]) }}" 
                                                           class="text-purple-600 hover:text-purple-900 btn-transition font-semibold"
                                                           title="Edit Task">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2z"></path>
                                                            </svg>
                                                        </a>
                                                        @if(Auth::user()->role === 'admin')
                                                        <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" 
                                                                    class="text-red-600 hover:text-red-900 btn-transition font-semibold"
                                                                    onclick="return confirm('Are you sure you want to delete this task?')"
                                                                    title="Delete Task">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Animasi untuk elemen yang masuk
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card-hover');
                const rows = document.querySelectorAll('tr.fade-in');
                const buttons = document.querySelectorAll('.btn-primary');
                
                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });
                
                rows.forEach((row, index) => {
                    setTimeout(() => {
                        row.style.opacity = '1';
                        row.style.transform = 'translateY(0)';
                    }, index * 50);
                });
                
                buttons.forEach((button, index) => {
                    setTimeout(() => {
                        button.style.opacity = '1';
                        button.style.transform = 'translateY(0)';
                    }, index * 150);
                });
            });
        </script>
    </x-app-layout>