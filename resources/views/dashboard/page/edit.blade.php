@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  
    <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-md-6 text-center text-md-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Pages</span>
      <h3 class="page-title">Add New Page</h3>
    </div>
  </div>
  <!-- End Page Header -->

  <div class="row">
    <div class="col-lg-6 col-md-12">
        <!-- Add New Page -->
        <div class="card card-small mb-3">
            <div class="card-body">
                {!! Form::open(['route' => ['page.update', $page->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <div class="form-row">
                        <div class="col">
                        {!! Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => 'Title', 'required']) !!}
                        </div>
                        <div class="col">
                        {!! Form::select('status', [1 => 'Yes', 0 => 'No'], $page->status, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <!-- Page Image -->
                    <div class="">
                        <div class=" my-4">
                            @if ($page->image)
                            <img src="{{ asset('uploads/pages/'.$page->image) }}" alt="" id="uploadPreview" class="w-100">
                            @else
                                <small class="text-muted">Select Image</small>
                            @endif
                        </div>
                        <div class="">
                        {!! Form::file('image',  ['class' => 'form-control my-4', 'placeholder' => 'Featured Image', 'id' => 'uploadImage', 'required', 'onchange' => 'readURL(this);', 'accept' => 'image/gif, image/jpeg, image/png']) !!}
                        </div>
                    </div>
                    <!-- / Page Image -->

                    {!! Form::textarea('description', $page->description, ['required']) !!}
                    {!! Form::submit('Update', ['class' => 'btn btn-primary mt-4']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <!-- / Add New Page -->
    </div>
    {{ view('dashboard.page.index')->with('pages', $pages) }}
  </div>

</div>
@endsection