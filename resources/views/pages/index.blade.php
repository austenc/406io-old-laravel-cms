@extends('layouts.app')

@section('content')
	<div class="flex mb-6 border-b pb-3">
		<h2 class="flex-1">Pages</h2>
		<a class="flex-none bg-blue px-4 py-2 rounded text-white hover:bg-blue-dark no-underline" href="{{ route('pages.create') }}">Create New Page</a>
	</div>
	<table class="table">
		<thead>
			<tr>
				<th>Title</th>
				<th>Slug</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
	    @foreach($pages as $page)
	    	<tr>
	    		<td class="pb-3">{{ $page->title }}</td>
	    		<td class="pb-3">{{ $page->slug }}</td>
	    		<td class="pb-3">
	    			<a href="{{ route('pages.edit', $page) }}">Edit</a>
	    		</td>
	    	</tr>
	    @endforeach
	</table>
@endsection