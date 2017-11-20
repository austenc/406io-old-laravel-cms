@extends('layouts.app')

@section('content')
	<h3 class="form-title">{{ $page->title }}</h3>
	<a href="{{ url($page->slug) }}">View Page</a>
	<a href="{{ route('pages.index') }}" class="block text-blue text-center mb-6 text-sm">&laquo; Back to all</a>

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