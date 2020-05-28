<header>
    <div class="bottom">
        <div class="container container-mobile">
            <div class="row">
                <div class="col-xs-3" id="bars">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div id="logo">
                        <a href="/">
                            <img src="{{asset(Constant::setting()->logo)}}" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col-sm-5 col-xs-12" id="filter-header">
                    <div class="form-search">
                        <form id="search_form" method="get" role="search" action="/filter">
                            <div class="input-group search-wrap">
                                <div class="input-group-btn list-search">
                                    <input type="hidden" id="search_category" name="category" value="0">
                                    <button type="button" class="btn btn-default dropdown-toggle dropdown-button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <span>Tất cả danh mục</span>
                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                    </button>
                                    <ul class="dropdown-menu ">
                                        <li data-category="0">Tất cả danh mục</li>
                                        @if(Constant::menu()->category)
                                        @foreach(Constant::menu()->category as $k=>$value)
                                        <li data-category="{{$value->type_id}}" class="{{ (!empty($_GET['category']) && $_GET['category'] == $k) ? 'active' : '' }}">- {{$value->title}}</li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>

                                <input type="search" id="search-key" name="keywords" autocomplete="off" value="{{!empty($_GET['keywords'])?$_GET['keywords']:''}}" placeholder="Tìm kiếm sản phẩm">
                                <button class="btn search-header" type="submit">
                                    <img src="/shop/svg/search.svg" width="20">
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-3 header-right">
                    <i class="fa fa-search icon-search"></i>
                    <div id="user_info_header">
                        @if(!Auth::check())
                        <a href="{{route('login')}}">
                            <img src="/shop/svg/user-black.svg">
                            <span>Đăng nhập <br> Đăng ký</span>
                        </a>
                        @else
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/shop/svg/user-black.svg">
                            <h5 class="name-user">{{Auth::user()->name}}</h5><small>Tài khoản</small>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/thong-tin-tai-khoan">Thông tin cá nhân</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                        @endif
                    </div>
                    <div class="header-cart">
                        <a href="/cart/checkout">
                            <img src="/shop/svg/cart-black.svg">
                            <span class="circle">{{Cart::getTotalQuantity()}}</span>
                            <p class="hidden-xs hidden-sm text-cart">Giỏ hàng</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container container-mobile">
            <nav class="main-nav-wrap active">
                <a href="#" class="main-nav-toggle"><span>Danh mục </span> <i class="fa fa-angle-down"></i></a>
                <ul class="list-cat" style="display: block">
                    @if(Constant::menu()->category)
                    @foreach(Constant::menu()->category as $k=>$value)
                    <li><a href="{{$value->link}}"> {{$value->title}}</a></li>
                    @endforeach
                    @endif
                </ul>
            </nav>
            @if(Constant::menu()->menuheader)
            @foreach(Constant::menu()->menuheader as $k=>$value)
            <a href="{{$value->link}}"> {{$value->title}}</a>
            @endforeach
            @endif
        </div>
    </div>
</header>
