<title>Doctors appointment system | Login</title>
<?php require 'header.php'; ?>
<!-- ======= Hero ======= -->
<div class="row d-flex justify-content-center" style="margin-top: 150px;">
  <div class="col-lg-9 col-md-9 col-sm-12 col-12">
    <div class="login-box">
      <div class="card card-outline card-primary ">
        <div class="card-header text-center">
          <a href="../../index2.html" class="h1"><b>Account</b> Registration</a>
        </div>
        <div class="card-body">
          <form action="processes.php" method="post" enctype="multipart/form-data">
            <div class="row">
              <div class="col-lg-12 mt-1 mb-3">
                <a class="h5 text-primary"><b>Basic information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-12 row mb-3">
                <div class="col-lg-4 col-md-4 col-sm 6 col-12">
                  <div class="form-group">
                    <span class="text-dark"><b>User roles</b></span>
                    <select class="custom-select form-control form-select" id="user_type" name="user_type" onchange="handleUserRoleChange()" required>
                      <option value="" selected disabled>Select user role</option>
                      <option value="0">Patient</option>
                      <option value="1">Secretary</option>
                      <option value="2">Doctor</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4 col col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>First name</b></span>
                  <input type="text" class="form-control"  placeholder="First name" name="firstname" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Middle name</b></span>
                  <input type="text" class="form-control"  placeholder="Middle name" name="middlename" onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-3 col col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Last name</b></span>
                  <input type="text" class="form-control"  placeholder="Last name" name="lastname" required onkeyup="lettersOnly(this)">
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Ext/Suffix</b></span>
                  <input type="text" class="form-control"  placeholder="Ext/Suffix" name="suffix">
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Date of Birth</b></span>
                  <input type="date" class="form-control" name="dob" placeholder="Date of birth" required id="birthdate" onchange="calculateAge()" max="<?php echo date('Y-m-d'); ?>">
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Age</b></span>
                  <input type="text" class="form-control bg-white" placeholder="Age" required id="txtage" name="age" readonly>
                </div>
              </div>
              <div class="col-lg-7 col-md-6 col-sm-12 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Place of Birth</b></span>
                  <textarea name="birthplace" id="" cols="30" rows="1" class="form-control" required placeholder="Place of Birth"></textarea>
                </div>
              </div>
              <div class="col-lg-2 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Sex</b></span>
                  <select class="custom-select form-control form-select" name="gender" required>
                    <option selected disabled value="">Select sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Non-Binary">Non-Binary</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Civil Status</b></span>
                  <select class="custom-select form-control form-select" name="civilstatus" required>
                    <option selected disabled value="">Select status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widow/ER">Widow/ER</option>
                    <option value="Separated">Separated</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Profession/ Occupation</b></span>
                  <input type="text" class="form-control"  placeholder="Profession/ Occupation" name="occupation" required>
                </div>
              </div>
              <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Religion</b></span>
                  <select class="custom-select form-control form-select" name="religion" required>
                    <option selected disabled value="">Select religion</option>
                    <option value="Roman Catholic">Roman Catholic</option>
                    <option value="Iglesia Ni Cristo">Iglesia Ni Cristo</option>
                    <option value="Evangelical Christianity">Evangelical Christianity</option>
                    <option value="Islam">Islam</option>
                    <option value="Protestants">Protestants</option>
                    <option value="Seventh-day Adventism">Seventh-day Adventism</option>
                    <option value="Aglipayan">Aglipayan</option>
                    <option value="Bible Baptist Church">Bible Baptist Church</option>
                    <option value="United Church of Christ in the Philippines">United Church of Christ in the Philippines</option>
                    <option value="Jehovah's Witnesses">Jehovah's Witnesses</option>
                    <option value="Buddhist">Buddhist</option>
                    <option value="Methodist">Methodist</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Judaism">Judaism</option>
                    <option value="Ang Dating Daan">Ang Dating Daan</option>
                    <option value="Other Religion">Other Religion</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12 mb-3">
                <a class="h5 text-primary"><b>Contact details</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Email</b></span>
                  <input type="email" class="form-control" placeholder="email@gmail.com" name="email" id="email"  onkeydown="validation()" onkeyup="validation()" required>
                  <small id="text" style="font-style: italic;"></small>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Contact number</b></span>
                  <div class="input-group">
                    <div class="input-group-text">+63</div>
                    <input type="tel" class="form-control" pattern="[7-9]{1}[0-9]{9}" id="contact" name="contact" placeholder = "9123456789" required maxlength="10">
                  </div>
                </div>
              </div>
              
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12 mb-3">
                <a class="h5 text-primary"><b>Complete ddress</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>House No.</b></span>
                  <input type="text" class="form-control"  placeholder="House No." name="house_no">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Street name</b></span>
                  <input type="text" class="form-control"  placeholder="Street name" name="street_name">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Sitio/Purok</b></span>
                  <input type="text" class="form-control"  placeholder="Sitio/Purok" name="purok">
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Zone</b></span>
                  <input type="text" class="form-control"  placeholder="Zone" name="zone">
                </div>
              </div>
              <div class="col-lg-8 col-md-6 col-sm-12 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Barangay</b></span>
                  <input type="text" class="form-control"  placeholder="Barangay" name="barangay" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Municipality</b></span>
                  <input type="text" class="form-control"  placeholder="Municipality" name="municipality" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Province</b></span>
                  <input type="text" class="form-control"  placeholder="Province" name="province" required>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Region</b></span>
                  <input type="text" class="form-control"  placeholder="Region" name="region" required>
                </div>
              </div>
              <div class="col-lg-12 mt-3 mb-2 col-md-12 col-sm-12 col-12 mb-3">
                <a class="h5 text-primary"><b>Account password</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Password</b></span>
                  <div class="input-group" style="display: flex; align-items: stretch;">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password" minlength="8">
                    <div class="input-group-append">
                      <span class="input-group-text" id="eye-toggle-password" onclick="togglePasswordVisibility('password')" style="height: 100%;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </span>
                    </div>
                  </div>
                  <span id="password-message" class="text-bold" style="font-style: italic; font-size: 12px; color: #e60000;"></span>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>Confirm password</b></span>
                  <div class="input-group" style="display: flex; align-items: stretch;">
                    <input type="password" class="form-control" name="cpassword" placeholder="Retype password" id="cpassword" onkeyup="validate_confirm_password()" required minlength="8">
                    <div class="input-group-append" >
                      <span class="input-group-text" id="eye-toggle-cpassword" onclick="togglePasswordVisibility('cpassword')" style="height: 100%;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </span>
                    </div>
                  </div>
                  <small id="wrong_pass_alert" class="text-bold" style="font-style: italic; font-size: 12px;"></small>
                </div>
              </div>
              <div class="col-lg-12 mt-3 mb-2">
                <a class="h5 text-primary"><b>Additional information</b></a>
                <div class="dropdown-divider"></div>
              </div>
              <div class="col-lg-6 col col-md-6 col-sm-6 col-12 mb-3" id="specializationField" style="display:none;">
                <div class="form-group">
                  <span class="text-dark"><b>Specialization</b></span>
                  <input type="text" class="form-control" placeholder="Specialization" name="specialization">
                </div>
              </div>
              <div class="col-lg-6 col col-md-6 col-sm-6 col-12 mb-3" id="clinicFields" style="display:none;">
                <div class="form-group">
                  <span class="text-dark"><b>Clinic name</b></span>
                  <input type="text" class="form-control" placeholder="Clinic name" name="clinic_name">
                </div>
              </div>
              <div class="col-lg-12 col col-md-12 col-sm-12 col-12 mb-3" id="clinicServicesField" style="display:none;">
                <div class="form-group">
                  <span class="text-dark"><b>Clinic services</b></span>
                  <textarea class="form-control" placeholder="Clinic services" name="clinic_services" id="" cols="30" rows="2"></textarea>
                </div>
              </div>
              <div class="col-lg-9 col-md-9 col-sm-9 col-12 mb-3">
                <div class="form-group">
                  <span class="text-dark"><b>User's photo</b></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input form-control" id="exampleInputFile" name="fileToUpload" onchange="getImagePreview(event)" required>
                    </div>
                    <!--  <div class="input-group-append">
                      <span class="input-group-text">Upload</span>
                    </div> -->
                  </div>
                  <p class="help-block text-danger">Max. 500KB</p>
                </div>
              </div>
              <!-- LOAD IMAGE PREVIEW -->
              <div class="col-lg-3 col-md-3 col-sm-3 col-12 mb-3">
                <div class="form-group">
                  <label for="imagePreview" class="text-dark"><b>Preview:</b></label>
                  <div class="image-preview" style="border: 1px solid #ddd; padding: 10px; border-radius: 5px; background-color: #f8f9fa;">
                    <img id="imagePreview" src="images/image-holder.png" alt="Image Preview" class="img-fluid" style="width: 100%;">
                  </div>
                </div>
              </div>
            </div>
          
        </div>
        <div class="card-footer">
          <div class="row">
            <div class="col-8">
              <p>Already have an account? <a class="text-primary" href="login.php">Click here!</a></p>
              <!-- <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                 I agree to the <a href="#" data-toggle="modal" data-target="#terms-conditions">terms</a>
                </label>
              </div> -->
            </div>
            <div class="col-4" style="display: flex;">
              <button type="submit" class="btn btn-primary" name="create_user" id="submit_button" style="margin-left: auto;"><i class="fa-solid fa-floppy-disk"></i> Register</button>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="terms-conditions" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <img src="dist/img/AdminLTELogo.png" alt="" class="d-block m-auto img-circle img-fluid shadow-sm" width="100">
        </div>
        <div class="modal-body text-justify">
            <h5 class="modal-title text-center mb-4" id="exampleModalLabel">Terms and Conditions</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel metus id elit mollis blandit nec vel libero. In ut facilisis dolor. Donec efficitur velit id ligula egestas, nec volutpat sapien congue.</p>
            <p>Curabitur ullamcorper feugiat velit, a egestas urna facilisis non. Sed in commodo nisl. Fusce vehicula dui at ligula blandit, sit amet dignissim justo volutpat. Integer sagittis, libero sit amet fermentum sagittis, neque dui hendrerit dolor.</p>
            <!-- Add more terms and conditions text as needed -->
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<?php require 'footer.php'; ?>
<script>
    function handleUserRoleChange() {
        var userTypeSelect = document.getElementById('user_type');
        var specializationField = document.getElementById('specializationField');
        var clinicFields = document.getElementById('clinicFields');
        var clinicServicesField = document.getElementById('clinicServicesField');
        var occupationField = document.getElementsByName('occupation')[0];

        // Reset values and hide fields
        specializationField.style.display = 'none';
        clinicFields.style.display = 'none';
        clinicServicesField.style.display = 'none';
        occupationField.value = '';

        // Show fields based on selected user role
        if (userTypeSelect.value == '2') { // Doctor
            specializationField.style.display = 'block';
            clinicFields.style.display = 'block';
            clinicServicesField.style.display = 'block';
            occupationField.value = 'Doctor';

            // Add the required attribute
            document.getElementsByName('specialization')[0].required = true;
            document.getElementsByName('clinic_name')[0].required = true;
            document.getElementsByName('clinic_services')[0].required = true;
        } else {
            // Remove the required attribute
            document.getElementsByName('specialization')[0].required = false;
            document.getElementsByName('clinic_name')[0].required = false;
            document.getElementsByName('clinic_services')[0].required = false;
        }
    }
</script>
