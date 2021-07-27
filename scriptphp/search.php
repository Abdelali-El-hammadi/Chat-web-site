<?php
    session_start();
    include("connexion.php");
    include("lastmessage.php");
    if(@$_GET["search"]!=""){
        $rq=$pdo->prepare("select * from account where(id!=? and fullname like ?);");
        $rq->execute(array($_SESSION["user_id"],$_GET["search"]."%"));
        $users=$rq->fetchAll();
        if(!sizeof($users)){
            echo "<div id='does'>There is no account has this name</div>";
            exit();
        }
    }
    else{
        $rq=$pdo->prepare("select * from account where(id!=?);");
        $rq->execute(array($_SESSION["user_id"]));
        $users=$rq->fetchAll();
    }
    foreach($users as $user){
        $str="profile_images/".$user["profile_image"];
        $id=md5($user["id"]);
        echo "<a href='chat.php?id=$id'class='user'>
        <div class='user_image' style='background-image:url($str) '></div>
        <div class='username_lastm'>
            <div class='user_fullname'>".$user["fullname"]."</div>
            <div class='user_lastmessage'>".last_message(md5($user["id"]),$pdo)."</div>
        </div>";
        if ($user["status"]){
            echo "<div class='user_status green'></div>";
        }
        else{
            echo "<div class='user_status grey'></div>";
        }
        echo "</a>";
    }
?>