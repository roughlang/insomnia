@extends('layouts.app')

@section('title', __('Unauthorized'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">401</h2>
          <p class="message">Unauthorized: 認証に失敗したか権限がありません。</p>
          <p class="detail">もう一度ログインし直してください。</p>
          <a href="/">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
