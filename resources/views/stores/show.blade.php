@section('title', $store->name)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $store->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('stores.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to Stores') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 md:p-12">
                    <div class="flex flex-col md:flex-row gap-12">
                        <!-- Store Info -->
                        <div class="md:w-1/2">
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $store->name }}</h1>
                            
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <div class="bg-indigo-50 p-2 rounded text-indigo-600 mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <circle cx="12" cy="11" r="3" stroke="currentColor" stroke-width="2" fill="none"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Address') }}</h4>
                                        <p class="text-lg text-gray-700">
                                            {{ $store->street_type }} {{ $store->address }}, {{ $store->number }}<br>
                                            {{ $store->neighborhood }}<br>
                                            {{ $store->city }} - {{ $store->state }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <div class="bg-indigo-50 p-2 rounded text-indigo-600 mt-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">{{ __('Hours') }}</h4>
                                        <p class="text-lg text-gray-700">
                                            Monday - Friday: 09:00 - 18:00<br>
                                            Saturday: 09:00 - 13:00<br>
                                            Sunday: Closed
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map Placeholder -->
                        <div class="md:w-1/2">
                            <div class="bg-gray-100 rounded-lg h-64 md:h-full flex items-center justify-center border border-gray-200">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                                    </svg>
                                    <p class="text-gray-500 font-medium italic">{{ __('Map location coming soon') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
