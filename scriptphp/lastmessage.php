<?php
    function last_message($receiver,$pdo){
    $r=$pdo->prepare("select * from chat where((transmiter=? and receiver=?) or (transmiter=? and receiver=?)) order by id DESC limit 1;");
        $r->execute(array(md5($_SESSION["user_id"]),$receiver,$receiver,md5($_SESSION["user_id"])));
        $last_message= $r->fetchAll();
        if(sizeof($last_message)){
            if($last_message[0]["type"]=="image"){
                $last_message[0]["message"]="Sent a photo";
            }
            if ($last_message[0]["receiver"]==$receiver){
                return "You:".$last_message[0]["message"];
            }
            else{
                return $last_message[0]["message"];
            }
        }
        else{
            return "Say hello"; 
        }
    }  
?>