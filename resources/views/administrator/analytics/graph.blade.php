@extends('layouts.administrator')

@section('head')
<title>Category Analytics</title>
@endsection

@section('content')

@include('layouts.graph')
<div class="container-fluid p-4" style="height:80vh;">
    {!! $on->container() !!}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $on->script() !!}
</div>
@endsection