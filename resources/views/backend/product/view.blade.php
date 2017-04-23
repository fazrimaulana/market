@extends('backend.layouts.base')
@section('style')
  <link rel="stylesheet" type="text/css" href="{{ url('/backend/vendors/iCheck/skins/square/green.css') }}">
@stop
@section('content')
  
  <!-- page content -->
        

          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3></h3>
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
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $product->name }}</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="product-image">
                        @foreach($product->set_utama as $key => $utama)
                          <img src="{{ url($utama->path) }}" alt="{{ $utama->name }}" />
                        @endforeach
                      </div>
                      <div class="product_gallery">
                          @foreach($product->gallery_other as $key => $other)
                          <a>
                            <img src="{{ url($other->path) }}" alt="{{ $other->name }}" />
                          </a>
                          @endforeach
                      </div>
                    </div>

                    <div class="col-md-5 col-sm-5 col-xs-12" style="border:0px solid #e5e5e5;">

                      <h3 class="prod_title">{{ $product->name }} Review</h3>

                      <p>{{ $product->description }}</p>
                      <br />

                      <div class="">
                        <h2>Available Colors</h2>
                        <ul class="list-inline prod_color">
                          <li>
                            <p>Green</p>
                            <div class="color bg-green"></div>
                          </li>
                          <li>
                            <p>Blue</p>
                            <div class="color bg-blue"></div>
                          </li>
                          <li>
                            <p>Red</p>
                            <div class="color bg-red"></div>
                          </li>
                          <li>
                            <p>Orange</p>
                            <div class="color bg-orange"></div>
                          </li>

                        </ul>
                      </div>
                      <br />

                      <div class="">
                        <h2>Size <small>Please select one</small></h2>
                        <ul class="list-inline prod_size">
                          <li>
                            <button type="button" class="btn btn-default btn-xs">Small</button>
                          </li>
                          <li>
                            <button type="button" class="btn btn-default btn-xs">Medium</button>
                          </li>
                          <li>
                            <button type="button" class="btn btn-default btn-xs">Large</button>
                          </li>
                          <li>
                            <button type="button" class="btn btn-default btn-xs">Xtra-Large</button>
                          </li>
                        </ul>
                      </div>
                      <br />

                      <div class="">
                        <div class="product_price">
                          <h1 class="price">{{ App\Helpers\Rupiah::rupiah($product->price) }}</h1>
                          <span class="price-tax">{{ App\Helpers\Rupiah::rupiah($product->price) }}</span>
                          <br>
                        </div>
                      </div>

                      <div class="">
                        <button type="button" class="btn btn-default btn-lg">Add to Cart</button>
                        <button type="button" class="btn btn-default btn-lg">Add to Wishlist</button>
                      </div>

                      <div class="product_social">
                        <ul class="list-inline">
                          <li><a href="#"><i class="fa fa-facebook-square"></i></a>
                          </li>
                          <li><a href="#"><i class="fa fa-twitter-square"></i></a>
                          </li>
                          <li><a href="#"><i class="fa fa-envelope-square"></i></a>
                          </li>
                          <li><a href="#"><i class="fa fa-rss-square"></i></a>
                          </li>
                        </ul>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>        
        <!-- /page content -->

@endsection
@section('javascript')
  <script src="{{ url('/backend/vendors/iCheck/icheck.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });
  </script>

@stop


