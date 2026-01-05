@extends('admin.maindesign')


@section('add_product')
    @if (session('category_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('category_message') }}
        </div>
    @endif
    <div class="container-fluid">

        <form method="POST" action="{{ route('admin.postaddproduct') }}">
            @csrf
            <input type="text" name="product_title" placeholder="Enter Product Title!">
            <textarea name="product_description" id="">
                Product Description!...
            </textarea>
            <input type="number" name="product_quantity" placeholder="Enter Product Quantity!">
            <input type="number" name="product_price" placeholder="Enter Product Price!">
            <section>
                <option value="">a</option>
                <option value="">b</option>
                <option value="">c</option>
            </section>
            <button type="submit" class="border bg-white p-2 ">Add Product</button>
        </form>
    </div>
@endsection
