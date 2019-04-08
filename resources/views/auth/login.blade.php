@extends('layout')

@section('display')
<form>
        <div>
            <h1>Sign In</h1>
            <p>Signing in allows you to have private lists</p>
        </div>
    
        <input type="email" id="at-field-email" name="at-field-email" placeholder="Email" autocapitalize="none" autocorrect="off">
        <input type="password" id="at-field-password" name="at-field-password" placeholder="Password" autocapitalize="none" autocorrect="off">
        <button  class="btn-primary">Sign In</button>
    </form>
@endsection 