<?php 
namespace lib;

use model\AbstractModel;

class Message extends AbstractModel {
    protected static $SESSION_NAME = '_msg';
    public CONST ERROR = 'error';
    public CONST INFO = 'info';
    public CONST DEBUG = 'debug';

    public static function Push($type, $msg){
        if (!is_array(static::getSession())) {
            static::init();            
        }

        $msgs = static::getSession();
        $msgs[$type][] = $msg;
        static::setSession($msgs);
    }

    public static function flush(){
        $msgs_with_type = static::getSessionAndclearSession() ?? [];

        foreach($msgs_with_type as $type => $msgs){
            foreach ($msgs as $msg) {
                echo "<div>{$type}:{$msg}</div>";
            }
        }
    }

    public static function init(){
        static::setSession([
            static::ERROR=>[],
            static::INFO=>[],
            static::DEBUG=>[]
        ]);
    }

    public static function getSessionAndclearSession()
    {
        try{
            return static::getSession();
        } finally{
            static::clearSession();
        }
    }
}