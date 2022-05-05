@extends('layouts.app')

@section('title', 'Tools | Serializer | Insomnia Roughlang')

@section('content_block')

<div class="container column2-card">
  <div class="row mt60 mb60">
    <div class="col-md-9">
      <h2 class="mb60">Tools</h2>
      <div class="breadcrumb">
        <ul>
          <li class="parent"><a href="/">Home</a></li>
          <li class="parent"><a href="/tools">Tools</a></li>
          <li>serializer</li>
        </ul>
      </div>

      <div class="tools">
        <p class="summary">
          jsonフォーマットをシリアライズします。またシリアライズされた文字列をjsonに戻します。
        </p>
        <div id="app" class="app">
          <textarea class="form-text" name="text" v-model="text"></textarea>
          <button @click="run()" type="button" class="mt10 btn-sm btn btn-secondary">Go</button>
          <pre class="view mt30"><code>@{{ res }}</code></pre>
        </div>
        <style>
          .form-text {
            width:100%;
            height: 200px;
            border: 1px solid #c1c1c1;
            border-radius: 3px;
            padding: 20px;
          }
          .view {
            background: #f5f5f5;
            border: 1px solid #c1c1c1;
            border-radius: 3px;
            padding: 20px;
          }
        </style>
        <script>
          const app = new Vue({
            el: "#app",
            data: {
              text: null,
              res: '',
            },
            methods: {
              run:function(){
                this.res = "";
                let data = new FormData();
                data.append('text', this.text);
                axios.post('/tools/serialized', data).then(response => {
                  console.log(response.status);
                  // console.log(response.data);
                  this.res = response.data;
                  console.log(this.res);
                }).catch(error => {
                  console.log(error.response.status);
                });
              }
            },
          });
        </script>
      </div>

    </div>
    <div class="col-md-3 mt60">
      <div class="card column2-card-sidebar">
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><a href="/tools/serializer">serializer</a></li>
          <li class="list-group-item"><a href="/tools/hash">hash</a></li>
          <li class="list-group-item"><a href="#">foobar</a></li>
          <li class="list-group-item"><a href="#">foobar</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection