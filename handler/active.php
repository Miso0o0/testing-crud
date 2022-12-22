<?php
if(isset($_GET['code'])){
    require("../connect.php") ;

    $sql=$database->prepare('SELECT * FROM register WHERE TOKEN=:token') ;
    $sql->bindparam("token",$_GET['code']) ;
    $sql->execute() ;
     if($sql->rowcount()>0){
    $mysql=$database->prepare("UPDATE register set ACTIVATED=true ,TOKEN=:newtoken Where TOKEN=:token  ") ;
    $newtoken=md5(date("h:i:s")) ;
    $mysql->bindparam('newtoken',$newtoken) ;
    $mysql->bindparam('token',$_GET['code']) ;
    if($mysql->execute()){
        echo "<h1>تم التحقق من حسابك  بنجاح </h1>" ;
    }


    }else{
        echo "<h1> فشل التحقق من الحساب </h1>" ;
    }




}