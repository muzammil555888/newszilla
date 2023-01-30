@extends('layouts.app')

@section('content')
    @if (count($posts) > 0)
        <div class="card">
            <div class="card-body">
                @foreach ($posts as $news)
                <div class="row">
                    <div class="col-4 col-xl-3">
                        <a href="{{ url('/pt/'.$news->slug) }}"><img src="{{ asset('uploads/posts/'.$news->image) }}" width="100%" height="100" alt="{{ $news->title }}"></a>
                    </div>
                    <div class="col-8 col-xl-9">
                        <h6 class="text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
                    </div>
                </div>
                <hr>
                @endforeach
                <div class="pagination justify-content-end w-100">
                    {{ $posts }}
                </div>
            </div>
        </div>
    @else
        <p>Nothing Found !</p>
    @endif
@endsection