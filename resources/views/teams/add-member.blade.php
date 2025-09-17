<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight 
                   bg-gradient-to-r from-purple-500 to-purple-700 
                   px-4 py-3 rounded-lg shadow-md 
                   transition duration-500 ease-in-out transform hover:scale-[1.01]">
            {{ __('Add Member to Project: ') }} {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12 animate-fadeIn">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg transition duration-500 hover:shadow-2xl hover:scale-[1.01]">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('projects.teams.storeMember', ['project' => $project]) }}" class="space-y-6">
                        @csrf

                        <!-- User Selection -->
                        <div>
                            <label for="user_id" class="block font-medium text-sm text-purple-800">
                                {{ __('Select User') }}
                            </label>
                            <select id="user_id" name="user_id" 
                                    class="block mt-1 w-full border-purple-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm transition duration-300 ease-in-out hover:scale-[1.01]">
                                <option value="">-- Select a user --</option>
                                @foreach ($availableUsers as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('projects.teams.index', $project) }}" 
                               class="text-sm text-purple-600 hover:text-purple-800 mr-4 transition duration-300 ease-in-out hover:underline">
                                {{ __('Cancel') }}
                            </a>

                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 
                                           bg-gradient-to-r from-purple-600 to-purple-700 
                                           border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest
                                           hover:from-purple-700 hover:to-purple-800
                                           transform hover:scale-105 active:scale-95
                                           focus:outline-none focus:border-purple-800 focus:ring ring-purple-300
                                           disabled:opacity-25 transition-all duration-300 ease-in-out">
                                {{ __('Add Member') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Animasi custom --}}
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.6s ease-in-out;
        }
    </style>
</x-app-layout>
