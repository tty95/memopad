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
                return view('memo.index');
        }

        public function add()
        {
                return view('memo.add');
        }

        public function memoInsert(MemoRequest $request)
        {
                $user_id = Auth::id();
                if ($this->memo->insert($user_id, $request)) {
                        return redirect('/memopad')->with('success_message', '新規メモを追加しました');
                } else {
                        return redirect('memopad')->with('message', 'メモを追加できませんでした');
                }
        }
}
