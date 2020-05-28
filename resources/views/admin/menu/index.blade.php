@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menus</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Menu',
                    ]])
                </div>
                <div class="col-sm-12">
                    @include('admin.includes.alert')
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-3">
                <form method="POST" action="{{ route('admin.menus.store') }}">
                    <div class="card">

                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="menu_id" value="{{$menu_id}}">
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select name="parent_id" class="form-control">
                                    <option value="">Choose parent</option>
                                    @foreach ($parents as $value)
                                    <option value="{{ $value['id'] }}">{{ $value['title']}}</option>
                                    @foreach ($value['children'] as $sub1)
                                    <option value="{{ $sub1['id'] }}">- {{ $sub1['title'] }}</option>
                                    @endforeach
                                    @endforeach

                                </select>
                            </div>
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-pills p-2">
                                        <li class="nav-item"><a class="nav-link menu_tab menu_tab_{{ config('global.menu_type.category') }} active" href="#tab_category" data-type="{{ config('global.menu_type.category') }}" data-toggle="tab">Categories</a></li>
                                        <li class="nav-item"><a class="nav-link menu_tab menu_tab_{{ config('global.menu_type.custom_url') }}" href="#tab_url" data-type="{{ config('global.menu_type.custom_url') }}" data-toggle="tab">Custom url</a></li>
                                        <li class="nav-item"><a class="nav-link menu_tab menu_tab_{{ config('global.menu_type.page') }}" href="#tab_page" data-type="{{ config('global.menu_type.page') }}" data-toggle="tab">Page</a></li>
                                        <input type="hidden" id="menu_type" name="type" value="">
                                    </ul>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab_{{ config('global.menu_type.category') }}">
                                            @foreach ($category as $value)
                                            <input type="hidden" name="category_title_{{ $value['id'] }}" value="{{ $value['title'] }}">
                                            <input type="hidden" name="category_url_{{ $value['id'] }}" value="{{ URL::to('/').'/category/'.$value['slug'] }}">
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
                                            @error('category_id')
                                            <span class="invalid-feedback" style="display: block" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="tab_{{ config('global.menu_type.custom_url') }}">
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
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane " id="tab_{{ config('global.menu_type.page') }}">
                                            @foreach ($page as $value)
                                            <input type="hidden" name="page_title_{{ $value['id'] }}" value="{{ $value['title'] }}">
                                            <input type="hidden" name="page_url_{{ $value['id'] }}" value="{{ URL::to('/').'/page/'.$value['slug'] }}">
                                            <div class="icheck-primary">
                                                <input id="checkbok_page_{{ $value['id'] }}" type="checkbox" class="form-check-input" name="page_id[]" value="{{ $value['id'] }}">

                                                <label for="checkbok_page_{{ $value['id'] }}" class=" form-check-label">{{ $value['title'] }}</label>
                                            </div>
                                            @endforeach
                                            @error('page_id')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>



                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button name="submit" class="btn btn-primary float-right">Add New</button>
                        </div>


                    </div>
                </form>
            </div>
            <!-- /.col -->
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <form class="form-inline menu-form" style="margin-left: 0" method="post" action="{{ route('admin.menus.actions') }}">
                                @csrf

                                <div class="form-group mr-2">
                                    <input type="text" class="form-control" name="menu_name" placeholder="Menu new">
                                </div>

                                <button type="submit" name="submit" value="add" class="btn btn-primary">Add New</button>
                                <span style="margin:0 10px"> or</span>
                                <div class="form-group mr-2">
                                    <select name="menu_id" class="form-control" id="select-menu">
                                        @foreach ($getMenu as $value)
                                        <option value="{{ $value['id'] }}" {{ $menu_id==$value['id']?"selected":"" }}>{{ $value['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" name="submit" value="apply" class="btn btn-success btn-sm">Apply</button>
                                <button type="submit" name="submit" value="delete" class="btn btn-danger">Delete</button>


                            </form>
                        </div>

                        <div class="card-tools">

                            <div class="input-group input-group-sm">
                                <input name="text" id="ajax-search" class="form-control" placeholder="Search keywords">
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
                                        <th>Order</th>
                                        <th>Title</th>
                                        <th>Link</th>

                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $category)
                                    @include('admin/menu/_item',['data'=>$category,'prefix'=>''])
                                    @foreach ($category['children'] as $sub1)
                                    @include('admin/menu/_item',['data'=>$sub1,'prefix'=>'-'])
                                    @foreach ($sub1['children'] as $sub2)
                                    @include('admin/menu/_item',['data'=>$sub2,'prefix'=>'--'])
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer p-0">
                        <div class="list-controls">
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script>
    $('body').on('change', '.menu_order', function(e) {
        var id = $(this).attr("data-id");
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "/admin/menus/order",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                order: val
            },
            success: function(data) {

            },
        });

    });
</script>
@stop
