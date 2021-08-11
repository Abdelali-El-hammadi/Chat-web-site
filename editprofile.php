<?php
    session_start();
    include("scriptphp/connexion.php");
    $rq=$pdo->prepare("select * from account where id=?");
    $rq->setFetchMode(PDO::FETCH_ASSOC);
    $rq->execute(array($_SESSION["user_id"]));
    $user=$rq->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/font.css"\>
    <link rel="stylesheet" href="style/shape.css"\>
    <link rel="stylesheet" href="style/loading.css"\>
    <link rel="stylesheet" href="style/edit_profile.css" >
    <link rel="stylesheet" href="style/media.css">
    <link rel="stylesheet" href="Icons/style.css">
    <script defer src="scriptjs/edit_profile.js"></script>
    <title>Edit Profile</title>
</head>
<body>
    <div id="home" class="bordershape">
        <div id="amidlune" class="bordershape">Amidlune</div>
        <form name="fo" onsubmit="form_submit()" enctype="multipart/form-data">
            <a href="homepage.php" id="return">
                <span class="icon-arrow-left2 icon">
                </span>
            </a>   
            <div id="profile_image" style="background-image:url('profile_images/<?php echo $user[0]["profile_image"]?>')">
                <label for="image">
                    <span class="icon-camera1 icon" id="camera"></span>
                </label>
                <input type="file" id="image" name="image" onchange='get_image()'>
            </div>
            <label id="lb" class="lb">Full name</label>
            <input type="text" name="full_name" id="full_name_field" value="<?php echo $user[0]["fullname"]?>" >
            <input type="submit" value="confirm" class="submit" id="submit">
            <div id="loading"></div>
        </form>
    </div>
    
</body>
</html>