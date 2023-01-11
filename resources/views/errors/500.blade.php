@extends('layouts.main')
@section('title','Internal Server Error')
@section('css')
<style>
    .non-exist-wrp { min-height: 100vh; background-color: aliceblue; margin-bottom: -60px; display: flex; align-items: center; justify-content: center }
    .non-exist-innr { box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1); text-align: center }
    .non-exist-innr h1 { font-weight: 800; font-size: 5rem; color: #EA2734 }
    .non-exist-innr h2 { font-weight: 800; font-size: 2.5rem; color: #324148 }
    .non-exist-innr p { color: #5e7d8a; }
    .non-exist-innr p a { color: #EA2734; text-decoration: underline }
</style>
@endsection

@section('content') 
<main>
  <div class="container-fluid non-exist-wrp">
      <div class="container">
          <div class="row align-items-center justify-content-center">
              <div class="col-md-6">
                  <div class="card non-exist-innr">
                      <div class="card-body">
                          <img src="{{asset('frontend/images/logo.png')}}" width="100" alt="">
                          <h1>500</h1>
                          <h2>Internal Server Error</h2>
                          <p>Whoops, something went wrong on our end. Try refreshing the page, or going back and attempting the action again.</p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection

