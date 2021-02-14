@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">{{ __('Edit Product') }}
            <div class="ml-auto"> 
                            <a  href="{{route('product.list')}}">Back</a>
                            </div></div>
               
                <div class="card-body">
                    <form method="POST" action="{{ route('product.update' ,$product->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_name" class="mb-0">Product Name</label>
                                    <input id="product_name" type="text" class="form-control custom-textbox @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}" required autocomplete="product_name" placeholder="Enter product name">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                <img src="{{ asset('storage/product/images/' . $product->image) }}" alt="Image" width="100px" hight="100px">
                                    <label for="image" class="mb-0">Image</label>
                                    <input id="image" type="file" class="form-control custom-textbox @error('image') is-invalid @enderror" name="image" value="{{ $product->image }}" placeholder="Enter image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description" class="mb-0">Description</label>
                                    <textarea name="description" id="description" class="form-control"  cols="30" rows="10">{{ $product->description }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4 mb-4">
                            <div class="m-auto">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>   
             </div>
        </div>
    </div>        
</div>    
@endsection