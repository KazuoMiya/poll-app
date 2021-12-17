<?php 
namespace lib;
use db\UserQuery;

class Auth {
    public static function login($id, $pwd) {
        $is_succses = false;
        $user = UserQuery::fetchById($id);
    
        if (!empty($user) && $user->del_flg !== 1) {
            if (password_verify($pwd, $user->pwd)) {
                $is_succses = true;
                $_SESSION['user'] = $user;
            } else {
                echo 'Password Error!<br>';
            }
        } else {
            echo 'User not exist!';
        }
    
        return $is_succses;
    }

    public static function regist($user) {
        $is_succses = false;
        $exist_user = UserQuery::fetchById($user->id);
    
        if (!empty($exist_user)) {
            echo 'User exist!';
            return false;
        }

        $is_succses = UserQuery::insert($user->id, $user->pwd, $user->nickname);
    
        return $is_succses;
    }
}