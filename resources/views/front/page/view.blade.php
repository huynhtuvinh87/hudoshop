@extends('front.layouts.app')
@section('title',$page->title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keyword)
@section('content')

<main>
    <div id="home-page" class="container container-mobile" style="min-height:650px">
        <div style="margin-top: 20px;" class="row">
            <div class="col-sm-3">
                <ul id="tree" class="tree">
                    <li class="branch"><i class="indicator glyphiconglyphicon glyphicon-minus"></i><a href="javascript:void(0)">Hỗ trợ khách hàng</a>
                        <ul style="display: block;">
                            @if(!empty(Constant::widget()->help))
                            @foreach(Constant::widget()->help as $k=>$value)
                            <li><a href="{{url('p/'.$value->slug.'-'.$value->id)}}">{{$value->title}}</a></li>
                            @endforeach
                            @endif
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-sm-9">
                <h4>{{$page->title}}</h4>
                {!! $page->content !!}
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
