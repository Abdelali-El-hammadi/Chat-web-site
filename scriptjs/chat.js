function create_xml_object(){
    try{
         xhr= new XMLHttpRequest();
    }
    catch(e){
        xhr= new ActiveXObject("Microsoft.XMLHTTP");
    }
}
function send(){
    create_xml_object();
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

function updatechat(){
    create_xml_object();
    // setTimeout("updatechat()",1000);
    chat = document.querySelector("#chat");
    xhr.open("POST","scriptphp/updatechat.php",true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhr.send();
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200){
            chat.innerHTML=xhr.responseText;
            chat.scrollTo(0,chat.scrollHeight);      
            document.querySelector("#loading").innerHTML="";
        }
        else{
            document.querySelector("#loading").innerHTML="<img src='Icons/loading1.gif' style='width:64px' >";
        }
    }
}

function get_image(){
    create_xml_object();
    var id_progress=Math.round(3000*Math.random());
    var id_fill_progress=id_progress+1;
    var id_image=id_progress+2;
    var id_message=id_progress+3;
    var id_date=id_progress+4;
    chat=document.querySelector("#chat");
    image = event.currentTarget.files[0];
    regexp=new RegExp("\.(jpe?g)$|(png)$|(JPG)$");
    if(regexp.test(image.name)){
        reader=new FileReader();
        reader.readAsDataURL(image);
        reader.onload=function(){
            chat.innerHTML+="<div id='"+id_message+"message' class='message margin_left'><div id='"+id_date+"date' class='date'></div><div class='loading_image'><img id='"+id_image+"image' class='image_from_me image full_width blur' loading='lazy' onclick='click_image()' src='"+reader.result+"'/><div id='"+id_progress+"progress' class='progress'><div id='"+id_fill_progress+"fill' class='progress_fill'></div></div></div></div>";
        }
        data=new FormData();
        data.append("image",image);
        xhr.open("POST","scriptphp/sendimage.php",true);
        xhr.upload.onprogress=function(e){
            if(e.lengthComputable){
                id=id_fill_progress+"fill";
                console.log(Math.round((e.loaded/e.total)*100)+"%");
                document.getElementById(id).style.width=Math.round((e.loaded/e.total)*100)+"%";
            }
            else{
                document.querySelector("#"+id_progress+"fill").style.width=0+"%";
            }
        }
        xhr.send(data);
        xhr.onload=function(){
            data=JSON.parse(xhr.responseText);
            document.getElementById(id_progress+"progress").remove();
            document.getElementById(id_image+"image").src=data.src;
            document.getElementById(id_image+"image").classList.remove("blur");
            document.getElementById(id_date+"date").innerHTML=data.date;
        }
    }
    else{
        document.querySelector("#invalid_image").style.display="block";
        setTimeout("document.querySelector('#invalid_image').style.display='none';",1500);
    }
}
h=0;
function click_image(){
    chat=document.querySelector("#chat");
    h=chat.scrollTop;
    document.body.innerHTML+="<div id='container_image'><img src='"+event.currentTarget.getAttribute('src')+"' height='90%'><span id='close' onclick='close_image()' class='icon-close'></span></div>";
}
function close_image(){
    chat=document.querySelector("#chat");
    document.body.removeChild(document.querySelector("#container_image"));
    chat.scrollTo(0,h);
}
