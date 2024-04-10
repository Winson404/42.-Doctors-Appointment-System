<title>Doctors appointment system | Doctor records</title>
<?php 
    require_once 'sidebar.php'; 
?>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Doctor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Doctor records</li>
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
                <a href="admin_mgmt.php?page=create" class="btn btn-sm bg-primary ml-2 d-none"><i class="fa-sharp fa-solid fa-square-plus"></i> New Doctor</a>
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
                      <th>PHOTO</th>
                      <th>NAME</th>
                      <th>SPECIALIZATION</th>
                      <th>CLINIC NAME</th>
                      <th>SERVICES</th>
                      <th>TOOLS</th>
                    </tr>
                  </thead>
                  <tbody id="users_data">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 2 ");
                    while ($row = mysqli_fetch_array($sql)) {
                    ?>
                    <tr>
                      <td>
                        <a data-toggle="modal" data-target="#viewphoto<?php echo $row['user_Id']; ?>">
                          <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="25" height="25" class="img-circle d-block m-auto">
                        </a href="">
                      </td>
                      <td><?= ucwords($row['firstname'].' '.$row['lastname']) ?></td>
                      <td><?= ucwords($row['specialization']) ?></td>
                      <td><?= ucwords($row['clinic_name']) ?></td>
                      <td><?= ucwords($row['clinic_services']) ?></td>
                      <td>
                        <button type="button" class="btn bg-info btn-sm" data-toggle="modal" data-target="#details<?php echo $row['user_Id']; ?>"><i class="fas fa-eye"></i> View</button>
                      </td>
                    </tr>
                    <?php include 'doctors_view.php'; }  ?>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php require_once '../includes/footer.php'; ?>