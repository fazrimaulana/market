@extends('backend.layouts.base')
@section('style')
  <link rel="stylesheet" type="text/css" href="{{ url('/backend/vendors/iCheck/skins/square/green.css') }}">
  <link href="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
@stop
@section('content')

    <div class="page-title">
      <div class="title_left">
        <h3>Edit Product</h3>
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
                    <h2>Media Gallery <small> Product {{ $product->name }} </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      @foreach($product->gallery as $key => $gallery)
                      <div class="col-md-55">
                        <div class="thumbnail" @if($gallery->pivot->set_utama=="1") style="border: solid 5px red" @endif>
                          <div class="image view view-first">
                            <img style="width: 100%; display: block; height: 100%;" src="{{ url($gallery->path) }}" alt="{{ $gallery->name }}" />
                            <div class="mask">
                              <p><!-- Your Text --></p>
                              <div class="tools tools-bottom">
                                <a href="{{ url($gallery->path) }}" target="_blank" data-toggle="tooltip" title="View"><i class="fa fa-link"></i></a>
                                @if($gallery->pivot->set_utama!='1')
                                <a href="{{ url('dashboard/product/'.$product->id.'/gallery_set_utama/'.$gallery->id) }}" class="edit" data-toggle="tooltip" title="Set Utama"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:;" class="delete" data-id="{{ $gallery->id }}" data-toggle="tooltip" title="Delete"><i class="fa fa-times"></i> {{ $gallery->pivot->utama }}</a>
                                @endif
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

        <div class="x_panel">
          <div class="x_content">
            <form method="post" class="form-horizontal form-label-left">
            {{csrf_field()}}
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="name" value="{{ $product->name }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Name">Add New Gallery <span class="required">*</span>
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
                  <input type="text" id="price" class="form-control col-md-7 col-xs-12" name="price" value="{{ $product->price }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Amount">Amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="amount" class="form-control col-md-7 col-xs-12" name="amount" value="{{ $product->amount }}">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Condition">Condition <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="radio">
                    <input type="radio" id="condition"  name="condition" value="New" @if($product->condition=="New") checked @endif > New
                    <input type="radio" id="condition"  name="condition" value="Former" @if($product->condition=="Former") checked @endif > Former
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea class="form-control" name="description" id="description" placeholder="Description">{{ $product->description }}</textarea>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Categories">Categories <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control col-md-7 col-xs-12" id="category" name="category">
                      <option value="" data-product="">--PILIH--</option>
                      @foreach($categories as $key => $category)
                        <option value="{{ $category->id }}" data-product="{{ $product->id }}" @if($product->category->id==$category->id) selected @endif >{{ $category->name }}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="form-group" id="sub_category">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Categories">Sub Categories <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12" id="list_subcategory" style="height: 150px;overflow-x: auto;">
                  
                    <!-- <input type="checkbox" name="sub_categories[]" value="" checked> None -->

                    @foreach($product->category->subcategories as $key => $value)

                        <div class="checkbox">
                          <input type="checkbox" name="sub_categories[]" id="sub_{{ $value->id }}" value="{{ $value->id }}" 
                            @foreach($product->subcategories as $k => $v)
                              @if($value->id==$v->id)
                                checked 
                              @endif 
                            @endforeach
                          > {{$value->name}}

                        </div>

                    @endforeach
                </div>
              </div>
              <div id="show">
              
              </div>
              <input type="hidden" name="set_utama" class="last_click" value="0">
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                  <input type="submit" class="btn btn-success" value="Update">
                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="modal fade bs-example-modal-sm" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="deleteModalLabel">Delete Image</h4>
              </div>
            <div class="modal-body">
              <form action="{{ url('/dashboard/product/gallery/delete') }}" id="formDelete" method="post">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input type="hidden" name="id_product" class="form-control" id="id_product" value="{{ $product->id }}">
                <input type="hidden" name="id_gallery" class="form-control" id="id">
                <p><b>Yakin ingin menghapus data ini ???</b></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>

@endsection
@section('javascript')
  <script src="{{ url('/backend/vendors/iCheck/icheck.js') }}" type="text/javascript"></script>
  <script src="{{ url('/backend/vendors/dropzone/dist/min/dropzone.min.js') }}"></script>
  <script type="text/javascript">

    Dropzone.options.myAwesomeDropzone = {
        url:"{{ url('/dashboard/gallery/add') }}",
        acceptedFiles:"image/*",
        parallelUploads: 1,
        addRemoveLinks: true,
        dictRemoveFile: "Delete",
        init: function(){
          
        },
        sending: function(file, xhr, formData) {
            formData.append("_token", $('[name=_token').val());
        },
        success: function (file, response) {
            file.previewElement.classList.add("dz-success");
            $('#show').append(" <input type='hidden' name='gallery[]' class='"+ response +"' value='"+ response +"' <br />");

            file.previewElement.id = response;

            file._captionLabel = Dropzone.createElement("<a class='dz-remove _"+ response +"' href='javascript:;'>Set Utama</a>");
            file.previewElement.appendChild(file._captionLabel);

            $('._'+response).on('click', function(){
                var url = "{{ url('/dashboard/gallery/') }}";
                var last_click = $('.last_click').val();
                $('#'+response).find('.dz-image').css('border', 'solid 5px red');

                $.get(url+"/"+last_click+"/set_utama/"+response, function(data){
                    if (last_click!="0") {
                      $('.last_click').val(data);
                      $('#'+last_click).find('.dz-image').css('border', 'none');
                      $('#'+response).find('.dz-image').css('border', 'solid 5px red');
                    }
                    else
                    {
                      $('.last_click').val(data);
                    }
                });

            });

        },
        removedfile: function (file){
          var id = file.previewElement.id;
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
      var product = $(this).find("option:selected").data("product");
      var a = "{{$product->id}}";

      if(product=="")
      {
        product = "none";
      }

      /*console.log("Product : "+product);*/

      var url= "{{ url('/dashboard/sub_categories/get') }}";

      if(id!="")
      {
        $('#list_subcategory').empty();
        $.get(url+'/'+id+'/'+product, function(data){

          $.each(data.sub, function(key, value){

              $('#list_subcategory').append(" <div class='checkbox'><input type='checkbox' id='sub_"+ value.id +"' name='sub_categories[]' value='"+ value.id +"'> "+value.name+"</div> ");             
              $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                increaseArea: '20%' // optional
              });
          });

          $.each(data.product, function(i, v){
            $('.checkbox').find('#sub_'+v).iCheck('check');
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


