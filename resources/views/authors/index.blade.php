@section('title', __('Authors'))
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Our Authors') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($authors as $author)
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
                                <p class="text-xs text-gray-500 mt-2 line-clamp-2">{{ $author->description }}</p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center relative z-10">
                                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    {{ $author->books->count() }} {{ \Illuminate\Support\Str::plural('Book', $author->books->count()) }}
                                </span>
                                <span class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Profile &rarr;</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 italic">No authors found in our records.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $authors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
