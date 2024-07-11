@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Sub-Category
                </div>

                <div class="card-body">
                    <form action="{{url('Update/Sub-Category/'.$subcategories->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update SubCategory</label>
                          <input type="text" name="subcategory_name" value="{{$subcategories->subcategory_name}}" class="form-control
                          @error('subcategory_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('subcategory_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Update sub category Image</label>
                            <input type="file" name="subcategory_image" value="{{$subcategories->product_name}}" class="form-control
                            @error('subcategory_image') is-invalid

                            @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('subcategory_image')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="mb-3">

                              <img src="{{asset('img/subcategory/'.$subcategories->subcategory_image)}}" height="50px" width="80px" alt="" >
                          </div>
                        <button type="submit" class="btn btn-primary">update</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
