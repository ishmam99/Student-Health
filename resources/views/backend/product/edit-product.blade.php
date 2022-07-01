@extends('layouts.fixed')

@section('title','Edit-Product')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Edit Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Product</li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row p-3">

        <!-- /.row -->
        <!-- Main row -->
        <div class="p-5 card col elevation-2">
          <div class="row">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>

          <form action="{{route('product.update',$product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-lg-2 col-sm-2 col-xs-12 {{$errors->has('sell_code') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>
                <label for="">Sell Code<span class="text-danger"><sup>*</sup></span></label>
                <input type="text" name="sell_code" id="prod_code" class="form-control" value="{{$product->sell_code}}">
                @if ($errors->has('sell_code'))
                  <span class="help-block">
                    <strong>{{ $errors->first('sell_code') }}</strong>
                  </span>
                @endif
              </div>

              <!--  PRODUCT NAME  -->
              <div class="col-lg-4 col-sm-4 col-xs-12 {{$errors->has('name') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label for="" class="label-control">Product Name<span class="text-danger"><sup>*</sup></span></label>
                <input type="text" name="name" class="form-control" placeholder="Eg. iPhone" required value="{{$product->name}}">
                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
              <!-- / PRODUCT NAME  -->

              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('price') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Price<span class="text-danger"><sup>*</sup></span></label>
                <input type="number" name="price" class="form-control" value="{{$product->price}}" placeholder="30000" required>
                @if ($errors->has('price'))
                  <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                  </span>
                @endif
              </div>
              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('quantity') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Quantity<span class="text-danger"><sup>*</sup></span></label>
                <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}" placeholder="10" required>
                @if ($errors->has('quantity'))
                  <span class="help-block">
                    <strong>{{ $errors->first('quantity') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="row">
              <!-- categorie_id Select Start -->
              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('category_id') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Category<span class="text-danger"><sup>*</sup></span></label>
                <select class="form-control" name="category_id" id="category_id">
                  <option readonly disabled>Select Category*</option>
                  @foreach($category as $cat)
                    @if($product->category_id == $cat->id)
                      <option selected value="{{$cat->id}}">{{$cat->name}}</option>
                    @else
                      <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('category_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('category_id') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('size_id') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Select Size(s)</label>
                <select class="form-control" name="size_id[]" id="size_id" multiple="multiple">
                  @foreach($sizes as $size)
                    @if(in_array($size->id, $sel_sizes))
                      <option selected value="{{$size->id}}">{{$size->name}}</option>
                    @else
                      <option value="{{$size->id}}">{{$size->name}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('size_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('size_id') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('color_id') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Select Color(s)</label>
                <select class="form-control" name="color_id[]" id="color_id" multiple="multiple">
                  @foreach($colors as $color)
                    @if(in_array($color->id, $sel_colors))
                      <option selected value="{{$color->id}}">{{$color->name}}</option>
                    @else
                      <option value="{{$color->id}}">{{$color->name}}</option>
                    @endif
                  @endforeach
                </select>
                @if ($errors->has('color_id'))
                  <span class="help-block">
                    <strong>{{ $errors->first('color_id') }}</strong>
                  </span>
                @endif
              </div>
              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('unit') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Unit</label>
                <input type="number" name="unit" class="form-control" value="{{$product->unit}}" placeholder="1 Kg.">
                @if ($errors->has('unit'))
                  <span class="help-block">
                    <strong>{{ $errors->first('unit') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="row">

              <!--  PRODUCT File NAME  -->
              <div class="col-lg-3 col-sm-3 col-xs-12 {{$errors->has('image') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Images</label>
                <input type="file" name="image[]" class="form-control" multiple>
                @if ($errors->has('image'))
                  <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                  </span>
                @endif
              </div>
              <!-- / PRODUCT File NAME  -->
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12"><span style="display: block;height: 10px;width: 100%;background: #fff;"></span></div>
            <div class="row">
              <div class="col-lg-8 col-sm-8 col-xs-12 {{$errors->has('description') ? 'has-error' : ''}}">
                <span style="display: block;height: 10px;width: 100%;background: #fff;"></span>

                <label class="label-control">Description</label>
                <textarea name="description" class="form-control">{{$product->description}}</textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
              </div>
              <div class="col-lg-6 col-sm-6 col-xs-12 {{$errors->has('image') ? 'has-error' : ''}}">
                <label> Current Product Images</label>
                <table class="table-secondary">
                  <thead>
                    <th>Image</th>
                    <th>Check for Delete</th>
                  </thead>
                  <tbody>
                    @foreach($product->images as $image)
                      <tr>
                        <td>
                          <img src="{{ asset('storage/product/'.$image->image) }}" style="height: 80px;width: 100px;">
                        </td>
                        <td>
                          <input type="checkbox" value="{{ $image->id }}" name="pro_image_delete[]" class="form-control">
                        </td>
                      </tr>

                    @endforeach
                  </tbody>
                </table>

              </div>

            </div>

            <div class="col-lg-12 col-sm-12 col-xs-12"><span style="display: block;height: 10px;width: 100%;background: #fff;"></span></div>

            <div class="col-lg-12 col-sm-12 col-xs-12">
              <button type="submit" class='btn btn-primary'>Save Product</button>
            </div>
          </form>

        </div>

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </div>
  </section>
  <!-- /.content -->
@stop
@section('script')

  <script>
    $(document).ready(function () {
      $("#size_id").select2();
      $("#color_id").select2();
    });


  </script>
@endsection
