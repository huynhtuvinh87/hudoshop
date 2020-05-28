@extends('layouts.afl')
@section('title',$page->title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keyword)
@section('og_image',$page->image)
@section('content')

<iframe src="{{ $page->content }}" style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0;">
</iframe>


@endsection
