<section class="bg-black text-light py-3 mt-5" style="border-top: solid 10px #333">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                News Zilla &copy; 2020
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ url('/') }}">Home</a> &nbsp;
                @if (count($pages) > 0)
                    @foreach ($pages as $page)                        
                    <a href="{{ url('/pg/'.$page->slug) }}">{{ $page->title }}</a> &nbsp;                    
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>