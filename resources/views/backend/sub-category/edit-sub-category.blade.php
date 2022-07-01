@extends('layouts.fixed')

@section('content')
  <div class="boxed">
    <div id="content-container">
      <div id="page-head">
        <div id="page-title">
          <h1 class="page-header text-overflow">Edit Sub-Category</h1>
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
                <h3 class="panel-title">Edit Sub-Category</h3>
              </div>
              <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                  @if(Session::has('exist'))
                    <div class="has-error">
                      <strong class="help-block">
                        <span> {{ Session::get('exist') }}</span>
                      </strong>
                    </div>
                  @endif



                  {{ Form::open(['route'=>'sub-category.update','method'=>'post', 'enctype'=>'multipart/form-data',]) }}

                  <input type="hidden" name="id" value="{{ $subcategory->id }}">

                  <div class="form-group">
                    {{ Form::label('category','Select Category',['class'=>'label-control']) }}
                    <select class="form-control" name="category_id">
                      @foreach($category as $cinfo)
                        @if($cinfo->id == $subcategory->category->id)
                          <option value="{{ $cinfo->id }}" selected> {{ $cinfo->name }}</option>
                        @else
                          <option value="{{ $cinfo->id }}"> {{ $cinfo->name }}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>

                  <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                    {{ Form::label('SubCategory','Sub-Category Name : ',['class'=>'control-label'])}}
                    {{Form::text('name',$subcategory->name,['class'=>'form-control','placeholder'=>'Ex: Men-Ring'])}}
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-lg-12 col-sm-12 {{$errors->has('image') ? 'has-error' : ''}}">
                    <br>
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
                    {{Form::textarea('description',$subcategory->description,['class'=>'form-control','placeholder'=>'Subcategory Details....'])}}
                    @if ($errors->has('description'))
                      <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                      </span>
                    @endif
                    <br>
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
                    {{ Form::button('UPDATE SUB-CATEGORY ',['type'=>'submit','id'=>'saveCategory','class'=>'col-sm-12 btn btn-primary']) }}
                    <hr>
                    <a href="{{ route('sub-category.add') }}" class="btn btn-danger">Cancel Edit</a>
                  </div>
                  {{ Form::close() }}
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
