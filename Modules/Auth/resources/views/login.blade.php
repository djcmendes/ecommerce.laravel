@extends('auth::components.layouts.master')

@section('content')
    <div class="container">
        <h1>Login</h1>
        <div style="margin-top: 20px;">
            <a href="{{ route('social.redirect', 'github') }}"
                style="display: inline-block; padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 5px;">Login
                with GitHub</a>
        </div>
        <a href="{{ route('password.request') }}">Forgot Password?</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
@endsection