@extends('backend.layouts.base')
@section('style')
  <!-- Dropzone.js -->
  <link href="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
@stop
@section('content')

  <div class="page-title">
      <div class="title_left">
        <h3>Form Upload</h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>
    </div>

    @if (count($errors) > 0)
    <div class="row">
      <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
    @endif

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Upload Image</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <p>Drag multiple files to the box below for multi upload or click to select files. This is for demonstration purposes only, the files are not uploaded to any server.</p>
            <form action="{{ url('/dashboard/gallery/add') }}" class="dropzone" id="myAwesomeDropzone">
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('javascript')
    <!-- Dropzone.js -->
    <script src="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.js') }}"></script>

    <script type="text/javascript">
      
      Dropzone.options.myAwesomeDropzone = {
        acceptedFiles:"image/*",
      };

    </script>

@stop


