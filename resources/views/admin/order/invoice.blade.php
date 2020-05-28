@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Hoá đơn cho đơn hàng #{{$order->code}}</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Đơn hàng' =>route('admin.orders.index'),
                    'Hoá đơn #'.$order->code,
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr role="row">
                                <th>Image</th>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $invoice)
                            <tr role="row" class="odd">
                                <td width=50>
                                    @if($invoice->image)
                                    <img width="50" src="{{ $invoice->image }}">
                                    @else
                                    <img width="50" src="{{ asset('images/image_default.png') }}">
                                    @endif
                                </td>
                                <td tabindex="0" class="sorting_1">{{ $invoice->title }}</td>
                                <td>{{ $invoice->price }}</td>
                                <td>{{ $invoice->quantity }}</td>
                                <td>{{ $invoice->price * $invoice->quantity }}</td>

                            </tr>
                            @endforeach
                            <tr>
                                <td colspan=5>
                                    <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}
                                        <div class="row ">
                                            <select name="status" class="form-control col-sm-1">
                                                <option value="">Chọn trạng thái</option>
                                                <option value="1">Chờ thanh toán</option>
                                                <option value="2">Đã thanh toán</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-success  col-sm-1">Câp nhật</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</section>
</div>
@endsection
