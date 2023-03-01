<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Memo extends Model
{
        protected $fillable = [
                'user_id', 'title', 'content',
        ];

        public function searchMemos($keyword, $auth_id)
        {
                $search = $this->findMemos($auth_id)
                        ->where(function($query) use ($keyword){
                                $query->where('title', 'like', '%' . $keyword . '%')
                                        ->orWhere('content', 'like', '%' . $keyword . '%');
                        });
                $result = $search->orderBy('created_at', 'desc')->paginate(10);
                return $result;
        }

        public function findMemos($auth_id)
        {
                return $this->where('user_id', $auth_id);
        }

        public function addMemo($user_id, $request)
        {
                $add = new Memo;
                $add->user_id = $user_id;
                $add->title = $request->input('title');
                $add->content = $request->input('content');
                if ($add->save()) {
                        return true;
                }
                return false;
        }

        public function findMemoToBeEdited($memo_id)
        {
                $memo = $this->find($memo_id);
                if ($memo && $memo->user_id == Auth::id()) {
                        return $memo;
                }
                return false;
        }

        public function updateMemo($request)
        {
                $memo_id = $request->input('id');
                $memo = $this->find($memo_id);    
                if($memo && $memo->user_id == Auth::id()) {
                        $memo->title = $request->input('title');
                        $memo->content = $request->input('content');
                        if ($memo->save()) {
				return true;
                        }
                }
		return false;
        }

        public function deleteMemo($request)
        {
                $memo_id = $request->input('memo_id');
                $memo = $this->find($memo_id);
                if ($memo && $memo->user_id == Auth::id()) {
                        $memo->forceDelete();
                        return true;
                }
                return false;
        }


}
