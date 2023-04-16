@extends('layouts.website')

@section('head')
    @if($meta != null)
        <title>{{$meta->title}}</title>
        <meta name="description" content="{{$meta->description}}">
        <meta name="keywords" content="{{$meta->keywords}}">
        <!-- Twitter Card data -->
        <meta name="twitter:title" content="{{$meta->title}}">
        <meta name="twitter:description" content="{{$meta->description}}">
        <meta name="twitter:image" content="{{$meta->media}}">
        <meta name="twitter:card" content="summary">
        <!-- Open Graph data -->
        <meta property="og:title" content="{{$meta->title}}" />
        <meta property="og:description" content="{{$meta->description}}" />
        <meta property="og:image" content="{{$meta->media}}" />
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="{{$meta->title}}" />
    @endif
@endsection

@section('content')


@if($product != null)

<div class="container-fluid shadow">
    <div class="container py-2">
        <a class="btn btn-dark" href="{{url()->previous()}}"><< Go Back</a>
    </div>
</div>
<div class="container py-4">
    <product-detail :product="{{$product}}" :pid="{{$pid}}" :user="{{$user}}" :buyqty="{{$buyqty}}"></product-detail>    
</div>
@endif

@endsection