@extends('auth::components.layouts.master')

@section('content')
    <div class="container">
        <h1>Register</h1>
        <div style="margin-top: 20px;">
            <a href="{{ route('social.redirect', 'github') }}"
                style="display: inline-block; padding: 10px 20px; background: #333; color: white; text-decoration: none; border-radius: 5px;">Register
                with GitHub</a>
        </div>
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
@endsection