@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
          <div class="col-lg-10 col-md-12 col-sm-12 my-4 mx-auto">
            <div class="card card-small card-post h-100">
              @if ($post->image !== NULL)
              <div class="show-card-post__image" style="background-image: url('{{ asset('uploads/posts/'.$post->image) }}');"></div>
              @endif
              <div class="card-body clearfix">
                <div class="float-right">
                  {!! Form::open(['route' => ['post.destroy', $post->slug], 'method' => 'POST', 'class' => 'float-left']) !!}
                    {!! Form::hidden('_method', 'Delete') !!}
                    <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                  {!! Form::close() !!}
                </div>
                <h4 class="card-title mb-0">
                  <a href="{{ url('/post/'.$post->slug.'/edit') }}">
                    <i class="material-icons">edit</i>
                    <span></span>
                  </a>
                  {{ $post->title }}
                </h4>
                <small class="text-muted">{{ Carbon\Carbon::parse($post->updated_at)->format('M d Y') }}</small>
                <p class="card-text">{!! $post->description !!}</p>
              </div>
              <div class="card-footer border-top d-flex">
                <div class="card-post__author d-flex">
                  <a href="" class="card-post__author-avatar card-post__author-avatar--small"
                    style="background-image: url('{{ asset('uploads/posts/'.$post->image) }}');">Written by {{ $post->user_id }}</a>
                  <div class="d-flex flex-column justify-content-center ml-3">
                    <span class="card-post__author-name">{{ $post->user_id }}</span>
                    <small class="text-muted">{{ Carbon\Carbon::parse($post->updated_at)->format('M d Y') }}</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection