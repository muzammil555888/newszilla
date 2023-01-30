@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-md-6 text-center text-md-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Videos</span>
      <h3 class="page-title">Add New Video</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">
          {!! Form::open(['route' => 'video.store', 'method' => 'POST']) !!}
          @csrf
          <div class="form-row">
            <div class="col">
              {!! Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::select('status', [1 => 'Yes', 0 => 'No'], 0, ['class' => 'form-control']) !!}
            </div>
          </div>
          
          {!! Form::url('video_url', '', ['class' => 'form-control my-4', 'placeholder' => 'Youtube Video URL', 'required']) !!}
          
          {!! Form::textarea('description', '', ['required']) !!}

          {!! Form::submit('Create', ['class' => 'btn btn-primary mt-4']) !!}

          {!! Form::close() !!}
        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>

    {{ view('dashboard.video.index')->with('videos', $videos) }}

  </div>
</div>
@endsection