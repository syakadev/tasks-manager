
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
        .btn-primary {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
            background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);
        }
        .btn-danger {
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        .slide-in {
            animation: slideIn 0.6s ease-out;
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
        .member-item {
            transition: all 0.3s ease;
        }
        .member-item:hover {
            background-color: #faf5ff;
            transform: translateX(5px);
        }
        .avatar {
            transition: all 0.3s ease;
        }
        .avatar:hover {
            transform: scale(1.1);
        }
    </style>
    <x-app-layout>

            <h2 class="font-semibold text-xl text-purple-700 leading-tight slide-in">
                {{ __('Team for Project: ') }} <span class="text-purple-600">{{ $project->name }}</span>
            </h2>


        <div class="py-8 fade-in">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl card-hover">
                    <div class="p-8">
                        <div class="mb-8">
                            <div class="flex justify-between items-center border-b-2 border-purple-200 pb-4 mb-6">
                                <h3 class="text-xl font-semibold text-purple-800 flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                                    </svg>
                                    Project Manager
                                </h3>
                                @if(Auth::user()->role === 'admin')
                                    @if($project->team && count($members) < 3)
                                    <a href="{{ route('projects.teams.addMemberForm', ['project' => $project]) }}"
                                       class="btn-primary px-6 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Add Member
                                    </a>
                                    @endif
                                @endif
                            </div>
                            @if($manager)
                                <div class="flex items-center space-x-6 p-6 bg-purple-50 rounded-2xl border border-purple-100">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xl avatar">
                                            {{ strtoupper(substr($manager->name, 0, 1)) }}
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-lg font-semibold text-purple-800">{{ $manager->name }}</p>
                                        <p class="text-sm text-purple-600">{{ $manager->email }}</p>
                                        <span class="inline-block mt-2 px-3 py-1 bg-purple-200 text-purple-800 text-xs font-semibold rounded-full">
                                            Manager
                                        </span>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8 bg-purple-50 rounded-2xl border border-purple-100">
                                    <svg class="mx-auto h-12 w-12 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    <p class="mt-4 text-purple-600">No manager assigned to this project.</p>
                                </div>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-xl font-semibold text-purple-800 border-b-2 border-purple-200 pb-4 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Team Members
                            </h3>
                            <ul class="space-y-4">
                                @forelse($members as $member)
                                    <li class="member-item flex items-center justify-between p-6 bg-white rounded-2xl border border-purple-100 shadow-sm">
                                        <div class="flex items-center space-x-6">
                                            <div class="flex-shrink-0">
                                                <div class="w-14 h-14 bg-purple-400 rounded-full flex items-center justify-center text-white font-bold text-lg avatar">
                                                    {{ strtoupper(substr($member->name, 0, 1)) }}
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-md font-semibold text-purple-800">{{ $member->name }}</p>
                                                <p class="text-sm text-purple-600">{{ $member->email }}</p>
                                                <span class="inline-block mt-1 px-2 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">
                                                    Member
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex space-x-3">


                                            @if(Auth::user()->role === 'admin')
                                                {{-- Action to Remove Member --}}
                                                <form action="{{ route('projects.teams.removeMember', ['project' => $project, 'member' => $member]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member from the team?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger px-4 py-2 text-white rounded-lg font-semibold transition-all duration-300 flex items-center"
                                                            title="Remove Member">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                        </svg>
                                                        Remove
                                                    </button>
                                                </form>
                                            @endif

                                        </div>
                                    </li>
                                @empty
                                    <li class="text-center py-12 bg-purple-50 rounded-2xl border border-purple-100">
                                        <svg class="mx-auto h-16 w-16 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-purple-900">No team members yet</h3>
                                        <p class="mt-2 text-sm text-purple-600">Add members to build your project team.</p>
                                        @if(Auth::user()->role === 'admin')
                                            <div class="mt-6">
                                                <a href="{{ route('projects.teams.addMemberForm', ['project' => $project]) }}"
                                                   class="btn-primary px-6 py-3 text-white rounded-xl font-semibold shadow-lg transition-all duration-300 inline-flex items-center">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Add First Member
                                                </a>
                                            </div>
                                        @endif
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card-hover');
                const members = document.querySelectorAll('.member-item');
                const buttons = document.querySelectorAll('.btn-primary, .btn-danger');

                cards.forEach((card, index) => {
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 100);
                });

                members.forEach((member, index) => {
                    setTimeout(() => {
                        member.style.opacity = '1';
                        member.style.transform = 'translateY(0)';
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
