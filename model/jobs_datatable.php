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
$table = 'jobs';
 
// Table's primary key
$primaryKey = 'ref_no';
 
// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
    array( 
        'db' => 'ref_no', 
        'dt' => 0
    ),
    array( 
        'db' => 'company_name', 
        'dt' => 1, 
        'formatter' => function($d, $row){
            return '<a href="job_details.php?ref_no='.$row[0].'" >'.$d.'</a>';
        }
    ),
    array( 
        'db' => 'job_description', 
        'dt' => 2
    ),
    array( 
        'db' => 'count',   
        'dt' => 3
    ),
    array( 
        'db' => 'experience',   
        'dt' => 4
    ),
    array( 
        'db' => 'course',   
        'dt' => 5,
        'formatter' => function($d, $row){
            return $d.' - '.$row[9];
        }
    ),
    array( 
        'db' => 'qualification',   
        'dt' =>6
    ),
    array( 
        'db' => 'status',   
        'dt' => 7,
        'formatter' => function( $d, $row ) {
            if($d=='Active'){
                return '<span class="badge badge-info">'.$d.'</span>';
            }else{
                return '<span class="badge badge-danger">'.$d.'</span>';
            }
            
        }
    ),
    array( 
        'db' => 'ref_no',
        'dt' => 8, 
        'formatter' => function( $d, $row ) {
            return '
            <a type="button" href="job_details.php?ref_no='.$row[0].'" class="btn btn-link text-info"><span class=""><i class="fa fa-eye"> </i></span></a> |
            <button type="button" class="btn btn-link edit_jobs text-success" id="'.$d.'"><span class=""><i class="fa fa-edit"> </i></span></button> |
            <button type="button" class="btn btn-link remove_jobs text-danger" id="'.$d.'"><span class=""><i class="fa fa-minus-circle"> </i></span> </button>
        ';
        }
    ),
    array( 
        'db' => 'educ_level',   
        'dt' => 9
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
