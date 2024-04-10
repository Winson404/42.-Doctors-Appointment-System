
<!-- VIEW DETAILS PHOTO -->
<div class="modal fade" id="details<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">Secretary's Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-4">
              <img src="../images-users/<?php echo $row['image']; ?>" alt="Secretary Photo" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title text-primary m-1"><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'].' '.$row['suffix']; ?></h5>
                  <p class="card-text m-1"><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
                  <p class="card-text m-1"><strong>Date of Birth:</strong> <?php echo $row['dob']; ?></p>
                  <p class="card-text m-1"><strong>Age:</strong> <?php echo $row['age']; ?></p>
                  <p class="card-text m-1"><strong>Email:</strong> <?php echo $row['email']; ?></p>
                  <p class="card-text m-1"><strong>Contact:</strong> <?php echo $row['contact'] ? '+63 '.$row['contact'] : ''; ?></p>
                  <p class="card-text m-1"><strong>Birthplace:</strong> <?php echo $row['birthplace']; ?></p>
                  <p class="card-text m-1"><strong>Civil Status:</strong> <?php echo $row['civilstatus']; ?></p>
                  <p class="card-text m-1"><strong>Occupation:</strong> <?php echo $row['occupation']; ?></p>
                  <p class="card-text m-1"><strong>Religion:</strong> <?php echo $row['religion']; ?></p>
                  <p class="card-text m-1"><strong>Address:</strong> <?php echo $row['house_no'].', '.$row['street_name'].', '.$row['purok'].', '.$row['zone'].', '.$row['barangay'].', '.$row['municipality'].', '.$row['province'].', '.$row['region']; ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
        <a href="secretary_mgmt.php?page=<?php echo $row['user_Id']; ?>" class="btn btn-success float-right btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
      </div>
    </div>
  </div>
</div>



<!-- VIEW PROFILE PHOTO -->
<div class="modal fade" id="viewphoto<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel">Secretary's photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <img src="../images-users/<?php echo $row['image']; ?>" alt="" width="200" height="200" class="img-circle" style="box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;">
      </div>
      <div class="modal-footer alert-light d-flex justify-content-center">
        <a href="../images-users/<?php echo $row['image']; ?>" type="button" class="btn bg-gradient-primary btn-sm" download><i class="fa-solid fa-download"></i> Download</a>
      </div>
    </div>
  </div>
</div>



<!-- DELETE -->
<div class="modal fade" id="delete<?php echo $row['user_Id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-large"></i> Delete Secretary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="fa-solid fa-circle-xmark"></i></span>
        </button>
      </div>
      <div class="modal-body">
        <form action="process_delete.php" method="POST">
          <input type="hidden" class="form-control" value="<?php echo $row['user_Id']; ?>" name="user_Id">
          <h6 class="text-center">Delete secretary record?</h6>
        </div>
        <div class="modal-footer alert-light">
          <button type="button" class="btn bg-secondary btn-sm" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
          <button type="submit" class="btn bg-danger btn-sm" name="delete_secretary"><i class="fas fa-trash"></i> Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>