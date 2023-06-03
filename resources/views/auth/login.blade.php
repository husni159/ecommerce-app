@extends('layouts.app');

@section('content');
    <h1>Login</h1>

    <form method="POST" action="{{ route('login.post') }}">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Remember Me</label>
        </div>

        <button type="submit">Login</button>
    </form>
@endsection
