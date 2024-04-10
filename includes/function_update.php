<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	function updateSystemUser($conn, $user_Id, $user_type, $specialization, $clinic_name, $clinic_services, $page) {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$birthplace     = ucwords(mysqli_real_escape_string($conn, $_POST['birthplace']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		$civilstatus    = ucwords(mysqli_real_escape_string($conn, $_POST['civilstatus']));
		$occupation     = ucwords(mysqli_real_escape_string($conn, $_POST['occupation']));
		$religion       = ucwords(mysqli_real_escape_string($conn, $_POST['religion']));
		$email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no       = ucwords(mysqli_real_escape_string($conn, $_POST['house_no']));
		$street_name    = ucwords(mysqli_real_escape_string($conn, $_POST['street_name']));
		$purok          = ucwords(mysqli_real_escape_string($conn, $_POST['purok']));
		$zone           = ucwords(mysqli_real_escape_string($conn, $_POST['zone']));
		$barangay       = ucwords(mysqli_real_escape_string($conn, $_POST['barangay']));
		$municipality   = ucwords(mysqli_real_escape_string($conn, $_POST['municipality']));
		$province       = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
		$region         = ucwords(mysqli_real_escape_string($conn, $_POST['region']));

		$file             = basename($_FILES["fileToUpload"]["name"]);

		$check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id'");
		if(mysqli_num_rows($check_email) > 0) {
	       displayErrorMessage("Email already exists.", $page);
		} else {
			if(empty($file)) {
				$update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', specialization='$specialization', clinic_name='$clinic_name', clinic_services='$clinic_services', user_type='$user_type' WHERE user_Id='$user_Id' ");
				displayUpdateMessage($update, $page);
			} else {
				// Check if image file is a actual image or fake image
				$target_dir = "../images-users/";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check == false) {
				    displayErrorMessage("File is not an image.", $page);
					$uploadOk = 0;
				} 

				// Check file size // 500KB max size
				elseif ($_FILES["fileToUpload"]["size"] > 500000) {
				    displayErrorMessage("File must be up to 500KB in size.", $page);
					$uploadOk = 0;
				}

				// Allow certain file formats
				elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
				    $uploadOk = 0;
				}

				// Check if $uploadOk is set to 0 by an error
				elseif ($uploadOk == 0) {
					displayErrorMessage("Your file was not uploaded.", $page);
				// if everything is ok, try to upload file
				} else {

					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					 $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', specialization='$specialization', clinic_name='$clinic_name', clinic_services='$clinic_services', user_type='$user_type', image='$file' WHERE user_Id='$user_Id' ");
              	     displayUpdateMessage($update, $page);
					} else {
	    	            displayErrorMessage("There was an error uploading your profile picture.", $page);
					}
				}
			}
		}
	}





	// CHANGE ADMIN PASSWORD - ADMIN/ADMIN_DELETE.PHP
	function changePassword($conn, $user_Id, $OldPassword, $password, $cpassword, $page) {

	    $check_old_password = mysqli_query($conn, "SELECT * FROM users WHERE password='$OldPassword' AND user_Id='$user_Id'");

	    if (mysqli_num_rows($check_old_password) === 1) {
	        if ($password != $cpassword) {
	            displayErrorMessage("Password did not match.", $page);
	        } else {
	            $update = mysqli_query($conn, "UPDATE users SET password='$password' WHERE user_Id='$user_Id'");
	            displayUpdateMessage($update, $page);
	        }
	    } else {
	    	displayErrorMessage("Old password is incorrect.", $page);
	    }
	}




	// UPDATE ADMIN PROFILE - ADMIN/PROFILE.PHP || || USER/PROFILE.PHP
	function updateProfileAdmin($conn, $user_Id, $page) {
	    $file = basename($_FILES["fileToUpload"]["name"]);
	    $target_dir = "../images-users/";
	    $target_file = $target_dir . $file;
	    $uploadOk = 1;
	    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if ($check === false) {
	        displayErrorMessage("Selected file is not an image.", $page);
	    }

	    if ($_FILES["fileToUpload"]["size"] > 500000) {
	        displayErrorMessage("File must be up to 500KB in size.", $page);
	    }

	    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
	        displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	    }

	    if ($_FILES["fileToUpload"]["error"] != 0) {
	        displayErrorMessage("Your file was not uploaded.", $page);
	    }

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $update = mysqli_query($conn, "UPDATE users SET image='$file' WHERE user_Id='$user_Id'");
	        displayUpdateMessage($update, $page);
	    } else {
	        displayErrorMessage("There was an error uploading your file.", $page);
	    }
	}




	// UPDATE ADMIN INFO - ADMIN/PROFILE.PHP || USER/PROFILE.PHP
	function updateProfileInfo($conn, $user_Id, $page) {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = ucwords(mysqli_real_escape_string($conn, $_POST['age']));
		$birthplace     = ucwords(mysqli_real_escape_string($conn, $_POST['birthplace']));
		$gender         = ucwords(mysqli_real_escape_string($conn, $_POST['gender']));
		$civilstatus    = ucwords(mysqli_real_escape_string($conn, $_POST['civilstatus']));
		$occupation     = ucwords(mysqli_real_escape_string($conn, $_POST['occupation']));
		$religion       = ucwords(mysqli_real_escape_string($conn, $_POST['religion']));
		$email          = mysqli_real_escape_string($conn, $_POST['email']);
		$contact        = mysqli_real_escape_string($conn, $_POST['contact']);
		$house_no       = ucwords(mysqli_real_escape_string($conn, $_POST['house_no']));
		$street_name    = ucwords(mysqli_real_escape_string($conn, $_POST['street_name']));
		$purok          = ucwords(mysqli_real_escape_string($conn, $_POST['purok']));
		$zone           = ucwords(mysqli_real_escape_string($conn, $_POST['zone']));
		$barangay       = ucwords(mysqli_real_escape_string($conn, $_POST['barangay']));
		$municipality   = ucwords(mysqli_real_escape_string($conn, $_POST['municipality']));
		$province       = ucwords(mysqli_real_escape_string($conn, $_POST['province']));
		$region         = ucwords(mysqli_real_escape_string($conn, $_POST['region']));
		$specialization = isset($_POST['specialization']) ? ucwords(mysqli_real_escape_string($conn, $_POST['specialization'])) : '';
		$clinic_name = isset($_POST['clinic_name']) ? ucwords(mysqli_real_escape_string($conn, $_POST['clinic_name'])) : '';
		$clinic_services = isset($_POST['clinic_services']) ? ucwords(mysqli_real_escape_string($conn, $_POST['clinic_services'])) : '';

		



	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND user_Id !='$user_Id' ");
		if(mysqli_num_rows($check_email) > 0 ) {
		   $_SESSION['message'] = "";
	       displayErrorMessage("Email already exists!", $page);
		} else {
		  $update = mysqli_query($conn, "UPDATE users SET firstname='$firstname', middlename='$middlename', lastname='$lastname', suffix='$suffix', dob='$dob', age='$age', email='$email', contact='$contact', birthplace='$birthplace', gender='$gender', civilstatus='$civilstatus', occupation='$occupation', religion='$religion', house_no='$house_no', street_name='$street_name', purok='$purok', zone='$zone', barangay='$barangay', municipality='$municipality', province='$province', region='$region', specialization='$specialization', clinic_name='$clinic_name', clinic_services='$clinic_services' WHERE user_Id='$user_Id' ");

      	  displayUpdateMessage($update, $page);
		}
	}




	// UPDATE SCHEDULES - SCHEDULES.PHP
	// function updateSchedule($conn, $page, $sched_ID, $activity, $schedule) {
	//     $checkQuery = mysqli_query($conn, "SELECT * FROM schedule WHERE sched_ID != '$sched_ID' AND activity = '$activity' AND schedule = '$schedule'");
	//     $existingActivity = mysqli_fetch_assoc($checkQuery);

	//     if ($existingActivity) {
	//     	displayErrorMessage("Activity already exists for the user!", $page); 
	//     } else {
	//         $update = mysqli_query($conn, "UPDATE schedule SET activity='$activity', schedule='$schedule' WHERE sched_ID=$sched_ID");
	//         displayUpdateMessage($update, $page);
	//     }
	// }
	function updateSchedule($conn, $page, $sched_ID, $activity, $schedule) {
	    $checkQuery = mysqli_query($conn, "SELECT * FROM schedule WHERE sched_ID != '$sched_ID' AND DATE(schedule) = DATE('$schedule')");
	    $clash = false;

	    while ($existingActivity = mysqli_fetch_assoc($checkQuery)) {
	        $existingStartTime = strtotime($existingActivity['schedule']);
	        $newStartTime = strtotime($schedule);

	        $existingEndTime = strtotime($existingActivity['schedule'] . ' +1 hour'); // Assuming each activity lasts for 1 hour, adjust accordingly
	        $newEndTime = strtotime($schedule . ' +1 hour'); // Adjust accordingly

	        // Check for time clash
	        if (($existingStartTime <= $newStartTime && $newStartTime < $existingEndTime) ||
	            ($existingStartTime < $newEndTime && $newEndTime <= $existingEndTime)) {
	            $clash = true;
	            break;
	        }
	    }

	    if ($clash) {
	        displayErrorMessage("Selected date and time overlap with an existing event!", $page);
	    } else {
	        $update = mysqli_query($conn, "UPDATE schedule SET activity='$activity', schedule='$schedule' WHERE sched_ID=$sched_ID");
	        displayUpdateMessage($update, $page);
	    }
	}



	function updateAppointment($conn, $page, $appt_ID, $purpose, $appt_date) {
	    $checkQuery = mysqli_query($conn, "SELECT * FROM appointment WHERE TIME(appt_date) = TIME('$appt_date') AND status = 1 AND appt_ID != $appt_ID");

	    if (mysqli_num_rows($checkQuery)) {
	        displayErrorMessage("There is already an appointment set at this time.", $page);
	    } else {
	        $update = mysqli_query($conn, "UPDATE appointment SET purpose='$purpose', appt_date='$appt_date' WHERE appt_ID=$appt_ID");
	        displayUpdateMessage($update, $page);
	    }
	}



	function updateAppointmentStatus($conn, $page, $appt_ID, $status, $rejection_msg) {
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

		if($status == 1) {
		    $subject = "Approved appointment";
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
	        send_Email($subject, $message, $email, "appointment.php");
			$update = mysqli_query($conn, "UPDATE appointment SET status='$status' WHERE appt_ID=$appt_ID");
	        
		} else {
			$subject = "Rejected appointment";
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
						<p style="color: #666; margin-bottom: 15px;">The appointment schedule you have set on '.$appt_date.' with Doctor '.$name2.', and with a purpose of, '.$purpose.' has been rejected.</p>
						<p style="color: #666; margin-bottom: 15px;">Reason for rejection: '.ucwords($rejection_msg).'</p>
	                    <!-- Add more paragraphs or customize as needed -->

	                    <!-- Closing note -->
	                    <p style="color: #666;"><strong>NOTE:</strong> This is a system-generated email. Please do not reply.</p>
	                </div>

	            </body>
	            </html>
	        ';
	        send_Email($subject, $message, $email, "appointment.php");
			$update = mysqli_query($conn, "UPDATE appointment SET status='$status', rejection_msg='$rejection_msg' WHERE appt_ID=$appt_ID");
		}
		displayUpdateMessage($update, $page);

	}


	// CONTACT EMAIL MESSAGING
	function send_Email($subject, $message, $recipientEmail, $page) {
	    $mail = new PHPMailer(true);
	    try {
	        // Server settings
	        $mail->isSMTP();
	        $mail->Host = 'smtp.gmail.com';
	        $mail->SMTPAuth = true;
	        $mail->Username = 'tatakmedellin@gmail.com';
	        $mail->Password = 'nzctaagwhqlcgbqq';
	        $mail->SMTPOptions = array(
	            'ssl' => array(
	                'verify_peer' => false,
	                'verify_peer_name' => false,
	                'allow_self_signed' => true
	            )
	        );
	        $mail->SMTPSecure = 'ssl';
	        $mail->Port = 465;

	        // Send Email
	        $mail->setFrom('tatakmedellin@gmail.com', 'System name no-reply');

	        // Recipients
	        $mail->addAddress($recipientEmail);
	        $mail->addReplyTo('tatakmedellin@gmail.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $subject;
	        $mail->Body = $message;

	        $mail->send();

	        $_SESSION['message'] = "Email sent successfully!";
			$_SESSION['text'] = "Sent successfully!";
			$_SESSION['status'] = "success";
			header("Location: $page");

	    } catch (Exception $e) {
	        $_SESSION['message'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	        header("Location: $page");
	    }
	}




?>



