@extends('layouts.administrator')

@section('head')
<title>Product Wise Sale Report</title>
@endsection

@section('content')
<div class="container-fluid p-4">
    <form action="/administrator/reports/products" method="get">
        <div class="input-group mb-3">
            <input value="{{$from}}" name="from" type="date" class="form-control shadow-none">
            <input value="{{$to}}" name="to" type="date" class="form-control shadow-none">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">GO</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@parent
@endsection
