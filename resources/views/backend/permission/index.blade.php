@extends('backend.layouts.base')
@section('style')

@stop
@section('content')
  <div class="page-title">
      <div class="title_left">
        <h3><!-- Users --></h3>
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

    <div class="x_panel">
          <div class="x_title">
            <h4>Permissions <button class="btn btn-sm btn-default" id="new">Add New</button></h4>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-hover table-condensed table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Display Name</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($permissions as $key => $permission)
                    <tr>
                      <td>{{ $permission->name }}</td>
                      <td>{{ $permission->display_name }}</td>
                      <td>{{ $permission->description }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="javascript:;" class="btn btn-success btn-sm edit" data-id="{{ $permission->id }}">Edit</a>
                          <a href="javascript:;" class="btn btn-danger btn-sm hapus" data-id="{{ $permission->id }}">Hapus</a>
                          <!-- <a href="{{ url('/dashboard/permission/'.$permission->id.'/view') }}" class="btn btn-primary btn-sm">View</a> -->
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{ $permissions->render() }}
          </div>
        </div>


<div class="modal fade" id="newPermission" tabindex="-1" role="dialog" aria-labelledby="newPermissionModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="newPermissionModalLabel">New Permission</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/permission/add') }}" method="post" class="form-horizontal form-label-left" id="newpermission">
              {{csrf_field()}}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Display Name">Display Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="display_name" class="form-control col-md-7 col-xs-12" name="display_name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="description" name="description" class="form-control"></textarea>
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editPermission" tabindex="-1" role="dialog" aria-labelledby="editPermissionModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editPermissionModalLabel">Edit Permission</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/permission/edit') }}" method="post" class="form-horizontal form-label-left" id="editpermission">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Display Name">Display Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="display_name" class="form-control col-md-7 col-xs-12" name="display_name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="description" name="description" class="form-control"></textarea>
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

<div class="modal fade bs-example-modal-sm" id="deletePermissionModal" tabindex="-1" role="dialog" aria-labelledby="deletePermissionModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deletePermissionLabel">Delete Permission</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/permission/delete') }}" id="formDelete" method="post">
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
      
    $('#new').on('click', function(){
      $('#newPermission').modal({
        "show":true,
        "backdrop":"static",
      });
    });

    $('.edit').on('click', function(){
      var id = $(this).data("id");
      $.get('permission/'+id+'/edit', function(data){
          var $form = $('#editpermission');
          $form.find('#id').val(data.id);
          $form.find('#name').val(data.name);
          $form.find('#display_name').val(data.display_name);
          $form.find('#description').val(data.description);
          $('#editPermission').modal({
            "show":true,
            "backdrop":"static",
          });
      });
    });

    $('.hapus').on('click', function(){
      var id = $(this).data("id");
      var $form = $('#formDelete');
      $form.find('#id').val(id);
      $('#deletePermissionModal').modal({
        "show":true,
        "backdrop":"static"
      });
    });

  </script>
@stop


