<?php 
    session_start();
    include("connexion.php");
    include("getdate.php");
    $rq=$pdo->prepare("select * from chat where((transmiter=? and receiver=?) or (transmiter=? and receiver=?)) ");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_COOKIE["receiver"],md5($_SESSION["user_id"])));
    $messages= $rq->fetchAll();
    foreach($messages as $message){
        if ($message["receiver"]==$_COOKIE["receiver"]){
            if($message["type"]=="text"){
                echo "<div class='message margin_left'>
                <div class='date'>".get_date($message["time_message"])."</div>
                <div class='message_text'>".$message["message"]."</div>
                </div>";
            }
            elseif($message["type"]=="image"){
                echo "<img class='image_from_me' src='".$message["message"]."' />";
            }
        }
        else{
            if($message["type"]=="text"){
                echo "<div class='message margin_right'>
                <div class='date'>".get_date($message["time_message"])."</div>
                <div class='message_text'>".$message["message"]."</div>
                </div>";
            }
            elseif($message["type"]=="image"){
                echo "<img class='image_from_him' src='".$message["message"]."' />";
            }
        }
    }
?>