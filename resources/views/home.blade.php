@extends('layouts.page')

@section('content')
	<div class="w-3/4 mx-auto leading-normal">
{{-- 		<h1 class="text-center text-grey-darker mb-8">Welcome</h1>
		<p class="my-8 text-center text-grey-dark">This is the story of building a new website. Here are the latest posts:</p>
 --}}		
 		<div class="mb-2">&nbsp;</div>
		{{-- List Recent Pages --}}
		@foreach ($pages as $page)
		<a class="font-heading text-orange-dark hover:text-orange-darker font-bold text-2xl lg:text-3xl text-left block" href="{{ $page->url }}">
			{{ $page->title }}
		</a>
		<div class="text-center text-lg card mb-8 pb-2 text-grey-dark">
			<p class="mb-8 mt-4">
				{{ strip_tags($page->excerpt) }} <br>
				<a href="{{ $page->url }}" class="text-sm btn bg-blue-dark hover:bg-blue-darker inline-block mt-4 hover:bg-blue-darker">Read More</a>
			</p>
		</div>
		@endforeach
	</div>
@endsection