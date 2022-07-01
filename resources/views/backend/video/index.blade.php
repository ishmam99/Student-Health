@extends('layouts.fixed')

@section('title', 'Videos')

@section('content')
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Videos</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Videos</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
        <div class="card-title">
          Video List
        </div>
      </div>
      <div class="card-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>type</th>
              <th>Count</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($videos as $video)
            <tr>
              @if($video->ads_type == 1)
              <td>Adsence</td>
              @elseif($video->ads_type == 2)
              <td>UnityAds</td>
              @elseif($video->ads_type == 3)
              <td>Media.net</td>
              @elseif($video->ads_type == 4)
              <td>2Captcha</td>
              @else
              <td>Megatypers</td>
              @endif
              <td>{{$video->watched_count}}</td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
@endsection