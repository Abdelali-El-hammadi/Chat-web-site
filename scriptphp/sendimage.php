<?php
    session_start();
    include("compress_image.php");
    compress_image($_FILES["image"]["tmp_name"],"../message_images/".$_FILES["image"]["name"],70);
    move_uploaded_file($_FILES["image"]["tmp_name"],"../message_images/".$_FILES["image"]["name"]);
    include("connexion.php");
    include("getdate.php");
    $rq=$pdo->prepare("insert into chat(transmiter,receiver,message,type,time_message) values(?,?,?,?,?)");
    $rq->execute(array(md5($_SESSION["user_id"]),$_COOKIE["receiver"],"message_images/".$_FILES["image"]["name"],"image",time()));
    // echo "<div class='message margin_left'>
    // <div class='date'>".get_date(time())."</div>
    // <img class='image_from_me image' loading='lazy' onclick='click_image()' src='message_images/".$_FILES["image"]["name"]."' />
    // </div>";
    echo '{"src":"message_images/'.$_FILES["image"]["name"].'",
            "date":"'.get_date(time()).'"}';
?>