<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$id 	= $_POST['id'];

	if (!empty($id)) {
		$query	= "DELETE FROM user WHERE id='$id'";
		$result 	= $conn->query($query);
		if($result === true){

			$validation['message'] = 'User successfully deleted!';
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