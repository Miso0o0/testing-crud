<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Elzero Courses">
    <title>يا مسهل الحال يارب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>


 









<form method='POST' >
Full Name: <input type="text" name=name>
<br>
Username: <input type="text" name=user>
<br>
Age: <input type="date" name=age>
<br>
Email: <input type="email" name=email>
<br>
Password: <input type="password" name=password>
<br>
<button type=submit name=register>Register</button>
<a href="login.php">Login</a>
</form>
<?php
 
$username="root" ;
$password="" ;
$database=new PDO("mysql:host=localhost;dbname=app;charset=utf8;",$username,$password) ;
if(isset($_POST['register'])){
$checkemail=$database->prepare("SELECT * FROM users WHERE EMAIL=:email OR USERNAME=:user" ) ;
$checkemail->bindparam("email",$_POST['email']) ;
$checkemail->bindparam("user",$_POST['user']) ;
$checkemail->execute() ;
if($checkemail->rowcount()>0){
echo "email or user already existed" ;


}else{
$addemail=$database->prepare("INSERT INTO users(NAME,USERNAME,AGE,EMAIL,PASSWORD,TOKEN,ROLE)
VALUES(:name,:username,:age,:email,:password,:TOKEN,'user')") ;
$token=md5(date("h:i:s")) ;
$pass=password_hash (filter_var($_POST['password'],FILTER_SANITIZE_STRING),PASSWORD_DEFAULT) ;
$addemail->bindparam("name",$_POST['name']) ;
$addemail->bindparam("username",$_POST['user']) ;
$addemail->bindparam("age",$_POST['age']) ;
$addemail->bindparam("email",$_POST['email']) ;
$addemail->bindparam("password",$pass) ;
$addemail->bindparam("TOKEN",$token ) ;
if($addemail->execute()){
    echo" REGISERTION DONE   " ;
    // هنا انت بتقووله ابعت الميل وخلي بالك انت عامل ملف تاني اسمه سيند ميل
    require_once "sendemail.php" ;
    $mail->addAddress($_POST['email']);
    $mail->Subject = " Please verify your email ";
    $mail->Body ="<h1>Thank you for registeration in our website</h1>
      <h2>your token is </h2>  <a href='http://localhost/app/active.php?code=$token'> http://localhost/app/active.php?code=$token  </a>" ;
      $mail->setFrom("miso201333@gmail.com","Miso");
      $mail->send();

}else{
    echo "try again" ;
}
}
}

 
 
 





