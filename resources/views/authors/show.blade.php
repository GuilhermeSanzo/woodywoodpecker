<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $author->name }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-12">
                <div class="p-6 md:p-12">
                    <div class="flex flex-col md:flex-row gap-12">
                        <!-- Author Image -->
                        <div class="md:w-1/3">
                            <div class="rounded-full overflow-hidden shadow-xl border-4 border-white aspect-square bg-gray-100">
                                @if($author->image)
                                    <img src="{{ asset('storage/' . $author->image) }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 italic">
                                        No image available
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Author Biography -->
                        <div class="md:w-2/3">
                            <div class="mb-6">
                                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $author->name }}</h1>
                                @if($author->pseudonym && $author->pseudonym !== $author->name)
                                    <p class="text-xl text-indigo-600 font-semibold mb-2">Known as: {{ $author->pseudonym }}</p>
                                @endif
                                
                                <p class="text-lg text-gray-500 font-medium">
                                    {{ $author->birth_date?->format('F j, Y') ?? 'Unknown' }} 
                                    @if($author->death_date)
                                        — {{ $author->death_date->format('F j, Y') }}
                                    @endif
                                </p>
                            </div>

                            <div class="prose max-w-none text-gray-700 leading-relaxed mb-8">
                                <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Biography</h2>
                                <p>{{ $author->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Author's Books -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-8 border-l-4 border-indigo-600 pl-4">Books by {{ $author->pseudonym ?? $author->name }}</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($author->books as $book)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col hover:shadow-md transition-shadow duration-200">
                            <div class="p-6 bg-white border-b border-gray-200 flex-grow">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover mb-4 rounded">
                                @endif
                                
                                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $book->title }}</h3>
                                
                                @if($book->subtitle)
                                    <p class="text-sm text-gray-600 mb-2 italic line-clamp-1">{{ $book->subtitle }}</p>
                                @endif

                                <div class="text-sm text-gray-700 space-y-1">
                                    <p><span class="font-semibold">Genre:</span> {{ $book->genre?->name ?? 'N/A' }}</p>
                                    <p><span class="font-semibold">Publisher:</span> {{ $book->publisher?->name ?? 'N/A' }}</p>
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
                    @empty
                        <div class="col-span-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center text-gray-500 italic">
                            No books listed for this author yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
