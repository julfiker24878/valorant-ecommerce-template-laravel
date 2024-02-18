@extends('layouts.dashboard');

@section('content')
<div class="container-fluid">
    <div class="row">

        {{-- NAME CHANGE --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Change Name</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/profile/name/update') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" name="name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- PASSWORD CHANGE --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/profile/password/update') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <input type="password" class="form-control" name="old_password" placeholder="Old Password">
                            @error('old_password')
                                <strong class="text-danger mt-2">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Enter New Password">
                            @error('password')
                                <strong class="text-danger mt-2">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            @error('password_confirmation')
                                <strong class="text-danger mt-2">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- PROFILE PHOTO CHANGE --}}
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Change Profile Picture</h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('/profile/photo/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <img src="" alt="profile-photo">
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-control" name="profile_photo">
                            @error('profile_photo')
                                <strong class="text-danger mt-2">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
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
                'Hmmmmm...',
                '{{ session('success') }}',
                'success'
                )
        </script>
    @endif
    @if(session('wrong_pass'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('wrong_pass') }}'
            })
        </script>
    @endif
@endsection
