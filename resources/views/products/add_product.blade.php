@extends('layouts_of_products.master')
@section('content')
<body>
<form name="add_product" enctype="multipart/form-data" method="post" action="{{route('products.store')}}">
    @csrf
    <div class="col-md-4 col-md-offset-4">
        <div class="form-group">
            <h1>Add Product</h1>
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="description">Description</label>
            <textarea type="text" class="form-control" name="description" id="description" rows="5" cols="50"></textarea>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" class="form-control" id="price" placeholder="Enter price">
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="image">Upload Image</label>
            <input type="file" name="image" class="form-control-file" id="image">
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @if(session('choose_file'))
            <div class="alert alert-danger"> {{ Session::get('choose_file') }}</div>
        @endif
        <button type="submit" class="btn btn-primary">ADD</button>
    </div>
</form>
</body>
@endsection
