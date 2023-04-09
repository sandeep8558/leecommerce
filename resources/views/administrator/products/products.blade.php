@extends('layouts.administrator')

@section('head')
<title>Products Manager</title>
@endsection

@section('content')
<admin-products-products :product_group="{{$product_group}}"></admin-products-products>
@endsection