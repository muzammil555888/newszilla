@if (count($featuredTenNews) > 0)
    <div class="card">
        <div class="card-body">
            @foreach ($featuredTenNews as $news)
            <a href="{{ url('/pt/'.$news->slug) }}"><img src="{{ asset('uploads/posts/'.$news->image) }}" width="100%" alt="{{ $news->title }}"></a>
            <h6 class="text-roboto mb-0 mt-3 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
            <hr>
            @endforeach
        </div>
    </div>  
@endif

<div class="mt-3">
    {{ view('app.inc.newsletter') }}
</div>