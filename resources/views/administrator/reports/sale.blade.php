@extends('layouts.administrator')

@section('head')
<title>Sale Report</title>
@endsection

@section('content')
<div class="container-fluid p-4">
    <form action="/administrator/reports/sale" method="get">
        <div class="input-group mb-3">
            <input value="{{$from}}" name="from" type="date" class="form-control shadow-none">
            <input value="{{$to}}" name="to" type="date" class="form-control shadow-none">
            <select name="what" class="form-select" id="inputGroupSelect01">
                <option {{ $what == "" ? 'selected' : '' }} value="">All</option>
                <option {{ $what == "category_id" ? 'selected' : '' }} value="category_id">Category</option>
                <option {{ $what == "sub_category_id" ? 'selected' : '' }} value="sub_category_id">Sub Category</option>
                <option {{ $what == "product_group_id" ? 'selected' : '' }} value="product_group_id">Product Group</option>
                <option {{ $what == "product_id" ? 'selected' : '' }} value="product_id">Product</option>
            </select>
            <input value="{{$id}}" name="id" type="text" class="form-control shadow-none" placeholder="Enter Product ID">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">GO</button>
        </div>
    </form>
</div>

<div class="container-fluid px-4 mb-4 fs-3">
    <div class="row justify-content-left">
        <div class="col-12 col-md-6 mb-3">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">Sale Amount</p>
                <p class="m-0 fs-3">&#8377;{{$total_amount}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">Purchase Amount</p>
                <p class="m-0 fs-3">&#8377;{{$purchase}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <div class="shadow p-3 rounded-lg text-center alert alert-info">
                <p class="m-0 fs-6 text-uppercase">Profit</p>
                <p class="m-0 fs-3">&#8377;{{$profit}}/-</p>
            </div>
        </div>

        <div class="col-12 col-md-6 mb-3">
            <div class="shadow p-3 rounded-lg text-center alert alert-primary">
                <p class="m-0 fs-6 text-uppercase">Sale Cycles</p>
                <p class="m-0 fs-3">{{$sale_cycles}}X</p>
            </div>
        </div>
        <div class="col-12 col-md-6 mb-3">
            <div class="shadow p-3 rounded-lg text-center alert alert-warning">
                <p class="m-0 fs-6 text-uppercase">Sale Quantity</p>
                <p class="m-0 fs-3">{{$total_qty}}X</p>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product ID</th>
                <th scope="col">Order ID</th>
                <th scope="col">Product</th>
                <th scope="col">Customer</th>
                <th scope="col">Date</th>
                <th scope="col">Qty</th>
                <th scope="col">Rate</th>
                <th scope="col">Sale</th>
                <th scope="col">Purchase</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale as $s)
                <tr>
                    <th scope="row">{{$s->id}}</th>
                    <td>{{$s->product_id}}</td>
                    <td>{{$s->order_id}}</td>
                    <td>{{$s->group_name}}</td>
                    <td>{{$s->order->address->name}}</td>
                    <td>{{$s->created_at}}</td>
                    <td>{{$s->qty}}</td>
                    <td>{{$s->rate}}</td>
                    <td>{{$s->rate_total}}</td>
                    <td>{{$s->purchase_amount}}</td>
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
