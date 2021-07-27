<?php
    session_start();
    include("connexion.php");
    include("lastmessage.php");
    $rq=$pdo->prepare("select * from account where(id!=?);");
    $rq->execute(array($_SESSION["user_id"]));
    $users=$rq->fetchAll();
    foreach($users as $user){
        $image="profile_images/".$user["profile_image"];
        echo "<a href='chat.php?id=".md5($user["id"])."' class='user'>
            <div class='user_image' style='background-image:url($image)'></div>
            <div class='username_lastm'>
                <div class='user_fullname'>".$user["fullname"]."</div>
                <div class='user_lastmessage'>".last_message(md5($user['id']),$pdo)."</div>
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