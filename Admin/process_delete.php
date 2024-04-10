<?php 
	include '../config.php';
	include '../includes/function_delete.php';
	include '../includes/function_create.php';


	// DELETE ADMIN - ADMIN_DELETE.PHP
	if (isset($_POST['delete_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    $fetch = mysqli_query($conn, "SELECT * FROM users WHERE user_Id=$user_Id");
	    $row = mysqli_fetch_array($fetch);
	    
	    	$name = $row['firstname'].' '.$row['lastname'];
		    $email = $row['email'];
		    $subject = "Account deletion";
		    $message = '
	            <!DOCTYPE html>
	            <html lang="en">
	            <head>
	                <meta charset="UTF-8">
	                <meta name="viewport" content="width=device-width, initial-scale=1.0">
	            </head>
	            <body style="font-family: \'Segoe UI\', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; margin: 0; padding: 2px; background-color: #f4f4f4;">

	                <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">

	                    <!-- Header with logo and system name -->
	                    <div style="display: flex; flex-direction: column; align-items: center; margin-bottom: 20px;">
	                    	<!-- <img src="images-users/academia.png" alt="Logo" style="max-width: 100px; height: auto; border-radius: 50%; margin-bottom: 10px;"> -->
	                        <div style="font-size: 20px; font-weight: bold; color: #007BFF;">Doctors appointment system</div>
	                    </div>

	                    <!-- Heading and message section -->
	                    <h2 style="color: #333;">Verification Code</h2>
	                    <p style="color: #666; margin-bottom: 15px;">Dear '.$name.',</p>
						<p style="color: #666; margin-bottom: 15px;">This is to inform you that your account has been deleted just now. Thank you for once again.</p>
	                    <!-- Add more paragraphs or customize as needed -->

	                    <!-- Closing note -->
	                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
	                </div>

	            </body>
	            </html>
	        ';
	        sendEmail($subject, $message, $email, "admin.php");
	        $delete = deleteRecord($conn, "users", "user_Id", $user_Id, "admin.php");

	    

	    
	}


	// DELETE USER - USERS_DELETE.PHP
	if (isset($_POST['delete_user'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "users.php");
	}


	// DELETE SECRETARY - SECRETARY_DELETE.PHP
	if (isset($_POST['delete_secretary'])) {
	    $user_Id = $_POST['user_Id'];
	    deleteRecord($conn, "users", "user_Id", $user_Id, "secretary.php");
	}


	// DELETE SECRETARY - SECRETARY_DELETE.PHP
	if (isset($_POST['delete_schedule'])) {
	    $sched_ID = $_POST['sched_ID'];
	    deleteRecord($conn, "schedule", "sched_ID", $sched_ID, "schedules.php");
	}




?>




