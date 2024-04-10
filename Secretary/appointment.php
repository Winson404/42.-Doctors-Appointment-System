<title>Doctors appointment system | Appointment schedules records</title>
<?php
require_once 'sidebar.php';
if(isset($_GET['user_Id'])) {
    $patient_ID = $_GET['user_Id'];
    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_Id=$patient_ID ");
    $row_header = mysqli_fetch_array($sql);
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Appointment schedules</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Appointment schedule records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-header">
                <?php echo $row_header['firstname'].' '.$row_header['lastname']; ?>'s schedules
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>DOCTOR NAME</th>
                    <th>PURPOSE</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $currentDateTime = date('Y-m-d H:i:s');
                  $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.doctor_ID=users.user_Id WHERE appointment.patient_ID = $patient_ID AND appointment.is_deleted=0 ");
                  while ($row = mysqli_fetch_array($sql)) {
                    $status = $row['status'];
                    $apptDate = $row['appt_date'];

                    // Check if the status is 0 and the appointment date has not passed
                    $disableButton = ($status != 0 || strtotime($apptDate) <= strtotime($currentDateTime)) ? 'disabled' : '';

                  ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                    <td><?php echo ucwords($row['purpose']); ?></td>
                    <td><?php echo date('F d, Y h:i A', strtotime($row['appt_date'])); ?></td>
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
                    <td>
                      <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#update<?php echo $row['appt_ID']; ?>" <?= $disableButton; ?>><i class="fas fa-bell"></i> Remind</button>
                    </td>
                  </tr>

                  <div class="modal fade" id="update<?php echo $row['appt_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel">Reminder</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <form action="process_update.php" method="POST">
                          <div class="modal-body d-flex justify-content-center">
                            <input type="hidden" class="form-control" value="<?= $row['appt_ID'] ?>" name="appt_ID" required>
                            <p>Remind the patient about the schedule?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                            <button type="submit" class="btn bg-primary btn-sm" name="reminder"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>


                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>



  </section>
<?php 
  } else { require_once '../includes/404.php'; } require_once '../includes/footer.php'; 
?>

