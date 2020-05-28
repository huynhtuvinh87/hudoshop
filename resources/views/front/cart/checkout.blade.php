@extends('front.layouts.app')
@section('title','Checkout')
@section('content')
<main>
    <div class="container">
        <ul class="breadcrumb">
            <li>Trang chủ</li>
            <li class="active">Checkout</li>
        </ul>
    </div>
    <div class="container container-mobile">
        <h4 class="main-title">Giỏ hàng ({{Cart::getTotalQuantity()}})</h4>
        @if(Cart::getTotalQuantity() > 0)
        <div class="main-content product-main">
            <div class="row" style="min-height:550px">
                <div class="col-md-9">
                    <div class="table-responsive" style="background-color: #fff; margin-bottom: 20px">
                        <table class="table">
                            @foreach($data as $value)
                            <tr class="cart_{{$value->id}}">
                                <td>
                                    <div class="right" style=" overflow: hidden">
                                        <a href="/{{$value->attributes->url}}">
                                            <img class="" style="border-radius: 5px;float:left; margin-right: 10px; width:50px" src="{{$value->attributes->image}}">
                                            <div>
                                                {{ $value->name }} </div>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="left">Đơn giá</div>
                                    <div class="right total" id="price-{{$value->id}}">
                                        {{number_format($value->price, 0, '', '.')}} ₫
                                    </div>
                                </td>
                                <td>
                                    <div class="left">Số lượng</div>
                                    <div class="right">
                                        <ul class="quanlity choosenumđber quantity_{{$value->id}}">
                                            <li><a href="javascript:void(0)" class="abate " data-type="abate" data-id="{{$value->id}}"><i class="fa fa-minus"></i></a></li>
                                            <li><span style="padding:0; border: 0"><input id="number-{{$value->id}}" type="text" style="width: 55px; text-align: center; " data-id="{{$value->id}}" data-value="{{$value->quantity}}" value="{{$value->quantity}}" class="number"></span></li>
                                            <li><a href="javascript:void(0)" class="augment" data-type="augment" data-id="{{$value->id}}"><i class="fa fa-plus"></i></a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div class="right">
                                        <a style="color: red;" href="javascript:void(0)" data-id="{{$value->id}}" class="remove">Xóa</a>
                                    </div>
                                </td>
                            </tr>


                            @endforeach

                        </table>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-default" style="border:0; border-radius: 0">
                        <div class="panel-body">
                            <div class="total">
                                <p>Tạm tính: <strong>{{number_format(Cart::getSubTotal(), 0, '', '.')}} ₫</strong></p>
                                <p>Phí ship: {{number_format(Constant::setting()->shipping, 0, '', '.')}} đ</p>
                            </div>
                            <div class="total" style="border-top: 1px solid #eee; padding-top: 15px; margin-top: 15px; font-size: 18px; font-weight: 300">
                                Thành tiền: <strong class="pull-right text-danger" style=" font-weight: 500">{{number_format(Cart::getTotal()+Constant::setting()->shipping, 0, '', '.')}} ₫</strong>
                            </div>
                        </div>
                    </div>
                    <h5>Hình thức thanh toán</h5>
                    <div class="panel panel-default" style="border:0; border-radius: 0">
                        <div class="panel-body">
                            <div class="total">
                                @foreach($payment as $k=>$value)
                                <div class="form-check">
                                    <input class="form-check-input payment" type="radio" name="payment" id="payment_{{$k}}" value="{{ $k }}" {{ $k==1?'checked':'' }}>
                                    <label class="form-check-label" for="payment_{{ $k }}">
                                        {{ $value }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="btn-ship" style="padding: 0 10px; margin-bottom: 20px;">

                        <input type="button" id="shipping" data-toggle="modal" data-target="#myModal" class="btn btn-success" style="padding: 6px 24px; width: 100%;" value="Tiến hành đặt hàng">

                    </div>
                </div>
            </div>
        </div>
        @else
        <div style="text-align: center; margin: 150px auto">
            <img src="/shop/images/cart.png" style="width: 250px">
            <p>Bạn không có sản phẩm nào trong giỏ hàng</p>
        </div>
        @endif
    </div>
</main>
@endsection
@section('script')
<script>
    $('.list-cat').hide();
    $('.number').on('change', function(e) {
        var id = $(this).attr("data-id");
        var val = ($(this).val());
        $.ajax({
            type: "POST",
            url: "/cart/update",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: val
            },
            success: function(data) {
                $(".header-cart .circle").html(JSON.parse(data.result))
            },
        });

    });
    $('#form-order input').on('change', function(e) {
        var val = $(this).parent().find('span');
        $(val).removeClass('error');
        $(val).html('');
    });
    $('.form-check input').on('change', function(e) {
        var val = $(this).val();
        $('#order-payment').val(val);
    })
    $(".augment").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var number = parseInt($('#number-' + id).val());
        $('#number-' + id).val(number + 1);
        $.ajax({
            type: "POST",
            url: "/cart/update",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: number + 1
            },
            success: function(data) {
                $(".header-cart .circle").html(JSON.parse(data.result))
            },
        });
    });

    $(".abate").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        var number = parseInt($('#number-' + id).val());
        $('#number-' + id).val(number - 1);
        $.ajax({
            type: "POST",
            url: "/cart/update",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                qty: number - 1
            },
            success: function(data) {
                $(".header-cart .circle").html(JSON.parse(data.result))
            },
        });
    });
    $(".remove").on("click", function(e) {
        e.preventDefault();
        var id = $(this).attr("data-id");
        $.ajax({
            type: "POST",
            url: "/cart/remove",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(data) {
                $(".header-cart .circle").html(JSON.parse(data.result));

                $('.cart_' + id).remove();
            },
        });
    });
    $("#order").on("click", function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '/cart/order',
            data: $("#form-order").serialize(),
            success: function(msg) {
                window.location.href = '/order/success';
            },
            error: function(err) {
                err = $.parseJSON(err.responseText).meta.error;
                if (err['email']) {
                    $('.error-email').html(err['email'][0]);
                    $('.error-email').addClass('error');
                }
                if (err['phone']) {
                    $('.error-phone').html(err['phone'][0]);
                    $('.error-phone').addClass('error');
                }
                if (err['name']) {
                    $('.error-name').html(err['name'][0]);
                    $('.error-name').addClass('error');
                }
                if (err['address']) {
                    $('.error-address').html(err['address'][0]);
                    $('.error-address').addClass('error');
                }


            }

        });
    });
</script>
@stop
