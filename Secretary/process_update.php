<?php 
	include '../config.php';
	include '../includes/function_update.php';


	// UPDATE ADMIN INFO - PROFILE.PHP
	if (isset($_POST['update_profile_info'])) {
	    $user_Id = mysqli_real_escape_string($conn, $_POST['user_Id']);
	    updateProfileInfo($conn, $user_Id, "profile.php");
	}




	// CHANGE USERS PASSWORD - USERS_DELETE.PHP
	if (isset($_POST['update_password_admin'])) {
	    $user_Id     = $_POST['user_Id'];
	    $OldPassword = md5($_POST['OldPassword']);
	    $password    = md5($_POST['password']);
	    $cpassword   = md5($_POST['cpassword']);

	    changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, "profile.php");
	}

		


	// UPDATE ADMIN PROFILE - PROFILE.PHP
	if (isset($_POST['update_profile_admin'])) {
	    $user_Id = $_POST['user_Id'];
	    updateProfileAdmin($conn, $user_Id, "profile.php");
	}




	// UPDATE APPOINTMENT STATUS - APPOINTMENT.PHP
	if (isset($_POST['reminder'])) {
		$appt_ID = $_POST['appt_ID'];
	    // GET PATIENT DETAILS
		$fetch     = mysqli_query($conn, "SELECT * FROM appointment a JOIN users u ON a.patient_ID=u.user_Id WHERE appt_ID=$appt_ID");
		$row       = mysqli_fetch_array($fetch);
		$name      = ucwords($row['firstname'].' '.$row['lastname']);
		$email     = $row['email'];
		$purpose   = $row['purpose'];
		$appt_date = date('F d, Y h:i A',strtotime($row['appt_date']));

		// GET DOCTOR DETAILS
		$fetch2     = mysqli_query($conn, "SELECT * FROM appointment a JOIN users u ON a.doctor_ID=u.user_Id WHERE appt_ID=$appt_ID");
		$row2       = mysqli_fetch_array($fetch2);
		$name2      = ucwords($row2['firstname'].' '.$row2['lastname']);
		$email2     = $row2['email'];
		$purpose2   = $row2['purpose'];
		$appt_date2 = date('F d, Y h:i A',strtotime($row2['appt_date']));

		
	    $subject = "Appointment reminder";
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
					<p style="color: #666; margin-bottom: 15px;">The appointment schedule you have set on '.$appt_date.' with Doctor '.$name2.', and with a purpose of, '.$purpose.' has been approved. You are advised to be on time on the day of your selected schedele. Thank you.</p>
                    <!-- Add more paragraphs or customize as needed -->

                    <!-- Closing note -->
                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
                </div>

            </body>
            </html>
        ';
        $send = send_Email($subject, $message, $email, "appointment.php?user_Id=".$row['patient_ID']);
        
	}











?>
