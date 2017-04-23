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

    <div class="x_panel">
          <div class="x_title">
            <h4>Product <a href="{{ url('/dashboard/product/add') }}" class="btn btn-sm btn-default">Add New</a></h4>
          </div>
          <div class="x_content">
            <div class="table-responsive">
              <table class="table table-hover table-condensed table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Condition</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $key => $product)
                    <tr>
                      <td>{{ $product->name }}</td>
                      <td><label class="badge">{{ $product->condition }}</label></td>
                      <td>{{ $product->category->name }}</td>
                      <td>{{ App\Helpers\Rupiah::rupiah($product->price) }}</td>
                      <td>{{ $product->stock }}</td>
                      <td>
                        <div class="btn-group">
                          <a href="{{ url('/dashboard/product/'.$product->id.'/edit') }}" class="btn btn-success btn-sm">Edit</a>
                          <a href="javascript:;" data-id="{{ $product->id }}" class="btn btn-danger btn-sm delete">Hapus</a>
                          <a href="{{ url('/dashboard/product/'.$product->id.'/view') }}" class="btn btn-primary btn-sm">View</a>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            {{ $products->render() }}
          </div>
        </div>


<div class="modal fade bs-example-modal-sm" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteProductLabel">Delete User</h4>
      </div>
      <div class="modal-body">
        <form action="{{ url('/dashboard/product/delete') }}" id="formDelete" method="post">
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
    $('.delete').on('click', function(){
        var id = $(this).data("id");
        var $form = $('#formDelete');
        $form.find('#id').val(id);
        $('#deleteProductModal').modal({
          "show" : true,
          "backdrop":"static"
        });
    });
  </script>
@stop


