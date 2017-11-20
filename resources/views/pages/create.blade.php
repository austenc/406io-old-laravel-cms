@extends('layouts.app')
@section('title')
	<h1 class="flex-1 page-title">Create New Page</h1>
	<a href="{{ route('pages.index') }}" class="flex-none text-blue text-right text-sm hover:underline">&laquo; Back to all</a>
@endsection
@section('content')
	<form method="POST" action="{{ route('pages.store') }}">
		{{ csrf_field() }}
		<div class="mb-4">
			<label for="title" class="label">Title</label>
			@include('forms.input', ['name' => 'title'])
		</div>
		<div class="mb-4">
			<label for="slug" class="label">Slug</label>
			@include('forms.input', ['name' => 'slug', 'placeholder' => '/your-great-url'])
		</div>
		<div class="mb-4">
			<label for="content" class="label">Page Content</label>
			<textarea name="content" id="page-content" class="input" placeholder="Enter your content">{{ old('content') }}</textarea>
			@include('validation.errors', ['field' => 'content'])
		</div>

		<button type="submit" class="btn bg-blue hover:bg-blue-darker">
			Save New Page
		</button>
	</form>
@endsection

@include('simplemde')