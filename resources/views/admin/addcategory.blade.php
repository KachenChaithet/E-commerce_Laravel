@extends('admin.maindesign')


@section('add_category')
    <div class="container-fluid">
        <form method="POST" action="">
            <input type="text" name="category">
            <input type="submit" name="submit" value="Add Category">
        </form>
    </div>
@endsection