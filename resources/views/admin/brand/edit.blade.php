@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit brand
                </div>

                <div class="card-body">
                    <form action="{{url('Update/Brand/'.$brands->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{$brands->brand_image}}">
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update brand Name</label>
                          <input type="hide" name="brand_name" value="{{$brands->brand_name}}" class="form-control
                          @error('brand_name') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('brand_name')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Update brand Name</label>
                          <input type="file" name="brand_image" value="{{$brands->brand_name}}" class="form-control
                          @error('brand_image') is-invalid

                          @enderror" id="exampleInputEmail1" aria-describedby="emailHelp">
                          @error('brand_image')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                        <div class="mb-3">

                            <img src="{{asset($brands->brand_image)}}" height="50px" width="80px" alt="" >
                        </div>
                        <button type="submit" class="btn btn-primary">update</button>
                      </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
