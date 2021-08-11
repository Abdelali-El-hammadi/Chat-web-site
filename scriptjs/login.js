document.fo.onsubmit=function(){
    event.preventDefault();
    document.querySelector("#loading").innerHTML="<img src='Icons/loading1.gif' style='width:64px' >";
    errors=Array.from(document.querySelectorAll(".error"));
    errors.forEach(error=>{
        error.style.display="none";
    });
    data= new FormData();
    data.append("email",document.fo.email.value);
    data.append("password",document.fo.password.value);
    try{
        xhr=new XMLHttpRequest();
    }
    catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST","scriptphp/login_script.php",true);
    xhr.send(data);
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            error_data=JSON.parse(xhr.responseText);
            document.querySelector("#loading").innerHTML="";
            if(error_data.errors=="yes"){
                form_errors(error_data);
            }
            else{
                window.location.href="homepage.php";
            }
        }

    }
}

function form_errors(error_data){
    errors=Array.from(document.querySelectorAll(".error"));
    errors.forEach(error=>{
        error.style.display="block";
    });
    document.querySelector("#email_error").innerText=error_data.email;
    document.querySelector("#password_error").innerText=error_data.password;
}