<?php
/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simple to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */
 
// DB table to use
$table = 'applicants';
 
// Table's primary key
$primaryKey = 'id';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 
        'db' => 'id', 
        'dt' => 0
    ),
    array( 
        'db' => 'name', 
        'dt' => 1, 
        'formatter' => function($d, $row){
            return '<a href="applicant_details.php?id='.$row[0].'" >'.$d.'</a>';
        }
    ),

    array( 
        'db' => 'address', 
        'dt' => 2
    ),

    array( 
        'db' => 'contact_num',   
        'dt' => 3
    ),
    array( 
        'db' => 'course',   
        'dt' => 4
    ),
    array( 
        'db' => 'status',   
        'dt' => 5,
        'formatter' => function( $d, $row ) {
            if($d=='New Applicant'){
                return '<span class="badge badge-primary">'.$d.'</span>';
            }else{
                return '<span class="badge badge-success">'.$d.'</span>';
            }
            
        }
    ),
    array( 
        'db' => 'id',
        'dt' => 6, 
        'formatter' => function( $d, $row ) {
            return '
            <a type="button" href="applicant_details.php?id='.$row[0].'" class="btn btn-link text-info"><span class=""><i class="fa fa-eye"> </i></span> View</a> |
            <button type="button" class="btn btn-link edit_applicant text-success" id="'.$d.'"><span class=""><i class="fa fa-edit"> </i></span> Edit</button> |
            <button type="button" class="btn btn-link remove_applicant text-danger" id="'.$d.'"><span class=""><i class="fa fa-minus-circle"> </i></span> Remove</button>
            ';
        }
    ),

);
 
// SQL server connection information
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'agency',
    'host' => 'localhost'
);
 
 
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */
// $joinQuery = "FROM sales JOIN customers ON sales.customer_id=customers.customer_id";
// $extraCondition = "`id_client`=".$ID_CLIENT_VALUE;
require( '../assets/plugins/datatables/ssp.class.php' );
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns)
);
