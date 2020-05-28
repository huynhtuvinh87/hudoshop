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
                    'Categories' =>route('admin.categories.index'),
                    'Add New',
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
                    <form method="POST" action="{{ route('admin.categories.store') }}">
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
                            <div class="form-group row">
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
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
