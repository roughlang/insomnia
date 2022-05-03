@extends('layouts.app')

@section('title', __('Session has expired'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">419</h2>
          <p class="message">Session has expired: セッションが切れました。</p>
          <p class="detail">もう一度ログインし直してください。</p>
          <a href="/">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection