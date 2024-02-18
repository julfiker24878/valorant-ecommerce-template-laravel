@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/category/update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cat" class="form-label">Category Name</label>
                            <input name="id" type="hidden" class="form-control" value="{{ $cat_name->id }}">
                            <input name="category_name" type="text" class="form-control" id="cat" value="{{ $cat_name->category_name }}">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong> 
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection