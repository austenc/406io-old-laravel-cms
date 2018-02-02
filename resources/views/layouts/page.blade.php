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

@section('content')
    <div class="container mx-auto w-3/4 pb-8 pt-2 px-2">
    	@yield('content')
    </div>
@endsection

@section('footer')
	<div class="footer">
	    <strong class="text-lg block mb-4 font-heading">
	        <i class="fa fa-heart text-red"></i> Follow Me On Social Media 
	    </strong>
	    <div class="text-xl mb-4">
	        <div class="fa-2x">
	            <a href="https://twitch.tv/austencam" class="fa-layers fa-fw text-white twitch-icon">
	                <i class="fas fa-circle"></i>
	                <i class="fab fa-twitch" data-fa-transform="shrink-6"></i>
	            </a>
	            <a href="https://twitter.com/austencam" class="fa-layers fa-fw text-white twitter-icon">
	                <i class="fas fa-circle"></i>
	                <i class="fab fa-twitter" data-fa-transform="shrink-6"></i>
	            </a>
	        </div>
	    </div>

	    <div class="copyright">
	        Copyright &copy; {{ date('Y') }} Austen Cameron, all rights reserved
	    </div>
	</div>
@endsection