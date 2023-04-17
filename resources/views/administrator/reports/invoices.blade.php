@extends('layouts.administrator')

@section('head')
<title>Sale Report</title>
@endsection

@section('content')
<div class="container-fluid p-4">
    <form action="/administrator/reports/invoices" method="get">
        <div class="input-group mb-3">
            <input value="{{$from}}" name="from" type="date" class="form-control shadow-none">
            <input value="{{$to}}" name="to" type="date" class="form-control shadow-none">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">GO</button>
        </div>
    </form>
</div>

<div class="container-fluid px-4 mb-4 fs-3">
    <div class="row justify-content-left">

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">mrp total</p>
                <p class="m-0 fs-3">&#8377;{{$mrp_total}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">cost total</p>
                <p class="m-0 fs-3">&#8377;{{$cost_total}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">tax total</p>
                <p class="m-0 fs-3">&#8377;{{$tax_total}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">rate total</p>
                <p class="m-0 fs-3">&#8377;{{$rate_total}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">discount</p>
                <p class="m-0 fs-3">&#8377;{{$discount}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">offer discount</p>
                <p class="m-0 fs-3">&#8377;{{$offer_discount}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">delivery</p>
                <p class="m-0 fs-3">&#8377;{{$delivery}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">payable</p>
                <p class="m-0 fs-3">&#8377;{{$payable}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">Total Invoices</p>
                <p class="m-0 fs-3">{{$invoices}}X</p>
            </div>
        </div>

    </div>
</div>

<div class="container-fluid px-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer</th>
                <th scope="col">Date</th>
                <th scope="col">MRP Total</th>
                <th scope="col">Cost Total</th>
                <th scope="col">Tax Total</th>
                <th scope="col">Rate Total</th>
                <th scope="col">Discount</th>
                <th scope="col">Offer Discount</th>
                <th scope="col">Delivery</th>
                <th scope="col">Payable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale as $s)
                <tr>
                    <th scope="row">{{$s->id}}</th>
                    <td>{{$s->address->name}}</td>
                    <td>{{$s->created_at}}</td>
                    <td>{{$s->mrp_total}}</td>
                    <td>{{$s->cost_total}}</td>
                    <td>{{$s->tax_total}}</td>
                    <td>{{$s->rate_total}}</td>
                    <td>{{$s->discount}}</td>
                    <td>{{$s->offer_discount}}</td>
                    <td>{{$s->delivery}}</td>
                    <td>{{$s->payable}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container-fluid px-4 mb-4 fs-3">
    {{$sale->appends(request()->except('page'))->links()}}
</div>

@endsection

@section('scripts')
@parent
@endsection
