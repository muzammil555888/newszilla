@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Profile</span>
      <h3 class="page-title">{{ Auth::user()->name }}</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <!-- Default Light Table -->
  <div class="row">
    <div class="col-lg-4">
      <div class="card card-small mb-4 pt-3">
        <div class="card-header border-bottom text-center">
          <div class="mb-3 mx-auto">
            @if (!empty(Auth::user()->image))                
            <img class="rounded-circle" src="{{ asset('uploads/users/'.Auth::user()->image) }}" alt="Profile Image" width="110" class="h-100"> 
            @endif
          </div>
          <h4 class="mb-0">{{ Auth::user()->name }}</h4>
          <span class="text-muted d-block mb-2">{{ Auth::user()->designation }}</span>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item p-4">
            <strong class="text-muted d-block mb-2">Description</strong>
            <span>{{ Auth::user()->description }}</span>
          </li>
        </ul>
      </div>
    </div>
    <div class="col-lg-8">
      {{ view('dashboard.user.edit')->with('user', $user) }}
    </div>
  </div>
  <!-- End Default Light Table -->
</div>
@endsection