<div class="col-lg-6 col-md-12">

    <!-- Categories Overview -->
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <h6 class="m-0">Videos</h6>
      </div>
      <div class="card-body p-0 pb-3">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">Title</th>
                <th scope="col" class="border-0 text-center">Status</th>
                <th scope="col" class="border-0 text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($videos) > 0)
                  @foreach ($videos as $video)
                    <tr>
                      <td><a href="{{ url('/video/'.$video->slug.'/edit') }}"><i class="material-icons">edit</i> {{ $video->title }}</a></td>
                      <td class="text-center">{{ $video->status }}</td>
                      <td>
                        <div class="text-right">
                          {!! Form::open(['route' => ['video.destroy', $video->slug], 'method' => 'POST']) !!}
                            {!! Form::hidden('_method', 'Delete') !!}
                            <button type="submit" class="btn btn-danger btn-sm"><i class="material-icons">delete</i></button>
                          {!! Form::close() !!}
                        </div>
                      </td>
                    </tr>
                  @endforeach
              @else
                  <tr>
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
    <!-- / Categories Overview -->
  </div>