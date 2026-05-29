@section('title', __('Search Results'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results for: ') }} <span class="text-indigo-600">"{{ $query }}"</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Books Results -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Books') }}</h3>
                @if($books->isNotEmpty())
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($books as $book)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col border border-gray-200 hover:shadow-md transition-shadow duration-300 relative">
                                <a href="{{ route('books.show', $book) }}" class="absolute inset-0 z-0">
                                    <span class="sr-only">View {{ $book->full_title }}</span>
                                </a>
                                <div class="p-6 flex-grow">
                                    @if($book->image)
                                        <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->full_title }}" class="w-full h-48 object-cover mb-4 rounded shadow-sm">
                                    @else
                                        <div class="w-full h-48 bg-gray-100 mb-4 rounded flex items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                        </div>
                                    @endif

                                    <h3 class="font-semibold text-lg text-gray-900 mb-1 leading-tight">{{ $book->full_title }}</h3>
                                    <p class="text-sm text-gray-600 mb-4 italic">{{ $book->author?->pseudonym ?? ($book->author?->name ?? 'Unknown Author') }}</p>
                                    
                                    <div class="flex justify-between items-center mt-auto">
                                        <span class="text-xl font-bold text-indigo-700">
                                            ${{ number_format($book->price, 2) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="p-6 pt-0 relative z-10">
                                    <form action="{{ route('cart.add', $book) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 {{ isset(session('cart', [])[$book->id]) ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-indigo-600 hover:bg-indigo-700' }} border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 {{ $book->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                            {{ isset(session('cart', [])[$book->id]) ? __('✓ In Cart') : __('Add to Cart') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-100">
                        <p class="text-gray-500 italic">{{ __('No books found matching your search.') }}</p>
                    </div>
                @endif
            </div>

            <!-- Authors Results -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Authors') }}</h3>
                @if($authors->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($authors as $author)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-150 ease-in-out flex flex-col relative">
                                <a href="{{ route('authors.show', $author) }}" class="absolute inset-0 z-0">
                                    <span class="sr-only">View {{ $author->name }} profile</span>
                                </a>
                                <div class="aspect-square overflow-hidden bg-gray-100">
                                    @if($author->image)
                                        <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 flex-grow flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 truncate mb-1">{{ $author->name }}</h3>
                                        @if($author->pseudonym && $author->pseudonym !== $author->name)
                                            <p class="text-sm text-indigo-600 italic font-medium">({{ $author->pseudonym }})</p>
                                        @endif
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end items-center relative z-10">
                                        <span class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Profile &rarr;</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-100">
                        <p class="text-gray-500 italic">{{ __('No authors found matching your search.') }}</p>
                    </div>
                @endif
            </div>

            <!-- Genres Results -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Genres') }}</h3>
                @if($genres->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full">
                        @foreach($genres as $genre)
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
                        @endforeach
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-100">
                        <p class="text-gray-500 italic">{{ __('No genres found matching your search.') }}</p>
                    </div>
                @endif
            </div>

            <!-- Publishers Results -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Publishers') }}</h3>
                @if($publishers->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($publishers as $publisher)
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
                        @endforeach
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-100">
                        <p class="text-gray-500 italic">{{ __('No publishers found matching your search.') }}</p>
                    </div>
                @endif
            </div>

            <!-- Stores Results -->
            <div>
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Stores') }}</h3>
                @if($stores->isNotEmpty())
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($stores as $store)
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-150 ease-in-out flex flex-col relative">
                                <a href="{{ route('stores.show', $store) }}" class="absolute inset-0 z-0">
                                    <span class="sr-only">View details for {{ $store->name }}</span>
                                </a>
                                <div class="p-6 flex-grow flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center gap-3 mb-4">
                                            <div class="bg-emerald-50 p-3 rounded-full text-emerald-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-bold text-gray-900 truncate">{{ $store->name }}</h3>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">
                                            <span class="font-medium">{{ $store->street_type }} {{ $store->address }}, {{ $store->number }}</span><br>
                                            {{ $store->neighborhood }}, {{ $store->city }} - {{ $store->state }}
                                        </p>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-end items-center relative z-10">
                                        <span class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Details &rarr;</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8 text-center border border-gray-100">
                        <p class="text-gray-500 italic">{{ __('No stores found matching your search.') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
