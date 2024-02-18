@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8 m-auto">
            <div class="card">
                <div class="card-header bg-info">
                    <h3>Update Coupon</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/coupon/update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input name="id" type="hidden" class="form-control" value="{{ $coupon->id }}">
                            <label for="coupon_code" class="form-label">Coupon Code</label>
                            <input value="{{ $coupon->coupon_code }}" name="coupon_code" type="text" class="form-control" id="coupon_code">
                            @error('coupon_code')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discount" class="form-label">Discount %</label>
                            <input value="{{ $coupon->discount }}" name="discount" type="number" class="form-control" id="discount">
                            @error('discount')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="validity" class="form-label">Validity</label>
                            <input value="{{ $coupon->validity }}" name="validity" type="date" class="form-control" id="validity">
                            @error('validity')
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

@section('footer_script')
    @if (session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        })
    </script>
    @endif
@endsection
