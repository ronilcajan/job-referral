<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array(), 'jobs' => array());

	$ref = $conn->real_escape_string($_POST['ref_no']);

	$sql 	= "SELECT * FROM jobs WHERE ref_no='$ref'";

	$result = $conn->query($sql);

	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$validation['jobs'] = $row; 
		}
		$validation['success'] = true;
		$validation['message'] = 'A Job is found!';

	}else{

		$validation['success'] = false;
		$validation['message'] = 'No job found!';
	
	}

	$conn->close();
	echo json_encode($validation);
