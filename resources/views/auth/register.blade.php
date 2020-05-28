@extends('admin.layouts.login')

@section('content')
<div class="login-logo">
    <a><b>Đăng ký</b></a>
</div>
<div class="card">
    <div class="card-header">Đăng ký</div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-group mb-3">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" class="form-control" placeholder="Fullname">

                @error('name')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('name') }}" class="form-control" placeholder="Username">

                @error('username')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Password confirmation">

            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" class="@error('agree') is-invalid @enderror" id="agreeTerms" name="terms">
                        <label for="agreeTerms">
                            I agree to the <a href="#">terms</a>
                        </label>
                        @error('terms')
                        <p class="text-danger"><small>{{ $message }}</small></p>
                        @enderror
                    </div>

                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Đăng ký</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a href="{{ route('login') }}" class="text-center">Tôi đã có tài khoản</a>
    </div>
</div>
@endsection
