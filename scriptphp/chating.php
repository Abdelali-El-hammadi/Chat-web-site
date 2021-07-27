<?php 
    session_start();
    include("connexion.php");
    $rq=$pdo->prepare("select * from chat where((transmiter=? and receiver=?) or (transmiter=? and receiver=?)) ;");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_COOKIE["receiver"],md5($_SESSION["user_id"])));
    $messages= $rq->fetchAll();
    foreach($messages as $message){
        if ($message["receiver"]==$_COOKIE["receiver"]){
            echo "<div class='from_me'>".$message["message"]."</div>";
        }
        else{
            echo "<div class='from_him'>".$message["message"]."</div>";
        }
    }
    
?>