@extends('layouts.administrator')

@section('head')
<title>Dashboard</title>
@endsection

@section('content')

<div class="container-fluid p-4 mb-4 fs-3">

Praise the Lord
    <div class="row justify-content-left">
        
        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/orders/pending">
                <div class="shadow p-3 rounded-lg text-center alert alert-info">
                    <p class="m-0 fs-6 text-uppercase">Pending Orders</p>
                    <p class="m-0 fs-3">{{$dashboard["pending"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/orders/accepted">
                <div class="shadow p-3 rounded-lg text-center alert alert-info">
                    <p class="m-0 fs-6 text-uppercase">Accepted Orders</p>
                    <p class="m-0 fs-3">{{$dashboard["accepted"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/orders/packed">
                <div class="shadow p-3 rounded-lg text-center alert alert-info">
                    <p class="m-0 fs-6 text-uppercase">Packed Orders</p>
                    <p class="m-0 fs-3">{{$dashboard["packed"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/orders/shipped">
                <div class="shadow p-3 rounded-lg text-center alert alert-info">
                    <p class="m-0 fs-6 text-uppercase">Shipped Orders</p>
                    <p class="m-0 fs-3">{{$dashboard["shipped"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/orders/delivered">
                <div class="shadow p-3 rounded-lg text-center alert alert-info">
                    <p class="m-0 fs-6 text-uppercase">Delivered Orders</p>
                    <p class="m-0 fs-3">{{$dashboard["delivered"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/user_manager">
                <div class="shadow p-3 rounded-lg text-center alert alert-warning">
                    <p class="m-0 fs-6 text-uppercase">Customers</p>
                    <p class="m-0 fs-3">{{$dashboard["customers"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/products/category">
                <div class="shadow p-3 rounded-lg text-center alert alert-primary">
                    <p class="m-0 fs-6 text-uppercase">Categories</p>
                    <p class="m-0 fs-3">{{$dashboard["categories"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/products/sub_category">
                <div class="shadow p-3 rounded-lg text-center alert alert-primary">
                    <p class="m-0 fs-6 text-uppercase">Sub Categories</p>
                    <p class="m-0 fs-3">{{$dashboard["sub_categories"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="/administrator/products/product_group">
                <div class="shadow p-3 rounded-lg text-center alert alert-primary">
                    <p class="m-0 fs-6 text-uppercase">Product Groups</p>
                    <p class="m-0 fs-3">{{$dashboard["product_groups"]}}X</p>
                </div>
            </a>
        </div>

        <div class="col-12 col-md-6 mb-2">
            <a class="btn btn-clear w-100 p-0" href="#">
                <div class="shadow p-3 rounded-lg text-center alert alert-primary">
                    <p class="m-0 fs-6 text-uppercase">Products</p>
                    <p class="m-0 fs-3">{{$dashboard["products"]}}X</p>
                </div>
            </a>
        </div>

    </div>
</div>

@endsection
