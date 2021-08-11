<?php
    session_start();
    include("connexion.php");
    include("compress_image.php");
    if(isset($_POST["new_image"])){
        unlink("../profile_images/".$profile_image[0]["profile_image"]);
        compress_image($_FILES["image"]["tmp_name"],"../profile_images/".$_FILES["image"]["name"],70);
        $rq=$pdo->prepare("select profile_image from account where(id=?)");
        $rq->setFetchMode(PDO::FETCH_ASSOC);
        $rq->execute(array($_SESSION["user_id"]));
        $profile_image=$rq->fetchAll();
        $rq=$pdo->prepare("update account set fullname=?,profile_image=? where(id=?);");
        $rq->execute(array($_POST["name"],$_FILES["image"]["name"],$_SESSION["user_id"]));
    }
    else{
        $rq=$pdo->prepare("update account set fullname=? where (id=?);");
        $rq->execute(array($_POST["name"],$_SESSION["user_id"])); 
    }

?>