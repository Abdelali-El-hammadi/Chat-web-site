<?php
    session_start();
    move_uploaded_file($_FILES["image"]["tmp_name"],"../message_images/".$_FILES["image"]["name"]);
    include("connexion.php");
    $rq=$pdo->prepare("insert into chat(transmiter,receiver,time_message,message,type) values(?,?,now(),?,?)");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],"message_images/".$_FILES["image"]["name"],"image"));
    echo "<img class='image_from_me' src='message_images/".$_FILES["image"]["name"]."' />";
?>