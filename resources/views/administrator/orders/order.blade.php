@extends('layouts.administrator')
@section('head')
<title>{{$title}}</title>
@endsection

@section('content')

<div class="container-fluid pt-4 px-4">
    <h2>{{$title}} - {{$count}}</h2>
    <hr>
</div>

@if(isset($id))
<div class="container-fluid px-4">
    <form action="/administrator/orders/search" method="get">
        <div class="input-group input-group-lg mb-3">
            <input type="text" class="form-control" value="{{$id}}" name="id" placeholder="">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search Order</button>
        </div>
    </form>
    <hr>
</div>
@endif

@if(sizeof($orders) > 0)
<div class="container-fluid px-4">
    <span class="d-block fs-3"><strong>Order ID:</strong> {{ $orders[0]->id }}</span>
    <span class="d-block fs-6"><strong>Order Placed at:</strong> {{ $orders[0]->created_at }}</span>
    <span class="fs-6"><strong>Delivery Address:</strong> {{ $orders[0]->address->name }} - ({{ $orders[0]->address->mobile }} | {{ $orders[0]->address->email }}): {{ $orders[0]->address->address }} {{ $orders[0]->address->city }} {{ $orders[0]->address->pincode }} {{ $orders[0]->address->state }} {{ $orders[0]->address->country }}</span>
    <span class="d-block fs-6"><strong>Payment Mode:</strong> {{ $orders[0]->paymentmode }}</span>
    <span class="d-block fs-6"><strong>Order Status:</strong> {{ $orders[0]->orderstatus }}</span>
    <span class="d-block fs-6"><strong>Shipping Details:</strong> {{ $orders[0]->shipping }}</span>
    <hr>
</div>

<div class="container-fluid px-4">
    <div class="row fs-6">
        
        @if($orders[0]->created_at != null)
        <div class="col-auto">
            <div class="border p-3">
                Ordered at <br>
                -{{ $orders[0]->created_at }}
            </div>
        </div>
        @endif

        @if($orders[0]->accepted_at != null)
        <div class="col-auto">
            <div class="border p-3">
                Accepted at <br>
                -{{ $orders[0]->accepted_at }}
            </div>
        </div>
        @endif

        @if($orders[0]->packed_at != null)
        <div class="col-auto">
            <div class="border p-3">
                Packed at <br>
                -{{ $orders[0]->packed_at }}
            </div>
        </div>
        @endif

        @if($orders[0]->shipped_at != null)
        <div class="col-auto">
            <div class="border p-3">
                Shipped at <br>
                -{{ $orders[0]->shipped_at }}
            </div>
        </div>
        @endif

        @if($orders[0]->delivered_at != null)
        <div class="col-auto">
            <div class="border p-3">
                Delivered at <br>
                -{{ $orders[0]->delivered_at }}
            </div>
        </div>
        @endif
        
    </div>
    <hr>
</div>

<div class="container-fluid px-4">
    <a class="btn btn-outline-dark ml-2" target="_blank" href="/administrator/print/{{$orders[0]->id}}/label">Label</a>
    <a class="btn btn-outline-dark ml-2" target="_blank" href="/administrator/print/{{$orders[0]->id}}/receipt">Receipt</a>

    @if($forward != null)
        @if($forward != 'Shipped')
            <a class="btn btn-outline-dark float-right mr-2" href="/administrator/order/{{$orders[0]->id}}/forward/{{$forward}}">{{$forward}}</a>
        @endif
        @if($forward == 'Shipped')
            <shipping order_id="{{ $orders[0]->id }}" shipping="{{ $orders[0]->shipping }}"></shipping>
        @endif
    @endif
    @if($reverse != null)
    <a class="btn btn-outline-dark float-right mr-2" href="/administrator/order/{{$orders[0]->id}}/reverse/{{$reverse}}">{{$reverse}}</a>
    @endif
    <hr>
</div>

<div class="container-fluid pb-4 px-4">
{{ $orders->links() }}
</div>

<div class="container-fluid pb-4 px-4">
    @foreach($orders[0]->order_data as $order)
    <div class="row align-items-center mb-4">
        <div class="col-12">
            <!-- {{$order}} -->
        </div>
        <div class="col-auto">
            <div class="image image-s" style="width:135px;">
                <img class="image-cover" src="{{$order->product->media_a}}" alt="{{$order->group_name}}">
            </div>
        </div>
        <div class="col">
            <h3>{{$order->group_name}}</h3>
            <p class="p-0 m-0 mb-1 fs-5">Itemcode: {{$order->itemcode}} - ProductID: {{$order->product_id}}</p>
            <p class="p-0 m-0 mb-1"><span class="fw-bold fs-6">&#8377;{{$order->rate}}</span> <del class="text-danger">MRP &#8377;{{$order->mrp}}</del> (&#8377;{{$order->rate * $order->qty}} for {{$order->qty}}x)</p>
            
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
        <div class="col-auto">
            <p class="btn btn-outline-dark btn-lg fs-4"><b>{{$order->qty}}X</b></p>
        </div>
    </div>
    @endforeach
</div>

<div class="container-fluid px-4 mb-4">
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

<div class="container-fluid px-4">
    {{$orders->appends(request()->except('page'))->links()}}
</div>
@endif
@endsection