<?php
    session_start();
    $exist=false;
    setcookie("receiver",$_GET["id"],time()+3600);
    include("scriptphp/connexion.php");
    $rq =$pdo->prepare("select * from account where(md5(id)=?) limit 1;");
    $rq->setFetchMode(PDO::FETCH_ASSOC);
    $rq->execute(array($_GET["id"]));
    $user=$rq->fetchAll();
    if(!sizeof($user)){
        header("location:homepage.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/chat.css">
    <link rel="stylesheet" href="style/font.css">
    <link rel="stylesheet" href="style/shape.css">
    <link rel="stylesheet" href="style/media.css">
    <script defer src="scriptjs/chat.js"></script>
    <title>Chat</title>
</head>
<body onload='setchat_firsttime()'>
    <div id="home" class="bordershape">
        <div id="top_bare" class="bordershape">
            <a href="homepage.php">
                <img id="arrow" src="assets/arrow.png">
            </a>
            <div id="user_image" style="background-image:url(<?php echo "profile_images/".$user[0]["profile_image"]?>)"></div>
            <div id="fullname_status">
                <div id="full_name"><?php echo $user[0]["fullname"]?></div>
                <?php if($user[0]["status"]){ ?>
                        <div class="status green">Active now</div>
                    <?php }
                    else{ ?>
                        <div class="status grey">Offline</div>
                    <?php } ?>
            </div>
        </div>
        <div id="chat">   
        </div>
        <div id="bottom_bar">
            <div id="input_msg">
                <input id="input" type="text" name="input">
                <img id="send" src="assets/send.png" onclick="send()">
            </div>
        </div>
    </div>
    
</body>
</html>