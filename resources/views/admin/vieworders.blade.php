@extends('admin.maindesign')

@section('view_orders')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-6">Orders</h1>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-300">
                <thead>
                    <tr class="border-b border-gray-300">
                        <th class="px-4 py-3 text-left text-sm font-semibold">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Order ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Customer ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Phone</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Products</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Created At</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $index => $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100/20">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">#{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->user_id ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $order->receiver_phone }}</td>

                            <td class="px-4 py-3">
                                <span
                                    class="
                                px-2 py-1 rounded text-xs font-semibold
                                @if ($order->status === 'pending') border border-yellow-500 text-yellow-600
                                @elseif($order->status === 'paid') border border-blue-500 text-blue-600
                                @elseif($order->status === 'completed') border border-green-500 text-green-600
                                @elseif($order->status === 'cancelled') border border-red-500 text-red-600 @endif
                            ">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @foreach ($order->items as $item)
                                    <div class="text-sm">
                                        {{ $item->product->product_title }}
                                    </div>
                                @endforeach
                            </td>


                            <td class="px-4 py-3">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                action
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-500">
                                No orders found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $orders->links() }}
        </div>
    </div>
@endsection
