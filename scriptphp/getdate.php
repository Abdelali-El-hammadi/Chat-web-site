<?php
    function get_date($time){
        $ecart= time()-$time;
        if($ecart/3600 <=24){
            return date("h:i a",$time);
        }
        else{
            return date("F d, Y \a\\t h:i a",$time);
        }
    }
?>