@extends('layouts.admin')

@section('content_block')
<div class="container member">
  <div class="row mt100">
    <div class="col-sm-9">
    Account
    </div>
    <div class="col-sm-3">
      @include('include/member-side-menu')
    </div>
  </div>
</div>
@endsection