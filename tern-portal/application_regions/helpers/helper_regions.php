<?php

function validCoords($coords)
{
	$valid = false;
	$coordinates = preg_replace("/\s+/", " ", trim($coords));
	if( preg_match('/^(\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?)( (\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?))*$/', $coordinates) )
	{
		$valid = true;
	} 
	return $valid;
}

?>
