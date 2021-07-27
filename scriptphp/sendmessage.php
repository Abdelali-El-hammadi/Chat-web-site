<?php
    session_start();
    include("connexion.php");
    $rq=$pdo->prepare("insert into chat(transmiter,receiver,time_message,message) values(?,?,now(),?)");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_POST["msg"]));
    $rq=$pdo->prepare("select * from chat
    where( (transmiter=? and receiver=?) or (transmiter=? and receiver=?)) order by id DESC limit 1;");
    $rq->setFetchMode(PDO::FETCH_ASSOC);
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_COOKIE["receiver"],md5($_SESSION["user_id"])));
    $message=$rq->fetchAll();
    if ($message[0]["receiver"]==$_COOKIE["receiver"]){
        echo "<div class='from_me'>".$message[0]["message"]."</div>";
    }
    else{
        echo "<div class='from_him'>".$message[0]["message"]."</div>";
    }
?>