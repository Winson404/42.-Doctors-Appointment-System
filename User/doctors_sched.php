<title>Doctors appointment system | Schedules records</title>
<?php
  require_once 'sidebar.php';
  if(isset($_GET['doctor_ID'])) {
    $doctor_ID = $_GET['doctor_ID'];

    $query = mysqli_query($conn, "SELECT * FROM schedule s JOIN users u ON s.user_ID=u.user_Id WHERE s.user_ID=$doctor_ID");
    if(mysqli_num_rows($query) > 0) {
      $doc_name = mysqli_fetch_array($query);
?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Doctor <?= ucwords($doc_name['firstname'].' '.$doc_name['lastname']) ?> schedules</h1>
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
              <button data-toggle="modal" data-target="#appointment" class="btn btn-sm bg-primary ml-2"><i class="fa-sharp fa-solid fa-square-plus"></i> Set appointment</button>
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

      <div class="modal fade" id="appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="process_save.php" method="POST">
              <input type="hidden" class="form-control"  placeholder="Enter type of activity" name="user_ID" value="<?= $id ?>" required>
              <input type="hidden" class="form-control"  placeholder="Enter type of activity" name="doctor_ID" value="<?= $doctor_ID ?>" required>
              <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-calendar-alt"></i> New appointment schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <span class="text-dark"><b>Purpose</b></span>
                  <textarea class="form-control"  placeholder="Enter purpose" name="purpose" id="" cols="30" rows="2" required></textarea>
                </div>
                <div class="form-group">
                    <span class="text-dark"><b>Date and Time</b></span>
                    <input type="datetime-local" class="form-control" placeholder="Select date and time" name="appt_date" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
                <button type="submit" class="btn bg-primary btn-sm" name="create_appointment"><i class="fas fa-trash"></i> Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>

  </section>
<?php 
  require_once '../includes/footer.php'; 
  $query2 = mysqli_query($conn, "SELECT * FROM schedule s JOIN users u ON s.user_ID=u.user_Id WHERE s.user_ID=$doctor_ID");
  $scheduledDates = array();
  while ($row = mysqli_fetch_assoc($query2)) {
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
                info.el.style.backgroundColor = info.event.backgroundColor;
                info.el.style.fontSize = '1px';
            },
            editable: true,
            droppable: true,
            drop: function (info) {
            },
            dateClick: function (info) {
                var date = info.dateStr; 
            }
        });

        calendar.render();
        
    });
</script>

<?php } else { require_once '../includes/500.php'; } } else { require_once '../includes/404.php'; } ?>
