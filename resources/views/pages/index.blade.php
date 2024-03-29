@extends('layouts.app')

@section('title')
	<h1 class="flex-1 page-title">Dashboard</h1>
	<a class="text-sm btn text-grey hover:text-white" href="{{ route('pages.create') }}">
		<i class="fa fa-plus"></i>
		 New Page
	</a>	
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