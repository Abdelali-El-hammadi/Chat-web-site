visible=false;

function hidepassword(){
    input=document.querySelector("#pass");
    img=document.querySelector("#hide");
    if(visible){
        img.setAttribute("src","assets/private.png");
        input.setAttribute("type","password");
        visible=false;
    }
    else{
        img.setAttribute("src","assets/view.png");
        input.setAttribute("type","text");
        visible=true;
    }
}