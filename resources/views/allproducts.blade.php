@extends('maindesign')

@section('all_products')
    <div class="container mx-auto px-4 py-10">

        <h2 class="text-3xl font-bold text-center mb-10">
            All Products
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($products as $product)
                <a href="{{ route('product_details', $product->id) }}"
                    class="group bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                    {{-- Image --}}
                    <div class="bg-gray-100 flex items-center justify-center h-56">
                        <img src="{{ asset('products/' . $product->product_image) }}" alt="{{ $product->product_title }}"
                            class="max-h-44 object-contain group-hover:scale-105 transition">
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-2 truncate">
                            {{ $product->product_title }}
                        </h3>

                        <div class="flex items-center justify-between mb-3">
                            <span class="text-pink-500 font-bold text-lg">
                                ฿{{ number_format($product->product_price) }}
                            </span>

                            <span class="text-xs bg-gray-200 px-2 py-1 rounded-full">
                                {{ $product->product_category }}
                            </span>
                        </div>

                        <button
                            class="w-full bg-pink-500 text-white py-2 rounded-lg text-sm
                               hover:bg-pink-600 transition">
                            View Details
                        </button>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-10 flex justify-center">
            {{ $products->links('pagination::tailwind') }}

        </div>

    </div>
@endsection
