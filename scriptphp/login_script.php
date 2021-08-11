<?php
    session_start();
    foreach($_POST as $key => $value){
        @${$key}=$value;
        ${$key."_error"}="";
    }
    $emailexist=false;
    if(empty($password)){
        $password_error="Empty field";
    }
    if(empty($email)){
        $email_error="Empty field";
    }
    else{
        include("connexion.php");
        $rq=$pdo->prepare("select id,email,password from account where(email=?) limit 1");
        $rq->setFetchMode(PDO::FETCH_ASSOC);
        $rq->execute(array($email));
        $account =$rq->fetchAll();
        if(sizeof($account)){
            if(md5($password)==$account[0]["password"]){
                $_SESSION['connected']="yes";
                $_SESSION['user_id']=$account[0]["id"];
                $u=$pdo->prepare("update account set status=? where(id=?)");
                $u->execute(array(1,$account[0]["id"]));
            }
            else{
                $password_error="Incorrect password";
            }
        }
        else{
            $email_error="This email doesn't exist";
        }
    }

    if($password_error=="" && $email_error==""){
        echo '{"errors":"none"}';
    }
    else{
        echo '{"errors":"yes","email":"'.$email_error.'","password":"'.$password_error.'"}';
    }   
    
?>