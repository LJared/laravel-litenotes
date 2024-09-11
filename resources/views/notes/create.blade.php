<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <div class="my-6 p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-900 shadow-sm sm:rounded-lg">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    <x-text-input field="title" type="text" name="title" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title')"></x-text-input>
                    <x-textarea field="text" name="text" rows="10" placeholder="Start typing..." class="w-full" autocomplete="off" :value="@old('text')"></x-textarea>
                    <div>
                        <label for="notebook_id">{{ __('Notebook') }}</label>
                        <select name="notebook_id" id="notebook_id" class="form-select">
                            <option value="">{{ __('Select a notebook') }}</option>
                            @foreach ($notebooks as $notebook)
                                <option value="{{ $notebook->id }}" {{ isset($note) && $note->notebook_id == $notebook->id ? 'selected' : '' }}>
                                    {{ $notebook->name }} <!-- Value for displaying records -->
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>