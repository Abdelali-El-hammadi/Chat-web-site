<?php
    session_start();
    include("connexion.php");
    include("lastmessage.php");
    $rq=$pdo->prepare("select md5(id),fullname,profile_image,status,last_modification from account where(id!=? and last_modification>?);");
    $rq->setFetchMode(PDO::FETCH_ASSOC); 
    while(true){
        $rq->execute(array($_SESSION["user_id"],$_POST["last_time"]*1));
        $users=$rq->fetchAll();
        if(sizeof($users)){
            echo json_encode($users);
            break;
        }
        sleep(1);
    }
    // else{
    //     $new_users=array();
    //     while(true){
    //         usleep(500000);
    //         $rq->execute(array($_SESSION["user_id"]));
    //         $new_data=$rq->fetchAll();
    //         if($new_data[0]["fullname"]=="rida"){
    //             echo '{"full":"zho"}';
    //             break;
    //         }   
    //         // if(sizeof($new_data)>sizeof($users)){
    //         //     for($j=sizeof($users);$j<sizeof($new_data);$j++){
    //         //         array_push($users,["id"=>"","fullname"=>"","profile_image"=>"","status"=>""]);
    //         //     }
    //         // }
    //         // for($i=0;$i<sizeof($new_data);$i++){
    //         //     $new_data[$i]["last_message"]=last_message(md5($new_data[$i]["id"]),$pdo);
    //         //     $new_data[$i]["id"]=md5($new_data[$i]["id"]);
    //         //     if(sizeof(array_diff_assoc($new_data[$i],$users[$i]))){
    //         //         array_push($new_users,$new_data[$i]);
    //         //     }
    //         // }
    //         // if(sizeof($new_users)){
    //         //     echo json_encode($new_users);
    //         //     break;
    //         // }  
    //     }
    // }
?>