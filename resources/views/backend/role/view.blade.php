@extends('backend.layouts.base')
@section('style')

@stop
@section('content')

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
            <!-- <h4>Roles <button class="btn btn-sm btn-default" id="new">Add New</button></h4> -->
            <div class="btn-group">
                <a href="javascript:;" class="btn btn-success btn-sm adduser" data-id="{{ $role->id }}">Add Users</a>
                <a href="javascript:;" class="btn btn-primary btn-sm addpermission" data-id="{{ $role->id }}">Add Permissions</a>
            </div>
          </div>
          <div class="x_content">
            <div class="" role="tabpanel" data-example-id="togglable-tabs">
              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Users</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Permissions</a>
                </li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                  <div class="table-responsive">
                    <table class="table table-hover table-condensed table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($role->users as $key => $user)
                          <tr>
                            <td>{{ $user->name }}</td>
                            <td>
                            <div class="btn-group">
                              <a href="javascript:;" class="btn btn-danger btn-sm hapususer" data-idrole = "{{ $role->id }}" data-iduser = "{{ $user->id }}">Hapus</a>
                            </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                  <div class="table-responsive">
                    <table class="table table-hover table-condensed table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($role->perms as $key => $permission)
                          <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                            <div class="btn-group">
                              <a href="javascript:;" class="btn btn-danger btn-sm hapuspermission" data-idrole = "{{ $role->id }}" data-idpermission = "{{ $permission->id }}">Hapus</a>
                            </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


<div class="modal fade" id="newRoleUser" tabindex="-1" role="dialog" aria-labelledby="newRoleUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="newRoleUserModalLabel">New Role</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/role/adduser') }}" method="post" class="form-horizontal form-label-left" id="newroleuser">
              {{csrf_field()}}
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="User">User <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="user[]" multiple>
                    @foreach($users as $key => $user)
                       <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
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

<div class="modal fade bs-example-modal-sm" id="deleteRoleUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoleUserModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteRoleLabel">Delete User From {{ $role->name }}</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/role/deleteuser') }}" id="formDeleteUser" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="hidden" name="roleid" class="form-control" id="roleid">
        <input type="hidden" name="userid" id="userid" class="form-control">
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

<div class="modal fade" id="newRolePermission" tabindex="-1" role="dialog" aria-labelledby="newRolePermissionModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="newRolePermissionModalLabel">New Permission</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/role/addpermission') }}" method="post" class="form-horizontal form-label-left" id="newrolepermission">
              {{csrf_field()}}
              <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Permission">Permission <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control" name="permission[]" multiple>
                    @foreach($permissions as $key => $permission)
                       <option value="{{ $permission->id }}">{{ $permission->display_name }}</option>
                    @endforeach
                  </select>
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

<div class="modal fade bs-example-modal-sm" id="deleteRolePermissionModal" tabindex="-1" role="dialog" aria-labelledby="deleteRolePermissionModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteRoleLabel">Delete Permission From {{ $role->name }}</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/role/deletepermission') }}" id="formDeletePermission" method="post">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <input type="hidden" name="roleid" class="form-control" id="roleid" value="{{ $role->id }}">
        <input type="hidden" name="permissionid" id="permissionid" class="form-control">
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
      
      $(".adduser").on('click', function(){

          var id = $(this).data("id");
          var $form = $('#newroleuser');
          $form.find('#id').val(id);
          $('#newRoleUser').modal({
            "show":true,
            "backdrop":"static"
          });

      });

      $('.addpermission').on('click', function(){

          var id = $(this).data("id");
          var $form = $('#newrolepermission');
          $form.find('#id').val(id);
          $('#newRolePermission').modal({
            "show" : true,
            "backdrop" : "static"
          });

      });

      $('.hapususer').on('click', function(){

        var idrole = $(this).data("idrole");
        var iduser = $(this).data("iduser");

        var $form  = $('#formDeleteUser');

        $form.find('#roleid').val(idrole);
        $form.find('#userid').val(iduser);

        $('#deleteRoleUserModal').modal({
          "show" : true,
          "backdrop" : "static"
        });

      });

      $('.hapuspermission').on('click', function(){
        var idpermission = $(this).data('idpermission');

        var $form = $('#formDeletePermission');

        $form.find('#permissionid').val(idpermission);

        $('#deleteRolePermissionModal').modal({
          "show" : true,
          "backdrop" : "static"
        });

      });

  </script>
@stop


