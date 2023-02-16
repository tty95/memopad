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

@if (session('success_message'))
<div class="alert alert-success text-center">
{{ session('success_message') }}
</div>
@elseif (session('message'))
<div class="alert alert-danger text-center">
{{ session('message') }}
</div>
@endif

<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading" align="center">メモ一覧</div>
<div class="panel-body">

<div class="card" style="width: 100%;">
<div class="card-header">
<div align="right">
<button class="btn btn-success" onclick="location.href='{{ route('memo.add') }}'">メモを追加</button>
</div>
</div>
</div>
<table class="table">
@if (0 < $memos->count())
@foreach ($memos as $memo)
<tbody>
<tr>
<td><a href="{{ route('memo.detail', $memo->id) }}">{{ $memo->title }}</a></td>
<td>
</div>
</td>
<td>
<form class="form-horizontal" method="POST" action="{{ route('memo.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="memo_id" value="{{ $memo->id }}">
<button class="btn btn-danger" onclick="return select()" type="submit">削除</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
@else
<div align=center>メモがありません</div>
@endif
</div>

</div>
</div>
</div>
</div>
</div>
@endsection