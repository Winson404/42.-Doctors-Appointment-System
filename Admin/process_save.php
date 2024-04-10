<?php 
	include '../config.php';
	// include('../phpqrcode/qrlib.php');
	include '../includes/function_create.php';
	

	// SAVE ADMIN - ADMIN_MGMT.PHP
	if (isset($_POST['create_admin'])) {
	    $user_type = 2;
	    $specialization = $_POST['specialization'];
	    $clinic_name = $_POST['clinic_name'];
	    $clinic_services = $_POST['clinic_services'];
	    $path = "../images-users/";
	    saveUser($conn, "admin_mgmt.php?page=create", $user_type, $specialization, $clinic_name, $clinic_services, $path);
	}


	// SAVE USERS - USERS_MGMT.PHP
	if (isset($_POST['create_user'])) {
		$user_type = 0;
		$specialization = '';
	    $clinic_name = '';
	    $clinic_services = '';
		$path = "../images-users/";
	    saveUser($conn, "users_mgmt.php?page=create", $user_type, $specialization, $clinic_name, $clinic_services, $path);
	}


	// SAVE SECRETARY - SECRETARY_MGMT.PHP
	if (isset($_POST['create_secretary'])) {
		$user_type = 1;
		$specialization = '';
	    $clinic_name = '';
	    $clinic_services = '';
		$path = "../images-users/";
	    saveUser($conn, "secretary_mgmt.php?page=create", $user_type, $specialization, $clinic_name, $clinic_services, $path);
	}


	// SAVE SCHEDULES - SCHEDULES.PHP
	if (isset($_POST['create_schedule'])) {
		$user_ID = $_POST['user_ID'];
		$activity = mysqli_real_escape_string($conn, $_POST['activity']);
		$schedule = $_POST['schedule'];
	    saveSchedule($conn, "schedules.php", $user_ID, $activity, $schedule);
	}





	// DATABASE RESTORATION - RESTORE.PHP
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['restore'])) {
	    $file = $_FILES['fileToRestore']['tmp_name'];
	    if (!$file) {
	        die("Please choose a file to restore.");
	    }
	    $sql = file_get_contents($file);
	    $queries = explode(';', $sql);
	    foreach ($queries as $query) {
	        if (!empty(trim($query))) {
	            $result = mysqli_query($conn, $query);
	            if (!$result) {
	                die("Error executing SQL query: " . mysqli_error($conn));
	            }
	        }
	    }
	    $_SESSION['message'] = "Database restoration successful";
		$_SESSION['text'] = "Sent successfully!";
		$_SESSION['status'] = "success";
		header("Location: restore.php");
	}

	
	
?>



