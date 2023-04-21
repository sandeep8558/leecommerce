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
        <a class="btn btn-lg btn-dark" href="/category/1">Shop Now!</a>
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


<div class="container px-0">

    <div id="OfferSlider" class="carousel slide">
        <div class="carousel-indicators">
            @foreach($offers as $i=>$offer)
                <button type="button" data-bs-target="#OfferSlider" data-bs-slide-to="{{$i}}" class="{{$i==0 ? 'active' : ''}}" aria-current="{{$i==0 ? true : false}}" aria-label="Slide {{$i}}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($offers as $i=>$offer)
                <div class="carousel-item {{$i==0 ? 'active' : ''}}">
                    <a class="w-100" href="{{$offer->link}}">
                        <div class="image image-l image-header-md">
                            <img src="{{$offer->media}}" class="image-cover" alt="{{$offer->title}}">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#OfferSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#OfferSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    
    </div>

</div>
@endsection