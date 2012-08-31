<?php

function checkValidCoords($coords)
{
	$valid = false;
	$coordinates = preg_replace("/\s+/", " ", trim($coords));
	if( preg_match('/^(\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?)( (\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?))*$/', $coordinates) )
	{
		$valid = true;
	} 
	return $valid;
}

function getRegionIndexId($arr_obj){
    foreach($arr_obj as $region){
        $index_id_arr[] = $region->l_id . ":" . $region->r_id;
    }   
    return $index_id_arr;
}
?>
