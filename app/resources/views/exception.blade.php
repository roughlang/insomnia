@extends('layouts.app')

@section('title', __('Unauthorized'))

@section('content_block')

<div class="container error">
  <div class="row justify-content-center"> 
    <div class="col-md-8">
      <div class="card mt120 mb120 border border-0">
        <div class="card-body">
          <h2 class="error-code">Exception</h2>
          <p class="message">{{ $message }}</p>
          <p class="detail">{{ $detail }}</p>
          <a href="javascript:history.back();">Back</a> | <a href="/">Top page</a> 
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
