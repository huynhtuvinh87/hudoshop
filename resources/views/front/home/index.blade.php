@extends('front.layouts.app')
@section('title',Constant::setting()->title)
@section('description',Constant::setting()->description)
@section('keywords',Constant::setting()->keyword)
@section('og_image',asset(Constant::setting()->og_image))
@section('content')

<main>
    <div class="container">
    </div>
    <div id="home-page" class="container container-mobile">
        <section class="title-page">
            @if(!empty(Constant::widget()->banner))
            {!! Constant::widget()->banner[0]->content!!}
            @endif
        </section>

        <section class="home-sec" id="list-tab">
            <div class="wrap-tab">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#deal-spcs">Sản phẩm có sẵn</a></li>
                    <li><a data-toggle="tab" href="#deal-spdt">Sản phẩm đặt trước</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="deal-spcs" class="tab-pane fade in active">
                    <div class="row list-product gird gird-5">
                        @if(!empty(Constant::widget()->spcs))
                        @foreach(Constant::widget()->spcs as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div id="deal-spdt" class="tab-pane fade in">
                    <div class="row list-product gird gird-5">
                        @if(!empty(Constant::widget()->spdt))
                        @foreach(Constant::widget()->spdt as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @else
                        <p class="text-center">Chưa có dữ liệu</p>
                        @endif
                    </div>
                </div>
        </section>

        @if(!empty(Constant::widget()->ddte ))
        <section class="home-sec">
            <div class="block_header">
                <h2 class="block_title">
                    <a href="#">DINH DƯỠNG DÀNH CHO TRẺ EM</a>
                </h2>
            </div>
            <div class="tab-content tab-fix">
                <div class="tab-pane fade active in">
                    <div class="row list-product gird gird-5">

                        @if(!empty(Constant::widget()->ddte))
                        @foreach(Constant::widget()->ddte as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @else
                        <p class="text-center">Chưa có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if(!empty(Constant::widget()->sale ))
        <section class="home-sec">
            <div class="block_header">
                <h2 class="block_title">
                    <a href="#">KHUYẾN MÃI CỰC SỐC</a>
                </h2>
            </div>
            <div class="tab-content tab-fix">
                <div class="tab-pane fade active in">
                    <div class="row list-product gird gird-5">

                        @if(!empty(Constant::widget()->sale))
                        @foreach(Constant::widget()->sale as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @else
                        <p class="text-center">Chưa có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if(!empty(Constant::widget()->hugt ))
        <section class="home-sec">
            <div class="block_header">
                <h2 class="block_title">
                    <a href="#">HÀNG ÚC GIÁ TỐT</a>
                </h2>
            </div>
            <div class="tab-content tab-fix">
                <div class="tab-pane fade active in">
                    <div class="row list-product gird gird-5">

                        @if(!empty(Constant::widget()->hugt))
                        @foreach(Constant::widget()->hugt as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @else
                        <p class="text-center">Chưa có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
        @if(!empty(Constant::widget()->beyeu ))
        <section class="home-sec">
            <div class="block_header">
                <h2 class="block_title">
                    <a href="#">SẢN PHẨM DÀNH CHO BÉ YÊU</a>
                </h2>
            </div>
            <div class="tab-content tab-fix">
                <div class="tab-pane fade active in">
                    <div class="row list-product gird gird-5">

                        @if(!empty(Constant::widget()->beyeu))
                        @foreach(Constant::widget()->beyeu as $item)
                        <div class="col-sm-3 col-lg-3 col">
                            @include('front.includes._item',['data'=>$item])
                        </div>
                        @endforeach
                        @else
                        <p class="text-center">Chưa có dữ liệu</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>
</main>
@endsection
