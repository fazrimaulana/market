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
    
    
        <div class="x_panel" id="form_add" style="display: none;">
          <div class="x_content">
            <form action="{{ url('/dashboard/users') }}" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role">Role <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="role" class="form-control col-md-7 col-xs-12" name="role[]" multiple>
                    @foreach($roles as $key => $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Password">Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="password" class="form-control col-md-7 col-xs-12" name="password">
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <a href="javascript:;" class="btn btn-default" id="cancel">Cancel</a>
                  <input type="submit" class="btn btn-success" value="Save">
                </div>
              </div>
            </form>
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

    @if (session('status'))
      <div class="row">
      <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissable">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <ul>
            {{ session('status') }}
          </ul>
        </div>
      </div>
    </div>
    @endif

   
        <div class="x_panel">
          <div class="x_title">
            <h4>Users <button class="btn btn-sm btn-default" id="new">Add New</button></h4>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-hover table-condensed table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($users as $key => $user)
                    <tr>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>
                        
                        @foreach($user->roles as $role)
                          <a href="javascript:;" class="badge">{{ $role->name }}</a>
                        @endforeach

                      </td>
                      <td>
                        @if(Auth::user()->hasRole('Root')==true || Auth::user()->hasRole('Admin')==true || Auth::user()->id==$user->id)
                        <div class="btn-group">
                          @if($user->hasRole('Root')==false || Auth::user()->hasRole('Root')==true)
                          <a href="javascript:;" class="btn btn-success btn-sm edit" data-id="{{ $user->id }}">Edit</a>
                          @endif
                          @if($user->hasRole('Root')==false)
                          <a href="javascript:;" class="btn btn-danger btn-sm delete" data-id="{{ $user->id }}">Delete</a>
                          @endif
                          <a href="{{ url('/dashboard/users/view/'.$user->id) }}" class="btn btn-primary btn-sm">View</a>
                          @if($user->hasRole('Root')==false || Auth::user()->hasRole('Root')==true)
                          <a href="javascript:;" class="btn btn-warning btn-sm change-pass" data-id="{{ $user->id }}">Change Password</a>
                          @endif
                        </div>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{ $users->render() }}
          </div>
        </div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="editModalLabel">Edit Users</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/users/edit') }}" method="post" class="form-horizontal form-label-left" id="editform">
            {{ method_field('PATCH') }}
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
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Email">Email <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="email" class="form-control col-md-7 col-xs-12" name="email">
                </div>
              </div>
              <div class="form-group"

                @if(Auth::user()->hasRole('Root')==true || Auth::user()->hasRole('Admin')==true)
                  style="display:block;"
                @else
                  style="display:none;"
                @endif

              >
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Role">Role <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="role" class="form-control col-md-7 col-xs-12" name="role[]" multiple>
                    @foreach($roles as $key => $role)
                      <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                  </select>
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
        <h4 class="modal-title" id="deleteModalLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/users/delete') }}" id="formDelete" method="post">
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

<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePassModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="changePassModalLabel">Change Password</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/users/change/password') }}" method="post" class="form-horizontal form-label-left" id="changepassform">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="New Password">New Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="new_password" class="form-control col-md-7 col-xs-12" name="new_password">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Old Password">Old Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="password" id="old_password" class="form-control col-md-7 col-xs-12" name="old_password">
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Change</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('javascript')
  <script type="text/javascript">
    
    $('#new').on('click', function(){
      $('#name').val("");
      $('#email').val("");
      $('#role').val("");
      $('#password').val("");
      $('#form_add').toggle();
    });

    $('#cancel').on('click', function(){
      $('#name').val("");
      $('#email').val("");
      $('#role').val("");
      $('#password').val("");
      $('#form_add').toggle();
    });

    $('.edit').on('click', function(){
      var id = $(this).data("id");
      var url = "{{ url('/dashboard/users/edit') }}";
      var $form = $('#editform');
      $.get(url+"/"+id, function(data){
        $form.find('#id').val(data.user.id);
        $form.find('#name').val(data.user.name);
        $form.find('#email').val(data.user.email);
        $form.find('#role').val(data.role);
      });
      $('#editModal').modal({
        "show":true,
        "backdrop":"static",
      });
    });

    $('.delete').on('click', function(){
      var id = $(this).data("id");
      var $form = $('#formDelete');
      $form.find('#id').val(id);
      console.log(id);
      $('#deleteModal').modal({
        "show":true,
        "backdrop":"static",
      });
    });

    $('.change-pass').on('click', function(){
      var id = $(this).data("id");
      var $form = $('#changepassform');
      $form.find('#id').val(id);
      $('#changePassword').modal({
        "show":true,
        "backdrop":"static",
      });
    });

  </script>
@stop


