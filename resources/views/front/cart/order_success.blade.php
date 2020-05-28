@extends('front.layouts.app')

@section('content')
<main>
    <div class="container">
        <ul class="breadcrumb">
            <li>Trang chủ</li>
            <li class="active">Đặt hàng thành công</li>
        </ul>
    </div>
    <div class="container container-mobile">
        <div class="main-content product-main">
            <div class="row" style="min-height:550px">
                <div class="col-sm-8">
                    <h2>Đặt hàng thành công</h2>
                    <p>Cảm ơn bạn đã đặt hàng</p>
                    <p>Chúng tôi sẽ giao hàng cho bạn từ 1 - 3 ngày làm việc.<br>
                        Nếu có nhu cầu gì đặc biệt thì liên hệ với số điện thoại {{ Setting::get()->phone }}
                    </p>
                    <p><a href="/" class="btn btn-success">Quay lại trang chủ</a></p>
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
@stop
