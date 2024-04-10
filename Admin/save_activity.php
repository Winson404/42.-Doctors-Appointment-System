<?php 
    include '../config.php';

    $user_ID = $_POST['user_ID'];
    $date = $_POST['date'];
    $activityName = $_POST['activityName'];

    // Check for existing event on the selected date and user_ID
    $check = mysqli_query($conn, "SELECT * FROM schedule WHERE user_ID = $user_ID AND DATE(schedule) = '$date'");
    $clash = false;

    while ($row = mysqli_fetch_array($check)) {
        $existingStartTime = strtotime($row['schedule']);
        $newStartTime = strtotime($date);

        $existingEndTime = strtotime($row['schedule'] . ' +1 hour'); // Assuming each activity lasts for 1 hour, adjust accordingly
        $newEndTime = strtotime($date . ' +1 hour'); // Adjust accordingly

        // Check for time clash
        if (($existingStartTime <= $newStartTime && $newStartTime < $existingEndTime) ||
            ($existingStartTime < $newEndTime && $newEndTime <= $existingEndTime)) {
            $clash = true;
            break;
        }
    }

    if (!$clash) {
        // Perform the database insertion here
        $insertQuery = "INSERT INTO schedule (user_ID, activity, schedule) VALUES ($user_ID, '$activityName', '$date')";
        $result = mysqli_query($conn, $insertQuery);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Activity saved successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save activity']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Selected date and time overlap with an existing event']);
    }
?>
