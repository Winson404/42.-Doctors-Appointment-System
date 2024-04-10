<title>Doctors appointment system | Dashboard</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <!-- <div class="row">
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type=2");
              $row_users = mysqli_num_rows($users);
              ?>
              <h3><?php echo $row_users; ?></h3>
              <p>Registered Doctors</p>
            </div>
            <div class="icon">
              <i class="fas fa-user-md"></i>
            </div>
            <a href="admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $users = mysqli_query($conn, "SELECT user_Id from users WHERE user_type=1");
              $row_users = mysqli_num_rows($users);
              ?>
              <h3><?php echo $row_users; ?></h3>
              <p>Registered Secretaries</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="secretary.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $patients = mysqli_query($conn, "SELECT user_Id from users WHERE user_type=0");
              $row_patients = mysqli_num_rows($patients);
              ?>
              <h3><?php echo $row_patients; ?></h3>
              <p>Registered Patients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div> -->
      <div class="row">

        <div class="col-md-6">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Appointments</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="appointments" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">System users</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <canvas id="registeredUsers" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>

        <div class="col-md-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Recent appointments</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool pt-3" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                  <thead>
                    <tr>
                      <th>PROFILE</th>
                      <th>PATIENT NAME</th>
                      <th>PURPOSE</th>
                      <th>APPOINTMENT DATETIME</th>
                      <th>STATUS</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php
                      if($type_logged_in == 2) {
                        $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.patient_ID=users.user_Id WHERE appointment.doctor_ID = $id AND is_deleted=0 ORDER BY appointment.appt_ID DESC LIMIT 10");
                      } else {
                        $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.patient_ID=users.user_Id WHERE is_deleted=0 ORDER BY appointment.appt_ID DESC LIMIT 10");
                      }
                      
                      while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                          <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                        </a href="">
                      </td>
                      <td><?php echo ucwords($row['firstname'].' '.$row['lastname']); ?></td>
                      <td><?php echo ucwords($row['purpose']); ?></td>
                      <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['appt_date'])); ?></td>
                      <td>
                        <?php
                            $status = $row['status'];
                            $statusMappings = [
                                0 => ['text' => 'Pending', 'class' => 'badge badge-warning'],
                                1 => ['text' => 'Approved', 'class' => 'badge badge-success'],
                                2 => ['text' => 'Rejected', 'class' => 'badge badge-danger'],
                                3 => ['text' => 'Missed', 'class' => 'badge badge-secondary'],
                            ];
                            $statusText = $statusMappings[$status]['text'] ?? 'Unknown';
                            $badgeClass = $statusMappings[$status]['class'] ?? 'badge badge-secondary';
                        ?>
                        <span class="<?= $badgeClass; ?>"><?= $statusText; ?></span>
                      </td>
                    </tr>
                    <?php include 'users_delete.php'; } ?>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
          
      </div>
    </div>
  </section>
  <?php require_once '../includes/footer.php'; ?>

  <script>
  $(function () {

    // SYSTEM USERS *****************************
    var donutChartCanvas = $('#registeredUsers').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Doctors', 'Secretaries', 'Patients'],
     <?php 
            $sql = mysqli_query($conn, "SELECT count(user_Id) AS Doctors FROM users WHERE user_type=2 ");
            $row = mysqli_fetch_array($sql);

            $sql2 = mysqli_query($conn, "SELECT count(user_Id) AS Secretaries FROM users WHERE user_type=1 ");
            $row2 = mysqli_fetch_array($sql2);

            $sql3 = mysqli_query($conn, "SELECT count(user_Id) AS Patients FROM users WHERE user_type=0 ");
            $row3 = mysqli_fetch_array($sql3);

      echo " datasets: [ 
              { 
                data: [".$row['Doctors'].", ".$row2['Secretaries'].", ".$row3['Patients']."], 
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




    // APPOINTMENTS *****************************
    var donutChartCanvas = $('#appointments').get(0).getContext('2d')
    var donutData        = {

    labels: [ 'Pending', 'Todays appointments', ' Approved appointments'],
     <?php 
            if($type_logged_in == 2) {
              $sql4 = mysqli_query($conn, "SELECT count(appt_ID) AS Pending FROM appointment WHERE status=0 AND doctor_ID=$id");
              $sql5 = mysqli_query($conn, "SELECT count(appt_ID) AS Today FROM appointment WHERE DATE(appt_date) = CURDATE() AND doctor_ID=$id");
              $sql3 = mysqli_query($conn, "SELECT count(appt_ID) AS Approved FROM appointment WHERE status=1 AND doctor_ID=$id");
            } else {
              $sql4 = mysqli_query($conn, "SELECT count(appt_ID) AS Pending FROM appointment WHERE status=0");
              $sql5 = mysqli_query($conn, "SELECT count(appt_ID) AS Today FROM appointment WHERE DATE(appt_date) = CURDATE()");
              $sql3 = mysqli_query($conn, "SELECT count(appt_ID) AS Approved FROM appointment WHERE status=1");
            }
            
            $row4 = mysqli_fetch_array($sql4);

            
            $row5 = mysqli_fetch_array($sql5);

            
            $row6 = mysqli_fetch_array($sql3);

      echo " datasets: [ 
              { 
                data: [".$row4['Pending'].", ".$row5['Today'].", ".$row6['Approved']."], 
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

