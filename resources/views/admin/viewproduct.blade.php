@extends('admin.maindesign')

@section('view_product')
    <form id="searchForm" action="{{ route('admin.searchproduct') }}" method="GET">
        @csrf
        <div class="form-group rounded-full bg-white w-[400px] flex justify-between ">
            <input type="text" name="search" class="border-0 w-full rounded-l-full"
                placeholder="What are you searching for...">
            <button type="submit" class="text-black underline">Search</button>
        </div>
    </form>


    @if (session('deleteproduct_message'))
        <div class="p-3 mb-2 bg-danger text-white">
            {{ session('deleteproduct_message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr class="">
                        <td>{{ $product->id }}</td>

                        <td>
                            <img src="{{ asset('products/' . $product->product_image) }}" width="70" class="rounded"
                                alt="product image">
                        </td>

                        <td>{{ $product->product_title }}</td>

                        <td>
                            <span class="badge bg-danger">
                                {{ $product->product_category }}
                            </span>
                        </td>

                        <td style="max-width: 250px;">
                            {{ Str::limit($product->product_description, 80) }}
                        </td>

                        <td>{{ number_format($product->product_price) }}</td>

                        <td>{{ $product->product_quantity }}</td>

                        <td class="align-middle">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('admin.updateproduct', $product->id) }}"
                                    class="btn bg-blue-500 text-white">update</a>

                                <form method="POST" action="{{ route('admin.deleteproduct', $product->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach

                {{ $products->links() }}
            </tbody>
        </table>
    </div>
@endsection
