@extends('layouts.dashboard')

@section('content')
<!-- row -->
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card avtivity-card">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="activity-icon bgl-success mr-md-4 mr-3">
                                    <i class="fa-solid fa-users" style="font-size: 25px; color: #2BC155;"></i>
                                </span>
                                <div class="media-body">
                                    <p class="fs-14 mb-2">Total Users</p>
                                    <span class="title text-black font-w600">{{ count($users) }}</span>
                                </div>
                            </div>
                            <div class="progress" style="height:5px;">
                                <div class="progress-bar bg-success" style="width: {{ count($users) }}%; height:5px;" role="progressbar">
                                </div>
                            </div>
                        </div>
                        <div class="effect bg-success"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card avtivity-card">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="activity-icon bgl-secondary  mr-md-4 mr-3">
                                    <i class="fa-solid fa-cart-shopping" style="font-size: 25px; color: #A02CFA;"></i>
                                </span>
                                <div class="media-body">
                                    <p class="fs-14 mb-2">Total Products</p>
                                    <span class="title text-black font-w600">{{ count($all_products) }}</span>
                                </div>
                            </div>
                            <div class="progress" style="height:5px;">
                                <div class="progress-bar bg-secondary" style="width: {{ count($all_products) }}%; height:5px;" role="progressbar">
                                </div>
                            </div>
                        </div>
                        <div class="effect bg-secondary"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card avtivity-card">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="activity-icon bgl-danger mr-md-4 mr-3">
                                    <i class="fa-solid fa-tags" style="font-size: 25px; color: #F94687;"></i>
                                </span>
                                <div class="media-body">
                                    <p class="fs-14 mb-2">Total Categories</p>
                                    <span class="title text-black font-w600">{{ count($categories) }}</span>
                                </div>
                            </div>
                            <div class="progress" style="height:5px;">
                                <div class="progress-bar bg-danger" style="width: {{ count($categories) }}%; height:5px;" role="progressbar">
                                </div>
                            </div>
                        </div>
                        <div class="effect bg-danger"></div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card avtivity-card">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span class="activity-icon bgl-warning  mr-md-4 mr-3">
                                    <i class="fa-solid fa-tag" style="font-size: 25px; color: #FFBC11;"></i>
                                </span>
                                <div class="media-body">
                                    <p class="fs-14 mb-2">Total Subcategoreis</p>
                                    <span class="title text-black font-w600">{{ count($sub_categories) }}</span>
                                </div>
                            </div>
                            <div class="progress" style="height:5px;">
                                <div class="progress-bar bg-warning" style="width: {{ count($sub_categories) }}%; height:5px;" role="progressbar">
                                </div>
                            </div>
                        </div>
                        <div class="effect bg-warning"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-9 col-xxl-8">
            <div class="row">
                <div class="col-xl-12">	
                    <div class="card">
                        <div class="card-header d-sm-flex d-block pb-0 border-0">
                            <div class="mr-auto pr-3">
                                <h4 class="text-black font-w600 fs-20">All Users</h4>
                            </div>
                            <a href="{{ route('users') }}" class="btn btn-primary rounded d-none d-md-block">View More</a>
                        </div>
                        <div class="card-body pt-2">
                            <div class="testimonial-one owl-carousel">

                                @foreach ($users as $user)
                                <div class="items">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <img src="{{ asset('/uploads/profile/default.png') }}" alt="">
                                            <h5 class="fs-16 font-w500 mb-1"><a href="app-profile.html" class="text-black">{{ $user->name }}</a></h5>
                                            <p class="fs-14">{{ $user->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-xl-3 col-xxl-4">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card featuredMenu">
                        <div class="card-header border-0">
                            <h4 class="text-black font-w600 fs-20 mb-0">Featured Products</h4>
                        </div>
                        <div class="card-body loadmore-content height750 dz-scroll pt-0" id="FeaturedMenusContent">

                            @foreach($products as $product)
                            <div class="media mb-4">
                                <img src="{{ asset('/uploads/products/preview') }}/{{ $product->preview }}" width="85" alt="product" class="rounded mr-3">
                                <div class="media-body">
                                    <h5><a href="food-menu.html" class="text-black fs-16">{{ $product->product_name }}</a></h5>
                                    <span class="fs-14 text-primary font-w500">{{ $product->brand }}</span>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection