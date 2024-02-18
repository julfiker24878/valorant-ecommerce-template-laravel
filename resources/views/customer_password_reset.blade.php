@extends('frontend.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto py-5">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Send Reset Link</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.reset.store') }}" method="POST"> @csrf
                        <div class="mt-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter your email address">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Request a Link</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection