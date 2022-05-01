@extends('layouts.app')

@section('title', 'Contact')

@section('content_block')
<div class="container contact">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card mt60 mb60">
        <div class="card-header">お問い合わせ</div>
        <div class="card-body">
          <form method="POST" action="/contact/confirm">
            @csrf

            <div class="row mb10">
              <label for="name" class="col-md-4 col-form-label text-md-end">お名前</label>
              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                @if($errors->has('name'))
                  <p class="error error-name">{{ $errors->first('name') }}</p>
                @endif
              </div>
            </div>
            
            <div class="row mb10">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                  <p class="error error-email">{{ $errors->first('email') }}</p>
                @enderror
              </div>
            </div>
            
            <div class="row mb10">
              <label for="inquiry_text" class="col-md-4 col-form-label text-md-end">お問い合わせ内容</label>
              <div class="col-md-6">
                <textarea id="inquiry_text" class="form-control" name="inquiry_text" rows="10">{{ old('inquiry_text') }}</textarea>
                @if($errors->has('inquiry_text'))
                  <p class="error error-inquiry_text">{{ $errors->first('inquiry_text') }}</p>
                @enderror
              </div>
            </div>

            <div class="row mb10">
              <label for="category" class="col-md-4 col-form-label text-md-end">お問い合わせの種類</label>
              <div class="col-md-6">
                <select name="category" id="category" class="form-select form-select-sm" aria-label=".form-select-sm">
                  <option value="">選択してください</option>
                  <option value="コンテンツについて" @if (old('category') == 'コンテンツについて') selected @endif>コンテンツについて</option>
                  <option value="商品について" @if (old('category') == '商品について') selected @endif>商品について</option>
                  <option value="その他" @if (old('category') == 'その他') selected @endif>その他</option>
                </select>
                @error('category')
                  <p class="error error-category">{{ $errors->first('category') }}</p>
                @enderror
              </div>
            </div>

            <div class="row mb10">
              <label for="agreement" class="col-md-4 col-form-label text-md-end"></label>
              <div class="col-md-6">
                <input class="form-check-input" type="checkbox" value="agree" id="agreement" name="agreement" @if (old('agreement')) checked @endif> 利用規約に同意する。
                @if($errors->has('agreement'))
                  <p class="error error-agreement">{{ $errors->first('agreement') }}</p>
                @enderror
              </div>
            </div> 

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-secondary">
                  送信内容を確認する
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection