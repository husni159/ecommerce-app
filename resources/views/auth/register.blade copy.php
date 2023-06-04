@extends('layouts.app');

@section('content');
<h1>Register</h1>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
        <label for="name">Name</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
    </div>

    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
    </div>

    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="new-password">
    </div>

    <div>
        <label for="password_confirmation">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
    </div>

    <div>
        <label for="user_type">User Type</label>
        <select id="type" name="type" required>
            <option value="employee" >Employee</option>
            <option value="customer" selected>Customer</option>
        </select>
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection
