<?php
include('../inc/header.php') ;  
include('../inc/nav.php') ;  
include '../core/functions.php' ;
include '../core/validations.php' ;
require("../connect.php") ;
$error=[] ;
if(isset($_GET['email']) & isset($_GET['code'])){
    $check=$database->prepare("SELECT * FROM register WHERE email=:email AND TOKEN=:token") ;
    $check->bindparam("email" ,$_GET['email']) ;
    $check->bindparam("token" ,$_GET['code']) ;
    $check->execute() ;
    if($check->rowcount()==1){
        echo "<form method=POST>
      Please type your new password  <input type=text name=password>
        <button type=submit name=send>update</button>
        </form>" ;
        if(isset($_POST['send'])){
        $new_password=password_hash(sanitizeInput($_POST['password']),PASSWORD_DEFAULT) ;
        $new_token=md5(date("h:i:s")) ;
        $update=$database->prepare("UPDATE register SET password=:password,TOKEN=:token WHERE email=:email") ;
        $update->bindparam("password",$new_password) ;
        $update->bindparam("email",$_GET['email']) ;
        $update->bindparam("token",$new_token) ;
        if($update->execute()){
            echo "<h1>password updated</h1>" ;
        }
    
        }

         }else{
           $_SESSION['passowrd']=$error ;
                   
                
                  
         }

    }else{
        $error[]= "error 404" ;
    }
  
    ?>

<?php if(isset($_SESSION['passowrd'])) : ?>
               <?php
                 foreach($_SESSION['passowrd'] as $error) : ?> 
                <div class="alert alert-danger" role="alert">
                        <?php echo $error ?> 
                    </div>
 
                <?php
                 endforeach ;
                    endif;
                unset($_SESSION['passowrd']) ;
                ?>