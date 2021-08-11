<?php 
    session_start();
    include("connexion.php");
    include("getdate.php");
    $rq=$pdo->prepare("select * from chat where((transmiter=? and receiver=?) or (transmiter=? and receiver=?)) order by  time_message DESC limit 10");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_COOKIE["receiver"],md5($_SESSION["user_id"])));
    $messages= $rq->fetchAll();
    foreach($messages as $message){
        if ($message["receiver"]==$_COOKIE["receiver"]){
            if($message["type"]=="text"){
                echo "<div class='message margin_left'>
                <div class='date'>".get_date($message["time_message"])."</div>
                <div class='message_text from_me'>".$message["message"]."</div>
                </div>";
            }
            elseif($message["type"]=="image"){
                echo "<div class='message margin_left'>
                <div class='date'>".get_date($message["time_message"])."</div>
                <img class='image_from_me image' loading='lazy' onclick='click_image()' src='".$message["message"]."' />
                </div>";     
            }
        }
        else{
            if($message["type"]=="text"){
                echo "<div class='message margin_right'>
                <div class='message_text from_him'>".$message["message"]."</div>
                <div class='date'>".get_date($message["time_message"])."</div>
                </div>";
            }
            elseif($message["type"]=="image"){
                echo "<div class='message margin_right'>
                <img class='image_from_him image' loading='lazy'onclick='click_image()' src='".$message["message"]."' />
                <div class='date'>".get_date($message["time_message"])."</div>
                </div>";        
            }
        }
    }
?>