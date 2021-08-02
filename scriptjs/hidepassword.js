visible=false;

function hidepassword(){
    input=document.querySelector("#pass");
    img=document.querySelector("#hide");
    if(visible){
        img.setAttribute("class","icon-eye-blocked");
        input.setAttribute("type","password");
        visible=false;
    }
    else{
        img.setAttribute("class","icon-eye");
        input.setAttribute("type","text");
        visible=true;
    }
}