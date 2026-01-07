@extends('maindesign')
<base href="/public">

@section('product_details')
    @if (session('cart_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('cart_message') }}
        </div>
    @endif
    <!-- Product Detail -->
    <section class="max-w-6xl mx-auto bg-white mt-10 p-10 rounded-xl shadow">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Image -->
            <div class="bg-gray-100 flex items-center justify-center rounded-lg p-10">
                <img src="{{ asset('products/' . $product->product_image) }}" alt="Product" class="max-h-80">
            </div>

            <!-- Info -->
            <div>
                <span
                    class="inline-block bg-pink-500 text-white text-xs px-3 py-1 rounded-full mb-4">{{ $product->product_category }}</span>
                <h2 class="text-3xl font-bold mb-4">{{ $product->product_title }}</h2>
                <p class="text-gray-600 mb-6">
                    {{ $product->product_description }}
                </p>

                <div class="text-2xl font-semibold text-pink-500 mb-6">${{ $product->product_price }}</div>

                <div class="flex items-center gap-4 mb-6">
                    <input type="number" value="1" min="1" class="w-20 border rounded px-3 py-2">
                    <a href="{{ route('add_to_cart', $product->id) }}">

                        <button class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded">
                            Add To Cart
                        </button>
                    </a>
                </div>

                <ul class="text-sm text-gray-600 space-y-2">
                    <li><strong>Category:</strong> {{ $product->product_category }}</li>
                    <li><strong>Availability:</strong> In Stock</li>
                    <li><strong>Shipping:</strong> Free Shipping</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Description -->
    <section class="max-w-6xl mx-auto mt-10 bg-white p-10 rounded-xl shadow">
        <h3 class="text-xl font-semibold mb-4">Product Description</h3>
        <p class="text-gray-600 leading-relaxed">
            {{ $product->product_description }}
        </p>
    </section>
@endsection
