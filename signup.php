<?php
    $validsign=true;
    $image_error="";
    foreach($_POST as $key => $value){
        @${$key}=$value;
        ${$key."_error"}="";
    }
    include("scriptphp/error.php");
    if(isset($submit)){
        foreach($_POST as $key=>$value){
            if($key!="submit"){
                if(empty($value)){
                    ${$key."_error"}="Empty field";
                    $validsign=false;
                }
            }
            switch($key){
                case "email":{
                    if(!preg_match("#^.+@.+\..+$#",$value) && $value!=""){
                        $email_error="Invalid email";
                        $validsign=false;
                    }
                    else{
                        include("scriptphp/connexion.php");
                        $r=$pdo->prepare("select email from account where(email=?) limit 1");
                        $r->setFetchMode(PDO::FETCH_ASSOC);
                        $r->execute(array($email));
                        $tab=$r->fetchAll();
                        if(sizeof($tab)){
                            $email_error="This email is already used";
                            $validsign=false;
                        }
                    }
                    break;
                }
                case "password":{
                    if(strlen($password)<6 && $value!=""){
                        $password_error="The password should contains more than six digits";
                        $validsign=false;
                    }
                    break;
                }
                default:{break;}
            }
        }
        if(empty($_FILES["image"]["name"])){
            $image_error="Empty field";
            $validsign=false;
        }
        elseif(!preg_match("#\.(jpe?g$)|(png$)#",@$_FILES["image"]["name"])){
            $image_error="Invalid image";
            $validsign=false;
        }
        if($validsign){
            include("scriptphp/connexion.php");
            $rq=$pdo->prepare("insert into account(fullname,email,password,profile_image,status,creation) values(?,?,?,?,?,now());");
            $rq->execute(array($first_name." ".$last_name,$email,md5($password),$_FILES["image"]["name"],false));
            move_uploaded_file($_FILES["image"]["tmp_name"],"profile_images/".$_FILES["image"]["name"]);
            header("location:index.php");
        }       
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/font.css" >
    <link rel="stylesheet" href="style/form.css" >
    <link rel="stylesheet" href="style/shape.css" >
    <link rel="stylesheet" href="style/signup.css" >
    <script defer src="scriptjs/hidepassword.js"></script>
    <title>Sign up</title>
</head>
<body>
    <form name="fo" method="POST" enctype="multipart/form-data" class="bordershape">
        <div id="amidlune" class="bordershape">Amidlune</div>
        <div id="form">
            <div id="full_name">
                <div id="f_name">
                    <label for="first_name" class="lb">First Name</label>
                    <input type="text" name="first_name" class="input" placeholder="First name" value=<?php echo @$first_name ?>>
                    <?php error(@$first_name_error)?>
                </div>
                <div id="l_name">
                    <label for="last_name" class="lb">Last Name</label>
                    <input type="text" name="last_name" class="input" placeholder="Last name" value=<?php echo @$last_name ?>>
                    <?php error(@$last_name_error)?>
                </div>
            </div>
            <label for="email" class="lb">Email</label>
            <input type="text" name="email" class="input" placeholder="Enter your email" value=<?php echo @$email ?>>
            <?php error(@$email_error)?>
            <label for="password" class="lb">Password</label>
            <div id="password_container">
                <input  id="pass" type="password" name="password" class="input" placeholder="Enter your password" value=<?php echo @$password ?>>
                <img  id="hide" src="assets/private.png" onclick="hidepassword()" >
            </div>
            <?php error(@$password_error)?>
            <label for="image" class="lb">Profile Image</label>
            <input type="file" name="image">
            <?php error_image(@$image_error)?>
            <input type="submit" name="submit" value="Sign up" class="submit" >
        </div>
    </form>
    <div class="already">You already have an account? 
        <a class="signup" href="index.php">Sign in</a>
    </div>
    
</body>
</html>