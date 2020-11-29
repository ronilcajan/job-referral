<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array(), 'applicant' => array());
	$id = $conn->real_escape_string($_POST['id']);

	$sql 	= "SELECT * FROM applicants WHERE id='$id'";

	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$validation['applicant'] = $row; 
		}
		$validation['success'] = true;
		$validation['message'] = 'Applicant found!';

	}else{

		$validation['success'] = false;
		$validation['message'] = 'No Applicant found!';
	
	}

	$conn->close();
	echo json_encode($validation);
