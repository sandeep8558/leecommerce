@extends('layouts.website')

@section('head')
<title>Vainkho | Online Grocery Store - Shop and Earn Money</title>
<meta name="description" content="Earn more Vainkho!! Buy Grocery online on Vainkho E-commerce. Vainkho is an online grocery Store that offers lowest price on all household shopping. Vainkho deals in daily staples like dal, pulses, grains, flours, spices, oil, noodles, pickles, snacks, packed food, personal care, baby care and so on. We are giving you an opportunity to earn with us through your shopping. We provide free home delivery. So, shop more and earn more with us.">
<meta name="keywords" content="grocery delivery near me,grocery delivery apps near me,buy grocery online near me,grocery delivery app,grocery delivery service,grocery delivery company,grocery delivery,grocery delivery in 24 hours,buy your grocery online,buy grocery online at lowest price,buy grocery online daily needs supermarket - Vainkho,buy grocery online vainkho,buy fresh grocery online,buy home grocery online,buy grocery online india,online buy grocery,online grocery shopping,grocery delivery [location],online grocery shopping [location],online grocery in [location],grocery online in [location],online grocery delivery in [location],buy grocery online [location],grocery delivery in [location],grocery delivery apps [location]">
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