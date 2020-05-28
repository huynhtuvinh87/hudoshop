@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $user->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Users' =>route('admin.users.index'),
                    'Update #'.$user->id,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-5">
                <form method="POST" action="{{ route('admin.users.update',$user->id) }}" class="form-horizontal">
                    @csrf
                    {{ method_field('PATCH') }}

                    <div class="form-group row">
                        <label for="fullname" class="col-sm-3">Fullname</label>
                        <div class="col-sm-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" class="form-control" placeholder="Fullname">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-3">Username</label>
                        <div class="col-sm-9">
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" class="form-control" placeholder="Username">

                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" placeholder="Email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3">Phone</label>
                        <div class="col-sm-9">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" class="form-control" placeholder="Phone">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-3">Address</label>
                        <div class="col-sm-9">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" class="form-control" placeholder="Address">

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-3">Role</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control">
                                <option value="member" {{ $user->role=='member'?'selected':'' }}>Member </option>
                                <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3">Status</label>
                        <div class="col-sm-9">
                            <select name="status" class="form-control">
                                <option value="{{ config('global.status.key.active') }}" {{ $user->status== config('global.status.key.active') ?'selected':'' }}>Active </option>
                                <option value="{{ config('global.status.key.inactive') }}" {{ $user->status== config('global.status.key.inactive') ?'selected':'' }}>InActive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-3 col-sm-9">
                            <div class="form-check">
                                <input id="check_password" type="checkbox" class="form-check-input check_password" name="check_password">
                                <label for=check_password class="form-check-label">Change the password</label>
                            </div>
                        </div>
                    </div>
                    <div id="change_password_option" class="hide">
                        <div class="form-group row">
                            <label for="password" class="col-sm-3">Password</label>
                            <div class="col-sm-9">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-sm-3">Password confirmation</label>
                            <div class="col-sm-9">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Update</button>
                </form>
            </div>
        </div>
</div>
</section>
</div>
@endsection
@section('script')
<script src={{ mix('js/user.js') }}></script>
@stop
