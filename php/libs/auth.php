<?php

namespace lib;

use db\UserQuery;
use model\UserModel;

use Throwable;

class Auth
{
    public static function login($id, $pwd)
    {
        try {
            $is_succsess = false;
            $user = UserQuery::fetchById($id);

            if (!empty($user) && $user->del_flg !== 1) {
                if (password_verify($pwd, $user->pwd)) {
                    $is_succsess = true;
                    UserModel::setSession($user);
                } else {
                    echo 'Password Error!<br>';
                }
            } else {
                echo 'User not exist!';
            }
        } catch (Throwable $e) {
            $is_succsess = false;
            Message::Push(Message::DEBUG, $e->getMessage());
            Message::Push(Message::ERROR, 'An error has occurred in the login process.');
        }

        return $is_succsess;
    }

    public static function regist($user)
    {
        try {
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
        } catch (Throwable $e) {
            $is_succsess = false;
            Message::Push(Message::DEBUG, $e->getMessage());
            Message::Push(Message::ERROR, 'An error has occurred in the regist process.');
        }

        return $is_succsess;
    }

    public static function isLogin()
    {
        try {
            $user = UserModel::getSession();
        } catch (Throwable $e) {
            $user = UserModel::clearSession();
            Message::Push(Message::DEBUG, $e->getMessage());
            Message::Push(Message::ERROR, 'An error has occurred. Try again.');
            return false;
        }

        if (isset($user)) {
            return true;
        } else {
            return false;
        }
    }
}
