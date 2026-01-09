@extends('auth::components.layouts.master')

@section('content')
    <div class="container">
        <h1>Forgot Password</h1>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <button type="submit">Send Reset Link</button>
        </form>
        <a href="{{ route('login') }}">Back to Login</a>
    </div>
@endsection