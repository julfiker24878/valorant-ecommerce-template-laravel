@extends('layouts/dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h2 class="text-white">All Subcategories</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>TC</th>
                            <th>Parent Category</th>
                            <th>Subcategory Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>

                        @forelse($subcategoeis as $tsc => $subcategory)
                        <tr>
                            <td> {{ $tsc+1 }} </td>
                            <td> {{ $subcategory->rel_to_category->category_name }} </td>
                            <td> {{ $subcategory->subcategory_name }} </td>
                            <td> {{ $subcategory->created_at->diffForHumans() }} </td>
                            <td>
                                <a href="{{route('cat_edit', $subcategory->id)}}" class="btn btn-success btn-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{route('cat_delete', $subcategory->id)}}" class="btn btn-warning btn-xs"><i class="fa-solid fa-trash-can"></i></a>
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
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info">
                    <h3 class="text-white">Add Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/subcategory/insert')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <select name="category_id" class="form-control">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cat" class="form-label">Subcategory Name</label>
                            <input name="subcategory_name" type="text" class="form-control" id="cat">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
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
@endsection
