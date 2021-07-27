<?php
    session_start();
    include("connexion.php");
    $rq=$pdo->prepare("select count(*) as count from chat where((transmiter=? and receiver=?) or (transmiter=? and receiver=?));");
    $rq->setFetchMode(PDO::FETCH_ASSOC);
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],$_COOKIE["receiver"],md5($_SESSION["user_id"])));   
    $count= $rq->fetchAll();
    echo $count[0]["count"];
?>