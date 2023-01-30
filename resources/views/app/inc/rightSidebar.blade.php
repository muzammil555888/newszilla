<div>
    {{ view('app.inc.newsletter') }}
</div>

<div class="card mt-3">
    <div class="card-body">
        <img src="{{ asset('imgs/banner-2.png') }}" class="w-100" alt="news zilla">
    </div>
</div>

{{-- <div class="card mt-3 text-roboto text-center">
    <div class="card-header bg-red text-light">
        <h5 class="font-weight-bold mb-0" title="COVID-19 Alert Worldwide">COVID-19 Alert Worldwide</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-xl-4">
                <span class="small">Total Confirmed</span>
                <h6 class="font-weight-bold" title="Total COVID-19 Confirmed">{{ $covid19["TotalConfirmed"] }}</h6>
            </div>
            <div class="col-xl-4 border-left">
                <span class="small">Total Deaths</span>
                <h6 class="font-weight-bold" title="Total COVID-19 Deaths">{{ $covid19["TotalDeaths"] }}</h6>
            </div>
            <div class="col-xl-4 border-left">
                <span class="small">Total Recovered</span>
                <h6 class="font-weight-bold" title="Total COVID-19 Recovered">{{ $covid19["TotalRecovered"] }}</h6>
            </div>
        </div>
    </div>
</div> --}}

@if (count($latestThirtyNews) > 0)
    <div class="card mt-3">
        <div class="card-body">
            @foreach ($latestThirtyNews as $news)
            <h6 class="text-roboto m-0 font-weight-bold letter-spacing-1" title="{{ $news->title }}"><a class="text-blue" href="{{ url('/pt/'.$news->slug) }}">{{ $news->title }}</a></h6>
            <hr>
            @endforeach
        </div>
    </div>  
@endif