@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $category->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Categories' =>route('admin.categories.index'),
                    'Update #'.$category->id,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <!-- form start -->
                    <form method="POST" action="{{ route('admin.categories.update',$category->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $category->title }}" class="form-control">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="5" class="form-control">{{ $category['description'] }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Choose parent</option>
                                    @foreach ($parents as $value)
                                    @if($value['id'] != $category->id)
                                    <option value="{{ $value['id'] }}" {{ $value['id'] == $category->parent_id?"selected":""  }}>{{ $value['title'] }}</option>
                                    @endif
                                    @foreach ($value['children'] as $sub1)
                                    @if($sub1['id'] != $category->id)
                                    <option value="{{ $sub1['id'] }}" {{ $sub1['id'] == $category->parent_id?"selected":""  }}>- {{ $sub1['title'] }}</option>
                                    @endif
                                    @endforeach
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image" class="col-sm-3">Image</label>
                                <div class="col-sm-9">
                                    <div class="upload-thumb">
                                        <div class="image image-thumbnail">
                                            @if(!empty($article->image))
                                            <a data-preview="thumb" class="change-upload select-image">
                                                <img src="{{ $article->image }}" width="200">
                                                <span class="btn btn-default btn-sm">Select image</span>

                                            </a>
                                            <span class="image"> <input type="hidden" name="image" value="{{ $article->image }}">
                                            </span>
                                            <span class="delete"> <a class="delete-image btn btn-danger btn-sm" data-id="thumb">Delete</a>
                                            </span>


                                            @else
                                            <a data-preview="thumb" class="change-upload select-image">
                                                <img src="{{ asset('images/image_default.png') }}" width="200">
                                                <span class="btn btn-default btn-sm">Select image</span>
                                            </a>
                                            <span class="image">
                                            </span>
                                            <span class="delete">
                                            </span>
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
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
<script src={{ asset('js/upload.js') }}></script>
@stop
