@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Pages' =>route('admin.pages.index'),
                    'Add New',
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('admin.pages.store') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2">Title</label>
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
                                <label for="description" class="col-sm-2">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Content</label>
                                <div class="col-sm-10">
                                    <textarea id="my-editor" name="content" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2">Meta Keyword</label>
                                <div class="col-sm-10">
                                    <input name="meta_keyword" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2">Meta Description</label>
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
                                <label for="status" class="col-sm-3">Status</label>
                                <div class="col-sm-9">
                                    <select name="status" class="form-control">
                                        <option value="{{ config('global.status.active') }}">Active </option>
                                        <option value="{{ config('global.status.inactive') }}">InActive</option>
                                    </select>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="image" class="col-sm-3">Image</label>
                                <div class="col-sm-9">
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
