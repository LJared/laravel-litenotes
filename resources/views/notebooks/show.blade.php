<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notebook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <div class="flex gap-6">
                <p class="opacity-70">
                    <strong>
                        Created:
                    </strong>
                    {{ $notebook->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70">
                    <strong>
                        Last changed:
                    </strong>
                    {{ $notebook->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $notebook->name }}
                </h2>
            </div>
        </div>
    </div>
</x-app-layout>