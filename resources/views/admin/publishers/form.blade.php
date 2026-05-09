<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($publisher) ? __('Edit Publisher') : __('Create New Publisher') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($publisher) ? route('admin.publishers.update', $publisher) : route('admin.publishers.store') }}" method="POST">
                    @csrf
                    @if(isset($publisher))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $publisher->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.publishers.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150 ease-in-out">Cancel</a>
                        <x-primary-button>
                            {{ isset($publisher) ? __('Update Publisher') : __('Create Publisher') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
