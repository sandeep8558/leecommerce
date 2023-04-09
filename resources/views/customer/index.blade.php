@extends('layouts.website')

@section('head')
<title>Dashboard</title>
@endsection

@section('content')
@if(Auth::user()->notOnlyCoustomer())
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
@endif
@endsection