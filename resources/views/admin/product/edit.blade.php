@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit product
                </div>

                <div class="card-body">
                    <form action="{{url('Update/Product/'.$products->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{$products->product_image}}">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update product Name</label>
                          <input type="text" name="product_name" value="{{$products->product_name}}" class="form-control
                          @error('product_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update product Name</label>
                          <input type="file" name="product_image" value="{{$products->product_name}}" class="form-control
                          @error('product_image') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('product_image')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">

                            <img src="{{asset('img/product/'.$products->product_image)}}" height="50px" width="80px" alt="" >
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
