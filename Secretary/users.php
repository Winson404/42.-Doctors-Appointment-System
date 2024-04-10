<title>Doctors appointment system | Patient records</title>
<?php
require_once 'sidebar.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Patient</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active">Patient records</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header p-2">
              <div class="card-tools mr-1">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover text-sm">
                <thead>
                  <tr>
                    <th>PHOTO</th>
                    <th>NAME</th>
                    <th>GENDER</th>
                    <th>EMAIL/CONTACT</th>
                    <th>DATE ADDED</th>
                    <th>TOOLS</th>
                  </tr>
                </thead>
                <tbody id="users_data">
                  <?php
                  $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 0 ");
                  while ($row = mysqli_fetch_array($sql)) {
                  ?>
                  <tr>
                    <td>
                      <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                        <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                      </a href="">
                    </td>
                    <td><?php echo $row['firstname'].' '.$row['lastname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?> <br> <span class="text-info"><?php if($row['contact'] !== '') { echo '+63 '.$row['contact']; } ?></span></td>
                    <td class="text-primary"><?php echo date("F d, Y h:i A", strtotime($row['created_at'])); ?></td>
                    <td>
                      <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#details<?php echo $row['user_Id']; ?>"><i class="fas fa-eye"></i> View</button>
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