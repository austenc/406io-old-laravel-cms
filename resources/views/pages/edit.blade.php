@extends('layouts.app')

@section('content')
	<h2 class="mb-3">{{ $page->title }}</h2>
	<a class="block mb-4" href="{{ route('pages.index') }}">Back to All</a>
	@if (session('updated'))
		<div class="p-3 my-4 rounded bg-green text-white">
			Page updated successfully.
		</div>		
	@endif

	@include('validation.errors')

	<form method="POST" action="{{ route('pages.update', $page) }}">
		<input type="text" name="title" placeholder="Title" value="{{ old('title', $page->title) }}"> <br>
		<input type="text" name="slug" placeholder="/your-great-url" value="{{ old('slug', $page->slug) }}"> <br>
		<textarea name="content" placeholder="Enter your content">
			{{ old('content', $page->content) }}
		</textarea> <br>

		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<button type="submit" class="py-2 px-4 bg-blue rounded text-white">
			Update Page
		</button>
	</form>
@endsection