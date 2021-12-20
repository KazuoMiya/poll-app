<?php

namespace model;

use lib\Message;

class UserModel extends AbstractModel
{
    public string $id;
    public string $pwd;
    public string $nickname;
    public int $del_flg;

    protected static $SESSION_NAME = '_user';

    public function isValidId()
    {
        return static::validateId($this->id);
    }

    public static function validateId($val)
    {
        $res = true;

        if (empty($val)) {
            Message::Push(Message::ERROR, 'Input the User ID.');
            $res = false;
        } else {

            if (strlen($val) > 10) {
                Message::Push(Message::ERROR, 'Input the User ID witin 10 letters.');
                $res = false;
            }

            if (!preg_match("/^[a-zA-Z0-9]+$/", $val)) {
                Message::Push(Message::ERROR, 'Input the User ID only Hankaku or numbers.');
                $res = false;
            }
        }
        return $res;
    }
}
