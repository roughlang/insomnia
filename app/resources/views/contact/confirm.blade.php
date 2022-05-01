@extends('layouts.app')

@section('title', 'Contact')

@section('content_block')
<div class="container contact">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mt60 mb60">
        <div class="card-header">お問い合わせ</div>
        <div class="card-body">

          <div class="row mb10">
            <div class="col-md-4 text-md-end">
              名前
            </div>
            <div class="col-md-6">
              {{ $name }}
            </div>
          </div>
          <div class="row mb10">
            <div class="col-md-4 text-md-end">
              Email
            </div>
            <div class="col-md-6">
              {{ $email }}
            </div>
          </div>
          <div class="row mb10">
            <div class="col-md-4 text-md-end">
              お問い合わせ内容
            </div>
            <div class="col-md-6">
              {{ $inquiry_text }}
            </div>
          </div>
          <div class="row mb10">
            <div class="col-md-4 text-md-end">
              お問い合わせの種類
            </div>
            <div class="col-md-6">
              {{ $category }}
            </div>
          </div>

          <div class="row mb-0 mt30">
            <div class="col-md-6 offset-md-4">
              <form method="POST" action="/contact/send">
                @csrf
                <a href="#" onclick="window.history.back(); return false;">戻る</a>
                <button type="submit" class="btn btn-secondary">
                  お問い合わせを送信する
                </button>
              </form>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection