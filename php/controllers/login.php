<?php

namespace controller\login;

use lib\Auth;
use lib\Message;
use model\UserModel;

function get()
{
    require_once SOURCE_BASE . 'views/login.php';
}

function post()
{
    $id = get_param('id', '');
    $pwd = get_param('pwd', '');

    if (Auth::login($id, $pwd)) {
        $user = UserModel::getSession();
        Message::Push(Message::INFO, "Succsessful! Hi {$user->nickname}!");
        redirect(GO_HOME);
    } else {
        redirect(GO_REFERER);
    }
}
