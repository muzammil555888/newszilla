<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="ou1nz1ouf1QJGjJrhNY298pZjj5M-LhKsYCtVLbd9AM" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/dashboard.js') }}" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
  <!--<script src="https://cdn.ckeditor.com/ckeditor5/22.0.0/classic/ckeditor.js"></script>-->

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">

  <!-- Styles -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>

<body>
  <div id="dashboard">
    <div class="container-fluid">
      <div class="row">
        {{ view('dashboard.inc.sidebar') }}

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
          {{ view('dashboard.inc.navbar') }}

          {{ view('dashboard.inc.messages') }}
          
          <div class="alert alert-danger text-white mx-4 text-capitalize">
              For Any Query | Problem | Error | Suggestions Contact me on ( 0345 5417 623 ) so I can remove or update my system ( Muzammil Sohail ) ...
          </div>

          @yield('content')

          {{ view('dashboard.inc.footer') }}
        </main>

      </div>
    </div>
  </div>

  <script>
    CKEDITOR.replace( 'description', {
      customConfig: '/custom/ckeditor_config.js',
      // filebrowserBrowseUrl:'{{ asset("/public/uploads/ckeditor/") }}',
      filebrowserUploadUrl:'{{ route("ckeditor.upload", ["_token" => csrf_token()]) }}',
      filebrowserUploadMethod:'form'
    });
    CKEDITOR.editorConfig = ( config ) => {
      config.uiColor = '#f8f8f8';
      config.height = '250px';
    };

    ClassicEditor
      .create( document.querySelector( '#description' ) )
      .catch( error => {
          console.error( error );
      } );

    // var myEditor;

    // ClassicEditor
    // .create( document.querySelector( '#description' ) ,
    // {
    //   ckfinder: {
    //     uploadUrl: '{{ asset("/public/uploads/ckeditor/") }}'
    //   }
    // }
    // )
    // .then( editor => {
    //   console.log( 'Editor was initialized', editor );
    //   myEditor = editor;
    // } )
    // .catch( err => {
    //   console.error( err.stack );
    // } );

  </script>

  <script type="text/javascript">

    // function readURL(input) {
    //   if (input.files && input.files[0]) {
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //       $('#uploadPreview').attr('src', e.target.result);
    //     }
    //     reader.readAsDataURL(input.files[0]);
    //   }
    // }

    // $("#uploadImage").change(function(){
    //   readURL(this);
    // });
  </script>

</body>

</html>