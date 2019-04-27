@extends('layout')

@section('display')
<form>

    <div>
        <h1>Join </h1>
        <p>Signing in allows you to have private lists</p>
    </div>

    <input type="email" placeholder="Email">
    <input type="password" placeholder="password">
    <input type="password" placeholder="password (again)">
    <button>Register</button>
</form>
@endsection 

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

 @endsection