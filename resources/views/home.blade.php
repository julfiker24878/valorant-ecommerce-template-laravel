@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}, <strong>{{ $logged_user }}</strong>
                    <span class="float-end">Total Users ( {{$total_users}} )</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Registered At</th>
                            <th>Action</th>
                        </tr>

                        @foreach($users as $tu => $user)
                        <tr>
                            <td> {{ $users->firstitem()+$tu }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->email }} </td>
                            <td> {{ $user->created_at->diffForHumans() }} </td>
                            <td>
                                <a href="{{ route('del',  $user->id) }}" class="btn btn-danger btn-xs"><i class="fa-solid fa-trash-can"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
