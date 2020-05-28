@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (aff header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Affs <a href="{{ route('admin.affs.create') }}" class="btn btn-primary btn-sm">Add New</a></h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Aff',
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
                        <div id="affs">
                            <div class="row row-option">
                                <div class="col-sm-12 col-md-6">

                                    <form class="form-inline" method="GET" action="{{ route('admin.affs.index') }}?limit=?">
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
                                                    <th>Link</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($affs as $aff)
                                                <tr role="row" class="odd">
                                                    <td width=50>
                                                        @if($aff->image)
                                                        <img width="50" src="{{ $aff->image }}">
                                                        @else
                                                        <img width="50" src="{{ asset('images/image_default.png') }}">
                                                        @endif
                                                    </td>
                                                    <td tabindex="0" class="sorting_1">{{ $aff->title }}</td>
                                                    <td>{{ url('/f/'.$aff->code) }}
                                                        <p>{{$aff->content}}</p>
                                                    </td>
                                                    <td>{{ config('global.status.label.'.$aff->status) }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-success" href="{{ route('admin.affs.edit',$aff->id) }}">Update</a>
                                                        <a class="btn btn-sm btn-danger" href="{{ route('admin.affs.trash.delete',$aff->id) }}">Trash</a>

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
                                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing {{($affs->currentpage()-1)*$affs->perpage()+1}} to {{$affs->currentpage()*$affs->perpage()}}
                                        of {{$affs->total()}} entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $limit?$affs->appends(['limit' => $limit])->links():$affs->links() }}
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
