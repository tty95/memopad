<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
        use Notifiable;

        /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = [
                'name', 'email', 'password',
        ];

        /**
        * The attributes that should be hidden for arrays.
        *
        * @var array
        */
        protected $hidden = [
                'password', 'remember_token',
        ];

        public function getAdminUserFromEmail($email)
        {
                return $this->where('email', $email)->first();
        }

        public function createUserByGoogle($google_user)
        {
                $user = User::create([
                        'name' => $google_user->name,
                        'email' => $google_user->email,
                        'password' => Hash::make(uniqid()),
                ]);
                return $user;
        }

        public function findEmail($google_user)
        {
                return $this->where('email', $google_user->email)->first();
        }
}
