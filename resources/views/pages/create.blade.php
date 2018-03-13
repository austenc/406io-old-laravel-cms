@extends('layouts.app')
@section('content')
	<form method="POST" action="{{ route('pages.store') }}">
		{{ csrf_field() }}

		{{-- Page Bar --}}
		<div class="page-bar">
			<div class="flex-1 pt-2">
				@include('forms.input', [
					'name' => 'title', 
					'value' => old('title', 'Your Page Title'),
					'class' => 'input mb-1 input-focus py-1'
				])
				<div class="flex justify-start">
					<div class="text-sm pl-1 pt-1">/</div>
					<div class="flex-1">
						@include('forms.input', [
							'name' => 'slug', 
							'value' => old('slug', 'your-page-title'), 
							'class' => 'slug'
						])
					</div>
				</div>
			</div>
			<div class="text-right text-xs">
				<button type="submit"
					class="ml-2 py-1 pt-2 px-2 bg-blue rounded text-white hover:bg-blue-dark">
					Create
				</button>
			</div>
		</div>

		<div class="bg-white h-full flex flex-col flex-grow">	
			<markdown-editor name="content" content="{{ old('content', 'Your page content') }}"></markdown-editor>
		</div>
	</form>
@endsection