@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center pt-8">
        <div class="w-full md:w-1/2">
            <h3 class="form-title">Login</h3>
            <form method="POST" action="{{ route('login') }}" class="card">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label for="email" class="label">E-Mail Address</label>
                    <input id="email" type="email" name="email" class="input @hasError($errors, 'email')" value="{{ old('email') }}" required autofocus>
                    @include('validation.errors', ['field' => 'email'])
                </div>
                <div class="mb-6">
                    <label for="password" class="label">Password</label>
                    <input id="password" type="password" name="password" class="input @hasError($errors, 'password')" value="{{ old('password') }}" required autofocus>
 
                    @include('validation.errors', ['field' => 'password'])
                </div>

                <div class="mb-6">
                    <label class="text-gray-dark text-sm">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                </div>
                <div class="flex items-center justify-between">
                    <button class="btn bg-blue hover:bg-blue-darker" type="submit">
                        Sign In
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker no-underline hover:underline" href="{{ route('password.request') }}">
                        Forgot Password?
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
