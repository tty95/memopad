@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-warning">
<div class="panel-heading text-center">新規メモ追加ページ</div>
<div class="panel-body">

@if (count($errors) > 0)
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form class="form-horizontal" method="POST" action="{{ route('memo.insert') }}">
{{ csrf_field() }}
<div class="form-group">
<label for="title" class="col-md-4 control-label">タイトル</label>
<div class="col-md-6">
<input id="title" type="text" class="form-control" name="title" maxlength="40" placeholder="メモ１" value="{{ old('title') }}" required autofocus>
</div>
</div>
<div class="form-group">
<label for="content" class="col-md-4 control-label">メモ内容</label>
<div class="col-md-6">
<textarea id="content" type="text" rows="10" class="form-control" name="content" required autofocus>{{ old('content') }}</textarea>
</div>
</div>
<div class="form-group">
<div class="col-md-8 col-md-offset-4">
<button type="submit" class="btn btn-success">追加する</button>
</div>
</div>
</form>

<div><a href="{{ route('memo.index') }}">メモ一覧へ</a></div>

</div>
</div>
</div>
</div>
</div>
@endsection