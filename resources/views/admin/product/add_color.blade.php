@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Color</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="text-white">All Colors</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SN</th>
                            <th>Color Name</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($colors as $key => $color)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>{{ $color->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="#" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add Color</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/product/color/insert') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="color" placeholder="Color Name">
                        </div>
                        <button type="submit" class="btn btn-primary btn-xs">ADD NOW</button>
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
@endsection
