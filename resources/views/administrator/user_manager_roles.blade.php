@extends('layouts.administrator')

@section('head')
<title>User Roles Manager</title>
@endsection

@section('content')

<admin-user-manager-roles :user_id="{{$id}}"></admin-user-manager-roles>
@endsection