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
    <div class="container-fluid">
        @foreach($content as $i=>$c)

            @if($c->what == 'Paragraph')
                <div class="container p-0">
                    <p class="lead py-2 {{$c->classes}}">{{$c->content}}</p>
                </div>
            @endif

            @if($c->what == 'Title')
                <div class="container p-0">
                    <h3 class="h3 py-2 {{$c->classes}}">{{$c->content}}</h3>
                </div>
            @endif

            @if($c->what == 'Image')
                <div class="container p-0 {{$c->classes}}">
                    <div class="image image-header">
                        <img src="{{$c->media}}" class="image-cover">
                    </div>
                </div>
            @endif

        @endforeach
    </div>
@endsection