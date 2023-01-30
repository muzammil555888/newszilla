@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Categories</span>
      <h3 class="page-title">Add New Category</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="row">
    <div class="col-lg-6 col-md-12">
      <!-- Add New Post Form -->
      <div class="card card-small mb-3">
        <div class="card-body">

          {!! Form::open(['route' => 'category.store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3']) !!}
            @csrf
            {!! Form::text('title', '', ['class' => 'form-control form-control-lg mb-4', 'placeholder' => 'Title', 'required']) !!}

            {!! Form::select('status', [1 => 'Yes', 0 => 'No'], 0, ['class' => 'form-control mb-4']) !!}

            {!! Form::file('image',  ['class' => 'form-control my-4', 'accept' => 'image/gif, image/jpeg, image/png']) !!}

            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
          {!! Form::close() !!}

        </div>
      </div>
      <!-- / Add New Post Form -->
    </div>

    {{ view('dashboard.category.index') }}

  </div>
</div>
@endsection