<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Team for Project: ') }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Manager Section --}}
                    <div class="mb-6">
                        <div class="flex justify-between items-center border-b pb-2 mb-4">
                            <h3 class="text-lg font-medium text-gray-900">
                                Project Manager
                            </h3>
                            @if(Auth::user()->role === 'admin')
                                @if($project->team && count($members) < 3)
                                <a href="{{ route('projects.teams.addMemberForm', ['project' => $project]) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Add Member') }}
                                </a>
                                @endif
                            @endif
                        </div>
                        @if($manager)
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="h-10 w-10 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-md font-semibold text-gray-800">{{ $manager->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $manager->email }}</p>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">No manager assigned to this project.</p>
                        @endif
                    </div>

                    {{-- Members Section --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">
                            Team Members
                        </h3>
                        <ul class="divide-y divide-gray-200">
                            @forelse($members as $member)
                                <li class="py-4 flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <svg class="h-10 w-10 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-md font-semibold text-gray-800">{{ $member->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $member->email }}</p>
                                        </div>
                                    </div>
                                    <div class="flex space-x-2">
                                        {{-- Action to Remove Member --}}
                                        <form action="{{ route('projects.teams.removeMember', ['project' => $project, 'member' => $member]) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this member from the team?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 text-xs font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4">
                                    <p class="text-gray-500">No members have been added to this team yet.</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
