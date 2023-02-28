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

<div class="col-md-8 col-md-offset-2" style="margin-bottom:20px;">
<form class="form-inline" action="{{ route('memo.index') }}">
<div class="form-group">
<input type="text" name="keyword" class="form-control" placeholder="キーワード">
</div>
<input type="submit" value="検索" class="btn btn-info">
</form>
</div>

<div class="col-md-8 col-md-offset-2">
<div class="panel panel-warning">

<div class="panel-heading text-center">
<h4><strong>メモ一覧</strong></h4>
<div class="text-right">
<button class="btn btn-success" onclick="location.href='{{ route('memo.add') }}'">メモを追加</button>
</div>
</div>

<table class="table table-hover">
@if (0 < $memos->count())
@foreach ($memos as $memo)

<tbody>
<tr>
<!-- trigger modal -->
<td class="text-left" style="width: 90%" data-toggle="modal" data-target="#exampleModal{{ $memo->id }}">
<h4>{{ $memo->title }}</h4>
</td>

<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $memo->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
<h3 class="text-center"><strong>メモ詳細</strong></h3>

<div class="modal-header">
<h4 style="margin-bottom:20px;"><mark>タイトル</mark></h4>
<h5 class="modal-title" id="exampleModalLabel">
{{ $memo->title }}
</h5>
</div>

<div class="modal-body">
<h4 style="margin-bottom:20px;"><mark>内容</mark></h4>
<h5>{!!nl2br(e($memo->content))!!}</h5>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
</div>

</div>
</div>
</div>

<td class="text-right">
<button class="btn btn-primary" onclick="location.href='{{ route('memo.edit', $memo->id) }}'">編集</button>
</td>

<td class="text-right">
<form class="form-horizontal" method="POST" action="{{ route('memo.delete') }}">
{{ csrf_field() }}
{{ method_field('DELETE') }}
<input type="hidden" name="memo_id" value="{{ $memo->id }}">
<button class="btn btn-danger" onclick="return select()" type="submit">削除</button>
</form>
</td>

</tr>
@endforeach
</tbody>
</table>

<div class="col-md-8">
<div class="paginate">
{{$memos->appends(request()->query())->links()}}
</div>
</div>

@else
<div class="text-center">
<h4>メモがありません</h4>
</div>
@endif

</div>
</div>

</div>
</div>
@endsection