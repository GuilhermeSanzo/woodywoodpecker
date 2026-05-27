@section('title', __('Genres'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Genres') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($genres as $genre)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-150 ease-in-out flex flex-col relative">
                        <a href="{{ route('genres.show', $genre) }}" class="absolute inset-0 z-0">
                            <span class="sr-only">View books in {{ $genre->name }}</span>
                        </a>
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="bg-indigo-50 p-3 rounded-full text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 truncate">{{ $genre->name }}</h3>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center relative z-10">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ $genre->books->count() }} {{ \Illuminate\Support\Str::plural('Book', $genre->books->count()) }}
                                </span>
                                <span class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">Browse &rarr;</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 italic">No genres found in our records.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $genres->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
