@extends('layouts.app')
@section('title')
	<div class="flex-1">
		<h1 class="inline-block py-6 font-normal text-xl text-grey-dark">Edit Page</h1>
		<a class="text-blue text-sm pl-4" href="{{ url($page->slug) }}">Preview</a>
	</div>
	<a href="{{ route('pages.index') }}" class="flex-none text-blue text-right text-sm">&laquo; Back to all</a>
@endsection
@section('content')

	@if (session('updated'))
		<div class="p-3 my-4 rounded bg-green-light text-white">
			Page updated successfully.
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
			<label for="content" class="label">Page Content</label>
			<textarea class="input" id="page-content" 
				name="content" 
				placeholder="Enter your content">{{ old('content', $page->getOriginal('content')) }}</textarea>
		</div>

		{{ csrf_field() }}
		{{ method_field('PUT') }}
		<button type="submit" class="py-2 px-4 bg-blue rounded text-white">
			Update Page
		</button>
	</form>
@endsection

@include('simplemde')