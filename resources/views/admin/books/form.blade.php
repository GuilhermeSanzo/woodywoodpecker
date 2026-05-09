<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($book) ? __('Edit Book') : __('Create New Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($book) ? route('admin.books.update', $book) : route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($book))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Title -->
                        <div class="md:col-span-2">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $book->title ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <!-- Subtitle -->
                        <div class="md:col-span-2">
                            <x-input-label for="subtitle" :value="__('Subtitle')" />
                            <x-text-input id="subtitle" class="block mt-1 w-full" type="text" name="subtitle" :value="old('subtitle', $book->subtitle ?? '')" />
                            <x-input-error :messages="$errors->get('subtitle')" class="mt-2" />
                        </div>

                        <!-- Author -->
                        <div>
                            <x-input-label for="author_id" :value="__('Author')" />
                            <select id="author_id" name="author_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select an Author</option>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id ?? '') == $author->id ? 'selected' : '' }}>
                                        {{ $author->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('author_id')" class="mt-2" />
                        </div>

                        <!-- Genre -->
                        <div>
                            <x-input-label for="genre_id" :value="__('Genre')" />
                            <select id="genre_id" name="genre_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Genre</option>
                                @foreach($genres as $genre)
                                    <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id ?? '') == $genre->id ? 'selected' : '' }}>
                                        {{ $genre->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('genre_id')" class="mt-2" />
                        </div>

                        <!-- Publisher -->
                        <div>
                            <x-input-label for="publisher_id" :value="__('Publisher')" />
                            <select id="publisher_id" name="publisher_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Publisher</option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>
                                        {{ $publisher->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('publisher_id')" class="mt-2" />
                        </div>

                        <!-- Distributor -->
                        <div>
                            <x-input-label for="distributor_id" :value="__('Distributor')" />
                            <select id="distributor_id" name="distributor_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Select a Distributor</option>
                                @foreach($distributors as $distributor)
                                    <option value="{{ $distributor->id }}" {{ old('distributor_id', $book->distributor_id ?? '') == $distributor->id ? 'selected' : '' }}>
                                        {{ $distributor->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('distributor_id')" class="mt-2" />
                        </div>

                        <!-- Price -->
                        <div>
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" step="0.01" name="price" :value="old('price', $book->price ?? '')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div>
                            <x-input-label for="image" :value="__('Book Cover Image')" />
                            @if(isset($book) && $book->image)
                                <div class="mb-2">
                                    <img src="{{ str_starts_with($book->image, 'http') ? $book->image : asset($book->image) }}" alt="{{ $book->title }}" class="h-20 w-20 object-cover rounded shadow-sm border border-gray-200">
                                </div>
                            @endif
                            <input id="image" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="image" />
                            <p class="text-xs text-gray-500 mt-1">Max size: 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $book->description ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.books.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150 ease-in-out">Cancel</a>
                        <x-primary-button>
                            {{ isset($book) ? __('Update Book') : __('Create Book') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
