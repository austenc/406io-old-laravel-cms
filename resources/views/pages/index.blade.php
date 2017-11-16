@extends('layouts.app')

@section('content')
	<h3>Pages</h3>
	<a class="block my-4" href="{{ route('pages.create') }}">Create New Page</a>

	<table class="b-0 bg-gray">
		<thead>
			<tr>
				<th>Title</th>
				<th>Slug</th>
				<th></th>
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