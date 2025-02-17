<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

  </div>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered p-3">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <img src="../dist/img/AdminLTELogo.png" alt="" class="d-block m-auto img-circle img-fluid shadow-sm" width="100">
        </div>
        <div class="modal-body p-5">
            <h6 class="text-center">Your session has timed out. Please login again</h6>
        </div>
        <div class="modal-footer alert-light">
          <a href="../logout.php" type="button" class="btn btn-secondary">Close</a>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <!-- <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Mission</label>
        <p class="text-sm text-justify text-muted">Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Veniam doloremque hic nam corrupti. Soluta ea, vero! Tenetur voluptatem rem, dolor quasi itaque inventore id nisi adipisci sunt, asperiores aut, provident?</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Vision</label>
        <p class="text-sm text-justify text-muted">Lorem ipsum, dolor sit, amet consectetur adipisicing elit. Veniam doloremque hic nam corrupti. Soluta ea, vero! Tenetur voluptatem rem, dolor quasi itaque inventore id nisi adipisci sunt, asperiores aut, provident?</p>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12 bg-white">
        <label>Contact Us</label>
        <p class="text-sm text-justify text-muted"><i class="fa-solid fa-phone"></i> +63 9123456789</p>
        <p class="text-sm text-justify text-muted"><i class="fa-solid fa-envelope"></i> admin@gmail.com</p>
      </div>

    </div>
    <div class="dropdown-divider"></div> -->
    <strong>Copyright &copy; 2023 <a href="#">Doctors appointment system</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>


<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.js"></script>

<!-- Custom JS -->
<script src="../dist/js/script.js"></script>
<!-- SweetAlert Message -->
<script src="../dist/js/sweetalert2.min.js"></script>
<?php if(isset($_SESSION['message']) && isset($_SESSION['text']) && isset($_SESSION['status'])) { ?>
  <script>
    swal ({
      title: '<?php echo $_SESSION['message']; ?>',
      text: "<?php echo $_SESSION['text']; ?>",
      icon: "<?php echo $_SESSION['status']; ?>",
      confirmButtonColor: '#3085d6',
      confirmButtonText: "Okay",
      timer: 3000
    });
  </script>
<?php unset($_SESSION['message']); unset($_SESSION['text']); unset($_SESSION['status']); } ?>


<script>
  $(function () {
    
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      // "buttons": ["csv", "pdf", "print"]
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


  // AUTO LOGOUT AFTER 10 MINS
  setInterval(function() {
    var lastActive = <?php echo $_SESSION['last_active']; ?>;
    var currentTime = new Date().getTime() / 1000;
    var inactiveTime = currentTime - lastActive;
    if (inactiveTime > 600) { // inactivity period is 10 minutes
      // $('#approve').modal({
      //   backdrop: 'static',
      //   keyboard: false
      // }).modal('show');

      // Make an AJAX request to update the logout time
      $.ajax({
        url: '../includes/ajax_autoLogout.php',
        type: 'POST',
        data: {
          id: '<?php echo $id; ?>',
          login_time: '<?php echo $login_time; ?>',
        },
        success: function(response) {
          console.log(response);
          window.location = "../logout.php";
        },
        error: function(xhr, status, error) {
          console.error(error);
          swal("Error occurred while logging out!", {
            icon: "error",
          });
        }
      });
    }
  }, 1000);

</script>
</body>
</html>
