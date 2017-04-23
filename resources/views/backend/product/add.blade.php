@extends('backend.layouts.base')
@section('style')
  <link rel="stylesheet" type="text/css" href="{{ url('/backend/vendors/iCheck/skins/square/green.css') }}">
  <!-- Dropzone.js -->
  <link href="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
@stop
@section('content')

    <div class="page-title">
      <div class="title_left">
        <h3>Add Product</h3>
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
          <div class="x_content">
            <form action="{{ url('/dashboard/product/add') }}" id="formAdd" method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Gallery <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="dropzone" id="myAwesomeDropzone">
                    
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Price">Price <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="price" class="form-control col-md-7 col-xs-12" name="price">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Amount">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="amount" class="form-control col-md-7 col-xs-12" name="amount">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Condition">Condition <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="radio">
                    <input type="radio" id="condition"  name="condition" value="New"> New
                    <input type="radio" id="condition"  name="condition" value="Former"> Former
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description" placeholder="Description">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control" name="description" id="description"></textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Categories">Categories <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12" id="category" name="category">
                      <option value="">--PILIH--</option>
                      @foreach($categories as $key => $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="form-group" style="display: none;" id="sub_category">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Categories">Sub Categories <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="list_subcategory" style="height: 150px;overflow-x: auto;">
                  <div class="checkbox">
                    <input type="checkbox" name="sub_categories[]" class="sub_categories" value="" checked> None
                  </div>
                </div>
              </div>
              <div id="show">
              
              </div>
              <input type="hidden" name="set_utama" class="last_click" value="0">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="submit" class="btn btn-success" value="Save" id="save">
                  </form>
                </div>
              </div>
          </div>
        </div>
@endsection
@section('javascript')
  <script src="{{ url('/backend/vendors/iCheck/icheck.js') }}" type="text/javascript"></script>
  <!-- Dropzone.js -->
  <script src="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.js') }}"></script>
    
  <script type="text/javascript">

      Dropzone.options.myAwesomeDropzone = {
        url:"{{ url('/dashboard/gallery/add') }}",
        acceptedFiles:"image/*",
        /*autoProcessQueue: false,*/
        parallelUploads: 1,
        addRemoveLinks: true,
        dictRemoveFile: "Delete",
        init: function() {
          /*var submitButton = document.querySelector("#save")*/
          myDropzone = this; 

          /*submitButton.addEventListener("click", function() {
            myDropzone.processQueue();
          });*/
          
          /*this.on("addedfile", function(file) {
              
          });*/

          /*this.on("success", function(file, response){
              var fileList = [response];
          });*/

          /*this.on("removedfile", function(file) {
            console.log(file);
            myDropzone.removeFile(file);
          });*/

        },
        sending: function(file, xhr, formData) {
            formData.append("_token", $('[name=_token').val());
        },
        success: function (file, response) {
            file.previewElement.classList.add("dz-success");
            /*console.log("Successfully uploaded :" + response);*/
            $('#show').append(" <input type='hidden' name='gallery[]' class='"+ response +"' value='"+ response +"' <br />");

            file.previewElement.id = response;

            file._captionLabel = Dropzone.createElement("<a class='dz-remove _"+ response +"' href='javascript:;'>Set Utama</a>");
            file.previewElement.appendChild(file._captionLabel);

            $('._'+response).on('click', function(){
                var url = "{{ url('/dashboard/gallery/') }}";
                var last_click = $('.last_click').val();
                $('#'+response).find('.dz-image').css('border', 'solid 5px red');

                //untuk proses update data last click and new click send last click and response to controller
                //lalu rubah last_click menjadi 0 dan response menjadi 1 di database nya
                $.get(url+"/"+last_click+"/set_utama/"+response, function(data){
                    if (last_click!="0") {
                      /*console.log("Last Click "+last_click);
                      console.log("Response "+response);*/
                      $('.last_click').val(data);
                      $('#'+last_click).find('.dz-image').css('border', 'none');
                      $('#'+response).find('.dz-image').css('border', 'solid 5px red');
                    }
                    else
                    {
                      /*console.log("Kosong");*/
                      $('.last_click').val(data);
                    }
                });

            });

        },
        removedfile: function (file){
          var id = file.previewElement.id;
          /*console.log(id);*/
          $('.'+id).remove();

          var url = "{{ url('dashboard/gallery/delete') }}";
          var formData = {
            _token  : $('meta[name="csrf-token"]').attr('content'),
            id      : id
          };

          $.ajax({
            type : "DELETE",
            url  : url,
            data : formData
            /*success: function(data){
              console.log(data)
            },
            error: function(data){
              console.log('Error : '+data)
            }*/
          });

          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;

        },
        error: function (file, response) {
          file.previewElement.classList.add("dz-error");
        }

      };


    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });
    
    $('#category').on('change', function(){
      var id = $(this).val();
      var url= "{{ url('/dashboard/sub_categories/get') }}";

      if(id!="")
      {
        $('#list_subcategory').empty();
        $.get(url+'/'+id, function(data){
          $.each(data, function(key, value){
              $('#list_subcategory').append(" <div class='checkbox'><input type='checkbox' class='sub_categories' name='sub_categories[]' value='"+ value.id +"'> "+value.name+"</div> ");
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%' // optional
              });
          });        
        });
        $('#sub_category').css("display","initial");
      }
      else
      {
        $('#list_subcategory').empty();
        $('#sub_category').css("display","none");
        $('#list_subcategory').append(" <div class='checkbox'><input type='checkbox' name='sub_categories[]' value='' checked></div> ");
      }
    });

  </script>
@stop


