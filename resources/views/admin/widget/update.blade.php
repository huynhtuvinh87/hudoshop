@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (widget header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $widget->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Widgets' =>route('admin.widgets.index'),
                    'Update #'.$widget->id,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <form method="POST" action="{{ route('admin.widgets.update',$widget->id) }}" class="form-horizontal" enctype="multipart/form-data">
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
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $widget->title }}" class="form-control">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="content" class="col-sm-2">Content</label>
                                <div class="col-sm-10">
                                    <textarea id="my-editor" name="content" class="form-control" row=200>{{ $widget->content }}</textarea>
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
                                        <option value="{{ config('global.status.active') }}" {{ config('global.status.active')==$widget->status?"selected":"" }}>Active </option>
                                        <option value="{{ config('global.status.inactive') }}" {{ config('global.status.inactive')==$widget->status?"selected":"" }}>InActive</option>
                                        <option value="{{ config('global.status.close') }}" {{ config('global.status.close')==$widget->status?"selected":"" }}>Close</option>
                                    </select>
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
