@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Categories',
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    <div class="card">

                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" class="form-control">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Choose parent</option>
                                    @foreach ($parents as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['title'] }}</option>
                                    @foreach ($value['children'] as $sub1)
                                    <option value="{{ $sub1['id'] }}">- {{ $sub1['title'] }}</option>
                                    @endforeach
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="upload-thumb">
                                    <div class="image image-thumbnail">
                                        <a data-preview="thumb" class="change-upload select-image">
                                            <img src="{{ asset('images/image_default.png') }}" width="200">
                                            <span class="btn btn-default btn-sm">Select image</span>

                                        </a>
                                        <span class="image"></span>
                                        <span class="delete"></span>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Add New</button>
                        </div>


                    </div>
                </form>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>

                        <div class="card-tools float-left">
                            <div class="input-group input-group-sm">
                                <input type="text" id="ajax-search" class="form-control" placeholder="Search keywords">
                                <div class="input-group-append">
                                    <div class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table-ajax">
                                <thead>
                                    <tr role="row">
                                        <th></th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    @include('admin/category/_item',['data'=>$category,'prefix'=>''])
                                    @foreach ($category['children'] as $sub1)
                                    @include('admin/category/_item',['data'=>$sub1,'prefix'=>'-'])
                                    @foreach ($sub1['children'] as $sub2)
                                    @include('admin/category/_item',['data'=>$sub2,'prefix'=>'--'])
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
<script src={{ asset('js/upload.js') }}></script>
@stop
