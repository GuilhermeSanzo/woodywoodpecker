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
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-150 ease-in-out">
                        <div class="aspect-square overflow-hidden">
                            <img src="{{ $author->image ? (str_starts_with($author->image, 'http') ? $author->image : asset($author->image)) : asset('uploads/imagem_padrao.jpg') }}" alt="{{ $author->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 truncate">{{ $author->name }}</h3>
                            @if($author->pseudonym)
                                <p class="text-sm text-gray-500 italic">({{ $author->pseudonym }})</p>
                            @endif
                            <div class="mt-4">
                                <a href="{{ route('authors.show', $author) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View Profile &rarr;</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">No authors found.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $authors->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
