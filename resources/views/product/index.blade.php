@extends('layouts.app')
@section('content')
    <div class="container">
    <div class="row">
    @if(Auth()->user()->access_list->add == 1)
    <a href="{{route('product.create')}}">Add Product</a>
    @else
    @endif
    </div>
        <table class="table text-center">
        @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
            <thead class="dark-color">
                <tr>
                    <th>Sr. no.</th>
                    <th>Product name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table table-bordered">
                @if(count($products)>0)
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $no++}}</td>
                            <td>{{ $product->product_name }}</td>
                            <td><img src="{{ asset('storage/product/images/' . $product->image) }}" alt="Image" width="100px" hight="100px"></td>
                            <td>{{ $product->description }}
                            </td>
                            <td>
                            @if(Auth()->user()->access_list->edit == 1)
                            <a class="btn btn-success" href="{{ route('product.edit', $product->id)}}">Edit</a>
                             @else
                             @endif
                             @if(Auth()->user()->access_list->view == 1)
                            <a class="btn btn-primary" href="{{ route('product.show', $product->id)}}">View</a>
                            @else
                            @endif
                            @if(Auth()->user()->access_list->delete == 1)
                            <a class="btn btn-danger" href="{{ route('product.destroy', $product->id)}}"  onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                            @else
                            @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6"> No record found</td>
                    </tr>
                @endif
            </tbody>
        </table> 
    </div>   
@endsection