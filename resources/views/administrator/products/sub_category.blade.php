@extends('layouts.administrator')

@section('head')
<title>Sub Category Manager</title>
@endsection

@section('content')
<admin-products-sub-category :categories="{{$categories}}"></admin-products-sub-category>
@endsection