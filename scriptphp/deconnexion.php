<?php
    session_start();
    include("connexion.php");
    $rq=$pdo->prepare("update account set status=? where(id=?);");
    $rq->execute(array(false,$_SESSION["user_id"]));
    session_destroy();
    header("location:../index.php");
    exit();
?>