@extends('layouts.app')

@section('bodytag')
	<body class="overflow-hidden pb-6">
@endsection

@section('content')
	@if (session('status'))
		<flash>Created</flash>
	@endif
	<form method="POST" action="{{ route('pages.update', $page) }}" class="h-full">

		{{-- Page Bar --}}
		<div class="page-bar">
			<div class="flex-1 pt-2">
				@include('forms.input', [
					'name' => 'title', 
					'value' => old('title', $page->title),
					'class' => 'input mb-1 input-focus py-1'
				])
				<div class="flex justify-start">
					<div class="text-sm pl-1 pt-1">/</div>
					<div class="flex-1 ">
						@include('forms.input', [							
							'name' => 'slug', 
							'value' => old('slug', $page->slug), 
							'class' => 'slug'
						])
					</div>
				</div>
			</div>
			<div class="text-right text-xs">
				<publish-button page="{{ $page->slug }}" published="{{ !empty($page->published_at) }}"></publish-button>
				<update-button></update-button>
			</div>
		</div>
{{-- 		<div class="mb-4">
			<label for="excerpt" class="label">Excerpt</label>
			@include('forms.input', ['name' => 'excerpt', 'value' => old('excerpt', $page->getOriginal('excerpt'))])
		</div>
 --}}
		<div class="bg-white h-full flex flex-col flex-grow">	
			<markdown-editor name="content" :content="{{ old('content', $page->jsonContent) }}"></markdown-editor>
		</div>

		{{ csrf_field() }}
		{{ method_field('PUT') }}
	</form>
@endsection