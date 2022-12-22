<?php  include('inc/header.php');   
 
?>

    <div class="container">
        <div class="row">
            <div class="col-12 ">
                <h1 class="text-center display-4 border my-5 p-2"> Login</h1>
            </div>
            <div class="col-sm-6 mx-auto">
                <div class="border p-5 my-3">
                    
                <?php if(isset($_SESSION['errors'])) : ?>
               <?php
                  foreach($_SESSION['errors'] as $error) : ?> 
                <div class="alert alert-danger" role="alert">
                        <?php echo $error ?> 
                    </div>
 
                <?php
                 endforeach ;
                    endif;
                unset($_SESSION['errors']) ;
                ?>
                <?php if(isset($_SESSION['wrong'])) : ?>
                    <?php
                       foreach($_SESSION['wrong'] as $wrong) : ?> 
                     <div class="alert alert-danger" role="alert">
                             <?php echo $wrong ?> 
                         </div>
      
                     <?php
                      endforeach ;
                         endif;
                     unset($_SESSION['wrong']) ;
                ?>
                    <form action="handler/hlogin.php" method=POST>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Your Password">
                        </div>
                        <div class="form-group">
                            <input type="submit" name=submit class="btn btn-block btn-primary"  value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php  include('inc/footer.php');  ?> 
