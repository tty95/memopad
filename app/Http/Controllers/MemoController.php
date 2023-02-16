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

        public function index()
        {
                $auth_id = Auth::id();
                $memos = $this->memo->where('user_id', $auth_id)->get();
                return view('memo.index', compact('memos'));
        }

        public function detail($memo_id)
        {
                $result = $this->memo->get($memo_id);
                if ($result) {
                        return view('memo.detail', compact('result'));
                }
                return redirect('/memopad')->with('message', '存在しないメモです。');
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

        public function edit(MemoRequest $request)
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
