<div class="card card-small mb-4">
  <div class="card-header border-bottom">
    <h6 class="m-0">Account Details</h6>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item p-3">
      <div class="row">
        <div class="col">
          {!! Form::open(['route' => ['updateprofile', Auth::user()->slug], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'py-3']) !!}
            @csrf
            <div class="form-group">
              {{ Form::label('name', 'Full Name') }}
              {!! Form::text('name', Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Full Name', 'required']) !!}
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                {{ Form::label('email', 'Email') }}
                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control disabled', 'placeholder' => 'Email'  ,'disabled', 'readonly']) !!}
              </div>
              <div class="form-group col-md-6">
                {{ Form::label('image', 'Profile Image') }}
                {!! Form::file('image',  ['class' => 'form-control', 'placeholder' => 'Profile Image', 'accept' => 'image/gif, image/jpg, image/jpeg, image/png']) !!}
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                {{ Form::label('designation', 'Designation') }}
                {!! Form::text('designation', Auth::user()->designation, ['class' => 'form-control', 'placeholder' => 'Designation']) !!}
              </div>
              <div class="form-group col-md-6">
                <label for="">Gender</label> <br>
                <div class="form-check form-check-inline">
                  {{ Form::radio('gender', 'male', true, ['class' => 'form-check-input']) }}
                  {{ Form::label('male', 'Male', ['class' => 'form-check-label']) }}
                </div>
                <div class="form-check form-check-inline">
                  {{ Form::radio('gender', 'female', false, ['class' => 'form-check-input']) }}
                  {{ Form::label('female', 'Female', ['class' => 'form-check-label']) }}
                </div>
                <div class="form-check form-check-inline">
                  {{ Form::radio('gender', 'other', false, ['class' => 'form-check-input']) }}
                  {{ Form::label('other', 'Other', ['class' => 'form-check-label']) }}
                </div>
              </div>
            </div>

            <div class="form-group">
              {{ Form::label('address', 'Address') }}
              {!! Form::text('address', Auth::user()->address, ['class' => 'form-control', 'placeholder' => 'Address']) !!} 
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                {{ Form::label('city', 'City') }}
                {!! Form::text('city', Auth::user()->city, ['class' => 'form-control', 'placeholder' => 'City']) !!}
              </div>
              <div class="form-group col-md-6">
                {{ Form::label('state', 'State') }}
                {!! Form::text('state', Auth::user()->state, ['class' => 'form-control', 'placeholder' => 'State']) !!} 
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                {{ Form::label('description', 'Description') }}
                  {!! Form::textarea('user_description', Auth::user()->description, ['class' => 'form-control', 'max' => '255', 'rows' => 3]) !!}
              </div>
            </div>
            {!! Form::submit('Update Account', ['class' => 'btn btn-primary']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </li>
  </ul>
</div>