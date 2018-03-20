@extends('layouts.page')

@section('content')
	<h1 class="mb-2 mt-6 text-center">{{ $page->title }}</h1>
	<div class="text-center text-grey-dark text-sm">
		Posted {{ $page->created_at->format('M dS, Y') }}
	</div>
	<div class="text-center py-4 mt-4">
		@foreach($page->tags as $tag)
			<a href="{{ route('tags.browse', $tag->slug) }}" class="bg-blue hover:bg-blue-darker p-1 mx-1 rounded text-white">
				{{ $tag->name }}
			</a>
		@endforeach
	</div>
	<a href="{{ url('/') }}" class="block text-center text-sm my-4 mb-8">
		&laquo; Back to All Posts
	</a>
	<div class="container mx-auto text-lg text-grey-darker leading-normal w-3/4 md:w-2/3 mx-auto">
		{!! $page->content !!}
	</div>
@endsection

@section('comments')
    @include('partials.disqus')
@endsection