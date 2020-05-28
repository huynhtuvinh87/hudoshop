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
                    <form method="POST" action="{{ route('admin.menus.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" class="form-control">
                                    <option value="{{ config('global.menu.key.header') }}">Header</option>
                                    <option value="{{ config('global.menu.key.footer') }}">Footer</option>
                                    <option value="{{ config('global.menu.key.category') }}">Category</option>
                                    <option value="{{ config('global.menu.key.body') }}">Body</option>
                                </select>
                            </div>
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
                                <label for="link">Link</label>
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" class="form-control">

                                @error('link')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
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
