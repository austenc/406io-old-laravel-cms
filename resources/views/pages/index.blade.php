@extends('layouts.app')

@section('title')
	<h1 class="flex-1 py-4 font-normal text-xl text-grey-dark">Dashboard</h1>
	<a class="flex-none btn bg-teal hover:bg-teal-dark" href="{{ route('pages.create') }}">Create New Page</a>	
@endsection
@section('content')
	@if ($pages->isEmpty())
		<div class="card text-center">
			You don't have any pages yet. <a href="{{ route('pages.create') }}" class="hover:underline">Click here to create a page</a>.
		</div>
	@else
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
		    		<td class="pb-3 text-grey-dark">
		    			<a href="{{ url($page->slug) }}">View</a> | 
		    			<a href="{{ route('pages.edit', $page) }}">Edit</a>
		    		</td>
		    	</tr>
		    @endforeach
		</table>
	@endif
@endsection