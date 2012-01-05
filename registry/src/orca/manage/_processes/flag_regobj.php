<?php
/*
Copyright 2009 The Australian National University
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*******************************************************************************/
if (!IN_ORCA) die('No direct access to this file is permitted.');


$key = rawurldecode(getQueryValue("key"));
if ($key)
{
	$flag = getQueryValue("flag");
	if (in_array($flag, array("true","false")))
	{
		global $gCNN_DBS_ORCA;
        $strQuery = 'UPDATE dba.tbl_registry_objects SET flag = $1 WHERE registry_object_key = $2';
        $params = array($flag, $key);
        $resultSet = @executeQuery($gCNN_DBS_ORCA, $strQuery, $params);	  		
	}
}