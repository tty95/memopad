<?php

namespace App\Http\Controllers;

use App\Memo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MemoRequest;

class MemoController extends Controller
{

        public function __construct(Memo $memo)
        {
                $this->memo = $memo;
        }

        public function index(Request $request)
        {
                $auth_id = Auth::id();
                if ($request->has('keyword')) {
                        $keyword = $request->input('keyword');
                        $memos = $this->memo->memoSearch($keyword, $auth_id);
                } else {
                        $result = $this->memo->where('user_id', $auth_id);
                        $memos = $result->orderBy('created_at', 'desc')->paginate(10);
                }
                return view('memo.index', compact('memos'));
        }

        public function add()
        {
                return view('memo.add');
        }

        public function memoInsert(MemoRequest $request)
        {
                $user_id = Auth::id();
                if ($this->memo->insert($user_id, $request)) {
                        return redirect('/memopad')->with('success_message', '新規メモを追加しました！');
                }
                return redirect('/memopad')->with('message', 'メモを追加できませんでした。');
                
        }

        public function edit($memo_id)
        {
                $result = $this->memo->get($memo_id);
                if ($result) {
                        return view('memo.edit', compact('result'));
                }
                return redirect('/memopad')->with('message', '存在しないメモです。');
        }

        public function update(MemoRequest $request)
        {
                if ($this->memo->memoUpdate($request)) {
                        return redirect('/memopad')->with('success_message', '編集しました！');
                }
                return redirect('/memopad')->with('message', '編集できませんでした。');
                   
        }

        public function delete(Request $request)
        {
                if ($this->memo->memoDelete($request)) {
                        return redirect('/memopad')->with('success_message', 'メモを削除しました。');
                }
                return redirect('/memopad')->with('message', 'メモを削除できませんでした。');
        }
}
