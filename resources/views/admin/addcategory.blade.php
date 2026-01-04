@extends('admin.maindesign')


@section('add_category')
    @if (session('category_message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('category_message') }}     
        </div>
    @endif
    <div class="container-fluid">
        
        <form method="POST" action="{{ route('admin.postaddcategory') }}">
            @csrf
            <input type="text" name="category" placeholder="Enter Category Name!">
            <button type="submit" class="border bg-white p-2 ">Add Category</button>
        </form>
    </div>
@endsection