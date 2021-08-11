<?php
    include("scriptphp/error.php");
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
    <link rel="stylesheet" href="Icons/style.css" >
    <link rel="stylesheet" href="style/loading.css" >
    <script defer src="scriptjs/hidepassword.js"></script>
    <script defer src="scriptjs/signup.js"></script>
    <title>Sign up</title>
</head>
<body>
    <form name="fo" method="POST" enctype="multipart/form-data" class="bordershape">
        <div id="amidlune" class="bordershape">Amidlune</div>
        <div id="form" name="fo">
            <div id="full_name">
                <div id="f_name">
                    <label for="first_name" class="lb">First Name</label>
                    <input type="text" name="first_name" class="input" placeholder="First name" >
                    <div id="first_name_error" class='error error_field'></div>
                </div>
                <div id="l_name">
                    <label for="last_name" class="lb">Last Name</label>
                    <input type="text" name="last_name" class="input" placeholder="Last name" >
                    <div id="last_name_error" class='error error_field'></div>
                </div>
            </div>
            <label for="email" class="lb">Email</label>
            <input type="text" name="email" class="input" placeholder="Enter your email">
            <div id="email_error" class='error error_field'></div>
            <label for="password" class="lb">Password</label>
            <div id="password_container">
                <input  id="pass" type="password" name="password" class="input" placeholder="Enter your password">
                <span  id="hide" class="icon-eye-blocked" onclick="hidepassword()" ></span>
            </div>
            <div id="password_error" class='error error_field'></div>
            <label for="image" class="lb">Profile Image</label>
            <input type="file" name="image">
            <div id="image_error" class='error error_image'></div>
            <input type="submit" name="submit" value="Sign up" class="submit">
        </div>
        <div id="loading"></div>

    </form>
    <div class="already">You already have an account? 
        <a class="signup" href="index.php">Sign in</a>
    </div>
    
</body>
</html>