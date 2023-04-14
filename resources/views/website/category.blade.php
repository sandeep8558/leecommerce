@extends('layouts.website')

@section('head')
<title>Vainkho | Online Grocery Store - Shop and Earn Money</title>
<meta name="description" content="Earn more Vainkho!! Buy Grocery online on Vainkho E-commerce. Vainkho is an online grocery Store that offers lowest price on all household shopping. Vainkho deals in daily staples like dal, pulses, grains, flours, spices, oil, noodles, pickles, snacks, packed food, personal care, baby care and so on. We are giving you an opportunity to earn with us through your shopping. We provide free home delivery. So, shop more and earn more with us.">
<meta name="keywords" content="grocery delivery near me,grocery delivery apps near me,buy grocery online near me,grocery delivery app,grocery delivery service,grocery delivery company,grocery delivery,grocery delivery in 24 hours,buy your grocery online,buy grocery online at lowest price,buy grocery online daily needs supermarket - Vainkho,buy grocery online vainkho,buy fresh grocery online,buy home grocery online,buy grocery online india,online buy grocery,online grocery shopping,grocery delivery [location],online grocery shopping [location],online grocery in [location],grocery online in [location],online grocery delivery in [location],buy grocery online [location],grocery delivery in [location],grocery delivery apps [location]">
@endsection

@section('content')

<div class="container-fluid shadow">
    <div class="container py-2 submenus text-center">
        <div class="btn-group">
            <a href="/category/{{$category->id}}" class="btn btn-outline-dark px-5 {{ (request()->is('category/'.$category->id)) ? 'active' : '' }}" aria-current="page">All</a>
            @foreach($category->sub_categories as $i=>$sub)
            <a href="/category/{{$category->id}}/sub_category/{{$sub->id}}" class="btn btn-outline-dark px-5 {{ (request()->is('category/'.$category->id.'/sub_category/'.$sub->id)) ? 'active' : '' }}" aria-current="page">{{$sub->sub_category}}</a>
            @endforeach
        </div>
    </div>
</div>

@if($banner != null || $banner != '')
<div class="container py-3">
    <div class="image image-banner-1 rounded-xl">
        <img class="image-cover" src="{{$banner}}" alt="">
    </div>
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
