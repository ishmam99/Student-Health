@extends('layouts.fixed')

@section('content')
  <div class="boxed">
    <div id="content-container">
      <div id="page-head">
        <div id="page-title">
          <h1 class="page-header text-overflow">Edit Size</h1>
        </div>
        <ol class="breadcrumb">
          <li><a href="#"><i class="demo-pli-home"></i></a></li>
          <li><a href="#">Admin</a></li>
          <li class="active">Size</li>
        </ol>
      </div>
      <div id="page-content">
        <div class="row">
          <div class="col-sm-12">
            <div class="panel">
              <div class="panel-heading">
                <h3 class="panel-title">Edit Size</h3>
              </div>
              <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                  <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">

                    {{ Form::open(['route'=>'size.update','method'=>'post','enctype'=>'multipart/form-data','id'=>'CategoryForm']) }}
                    {{ Form::label('size','Size Name : ',['class'=>'control-label'])}}
                    {{ Form::hidden('id',$size->id,['class'=>'form-control']) }}
                    {{Form::text('name',$size->name,['class'=>'form-control','placeholder'=>'Ex: Medium','required'=>'required'])}}
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif

                  </div>

                  <div class="col-md-12 col-xs-12">
                    <br>
                  </div>

                  <div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
                    {{ Form::button('UPDATE SIZE',['type'=>'submit','class'=>'btn btn-primary']) }}
                  </div>
                  <div class="col-lg-1 co-sm-1 col-md-1 col-xs-12"></div>
                  <div class="col-md-5 col-sm-5 col-lg-5 col-xs-12">
                    <a href="{{route('size.add')}}" class="btn btn-danger"> Cancel</a>

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
