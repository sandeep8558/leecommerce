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

<div class="container-fluid shadow">
    <div class="container py-2 submenus text-center">
        @if($category != null || $category != '')
        <div class="btn-group">
            <a href="/category/{{$category->id}}" class="btn btn-outline-dark ButtonLink px-5 {{ (request()->is('category/'.$category->id)) ? 'active' : '' }}" aria-current="page">All</a>
            @foreach($category->sub_categories as $i=>$sub)
            <a href="/category/{{$category->id}}/sub_category/{{$sub->id}}" class="btn btn-outline-dark ButtonLink px-5 {{ (request()->is('category/'.$category->id.'/sub_category/'.$sub->id)) ? 'active' : '' }}" aria-current="page">{{$sub->sub_category}}</a>
            @endforeach
        </div>
        @endif

        @if($category == null || $category == '')
        <form action="/search" method="get">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control shadow-none" placeholder="Type here to Search Products" name="search" id="search" aria-describedby="button-addon2" value="{{$search}}">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
            </div>
        </form>
        @endif
    </div>
</div>


@if($banner != null || $banner != '')
<div class="container py-3">
    <div class="image image-banner-1 rounded-xl">
        <img class="image-cover" src="{{$banner}}" alt="">
    </div>
</div>
@endif

@if(sizeof($products) <= 0)
<div class="container py-5 text-center" style="height:50vh;">
    <h1>Opps!</h1>
    <p>Products not found.</p>
</div>
@endif

<div class="container mt-2">
    <div class="row justify-content-center">
        @foreach($products as $product)
        <div class="col-10 col-sm-9 col-md-6 col-lg-4 col-xl-3 mb-4">
            <product :product="{{$product}}" :user="{{$user}}" :buyqty="{{$buyqty}}"></product>
        </div>
        @endforeach
    </div>
</div>

<div class="container">
    {{$products->links()}}
</div>

@endsection
