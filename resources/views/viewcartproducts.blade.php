@extends('maindesign')

@section('viewcart_products')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">My Cart ({{ $count }})</h1>

        @if ($cart->isEmpty())
            <p class="text-gray-500">Your cart is empty.</p>
        @else
            <div class="overflow-x-auto w-full">
                <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 text-left border-b">#</th>
                            <th class="py-2 px-4 text-left border-b">Product Title</th>
                            <th class="py-2 px-4 text-left border-b">Product Image</th>
                            <th class="py-2 px-4 text-left border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 border-b">{{ $index + 1 }}</td>
                                <td class="py-2 px-4 border-b">{{ $item->product->product_title }}</td>
                                <td class="py-2 px-4 border-b">
                                    <img src="{{ asset('products/' . $item->product->product_image) }}"
                                        class="h-20 w-20 object-cover" alt="">
                                </td>
                                <td class="py-2 px-4 border-b">
                                    <a href="{{ route('removecartproducts', $item->id) }}">
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remove</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

@endsection
