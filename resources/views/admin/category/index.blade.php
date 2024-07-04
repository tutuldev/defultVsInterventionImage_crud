@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Category
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
                            <th scope="col">Added By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    @if($category->created_at == NULL)
                                    <span class="text-danger">No Time Set</span>
                                    @else
                                    {{-- {{$category->created_at->diffForHumans()}} --}}
                                    {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                    @endif

                                </td>
                                <td>
                                    <a href="{{url('Category/Edit/'.$category->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{url('pdelete/category/'.$category->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                      </table>
                      {{$categories->links()}}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Create Category
                </div>

                <div class="card-body">
                    <form action="{{route('store.category')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Add Category</label>
                          <input type="text" name="category_name" placeholder="Enter Category" class="form-control
                          @error('category_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('category_name')
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
