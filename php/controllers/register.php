<?php

namespace controller\register;

use lib\Auth;
use lib\Message;
use model\UserModel;

function get()
{
    require_once SOURCE_BASE . 'views/register.php';
}

function post()
{
    $user = new UserModel;
    $user->id = get_param('id', '');
    $user->pwd = get_param('pwd', '');
    $user->nickname = get_param('nickname', '');

    if (Auth::regist($user)) {
        Message::Push(Message::INFO, "Succsessful!Welcom {$user->nickname}!");
        redirect(GO_HOME);
    } else {
        redirect(GO_REFERER);
    }
}
