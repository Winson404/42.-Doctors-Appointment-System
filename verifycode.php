<title>Doctors appointment system | Code verification</title>
<?php require 'header.php'; ?>
<!-- ======= Hero ======= -->
<section id="hero" class="bg-light">
  <div class="row d-flex justify-content-center m-5">
    <div class="col-4 m-5">
      <div class="login-box d-block m-auto">
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="#" class="h1"><b>Enter your </b>Code</a>
          </div>
          <div class="card-body">
            <?php
            if(isset($_GET['user_Id']) && isset($_GET['email'])) {
            $user_Id = $_GET['user_Id'];
            $email   = $_GET['email'];
            ?>
            <p class="login-box-msg">Please check your email for a message with your code. Your code is 6 numbers long.</p>
            <form action="processes.php" method="POST">
              <input type="hidden" class="form-control mb-3" value="<?php echo $user_Id; ?>" name="user_Id">
              <input type="hidden" class="form-control mb-3" value="<?php echo $email; ?>" name="email">
              <div class="input-group mb-3">
                <input type="number" class="form-control" placeholder="Enter verification code" name="code" minlength="6" maxlength="6" required>
              </div>
              <div class="input-group">
                <p>We sent your code to: <b><?php echo $email; ?></b></p>
              </div>
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block"  name="verify_code">Continue</button> <br>
                  <a class="text-primary" href="sendcode.php?user_Id=<?php echo $user_Id; ?>">Didn't get a code?</a>
                </div>
              </div>
            </form>
            <p>
              <a class="text-primary" href="login.php">Login</a>
            </p>
            <?php } else { require_once '404.php'; } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ======= End Hero ======= -->
<?php require 'footer.php'; ?>