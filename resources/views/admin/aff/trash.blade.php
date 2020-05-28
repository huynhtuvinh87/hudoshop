@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Articles <small>(Trash)</small></h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Articles'=>route('admin.articles.index'),
                    'Trash'
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
            <div class="col-12">

                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="articles">
                            <div class="row row-option">
                                <div class="col-sm-12 col-md-6">

                                    <form class="form-inline" method="GET" action="{{ route('admin.articles.index') }}?limit=?">
                                        <div class="form-group">
                                            <span>Show</span>
                                            <select name="limit" class="form-control mx-sm-2" onchange="this.form.submit()">
                                                <option value="5" {{ $limit==5?"selected":"" }}>5</option>
                                                <option value="10" {{ $limit==10?"selected":"" }}>10</option>
                                                <option value="25" {{ $limit==25?"selected":"" }}>25</option>
                                                <option value="50" {{ $limit==50?"selected":"" }}>50</option>
                                                <option value="100" {{ $limit==100?"selected":"" }}>100</option>
                                            </select>
                                            <span>entries</span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <form class="form-inline float-right">
                                        <div class="form-group">
                                            <span>Search</span>
                                            <input type="text" name="search" value="{{ !empty($_GET['search'])?$_GET['search']:"" }}" class="form-control mx-sm-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th>Image</th>
                                                <th>Title</th>
                                                <th>Slug</th>
                                                <th>User</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($articles as $article)
                                            <tr role="row" class="odd">
                                                <td width=50>
                                                    @if($article->image)
                                                    <img width="50" src="{{ asset('photos/shares/thumbs/'.$article->image) }}">
                                                    @endif
                                                </td>
                                                <td tabindex="0" class="sorting_1">{{ $article->title }}</td>
                                                <td>{{ $article->slug }}</td>
                                                <td>{{ $article->username }}</td>
                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.articles.rolback',$article->id) }}">Rolback</a>
                                                    <a class="btn btn-sm btn-danger" href="{{ route('admin.articles.trash.delete',$article->id) }}">Delete</a>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing {{($articles->currentpage()-1)*$articles->perpage()+1}} to {{$articles->currentpage()*$articles->perpage()}}
                                        of {{$articles->total()}} entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $limit?$articles->appends(['limit' => $limit])->links():$articles->links() }}
                                    </div>
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
