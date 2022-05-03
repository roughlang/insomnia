@extends('layouts.app')

@section('title', __('Not Found'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">404</h2>
          <p class="message">Not Found: お探しのページは見つかりませんでした。</p>
          <p class="detail">トップページに戻ってもう一度検索してください。</p>
          <a href="/">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
