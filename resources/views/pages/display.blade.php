@extends('layouts.page')

@section('content')
	<h1 class="mb-2 mt-6 text-center">{{ $page->title }}</h1>
	<div class="text-center text-grey-dark text-sm">
		Posted {{ $page->created_at->format('M dS, Y') }}
	</div>
	<a href="{{ url('/') }}" class="block text-center text-sm my-4">
		&laquo; Back to All Posts
	</a>
	<div class="text-lg text-grey-darker leading-normal w-4/5 mx-auto">
		{!! $page->content !!}
	</div>
@endsection

@section('comments')
    @include('partials.disqus')
@endsection