<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{

        public function __construct(User $user)
        {
                $this->user = $user; //Usermodelをインスタンス化
        }

        public function getGoogleAuth()
        {
                return Socialite::driver('google')
                        ->redirect();
        }

        public function authGoogleCallback()
        {
                $gUser = Socialite::driver('google')->stateless()->user();
                // email が合致するユーザーを取得
                $user = $this->user->findEmail($gUser);
                // 見つからなければ新しくユーザーを作成
                if ($user === null) {
                        $user = $this->user->createUserByGoogle($gUser);
                }
                Auth::login($user, true);
                return redirect('/memopad');
        }
}
