<?php 
	include '../config.php';

	// DELETE USER - USERS_DELETE.PHP
	if (isset($_POST['delete_appointment'])) {
	    $appt_ID = $_POST['appt_ID'];
	    $update = mysqli_prepare($conn, "UPDATE appointment SET is_deleted=1 WHERE appt_ID = ?");
	    mysqli_stmt_bind_param($update, "i", $appt_ID);
	    mysqli_stmt_execute($update);

	    if (mysqli_stmt_affected_rows($update) > 0) {
	        $_SESSION['message'] = "Record has been deleted!";
	        $_SESSION['text'] = "Deleted successfully!";
	        $_SESSION['status'] = "success";
	        header("Location: appointment.php");
	    } else {
	        $_SESSION['message'] = "Deletion failed!";
	        $_SESSION['text'] = "Please try again.";
	        $_SESSION['status'] = "error";
	        header("Location: appointment.php");
	    }
	}



?>




