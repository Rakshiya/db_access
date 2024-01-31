<x-app-layout>
    <x-slot name="header" class="row">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Selected Table - ').base64_decode($tableName) }}
            </h2>
            <a href="{{ url('/tables') }}"><x-primary-button>{{ __('Back') }}</x-primary-button></a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                
                @include('tables.partials.table-view',['tableName' => base64_decode($tableName)])
                
            </div>

           
        </div>
    </div>
</x-app-layout>