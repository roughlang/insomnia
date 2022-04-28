@extends('layouts.app-in')

@section('title', 'Registed | Roughlang')

@section('content_block')
<div class="container lw-contents-block mt100">
  <div class="row mb100">
    <div class="col-sm-12">
      <div class="card mx-auto" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title mb30">Registration Complete</h5>
          <p class="card-text">
            会員登録が完了しました。登録のメールアドレスに本登録URLが記載されています。<br>
            30分以内に本登録の手続きを完了させてください。
          </p>
          <a href="/" class="card-link">Top page</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection