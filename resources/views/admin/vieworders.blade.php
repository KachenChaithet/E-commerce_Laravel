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
                        <th class="px-4 py-3 text-left text-sm font-semibold">Image</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">Actions</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold">PDF</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($orders as $index => $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100/20">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">#{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->user_id ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $order->receiver_phone }}</td>

                            @php
                                $statusClasses = [
                                    'pending' => 'border-yellow-500 text-yellow-600',
                                    'paid' => 'border-blue-500 text-blue-600',
                                    'completed' => 'border-green-500 text-green-600',
                                    'cancelled' => 'border-red-500 text-red-600',
                                ];
                            @endphp
                            <td class="px-4 py-3">

                                <select data-id="{{ $order->id }}"
                                    class="
                                    order-status
                                    px-2 py-1 rounded text-xs font-semibold border {{ $statusClasses[$order->status] ?? '' }}
                                    appearance-none
                                    focus:outline-none focus:ring-1 focus:ring-blue-500
                                    ">
                                    @foreach ($status as $s)
                                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                            {{ ucfirst($s) }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="px-4 py-3">
                                @foreach ($order->items as $item)
                                    <div class="text-sm">
                                        {{ $item->product->product_title }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    </div>
                                @endforeach
                            </td>


                            <td class="px-4 py-3">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-4 py-3 grid grid-cols-3 ">

                                @foreach ($order->items as $item)
                                    <img src="{{ asset('products/' . $item->product->product_image) }}" alt=""
                                        class="w-16 h-16 object-cover ">
                                @endforeach
                            </td>

                            <td class="px-4 py-3 text-center">
                                action
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a class="btn btn-primary font-semibold text-white"
                                    href="{{ route('admin.dowloadpdf',$order->id) }}">Dowload PDF</a>
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
@section('scriptsvieworders')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.order-status').forEach(select => {
                select.addEventListener('change', function() {

                    fetch(`/orders/${this.dataset.id}/status`, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                status: this.value
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                            }
                        });
                });
            });
        });
    </script>
@endsection
