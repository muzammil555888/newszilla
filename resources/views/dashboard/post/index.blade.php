@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Posts</span>
      <h3 class="page-title">Blog Posts ({{ $totalPosts }})</h3>
    </div>
  </div>
  <!-- End Page Header -->

  @if (count($posts) > 0)
  <div class="row">
    @foreach ($posts as $post)
    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 my-2">
      <div class="card card-small card-post h-100">
        <div class="card-post__image" style="background-image: url('{{ asset('uploads/posts/'.$post->image) }}');"></div>
        <div class="card-body clearfix">
          <div class="float-right">
            {!! Form::open(['route' => ['post.destroy', $post->slug], 'method' => 'POST', 'class' => 'float-left']) !!}
            {!! Form::hidden('_method', 'Delete') !!}
            <button type="submit" class="btn btn-danger btn-sm m-1"><i class="material-icons">delete</i></button>
            {!! Form::close() !!}
          </div>
          <h6 class="card-title mb-0">
            <a href="{{ url('/post/'.$post->slug.'/edit') }}">
              <i class="material-icons">edit</i>
              <span></span>
            </a>
            <a class="text-fiord-blue" href="{{ url('post/'.$post->slug) }}">{{ $post->title }}</a>
          </h6>
        </div>
        <div class="card-footer border-top d-flex">
          <div class="card-post__author d-flex">
            <div class="d-flex flex-column justify-content-center ml-3">
              <small class="text-muted">{{ Carbon\Carbon::parse($post->updated_at)->format('M d Y') }}</small>
            </div>
          </div>
          <div class="my-auto ml-auto">
            <a class="btn btn-sm btn-white" href="{{ url('post/'.$post->slug) }}">
              <i class="far fa-bookmark mr-1"></i> More </a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="pagination justify-content-center my-4 px-5">
    {{ $posts }}
  </div>
  @else
  <p>No Post Found</p>
  @endif
</div>
@endsection