<title>Doctors appointment system | Login</title>
<?php require 'header.php'; ?>

<!-- ======= Hero ======= -->
<section id="hero" class="bg-white p-5" style="margin-top: 100px;">
  <div class="row d-flex justify-content-center">
    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
      <div class="login-box">
        <div class="card card-outline card-primary ">
          <div class="card-header text-center">
            <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->
            <a href="login.php" class="h4">
              <img src="images/logo.jpg" alt="logo" class="img-fluid img-circle shadow-sm" width="110" height="110" style="border-radius: 50%;">
            </a>
          </div>
          <div class="card-body">
            <p class="text-center">Sign in to start your session</p>
            <form action="processes.php" method="post">
             <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="user_type">User Role</label>
                </div>
                <select class="custom-select form-control form-select" id="user_type" name="user_type" required>
                  <option value="" selected disabled>Select user role</option>
                  <option value="0">Patient</option>
                  <option value="1">Secretary</option>
                  <option value="2">Doctor</option>
                  <option value="3">Administrator</option>
                </select>
              </div>

              <div class="input-group" style="display: flex; align-items: stretch;">
                <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" onkeydown="validation()" onkeyup="validation()">
                <div class="input-group-append">
                  <div class="input-group-text" style="height: 100%;">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>

              <!-- FOR INVALID EMAIL -->
              <div class="input-group mb-3">
                <small id="text" style="font-style: italic;"></small>
              </div>
              <div class="input-group mb-3" style="display: flex; align-items: stretch;">
                <input type="password" class="form-control" placeholder="Enter your password" id="password" name="password" minlength="8" required>
                <div class="input-group-append">
                  <div class="input-group-text" style="height: 100%;">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" onclick="showPassword()">
                    <label for="remember">
                      Show password
                    </label>
                  </div>
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary ml-auto" name="login" id="submit_button">Sign In</button>
                </div>
              </div>
            </form>
            <!-- <div class="social-auth-links text-center mt-2 mb-3">
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
              </a>
            </div> -->
            <p class="mb-1">
              <a class="text-primary" href="forgot-password.php">Forgot password?</a>
            </p>
            <p class="mdsb-0">
              No account? <a href="register.php" class="text-center text-primary">Register here!</a>
            </p>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ======= End Hero ======= -->



<?php require 'footer.php'; ?>

