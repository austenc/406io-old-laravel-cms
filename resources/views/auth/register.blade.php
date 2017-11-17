@extends('layouts.app')

@section('content')
<h3 class="form-title">Register</h3>
<form class="card" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="mb-4">
        <label for="name" class="label">Name</label>
        @include('forms.input', [
            'name' => 'name',
            'value' => old('name'),
            'attributes' => 'required autofocus'
        ])
    </div>
    <div class="mb-4">
        <label for="email" class="label">E-Mail Address</label>
        @include('forms.input', [
            'name' => 'email',
            'type' => 'email',
            'value' => old('email'),
            'attributes' => 'required autofocus'
        ])
    </div>
    <div class="mb-4">
        <label for="password" class="label">Password</label>
        @include('forms.input', [
            'name' => 'password',
            'type' => 'password',
            'attributes' => 'required autofocus'
        ])
    </div>    
    <div class="mb-4">
        <label for="password_confirmation" class="label">Confirm Password</label>
        @include('forms.input', [
            'name' => 'password_confirmation',
            'type' => 'password',
            'attributes' => 'required autofocus'
        ])
    </div>


    <button class="btn bg-blue hover:bg-blue-darker" type="submit">
        Register
    </button>
</form>
@endsection
