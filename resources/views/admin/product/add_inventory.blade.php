@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h3 class="text-white">Inventory List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SN</th>
                            <th>Product Name</th>
                            <th>Color Name</th>
                            <th>Size Name</th>
                            <th>Quantity</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                        @foreach($inventories as $key => $inventory)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $inventory->rel_to_product->product_name }}</td>
                            <td>{{ $inventory->rel_to_color->color_name }}</td>
                            <td>{{ $inventory->rel_to_size->size_name }}</td>
                            <td>{{ $inventory->quantity }}</td>
                            <td>{{ $inventory->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="#" class="btn btn-success btn-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="#" class="btn btn-danger btn-xs mt-2"><i class="fa-solid fa-trash-can"></i></a>
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
                    <h3 class="text-white">Add Inventory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/product/inventory/insert') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ $product_info->product_name }}</label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="{{ $product_info->id }}" name="product_id">
                            <select name="color_id" id="" class="form-control">
                                <option value="">-- Select Color --</option>
                                @foreach($colors as $color)
                                <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="size_id" id="" class="form-control">
                                <option value="">-- Select Size --</option>
                                @foreach($sizes as $size)
                                <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="quantity" placeholder="Quantity">
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
