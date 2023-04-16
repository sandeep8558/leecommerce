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

<div class="container pt-5">
    <h2>My Wishlist</h2>
    <hr>
</div>

<div class="container mt-3">

    @if(sizeof($wishlists) <= 0)
    <div class="py-5 text-center">
        <h3>You don't have products added in your wishlist!</h3>
        <a class="btn btn-outline-primary btn-lg" href="/category/1">Continue Shopping</a>
    </div>
    @endif
    
    @foreach($wishlists as $wishlist)
        <wishlist :wishlist="{{$wishlist}}"></wishlist>
    @endforeach
    
</div>

@endsection