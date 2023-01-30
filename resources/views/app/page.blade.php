@extends('layouts.page')

@section('title', "News Zilla - Every Thing To Know")
@section('description', "News Zilla - Every Thing To Know.")

@section('content')
    @if (!empty($page))
        <h2>{{ $page->title }}</h2>
        <p>{!! $page->description !!}</p>
    @else
        <p>No Page Found</p>
    @endif
@endsection