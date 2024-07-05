@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Product
                </div>

                <div class="card-body">
                    {{-- aleart --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @elseif(session('error'))
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>{{session('error')}}</strong>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      @endif
                      {{-- aleart end  --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SI NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{$products->firstItem()+$loop->index}}</th>
                                <td>{{$product->product_name}}</td>
                                <td>
                                    <img src="{{asset('img/product/'.$product->product_image)}}" height="50px" width="80px" alt="" >
                                </td>
                                <td>
                                    @if($product->created_at == NULL)
                                    <span class="text-danger">No Time Set</span>
                                    @else
                                    {{$product->created_at->diffForHumans()}}
                                    {{-- {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}} --}}
                                    @endif

                                </td>
                                <td>
                                    <a href="{{url('Product/Edit/'.$product->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('Delete/Product/'.$product->id)}}" onclick="return confirm ('Are you Sure Want to delete?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      {{$products->links()}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create Product
                </div>

                <div class="card-body">
                    <form action="{{route('store.product')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add  Product</label>
                          <input type="text" name="product_name" placeholder="Enter Product Name" class="form-control
                          @error('product_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('product_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>



                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Image</label>
                            <input type="file" name="product_image"  class="form-control
                            @error('product_image') is-invalid

                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('product_image')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
