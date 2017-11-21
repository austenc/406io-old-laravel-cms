@extends('layouts.page')

@section('content')
	<div class="w-3/4 mx-auto leading-normal">
		<h1 class="text-center text-grey-dark mb-8">Welcome</h1>
		<p class="my-8 text-center text-grey">This is the story of building a new website. Here are the latest posts:</p>
		
		{{-- List Recent Pages --}}
		@foreach ($pages as $page)
		<div class="text-center text-lg card mb-8">
			<a class="text-blue font-bold text-2xl text-left block" href="{{ $page->url }}">
				{{ $page->title }}
			</a>
			<p class="mb-8 mt-4">
				{{ str_limit(strip_tags($page->content), 200) }}
			</p>
		</div>
		@endforeach
	</div>
@endsection