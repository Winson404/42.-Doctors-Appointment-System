<?php include 'header.php'; ?>

<!-- ======= Hero ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel" >
    <ol class="carousel-indicators" id="hero-carousel-indicators" ></ol>
    <div class="carousel-inner" role="listbox" >

      <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg);" >
          <div class="container" >
              <h2>Welcome to <span>DOCTORS APPOINTMENT SYSTEM</span></h2>
              <p>Discover a seamless healthcare experience with Doctors Appointment. Your wellness journey begins here.</p>
              <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
      </div>

      <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg)">
          <div class="container">
              <h2>Welcome to <span>HEALTHCARE HUB</span></h2>
              <p>Empowering you to take control of your health. Join us in redefining healthcare through innovation and care.</p>
              <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
      </div>

      <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg)">
          <div class="container">
              <h2>Welcome to <span>WELLNESS CENTRAL</span></h2>
              <p>Your well-being, our priority. Experience personalized healthcare solutions tailored just for you.</p>
              <a href="#about" class="btn-get-started scrollto">Read More</a>
          </div>
      </div>


    </div>
    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>
    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>
  </div>
</section>
<!-- ======= End Hero ======= -->

<!-- ======= About Us Section ======= -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>About Us</h2>
      <p>Welcome to Doctors Appointment System, where your health is our priority. Our mission is to provide seamless and efficient appointment services to ensure you receive the care you need when you need it. Learn more about our commitment to excellence, patient-centric approach, and the dedicated team behind Doctors Appointment System. Your well-being is at the heart of what we do, and we look forward to serving you with the highest standard of care.</p>
    </div>

    <div class="row">
      <div class="col-lg-6" data-aos="fade-right">
        <img src="images/logo.jpg" class="img-fluid" alt="Centralians Clinic Building">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
        <h3>Experience Quality Healthcare at Doctors Appointment System</h3>
        <p class="fst-italic">Discover a healthcare experience like no other at Centralians Clinic. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <ul>
          <li><i class="text-primary bi bi-check-circle"></i> Unparalleled commitment to patient care and satisfaction.</li>
          <li><i class="text-primary bi bi-check-circle"></i> Expert doctors providing personalized medical services.</li>
          <li><i class="text-primary bi bi-check-circle"></i> State-of-the-art facilities for comprehensive healthcare.</li>
        </ul>
        <p>At CCP Clinic Appointment, we strive to create a welcoming and healing environment for our patients. Our dedicated team works tirelessly to ensure your health and well-being are prioritized. Experience the difference with Doctors Appointment System - where your health matters the most.</p>
      </div>
    </div>


  </div>
</section>
<!-- End About Us Section -->

<!-- ======= Appointment Section ======= -->
<!-- <section id="appointment" class="appointment section-bg">
  <div class="container" data-aos="fade-up">

   <div class="section-title">
      <h2>Make an Appointment</h2>
      <p>Take the first step towards a healthier you. Schedule your appointment today and let our dedicated team of professionals provide you with the care you deserve. Your well-being is our priority, and we look forward to assisting you on your journey to better health.</p>
   </div>


    <form action="processes.php" method="post" role="form"  data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-md-4 form-group mb-3">
          <input type="number" name="studNum" class="form-control" id="studNum" placeholder="Student Number" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 form-group mb-3">
          <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First Name" required>
        </div>
        <div class="col-md-3 form-group mb-3">
          <input type="text" name="middlename" class="form-control" id="middlename" placeholder="Middle Name">
        </div>
        <div class="col-md-3 form-group mb-3">
          <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last Name" required>
        </div>
        <div class="col-md-3 form-group mb-3">
          <input type="text" name="suffix" class="form-control" id="suffix" placeholder="Suffix">
        </div>
        <div class="col-md-4 form-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="CCP Email" onkeydown="validationAppointment()" onkeyup="validationAppointment()"  required>
          <div class="input-group mb-3">
            <small id="text" style="font-style: italic;"></small>
          </div>
        </div>
        <div class="col-md-4 form-group mb-3">
          <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" required>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 form-group">
          <input type="date" name="selectedDate" class="form-control datepicker" id="date" placeholder="Appointment Date" required oninput="validateDate()" min="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="col-md-4 form-group">
          <select name="selectedTime" id="selectedTime" class="form-select" required>
            <option value="">Select Time</option>
            <option value="11:00 - 11:15 AM">11:00 - 11:15 AM</option>
            <option value="11:15 - 11:30 AM">11:15 - 11:30 AM</option>
            <option value="11:30 - 11:45 AM">11:30 - 11:45 AM</option>
            <option value="11:45 - 12:00 AM">11:45 - 12:00 AM</option>
            <option value="12:00 - 12:15 PM">12:00 - 12:15 PM</option>
            <option value="12:15 - 12:30 PM">12:15 - 12:30 PM</option>
            <option value="12:30 - 12:45 PM">12:30 - 12:45 PM</option>
          </select>
        </div>
        <div class="col-md-4 form-group">
          <select name="doctor" id="doctor" class="form-select" required>
            <option value="">Select Doctor</option>
            <option value="Leovihilda Chan Cheng (School Dentist)">Leovihilda Chan Cheng (School Dentist)</option>
            <option value="Barbara Velayo Diuco (School Physician)">Barbara Velayo Diuco (School Physician)</option>
          </select>
        </div>
      </div>

      <div class="form-group mt-3">
        <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
      </div>
      <div class="text-center"><button type="submit" class="btn btn-primary mt-3" name="setAppointment" id="submit_button">Make an Appointment</button></div>
    </form>

  </div>
</section> -->
<!-- End Appointment Section -->

<!-- ======= Doctors Section ======= -->
<!-- <section id="doctors" class="doctors section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Doctors</h2>
     <p>Meet our dedicated team of experienced healthcare professionals, including our school dentist and school physician, who are committed to providing top-notch care for our students. With expertise in oral health and general medicine, our professionals are here to ensure the well-being of every student. Whether you need a dental checkup, have specific health concerns, or just want to schedule an appointment, our school dentist and physician are ready to assist you on your journey to better health within the school community.</p>

    </div>

    <div class="row d-flex justify-content-center">

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="100">
          <div class="member-img">
            <img src="assets/img/doctors/doctors-5.png" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info">
            <h4>Leovihilda Chan Cheng</h4>
            <span>School Dentist</span>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
        <div class="member" data-aos="fade-up" data-aos-delay="200">
          <div class="member-img">
            <img src="assets/img/doctors/doctors-6.png" class="img-fluid" alt="">
            <div class="social">
              <a href=""><i class="bi bi-twitter"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
          <div class="member-info" style="margin-top: 11px;">
            <h4>Barbara Velayo Diuco</h4>
            <span>School Physician</span>
          </div>
        </div>
      </div>

    </div>

  </div>
</section> -->
<!-- End Doctors Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
  <div class="container">

    <div class="section-title">
      <h2>Contact</h2>
      <p>Have questions or need assistance? Feel free to reach out to us. Our friendly team is here to help you with any inquiries related to our appointment system. Whether you have a suggestion, feedback, or need technical support, we're just a message away. Your satisfaction is our priority, and we look forward to hearing from you!</p>
    </div>

  </div>


  <div class="container">

    <div class="row mt-5">

      <div class="col-lg-6">

        <div class="row">
          <div class="col-md-12">
            <div class="info-box">
              <i class="text-primary bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Loc. 127</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box mt-4">
              <i class="text-primary bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>clinic@ccp.edu.ph</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box mt-4">
              <i class="text-primary bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>8715-5170</p>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-6">
        <form action="processes.php" method="post" class="info-box p-3">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
          </div>
          <?php if(isset($_SESSION['success'])) { ?> 
          <div class="my-3 bg-info">
            <h6 class="alert text-white" role="alert"><?php echo $_SESSION['success']; ?></h6>
          </div>
          <?php unset($_SESSION['success']); } ?>
          <div class="text-center"><button class="btn btn-primary mt-3" type="submit" name="sendEmail">Send Message</button></div>
        </form>
      </div>

    </div>

  </div>
</section>
<!-- End Contact Section -->

<?php include 'footer.php'; ?>

<script>
function validateDate() {
    var inputDate = document.getElementById("date").value;
    var selectedDate = new Date(inputDate);
    var day = selectedDate.getDay();

    if (day === 0 || day === 6) {
        alert("Weekends are not allowed for appointments. Please choose a weekday.");
        document.getElementById("date").value = "";
    }

    var today = new Date();
    if (selectedDate < today) {
        alert("Past dates are not allowed for appointments. Please choose a future date.");
        document.getElementById("date").value = "";
    }
}


  $(document).ready(function() {
        setTimeout(function() {
            $('.alert').hide();
        } ,4000);
  });
</script>