@extends('layouts.app')

@section('title', __('Service Unavailable'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">503</h2>
          <p class="message">Service Unavailable: 一時的にサーバにアクセスが出来ません。</p>
          <p class="detail">しばらくしてからもう一度お試しください。</p>
          <a href="/">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection