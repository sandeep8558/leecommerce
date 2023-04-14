@extends('layouts.website')

@section('head')
<title>Vainkho | Online Grocery Store - Shop and Earn Money</title>
<meta name="description" content="Earn more Vainkho!! Buy Grocery online on Vainkho E-commerce. Vainkho is an online grocery Store that offers lowest price on all household shopping. Vainkho deals in daily staples like dal, pulses, grains, flours, spices, oil, noodles, pickles, snacks, packed food, personal care, baby care and so on. We are giving you an opportunity to earn with us through your shopping. We provide free home delivery. So, shop more and earn more with us.">
<meta name="keywords" content="grocery delivery near me,grocery delivery apps near me,buy grocery online near me,grocery delivery app,grocery delivery service,grocery delivery company,grocery delivery,grocery delivery in 24 hours,buy your grocery online,buy grocery online at lowest price,buy grocery online daily needs supermarket - Vainkho,buy grocery online vainkho,buy fresh grocery online,buy home grocery online,buy grocery online india,online buy grocery,online grocery shopping,grocery delivery [location],online grocery shopping [location],online grocery in [location],grocery online in [location],online grocery delivery in [location],buy grocery online [location],grocery delivery in [location],grocery delivery apps [location]">
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endsection

@section('content')

<div class="container pt-5">
    <h2>Checkout</h2>
    <hr>
</div>

<div class="container mt-3">
    <checkout color="{{$color}}" :user="{{$user}}" :alladdresses="{{$user->addresses}}" cod="{{$cod}}" online="{{$online}}" app_name="{{$app_name}}" logo="{{$logo}}"  delivery_timing="{{$delivery_timing}}" :buyqty="{{$buyqty}}" :delivery_charges="{{$delivery_charges}}" :free_delivery_amount="{{$free_delivery_amount}}" :minimum_order_amount="{{$minimum_order_amount}}"><checkout>
</div>

@endsection