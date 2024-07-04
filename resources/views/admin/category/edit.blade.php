@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Category
                </div>

                <div class="card-body">
                    <form action="{{url('Store/Category/'.$categories->id)}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update Category</label>
                          <input type="text" name="category_name" value="{{$categories->category_name}}" class="form-control
                          @error('category_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('category_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
