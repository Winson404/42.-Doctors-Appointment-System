<?php 

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	// require '../vendor/PHPMailer/src/Exception.php';
	// require '../vendor/PHPMailer/src/PHPMailer.php';
	// require '../vendor/PHPMailer/src/SMTP.php';
	if (!class_exists('PHPMailer\PHPMailer\Exception')) { require __DIR__ . '/../vendor/PHPMailer/src/Exception.php'; }
	if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) { require __DIR__ . '/../vendor/PHPMailer/src/PHPMailer.php'; }
	if (!class_exists('PHPMailer\PHPMailer\SMTP')) { require __DIR__ . '/../vendor/PHPMailer/src/SMTP.php'; }

	
	// SAVE SYSTEM USERS - ADMIN/ADMIN_MGMT.PHP || ADMIN/USERS_MGMT.PHP
	function saveUser($conn, $page, $user_type, $specialization, $clinic_name, $clinic_services, $path = "images-users/") {
		$firstname      = ucwords(mysqli_real_escape_string($conn, $_POST['firstname']));
		$middlename     = ucwords(mysqli_real_escape_string($conn, $_POST['middlename']));
		$lastname       = ucwords(mysqli_real_escape_string($conn, $_POST['lastname']));
		$suffix         = ucwords(mysqli_real_escape_string($conn, $_POST['suffix']));
		$dob            = ucwords(mysqli_real_escape_string($conn, $_POST['dob']));
		$age            = intval($_POST['age']);
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
		$password         = md5($_POST['password']);
		$file             = basename($_FILES["fileToUpload"]["name"]);

	    $check_email = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
	    if (mysqli_num_rows($check_email) > 0) {
	        displayErrorMessage("Email already exists!", $page);
	    } else {
	        $target_dir = $path;
	        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	        $uploadOk = 1;
	        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	        if ($check == false) {
	            displayErrorMessage("File is not an image.", $page);
	            $uploadOk = 0;
	        } elseif ($_FILES["fileToUpload"]["size"] > 500000) {
	            displayErrorMessage("File must be up to 500KB in size.", $page);
	            $uploadOk = 0;
	        } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
	            displayErrorMessage("Only JPG, JPEG, PNG & GIF files are allowed.", $page);
	            $uploadOk = 0;
	        } elseif ($uploadOk == 0) {
	            displayErrorMessage("Your file was not uploaded.", $page);
	        } else {
	            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	            	$save = mysqli_query($conn, "INSERT INTO users (firstname, middlename, lastname, suffix, dob, age, email, contact, birthplace, gender, civilstatus, occupation, religion, house_no, street_name, purok, zone, barangay, municipality, province, region, specialization, clinic_name, clinic_services, image, password, user_type) VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$dob', '$age', '$email', '$contact', '$birthplace', '$gender', '$civilstatus', '$occupation', '$religion', '$house_no', '$street_name', '$purok', '$zone', '$barangay', '$municipality', '$province', '$region', '$specialization', '$clinic_name', '$clinic_services', '$file', '$password', '$user_type')");

	            	displaySaveMessage($save, $page);
	            } else {
	            	displayErrorMessage("There was an error uploading your profile picture.", $page); 
	            }
	        }
	    }
	}


	// SAVE SCHEDULES - SCHEDULES.PHP
	// function saveSchedule($conn, $page, $user_ID, $activity, $schedule) {
	//     $checkQuery = mysqli_query($conn, "SELECT * FROM schedule WHERE user_ID = '$user_ID' AND activity = '$activity' AND schedule = '$schedule'");
	//     $existingActivity = mysqli_fetch_assoc($checkQuery);

	//     if ($existingActivity) {
	//     	displayErrorMessage("Activity already exists for the user!", $page); 
	//     } else {
	//         $save = mysqli_query($conn, "INSERT INTO schedule (user_ID, activity, schedule) VALUES ('$user_ID', '$activity', '$schedule')");
	//         displaySaveMessage($save, $page);
	//     }
	// }
	function saveSchedule($conn, $page, $user_ID, $activity, $schedule) {
	    $checkQuery = mysqli_query($conn, "SELECT * FROM schedule WHERE user_ID = '$user_ID' AND DATE(schedule) = DATE('$schedule')");
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
	        $save = mysqli_query($conn, "INSERT INTO schedule (user_ID, activity, schedule) VALUES ('$user_ID', '$activity', '$schedule')");
	        displaySaveMessage($save, $page);
	    }
	}




	
	function saveAppointment($conn, $page, $user_ID, $doctor_ID, $purpose, $appt_date) {
	    $checkQuery = mysqli_query($conn, "SELECT * FROM appointment WHERE patient_ID = '$user_ID' AND DATE(appt_date) = DATE('$appt_date') AND TIME(appt_date) = TIME('$appt_date') AND status = 1");

	    if (mysqli_num_rows($checkQuery)) {
	        displayErrorMessage("You have already set an appointment at this time.", $page);
	    } else {
	        $checkQuery2 = mysqli_query($conn, "SELECT * FROM appointment WHERE TIME(appt_date) = TIME('$appt_date') AND DATE(appt_date) = DATE('$appt_date') AND status = 1");

	        if (mysqli_num_rows($checkQuery2)) {
	            displayErrorMessage("There is already an appointment set at this time.", $page);
	        } else {
	            $save = mysqli_query($conn, "INSERT INTO appointment (patient_ID, doctor_ID, purpose, appt_date) VALUES ('$user_ID', '$doctor_ID', '$purpose', '$appt_date')");
	            displaySaveMessage($save, $page);
	        }
	    }
	}







	// CONTACT EMAIL MESSAGING
	function sendEmail($subject, $message, $recipientEmail, $page) {
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



	// CONTACT EMAIL MESSAGING
	function contactUs($conn, $name, $subject, $message, $email, $page) {
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
	        $mail->addAddress('sonerwin8@gmail.com');
	        $mail->addReplyTo('tatakmedellin@gmail.com');

	        // Content
	        $mail->isHTML(true);
	        $mail->Subject = $subject;
	        $mail->Body = $message;

	        $mail->send();

	        $_SESSION['success'] = "Email sent successfully!";
			header("Location: $page");

	    } catch (Exception $e) {
	        $_SESSION['success'] = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	        header("Location: $page");
	    }
	}


?>



