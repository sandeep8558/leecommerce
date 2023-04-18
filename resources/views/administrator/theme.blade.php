@extends('layouts.administrator')

@section('head')
<title>Theme Manager</title>
@endsection

@section('content')
@if(isset($theme->primary))
<div class="container-fluid p-4">
    <form action="/administrator/theme" method="get">

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Primary</label>
            <input type="color" class="form-control" value="{{$theme->primary}}" name="primary" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Secondary</label>
            <input type="color" class="form-control" value="{{$theme->secondary}}" name="secondary" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Success</label>
            <input type="color" class="form-control" value="{{$theme->success}}" name="success" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Info</label>
            <input type="color" class="form-control" value="{{$theme->info}}" name="info" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Warning</label>
            <input type="color" class="form-control" value="{{$theme->warning}}" name="warning" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Danger</label>
            <input type="color" class="form-control" value="{{$theme->danger}}" name="danger" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Light</label>
            <input type="color" class="form-control" value="{{$theme->light}}" name="light" style="height:50px;">
        </div>

        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Dark</label>
            <input type="color" class="form-control" value="{{$theme->dark}}" name="dark" style="height:50px;">
        </div>

        <button class="btn btn-primary btn-lg" type="submit">Save Theme</button>

    </form>
</div>
@endif
@endsection