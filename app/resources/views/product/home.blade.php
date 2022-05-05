@extends('layouts.admin')

@section('content_block')
<div class="container member">
  <div class="row mt100">
    <div class="col-sm-9">
      <h3>Home</h3>
      <h4>{{ $user['name'] }}</h4>
    </div>
    <div class="col-sm-3">
      @include('include/member-side-menu')
    </div>
  </div>
</div>
@endsection