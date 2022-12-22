 
 
 <?php

 include '../inc/header.php' ;
 include '../inc/nav.php' ;
 include '../core/functions.php' ;
include '../core/validations.php' ;
require("../connect.php") ;
 if(isset($_POST['submit'])){
    foreach($_POST as $key=>$value){
        $$key=sanitizeInput($value) ;
    }
    $errors=[] ;
    $error=[] ;
if(requiredVal($email)){
    $errors[]="Please Type your email" ;
}elseif(!emailVal($email)){
    $errors[]='email not valid' ;
}
if(requiredVal($password)){
    $errors[]='Please type your password' ; 
}
if(empty($errors)){
$user=$database->prepare('SELECT * FROM register WHERE email=:email') ;
$user->bindParam('email',$email) ;
$user->execute() ;
if($user->rowCount()===1){
    $login=$user->fetchObject() ;
    $check=password_verify($password,$login->password) ;
    if($check){
        $_SESSION['name']=$login->name ;
        $_SESSION['email']=$login->email ;
        $_SESSION['password']=$login->password ;
        echo "Hello user" ;

    }else{
        $error[]="Wrong password" ;
        $_SESSION['wrong']=$error ;
        redirect("../login.php") ;
        die() ;
     }

}
}else{
    $_SESSION['errors']=$errors ;
    redirect("../login.php") ;
    die() ;
 
}


}
