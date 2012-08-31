<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../_includes/init.php';
require '../orca_init.php';
require '../_functions/assoc_array2xml.php';

global $gCNN_DBS_ORCA;
set_time_limit(0);

	$resultSet = null;
	$strQuery = 'SELECT registry_object_key FROM dba.vw_registry_search WHERE status=$1';
	$params = array('PUBLISHED');
	$resultSet = executeQuery($gCNN_DBS_ORCA, $strQuery, $params);
$keys = array();

//print_r($resultSet);
foreach($resultSet as $col => $keyArr){
   foreach( $keyArr as $rubbish => $key){
        array_push($keys,$key);
   }
}

addKeysToSolrIndex($keys, true);
print_r(error_get_last());
//$response['responsecode'] = "1";
//echo json_encode($response);



?>
