<?php 

class Session {

    private static $_sessionStarted = FALSE;

    public static function start()
    {
        if(!session_id())
        {
            if(self::$_sessionStarted == FALSE)
            {
                session_start();
                self::$_sessionStarted = TRUE;
            }
        }
    }

    public static function set_user_session($key, $value)
    {
        $_SESSION['user'][$key] = $value;
    }

    public static function get_sess_role()
    {
        if(isset($_SESSION['user']['userrole']))
        {
            return $_SESSION['user']['userrole'];
        }else{
            return FALSE;
        }
    }

    public static function get_session($key)
    {
        if(isset($_SESSION['user'][$key]))
        {
            return $_SESSION['user'][$key];
        }else{
            return FALSE;
        }
    }

    public static function get_role($rolename, $rolearray)
    {
        if(!in_array($rolename, $rolearray))
        {
            session_destroy();
            header('location: '. BASEURL . '/public/home');
        }else{
            echo "";
        }
    }

    public static function get_name()
    {
        return $_SESSION['user']['username'];
    }
}