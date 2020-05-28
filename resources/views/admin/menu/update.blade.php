@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update #{{ $menu->id }}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Menu' =>route('admin.menus.index'),
                    'Update #'.$menu->id,
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
                    <form method="POST" action="{{ route('admin.menus.update',$menu->id) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="card-body">

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $menu->title }}" class="form-control">

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="link">Link</label>
                                <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link',$menu->link) }}" class="form-control">

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
                                    @if($value['id'] != $menu->id)
                                    <option value="{{ $value['id'] }}" {{ $value['id'] == $menu->parent_id?"selected":""  }}>{{ $value['title'] }}</option>
                                    @endif
                                    @foreach ($value['children'] as $sub1)
                                    @if($sub1['id'] != $menu->id)
                                    <option value="{{ $sub1['id'] }}" {{ $sub1['id'] == $menu->parent_id?"selected":""  }}>- {{ $sub1['title'] }}</option>
                                    @endif
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
