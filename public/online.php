<?php
global $dbfile, $expire;
$dbfile = $data['widget_source'];
$expire = 300;

if(file_exists($dbfile))
{
    if(is_writable($dbfile))
    {
        echo "";
    }else{
        echo "DB FIle is not writable";
    }

}else{
    echo "DB File does not exist!";
}

function getIp()
{
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }elseif(isset($_SERVER['REMOTE_ADDR']))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }else{
        $ip = "0";
    }
    return $ip;
}

function myEach(&$arr)
{
    $key = key($arr);
    $result = ($key == null)? false: [$key, current($arr), 'key'=>$key, 'value'=>current($arr)];
    next($arr);
    return $result;
}

function countVisitor($dbfile, $expire)
{
    $cur_ip = getIp();
    $cur_time = time();
    $dbarraynew = array();
    
    $dbarray = unserialize(file_get_contents($dbfile));

    if(is_array($dbarray))
    {
        while(list($user_ip, $user_time) = myEach($dbarray)) {
            if(($user_ip != $cur_ip) && (($user_time + $expire) > $cur_time)) {
                $dbary_new[$user_ip] = $user_time;
            }
        }
    }

    $dbarraynew[$cur_ip] = $cur_time;
    $fp = fopen($dbfile, 'w');
    fputs($fp, serialize($dbarraynew));
    fclose($fp);
    $out = sprintf("%03d", count($dbarraynew));
    return $out;
}
$onlineVisitor = countVisitor($dbfile, $expire);
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <p class="text-dark rounded d-flex justify-content-center align-items-center shadow olcounter" style="width:90%; margin:auto;" title="OJStat | Online Visitor Counter">
                <span class="display-3 mr-2"><?=Sanitize::clean($onlineVisitor);?></span>
                <span>Online <br> Visitor(s)</span>
            </p>
        </div>
    </div>
</div>