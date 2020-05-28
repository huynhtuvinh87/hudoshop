@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $article->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Articles' =>route('admin.articles.index'),
                    'Update #'.$article->id,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('admin.articles.update',$article->id) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2">Tiêu để</label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $article->title }}" class="form-control">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Slug</label>
                                <div class="col-sm-10">
                                    <input id="slug" type="text" class="form-control @error('title') is-invalid @enderror" name="slug" value="{{ $article->slug }}" class="form-control">

                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea name="description" rows="5" class="form-control">{{ $article->description }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea id="my-editor" name="content" class="form-control">{{ $article->content }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Hình ảnh</label>
                                <div class="col-sm-10">
                                    <div>
                                        <ul class='images image-list clearfix images-pev'>
                                            @php
                                            if($article->images){
                                            $count = (count($article->images) > 8)?count($article->images)-1:8;
                                            }else{
                                            $count =8;
                                            }

                                            @endphp
                                            @for($i=0;$i<$count; $i++) <li>
                                                <div class="upload-{{ $i }}">
                                                    <div class="image image-thumbnail">
                                                        @if(!empty($article->images[$i]))
                                                        <a data-preview="{{ $i }}" class="change-upload select-image">
                                                            <img src="{{ !empty($article->images[$i])?$article->images[$i]:asset('images/image_default.png') }}">
                                                            <span class="btn btn-default btn-sm">Select image</span>

                                                        </a>
                                                        <span class="image">
                                                            <input type="hidden" name="images[]" value="{{ $article->images[$i] }}">
                                                        </span>
                                                        <span class="delete">
                                                            <a class="delete-image btn btn-danger btn-sm" data-id="{{ $i }}">Delete</a>
                                                        </span>
                                                        @else
                                                        <a data-preview="{{ $i }}" class="change-upload select-image">
                                                            <img src="/image.php?src=images/image_default.png&size=180x200">
                                                            <span class="btn btn-default btn-sm">Select image</span>
                                                        </a>
                                                        <span class="image">
                                                        </span>
                                                        <span class="delete">
                                                        </span>
                                                        @endif
                                                        @if($i==0)
                                                        <p>Ảnh bìa</p>
                                                        @else
                                                        <p>Hình {{$i+1}}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                </li>
                                                @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2">Meta từ khoá</label>
                                <div class="col-sm-10">
                                    <input name="meta_keyword" class="form-control" value="{{ $article->meta_keyword }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2">Meta mô tả</label>
                                <div class="col-sm-10">
                                    <textarea name="meta_description" rows="5" class="form-control">{{ $article->meta_description }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="status" class="col-sm-3">Trạng thái</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="{{ config('global.status.active') }}" {{ config('global.status.active')==$article->status?"selected":"" }}>Active </option>
                                        <option value="{{ config('global.status.inactive') }}" {{ config('global.status.inactive')==$article->status?"selected":"" }}>InActive</option>
                                        <option value="{{ config('global.status.close') }}" {{ config('global.status.close')==$article->status?"selected":"" }}>Close</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="maker_id" class="col-sm-3">Hãng</label>
                                <div class="col-sm-9">
                                    <select name="maker_id" class="form-control">
                                        <option value="">Chọn hãng sản xuất </option>
                                        @foreach ($maker as $value)
                                        <option value="{{ $value['id'] }}" {{ $value['id']==$article->maker_id?'selected':'' }}>{{ $value['name'] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-sm-3">Danh mục</label>
                                <div class="col-sm-9">
                                    @foreach ($category as $value)
                                    <div class="icheck-primary">
                                        <input id="checkbok_{{ $value['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $value['id'] }}" {{ in_array($value['id'],$postCategory)?"checked":"" }}>
                                        <label for="checkbok_{{ $value['id'] }}" class=" form-check-label">{{ $value['title']}}</label>
                                    </div>
                                    @foreach ($value['children'] as $sub1)
                                    <div class="ml-4 icheck-primary">
                                        <input id="checkbok_{{ $sub1['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $sub1['id'] }}" {{ in_array($sub1['id'],$postCategory)?"checked":"" }}>
                                        <label for="checkbok_{{ $sub1['id'] }}" class="form-check-label">{{ $sub1['title']}}</label>
                                    </div>
                                    @foreach ($sub1['children'] as $sub2)
                                    <div class="ml-5 icheck-primary">
                                        <input id="checkbok_{{ $sub2['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $sub2['id'] }}" {{ in_array($sub2['id'],$postCategory)?"checked":"" }}>
                                        <label for="checkbok_{{ $sub2['id'] }}" class="form-check-label">{{ $sub2['title'] }}</label>
                                    </div>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3">Giá</label>
                                <div class="col-sm-9">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $article->price }}" class="form-control">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-3">Giá KM</label>
                                <div class="col-sm-9">
                                    <input id="price_sale" type="text" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" value="{{ $article->price_sale }}" class="form-control">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Cập nhập</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')


<script type="text/javascript" src={{ asset('js/upload.js') }}></script>
@stop