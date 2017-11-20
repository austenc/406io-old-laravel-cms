@extends('layouts.app')

@section('title')
	<h1 class="flex-1 py-6 font-normal text-xl text-grey-dark">Manage Pages</h1>
	<a class="flex-none btn bg-blue hover:bg-blue-darker" href="{{ route('pages.create') }}">Create New Page</a>	
@endsection
@section('content')
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
	    			<a href="{{ url($page->slug) }}">View</a>  
	    			<a href="{{ route('pages.edit', $page) }}">Edit</a>
	    		</td>
	    	</tr>
	    @endforeach
	</table>
@endsection