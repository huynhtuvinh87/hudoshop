@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Đơn hàng</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'orders',
                    ]])
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
                        <div id="contacs">
                            <div class="row row-option">
                                <div class="col-sm-12 col-md-6">

                                    <form class="form-inline" method="GET" action="{{ route('admin.orders.index') }}?limit=?">
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
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <tr role="row">
                                                <th>Mã đơn hàng</th>
                                                <th>Họ tên</th>
                                                <th>Email</th>
                                                <th>Điện thoại</th>
                                                <th>Địa chỉ</th>
                                                <th>Tổng tiền</th>
                                                <th>Ghi chú</th>
                                                <th>Trạng thái</th>
                                                <th>Ngày đặt</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                            <tr role="row" class="odd">
                                                <td>{{ $order->code }}</td>
                                                <td>{{ $order->fullname }}</td>
                                                <td>{{ $order->email }}</td>
                                                <td>{{ $order->phone }}</td>
                                                <td>{{ $order->address }}</td>
                                                <td>{{ $order->price}}</td>
                                                <td>{{ $order->note}}</td>
                                                <td>{!! $order->status == 1?'<span class="btn btn-danger btn-sm">Chưa thanh toán</span>':'<span class="btn btn-success btn-sm">Đã thanh toán</span>' !!}</td>
                                                <td>{{ $order->created_at}}</td>
                                                <td width=250>
                                                    <form onsubmit="return confirm('Please confirm you want to delete!');" action="{{ route('admin.orders.destroy',$order->id) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.invoice',$order->id) }}">Hoá đơn</a>
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info pl-2">Showing {{($orders->currentpage()-1)*$orders->perpage()+1}} to {{$orders->currentpage()*$orders->perpage()}}
                                        of {{$orders->total()}} entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                                        {{ $limit?$orders->appends(['limit' => $limit])->links():$orders->links() }}
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
