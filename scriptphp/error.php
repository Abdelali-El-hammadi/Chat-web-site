<?php
    function error($e){
        if(!empty($e)){
            echo "<div class='error'>".$e."</div>";
        }
    }
    function error_image($e){
        if(!empty($e)){
            echo "<div class='error_image'>".$e."</div>";
        }
    }

?>