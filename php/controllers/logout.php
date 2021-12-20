<?php

namespace controller\logout;

use lib\Auth;
use lib\Message;

function get()
{
    if (Auth::logout()) {
        Message::Push(Message::INFO, 'Logout was successful.');
    } else {
        Message::Push(Message::ERROR, 'Logout has failed.');
    }

    redirect(GO_HOME);
}
