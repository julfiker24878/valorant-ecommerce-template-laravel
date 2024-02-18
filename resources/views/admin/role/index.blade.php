@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All Permisssions</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Permisssion Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach($permissions as $key=>$permission)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h3>Role List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Permisssions</th>
                            <th>Action</th>
                        </tr>

                        @foreach($roles as $key=>$role)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach( $role->getPermissionNames() as $permission )
                                    {{ $permission.',' }}
                                @endforeach
                            </td>
                            <td>
                                <a href="" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h3>Users Assigned Role</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>User Name</th>
                            <th>Role Name</th>
                            <th>Permisssion Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach($users as $key=>$user)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @if( count($user->getRoleNames()) != 0 )
                                @foreach( $user->getRoleNames() as $role )
                                    <span>{{ $role }}</span>
                                @endforeach
                                @else
                                    'Not assigned yet!'
                                @endif
                            </td>
                            <td>
                                @if( count($user->getAllPermissions()) != 0 )
                                @foreach( $user->getAllPermissions() as $permission )
                                    {{ $permission->name.',' }}
                                @endforeach
                                @else
                                    'Not assigned yet!'
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('role.edit', $user->id) }}" class="btn btn-success">Edit</a>
                            </td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Permisssion</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('permission.store') }}" method="POST">@csrf
                        <div class="form-group">
                            <label for="permission_name" class="form-label">Permisssion Name</label>
                            <input type="text" id="permission_name" class="form-control" name="permission_name">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.store') }}" method="POST">@csrf
                        <div class="form-group">
                            <label class="form-label">Role Name</label>
                            <select name="role_name" id="" class="form-control">
                                <option value="">-- SELECT ROLE --</option>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Moderator">Moderator</option>
                                <option value="Coupon Manager">Coupon Manager</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign Permisssion</label>
                            @foreach($permissions as $permission)
                            <br>
                            <input type="checkbox" name="permission[]" value="{{ $permission->name }}"> {{ $permission->name }}
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

            <br>

            <div class="card">
                <div class="card-header">
                    <h3>Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.assign') }}" method="POST">@csrf
                        <div class="form-group">
                            <label class="form-label">Select User</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">-- SELECT USER --</option>

                                @foreach($users as $key=>$user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Role</label>
                            <select name="role" id="" class="form-control">
                                <option value="">-- SELECT ROLE --</option>

                                @foreach($roles as $key=>$role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection