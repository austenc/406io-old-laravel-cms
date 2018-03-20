@extends('layouts.page')

@section ('nav')
@endsection

@section('content')
    <div class="w-3/4 mx-auto leading-normal">
        <h2 class="text-grey text-center block mx-auto py-8">
            Browsing posts tagged with "{{ $tag->name }}"
        </h2>
        @foreach ($pages as $page)
        <a class="font-heading text-orange-dark hover:text-orange-darker font-bold text-2xl lg:text-3xl text-left block" href="{{ $page->url }}">
            {{ $page->title }}
        </a>
        <div class="text-center text-lg card mb-8 pb-2 text-grey-dark">
            <p class="mb-8 mt-4">
                {{ strip_tags($page->excerpt) }} <br>
                <a href="{{ $page->url }}" class="text-sm btn bg-blue-dark hover:bg-blue-darker inline-block mt-4 hover:bg-blue-darker">Read More</a>
            </p>
        </div>
        @endforeach
    </div>
@endsection