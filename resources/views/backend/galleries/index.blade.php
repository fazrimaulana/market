@extends('backend.layouts.base')
@section('style')
  
@stop
@section('content')
  <div class="page-title">
      <div class="title_left">
        <h3>Gallery <a href="{{ url('/dashboard/gallery/add') }}" class="btn btn-default btn-sm">New Gallery</a></h3>
      </div>

      <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>a
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

    <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Media Gallery <small> gallery design </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="overflow-x: auto;height: 650px;">

                    <div class="row">
                      @foreach($galleries as $key => $gallery)
                      <div class="col-md-55">
                        <div class="thumbnail">
                          <div class="image view view-first">
                            <img style="width: 100%; display: block; height: 100%;" src="{{ url($gallery->path) }}" alt="{{ $gallery->name }}" />
                            <div class="mask">
                              <p><!-- Your Text --></p>
                              <div class="tools tools-bottom">
                                <a href="{{ url($gallery->path) }}" target="_blank"><i class="fa fa-link"></i></a>
                                <a href="javascript:;" class="edit" data-id="{{ $gallery->id }}"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:;" class="delete" data-id="{{ $gallery->id }}"><i class="fa fa-times"></i></a>
                              </div>
                            </div>
                          </div>
                          <div class="caption">
                            <p>{{ $gallery->name }}</p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalLabel">Edit Image</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/gallery/edit') }}" method="post" class="form-horizontal form-label-left" id="editform" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{csrf_field()}}
            <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Image">Image <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="file" class="form-control col-md-7 col-xs-12" name="file">
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bs-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteModalLabel">Delete Image</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/gallery/delete') }}" id="formDelete" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="hidden" name="id" class="form-control" id="id">
        <p><b>Yakin ingin menghapus data ini ???</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('javascript')
    <script type="text/javascript">
      $('.edit').on('click', function(){
        var id = $(this).data("id");
        var $form = $('#editform');
        $form.find('#id').val(id);
        $('#editModal').modal({
          "show":true,
          "backdrop":"static"
        });
      });

      $('.delete').on('click', function(){
          var id = $(this).data("id");
          var $form = $('#formDelete');
          $form.find('#id').val(id);
          $('#deleteModal').modal({
            "show":true,
            "backdrop":"static"
          });
      });
    </script>
@stop


