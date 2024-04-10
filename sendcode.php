<title>Doctors appointment system | Send verification code</title>
<?php require 'header.php'; ?>
<br>
<br>

<!-- ======= Hero ======= -->
<section id="hero" class="bg-light">
  <div class="row d-flex justify-content-center m-5">
    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
      <div class="login-box d-block m-auto">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="#" class="h1"><b>Reset </b>Password</a>
          </div>
          <div class="card-body">
            <?php
            if(isset($_GET['user_Id'])) {
            $user_Id = $_GET['user_Id'];
            $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id='$user_Id'");
            $row = mysqli_fetch_array($fetch);
            ?>
            <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
            <form action="processes.php" method="POST">
              <input type="hidden" class="form-control mb-3" name="email" value="<?php echo $row['email']; ?>">
              <input type="hidden" class="form-control mb-3" name="user_Id" value="<?php echo $user_Id; ?>">
              <div class="row">
                <div class="col-md-12">
                  <div class="input-group mb-3">
                    <img src="images-users/<?php echo $row['image']; ?>" alt="" style="width: 60px;height: 60px; border-radius: 50%; display: block;margin-left: auto;margin-right: auto;margin-bottom: -12px;">
                  </div>
                  <p class="text-center mb-4"><?php echo ' '.$row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix'].' '; ?></p>
                </div>
                
                <div class="col-md-12">
                  <div class="input-group">
                    <p>Send code via email?</p>
                  </div>
                </div>
                <div class="col-md-12" style="margin-top: -18px;">
                  <div class="input-group">
                    <p><b><?php echo $row['email']; ?></b></p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block"  name="sendcode">Continue</button>
                  <p class="mt-1"><a href="forgot-password.php" class="text-center text-primary">Not you?</a></p>
                </div>
              </div>
            </form>
            <?php } else { require_once '404.php'; } ?>
          </div>
        </div>
      </div>

    </div>
  </div>

</section>

<!-- ======= End Hero ======= -->
<?php require 'footer.php'; ?>