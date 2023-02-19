<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Memo extends Model
{

        public function memoSearch($keyword, $auth_id)
        {
                $search = $this->where('user_id', $auth_id)
                        ->where(function($query) use ($keyword){
                                $query->where('title', 'like', '%' . $keyword . '%')
                                        ->orWhere('content', 'like', '%' . $keyword . '%');
                        });
                $result = $search->orderBy('created_at', 'desc')->paginate(10);
                return $result;
        }
        public function insert($user_id, $request)
        {
                $insert = new Memo;
                $insert->user_id = $user_id;
                $insert->title = $request->input('title');
                $insert->content = $request->input('content');
                if ($insert->save()) {
                        return true;
                }
                return false;
        }

        public function get($memo_id)
        {
                $memo = $this->find($memo_id);
                if ($memo) {
                        if ($memo->user_id == Auth::id()) {
                                return $memo;
                        }
                }
                return false;
        }

        public function memoUpdate($request)
        {
                $memo_id = $request->input('id');
                $memo = $this->find($memo_id);    
                if($memo) {
                                $memo->title = $request->input('title');
                                $memo->content = $request->input('content');
                                if ($memo->save()) {
				                        return true;
                                }
                        }
		        return false;
        }

        public function memoDelete($request)
        {
                $memo_id = $request->input('memo_id');
                $memo = $this->find($memo_id);
                if ($memo) {
                        $memo->forceDelete();
                        return true;
                }
                return false;
        }
}
