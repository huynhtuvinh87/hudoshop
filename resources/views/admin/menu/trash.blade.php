@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories <small>(Trash)</small></h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Categories'=>route('admin.categories.index'),
                    'Trash'
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
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="categories">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Title</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                            <tr role="row" class="odd">
                                                <td>{{ $category['title'] }}</td>
                                                <td width=200>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.categories.rolback',$category['id']) }}">Rolback</a>
                                                    <a class="btn btn-sm btn-danger" href="{{ route('admin.categories.destroy',$category['id']) }}">Delete</a>
                                                </td>
                                            </tr>
                                    
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
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
