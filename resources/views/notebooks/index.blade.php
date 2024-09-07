<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notebooks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">

            <x-link-button href="{{ route('notebooks.create') }}">
                + New notebook
            </x-link-button>

            @forelse ($notebooks as $notebook)
                <div class="my-6 p-6 bg-white border-b border-gray-200 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a href="{{ route('notebooks.show', $notebook) }}" class="hover:underline">{{ $notebook->name }}</a>
                    </h2>
                    <span class="block mt-4 text-sm opacity-70">{{ $notebook->created_at->diffForHumans() }}</span>
                </div>
            @empty
            <p>You don't have any notebooks.</p>
            @endforelse

            {{ $notebooks->links() }}
        </div>
    </div>
</x-app-layout>