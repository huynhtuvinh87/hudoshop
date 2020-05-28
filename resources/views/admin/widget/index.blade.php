@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Widgets</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Widgets',
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
                <form method="POST" action="{{ route('admin.widgets.store') }}">
                    <div class="card">

                        @csrf
                        <div class="card-body">
                            <input type="hidden" name="widget_id" value="{{$findWidget['id']}}">
                            <div class="form-group">
                                <label for="prefix">Prefix</label>
                                <input id="prefix" type="text" class="form-control @error('prefix') is-invalid @enderror" name="prefix" value="{{ old('prefix') }}" class="form-control" placeholder="abc">
                                <small><code>Widget::get()->abc </code></small>
                                @error('prefix')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="card">
                                <div class="card-header d-flex p-0">
                                    <ul class="nav nav-sm nav-pills p-2">
                                        <li class="nav-item"><a class="nav-link menu_tab widget_tab_{{ config('global.widget_type.category') }}" href="#tab_category" data-type="{{ config('global.widget_type.category') }}" data-toggle="tab">Categories</a></li>
                                        <li class="nav-item"><a class="nav-link menu_tab widget_tab_{{ config('global.widget_type.html_text') }}" href="#tab_html_text" data-type="{{ config('global.widget_type.html_text') }}" data-toggle="tab">Html Text</a></li>
                                        <li class="nav-item"><a class="nav-link menu_tab widget_tab_{{ config('global.widget_type.page') }}" href="#tab_page" data-type="{{ config('global.widget_type.page') }}" data-toggle="tab">Page</a></li>
                                        <input type="hidden" id="menu_type" name="type" value="">
                                    </ul>
                                </div> <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab_{{ config('global.widget_type.category') }}">
                                            Limit post <input type="number" class="form-control" name="post_limit" value="10">
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
                                        <div class="tab-pane" id="tab_{{ config('global.widget_type.html_text') }}">
                                            <div class="form-group">
                                                <textarea id="textarea_basic" name="content" class="form-control " style="height:150px"></textarea>
                                                @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    {{ $message }}
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane " id="tab_{{ config('global.widget_type.page') }}">
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
                            @if($getwidget)
                            <button name="submit" value="update" class="btn btn-success">Update</button>
                            @endif
                            <button name="submit" value="add" class="btn btn-primary float-right">Add New</button>
                        </div>


                    </div>
                </form>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                @if($getwidget)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title pb-2">
                            <form class="form-inline widget-form" style="margin-left: 0" method="post" action="{{ route('admin.widgets.actions') }}">
                                @csrf

                                <div class="form-group mr-2">
                                    <select name="widget_id" class="form-control  form-control-sm" id="select-widget">
                                        @foreach ($getwidget as $value)
                                        <option value="{{ $value['id'] }}" {{ $findWidget['id']==$value['id']?"selected":"" }}>{{ $value['name']}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <button type="submit" name="submit" value="apply" class="btn btn-success btn-sm">Apply</button>
                                <button type="submit" name="submit" value="delete" class="btn btn-danger btn-sm">Delete</button>
                                <small style="margin-left:10px"><code>Widget::get()->{{$findWidget['prefix']}} </code></small>

                            </form>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped" id="table-ajax">
                                    <thead>
                                        <tr role="row">
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($widgets)
                                        @foreach ($widgets as $widget)
                                        @include('admin/widget/_item',['data'=>$widget])
                                        @endforeach
                                        @endif
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
                    @endif
                    <!-- /.col -->
                </div>
                <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
@endsection
@section('script')
<script>
    $('body').on('change', '.widget_order', function(e) {
        var id = $(this).attr("data-id");
        var val = $(this).val();
        $.ajax({
            type: "POST",
            url: "/admin/widgets/order",
            data: {
                _token: "{{ csrf_token() }}",
                id: id,
                order: val
            },
            success: function(data) {

            },
        });

    });
    $(document).ready(function() {
        CKEDITOR.replace('textarea_basic', {
            fullPage: false,
            // Disable content filtering because if you use full page mode, you probably
            // want to  freely enter any HTML content in source mode without any limitations.
            allowedContent: true,
            height: 320,
            toolbar: [{
                    name: 'document',
                    items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates']
                }, // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic']
                },
                {
                    name: 'insert',
                    items: ['Image']
                },
                {
                    name: 'styles',
                    items: ['Format', 'Font', 'FontSize']
                },
            ],
            filebrowserImageBrowseUrl: "/laravel-filemanager?type=Images",
            filebrowserImageUploadUrl: "/laravel-filemanager/upload?type=Images&_token=",
            filebrowserBrowseUrl: "/laravel-filemanager?type=Files",
            filebrowserUploadUrl: "/laravel-filemanager/upload?type=Files&_token="
        });
    });
</script>
@stop
