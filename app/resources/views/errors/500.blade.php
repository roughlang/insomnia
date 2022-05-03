@extends('layouts.app')

@section('title', __('Internal Server Error'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">500</h2>
          <p class="message">Internal Server Error: エラーが発生しました。</p>
          <p class="detail">問題が続く場合は、管理者に問い合わせてください。<a href="/contact" target="_blank">お問い合わせ</a></p>
          <a href="/">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection