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

<div class="container-fluid">
<div class="row">
<div class="col-sm-4" style="margin-left:180px; margin-bottom:20px;">
<form class="form-inline" action="{{ route('memo.index') }}">
<div class="form-group">
<input type="text" name="keyword" class="form-control" placeholder="キーワード">
</div>
<input type="submit" value="検索" class="btn btn-info">
</form>
</div>

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-warning">
<div class="panel-heading text-center">メモ一覧
<div class="text-right">
<button class="btn btn-success" onclick="location.href='{{ route('memo.add') }}'">メモを追加</button>
</div>
</div>

<table class="table">
@if (0 < $memos->count())
@foreach ($memos as $memo)
<tbody>
<tr>
<td class="text-left"><a href="{{ route('memo.detail', $memo->id) }}">{{ $memo->title }}</a></td>
<td>
</div>
</td>
<td class="text-right">
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
<div class="col-sm-8" style="text-align:right;">
<div class="paginate">
{{ $memos->links() }}
</div>
</div>
@else
<div class="text-center"><font size="4">メモがありません</font></div>
@endif
</div>

</div>
</div>
</div>
</div>
@endsection