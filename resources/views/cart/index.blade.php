<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shopping Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6">
                    @if(count($cart) > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200">
                                        <th class="py-4 px-2 font-bold uppercase text-sm text-gray-700">Product</th>
                                        <th class="py-4 px-2 font-bold uppercase text-sm text-gray-700 text-center">Quantity</th>
                                        <th class="py-4 px-2 font-bold uppercase text-sm text-gray-700 text-right">Price</th>
                                        <th class="py-4 px-2 font-bold uppercase text-sm text-gray-700 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart as $id => $item)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-colors">
                                            <td class="py-4 px-2">
                                                <div class="flex items-center">
                                                    @if(isset($item['image']))
                                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['title'] }}" class="w-12 h-16 object-cover rounded mr-4 shadow-sm">
                                                    @endif
                                                    <span class="font-semibold text-gray-900">{{ $item['title'] }}</span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-2 text-center text-gray-700">
                                                {{ $item['quantity'] }}
                                            </td>
                                            <td class="py-4 px-2 text-right text-gray-700">
                                                ${{ number_format($item['price'], 2) }}
                                            </td>
                                            <td class="py-4 px-2 text-right font-bold text-indigo-700">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex flex-col items-end">
                            <div class="bg-gray-50 p-6 rounded-xl border border-gray-100 w-full md:w-80">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-gray-600">Subtotal:</span>
                                    <span class="text-gray-900 font-medium">${{ number_format($totalAmount, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                    <span class="text-lg font-bold text-gray-900">Total:</span>
                                    <span class="text-2xl font-black text-indigo-700">${{ number_format($totalAmount, 2) }}</span>
                                </div>
                                
                                <button class="mt-6 w-full inline-flex justify-center items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Proceed to Checkout') }}
                                </button>
                                
                                <div class="mt-4 text-center">
                                    <a href="{{ route('books.index') }}" class="text-sm text-indigo-600 hover:text-indigo-900 font-medium">
                                        &larr; Continue Shopping
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="mb-4 flex justify-center text-gray-300">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Your cart is empty</h3>
                            <p class="text-gray-500 mb-8 italic">Looks like you haven't added anything to your cart yet.</p>
                            <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                                Browse Catalog
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
