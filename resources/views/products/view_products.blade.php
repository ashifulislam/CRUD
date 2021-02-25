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
                @endif
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
{{--                {{route('approveCandidates',[$singleCandidate->candidate_id])}}--}}
                <td><a href="{{route('products.edit',[$single_product->id])}}">EDIT</a></td>
                <td><a href="{{route('products.destroy',[$single_product->id])}}">DELETE</a> </td>
            </tr>
            @endforeach

            </tbody>

        </table>


@endsection
