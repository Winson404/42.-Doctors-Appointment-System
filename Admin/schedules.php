<title>Doctors appointment system | Schedules records</title>
<?php
require_once 'sidebar.php';
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Schedules</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Schedule records</li>
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
              <button data-toggle="modal" data-target="#add" class="btn btn-sm bg-primary"><i class="fa-sharp fa-solid fa-square-plus"></i> New Schedule</button>
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
                    <th width="60%">ACTIVITY</th>
                    <th width="20%">SCHEDULE</th>
                    <th width="20%">TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM schedule WHERE user_ID = $id ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td><?php echo ucwords($row['activity']); ?></td>
                    <td><?php echo date('F d, Y h:i A', strtotime($row['schedule'])); ?></td>
                    <td>
                      <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#update<?php echo $row['sched_ID']; ?>"><i class="fas fa-pencil-alt"></i></button>
                      <button type="button" class="btn bg-danger btn-sm" data-toggle="modal" data-target="#delete<?php echo $row['sched_ID']; ?>"><i class="fas fa-trash"></i></button>
                    </td>
                  </tr>

                  <div class="modal fade" id="update<?php echo $row['sched_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <form action="process_update.php" method="POST">
                          <input type="hidden" class="form-control"  placeholder="Enter type of activity" name="sched_ID" value="<?= $row['sched_ID'] ?>" required>
                          <div class="modal-header bg-light">
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> Update schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                              <span class="text-dark"><b>Activity</b></span>
                              <input type="text" class="form-control"  placeholder="Enter type of activity" name="activity" value="<?= $row['activity'] ?>" required>
                            </div>
                            <div class="form-group">
                                <span class="text-dark"><b>Date and Time</b></span>
                                <input type="datetime-local" class="form-control" placeholder="Select date and time" name="schedule" value="<?= $row['schedule'] ?>" required>
                                <!-- <input type="date" class="form-control" placeholder="Select date and time" name="schedule" value="<?= $row['schedule'] ?>" required> -->
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-primary btn-sm" name="update_schedule"><i class="fas fa-trash"></i> Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- DELETE -->
                  <div class="modal fade" id="delete<?php echo $row['sched_ID']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input type="hidden" class="form-control" value="<?php echo $row['sched_ID']; ?>" name="sched_ID">
                            <h6 class="text-center">Delete schedule record?</h6>
                          </div>
                          <div class="modal-footer alert-light">
                            <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                            <button type="submit" class="btn bg-danger btn-sm" name="delete_schedule"><i class="fas fa-trash"></i> Delete</button>
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
              Calendar
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

    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="process_save.php" method="POST">
            <input type="hidden" class="form-control"  placeholder="Enter type of activity" name="user_ID" value="<?= $id ?>" required>
            <div class="modal-header bg-light">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> New schedule</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <span class="text-dark"><b>Activity</b></span>
                <input type="text" class="form-control"  placeholder="Enter type of activity" name="activity" required>
              </div>
              <div class="form-group">
                  <span class="text-dark"><b>Date and Time</b></span>
                  <input type="datetime-local" class="form-control" placeholder="Select date and time" name="schedule" required>
                  <!-- <input type="date" class="form-control" placeholder="Select date and time" name="schedule" required> -->
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
              <button type="submit" class="btn bg-primary btn-sm" name="create_schedule"><i class="fas fa-trash"></i> Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>


  </section>
<?php 
  require_once '../includes/footer.php'; 
  $query = mysqli_query($conn, "SELECT * FROM schedule s JOIN users u ON s.user_ID=u.user_Id WHERE s.user_ID=$id");
  $scheduledDates = array();
  while ($row = mysqli_fetch_assoc($query)) {
      $client_name = ucwords($row['firstname'].' '.$row['lastname']);
      $scheduledDates[] = array(
          'title' => ucwords($row['activity']),
          'start' => $row['schedule'], // Include both date and time
          'formattedTime' => date('h:i:s A', strtotime($row['schedule'])) // Format time
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

        function openAddActivityModal(date) {
          var activityName = prompt('Enter activity for ' + date);

          if (activityName) {
              var eventData = {
                  user_ID: <?= $id ?>,
                  date: date,
                  activityName: activityName
              };

              // Send the data to the server using AJAX
              $.ajax({
                  url: 'save_activity.php',
                  type: 'POST',
                  dataType: 'json',
                  data: eventData,
                  success: function (response) {
                      if (response.success) {
                          alert(response.message);
                          calendar.refetchEvents();
                          location.reload();
                      } else {
                          alert(response.message);
                      }
                  },
                  error: function () {
                      alert('Error while saving activity');
                  }
              });
          }
      }
    });
</script>