<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-indigo-900 overflow-hidden">
        <div class="absolute inset-0">
            @php
                $heroImage = file_exists(public_path('uploads/fundo.jpg')) ? asset('uploads/fundo.jpg') : null;
            @endphp
            @if($heroImage)
                <img class="w-full h-full object-cover opacity-30" src="{{ $heroImage }}" alt="Woody Woodpecker Hero">
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-transparent"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Woody Woodpecker</h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl">
                Discover your next favorite story in our curated collection of classical and modern literature. From the depths of Middle-earth to the magical halls of Hogwarts.
            </p>
            <div class="mt-10 flex space-x-4">
                <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 transition duration-150 ease-in-out">
                    Browse Collection
                </a>
            </div>
        </div>
    </div>

    <!-- Books of the Month -->
    <div class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Books of the Month</h2>
                    <p class="mt-2 text-lg text-gray-500 italic">Our editors' top picks for this season.</p>
                </div>
                <a href="{{ route('books.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-900 transition duration-150">
                    View All Books &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @forelse ($booksOfTheMonth as $item)
                    @if($item->book)
                        <div class="bg-white overflow-hidden shadow-lg rounded-xl flex flex-col border border-gray-100 transform hover:-translate-y-1 transition duration-300 relative">
                            <a href="{{ route('books.show', $item->book) }}" class="absolute inset-0 z-0">
                                <span class="sr-only">View {{ $item->book->title }}</span>
                            </a>
                            <div class="p-4 bg-white flex-grow">
                                @if($item->book->image)
                                    <img src="{{ asset($item->book->image) }}" alt="{{ $item->book->title }}" class="w-full h-72 object-cover mb-4 rounded-lg shadow-sm">
                                @endif
                                
                                <h3 class="text-lg font-bold text-gray-900 mb-1 leading-tight">{{ $item->book->title }}</h3>
                                <p class="text-sm text-indigo-600 font-medium mb-3">
                                    {{ $item->book->author?->pseudonym ?? ($item->book->author?->name ?? 'Unknown Author') }}
                                </p>
                                
                                <div class="text-xs text-gray-500 flex items-center">
                                    <span class="bg-gray-100 px-2 py-1 rounded">{{ $item->book->genre?->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            
                            <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center relative z-10">
                                <span class="text-xl font-black text-indigo-700">
                                    ${{ number_format($item->book->price, 2) }}
                                </span>
                                <form action="{{ route('cart.add', $item->book) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="p-2 {{ isset(session('cart', [])[$item->book->id]) ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white rounded-full transition duration-150">
                                        @if(isset(session('cart', [])[$item->book->id]))
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        @endif
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400 italic">
                        No featured books this month.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Featured Authors -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-12 text-center underline decoration-indigo-500 decoration-4 underline-offset-8">Featured Authors</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse ($featuredAuthors as $item)
                    @if($item->author)
                        <div class="flex items-center space-x-6 group">
                            <div class="flex-shrink-0">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-indigo-600 rounded-full transform group-hover:scale-110 transition duration-300 opacity-0 group-hover:opacity-20"></div>
                                    @if($item->author->image)
                                        <img class="h-24 w-24 rounded-full object-cover shadow-md border-2 border-white" src="{{ asset($item->author->image) }}" alt="{{ $item->author->name }}">
                                    @else
                                        <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition duration-150">
                                    <a href="{{ route('authors.show', $item->author) }}">{{ $item->author->name }}</a>
                                </h3>
                                <p class="text-indigo-600 text-sm font-semibold mb-2">{{ $item->author->pseudonym }}</p>
                                <p class="text-gray-500 text-sm line-clamp-2 italic">
                                    {{ $item->author->description }}
                                </p>
                            </div>
                        </div>
                    @endif
                @empty
                    <div class="col-span-full text-center py-12 text-gray-400 italic">
                        No authors featured at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
