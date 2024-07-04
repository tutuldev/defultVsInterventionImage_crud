@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Brand
                </div>

                <div class="card-body">
                    {{-- aleart --}}
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      @endif
                      {{-- aleart end  --}}
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">SI NO</th>
                            <th scope="col">Name</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($brands as $brand)
                            <tr>
                                <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                <td>{{$brand->brand_name}}</td>
                                <td>
                                    <img src="{{asset($brand->brand_image)}}" height="50px" width="80px" alt="" >
                                </td>
                                <td>
                                    @if($brand->created_at == NULL)
                                    <span class="text-danger">No Time Set</span>
                                    @else
                                    {{$brand->created_at->diffForHumans()}}
                                    {{-- {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}} --}}
                                    @endif

                                </td>
                                <td>
                                    <a href="{{url('Brand/Edit/'.$brand->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('Delete/Brand/'.$brand->id)}}" onclick="return confirm ('Are you Sure Want to delete?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      {{$brands->links()}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create Brand
                </div>

                <div class="card-body">
                    <form action="{{route('store.brand')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add  Brand</label>
                          <input type="text" name="brand_name" placeholder="Enter Brand Name" class="form-control
                          @error('brand_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>



                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Image</label>
                            <input type="file" name="brand_image"  class="form-control
                            @error('brand_image') is-invalid

                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('brand_image')
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
