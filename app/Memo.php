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
}
