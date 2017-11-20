@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap justify-center pt-8">
        @if (session('status'))
            <div class="w-full bg-green-light rounded text-white p-3 my-4">
                {{ session('status') }}
            </div>
        @endif
        <div class="w-full md:w-1/2">
            <h3 class="form-title">Reset Password</h3>
            <form class="card" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <label for="email" class="label">Enter Your E-Mail Address</label>
                @include('forms.input', [
                    'name' => 'email',
                    'type' => 'email',
                    'value' => old('email'),
                    'attributes' => 'required autofocus'
                ])

                <button type="submit" class="w-full mt-6 btn bg-blue hover:bg-blue-darker">
                    Send Password Reset Link
                </button>
            </form>
        </div>
    </div>
@endsection
