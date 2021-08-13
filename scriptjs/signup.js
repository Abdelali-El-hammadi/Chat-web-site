
document.fo.onsubmit=function(){
    event.preventDefault();
    document.querySelector("#loading").innerHTML="<img src='Icons/loading1.gif' style='width:64px' >";
    errors=Array.from(document.querySelectorAll(".error"));
    errors.forEach(error=>{
        error.style.display="none";
    });
    data= new FormData();
    data.append("first_name",document.fo.first_name.value);
    data.append("last_name",document.fo.last_name.value);
    data.append("email",document.fo.email.value);
    data.append("password",document.fo.password.value);
    data.append("image",document.fo.image.files[0]);
    try{
        xhr=new XMLHttpRequest();
    }
    catch(e){
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.open("POST","scriptphp/signup_script.php",true);
    xhr.send(data);
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            errors_data=JSON.parse(xhr.responseText)
            document.querySelector("#loading").innerHTML="";
            if(errors_data.errors=="yes"){
                // form_errors(errors_data);
            }
            else{
                window.location.href="index.php";
            }
        }
    }
}
function form_errors(error_data){
    errors=Array.from(document.querySelectorAll(".error"));
    errors.forEach(error=>{
        error.style.display="block";
    });
    document.querySelector("#first_name_error").innerText=error_data.first_name;
    document.querySelector("#last_name_error").innerText=error_data.last_name;
    document.querySelector("#email_error").innerText=error_data.email;
    document.querySelector("#password_error").innerText=error_data.password;
    document.querySelector("#image_error").innerText=error_data.image;
}