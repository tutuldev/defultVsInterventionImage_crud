@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Sub Category
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
                            <th scope="col">Sub-Category Image</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($subcategories as $subcategory)
                            <tr>
                                <th scope="row">{{$subcategories->firstItem()+$loop->index}}</th>
                                <td>{{$subcategory->subcategory_name}}</td>
                                <td>
                                    <img src="{{asset('img/subcategory/'.$subcategory->subcategory_image)}}" height="50px" width="80px" alt="" >
                                </td>
                                <td>
                                    @if($subcategory->created_at == NULL)
                                    <span class="text-danger">No Time Set</span>
                                    @else
                                    {{$subcategory->created_at->diffForHumans()}}
                                    {{-- {{Carbon\Carbon::parse($subcategory->created_at)->diffForHumans()}} --}}
                                    @endif

                                </td>
                                <td>
                                    <a href="{{url('Sub-Category/Edit/'.$subcategory->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('Delete/Sub-Category/'.$subcategory->id)}}"
                                        onclick="return confirm ('Are you Sure Want to delete?')" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      {{$subcategories->links()}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create Sub-Category
                </div>

                <div class="card-body">
                    <form action="{{route('store.subcategory')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add Sub-Category</label>
                          <input type="text" name="subcategory_name" placeholder="Enter Sub-Category" class="form-control
                          @error('subcategory_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('subcategory_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Image</label>
                            <input type="file" name="subcategory_image"  class="form-control
                            @error('subcategory_image') is-invalid

                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('subcategory_image')
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
