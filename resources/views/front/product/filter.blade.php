@extends('front.layouts.app')
@section('title','Tìm kiếm')
@section('description','Tìm kiếm')
@section('keywords','Tìm kiếm')
@section('og_image',!empty($data[0])?Constant::getFileImage($data[0]->image):"")
@section('content')
<main>
    <div class="container">
        <ul class="breadcrumb">
            <li>Trang chủ</li>
            <li class="active">Tìm kiếm</li>
        </ul>
    </div>
    <form id="formSearch" action="/filter" method="get">
        <div class="container container-mobile">
            <div class="filter-mobi" id="filter-mobi">
                <div class="left">

                    <p>Tìm thấy 0 sản phẩm</p>
                </div>
                <div class="right">
                    <a href="#" class="button-filter">Bộ lọc<i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="category-content">
                <div class="main-content">
                    <div class="top-content">

                    </div>
                    <div class="content">
                        <div id="sidebar">
                            <div class="sidebar-inner">
                                <div class="header-mobi">
                                    <a href="#" class="btn back"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Quay lại</a>
                                    Bộ lọc </div>
                                <div class="product-filters">
                                    <div class="widget">
                                        <div class="widget-title">
                                            <h4>Danh mục</h4>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                        <div class="list-radio filter-category">
                                            @if(Constant::menu()->category)
                                            @foreach(Constant::menu()->category as $k=>$value)
                                            <div class="item {{ (!empty($_GET['category']) && $_GET['category'] == $k) ? 'active' : '' }}">
                                                <label class="radio">
                                                    <input type="radio" id="filter-category_{{$k}}" name="category" value="{{$value->type_id}}" {{ (!empty($_GET['category']) && $_GET['category'] == $k) ? 'checked' : '' }}>
                                                    <span>{{$value->title}}</span>
                                                </label>


                                            </div>
                                            @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="widget">
                                        <div class="widget-title">
                                            <h4>Hãng sản xuất</h4>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                        <div class="list-radio filter-category">
                                            @foreach(Constant::maker() as $k=>$value)

                                            <div class="item {{ (!empty($_GET['maker']) && $_GET['maker'] == $k) ? 'active' : '' }}">
                                                <label class="radio">
                                                    <input type="radio" id="filter-maker_{{$k}}" name="maker" value="{{$value->id}}" {{ (!empty($_GET['maker']) && $_GET['maker'] == $k) ? 'checked' : '' }}>
                                                    <span>{{$value->name}}</span>
                                                </label>


                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="widget">
                                        <div class="widget-title">
                                            <h4>Giá</h4>
                                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                                        </div>
                                        <div class="price">
                                            <label>
                                                <input type="number" name="from_price" id="filter-from_price" value="{{ !empty($_GET['from_price'])?$_GET['from_price']:'' }}" placeholder="Giá từ">
                                            </label>
                                            <span>-</span>
                                            <label>
                                                <input type="number" name="to_price" id="filter-to_price" value="{{ !empty($_GET['to_price'])? $_GET['to_price']:'' }}" placeholder="đến">
                                            </label>
                                            <button><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="nav-bottom"><button type="submit" class="btn btn-success btn-apply">Áp dụng</button><button type="button" class="btn btn-default btn-reset">Xóa</button></div>
                            </div>
                        </div>
                        <input type="hidden" name="keywords" id="filter-keywords" value="{{!empty($_GET['keywords'])?$_GET['keywords']:''}}">
                        <div id="content">
                            <div id="list-wrapper">
                                <div class="list-product row gird">
                                    @foreach($data as $val)
                                    <div class="col-sm-3 col-lg-3">
                                        @include('front.includes._item',['data'=>$val])
                                    </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{ $data->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>
@endsection
@section('script')
<script>
    $('.list-cat').hide();
    $(document).ready(function() {

        if ($(window).width() >= 1024) {
            $("#formSearch").on("change", "input:checkbox, input:radio", function() {
                $("#formSearch").submit();
            });
        } else {
            $("#formSearch .filter-category").on("change", "input:radio", function() {
                $(".list-checkbox").hide();
                $(this).parent().parent().find(".list-checkbox").show();
            });
        }
        $("body").on('click', '.btn-reset', function() {
            $('#formSearch input:checkbox').removeAttr('checked');
            $('#formSearch input:checkbox').prop('checked', false);
            $('#formSearch input:radio').prop('checked', false);
            $('#formSearch input:text').val("");
            $('#formSearch input[type=number]').val("");
            return false;
        });
        var filter_selected = '';
        if (typeof $("input[name='category']:checked").val() != "undefined") {
            var category = $("input[name='category']:checked");
            category.parent().addClass("active");
            $('.list-search button span').html(category.next('span').html());
            filter_selected += selected(category.next('span').html(), category.attr('id'));
        }
        if ($("input[name='from_price']").val() != "") {
            filter_selected += selected($("input[name='from_price']").val(), $("input[name='from_price']").attr('id'));
        }
        if ($("input[name='to_price']").val() != "") {
            filter_selected += selected($("input[name='to_price']").val(), $("input[name='to_price']").attr('id'));
        }
        if ($("input[name='keywords']").val() != "") {
            filter_selected += selected($("input[name='keywords']").val(), $("input[name='keywords']").attr('id'));
        }
        $("#filter_selected").html(filter_selected);
        $('.filter-remove').on('click', function() {
            var id = $(this).attr('data-id');
            $("#" + id).val("");
            $("#" + id).prop('checked', false);
            $("#formSearch").submit();
            return false;
        });

    });

    function selected(title, id) {
        return '<div class="btn-group"> <button type="button" class="btn btn-default">' + title + '</button> <button type="button" data-id="' + id + '" class="btn btn-default filter-remove"> <i class="close"></i></button></div>';
    }
    // scroll bar
    $('.scrollbar-inner').scrollbar();
</script>
@stop
