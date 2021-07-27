<?php
    session_start();
    if(@$_SESSION["connected"]=="yes"){
        header("location:homepage.php");
    }
    else{
        foreach($_POST as $key => $value){
            @${$key}=$value;
            ${$key."_error"}="";
        }
        $emailexist=false;
        include("scriptphp/error.php");
        if(isset($submit)){
            if(empty($email)){
                $email_error="Empty field";
            }
            else{
                include("scriptphp/connexion.php");
                $rq=$pdo->prepare("select id,email,password from account where(email=?) limit 1");
                $rq->setFetchMode(PDO::FETCH_ASSOC);
                $rq->execute(array($email));
                $account =$rq->fetchAll();
                if(sizeof($account)){
                    if(md5($password)==$account[0]["password"]){
                        $_SESSION['connected']="yes";
                        $_SESSION['user_id']=$account[0]["id"];
                        $u=$pdo->prepare("update account set status=? where(id=?)");
                        $u->execute(array(true,$account[0]["id"]));
                        header("location:homepage.php");
                    }
                    else{
                        $password_error="Incorrect password";
                    }
                }
                else{
                    $email_error="This email doesn't exist";
                }
            }
            if(empty($password)){
                $password_error="Empty field";
            }
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
            <label for="email" class="lb">Email</label>
            <input type="text" name="email" class="input" placeholder="Enter your email" value=<?php echo @$email ?>>
            <?php error(@$email_error) ?>
            <label for="password" class="lb">Password</label>
            <div id="password_container">
                <input  id="pass" type="password" name="password" class="input" placeholder="Enter your password" value=<?php echo @$password ?>>
                <img  id="hide" src="assets/private.png" onclick="hidepassword()" >
            </div>
            <?php error(@$password_error)?>
            <input type="submit" name="submit" value="Sign up" class="submit" value=<?php echo @$password ?>>
        </div>
    </form>
    <div class="already">You need an account? 
        <a class="signup" href="signup.php">Sign up</a>
    </div>
    
</body>
</html>