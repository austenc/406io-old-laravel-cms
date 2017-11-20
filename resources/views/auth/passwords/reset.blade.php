@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center pt-8">
        <div class="w-full md:w-1/2">
            <h3 class="form-title">Reset Password</h3>

            <form class="card" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-4">
                    <label for="email" class="label">E-Mail Address</label>
                    @include('forms.input', [
                        'name' => 'email',
                        'type' => 'email',
                        'value' => $email ?? old('email'),
                        'attributes' => 'required autofocus'
                    ])
                </div>
                <div class="mb-4">
                    <label for="password" class="label">Password</label>
                    @include('forms.input', [
                        'name' => 'password',
                        'type' => 'password',
                        'attributes' => 'required'
                    ])
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                    @include('forms.input', [
                        'name' => 'password_confirmation',
                        'type' => 'password',
                        'attributes' => 'required'
                    ])
                </div>

                <button type="submit" class="btn bg-blue w-full hover:bg-blue-darker">
                    Reset Password
                </button>
            </form>
        </div>
    </div>
@endsection
