<?php 
	$id = $_GET['id'];
	
	$query = "SELECT * FROM applicants WHERE id='$id'";

	$result = $conn->query($query);
	$row = $result->fetch_assoc();

	$name 		= $row['name'];
	$address 	= $row['address'];
	$gender		= $row['gender'];
	$number 	= $row['contact_num'];
	$course		= $row['course'];
    $pic 		= $row['image'];
    $exp		= $row['experience'];
	$educ 	    = $row['educ_level'];
    $status		= $row['status'];
    $bday		= $row['birthday'];


