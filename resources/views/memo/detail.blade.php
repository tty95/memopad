@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div align=center class="panel-heading">メモ詳細ページ</div>
<div class="panel-body">
<table class="table table-striped">
<tr>
<th>タイトル</th>
<th>メモ内容</th>
</tr>
<tr>
<td>{{ $result->title }}</td>
<td>{{ $result->content }}</td>
</tr>
</table>
<a href="{{ route('memo.index') }}">メモ一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection