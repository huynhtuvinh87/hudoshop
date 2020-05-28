@extends('front.layouts.app')
@section('title',$data->title)
@section('description',$data->meta_description)
@section('keywords',$data->meta_keyword)
@section('og_image',$data->image)
@section('content')
<main>
    <div class="container">
        <ul class="breadcrumb">
            <li>Trang chủ</li>
            <li><a href="/filter?category=5aefc803da07c702af45b503">{{$data->category_name}}</a></li>
            <li class="active">{{$data->title}}</li>
        </ul>
    </div>
    <div class="container container-mobile">
        <div class="main-content product-main">
            <div class="row">

                <div class="col-md-12 product-detail ">
                    <div class="product-detail-inner">
                        <div class="row">
                            <div class="col-md-5">
                                @if($data->images )
                                <div class="col-left">
                                    <div class="slider slider-for">

                                        @foreach ($data->images as $key => $value)
                                        <div class="item">
                                            <a href="{{$value}}" rel="group" data-lightbox="roadtrip">
                                                <img class="lazyload {{  $key ==  0 ? '' : 'set-img'}}" data-src="/image.php?src={{Constant::getFileImage($value)}}&size=460x400" src="{{ asset('images/image_default.png') }}" alt="{{$data->title}}">
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="slider slider-nav">
                                        @foreach ($data->images as $key => $value)
                                        <div class="item slider-nav-item">
                                            <a href="javascript:void(0)"><img class="lazyload set-img" src="{{$value}}"></a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-7 col-right">
                                <form id="cart-form" class="cart form-horizontal" method="post">
                                    <h1 class="product-title">{{$data['title']}}</h1>
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="product-price">
                                                <span class="orange">{{number_format($data['price'], 0, '', ',')}} VNĐ</span>
                                            </div>
                                            <div class="quantity">
                                                <label>Số lượng</label>
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                                <input type="text" id="cart-quantity" name="qty" class="qty" value="1" min="1">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </div>
                                            <div class="desc">
                                                <p>{!! $data->description !!}</p>
                                            </div>
                                            <div class="button-group">
                                                <div class="item item-buy">
                                                    <div class="item-wrap">
                                                        <button type="button" name="buynow" class="btn btn-buy buynow"><img src="/shop/svg/cart.svg" width="18"> Mua ngay</button>
                                                    </div>
                                                </div>
                                                <div class="item item-sms">
                                                    <div class="item-wrap"> <a href="javascript:void(0)" class="addcart btn request"><i class="fa fa-envelope" aria-hidden="true"></i> Thêm vào giỏ hàng</a>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="transport">
                                                <small><b>Hình thức thanh toán</b>: Thanh toán khi nhận hàng</small>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="info">
                                                <ul class="commitment">
                                                    <li class="text-red">Có bill mua hàng từ nước ngoài</li>
                                                    <li>Cam kết 100% chính hãng</li>
                                                    <li>Sản phẩm có tem chống giả</li>
                                                    <li>Giao hàng 24h- 48h</li>
                                                    <li>Đổi trả trong 15 ngày</li>
                                                </ul>
                                                <ul class="policy">
                                                    <li><i class="icon-poltel"></i>
                                                        <p>Bán lẻ: 0905951699 </p>
                                                        <p>Bán sỉ: 0905951699</p>
                                                    </li>
                                                    <li><i class="icon-polmail"></i>
                                                        <p>Email: huynhtuvinh87@gmail.com</p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="social_share">
                                                <span id="share-buttons">
                                                    <a rel="nofollow" href="http://www.facebook.com/sharer.php?u={{url($data['slug'].'-'.$data['id'])}}" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook">
                                                    </a>

                                                    <a rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{url($data['slug'].'-'.$data['id'])}}" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn">
                                                    </a>

                                                    <a rel="nofollow" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','https://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                                                        <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest">
                                                    </a>

                                                    <a rel="nofollow" href="https://twitter.com/share?url={{url($data['slug'].'-'.$data['id'])}}" target="_blank">
                                                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter">
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="sec-pro">
                        <h3 class="sec-title">Giới thiệu sản phẩm</h3>
                        <div class="sec-content">
                            {!! $data->content !!}
                        </div>
                    </div>

                </div>

            </div>
            <div class="more-pro">
                @if($data->category_id && Constant::category()->{$data->category_id})
                <h3>Sản phẩm khác</h3>
                <div class="wrap-product">
                    <div class="row list-product gird gird-5">
                        @foreach(Constant::category()->{$data->category_id}->posts as $value)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$value])
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

</main>
@endsection

@section('script')
<script>
    $('.list-cat').hide();
    $('.quantity').on('click', '.fa-plus', function(e) {
        e.preventDefault();
        var number = parseInt($('#cart-quantity').val());

        $('#cart-quantity').val(number + 1);
    });
    $('.quantity').on('click', '.fa-minus', function(e) {
        e.preventDefault();
        var val = parseInt($('#cart-quantity').val());
        var min = 1;
        if (val > min) {
            $(this).removeClass('disable');
            $('#cart-quantity').val(val - 1);
        } else {
            $('#cart-quantity').val(min);
        }
    });
    $("body").on("click", '.buynow', function(event, state) {
        var id = "{{$data->id}}";
        var quantity = parseInt($("#cart-quantity").val());
        $.ajax({
            type: "POST",
            url: "/cart/add",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: quantity
            },
            success: function(data) {
                window.location.href = '/cart/checkout';
            },
        });
    });
    $("body").on("click", '.addcart', function(event, state) {
        var id = "{{$data->id}}";
        var quantity = parseInt($("#cart-quantity").val());
        $.ajax({
            type: "POST",
            url: "/cart/add",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: quantity
            },
            success: function(data) {
                console.log(data);
                $(".header-cart .circle").html(data.result)
            },
        });
    });
</script>
@stop
