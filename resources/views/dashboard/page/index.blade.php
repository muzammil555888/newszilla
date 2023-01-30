<div class="col-lg-6 col-md-12">

    <!-- Pages -->
    <div class="card card-small mb-4">
      <div class="card-header border-bottom">
        <h6 class="m-0">Pages</h6>
      </div>
      <div class="card-body p-0 pb-3">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="bg-light">
              <tr>
                <th scope="col" class="border-0">Image</th>
                <th scope="col" class="border-0">Title</th>
                <th scope="col" class="border-0 text-center">Status</th>
                <th scope="col" class="border-0 text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($pages) > 0)
                  @foreach ($pages as $page)
                    <tr>
                      <td>
                        @if ($page->image)
                        <img src="{{ asset('uploads/pages/'.$page->image) }}" alt="" width="50" height="50">
                        @else
                          <small class="text-muted">No Image</small>
                        @endif
                      </td>
                      <td><a href="{{ url('/page/'.$page->slug.'/edit') }}"><i class="material-icons">edit</i> {{ $page->title }}</a></td>
                      <td class="text-center">{{ $page->status }}</td>
                      <td>
                        <div class="text-right">
                          {!! Form::open(['route' => ['page.destroy', $page->slug], 'method' => 'POST']) !!}
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
    <!-- / Pages -->
  </div>