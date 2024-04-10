<title>Doctors appointment system | Forgot password</title>
<?php require 'header.php'; ?>

<!-- ======= Hero ======= -->
<section id="hero" class="bg-light">
  <div class="row d-flex justify-content-center m-5">
    <div class="col-4 m-5">
      <div class="login-box d-block m-auto">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Find your </b>ACCOUNT</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
        <form action="processes.php" method="post">
          <div class="input-group">
            <input type="email" class="form-control" placeholder="email@gmail.com" name="email"  id="email" onkeydown="validation()" onkeyup="validation()" required>
          </div>
          <!-- FOR INVALID EMAIL -->
          <div class="input-group mt-1 mb-3">
            <small id="text" style="font-style: italic;"></small>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary"  name="search" id="submit_button">Search</button>
            </div>
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a class="text-primary" href="login.php">Login</a>
        </p>
      </div>
    </div>
  </div>
    </div>
  </div>
</section>
<!-- ======= End Hero ======= -->



<?php require 'footer.php'; ?>

