<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông tin giao hàng</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('order') }}" id="form-order">
                    @csrf
                    <input type="hidden" name="payment" value="1" id="order-payment">
                    <div class="form-group row">
                        <label for="name" class="col-sm-3">Họ và tên</label>
                        <div class="col-sm-9">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check()?Auth::user()->name:'' }}" class="form-control">
                            <span class="invalid-feedback error-name" role="alert">
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3">Email</label>
                        <div class="col-sm-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check()?Auth::user()->email:'' }}">
                            <span class="invalid-feedback error-email" role="alert">

                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-3">Điện thoại</label>
                        <div class="col-sm-9">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ Auth::check()?Auth::user()->phone:'' }}" class="form-control">
                            <span class="invalid-feedback error-phone" role="alert">

                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-3">Địa chỉ</label>
                        <div class="col-sm-9">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::check()?Auth::user()->address:'' }}" class="form-control">
                            <span class="invalid-feedback error-address" role="alert">
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="province" class="col-sm-3">Tỉnh/thành</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="province">
                                @foreach(Province::get() as $key=>$province)
                                <option value="{{$key}}" {{ $key=='HN'?'selected':'' }}>{{$province}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="note" class="col-sm-3">Ghi chú</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="note" style="height:100px"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-primary" id="order">Đặt hàng</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
