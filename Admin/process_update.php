<?php 
	include '../config.php';
	include '../includes/function_update.php';

		
	// UPDATE ADMIN - ADMIN_MGMT.PHP
	if(isset($_POST['update_admin'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = 2;
		$specialization = $_POST['specialization'];
	    $clinic_name = $_POST['clinic_name'];
	    $clinic_services = $_POST['clinic_services'];
		updateSystemUser($conn, $user_Id, $user_type, $specialization, $clinic_name, $clinic_services, "admin_mgmt.php?page=".$user_Id);
	}



	// UPDATE USER - USERS_MGMT.PHP
	if(isset($_POST['update_user'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = 0;
		$specialization = '';
	    $clinic_name = '';
	    $clinic_services = '';
		updateSystemUser($conn, $user_Id, $user_type, $specialization, $clinic_name, $clinic_services, "users_mgmt.php?page=".$user_Id);
	}



	// UPDATE SECRETARY - SECRETARY_MGMT.PHP
	if(isset($_POST['update_secretary'])) {
		$user_Id		  = mysqli_real_escape_string($conn, $_POST['user_Id']);
		$user_type		  = 1;
		$specialization = '';
	    $clinic_name = '';
	    $clinic_services = '';
		updateSystemUser($conn, $user_Id, $user_type, $specialization, $clinic_name, $clinic_services, "secretary_mgmt.php?page=".$user_Id);
	}




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



	// UPDATE SCHEDULES - SCHEDULES.PHP
	if (isset($_POST['update_schedule'])) {
		$sched_ID = $_POST['sched_ID'];
		$activity = mysqli_real_escape_string($conn, $_POST['activity']);
		$schedule = $_POST['schedule'];
	    updateSchedule($conn, "schedules.php", $sched_ID, $activity, $schedule);
	}



	// UPDATE APPOINTMENT STATUS - APPOINTMENT.PHP
	if (isset($_POST['update_appointment'])) {
		$appt_ID = $_POST['appt_ID'];
		$status = $_POST['status'];
		$rejection_msg = mysqli_real_escape_string($conn, $_POST['rejection_msg']);
	    updateAppointmentStatus($conn, "appointment.php", $appt_ID, $status, $rejection_msg);
	}










?>
