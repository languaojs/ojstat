<?php 
$siteid = $data['siteid'];
$widget_source = $data['widget_source'];
$widget_reader = $data['widget_reader'];

if(file_exists($widget_source))
{
    include $widget_reader;
}else{
    touch($widget_source);
    include $widget_reader;
}

?>