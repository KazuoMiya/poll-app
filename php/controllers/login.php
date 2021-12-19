<?php 
namespace controller\login;
use lib\Auth;
use lib\Message;

function get() {
    require_once SOURCE_BASE . 'views/login.php';
}

function post() {
    $id = get_param('id', '');
    $pwd = get_param('pwd', '');

    if (Auth::login($id, $pwd)) {
        Message::Push(Message::INFO, 'Succsessful!');
        redirect(GO_HOME);
    } else {
        Message::Push(Message::INFO, 'Fail.');
        redirect(GO_REFERER);
    }
}