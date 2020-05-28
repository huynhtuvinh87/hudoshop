@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Articles</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Articles',
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
                    <div class="card-body pl-0 pr-0">
                        <div id="users">
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
                                    <form class="float-right">
                                        <div class="input-group input-group-sm pr-3">
                                            <input type="text" class="form-control" name="search" value="{{ !empty($_GET['search'])?$_GET['search']:"" }}" placeholder="Search keywords">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr role="row">
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>Giá</th>
                                                    <th>Giá khuyến mãi</th>
                                                    <th>Hãng</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($articles as $article)
                                                <tr role="row" class="odd">
                                                    <td width=50>
                                                        @if($article->image)
                                                        <img width="50" src="{{ $article->image }}">
                                                        @else
                                                        <img width="50" src="{{ asset('images/image_default.png') }}">
                                                        @endif
                                                    </td>
                                                    <td tabindex="0" class="sorting_1">{{ $article->title }}
                                                        <p>{{ url('/s/'.$article->code) }}</p>
                                                    </td>
                                                    <td>{{ Constant::price($article->price) }}</td>
                                                    <td>{{ Constant::price($article->price_sale) }}</td>
                                                    <td>{{ $article->maker_name }}</td>
                                                    <td>{{ Constant::status()[$article->status] }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('admin.articles.edit',$article->id) }}">Update</a>
                                                        <a class="btn btn-sm btn-danger" href="{{ route('admin.articles.trash.delete',$article->id) }}">Trash</a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
