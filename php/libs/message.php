<?php

namespace lib;

use model\AbstractModel;
use Throwable;

class Message extends AbstractModel
{
    protected static $SESSION_NAME = '_msg';
    public const ERROR = 'error';
    public const INFO = 'info';
    public const DEBUG = 'debug';

    public static function Push($type, $msg)
    {
        if (!is_array(static::getSession())) {
            static::init();
        }

        $msgs = static::getSession();
        $msgs[$type][] = $msg;
        static::setSession($msgs);
    }

    public static function flush()
    {
        try {
            $msgs_with_type = static::getSessionAndclearSession() ?? [];

            foreach ($msgs_with_type as $type => $msgs) {
                if ($type === Message::DEBUG && !false) {
                    'Debug Message!!';
                }
                foreach ($msgs as $msg) {
                    echo "<div>{$type}:{$msg}</div>";
                }
            }
        } catch (Throwable $e) {
            Message::Push(Message::DEBUG, $e->getMessage());
            Message::Push(Message::ERROR, 'An error has occurred in the Message::flush process.');
        }
    }

    public static function init()
    {
        static::setSession([
            static::ERROR => [],
            static::INFO => [],
            static::DEBUG => []
        ]);
    }

    public static function getSessionAndclearSession()
    {
        try {
            return static::getSession();
        } finally {
            static::clearSession();
        }
    }
}
