<?php include 'inc/header.php' ; ?>
<?php include 'inc/nav.php' ; ?>
<?php
  include 'core/functions.php' ;
 include 'core/validations.php' ;
 require("connect.php") ;
 ?>


<form method="POST">
   Please Type Your Email: <input type="text" name=email>
    <button type='submit' name="reset">reset</button>
</form>


<?php
$errors=[] ;





if(isset($_POST['reset'])){
    $new_email=sanitizeInput($_POST['email']) ;
    if(requiredVal($_POST['email'])){
        $errors[]="please type your email" ;
    
    }elseif(!emailVal($_POST['email'])){
        $errors[]='not a valid email' ;
    }
    $find=$database->prepare("SELECT * FROM register WHERE email=:email") ;
    $find->bindparam("email",$new_email) ;
    $find->execute() ;
    $reset=$find->fetchObject() ;
    if($find->rowCount()==1){
        echo "an email is sent to your email check it please" ;
      require_once "handler/sendemail.php" ;
      $mail->addAddress($new_email);
      $mail->Subject = " Reset Password ";
      $mail->Body ="<h1>Reset yor password</h1>
      <h2>Click here to update your password </h2>  <a href='http://localhost/app3/handler/hreset.php?email=$new_email&code=$reset->TOKEN'>http://localhost/app3/handler/hreset.php?email=$new_email & code=$reset->TOKEN  </a>" ;
      $mail->setFrom("miso201333@gmail.com","Miso");
      $mail->send();
    }else{
      echo  "failed" ;
    }
    $_SESSION['RESET']=$errors ;

}

?>
<?php if(isset($_SESSION['RESET'])) : ?>
    <?php
      foreach($_SESSION['RESET'] as $error) : ?> 
     <div class="alert alert-danger" role="alert">
             <?php echo $error ?> 
         </div>

     <?php
      endforeach ;
         endif;
     unset($_SESSION['RESET']) ;
     ?>