@extends('admin.layouts.login')

@section('content')
<div class="login-logo">
    <a href=""><b>Đăng nhập</b></a>
</div>
<div class="card">
    <div class="card-body">
        <p class="login-box-msg">Đăng nhập để bắt đầu phiên của bạn</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf


            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <div class="col-7">
                    <div class="icheck-primary">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-5">
                    <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>

        </form>
        <p class="mb-1"> <a class="text-center" href="{{ route('register') }}">
                Đăng ký
            </a></p>
        <p class="mb-1">

            @if (Route::has('password.request'))
            <a class="text-center" href="{{ route('password.request') }}">
                Quên mật khẩu
            </a>
            @endif
        </p>
    </div>
</div>
@endsection
