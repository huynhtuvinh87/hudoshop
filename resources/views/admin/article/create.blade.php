@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Thêm mới</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Sản phẩm' =>route('admin.articles.index'),
                    'Thêm mới',
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('admin.articles.store') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2">Tiêu để</label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" class="form-control">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Nội dung</label>
                                <div class="col-sm-10">
                                    <textarea id="my-editor" name="content" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Hình ảnh</label>
                                <div class="col-sm-10">
                                    <ul class='images image-list clearfix'>
                                        @for($i=0;$i<8; $i++) <li>
                                            <div class="upload-{{ $i }}">
                                                <div class="image image-thumbnail">
                                                    <a data-preview="{{ $i }}" class="change-upload select-image">
                                                        <img src="{{ asset('images/image_default.png') }}" width="200">
                                                        <span class="btn btn-default btn-sm">Select image</span>

                                                    </a>
                                                    <span class="image"></span>
                                                    <span class="delete"></span>
                                                </div>
                                                @if($i==0)
                                                <p>Ảnh bìa</p>
                                                @else
                                                <p>Hình {{$i+1}}</p>
                                                @endif
                                            </div>
                                            </li>
                                            @endfor
                                    </ul>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2">Meta từ khoá</label>
                                <div class="col-sm-10">
                                    <input name="meta_keyword" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2">Meta mô tả</label>
                                <div class="col-sm-10">
                                    <textarea name="meta_description" rows="5" class="form-control"></textarea>
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
                                <label for="status" class="col-sm-4">Trạng thái</label>
                                <div class="col-sm-8">
                                    <select name="status" class="form-control">
                                        @foreach (Constant::status() as $id=>$value)
                                        <option value="{{ $id }}">{{ $value}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="maker_id" class="col-sm-4">Hãng sản xuất</label>
                                <div class="col-sm-8">
                                    <select name="maker_id" class="form-control">
                                        <option value="">Chọn hãng </option>
                                        @foreach ($maker as $value)
                                        <option value="{{ $value['id'] }}">{{ $value['name'] }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category" class="col-sm-4">Danh mục</label>
                                <div class="col-sm-8">
                                    @foreach ($category as $value)
                                    <div class="icheck-primary">
                                        <input id="checkbok_{{ $value['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $value['id'] }}">
                                        <label for="checkbok_{{ $value['id'] }}" class=" form-check-label">{{ $value['title'] }}</label>
                                    </div>
                                    @foreach ($value['children'] as $sub1)
                                    <div class="ml-4 icheck-primary">
                                        <input id="checkbok_{{ $sub1['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $sub1['id'] }}">
                                        <label for="checkbok_{{ $sub1['id'] }}" class="form-check-label">{{ $sub1['title'] }}</label>
                                    </div>
                                    @foreach ($sub1['children'] as $sub2)
                                    <div class="ml-5 icheck-primary">
                                        <input id="checkbok_{{ $sub2['id'] }}" type="checkbox" class="form-check-input" name="category_id[]" value="{{ $sub2['id'] }}">
                                        <label for="checkbok_{{ $sub2['id'] }}" class="form-check-label">{{ $sub2['title'] }}</label>
                                    </div>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="price" class="col-sm-4">Giá</label>
                                <div class="col-sm-8">
                                    <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" class="form-control">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-4">Giá khuyến mãi</label>
                                <div class="col-sm-8">
                                    <input id="price_sale" type="text" class="form-control @error('price_sale') is-invalid @enderror" name="price_sale" value="{{ old('price_sale') }}" class="form-control">

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
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
<script src={{ asset('js/upload.js') }}></script>
@stop
