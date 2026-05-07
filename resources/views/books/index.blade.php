<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($books as $book)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <div class="p-6 bg-white border-b border-gray-200 flex-grow">
                            @if($book->image)
                                <img src="{{ asset($book->image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover mb-4 rounded">
                            @endif
                            
                            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $book->title }}</h3>
                            
                            @if($book->subtitle)
                                <p class="text-sm text-gray-600 mb-2 italic">{{ $book->subtitle }}</p>
                            @endif

                            <div class="text-sm text-gray-700 space-y-1">
                                <p><span class="font-semibold">Author:</span> {{ $book->author?->pseudonym ?? $book->author?->name ?? 'Unknown' }}</p>
                                <p><span class="font-semibold">Genre:</span> {{ $book->genre?->name ?? 'Unknown' }}</p>
                                <p><span class="font-semibold">Publisher:</span> {{ $book->publisher?->name ?? 'Unknown' }}</p>
                            </div>
                        </div>
                        
                        <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                            <span class="text-lg font-bold text-indigo-600">
                                ${{ number_format($book->price, 2) }}
                            </span>
                            <a href="{{ route('books.show', $book) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                                View Details &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($books->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center text-gray-500">
                    No books found in our collection yet.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
