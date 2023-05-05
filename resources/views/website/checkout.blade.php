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
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

@section('content')

<div class="container-fluid shadow">
    <div class="container py-2">
        <a class="btn btn-dark" href="{{url()->previous()}}"><< Go Back</a>
    </div>
</div>

<div class="container pt-5">
    <h2>Checkout</h2>
    <hr>
</div>

<div class="container mt-3">
    <checkout razorpay_key="{{$razorpay_key}}" color="{{$color}}" :user="{{$user}}" :alladdresses="{{$user->addresses}}" cod="{{$cod}}" online="{{$online}}" app_name="{{$app_name}}" logo="{{$logo}}"  delivery_timing="{{$delivery_timing}}" :buyqty="{{$buyqty}}" :delivery_charges="{{$delivery_charges}}" :free_delivery_amount="{{$free_delivery_amount}}" :minimum_order_amount="{{$minimum_order_amount}}"><checkout>
</div>

@endsection