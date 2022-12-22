<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Elzero Courses">
    <title>يا مسهل الحال يارب</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>

<form action="" method='POST'>
Email : <input type="email" name=email>
Password : <input type="password" name=password>
<a href=reset.php>Reset Password</a>
<br><br>
<button type=submit name=login>Login</button>
<a href=register.php>Register</a>

</form>

<?php
if(isset($_POST['login'])){
    $username="root" ;
    $password="" ;
    $database=new PDO("mysql:host=localhost;dbname=app;charset=utf8;",$username,$password) ;
    $sql=$database->prepare("SELECT * FROM users WHERE EMAIL=:email AND PASSWORD=:password") ;
    $sql->bindparam("email",$_POST['email']) ;
    $passhash=md5($_POST['password']) ;
    $sql->bindparam("password",$passhash) ;
    $sql->execute() ;
    if($sql->rowcount()===1){
        $user=$sql->fetchObject() ;
        if($user->ACTIVATED==1){
            echo "<h1> hello $user->NAME </h1>" ;
            session_start() ;
            $_SESSION['user']=$user ;
            if($user->ROLE==="user"){
                header("location:user/index.php",true) ;
            }elseif($user->ROLE==="admin"){
                header("location:admin/index.php" ,true) ;
            }elseif($user->ROLE==="super-admin"){
            header("location:super-admin/index.php" ,true) ;
            }
        }else{
            echo "<h1> you can't log in Please verify your email</h1>" ;
        }

    }else{
        echo "<h1>Wrong email or password</h1>" ;
    }
}
 