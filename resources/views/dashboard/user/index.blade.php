@extends('layouts.dashboard')

@section('content')
<div class="main-content-container container-fluid px-4">
  <!-- Page Header -->
  <div class="page-header row no-gutters py-4">
    <div class="col-12 col-sm-4 text-center text-sm-left mb-0">
      <span class="text-uppercase page-subtitle">Blog Users</span>
      <h3 class="page-title">Blog Users</h3>
    </div>
  </div>
  <!-- End Page Header -->
  <div class="row">
    <div class="col-lg-12 col-md-12">

      <!-- Users Overview -->
      <div class="card card-small mb-4">
        <div class="card-header border-bottom">
          <h6 class="m-0">Users</h6>
        </div>
        <div class="card-body p-0 pb-3">
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead class="bg-light">
                <tr>
                  <th scope="col" class="border-0">Image</th>
                  <th scope="col" class="border-0">Name</th>
                  <th scope="col" class="border-0">Email</th>
                  <th scope="col" class="border-0">Gender</th>
                  <th scope="col" class="border-0">Status</th>
                  <th scope="col" class="border-0">Type</th>
                  <th scope="col" class="border-0">Action</th>
                </tr>
              </thead>
              <tbody>
                @if (count($users) > 0)
                @foreach ($users as $user)
                <tr>
                  <td>
                    @if ($user->image !== NULL)
                    <img src="{{ asset('uploads/users/'.$user->image) }}" alt="" width="50" height="50">
                    @else
                    <small class="text-muted">No Image</small>
                    @endif
                  </td>
                  <td>
                    <a href="{{ url('/userposts/'.$user->slug) }}">{{ $user->name }}</a>
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->gender }}</td>
                  <td>{{ $user->status }}</td>
                  <td>{{ $user->type }}</td>
                  <td class="clearfix">
                    {!! Form::open(['route' => ['user.update', $user->slug], 'method' => 'POST']) !!}
                      @csrf
                      {!! Form::hidden('_method', 'PUT') !!}
                      {!! Form::select('type', $user_types, $user->type, ['class' => 'form-control']) !!}
                      {!! Form::submit('Change', ['class' => 'btn btn-primary btn-sm mt-2 float-right']) !!}

                    {!! Form::close() !!}
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>---</td>
                  <td>---</td>
                  <td>---</td>
                  <td>---</td>
                  <td>---</td>
                  <td>---</td>
                  <td>---</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- / Users -->
    </div>
  </div>
</div>
@endsection