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

            if (!is_alnum($val)) {
                Message::Push(Message::ERROR, 'Input the User ID only Hankaku or numbers.');
                $res = false;
            }
        }
        return $res;
    }

    public static function validatePwd($val)
    {
        $res = true;

        if (empty($val)) {

            Message::push(Message::ERROR, 'Input the User Password.');
            $res = false;
        } else {

            if (strlen($val) < 4) {

                Message::push(Message::ERROR, 'Input the User Password over 4 letters.');
                $res = false;
            }

            if (!is_alnum($val)) {

                Message::push(Message::ERROR, 'Input the User Password only Hankaku or numbers.');
                $res = false;
            }
        }

        return $res;
    }

    public function isValidPwd()
    {
        return static::validatePwd($this->pwd);
    }

    public static function validateNickname($val)
    {

        $res = true;

        if (empty($val)) {

            Message::push(Message::ERROR, 'Input the User Nickname.');
            $res = false;
        } else {

            if (mb_strlen($val) > 10) {

                Message::push(Message::ERROR, 'Input the User Nickname under 10 letters.');
                $res = false;
            }
        }

        return $res;
    }

    public function isValidNickname()
    {
        return static::validateNickname($this->nickname);
    }
}
