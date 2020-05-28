@extends('admin.layouts.app')

@section('content')
<div class="content-wrapper" style="min-height: 1200.88px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6">
                    @include('admin.includes.breadcrumb', ['breadcrumbs' => [
                    'Setting',
                    ]])
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-5">
                <form method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf
                    @foreach ($setting as $value)
                    <div class="form-group row">
                        <label for="{{ $value['option'] }}" class="col-sm-3">{{ $value['option_name'] }}</label>
                        <div class="col-sm-9">
                            @if($value['type']=='input')
                            <input id="{{ $value['option'] }}" type="text" class="form-control " name="{{ $value['option'] }}" value="{{ $value['value'] }}" class="form-control">
                            @else
                            <textarea class="form-control " name="{{ $value['option'] }}" style="height: 100px">{!! $value['value'] !!}</textarea>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary float-right">Update</button>

                </form>
            </div>
        </div>

    </section>
</div>
@endsection
