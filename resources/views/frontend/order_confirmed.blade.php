@extends('frontend.master')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Order Confirmed</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<section>
    <div class="container">
        <div class="row p-5">
            <div class="col-md-12 text-center">
                @if (session('success'))
                <div class="alert alert-success">
                    <h5>{{ session('success') }}</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
