@extends('layouts.fixed')

@section('content')
  <div class="boxed">
    <div id="content-container">
      <div id="page-head">
        <div id="page-title">
          <h1 class="page-header text-overflow">Add / View Sub-Category</h1>
        </div>
        <ol class="breadcrumb">
          <li><a href="#"><i class="demo-pli-home"></i></a></li>
          <li><a href="#">Admin</a></li>
          <li class="active">Sub-Category</li>
        </ol>
      </div>
      <div id="page-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title">Add New Sub-Category</h3>
              </div>
              <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                  {{ Form::open(['route'=>'sub-category.store','method'=>'post', 'enctype'=>'multipart/form-data',]) }}
                  <div class="form-group">
                    {{ Form::label('category','Select Category',['class'=>'label-control']) }}
                    {{ Form::select('category_id',$category,null,['class'=>'form-control']) }}
                  </div>

                  <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                    {{ Form::label('SubCategory','Sub-Category Name : ',['class'=>'control-label'])}}
                    {{Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Ex: Men-Ring'])}}
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-lg-12 col-sm-12 {{$errors->has('image') ? 'has-error' : ''}}">
                    {{ Form::label('','Cover image : ',['class'=>'control-label'])}}
                    {{Form::file('image',['class'=>'form-control'])}}
                    @if ($errors->has('image'))
                      <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                      </span>
                    @endif
                    <br>
                  </div>


                  <div class="col-lg-12 col-sm-12 {{$errors->has('description') ? 'has-error' : ''}}">
                    {{ Form::label('','Description : ',['class'=>'control-label'])}}
                    {{Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>'Category Details....'])}}
                    @if ($errors->has('description'))
                      <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-lg-12 col-sm-12 {{$errors->has('advertise_image1') ? 'has-error' : ''}}">
                    {{ Form::label('','GiF Or Alter Image : ',['class'=>'control-label'])}}
                    {{Form::file('advertise_image1',['class'=>'form-control'])}}
                    @if ($errors->has('advertise_image1'))
                      <span class="help-block">
                        <strong>{{ $errors->first('advertise_image1') }}</strong>
                      </span>
                    @endif
                    <br>
                  </div>
                  <div class="col-lg-12 col-sm-12 {{$errors->has('advertise_image2') ? 'has-error' : ''}}">
                    {{ Form::label('','Advertise image : ',['class'=>'control-label'])}}
                    {{Form::file('advertise_image2',['class'=>'form-control'])}}
                    @if ($errors->has('advertise_image2'))
                      <span class="help-block">
                        <strong>{{ $errors->first('advertise_image2') }}</strong>
                      </span>
                    @endif
                    <br>
                  </div>


                  <div class="col-md-12 col-xs-12">
                    <br>
                  </div>

                  <div class="col-md-12 col-xs-12">
                    {{ Form::button('SAVE Sub-Category',['type'=>'submit','id'=>'saveCategory','class'=>'col-sm-5 btn btn-primary']) }}
                  </div>
                  {{ Form::close() }}
                </div>

                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                  <table class="table table-bordered " id="CategoryTable">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Sub-Category</th>
                        <th>Cover Image</th>
                        {{--<th>GIF Image</th>--}}
                        <th>Adv Image</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=0 @endphp
                      @foreach($subcategory as $info)
                        <tr id="rowid{{$info->id}}" class="abcd">
                          <td>{{++$i}}</td>
                          <td id="Category{{$info->id}}">{{$info->category->name}}</td>
                          <td id="Category{{$info->id}}">{{$info->name or null}}</td>
                          <td width="15%">
                            <img src="{{ asset('admin/subcategory/'.$info->image) }}" alt="no image" style="height: 80px;width: 80px;">
                          </td>
                          {{--<td width="15%">
                              <img src="{{ asset('admin/subcategory/advertise/'.$info->advertise_image1) }}" alt="no image" style="height: 80px;width: 80px;">
                          </td>--}}
                          <td width="15%">
                            <img src="{{ asset('admin/subcategory/advertise/'.$info->advertise_image2) }}" alt="no image" style="height: 80px;width: 80px;">
                          </td>
                          <td width="55%"> {{$info->description !=null ? substr($info->description,0,150) : "no description " }}</td>
                          <td>
                            <a href="{{route('sub-category.edit',$info->id)}}" class="btn btn-sm btn-info edit"><i class="demo-pli-pen-5"></i></a> ||
                            <button class="btn btn-sm btn-danger erase" data-id="{{$info->id}}" data-url="{{url('ProductManagement/sub-Category/erase')}}"><i class="demo-pli-trash"></i></button>
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
    </div>
  </div>

  <script>

    $(function () {
      $('#CategoryTable').DataTable();

    });

    /* UPDATE Category END */

  </script>



@endsection
