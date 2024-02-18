@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2>Coupon List</h2>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/trash')}}" method="POST"> @csrf
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>
                                <th>Discount</th>
                                <th>Validity</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>

                            @forelse($coupons as $sl => $coupon)
                            <tr>
                                <td> {{ $sl+1 }} </td>
                                <td> {{ $coupon->coupon_code }} </td>
                                <td> {{ $coupon->discount }} </td>
                                <td> {{ $coupon->validity }} </td>
                                <td> {{ $coupon->created_at->diffForHumans() }} </td>
                                <td>
                                    <a href="{{route('coupon.edit', $coupon->id)}}" class="btn btn-success btn-xs"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="{{route('coupon.delete', $coupon->id)}}" class="btn btn-warning btn-xs"><i class="fa-solid fa-trash-can"></i></a>
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
                    </form>
                </div>
            </div>


        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header bg-info">
                    <h3>Add Coupon</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/coupon/insert')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="coupon_code" class="form-label">Coupon Code</label>
                            <input name="coupon_code" type="text" class="form-control" id="coupon_code">
                            @error('coupon_code')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount %</label>
                            <input name="discount" type="number" class="form-control" id="discount">
                            @error('discount')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validity" class="form-label">Validity</label>
                            <input name="validity" type="date" class="form-control" id="validity">
                            @error('validity')
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
