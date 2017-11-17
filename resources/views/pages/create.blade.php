@extends('layouts.app')

@section('content')
	<h3 class="form-title">Create Page</h3>
	<a href="{{ route('pages.index') }}" class="block text-blue text-center mb-6 text-sm">&laquo; Back to all</a>
	<form method="POST" action="{{ route('pages.store') }}" class="card">
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
			<textarea name="content" class="input" placeholder="Enter your content"></textarea>
			@include('validation.errors', ['field' => 'content'])
		</div>

		<button type="submit" class="btn bg-blue hover:bg-blue-darker">
			Save New Page
		</button>
	</form>
@endsection