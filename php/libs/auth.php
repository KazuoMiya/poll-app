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
            if (!(UserModel::validateId($id)
                * UserModel::validatePwd($pwd)
            )) {
                return false;
            }
            $is_succsess = false;
            $user = UserQuery::fetchById($id);

            if (!empty($user) && $user->del_flg !== 1) {
                if (password_verify($pwd, $user->pwd)) {
                    $is_succsess = true;
                    UserModel::setSession($user);
                } else {
                    Message::Push(Message::ERROR, 'Password Error!<br>');
                }
            } else {
                Message::Push(Message::ERROR, 'User not exist!');
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
            if (!($user->isValidId()
                * $user->isValidPwd()
                * $user->isValidNickname())) {
                return false;
            }
            $is_succsess = false;
            $exist_user = UserQuery::fetchById($user->id);

            if (!empty($exist_user)) {
                Message::Push(Message::INFO, 'User exist!');
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
            UserModel::clearSession();
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

    public static function logout(){
        try {
            UserModel::clearSession();
        } catch (Throwable $e) {
            Message::Push(Message::DEBUG, $e->getMessage());
            return false;
        }
        return true;
    }
}