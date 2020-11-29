<?php
include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$id 	= $_POST['id'];

	if (!empty($id)) {
		$query	= "UPDATE referral SET status = 'Hired' WHERE id='$id';";
        $result 	= $conn->query($query);
        
		if($result === true){

            $sql = "SELECT applicant_id FROM referral WHERE id='$id';";
            $app_id 	= $conn->query($sql);
            $row = $app_id->fetch_assoc();
            $id = $row['applicant_id'];
            $query	= "UPDATE applicants SET status = 'Hired' WHERE id=$id";
            $conn->query($query);

			$validation['message'] = 'Mark as Hired!';
			$validation['success'] = true;

		}else{
			$validation['message'] = 'Something went wrong!';
			$validation['success'] = false;
		}
	}else{
		$validation['message'] = 'Something went wrong!';
		$validation['success'] = false;
	}

	$conn->close();

	echo json_encode($validation);