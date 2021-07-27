try{
    xhr= new XMLHttpRequest();
}
catch(e){
    xhr= new ActiveXObject("Microsoft.XMLHTTP");
}
function send(){
    input=document.querySelector("#input");
    chat = document.querySelector("#chat");
    if(input.value!=""){
        xhr.open("post","scriptphp/sendmessage.php",true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("msg="+input.value);
        xhr.onload=function(){
            document.querySelector("#chat").innerHTML+=xhr.responseText;
            chat.scrollTo(0,chat.scrollHeight);
        }
        input.value="";
    }
}
window.onkeyup=function(){
    if (event.keyCode==13){
        input=document.querySelector("#input");
        if(input.value!=""){
            send();
        }
    }
}
count=0;
new_message=false;
function updatechat(){
    setTimeout("updatechat()",500);
    xhr.open("post","scriptphp/countmessages.php",true);
    xhr.send();
    xhr.onload=function(){
        if(count<parseInt(xhr.responseText)){
            count=parseInt(xhr.responseText);
            new_message=true;
        }
    }
    if(new_message){
            chat = document.querySelector("#chat");
            xhr.open("POST","scriptphp/updatechat.php",true);
            xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.send("count="+parseInt(xhr.responseText));
            xhr.onload=function(){
                chat.innerHTML=xhr.responseText;
                chat.scrollTo(0,chat.scrollHeight);
            }   
            new_message=false;
    }
}
function setchat_firsttime(){
    chat = document.querySelector("#chat");
    xhr.open("POST","scriptphp/chating.php",true);
    xhr.send();
    xhr.onload=function(){
        chat.innerHTML=xhr.responseText;
        chat.scrollTo(0,chat.scrollHeight);
        updatechat();
    }
}

