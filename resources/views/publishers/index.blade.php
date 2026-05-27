@section('title', __('Publishers'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publishers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($publishers as $publisher)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-150 ease-in-out flex flex-col relative">
                        <a href="{{ route('publishers.show', $publisher) }}" class="absolute inset-0 z-0">
                            <span class="sr-only">View books from {{ $publisher->name }}</span>
                        </a>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-amber-50 p-3 rounded-full text-amber-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $publisher->name }}</h3>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center relative z-10">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ $publisher->books->count() }} {{ \Illuminate\Support\Str::plural('Book', $publisher->books->count()) }}
                                </span>
                                <span class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Books &rarr;</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 italic">No publishers found in our records.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $publishers->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
