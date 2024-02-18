@extends('layouts/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2>All Categories</h2>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/trash')}}" method="POST"> @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" id="checkAll"> Check All</th>
                                <th>TC</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Category Image</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>

                            @forelse($categories as $tc => $category)
                            <tr>
                                <td><input class="chk" type="checkbox" name="mark[]" value="{{ $category->id }}"></td>
                                <td> {{ $tc+1 }} </td>
                                <td> {{ $category->category_name }} </td>
                                <td> {{ App\Models\User::find($category->added_by)->name }} </td>
                                <td> <img src="{{ asset('uploads/category') }}/{{$category->category_image}}" alt="category-image" width="80"> </td>
                                <td> {{ $category->created_at->diffForHumans() }} </td>
                                <td>
                                    <a href="{{route('cat_edit', $category->id)}}" class="btn btn-success btn-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('cat_delete', $category->id)}}" class="btn btn-warning btn-xs"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-success">
                                    No data found!
                                </td>
                            </tr>
                            @endforelse
                        </table>
                        <button type="submit" class="btn btn-warning">Trash All</button>
                    </form>
                </div>
            </div>


        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-info">
                    <h3>Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/category/insert')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input name="icon" type="text" class="form-control" id="icon">
                            @error('icon')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cat" class="form-label">Category Name</label>
                            <input name="category_name" type="text" class="form-control" id="cat">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cat_img" class="form-label">Category Image</label>
                            <input name="category_image" type="file" class="form-control" id="cat_img">
                            @error('category_image')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TRASHED CATEGORIES -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-2">
                <div class="card-header bg-warning">
                    <h2>Trashed Categories</h2>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/restore')}}" method="POST"> @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" id="checkedAll"> Check All</th>
                                <th>TC</th>
                                <th>Category Name</th>
                                <th>Added By</th>
                                <th>Category Image</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>

                            @forelse($trashed as $tc => $category)
                            <tr>
                                <td><input class="chk2" type="checkbox" name="mark[]" value="{{ $category->id }}"></td>
                                <td> {{ $tc+1 }} </td>
                                <td> {{ $category->category_name }} </td>
                                <td> {{ App\Models\User::find($category->added_by)->name }} </td>
                                <td> <img src="{{ asset('uploads/category') }}/{{$category->category_image}}" alt="category-image" width="80"> </td>
                                <td> {{ $category->created_at < now()->subDays(30)? $category->created_at:$category->created_at->diffForHumans() }} </td>
                                <td>
                                    <a href="{{route('cat_restore', $category->id)}}" class="btn btn-primary">Restore</a>
                                    <a href="{{route('force_delete', $category->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-success">
                                    No data found!
                                </td>
                            </tr>
                            @endforelse
                        </table>
                        <button type="submit" class="btn btn-primary">Restore All</button>
                    </form>
                </div>
            </div>
        </div>
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
    @if(session('deleted'))
        <script>
            Swal.fire(
                'Good job!',
                '{{ session('deleted') }}',
                'success'
                )
        </script>
    @endif
    <script type="text/javascript">
        $("#checkAll").click(function(){
            $('.chk:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
    <script type="text/javascript">
        $("#checkedAll").click(function(){
            $('.chk2:checkbox').not(this).prop('checked', this.checked);
        });
    </script>
@endsection
