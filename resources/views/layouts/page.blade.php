@extends('layouts.app')

@section('nav')
<div class="bg-grey-lightest p-4 w-full border-t-4 border-brand border-b-none">
    <div class="container mx-auto w-3/4">
        <a href="{{ url('/') }}" class="logo">
            <img src="/img/logo.png" alt="406.io"> 406.io
        </a>
    </div>
</div>
@endsection
