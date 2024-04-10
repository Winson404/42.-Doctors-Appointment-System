<title>Doctors appointment system | Appointment schedules records</title>
<?php
require_once 'sidebar.php';
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
                    <th>PATIENT NAME</th>
                    <th>PURPOSE</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = '';
                  if($type_logged_in == 3) {
                    $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.patient_ID=users.user_Id WHERE appointment.is_deleted=0 ");
                  } else {
                    $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.patient_ID=users.user_Id WHERE appointment.doctor_ID = $id AND appointment.is_deleted=0 ");
                  }
                  
                  while ($row = mysqli_fetch_array($sql)) {
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
                        <?php if($type_logged_in == 3): ?>
                            <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#update<?php echo $row['appt_ID']; ?>" <?php if($row['status'] != 0) { echo 'disabled'; } ?> disabled><i class="fas fa-pencil-alt"></i> Update Status</button>
                        <?php else: ?>
                            <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#update<?php echo $row['appt_ID']; ?>" <?php if($row['status'] != 0) { echo 'disabled'; } ?>><i class="fas fa-pencil-alt"></i> Update Status</button>
                        <?php endif; ?>
                    </td>
                  </tr>

                  <div class="modal fade" id="update<?php echo $row['appt_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="process_update.php" method="POST">
                                <input type="hidden" class="form-control" name="appt_ID" value="<?= $row['appt_ID'] ?>" required>
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> Update status</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="text-dark"><b>Status</b></span><br>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="approved_<?php echo $row['appt_ID']; ?>" name="status" value="1" <?php echo ($row['status'] == 1) ? 'checked' : ''; ?>>
                                            <label for="approved">Approved</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" id="rejected_<?php echo $row['appt_ID']; ?>" name="status" value="2" <?php echo ($row['status'] == 2) ? 'checked' : ''; ?>>
                                            <label for="rejected">Reject</label>
                                        </div>
                                        <div class="col-md-12" id="reason-section_<?php echo $row['appt_ID']; ?>" <?php echo ($row['status'] == 2) ? '' : 'style="display: none;"'; ?>>
                                            <div class="form-group">
                                                <span class="text-dark"><b>Reason</b></span>
                                                <textarea class="form-control" placeholder="Enter purpose" name="rejection_msg" id="rejection_msg_<?php echo $row['appt_ID']; ?>" cols="30" rows="2"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                                    <button type="submit" class="btn bg-primary btn-sm" name="update_appointment"><i class="fas fa-trash"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Add an event listener to the radio buttons
                        var approvedRadio = document.getElementById('approved_<?php echo $row['appt_ID']; ?>');
                        var rejectedRadio = document.getElementById('rejected_<?php echo $row['appt_ID']; ?>');
                        var reasonSection = document.getElementById('reason-section_<?php echo $row['appt_ID']; ?>');
                        var rejectionMsgTextarea = document.getElementById('rejection_msg_<?php echo $row['appt_ID']; ?>');

                        function toggleReasonSection() {
                            if (rejectedRadio.checked) {
                                reasonSection.style.display = 'block';
                                rejectionMsgTextarea.required = true;
                            } else {
                                reasonSection.style.display = 'none';
                                rejectionMsgTextarea.required = false;
                            }
                        }

                        approvedRadio.addEventListener('change', toggleReasonSection);
                        rejectedRadio.addEventListener('change', toggleReasonSection);

                        // Initial state
                        toggleReasonSection();
                    });
                </script>

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
  require_once '../includes/footer.php'; 
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add an event listener to the radio buttons
        var approvedRadio = document.getElementById('approved');
        var rejectedRadio = document.getElementById('rejected');
        var reasonSection = document.getElementById('reason-section');
        var rejectionMsgTextarea = document.querySelector('textarea[name="rejection_msg"]');

        function toggleReasonSection() {
            if (rejectedRadio.checked) {
                reasonSection.style.display = 'block';
                rejectionMsgTextarea.required = true;
            } else {
                reasonSection.style.display = 'none';
                rejectionMsgTextarea.required = false;
            }
        }

        approvedRadio.addEventListener('change', toggleReasonSection);
        rejectedRadio.addEventListener('change', toggleReasonSection);

        // Initial state
        toggleReasonSection();
    });
</script>
