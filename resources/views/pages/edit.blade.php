@extends('layouts.app')
@section('title')
	<div class="flex-1">
		<h1 class="inline-block page-title">Edit Page</h1>
		<a class="text-blue text-sm hover:underline pl-4" href="{{ url($page->slug) }}">Preview</a>
		<publish-button :page="{{ $page->id }}" published="{{ !empty($page->published_at) }}"></publish-button>
	</div>
	<a href="{{ route('pages.index') }}" class="flex-none text-blue text-right hover:underline text-sm">&laquo; Back to all</a>
@endsection
@section('content')
	@if (session('status'))
		<div class="p-3 my-4 rounded bg-green-light text-white">
			Page {{ session('status') }} successfully.
		</div>		
	@endif
	<form method="POST" action="{{ route('pages.update', $page) }}">
		<div class="mb-4">
			<label for="title" class="label">Title</label>
			@include('forms.input', ['name' => 'title', 'value' => old('title', $page->title)])
		</div>

		<div class="mb-4">
			<label for="slug" class="label">Slug</label>
			@include('forms.input', ['name' => 'slug', 'value' => old('slug', $page->slug)])
		</div>

		<div class="mb-4">
			<label for="excerpt" class="label">Excerpt</label>
			@include('forms.input', ['name' => 'excerpt', 'value' => old('excerpt', $page->getOriginal('excerpt'))])
		</div>

		<div class="mb-4">			
			<markdown-editor name="content" value="{{ old('content', $page->getOriginal('content')) }}"></markdown-editor>
		</div>

		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<button type="submit" name="update" class="py-2 px-4 bg-blue rounded text-white">
			Update Page
		</button>
	</form>
@endsection