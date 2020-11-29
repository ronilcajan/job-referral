<?php 
	include '../server/server.php';

    $validation = array('success' => false, 'message' => array());
    
	$username 		= $conn->real_escape_string($_POST['username']);
	$password   	= md5($conn->real_escape_string($_POST['password']));
	$user_type   	= $conn->real_escape_string($_POST['user-type']);
	$id 	        = $conn->real_escape_string($_POST['user_id']);

    if(!empty($id)){
        $update = "UPDATE user SET username='$username', `password`='$password', user_type='$user_type' WHERE id=$id";
        $update_res  = $conn->query($update);

        if($update_res === true){
            $validation['message'] = 'User information has been updated!';
            $validation['success'] = true;
        }else{
            $validation['message'] = 'User not updated!';
            $validation['success'] = false;
        }

    }else{
        $insert = "INSERT INTO user (username,`password`, user_type) VALUES ('$username', '$password','$user_type');";
        $insert_res  = $conn->query($insert);

        if($insert_res === true){
            $validation['message'] = 'User information has been save!';
            $validation['success'] = true;
        }else{
            $validation['message'] = 'User not save!';
            $validation['success'] = false;
        }

    }
	
	$conn->close();

	echo json_encode($validation);