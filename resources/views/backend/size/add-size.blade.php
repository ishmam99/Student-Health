@extends('layouts.fixed')

@section('content')
  <div class="boxed">
    <div id="content-container">
      <div id="page-head">
        <div id="page-title">
          <h1 class="page-header text-overflow">Add / View Size</h1>
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
                <h3 class="panel-title">Add New Size</h3>
              </div>
              <div class="panel-body">
                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-12">
                  <div class="col-lg-12 col-sm-12 {{$errors->has('name') ? 'has-error' : ''}}">
                    {{ Form::open(['route'=>'size.store','method'=>'post','enctype'=>'multipart/form-data','id'=>'karatForm']) }}
                    {{ Form::label('size','Size Name: ',['class'=>'control-label'])}}
                    {{Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Ex: Medium','required'=>'required'])}}
                    @if ($errors->has('name'))
                      <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="col-md-12 col-xs-12">
                    <br>
                  </div>

                  <div class="col-md-12 col-xs-12">
                    {{ Form::button('SAVE SIZE',['type'=>'submit','class'=>'btn btn-primary']) }}
                  </div>
                  {{ Form::close() }}
                </div>

                <div class="col-lg-8 col-sm-8 col-md-8 col-xs-12">
                  <table class="table table-bordered " id="karatTable">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Size</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $i=0 @endphp
                      @foreach($size as $info)
                        <tr>
                          <td>{{++$i}}</td>
                          <td>{{$info->name}}</td>
                          <td>
                            <a href="{{route('size.edit',$info->id)}}" class="btn btn-sm btn-info edit"><i class="demo-pli-pen-5"></i></a> ||
                            <button class="btn btn-sm btn-danger erase" data-id="{{$info->id}}" data-url="{{url('ProductManagement/Size/erase')}}"><i class="demo-pli-trash"></i></button>
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
      $('#karatTable').DataTable();

    });

    /* UPDATE karat END */

  </script>



@endsection
