<?php

if(!$_SESSION['username']){
    header("location: ../login.php");
}

// = for sidevar name and profile 
$username = $_SESSION['username'];
$query = "SELECT name,profile_img FROM user JOIN user_profile ON user.username=user_profile.username WHERE user.username='$username' LIMIT 1";
$result = $conn->query($query);
$row = $result->fetch_assoc();
if($row){
    $name = $row['name'];
    $image = $row['profile_img'];
}