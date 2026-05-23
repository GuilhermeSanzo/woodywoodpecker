<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Order History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                @forelse ($orders as $order)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                        <div class="p-6">
                            <div class="flex flex-wrap justify-between items-center mb-6 border-b border-gray-100 pb-4">
                                <div>
                                    <span class="text-sm uppercase tracking-widest text-gray-500 font-bold">Order</span>
                                    <div class="text-xl font-black text-indigo-700">#{{ $order->id }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-sm text-gray-500 font-medium">{{ $order->created_at->format('M d, Y') }}</div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 uppercase">
                                        {{ $order->status }}
                                    </span>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Book Title</th>
                                            <th class="px-2 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-2 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Price</th>
                                            <th class="px-2 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900 font-medium">
                                                    {{ $item->book?->title ?? 'Book Deleted' }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-center">
                                                    {{ $item->quantity }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-600 text-right">
                                                    ${{ number_format($item->unit_price, 2) }}
                                                </td>
                                                <td class="px-2 py-4 whitespace-nowrap text-sm text-gray-900 font-bold text-right">
                                                    ${{ number_format($item->unit_price * $item->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-6 flex justify-end">
                                <div class="text-right">
                                    <span class="text-sm text-gray-500 uppercase tracking-widest font-bold">Total Amount</span>
                                    <div class="text-2xl font-black text-indigo-700">${{ number_format($order->total_amount, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-12 text-center border border-gray-200">
                        <div class="mb-4 flex justify-center text-gray-300">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">You have no past orders</h3>
                        <p class="text-gray-500 mb-8 italic">Start your collection today by browsing our catalog!</p>
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                            Browse Catalog
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
