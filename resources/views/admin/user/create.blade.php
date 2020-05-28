@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Users' =>route('admin.users.index'),
                    'Add New',
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-5">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Fullname</label>
                        <div class="col-sm-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" class="form-control">

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
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('phone') }}" class="form-control">

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
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">

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
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" class="form-control">

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
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" class="form-control">

                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>


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
                    <div class="form-group row">
                        <label for="role" class="col-sm-3">Role</label>
                        <div class="col-sm-9">
                            <select name="role" class="form-control">
                                <option value="{{ config('global.role.member') }}">Member </option>
                                <option value="{{ config('global.role.admin') }}">Admin</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Add New</button>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
