
  
<?php include('inc/header.php') ; ?>
<?php if(!isset($_SESSION['auth'])){
    header('location:login.php') ;
}

    ?>

<?php include('inc/nav.php') ; ?>


<h1>PROFILE PAGE</h1>
<?php include('inc/footer.php') ; ?>



  