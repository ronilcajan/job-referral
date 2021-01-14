<?php
include '../server/server.php';

if(!isset($_GET['searchTerm'])){ 
    $json = [];
}else{
    $search = $_GET['searchTerm'];
    $sql = "SELECT ref_no, company_name FROM jobs 
            WHERE NOT status='Closed' AND ref_no LIKE '%".$search."%'
            LIMIT 10"; 
    $result = $conn->query($sql);
    $json = [];
    while($row = $result->fetch_assoc()){
        $json[] = ['id'=>$row['ref_no'], 'text'=>$row['company_name']];
    }
}

echo json_encode($json);