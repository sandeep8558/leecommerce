@extends('layouts.administrator')

@section('head')
<title>Product Group Manager</title>
@endsection

@section('content')
<admin-products-product-group :categories="{{$categories}}" :sub_categories="{{$sub_categories}}"></admin-products-product-group>
@endsection