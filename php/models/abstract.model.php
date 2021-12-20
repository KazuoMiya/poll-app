<?php

namespace model;

use Error;

abstract class AbstractModel
{
    protected static $SESSION_NAME = null;

    public static function setSession($val)
    {
        if (empty(static::$SESSION_NAME)) {
            throw new Error('Need to define $SESSION_NAME.');
        }
        $_SESSION[static::$SESSION_NAME] = $val;
    }

    public static function getSession()
    {
        return $_SESSION[static::$SESSION_NAME] ?? null;
    }

    public static function clearSession()
    {
        static::setSession(null);
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
