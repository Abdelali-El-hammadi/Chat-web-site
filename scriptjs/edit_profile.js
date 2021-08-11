try{
    xhr=new XMLHttpRequest();
}
catch(e){
    xhr=new ActiveXObject("Microsoft.XMLHTTP");
}

function get_image(){
    file=document.querySelector("#image").files[0];
    reader=new FileReader();
    reader.onload=function(){
            document.querySelector("#profile_image").style.backgroundImage="url("+reader.result+")";
        }        
    reader.readAsDataURL(file);
}
error_input=false;
error_image=false;
function form_submit(){
    notvalidsubmit=false;
    form_submited=true;
    event.preventDefault();
    document.querySelector("#loading").innerHTML="<img src='Icons/loading1.gif' style='width:64px' >";
    data= new FormData();
    image=document.querySelector("#image").files[0];
    input=document.querySelector("#full_name_field");
    regexp=new RegExp("\.(jpe?g)$|(png)$");
    if(input.value==""){
        notvalidsubmit=true;
        if(!error_input){
            error_input=true;
            error=document.createElement("div");
            error.classList.add("error");
            error.classList.add("error_field");
            error.setAttribute("id","error_input");
            error.innerText="Empty field";
            document.fo.insertBefore(error,document.fo.submit);
        }
    }
    else{
        if(error_input){
            document.querySelector("#error_input").remove();
            error_input=false;
        }
    }
    if(image!=null && !regexp.test(image.name)){
        notvalidsubmit=true;
        if(!error_image){
            error_image=true;
            error=document.createElement("div");
            error.classList.add("error");
            error.setAttribute("id","error_image");
            error.innerText="Invalid image";
            document.fo.insertBefore(error,document.querySelector("#lb"));
        }
    }
    else{
        if(error_image){
            document.querySelector("#error_image").remove();
            error_image=false;
        }
    }
    if(!notvalidsubmit){
        xhr.open("post","scriptphp/editprofile.php",true);
        data.append("name",input.value);
        if(image!=null){
            data.append("new_image",true);
            data.append("image",image);
        }
        xhr.send(data);
        xhr.onreadystatechange=function(){
            if(xhr.status==200 && xhr.readyState==4){
                window.location.src="homepage.php";
            }
        }
    }
    
}