@extends('layouts.app')

@section('content')
	<h3 class="text-center">Pages</h3>
	<ul>
	    @foreach($pages as $page)
	        <li>
	            <strong>{{ $page->title }}</strong> <br>
	            <small>{{ $page->content }}</small>
	        </li>        
	    @endforeach
	</ul>
@endsection