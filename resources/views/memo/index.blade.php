@extends('layouts.app')
@section('content')

<script>
function select() {
	var select = confirm("本当に削除しますか？");
	if (!select) {
		alert('キャンセルしました');
		return select;
	}
}
</script>

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">メモ一覧</div>
<div class="panel-body">

@if (session('success_message'))
<div class="alert alert-success text-center">
{{ session('success_message') }}
</div>
@elseif (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif


<div class="card" style="width: 100%;">
<div class="card-header">
<div align="right">
<a href="" class="submit">メモを追加</a>
</div>
</div>
<table class="table">
<tbody>
<tr>
<td><a href="">タイトル</a></td>
<td>
<button class="btn btn-primary">編集</button>
</td>
<td>
<button class="btn btn-danger" onclick="return select()">削除</button>
</td>
</tr>
</tbody>
</table>
</div>

</div>
</div>
</div>
</div>
</div>
@endsection