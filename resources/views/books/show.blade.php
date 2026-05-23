<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $book->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('books.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to Books
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-12">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                        <!-- Book Cover -->
                        <div class="md:col-span-1">
                            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-md">
                                @if($book->image)
                                    <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="w-full h-auto object-cover">
                                @else
                                    <div class="w-full h-96 flex items-center justify-center text-gray-400 italic">
                                        No cover available
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Book Details -->
                        <div class="md:col-span-2 flex flex-col">
                            <div class="mb-6">
                                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">{{ $book->title }}</h1>
                                @if($book->subtitle)
                                    <p class="text-xl text-gray-600 italic mb-4">{{ $book->subtitle }}</p>
                                @endif
                                
                                <div class="flex items-center text-lg text-indigo-600 font-semibold mb-6">
                                    <span class="mr-2">by</span>
                                    <a href="{{ $book->author ? route('authors.show', $book->author->id) : '#' }}" class="hover:underline">
                                        {{ $book->author?->pseudonym ?? ($book->author?->name ?? 'Unknown Author') }}
                                    </a>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-6 mb-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Genre</p>
                                    <p class="text-gray-900 font-medium">{{ $book->genre?->name ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Publisher</p>
                                    <p class="text-gray-900 font-medium">{{ $book->publisher?->name ?? 'N/A' }}</p>
                                </div>
                                <div class="col-span-2 flex justify-between items-end">
                                    <div>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Price</p>
                                        <p class="text-2xl font-bold text-indigo-600">${{ number_format($book->price, 2) }}</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm {{ $book->stock > 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} px-3 py-1 rounded-full font-bold border {{ $book->stock > 0 ? 'border-green-100' : 'border-red-100' }}">
                                            {{ $book->stock > 0 ? 'In Stock: ' . $book->stock : 'Out of Stock' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="prose max-w-none text-gray-700 leading-relaxed mb-8 flex-grow">
                                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Synopsis</h2>
                                <p>{{ $book->description }}</p>
                            </div>

                            <div class="flex space-x-4">
                                <form action="{{ route('cart.add', $book) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full {{ isset(session('cart', [])[$book->id]) ? 'bg-emerald-600 hover:bg-emerald-700' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out {{ $book->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $book->stock <= 0 ? 'disabled' : '' }}>
                                        {{ isset(session('cart', [])[$book->id]) ? '✓ In Cart' : 'Add to Cart' }}
                                    </button>
                                </form>
                                <button class="p-3 border border-gray-300 rounded-lg text-gray-500 hover:bg-gray-50 transition duration-150 ease-in-out">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
