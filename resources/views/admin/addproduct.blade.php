@extends('admin.maindesign')


@section('add_product')
    @if (session('product_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('product_message') }}
        </div>
    @endif
    <div class="container-fluid">

        <form method="POST" action="{{ route('admin.postaddproduct') }}" class="flex flex-col gap-2 "
            enctype="multipart/form-data">
            @csrf
            <input type="text" name="product_title" placeholder="Enter Product Title!">
            <textarea name="product_description" id="" placeholder="Product Description!..."></textarea>
            <input type="number" name="product_quantity" placeholder="Enter Product Quantity!" min="1">
            <input type="number" name="product_price" placeholder="Enter Product Price!" min="1">
            <input type="file" name="product_image" />
            <select name="product_category">
                @foreach ($categories as $category)
                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                @endforeach
            </select>
            <button type="submit" class="border bg-white p-2 ">Add Product</button>
        </form>
    </div>
@endsection
