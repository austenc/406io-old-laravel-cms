@extends('layouts.page')

@section('content')
	<div class="mx-auto w-3/4">
		<h1 class="mb-2 text-center">{{ $page->title }}</h1>
		<div class="text-center text-grey-dark text-sm">
			Posted {{ $page->created_at->format('M dS, Y') }}
		</div>
		<a href="{{ url('/') }}" class="block text-center text-sm my-4">
			&laquo; Back to All Posts
		</a>
		<div class="text-lg leading-normal">{!! $page->content !!}</div>
	</div>
@endsection