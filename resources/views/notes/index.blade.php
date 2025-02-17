<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes'): __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <x-alert-success>{{ session('success') }}</x-alert-success>

            @if (request()->routeIs('notes.index'))
                <x-link-button href="{{ route('notes.create') }}">
                    + New note
                </x-link-button>
            @endif

            @forelse ($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-2xl">
                        <a 
                            @if (request()->routeIs('notes.index'))
                            href="{{ route('notes.show', $note) }}"
                            @else
                            href="{{ route('trashed.show', $note) }}"
                            @endif                            
                            class="hover:underline">{{ $note->title }}</a>
                    </h2>
                    <p class="mt-2">{{ Str::limit($note->text, 200) }}</p>
                    <span class="block mt-4 text-sm opacity-70">{{ $note->created_at->diffForHumans() }}</span>
                </div>
            @empty
            <p>You don't have any notes.</p>
            @endforelse

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>