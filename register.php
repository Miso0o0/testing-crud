
  
<?php include('inc/header.php') ; ?>

<?php include('inc/nav.php') ; ?>


<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>
              <!-- مش هدخل ف الشرط دا غير وانا شايف قدامي ايرور  -->
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

              <form  action="handler/hregister.php" method="POST">

                <div class="form-outline mb-4">
                  <input name="name" type="text" id="form3Example1cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div class="form-outline mb-4">
                  <input name="email" type="text" id="form3Example3cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example3cg">Your Email</label>
                </div>

                <div class="form-outline mb-4">
                  <input name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example4cg">Password</label>
                </div>

                 

                 

                <button type="submit" class="btn btn-success btn-lg mb-1">Submit</button>


                <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="#!"
                    class="fw-bold text-body"><u>Login here</u></a></p>

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>










 <?php include('inc/footer.php') ; ?>



  