@extends('layouts_of_products.master')
@section('content')
    <h1 style="text-align:center">View Products</h1>
    <div>
        <table id="example" class="table table-striped table-bordered" style="width:80%;margin-left:120px;">
            <thead>
            @if(session('Success'))
                <div class="alert alert-success"> {{ Session::get('Success') }}</div>
            @elseif(session('Delete'))
                <div class="alert alert-danger">{{Session::get('Delete')}}</div>
                 @elseif(session('Update'))
                <div class="alert alert-danger">{{Session::get('Update')}}</div>
                @endif
            <a href="{{route('products.create')}}" style="margin-left:120px;">Add New Product</a>
            <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>DESCRIPTION</th>
                <th>PRICE</th>
                <th>IMAGE</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $single_product)
            <tr>
                <td>{{$single_product->id}}</td>
                <td>{{$single_product->Title}}</td>
                <td>{{$single_product->Description}}</td>
                <td>{{$single_product->Price}}</td>
                <td>
                    <img src="{{asset('images')}}/{{$single_product->Image}}" style="max-height: 60px;"/>
                </td>
                <td><a href="{{route('products.edit',[$single_product->id])}}">EDIT</a></td>
                <td>
                    <form action="{{route('products.destroy',[$single_product->id])}}" method="post">
                       @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
