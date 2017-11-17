@extends('layouts.app')

@section('content')
	<h1 class="mb-6">{{ $page->title }}</h1>
	<p>{{ $page->content }}</p>
@endsection