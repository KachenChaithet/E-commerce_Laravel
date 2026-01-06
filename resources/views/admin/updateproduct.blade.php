@extends('admin.maindesign')

<base href="/public">

@section('add_product')
    @if (session('updateproduct_message'))
        <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">
            {{ session('updateproduct_message') }}
        </div>
    @endif
    <div class="container-fluid">

        <form method="POST" action="{{ route('admin.postupdateproduct', $product->id) }}" class="flex flex-col gap-2 "
            enctype="multipart/form-data">
            @csrf
            <input type="text" name="product_title" value="{{ $product->product_title }}">
            <textarea name="product_description" id="">{{ $product->product_description }}</textarea>
            <input type="number" name="product_quantity" value="{{ $product->product_quantity }}" min="1">
            <input type="number" name="product_price" value="{{ $product->product_price }}" min="1">
            <input type="file" name="product_image" value="{{ $product->product_image }}" />
            <img class="w-[100px] h-[100px]" src="{{ asset('products/' . $product->product_image) }}" alt="">
            <select name="product_category">
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}"
                        {{ $product->product_category === $category->category ? 'selected' : '' }}>
                        {{ $category->category }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="border bg-white p-2 ">Update Product</button>
        </form>
    </div>
@endsection
