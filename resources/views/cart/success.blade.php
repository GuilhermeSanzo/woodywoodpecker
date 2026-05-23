<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Confirmed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-12 text-center">
                    <div class="mb-6 flex justify-center text-green-500">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Thank you for your purchase!</h2>
                    <p class="text-lg text-gray-600 mb-8">Your order has been placed successfully and is being processed.</p>
                    
                    <div class="inline-block bg-gray-50 border border-gray-200 rounded-lg px-8 py-4 mb-10">
                        <span class="text-sm uppercase tracking-widest text-gray-500 font-bold">Order ID</span>
                        <div class="text-2xl font-black text-indigo-700">#{{ $orderId }}</div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                        <a href="{{ route('books.index') }}" class="inline-flex justify-center items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Continue Shopping
                        </a>
                        <a href="/" class="inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-lg font-bold text-sm text-gray-700 uppercase tracking-widest hover:bg-gray-50 transition ease-in-out duration-150">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
