<?php 
	include '../server/server.php';

	$validation = array('success' => false, 'message' => array());

	$job 	= $conn->real_escape_string($_POST['job_id']);
	$appl 	= $conn->real_escape_string($_POST['app_id']);

    if(!empty($job) && !empty($appl)){

    
        $sql		= "SELECT id FROM referral WHERE job_no=$job AND applicant_id=$appl";
        $result 	= $conn->query($sql);

        if(empty($result->num_rows)){
            $insert  = "INSERT INTO referral (applicant_id, job_no) VALUES ($appl,$job)";
            $referred  = $conn->query($insert);

            if($referred === true){

                $update = "UPDATE applicants SET status='Referred' WHERE id='$appl'";
                $conn->query($update);

                $validation['message'] = 'Applicant successfully referred!';
                $validation['success'] = true;
            }else{
                $validation['message'] = 'Applicant not referred!';
                $validation['success'] = false;
            }
        }else{
            $validation['message'] = 'Applicant already referred!';
            $validation['success'] = false;
        }
    }else{
        $validation['message'] = 'Empty form!';
        $validation['success'] = false;
    }

	$conn->close();

	echo json_encode($validation);

?>