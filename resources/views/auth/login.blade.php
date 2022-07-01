@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Login') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                  </button>

                  @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                      {{ __('Forgot Your Password?') }}
                    </a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
{{-- <button type="button" id="playButton1">Watch Video1</button>                                             
    <script type="text/javascript" src="https://cdn.applixir.com/applixir.sdk3.0m.js"></script>   
    <div id="applixir_vanishing_div" hidden>
        <iframe id="applixir_parent" allow="autoplay"></iframe>
    </div> --}}


    {{-- cd0912c4c8057e6dcb12bdb9f35f9dfe --}}

    {{-- <script type="application/javascript">
        function adStatusCallback(status) {                  // Status Callback Method
            console.log('Ad Status: ' + status);
        }

        var options = {                                     // Video Ad Options
             zoneId: 30506,
            //  accountId: xxxx,                               // Required field for RMS                                                                               
            //  gameId: yyyy,                                  // Required field for RMS
             adStatusCb: adStatusCallback,
            //  userId: currentUserID(),                      // Required field for RMS
            //  custom: currentUserReward(),
        };  
        playBtn1= document.getElementById("playButton1");                                                      
        playBtn1.onclick = function () {                     
                     invokeApplixirVideoUnit(options);     // Invoke Video ad
       }
    </script> --}}

{{--  --}}

{{-- <button type="button" id="playButton2nd">Watch</button>                                             
    <script type="text/javascript" src="https://cdn.applixir.com/applixir.sdk3.0m.js"></script>   
    <div id="applixir_vanishing_div" hidden>
        <iframe id="applixir_parent" allow="autoplay"></iframe>
    </div>

    <script type="application/javascript">
        function adStatusCallback(status) {                  // Status Callback Method
            console.log('Ad Status: ' + status);
        }

        // function currentUserID(id){
        //   console.log('id', id);
        // }                      // Required field for RMS

        var options = {                                     // Video Ad Options
             zoneId: 4720,
             accountId: 6033,                               // Required field for RMS                                                                               
             gameId: 6892,                                  // Required field for RMS
             adStatusCb: adStatusCallback,
            //  userId: 1234,                      // Required field for RMS
            //  custom: currentUserReward(),
        };  
        playBtn = document.getElementById("playButton2nd");                                                      
        playBtn.onclick = function () {                     
                     invokeApplixirVideoUnit(options);     // Invoke Video ad
       }
    </script> --}}
{{--  --}}
{{-- <button type="button" id="playButton3nd">Watch 3</button>                                             
<script type="text/javascript" src="https://cdn.applixir.com/applixir.sdk3.0m.js"></script>   
<div id="applixir_vanishing_div" hidden>
    <iframe id="applixir_parent" allow="autoplay"></iframe>
</div> --}}

{{-- <script type="application/javascript">
    function adStatusCallback(status) {                  // Status Callback Method
        console.log('Ad Status: ' + status);
    }

    var options = {                                     // Video Ad Options
         zoneId: 30506,
        //  accountId: xxxx,                               // Required field for RMS                                                                               
        //  gameId: yyyy,                                  // Required field for RMS
         adStatusCb: adStatusCallback,
        //  userId: currentUserID(),                      // Required field for RMS
        //  custom: currentUserReward(),
    };  
    playBtn3 = document.getElementById("playButton3nd");                                                      
    playBtn3.onclick = function () {                     
                 invokeApplixirVideoUnit(options);     // Invoke Video ad
   
</script>} --}}


