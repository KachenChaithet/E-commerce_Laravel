@extends('admin.maindesign')


@section('view_category')
    @if (session('deletecategory_message'))
        <div class="p-3 mb-2 bg-danger text-white">
            {{ session('deletecategory_message') }}
        </div>
    @endif
    <table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif;">
        <thead>
            <tr style="background-color:#f2f2f2;">
                <th style="padding:12px; text-align:left; border-bottom:1px solid #ddd;">
                    Category ID
                </th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid #ddd;">
                    Category Name
                </th>
                <th style="padding:12px; text-align:left; border-bottom:1px solid #ddd;">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:12px;">{{ $category->id }}</td>
                    <td style="padding:12px;">{{ $category->category }}</td>
                    <td style="padding:12px;" class="flex  gap-2">
                        <form action="{{ route('admin.categorydelete', $category->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        <form action="{{ route('admin.categoryupdate', $category->id) }}" method="GET" @csrf <button
                            type="submit" class="btn  bg-blue-500 text-white">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
