<?php
    function get_date($time){
        $ecart= time()-$time;
        if($ecart/3600 <=24){
            if($ecart/3600>=1){
                return (round($ecart/3600))."h ago";
            }
            elseif($ecart/60>=1){
                return (round($ecart/60))."min ago";
            }
            else{
                return ($ecart)."s ago";
            }
        }
        else{
            return date("F d, Y \a\\t h:i a",$time);
        }
    }
?>