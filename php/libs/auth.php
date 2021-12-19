<?php

namespace lib;

use db\UserQuery;
use model\UserModel;

class Auth
{
    public static function login($id, $pwd)
    {
        $is_succses = false;
        $user = UserQuery::fetchById($id);

        if (!empty($user) && $user->del_flg !== 1) {
            if (password_verify($pwd, $user->pwd)) {
                $is_succses = true;
                UserModel::setSession($user);
            } else {
                echo 'Password Error!<br>';
            }
        } else {
            echo 'User not exist!';
        }

        return $is_succses;
    }

    public static function regist($user)
    {
        $is_succsess = false;
        $exist_user = UserQuery::fetchById($user->id);

        if (!empty($exist_user)) {
            echo 'User exist!';
            return false;
        }

        $is_succsess = UserQuery::insert($user);
        if ($is_succsess) {
            UserModel::setSession($user);
        }

        return $is_succsess;
    }

    public static function isLogin()
    {
        $user = UserModel::getSession();
        if(isset($user)) {
            return true;
        } else {
            return false;
        }
    }
}
