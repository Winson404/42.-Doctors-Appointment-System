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
              <a href="doctors.php" class="btn btn-sm bg-primary"><i class="fa-sharp fa-solid fa-square-plus"></i> New appointment</a>
              <div class="card-tools mr-1 mt-3">
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
                    <th>DOCTOR DETAILS</th>
                    <th>PURPOSE</th>
                    <th>SCHEDULE</th>
                    <th>STATUS</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $i = 1;
                  $sql = mysqli_query($conn, "SELECT * FROM appointment JOIN users ON appointment.doctor_ID=users.user_Id WHERE appointment.patient_ID = $id AND appointment.is_deleted=0 ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?= $i++ ?></td>
                    <td>
                      <b>Name:</b> <?php echo $row['firstname'].' '.$row['lastname']; ?> <br>
                      <b>Specialization:</b> <?php echo ucwords($row['specialization']); ?> <br>
                      <b>Clinic name:</b> <?php echo ucwords($row['clinic_name']); ?> <br>
                      <b>Clinic services:</b> <?php echo ucwords($row['clinic_services']); ?> <br>
                    </td>
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
                      <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#update<?php echo $row['appt_ID']; ?>" <?php if($row['status'] != 0) { echo 'disabled'; } ?>><i class="fas fa-pencil-alt"></i></button>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['appt_ID']; ?>"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>

                  <div class="modal fade" id="update<?php echo $row['appt_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="process_update.php" method="POST">
                          <input type="hidden" class="form-control"  placeholder="Enter type of activity" name="appt_ID" value="<?= $row['appt_ID'] ?>" required>
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> Update appointment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <span class="text-dark"><b>Purpose</b></span>
                              <textarea class="form-control"  placeholder="Enter purpose" name="purpose" id="" cols="30" rows="2" required><?= $row['purpose'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <span class="text-dark"><b>Date and Time</b></span>
                                <input type="datetime-local" class="form-control" placeholder="Select date and time" name="appt_date" value="<?= $row['appt_date'] ?>" required>
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

                  <!-- DELETE -->
                  <div class="modal fade" id="delete<?php echo $row['appt_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-light">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> Delete schedule</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="process_delete.php" method="POST">
                            <input type="hidden" class="form-control" value="<?php echo $row['appt_ID']; ?>" name="appt_ID">
                            <h6 class="text-center">Delete schedule record?</h6>
                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-danger btn-sm" name="delete_appointment"><i class="fas fa-trash"></i> Delete</button>
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <div class="card-header">
              Appointment schedules
              <div class="card-tools mr-1 mt-3">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div id="calendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>



  </section>
<?php 
  require_once '../includes/footer.php'; 
  $query = mysqli_query($conn, "SELECT * FROM appointment WHERE patient_ID=$id AND status=1");
  $scheduledDates = array();
  while ($row = mysqli_fetch_assoc($query)) {
      $scheduledDates[] = array(
          'title' => ucwords($row['purpose']),
          'start' => $row['appt_date'],
          'formattedTime' => date('h:i:s A', strtotime($row['appt_date'])) // Format time
      );
  }
?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var scheduledDates = <?php echo json_encode($scheduledDates); ?>;
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            events: scheduledDates,
            eventRender: function (info) {
                info.el.innerHTML = '<div style="font-weight: bold;">' + info.event.title + '</div>';
                info.el.innerHTML += '<div>' + formatTime(info.event.start) + '</div>';
            },
            editable: true,
            droppable: true,
            drop: function (info) {
            },
            dateClick: function (info) {
                var date = info.dateStr; 
                openAddActivityModal(date);
            }
        });

        calendar.render();

        function formatTime(date) {
            var options = { hour: 'numeric', minute: 'numeric', hour12: true };
            return new Intl.DateTimeFormat('en-US', options).format(date);
        }

    });
</script>