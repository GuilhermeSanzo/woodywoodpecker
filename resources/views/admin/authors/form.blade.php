<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($author) ? __('Edit Author') : __('Create New Author') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($author) ? route('admin.authors.update', $author) : route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($author))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $author->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Pseudonym -->
                        <div>
                            <x-input-label for="pseudonym" :value="__('Pseudonym')" />
                            <x-text-input id="pseudonym" class="block mt-1 w-full" type="text" name="pseudonym" :value="old('pseudonym', $author->pseudonym ?? '')" />
                            <x-input-error :messages="$errors->get('pseudonym')" class="mt-2" />
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <x-input-label for="birth_date" :value="__('Birth Date')" />
                            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date', isset($author) ? $author->birth_date->format('Y-m-d') : '')" required />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                        </div>

                        <!-- Death Date -->
                        <div>
                            <x-input-label for="death_date" :value="__('Death Date')" />
                            <x-text-input id="death_date" class="block mt-1 w-full" type="date" name="death_date" :value="old('death_date', isset($author) && $author->death_date ? $author->death_date->format('Y-m-d') : '')" />
                            <x-input-error :messages="$errors->get('death_date')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div class="md:col-span-2">
                            <x-input-label for="image" :value="__('Author Image')" />
                            @if(isset($author) && $author->image)
                                <div class="mb-2">
                                    <img src="{{ str_starts_with($author->image, 'http') ? $author->image : asset($author->image) }}" alt="{{ $author->name }}" class="h-20 w-20 object-cover rounded shadow-sm border border-gray-200">
                                </div>
                            @endif
                            <input id="image" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" type="file" name="image" />
                            <p class="text-xs text-gray-500 mt-1">Recommended size: 300x300. Max size: 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('description', $author->description ?? '') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.authors.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150 ease-in-out">Cancel</a>
                        <x-primary-button>
                            {{ isset($author) ? __('Update Author') : __('Create Author') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
