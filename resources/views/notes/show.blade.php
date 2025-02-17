<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed() ? __('Notes'): __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 dark:text-white">
            <x-alert-success>{{ session('success') }}</x-alert-success>

            <span class="px-2 py-1 border border-indigo-400 bg-indigo-100 rounded font-semibold text-sm">
                {{ $note->notebook->name }}
            </span>

            <div class="flex gap-6">
                @if (!$note->trashed())
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
                            onclick="return confirm('Move note to trash?')">
                            Move to Trash
                        </x-danger-button>
                    </form>
                @else
                    <p class="opacity-70">
                        <strong>
                            Deleted:
                        </strong>
                        {{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form class="ml-auto" action="{{ route('trashed.update', $note) }}" method="post">
                        @method('PUT')
                        @csrf
                        <x-primary-button>Restore Note</x-primary-button>
                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-danger-button
                            onclick="return confirm('Delete permanently? This action cannot be undone')">
                            Delete Forever
                        </x-danger-button>
                    </form>
                @endif
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