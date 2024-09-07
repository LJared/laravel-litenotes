<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 dark:text-white">
            <x-alert-success>{{ session('success') }}</x-alert-success>
            <div class="flex gap-6">
                <p class="opacity-70">
                    <strong>
                        Created:
                    </strong>
                    {{ $note->created_at->diffForHumans() }}
                </p>
                <p class="opacity-70">
                    <strong>
                        Last changed:
                    </strong>
                    {{ $note->updated_at->diffForHumans() }}
                </p>
                <x-link-button class="ml-auto" href="{{ route('notes.edit', $note) }}">
                    Edit
                </x-link-button>
                <form action="{{ route('notes.destroy', $note) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <x-danger-button
                        onclick="return confirm('Are you sure you want to delete this note?')">
                        Delete
                    </x-danger-button>
                </form>
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 dark:bg-gray-800 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">
                    {{ $note->title }}
                </h2>
                <p class="mt-4 whitespace-pre-wrap">{{ $note->text }}</p>
            </div>
        </div>
    </div>
</x-app-layout>