@extends('layouts.app')

@section('title', $post->title)
@section('image', asset('uploads/posts/'.$post->image))
@section('description', " ")

@section('content')
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v8.0" nonce="8xNUXO6C"></script>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title h2 text-bungee-inline mb-0" title="{{ $post->title }}">{{ $post->title }}</h4>
            <div class="text-muted small font-weight-bold">
                <i class="fa fa-clock-o" aria-hidden="true"> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</i>
                <i class="fa fa-eye" aria-hidden="true"> {{ $post->views }}</i> <br>
                <span class="text-muted text-bungee-inline">{{ Carbon\Carbon::parse($post->created_at)->format('M d Y') }}</span>
            </div>
            @if ($post->image !== NULL)
                <img src="{{ asset('uploads/posts/'.$post->image) }}" alt="{{ $post->title }}" class="w-100 mt-3">
            @endif
            <div class="text-mate-sc mt-3">{!! $post->description !!}</div>

            <div class="mt-4">
                <div class="fb-share-button" data-href="{{ url('/pt/'.$post->slug) }}" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url('/pt/'.$post->slug) }}&amp;&p[title]={{ $post->title }}&amp;&p[picture]={{ asset('uploads/posts/'.$post->image) }}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
                <a href="https://twitter.com/share?hashtags={{ $post->tags }}&text={{ $post->title }}&via=news-zilla.com" class="btn btn-primary btn-sm">twitter</a>
            </div>
        </div>
    </div>
@endsection
