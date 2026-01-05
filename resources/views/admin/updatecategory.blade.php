@extends('admin.maindesign')

<base href="/public">
@section('update_category')
    @if (session('category_updated_message'))
        <div class="mb-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative">
            {{ session('category_updated_message') }}
        </div>
    @endif
    <div class="container-fluid">

        <form method="POST" action="{{ route('admin.postupdatecategory', $category->id) }}">
            @csrf

            <input type="text" name="category" value="{{ $category->category }}">
            <button type="submit" class="border bg-white p-2 ">update Category</button>
    </form>
    </div>
@endsection
