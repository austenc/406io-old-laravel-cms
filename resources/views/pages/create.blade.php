@extends('layouts.app')

@section('content')
	@include('validation.errors')
	
	<form method="POST" action="{{ route('pages.store') }}">
		<input type="text" name="title" placeholder="Title"> <br>
		<input type="text" name="slug" placeholder="/your-great-url"> <br>
		<textarea name="content" placeholder="Enter your content"></textarea> <br>

		{{ csrf_field() }}
		<button type="submit" class="py-2 px-4 bg-blue rounded text-white">
			Save New Page
		</button>
	</form>
@endsection