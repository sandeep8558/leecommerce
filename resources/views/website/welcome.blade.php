@extends('layouts.website')

@section('head')
<title>Vainkho | Online Grocery Store - Shop and Earn Money</title>
<meta name="description" content="Earn more Vainkho!! Buy Grocery online on Vainkho E-commerce. Vainkho is an online grocery Store that offers lowest price on all household shopping. Vainkho deals in daily staples like dal, pulses, grains, flours, spices, oil, noodles, pickles, snacks, packed food, personal care, baby care and so on. We are giving you an opportunity to earn with us through your shopping. We provide free home delivery. So, shop more and earn more with us.">
<meta name="keywords" content="grocery delivery near me,grocery delivery apps near me,buy grocery online near me,grocery delivery app,grocery delivery service,grocery delivery company,grocery delivery,grocery delivery in 24 hours,buy your grocery online,buy grocery online at lowest price,buy grocery online daily needs supermarket - Vainkho,buy grocery online vainkho,buy fresh grocery online,buy home grocery online,buy grocery online india,online buy grocery,online grocery shopping,grocery delivery [location],online grocery shopping [location],online grocery in [location],grocery online in [location],online grocery delivery in [location],buy grocery online [location],grocery delivery in [location],grocery delivery apps [location]">
@endsection

@section('content')

<div class="container-fluid px-0">

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            @foreach($sliders as $i=>$slider)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}" class="{{$i==0 ? 'active' : ''}}" aria-current="{{$i==0 ? true : false}}" aria-label="Slide {{$i}}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($sliders as $i=>$slider)
                <div class="carousel-item {{$i==0 ? 'active' : ''}}">
                    <a class="w-100" href="{{$slider->link}}">
                        <div class="image image-l image-header-md">
                            <img src="{{$slider->media}}" class="image-cover" alt="{{$slider->title}}">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    
    </div>

</div>


<div class="container-fluid text-center py-5">
    <div class="container">
        <h2 class="fw-bold">{{ $welcome_title }}</h2>
        <p class="lead">{{ $welcome_note }}</p>
        <hr>
        <p>{{ $welcome_call }}</p>
        <a class="btn btn-lg btn-primary mr-3" href="/register">Register Now!</a>
        <a class="btn btn-lg btn-dark" href="/category/3">Shop Now!</a>
    </div>

</div>

<div class="container">
    <div class="row">
        @foreach($features as $feature)
        <div class="col-12 col-md-6 mb-5">
            <a class="btn btn-clear w-100" href="{{$feature->link}}">
                <div class="image image-hd rounded-lg">
                    <img src="{{$feature->media}}" class="image-cover" alt="{{$feature->title}}">
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>



@endsection
