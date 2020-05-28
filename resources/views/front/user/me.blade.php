@extends('front.layouts.app')

@section('content')
<main>
    <div class="container">
        <ul class="breadcrumb">
            <li>Trang chủ</li>
            <li class="active">Thông tin tài khoản</li>
        </ul>
    </div>
    <div class="container container-mobile">
        <h4 class="main-title">Thông tin tài khoản</h4>
        <div class="main-content product-main">
            <div class="row" style="min-height:550px">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('me.update') }}" class="form-horizontal">
                        @csrf
                        {{ method_field('PATCH') }}

                        <div class="form-group row">
                            <label for="fullname" class="col-sm-3">Họ và tên</label>
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
                            <label for="phone" class="col-sm-3">Điện thoại</label>
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
                            <div class="col-sm-offset-3 col-sm-9">
                                <div class="form-check">
                                    <input id="check_password" type="checkbox" class="form-check-input check_password" name="check_password">
                                    <label for=check_password class="form-check-label">Thay đổi mật khẩu</label>
                                </div>
                            </div>
                        </div>

                        <div id="change_password_option" class="hide">
                            <div class="form-group row">
                                <label for="password" class="col-sm-3">Mật khẩu</label>
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
                                <label for="password-confirm" class="col-sm-3">Nhập lại mật khẩu</label>
                                <div class="col-sm-9">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9 col-sm-offset-3">
                                <button type="submit" class="btn btn-primary float-right">Cập nhật</button>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>

    </div>
</main>
@endsection
@section('script')
<script>
    $('.list-cat').hide();
</script>
<script src={{ mix('js/user.js') }}></script>
@stop
