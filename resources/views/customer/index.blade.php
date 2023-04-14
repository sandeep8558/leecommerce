@extends('layouts.website')

@section('head')
<title>My Account</title>
@endsection

@section('content')
@if(Auth::user()->notOnlyCoustomer())
<div class="container-fluid shadow">
    <div class="container p-2 text-center">
        @foreach(Auth::user()->roles as $role)
            @switch($role->role)

                @case("Administrator")
                    <a class="btn btn-dark" href="/administrator">Administrator</a>
                @break

                @case("Web-Admin")
                    <a class="btn btn-dark" href="/webadmin">Web-Admin</a>
                @break

                @case("Store Manager")
                    <a class="btn btn-dark" href="/storemanager">Store Manager</a>
                @break
            
            @endswitch
        @endforeach
    </div>
</div>
@endif

<div class="container my-4">
    {{ $orders->links() }}
</div>

<div class="container py-2">
    <span class="d-block fs-3"><strong>Order ID:</strong> {{ $orders[0]->id }}</span>
    <span class="d-block fs-6"><strong>Order Placed at:</strong> {{ $orders[0]->created_at }}</span>
    <span class="d-block fs-6"><strong>Expected Delivery Time:</strong> {{ $delivery_timing }}</span>
</div>

<div class="container py-2">
    <span class="fs-6"><strong>Delivery Address:</strong> {{ $orders[0]->address->name }} - ({{ $orders[0]->address->mobile }} | {{ $orders[0]->address->email }}): {{ $orders[0]->address->address }} {{ $orders[0]->address->city }} {{ $orders[0]->address->pincode }} {{ $orders[0]->address->state }} {{ $orders[0]->address->country }}</span>
</div>

<div class="container py-2">
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Bill Breakup - &#8377;{{$orders[0]->payable}} - {{$orders[0]->paymentmode == 'COD' ? 'Cash On Delivery' : ($orders[0]->paymentmode == 'Online' ? 'Online Payment' : '')}}
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">MRP Total <span class="float-right">&#8377;{{$orders[0]->mrp_total}}</span></li>
                    <li class="list-group-item">Cost Total <span class="float-right">&#8377;{{$orders[0]->cost_total}}</span></li>
                    <li class="list-group-item">Tax Total <span class="float-right">&#8377;{{$orders[0]->tax_total}}</span></li>
                    <li class="list-group-item">Rate Total <span class="float-right">&#8377;{{$orders[0]->rate_total}}</span></li>
                    <li class="list-group-item">Discount <span class="float-right">&#8377;{{$orders[0]->discount}}</span></li>
                    <li class="list-group-item">Offer Discount <span class="float-right">&#8377;{{$orders[0]->offer_discount}}</span></li>
                    <li class="list-group-item">Delivery <span class="float-right">&#8377;{{$orders[0]->delivery}}</span></li>
                    <li class="list-group-item">Payable Amount <span class="float-right"><strong>&#8377;{{$orders[0]->payable}}</strong></span></li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    @foreach($orders[0]->order_data as $order)
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <!-- {{$order}} -->
        </div>
        <div class="col-4 col-md-3 col-lg-2">
            <div class="image image-s">
                <img class="image-cover" src="{{$order->product->media_a}}" alt="{{$order->group_name}}">
            </div>
        </div>
        <div class="col">
            <h3>{{$order->group_name}}</h3>
            <p class="p-0 m-0 mb-1"><span class="fw-bold fs-6">&#8377;{{$order->rate}}</span> <del class="text-danger">MRP &#8377;{{$order->mrp}}</del> (&#8377;{{$order->rate * $order->qty}} for {{$order->qty}}x)</p>
            <p class="p-0 m-0 mb-1">Quantity Purchased: <b>{{$order->qty}}X</b></p>
            <p class="p-0 m-0 mb-1" style="line-height:32px;">
                @if($order->color != null)
                <span class="mr-3"><span style="display:inline-block; width:32px;height:32px;background-color:{{$order->color}}; border: 1px solid #cccccc;">.</span></span>
                @endif
                @if($order->weight != null)
                <span class="mr-3">{{$order->weight}}</span>
                @endif
                @if($order->volume != null)
                <span class="mr-3">{{$order->volume}}</span>
                @endif
                @if($order->size != null)
                <span class="mr-3">{{$order->size}}</span>
                @endif
            </p>
        </div>
    </div>
    @endforeach
</div>

@if($cancellation == 'Enable')
<cancel-button order_id="{{$orders[0]->id}}" cancelled_at="{{$orders[0]->cancelled_at}}" shipped_at="{{$orders[0]->shipped_at}}"></cancel-button>
@endif

<div class="container my-4">
    {{ $orders->links() }}
</div>
@endsection