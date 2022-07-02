<?php 

class Sanitize {

    public static function clean($val)
    {
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        $val = trim($val);
        return $val;
    }

    public static function cleanAll($arr)
    {
        $keys = array_keys($arr);
        $myArr = array();
        foreach($keys as $key)
        {
            $myArr[$key]=self::clean($arr[$key]);
        }
        return $myArr;   
    }

    public static function hashIp($str)
    {
        $srch = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'X');
        $rplc = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k');
        if(!empty($str))
        {
            $hashed = str_replace($srch, $rplc, $str);
        }else{
            $hashed = "please enter correct IP";
        }
        return $hashed;
    }

    public static function dehashIp($str)
    {
        $rplc = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '0', 'X');
        $srch = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k');
        if(!empty($str))
        {
            $hashed = str_replace($srch, $rplc, $str);
        }else{
            $hashed = "please enter correct IP";
        }
        return $hashed;
    }
}