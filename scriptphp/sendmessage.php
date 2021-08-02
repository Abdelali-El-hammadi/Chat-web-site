<?php
    session_start();
    include("getdate.php");
    echo "<div class='message margin_left'>
        <div class='date'>".get_date(time())."</div>
        <div class='message_text'>".$_POST["msg"]."</div>
        </div>";
    include("connexion.php");
    
    $rq=$pdo->prepare("insert into chat(transmiter,receiver,time_message,message) values(?,?,?,?)");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],time(),$_POST["msg"]));
    
?>