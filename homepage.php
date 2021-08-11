<?php
    session_start();
    if($_SESSION["connected"]!="yes"){
        header("location:index.php");
        exit();
    }
    else{
        include("scriptphp/connexion.php");
        $rq=$pdo->prepare("select fullname,profile_image from account where(id=?) limit 1;");
        $rq->setFetchMode(PDO::FETCH_ASSOC);
        $rq->execute(array($_SESSION["user_id"]));
        $profile=$rq->fetchAll();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/font.css"\>
    <link rel="stylesheet" href="style/shape.css"\>
    <link rel="stylesheet" href="style/homepage.css" >
    <link rel="stylesheet" href="style/media.css">
    <link rel="stylesheet" href="Icons/style.css">
    <script defer src="scriptjs/searching.js"></script>
    <title>Home</title>
</head>
<body onload="list_users()">
    <a id="logout" href="scriptphp/deconnexion.php" >Log out</a>
    <div id="home" class="bordershape">
        <div id="amidlune" class="bordershape">Amidlune</div>
        <div id="profile">
            <div id="profile_image" style="background-image:url('<?php echo "profile_images/".$profile[0]["profile_image"] ?>')"></div>
            <div id="fullname_status">
                <div id="full_name"><?php echo $profile[0]["fullname"] ?></div>
                <div id="status">Active now</div>
            </div>
            <a href="editprofile.php" id="edit_profile">
                <span class="icon-cog icon"></span>
            </a>
        </div>
        <div id="search_bar">
            <div id="select_user">Select an user to chat with</div>
            <span id="loupe" class="icon-search icon"></span>
        </div>
        <div id="users">
        
        </div>
    </div>
    
</body>
<script>
    window.onbeforeunload=function(){
        try{
         xhr= new XMLHttpRequest();
        }
        catch(e){
            xhr= new ActiveXObject("Microsoft.XMLHTTP");
        }
        if(window.event.clientY<0){
            xhr.open("post","scriptphp/close_window.php",true);
            xhr.send();
        }
    }
</script>
</html>