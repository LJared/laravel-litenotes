<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notebook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 dark:text-white">
            <div class="my-6 p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-900 shadow-sm sm:rounded-lg">     
                <form action="{{ route('notebooks.store') }}" method="POST">
                    @csrf
                    <x-text-input field="name" type="text" name="name" placeholder="Name" class="w-full" autocomplete="off" :value="@old('name')"></x-text-input>
                    <x-primary-button class="mt-6">Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>