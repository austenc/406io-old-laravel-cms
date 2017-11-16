@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center pt-8">
        <div class="w-full md:w-1/2">
            <h3 class="text-center text-grey-dark mb-6 uppercase">Login</h3>
            <form method="POST" action="{{ route('login') }}" class="card">
                {{ csrf_field() }}
                <div class="mb-4">
                    <label for="email" class="label">E-Mail Address</label>
                    <input id="email" type="email" name="email" class="input {{ $errors->has('email') ? ' border-red' : '' }}" value="{{ old('email') }}" required autofocus>

                    @if ($errors->has('email'))
                        <p class="text-red text-xs italic">
                            <strong>{{ $errors->first('email') }}</strong>
                        </p>
                    @endif
                </div>
                <div class="mb-6">
                    <label for="password" class="label">Password</label>
                    <input id="password" type="password" name="password" class="input {{ $errors->has('password') ? ' border-red' : '' }}" value="{{ old('password') }}" required autofocus>

                    @if ($errors->has('password'))
                        <p class="text-red text-xs italic">
                            <strong>{{ $errors->first('password') }}</strong>
                        </p>
                    @endif
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
