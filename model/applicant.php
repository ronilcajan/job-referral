<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$name 		= $conn->real_escape_string($_POST['name']);
	$address 	= $conn->real_escape_string($_POST['address']);
	$contact	= $conn->real_escape_string($_POST['contact']);
	$gender 	= $conn->real_escape_string($_POST['gender']);
	$bday 	    = $conn->real_escape_string($_POST['bday']);
	$educ_level = $conn->real_escape_string($_POST['educ_level']);
    $course 	= $conn->real_escape_string($_POST['course']);
    $work_ex 	= $conn->real_escape_string($_POST['work_ex']);
    $img 		= $_FILES['profile_img']['name'];
    
    if(isset($_POST['id_no'])){
		$id 	= $conn->real_escape_string($_POST['id_no']);
		$status	= $conn->real_escape_string($_POST['status']);
	}else{
		$id='';
    }
    
	// change img name
	$newimg = date('dmYHis').str_replace(" ", "", $img);

	// image file directory
  	$target = "../uploads/avatar/".basename($newimg);

  	// suppurted file
	$supported_image = array('image/gif', 'image/jpg', 'image/jpeg', 'image/png');

	$sql		= "SELECT id FROM applicants WHERE id='$id'";
	$result 	= $conn->query($sql);

	if($result->num_rows > 0){

		if(!empty($img) && in_array($_FILES['profile_img']['type'], $supported_image)){
			$update  = "UPDATE applicants SET `name`='$name', contact_num=$contact, `address`='$address', gender='$gender', birthday='$bday', course='$course', experience='$work_ex', educ_level='$educ_level', status='$status',`image`='$newimg' WHERE id='$id'";
			$update_res  = $conn->query($update);

			if($update_res === true){
				$validation['message'] = 'Applicant information has been saved!';
				$validation['success'] = true;

				if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target)){
					$validation['message'] = 'Applicant image has been saved!';
					$validation['success'] = true;
				}
			}else{
				$validation['message'] = 'Applicant not save!';
				$validation['success'] = false;
			}

		}else{
			$update  = "UPDATE applicants SET `name`='$name', contact_num=$contact, `address`='$address', gender='$gender', birthday='$bday', course='$course', experience='$work_ex', educ_level='$educ_level', `status`='$status' WHERE id='$id'";
			$update_res  = $conn->query($update);

			if($update_res === true){
				$validation['message'] = 'Applicant information has been updated!';
				$validation['success'] = true;
			}else{
				$validation['message'] = 'Applicant not save!';
				$validation['success'] = false;
			}
		}
	}else{
		if(!empty($img) && in_array($_FILES['profile_img']['type'], $supported_image)){
			$insert 	= "INSERT INTO applicants (`name`, `contact_num`, `address`, gender, birthday, course, experience, educ_level, `image`) VALUES ('$name', $contact, '$address', '$gender', '$bday', '$course', '$work_ex', '$educ_level', '$newimg')";	
			$insert_res 	= $conn->query($insert);

			if($insert_res === true){
				if(move_uploaded_file($_FILES['profile_img']['tmp_name'], $target)){
					$validation['message'] = 'Applicant image has been saved!';
					$validation['success'] = true;
				}
				$validation['message'] = 'Applicant information has been saved!';
				$validation['success'] = true;
			}else{
				$validation['message'] = 'Applicant not save!';
				$validation['success'] = false;
			}

		}else{
			$insert 	= "INSERT INTO applicants (`name`, `contact_num`, `address`, gender, birthday, course, experience, educ_level) VALUES ('$name', $contact,' $address', '$gender', '$bday', '$course', '$work_ex', '$educ_level')";	
			$insert_res 	= $conn->query($insert);
			if($insert_res === true){
				$validation['message'] = 'Applicant information has been saved!';
				$validation['success'] = true;
			}else{
				$validation['message'] = 'Product not save!';
				$validation['success'] = false;
			}
		}
		
	}

	$conn->close();

	echo json_encode($validation);

