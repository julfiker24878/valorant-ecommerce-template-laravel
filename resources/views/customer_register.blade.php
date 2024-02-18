@extends('frontend.master')

@section('content')
<!-- register_section - start
================================================== -->
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if (session('email_verified'))
                    <div class="alert alert-success">
                        {{ session('email_verified') }}
                    </div>
                @endif
                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab" aria-controls="signin_tab" aria-selected="true">Sign In</button>
                    </li>
                    <li role="presentation">
                        <button data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Register</button>
                    </li>
                </ul>

                <!-- ###################### SIGN IN #################### -->
                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signin_tab" role="tabpanel">
                        <form action="{{ url('/customer/login') }}" method="POST"> @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-user"></i></label>
                                    <input id="username_input" type="email" name="email" placeholder="Eamil">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input"><i class="fas fa-lock"></i></label>
                                    <input id="password_input" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="checkbox_item">
                                    <input id="remember_checkbox" type="checkbox">
                                    <label for="remember_checkbox">Remember Me</label>
                                    <a href="{{ route('password.reset.req') }}">Forgot your password?</a>
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_primary">Sign In</button>
                            </div>

                            <div class="form_item_wrap mt-5">
                                <p>Login with</p>
                                <a href="{{ url('/github/redirect') }}" style="padding: 10px 15px; background:#161B22; color:#fff; border-radius: 10px;">GitHub</a>
                                <a href="{{ url('/google/redirect') }}" style="padding: 10px 15px; background:#F3B605; color:#000; border-radius: 10px;">Google</a>
                                <a href="{{ url('/facebook/redirect') }}" style="padding: 10px 15px; background:#3B579D; color:#fff; border-radius: 10px;">Facebook</a>
                            </div>
                        </form>
                    </div>

                    <!-- ###################### REGISTER #################### -->
                    <div class="tab-pane fade" id="signup_tab" role="tabpanel">
                        <form action="{{ url('/customer/register') }}" method="POST"> @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Name*</h3>
                                <div class="form_item">
                                    <label for="username_input2"><i class="fas fa-user"></i></label>
                                    <input id="username_input2" type="text" name="name" placeholder="User Name">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-envelope"></i></label>
                                    <input id="email_input" type="email" name="email" placeholder="Email">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_secondary">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- register_section - end
================================================== -->
@endsection