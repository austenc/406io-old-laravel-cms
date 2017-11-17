@extends('layouts.app')

@section('content')
<h3 class="form-title">Register</h3>
<form class="card" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="mb-4">
        <label for="name" class="label">Name</label>
        <input id="name" type="name" name="name" class="input {{ $errors->has('name') ? ' border-red' : '' }}" value="{{ old('name') }}" required autofocus>

        @include('validation.errors', ['field' => 'name'])
    </div>
    <div class="mb-4">
        <label for="email" class="label">E-Mail Address</label>
        <input id="email" type="email" name="email" class="input {{ $errors->has('email') ? ' border-red' : '' }}" value="{{ old('email') }}" required autofocus>

        @include('validation.errors', ['field' => 'email'])
    </div>
    <div class="mb-4">
        <label for="password" class="label">Password</label>
        <input id="password" type="password" name="password" class="input {{ $errors->has('password') ? ' border-red' : '' }}" value="{{ old('password') }}" required autofocus>

        @include('validation.errors', ['field' => 'password'])
    </div>    
    <div class="mb-4">
        <label for="password_confirmation" class="label">Confirm Password</label>
        <input id="password_confirmation" type="password_confirmation" name="password_confirmation" class="input {{ $errors->has('password_confirmation') ? ' border-red' : '' }}" value="{{ old('password_confirmation') }}" required autofocus>

        @include('validation.errors', ['field' => 'password_confirmation'])
    </div>


    <button class="btn bg-blue hover:bg-blue-darker" type="submit">
        Register
    </button>
</form>
@endsection
