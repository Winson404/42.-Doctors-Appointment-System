<?php 
	require_once '../config.php';
	require_once '../includes/function_update.php';


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




	// SAVE SCHEDULES - SCHEDULES.PHP
	if (isset($_POST['update_appointment'])) {
		$appt_ID = $_POST['appt_ID'];
		$purpose = mysqli_real_escape_string($conn, $_POST['purpose']);
		$appt_date = $_POST['appt_date'];
	    updateAppointment($conn, "appointment.php", $appt_ID, $purpose, $appt_date);
	}

	





?>
