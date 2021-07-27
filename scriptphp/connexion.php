<?php
    try{
        $pdo=new PDO("mysql:hostname=localhost;dbname=chatapp","root","");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>