<?php
    function compress_image($source,$destination,$quality){
        $info=getimagesize($source);
        switch($info["mime"]){
            case "image/jpeg":{
                $image=imagecreatefromjpeg($source);
                break;
            }
            case "image/png":{
                $image=imagecreatefrompng($source);
                break;
            }
        }
        imagejpeg($image,$destination,$quality);
    }
?>