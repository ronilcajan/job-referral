<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$id 	= $conn->real_escape_string($_POST['id']);


	if($id != ''){
		$query 		= "DELETE FROM jobs WHERE ref_no = '$id'";
		
		$result 	= $conn->query($query);
		
		if($result === true){
			$validation['message'] = 'Job has been removed!';
			$validation['success'] = true;
		}else{
			$validation['message'] = 'Job cannot removed!';
			$validation['success'] = false;
		}
	}else{
		$validation['message'] = 'Missing job referral number!';
		$validation['success'] = false;
	}

	$conn->close();

	echo json_encode($validation);

