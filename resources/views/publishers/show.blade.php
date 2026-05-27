@section('title', $publisher->name)
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Publisher') }}: {{ $publisher->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('publishers.index') }}" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    {{ __('Back to Publishers') }}
                </a>
            </div>

            <div class="mb-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-6 border-l-4 border-indigo-600 pl-4">{{ __('Books published by') }} {{ $publisher->name }}</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($publisher->books as $book)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col hover:shadow-md transition-shadow duration-200 border border-gray-100">
                            <div class="p-6 flex-grow">
                                @if($book->image)
                                    <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-64 object-cover mb-4 rounded shadow-sm">
                                @else
                                    <div class="w-full h-64 bg-gray-50 mb-4 rounded flex items-center justify-center text-gray-400 italic">
                                        No image
                                    </div>
                                @endif
                                
                                <h4 class="text-lg font-bold text-gray-900 mb-1 leading-tight">{{ $book->title }}</h4>
                                <p class="text-sm text-gray-600 mb-4 italic">{{ $book->author?->pseudonym ?? ($book->author?->name ?? 'Unknown Author') }}</p>
                            </div>
                            
                            <div class="p-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-lg font-bold text-indigo-600">
                                    ${{ number_format($book->price, 2) }}
                                </span>
                                <a href="{{ route('books.show', $book) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">
                                    {{ __('View Details') }} &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center text-gray-500 italic border border-gray-100">
                            {{ __('No books listed for this publisher yet.') }}
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
