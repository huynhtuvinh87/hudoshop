@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $aff->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Aff' =>route('admin.pages.index'),
                    'Update #'.$aff->id,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('admin.affs.update',$aff->id) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row">
                <div class="col-9">
                    <div class="card">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="title" class="col-sm-2">Title</label>
                                <div class="col-sm-10">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $aff->title }}" class="form-control">

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
                                    <input id="slug" type="text" class="form-control @error('title') is-invalid @enderror" name="slug" value="{{ $aff->slug }}" class="form-control">

                                    @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Link Aframe</label>
                                <div class="col-sm-10">
                                    <input id="content" type="text" class="form-control @error('content') is-invalid @enderror" name="content" value="{{ $aff->content }}" class="form-control">

                                    @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" rows="5" class="form-control">{{ $aff->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="meta_keyword" class="col-sm-2">Meta Keyword</label>
                                <div class="col-sm-10">
                                    <input name="meta_keyword" class="form-control" value="{{ $aff->meta_keyword }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="meta_description" class="col-sm-2">Meta Description</label>
                                <div class="col-sm-10">
                                    <textarea name="meta_description" rows="5" class="form-control">{{ $aff->meta_description }}</textarea>
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
                                        <option value="{{ config('global.status.active') }}" {{ config('global.status.active')==$aff->status?"selected":"" }}>Active </option>
                                        <option value="{{ config('global.status.inactive') }}" {{ config('global.status.inactive')==$aff->status?"selected":"" }}>InActive</option>
                                        <option value="{{ config('global.status.close') }}" {{ config('global.status.close')==$aff->status?"selected":"" }}>Close</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="image" class="col-sm-3">Image</label>
                                <div class="col-sm-9">
                                    <div class="upload-thumb">
                                        <div class="image image-thumbnail">
                                            @if(!empty($aff->image))
                                            <a data-preview="thumb" class="change-upload select-image">
                                                <img src="{{ $aff->image }}" width="200">
                                                <span class="btn btn-default btn-sm">Select image</span>

                                            </a>
                                            <span class="image">
                                                <input type="hidden" name="image" value="{{ $aff->image }}">
                                            </span>
                                            <span class="delete">
                                                <a class="delete-image btn btn-danger btn-sm" data-id="thumb">Delete</a>
                                            </span>
                                            @else
                                            <a data-preview="thumb" class="change-upload select-image">
                                                <img src="{{ asset('images/image_default.png') }}" width="200">
                                                <span class="btn btn-default btn-sm">Select image</span>
                                            </a>
                                            <span class="image"></span>
                                            <span class="delete"></span>
                                            @endif
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


<script type="text/javascript" src={{ asset('js/upload.js') }}></script>
@stop
