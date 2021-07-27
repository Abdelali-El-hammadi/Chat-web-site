searching=false;
try{
    xhr= new XMLHttpRequest()}
catch(e){
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}

document.querySelector("#loupe").onclick=function(){
    search_bar=document.querySelector("#search_bar");
    select_user = document.querySelector("#select_user");
    loupe = document.querySelector("#loupe");
    if(!searching){
        loupe.setAttribute("src","assets/x.png");
        select_user.remove();
        input = document.createElement("input");
        input.setAttribute("type","text");
        input.setAttribute("id","select_user");
        input.setAttribute("onkeyup","search()");
        search_bar.appendChild(input);
        input.select();
        searching=true;
    }
    else{
        loupe.setAttribute("src","assets/loupe.png");
        select_user.remove();
        div = document.createElement("div");
        div.innerHTML="Select an user to chat with";
        div.setAttribute("id","select_user");
        search_bar.appendChild(div);
        search();
        searching=false;
    }
}

function search(){
    input=document.querySelector("#select_user");
    if(input.value==null){
        input.value="";
    }
    xhr.open("get","scriptphp/search.php?search="+input.value,true); 
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.status==200 && xhr.readyState==4){
            document.querySelector("#users").innerHTML=xhr.responseText; 
        }
    }
}

function list_users(){
   if(!searching){
        xhr.open("POST","scriptphp/list_users.php",true);
        xhr.send();
        xhr.onload=function(){
            document.querySelector("#users").innerHTML=xhr.responseText;
        }
   }
   setTimeout("list_users()",1000);
}