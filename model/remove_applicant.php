<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$id 	= $conn->real_escape_string($_POST['id']);


	if($id != ''){
		$query 		= "DELETE FROM applicants WHERE id = '$id'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
			$validation['message'] = 'Applicant has been removed!';
			$validation['success'] = true;
		}else{
			$validation['message'] = 'Applicant cannot removed!';
			$validation['success'] = false;
		}
	}else{
		$validation['message'] = 'Missing Applicant number!';
		$validation['success'] = false;
	}

	$conn->close();

	echo json_encode($validation);

