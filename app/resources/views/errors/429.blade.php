@extends('layouts.app')

@section('title', __('Too Many Requests'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">429</h2>
          <p class="message">Too Many Requests: リクエスト回数が多すぎます。</p>
          <p class="detail">しばらくしてからもう一度お試しください。</p>
          <a href="#">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection