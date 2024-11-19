@extends('layouts.app')

@section('content')
<div id="login-app">
    <EmpleadoLogin></EmpleadoLogin>
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@endsection