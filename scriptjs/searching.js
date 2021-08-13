
searching=false;


try{
    xhr= new XMLHttpRequest()}
catch(e){
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
document.body.onload=list_users(0);
document.querySelector("#loupe").onclick=function(){
    search_bar=document.querySelector("#search_bar");
    select_user = document.querySelector("#select_user");
    loupe = document.querySelector("#loupe");
    if(!searching){
        loupe.setAttribute("class","icon-close");
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
        loupe.setAttribute("class","icon-search");
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

function list_users(last_time){
   if(!searching){
        xhr.open("POST","scriptphp/list_users.php",true);
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("last_time="+last_time);
        xhr.onload=function(){
            date=new Date();
            last_time=date.getTime();
            users=JSON.parse(xhr.responseText);
            setTimeout("list_users("+last_time+")",100);
            // users=JSON.parse(xhr.responseText);
            // users.forEach(user=>{
            //     image="profile_images/"+user.profile_image;
            //     document.querySelector("#users").insertAdjacentHTML("beforeend",
            //         set_user(user));      
            // });
            console.log(xhr.responseText);
        }
   }
}
function set_user(user){
    return "<a href='chat.php?id="+user.id+"' class='user'>"
                +"<div class='user_image' style='background-image:url("+image+")'></div>"   
                +"<div class='username_lastm'>"
                    +"<div class='user_fullname'>"+user.fullname+"</div>"
                    // +"<div id='"+user.id+"last_message' class='user_lastmessage'>"+user.last_message+"</div>"
                +"</div>"
                +"<div id='"+user.id+"status' class='user_status "+(user.status=='1'?'green':'grey')+"'></div>"
            +"</a>";
}