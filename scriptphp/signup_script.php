<?php
    $validsign=true;
    $image_error="";
    foreach($_POST as $key => $value){
        @${$key}=$value;
        ${$key."_error"}="";
    }
    foreach($_POST as $key=>$value){
        if(empty($value)){
            ${$key."_error"}="Empty field";
            $validsign=false;
        }
        switch($key){
            case "email":{
                if(!preg_match("#^.+@.+\..+$#",$value) && $value!=""){
                    $email_error="Invalid email";
                    $validsign=false;
                }
                else{
                    include("connexion.php");
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
        include("connexion.php");
        include("compress_image.php");
        $rq=$pdo->prepare("insert into account(fullname,email,password,profile_image,status,creation) values(?,?,?,?,?,now());");
        $rq->execute(array($first_name." ".$last_name,$email,md5($password),$_FILES["image"]["name"],0));
        compress_image($_FILES["image"]["tmp_name"],"../profile_images/".$_FILES["image"]["name"],70);
        echo '{"errors":"none"}';
    }
    else{
        echo '{"first_name":"'.$first_name_error.'","last_name":"'.$last_name_error.'","email":"'.$email_error.'","password":"'.$password_error.'","image":"'.$image_error.'","errors":"yes"}';
    }    
?>