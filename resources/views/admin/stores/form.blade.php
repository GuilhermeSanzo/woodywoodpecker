<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($store) ? __('Edit Store') : __('Create New Store') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ isset($store) ? route('admin.stores.update', $store) : route('admin.stores.store') }}" method="POST">
                    @csrf
                    @if(isset($store))
                        @method('PUT')
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div class="md:col-span-2">
                            <x-input-label for="name" :value="__('Store Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $store->name ?? '')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Street Type -->
                        <div>
                            <x-input-label for="street_type" :value="__('Street Type (e.g., Ave, St)')" />
                            <x-text-input id="street_type" class="block mt-1 w-full" type="text" name="street_type" :value="old('street_type', $store->street_type ?? '')" required />
                            <x-input-error :messages="$errors->get('street_type')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div>
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $store->address ?? '')" required />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- Number -->
                        <div>
                            <x-input-label for="number" :value="__('Number')" />
                            <x-text-input id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number', $store->number ?? '')" required />
                            <x-input-error :messages="$errors->get('number')" class="mt-2" />
                        </div>

                        <!-- Neighborhood -->
                        <div>
                            <x-input-label for="neighborhood" :value="__('Neighborhood')" />
                            <x-text-input id="neighborhood" class="block mt-1 w-full" type="text" name="neighborhood" :value="old('neighborhood', $store->neighborhood ?? '')" required />
                            <x-input-error :messages="$errors->get('neighborhood')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $store->city ?? '')" required />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- State -->
                        <div>
                            <x-input-label for="state" :value="__('State (2 letters)')" />
                            <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $store->state ?? '')" required maxlength="2" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.stores.index') }}" class="text-gray-600 hover:text-gray-900 mr-4 transition duration-150 ease-in-out">Cancel</a>
                        <x-primary-button>
                            {{ isset($store) ? __('Update Store') : __('Create Store') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
