@extends('auth::components.layouts.master')

@section('content')
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <a href="{{ route('password.request') }}">Forgot Password?</a>
        <a href="{{ route('register') }}">Register</a>
    </div>
@endsection