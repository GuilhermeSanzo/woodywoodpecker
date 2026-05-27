@section('title', __('Books'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col border border-gray-200 hover:shadow-md transition-shadow duration-300 relative">
                        <a href="{{ route('books.show', $book) }}" class="absolute inset-0 z-0">
                            <span class="sr-only">View {{ $book->title }}</span>
                        </a>
                        <div class="p-6 flex-grow">
                            @if($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover mb-4 rounded shadow-sm">
                            @else
                                <div class="w-full h-48 bg-gray-100 mb-4 rounded flex items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                </div>
                            @endif

                            <h3 class="font-semibold text-lg text-gray-900 mb-1 leading-tight">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4 italic">{{ $book->author?->pseudonym ?? ($book->author?->name ?? 'Unknown Author') }}</p>
                            
                            <div class="flex justify-between items-center mt-auto">
                                <span class="text-xl font-bold text-indigo-700">
                                    ${{ number_format($book->price, 2) }}
                                </span>
                                <span class="text-xs {{ $book->stock > 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} px-2 py-1 rounded-full font-medium">
                                    {{ $book->stock > 0 ? 'In Stock (' . $book->stock . ')' : 'Out of Stock' }}
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

            @if($books->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 italic">{{ __('No books found in the catalog.') }}</p>
                </div>
            @endif

            <div class="mt-12">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
