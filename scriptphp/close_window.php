<?php
    session_start();
    include("connexion.php");
    $rq=$pdo->prepare("update account set fullname=? where (id=?);");
    $rq->execute(array("khraj t9wd",$_SESSION["user_id"])); 
?>