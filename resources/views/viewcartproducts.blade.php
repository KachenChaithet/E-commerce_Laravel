@extends('maindesign')

@section('viewcart_products')
    <div class="container mx-auto p-6 space-y-6">
        <a href="{{ route('index') }}" class=" inline-block cursor-pointer hover:text-black text-gray-600">
            &larr; Go back
        </a>
        @if (session('comfirm_order_message'))
            <div class="p-3 mb-2 bg-blue-500 text-white">
                {{ session('comfirm_order_message') }}
            </div>
        @endif
        <h1 class="text-3xl font-bold mb-6 text-gray-800">My Cart ({{ $count }})</h1>

        @if ($cart->isEmpty())
            <p class="text-gray-500 text-lg">Your cart is empty.</p>
        @else
            <div class="overflow-x-auto w-full shadow-md rounded-lg">
                <table class="min-w-full table-auto bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-3 px-6 text-left border-b text-gray-600 uppercase tracking-wider">#</th>
                            <th class="py-3 px-6 text-left border-b text-gray-600 uppercase tracking-wider">Product Title
                            </th>
                            <th class="py-3 px-6 text-left border-b text-gray-600 uppercase tracking-wider">Product Image
                            </th>
                            <th class="py-3 px-6 text-left border-b text-gray-600 uppercase tracking-wider">Product Price
                            </th>
                            <th class="py-3 px-6 text-left border-b text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @php $price = 0; @endphp
                        @foreach ($cart as $index => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-6 border-b">{{ $index + 1 }}</td>
                                <td class="py-3 px-6 border-b font-medium">{{ $item->product->product_title }}</td>
                                <td class="py-3 px-6 border-b">
                                    <img src="{{ asset('products/' . $item->product->product_image) }}"
                                        class="h-20 w-20 object-cover rounded-lg shadow" alt="">
                                </td>
                                <td class="py-3 px-6 border-b font-medium">
                                    {{ number_format($item->product->product_price) }} ฿</td>
                                <td class="py-3 px-6 border-b">
                                    <form action="{{ route('removecartproducts', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @php $price += $item->product->product_price; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class=" flex justify-between items-center bg-gray-100 p-4 rounded-lg shadow">
                <span class="text-lg font-semibold text-gray-700">Total Price:</span>
                <span class="text-xl font-bold text-green-600">{{ number_format($price) }} ฿</span>
            </div>

            <div class="bg-gray-200 p-4 space-y-4 rounded-md shadow">
                <h1 class="text-2xl font-bold">Shipping Information</h1>
                <form action="{{ route('confirm_order') }}" onsubmit="return confirm('confirm order right?')" method="POST"
                    class="flex flex-col gap-4">
                    @csrf
                    <input type="text" name="receiver_address" class="py-2 pl-2 rounded-md focus:outline-none"
                        placeholder="Enter Your Address" required>
                    <input type="text" name="receiver_phone" class="py-2 pl-2 rounded-md focus:outline-none"
                        placeholder="Enter Your Phone Number" required>
                    <button class="bg-pink-500 w-fit text-white px-2 py-2 rounded-lg font-semibold hover:bg-pink-400"
                        type="submit">Confirm
                        Order</button>
                </form>
            </div>
        @endif
    </div>
@endsection
