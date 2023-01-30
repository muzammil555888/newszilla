@extends('layouts.app')

@section('content')
    @if (!empty($breakingNews))
        <div class="card breaking-news">
            <a href="{{ url('/pt/'.$breakingNews->slug) }}"><div class="image" style="background-image: url('{{ asset('uploads/posts/'.$breakingNews->image) }}')"></div></a>
            <h2 class="card-body text-open-sans m-0 font-weight-bold" title="{{ $breakingNews->title }}"><a class="text-blue" href="{{ url('/pt/'.$breakingNews->slug) }}">{{ $breakingNews->title }}</a></h2>
        </div>
    @endif

    @if (count($featuredNews) > 0)
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    @foreach ($featuredNews as $news)
                        <div class="col-12 col-sm-6 col-md-6 featured-news">
                            <a href="{{ url('/pt/'.$news->slug) }}"><div class="image" style="background-image: url('{{ asset('uploads/posts/'.$news->image) }}')"></div></a>
                            <h6 class="card-body text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if (count($latestNews) > 0)
        <div class="card mt-3">
            <div class="card-body">
                <div class="row">
                    @foreach ($latestNews as $news)
                        <div class="col-12 col-sm-6 col-md-6 latest-news">
                            <a href="{{ url('/pt/'.$news->slug) }}"><div class="image" style="background-image: url('{{ asset('uploads/posts/'.$news->image) }}')"></div></a>
                            <h6 class="card-body text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    @if (count($singleCategoryNews) > 0)
        <div class="card mt-3">
            <div class="card-body">
                @foreach ($categories as $category)
                <div class="row">
                    <div class="col-4 col-xl-3">
                        <a href="{{ url('/pt/'.$singleCategoryNews[$category->title]->slug) }}"><img src="{{ asset('uploads/posts/'.$singleCategoryNews[$category->title]->image) }}" width="100%" height="100" alt="{{ $singleCategoryNews[$category->title]->title }}"></a>
                    </div>
                    <div class="col-8 col-xl-9">
                        <a class="text-primary small text-uppercase letter-spacing-1 font-weight-bold mb-2" href="{{ url('/ct/'.$category->slug) }}">{{ $category->title }}</a>
                        <h6 class="text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $singleCategoryNews[$category->title]->title }}"><a class="text-blue" href="{{ url('/pt/'.$singleCategoryNews[$category->title]->slug) }}">{{ $singleCategoryNews[$category->title]->title }}</a></h6>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
        </div>
    @endif

    <div class="d-block d-sm-none mt-3">
        {{ view('app.inc.newsletter') }}
    </div>
@endsection

@section('extra')
    @if (count($categoryNews) > 0)
        @foreach ($categories as $category)
            <div class="col-md-12 mt-5">
                <h3 class="border-left border-danger border-width-lg text-roboto text-uppercase"><span class="pl-2">{{ $category->title }} <span class="text-red font-weight-bold">News</span></span></h3>
            </div>
            @foreach ($categoryNews[$category->title] as $news)
            <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-4">
                <div class="card h-100">
                    <a href="{{ url('/pt/'.$news->slug) }}"><img src="{{ asset('uploads/posts/'.$news->image) }}" width="100%" height="150" alt="{{ $news->title }}"></a>
                    <div class="card-body">
                        <h6 class="text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
                    </div>
                </div>
            </div>
            @endforeach
        @endforeach
    @endif
@endsection
