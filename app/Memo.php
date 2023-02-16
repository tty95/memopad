<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Memo extends Model
{
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
                        return $memo;
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
