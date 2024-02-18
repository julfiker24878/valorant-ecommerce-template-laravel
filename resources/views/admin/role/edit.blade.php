@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update') }}" method="POST">@csrf
                        <div class="form-group">
                            <input type="hidden" value="{{ $role_info->id }}" class="form-control" name="user_id">
                            <input type="text" value="{{ $role_info->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Assign Permisssion</label>
                            @foreach($permissions as $permission)
                            <br>
                            <input type="checkbox" {{ ($role_info->hasPermissionTo($permission->name))? 'checked': '' }} name="permission[]" value="{{ $permission->name }}"> {{ $permission->name }}
                            @endforeach
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection