<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="POST" action="{{ route('projects.update', $project->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Name') }}
                            </label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $project->name) }}"
                                required
                                autofocus
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300
                                       dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                       focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                       focus:ring-opacity-50"
                            >
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('Description') }}
                            </label>
                            <textarea
                                name="description"
                                id="description"
                                rows="5"
                                required
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300
                                       dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                       focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                       focus:ring-opacity-50"
                            >{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                {{ __('end Date') }}
                            </label>
                            <input
                                type="date"
                                name="end_date"
                                id="end_date"
                                value="{{ old('end_date', $project->end_date ? \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') : '') }}"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300
                                       dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300
                                       focus:border-indigo-300 focus:ring focus:ring-indigo-200
                                       focus:ring-opacity-50"
                            >
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200
                                       border border-transparent rounded-md font-semibold text-xs
                                       text-white dark:text-gray-800 uppercase tracking-widest
                                       hover:bg-gray-700 dark:hover:bg-white
                                       focus:bg-gray-700 dark:focus:bg-white
                                       active:bg-gray-900 dark:active:bg-gray-300
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500
                                       focus:ring-offset-2 dark:focus:ring-offset-gray-800
                                       transition ease-in-out duration-150">
                                {{ __('Update Project') }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
