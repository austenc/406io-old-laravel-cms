@extends('layouts.app')

@section('content')
	<h3 class="text-center">Pages</h3>

	<table class="b-0 bg-gray">
	    @foreach($pages as $page)
	        <li>
	            <strong>{{ $page->title }}</strong> <br>
	            <small>{{ $page->content }}</small>
	        </li>        
	    @endforeach
	</table>
@endsection