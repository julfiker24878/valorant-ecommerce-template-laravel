@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">

        @can('edit_category')
        <div class="col-md-10 m-auto">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/category/update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="cat" class="form-label">Category Name</label>
                            <input name="id" type="hidden" class="form-control" value="{{ $cat_name->id }}">
                            <input name="category_name" type="text" class="form-control" id="cat" value="{{ $cat_name->category_name }}">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label d-block">Category Image</label>
                            <img src="{{ asset('uploads/category') }}/{{$cat_name->category_image}}" alt="category-image" class="mb-3" width="350">
                            <input type="file" class="form-control" id="img" name="category_iamge">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        @else 
        <div class="col-lg-12">
            <div class="alert alert-warning">
                <h5>Sorry, you are not eligible for this action!!!</h5>
            </div>
        </div>
        @endcan

    </div>
</div>
@endsection

@section('footer_script')
    @if(session('success'))
        <script>
            Swal.fire(
                'Good job!',
                '{{ session('success') }}',
                'success'
                )
        </script>
    @endif
@endsection
