<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$job_des 	= $conn->real_escape_string($_POST['job_des']);
	$com_name 	= $conn->real_escape_string($_POST['com_name']);
	$count 		= $conn->real_escape_string($_POST['count']);
	$gender		= $conn->real_escape_string($_POST['gender']);
	$work_ex 	= $conn->real_escape_string($_POST['work_ex']);
	$educ_level = $conn->real_escape_string($_POST['educ_level']);
	$course 	= $conn->real_escape_string($_POST['course']);
	$qualification 	= $conn->real_escape_string($_POST['qualification']);
	if(isset($_POST['ref_no'])){
		$ref_no 	= $conn->real_escape_string($_POST['ref_no']);
		$status		= $conn->real_escape_string($_POST['status']);
	}else{
		$ref_no='';
	}
	if($ref_no != ''){
		$sql		= "SELECT ref_no FROM jobs WHERE ref_no=$ref_no";
		$result 	= $conn->query($sql);

		if($result->num_rows > 0){
			$update  = "UPDATE jobs SET company_name='$com_name', job_description='$job_des', `count`=$count, gender='$gender', experience='$work_ex', educ_level='$educ_level', 
						course='$course', qualification='$qualification',`status`='$status' WHERE ref_no='$ref_no'";
			$update_jobs  = $conn->query($update);

			if($update_jobs === true){
				$validation['message'] = 'Jobs information has been updated!';
				$validation['success'] = true;
			}else{
				$validation['message'] = 'Job not updated!';
				$validation['success'] = false;
			}
		}else{
			$validation['message'] = 'No jobs has the referral no.'.$ref_no;
			$validation['success'] = false;
		}
	}else{
		$insert 	= "INSERT INTO jobs (company_name, job_description, `count`, gender, experience, educ_level, course, qualification) 
						VALUES ($com_name', '$job_des', $count , '$gender', '$work_ex', '$educ_level', '$course', '$qualification')";	
		$insert_res 	= $conn->query($insert);

		if($insert_res === true){
			$validation['message'] = 'Job information has been saved!';
			$validation['success'] = true;
		}else{
			$validation['message'] = 'Job not save!';
			$validation['success'] = false;
		}
	}
	

	$conn->close();

	echo json_encode($validation);

?>