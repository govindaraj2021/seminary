@extends('layouts.app')
<style>
    .hide {
      display: none;
    }

  </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="col-md-8 alert alert-danger alert-div alert-dismissible offset-md-2">
                    <a href="#" class="close close_btn" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ $error }}
                        </div>
                        @endforeach
                        
                @endif
                @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif

                <div class="card-body">

                    <div class="row" style="margin:10px 0 20px 0">
                        <div class="col-md-12 text-center">
                            <img src="{{ asset('/assets/img/logo/logo.png')}}" alt="" style="max-width: 320px;height:150px">
                        </div>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('User Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('nmae'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                    @foreach ($errors->all() as $error)

                
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script>
      $(".close_btn").click(function(){
  $('.alert-danger').addClass('hide');
  // $("#div2").show();
  
  // alert("hai");
})
  </script>

@endsection
