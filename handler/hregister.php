 <?php
 session_start() ;
 include '../core/functions.php' ;
 include '../core/validations.php' ;
 require("../connect.php") ;
//  هنا عملت ارراي والاراي دي هتخزن الايرورز وهتخزنها ف سيشن
 $errors=[] ;
 if(checkRequestMethod('POST') && checkPostinput('name')){
    foreach($_POST as $key=>$value){
       
        // $key=name=>$value ..... $$key=>$value
      //   انت كل اللي عاوزه تعمل متغير بإسم نيم وايميل وباسورد عشان تطلع منهم القرف اللي بيدخل
      // في الحاله دي 
      // $key=$value ... email=ahmed_ahmed   $$key=$value means that u have made an variable called email $email=$value
        $$key= sanitizeInput($value) ;
       
    }
    //  عموما اي شرط بيقولك لو ..في حاله .لو . دا ترو روح نفذ الشرط ف هنا الفانكشن هيرجعلك ترو معناها شرط .لو. هيتحقق

   $check_email=$database->prepare("SELECT * FROM register Where email= :email ") ;
   $check_email->bindParam("email",$email) ;
   $check_email->execute() ;
   if($check_email->rowCount()>0){
   $errors[]="Email Already registered <a href=login.php>Log In ?</a>"  ;
   }else{  

  if(requiredVal($name)){
    $errors[]= "name is required"  ;
 }elseif(minVal($name,3)){
    $errors[]="name must be greater than 3 chars" ;

 }elseif(maxVal($name,15)){
    $errors[]="name must be less than 15 chars" ;

 }
    if(requiredVal($email)){
      $errors[]="email is required" ;
   }
elseif(!emailVal($email)){
   $errors=["please enter a valid email"] ;
}

if(requiredVal($password)){
   $errors[]= "password is required"  ;
}elseif(minVal($password,6)){
   $errors[]="password must be greater than 6 chars" ;

} 
} 
 

 if(empty($errors)){
   $password=password_hash($password,PASSWORD_DEFAULT) ;
   $register=$database->prepare("INSERT INTO register(name,email,password,TOKEN) VALUES (:name,:email,:password,:token)") ;
   $register->bindparam("name",$name) ;
   $register->bindparam("email",$email) ;
   $register->bindparam("password",$password) ;
   $token=md5(date("h:i:s")) ;
   $register->bindparam("token",$token ) ;

   if($register->execute()){
      echo "Registered Successfully Please Verify your email" ;
      require_once "sendemail.php" ;
      $mail->addAddress($email);
      $mail->Subject = " Please verify your email ";
      $mail->Body ="<h1>Thank you for registeration in our website</h1>
      <h2>your token is </h2>  <a href='http://localhost/app3/handler/active.php?code=$token'> http://localhost/app/active.php?code=$token  </a>" ;
      $mail->setFrom("miso201333@gmail.com","Miso");
      $mail->send();

   }
    



  }else{
    $_SESSION['errors']=$errors ;
    redirect("../register.php") ;
    die() ;
 }

}else{
    echo "not supported method" ;
}


 
?>
 
 