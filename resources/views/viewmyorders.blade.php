<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr class="border-b border-gray-300">
                                    <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Receiver Address</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Receiver Phone</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Order Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold ">Order Image</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold">Order Status</th>

                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($orders as $index => $order)
                                    <tr class="border-b border-gray-200 ">
                                        <td class="px-4 py-3 text-left text-sm font-semibold">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3 text-left text-sm font-semibold">
                                            {{ $order->receiver_address }}
                                        </td>
                                        <td class="px-4 py-3 text-left text-sm font-semibold">
                                            {{ $order->receiver_phone }}
                                        </td>
                                        <td class="px-4 py-3 text-left text-sm font-semibold">
                                            @foreach ($order->items as $item)
                                                <div class="">
                                                    {{ $item->product->product_title }}
                                                    @if (!$loop->last)
                                                        ,
                                                    @endif
                                                </div>
                                            @endforeach
                                        </td>

                                        <td class="px-4 py-3 text-left text-sm font-semibold w-[160px] min-w-[160px]">
                                            <div class="grid grid-cols-3 gap-1 w-full">
                                                @foreach ($order->items as $item)
                                                    <img src="{{ asset('products/' . $item->product->product_image) }}"
                                                        class="w-10 h-10 object-cover rounded border border-gray-200"
                                                        alt="{{ $item->product->product_title }}">
                                                @endforeach
                                            </div>
                                        </td>

                                        <td class="px-4 py-3 text-left text-md font-semibold">
                                            {{ $order->status }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-6 text-gray-500">
                                            No orders found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
