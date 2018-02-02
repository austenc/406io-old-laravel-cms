@extends('layouts.app')
@section('content')
	@if (session('status'))
		<div class="p-3 my-4 rounded bg-green-light text-white">
			Page {{ session('status') }} successfully.
		</div>		
	@endif
	<form method="POST" action="{{ route('pages.update', $page) }}">

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
				<a class="text-sm hover:text-grey-lightest pl-4 text-grey" href="{{ url($page->slug) }}">
					<i class="fa fa-search"></i>
				</a>
				<publish-button page="{{ $page->slug }}" published="{{ !empty($page->published_at) }}"></publish-button>
				<button type="submit" name="update" class="ml-2 py-1 pt-2 px-2 bg-blue rounded text-white hover:bg-blue-dark">
					Update
				</button>
			</div>
		</div>
{{-- 		<div class="mb-4">
			<label for="excerpt" class="label">Excerpt</label>
			@include('forms.input', ['name' => 'excerpt', 'value' => old('excerpt', $page->getOriginal('excerpt'))])
		</div>
 --}}
		<div class="mb-4">			
			<markdown-editor name="content" :content="{{ old('content', $page->jsonContent) }}"></markdown-editor>
		</div>

		{{ csrf_field() }}
		{{ method_field('PUT') }}
	</form>
@endsection