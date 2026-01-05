@extends('admin.maindesign')

@section('view_product')
    @if (session('deletecategory_message'))
        <div class="p-3 mb-2 bg-danger text-white">
            {{ session('deletecategory_message') }}
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
                    <tr>
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

                        <td class="d-flex gap-2">
                            <a href="#" class="btn btn-sm bg-blue-500 text-white">Edit</a>

                            <form method="POST" action="#">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                {{ $products->links() }}
            </tbody>
        </table>
    </div>
@endsection
