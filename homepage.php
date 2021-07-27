<?php
    session_start();
    include("scriptphp/connexion.php");
    $rq=$pdo->prepare("select fullname,profile_image from account where(id=?) limit 1;");
    $rq->setFetchMode(PDO::FETCH_ASSOC);
    $rq->execute(array($_SESSION["user_id"]));
    $profile=$rq->fetchAll();
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
    <script defer src="scriptjs/searching.js"></script>
    <title>Home</title>
</head>
<body onload="list_users()">
    <div id="home" class="bordershape">
        <div id="amidlune" class="bordershape">Amidlune</div>
        <div id="profile">
            <div id="profile_image" style="background-image:url('<?php echo "profile_images/".$profile[0]["profile_image"] ?>')"></div>
            <div id="fullname_status">
                <div id="full_name"><?php echo $profile[0]["fullname"] ?></div>
                <div id="status">Active now</div>
            </div>
            <a id="logout" href="scriptphp/deconnexion.php" >Log out</a>
        </div>
        <div id="search_bar">
            <div id="select_user">Select an user to chat with</div>
            <img id="loupe" src="assets/loupe.png" >
        </div>
        <div id="users">
        
        </div>
    </div>
    
</body>
</html>