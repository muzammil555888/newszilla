@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-md-6 text-center text-md-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Videos</span>
      <h3 class="page-title">Edit Video</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">
          {!! Form::open(['route' => ['video.update', $video->slug], 'method' => 'POST']) !!}
          @csrf
          {!! Form::hidden('_method', 'PUT') !!}
          <div class="form-row">
            <div class="col">
              {!! Form::text('title', $video->title, ['class' => 'form-control', 'placeholder' => 'Title', 'required']) !!}
            </div>
            <div class="col">
              {!! Form::select('status', [1 => 'Yes', 0 => 'No'], $video->status, ['class' => 'form-control']) !!}
            </div>
          </div>
          
          {!! Form::url('video_url', $video->url, ['class' => 'form-control my-4', 'placeholder' => 'Youtube Video URL', 'required']) !!}
          
          {!! Form::textarea('description', $video->description, ['required']) !!}

          {!! Form::submit('Update', ['class' => 'btn btn-primary mt-4']) !!}

          {!! Form::close() !!}
        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>

    {{ view('dashboard.video.index')->with('videos', $videos) }}

  </div>
</div>
@endsection