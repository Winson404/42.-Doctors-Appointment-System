<title>Doctors appointment system | Dashboard</title>
<?php require_once 'sidebar.php'; ?>
  
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="row d-flex justify-content-center">

        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Appointments</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="Appointments" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>


<?php include '../includes/footer.php'; ?>

<script>
  $(function () {


    // CIVIL STATUS *****************************
    var donutChartCanvas = $('#Appointments').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Pending', 'Approved', 'Rejected'],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(appt_ID ) AS Pending FROM appointment WHERE status=0 ");
            $row = mysqli_fetch_array($sql);

            $sql2 = mysqli_query($conn, "SELECT count(appt_ID ) AS Approved FROM appointment WHERE status=1 ");
            $row2 = mysqli_fetch_array($sql2);

            $sql3 = mysqli_query($conn, "SELECT count(appt_ID ) AS Rejected FROM appointment WHERE status=2 ");
            $row3 = mysqli_fetch_array($sql3);

            // $sql4 = mysqli_query($conn, "SELECT count(appt_ID ) AS Missed FROM appointment WHERE status=3 AND DATE(appt_date) < CURDATE()");
            // $row4 = mysqli_fetch_array($sql4);

      echo " datasets: [ 
              { 
                data: [".$row['Pending'].", ".$row2['Approved'].", ".$row3['Rejected']."], 
                backgroundColor : ['#f56954', '#00a65a', '#f39c12'],
              } 
             ] ";
      ?>
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      // type: 'pie',
      data: donutData,
      options: donutOptions
    })







  })
</script>