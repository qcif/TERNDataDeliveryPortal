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
// Include required files and initialisation.
<<<<<<< HEAD
<<<<<<< HEAD

require '/var/www/htdocs/registry/global_config.php';

define('gRIF_SCHEMA_PATH', eAPPLICATION_ROOT.'/orca/schemata/registryObjects.xsd');
define('gRIF_SCHEMA_URI', 'http://services.ands.org.au/documentation/rifcs/1.3/schema/registryObjects.xsd');
define('gCURRENT_SCHEMA_VERSION', '1.3');
define('gDATA_SOURCE','NLA_PARTY');
define('gNLA_SRU_URI','http://www.nla.gov.au/apps/srw/search/peopleaustralia');
define('gSOLR_UPDATE_URL' , $solr_url . "update");

require '/var/www/htdocs/registry/_includes/_environment/database_env.php';
require '/var/www/htdocs/registry/_includes/_functions/database_functions.php';
require '/var/www/htdocs/registry/_includes/_functions/general_functions.php';
require '/var/www/htdocs/registry/_includes/_functions/access_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_data_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_data_source_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_export_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_access_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_import_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_cache_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_presentation_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_constants.php';

chdir("/var/www/htdocs/registry/orca/_includes");
function htmlNumericCharRefs($unsafeString)
{
        $safeString = str_replace("&", "&#38;", $unsafeString);
        $safeString = str_replace('"', "&#34;", $safeString);
        $safeString = str_replace("'", "&#39;", $safeString);
        $safeString = str_replace("<", "&#60;", $safeString);
        $safeString = str_replace(">", "&#62;", $safeString);
        return $safeString;
}
function esc($unsafeString, $forJavascript=false)
{
        $safeString = $unsafeString;
        if( $forJavascript )
        {
                $safeString = str_replace('\\', '\\\\', $safeString);
                $safeString = str_replace("'", "\\'", $safeString);
        }
        $safeString = htmlNumericCharRefs($safeString);
        $safeString = str_replace("\r", "", $safeString);
        $safeString = str_replace("\n", "&#xA;", $safeString);
        return $safeString;
}
=======
require '/var/www/home/_includes/_environment/database_env.php';
require '/var/www/home/_includes/_functions/database_functions.php';
require '/var/www/home/_includes/_functions/general_functions.php';
require '/var/www/home/_includes/_functions/access_functions.php';
require '/var/www/home/orca/_functions/orca_data_functions.php';
require '/var/www/home/orca/_functions/orca_data_source_functions.php';
require '/var/www/home/orca/_functions/orca_export_functions.php';
require '/var/www/home/orca/_functions/orca_access_functions.php';
require '/var/www/home/orca/_functions/orca_import_functions.php';
date_default_timezone_set('Antarctica/Macquarie'); 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

require '/var/www/htdocs/registry/global_config.php';

<<<<<<< HEAD
<<<<<<< HEAD

// Open a connection to the database.
// This will be closed automatically by the framework.
openDatabaseConnection($gCNN_DBS_ORCA, eCNN_DBS_ORCA);
=======
define('gRIF_SCHEMA_URI', 'http://services.ands.org.au/documentation/rifcs/1.2.0/schema/registryObjects.xsd');
define('gRIF_SCHEMA_URI', 'http://services.ands.org.au/documentation/rifcs/1.2.0/schema/registryObjects.xsd');
define('gCURRENT_SCHEMA_VERSION', '1.2.0');
=======
define('gRIF_SCHEMA_PATH', eAPPLICATION_ROOT.'/orca/schemata/registryObjects.xsd');
define('gRIF_SCHEMA_URI', 'http://services.ands.org.au/documentation/rifcs/1.3/schema/registryObjects.xsd');
define('gCURRENT_SCHEMA_VERSION', '1.3');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
define('gDATA_SOURCE','NLA_PARTY');
define('gNLA_SRU_URI','http://www.nla.gov.au/apps/srw/search/peopleaustralia');
define('gSOLR_UPDATE_URL' , $solr_url . "update");

require '/var/www/htdocs/registry/_includes/_environment/database_env.php';
require '/var/www/htdocs/registry/_includes/_functions/database_functions.php';
require '/var/www/htdocs/registry/_includes/_functions/general_functions.php';
require '/var/www/htdocs/registry/_includes/_functions/access_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_data_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_data_source_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_export_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_access_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_import_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_cache_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_presentation_functions.php';
require '/var/www/htdocs/registry/orca/_functions/orca_constants.php';

chdir("/var/www/htdocs/registry/orca/_includes");
function htmlNumericCharRefs($unsafeString)
{
        $safeString = str_replace("&", "&#38;", $unsafeString);
        $safeString = str_replace('"', "&#34;", $safeString);
        $safeString = str_replace("'", "&#39;", $safeString);
        $safeString = str_replace("<", "&#60;", $safeString);
        $safeString = str_replace(">", "&#62;", $safeString);
        return $safeString;
}
function esc($unsafeString, $forJavascript=false)
{
        $safeString = $unsafeString;
        if( $forJavascript )
        {
                $safeString = str_replace('\\', '\\\\', $safeString);
                $safeString = str_replace("'", "\\'", $safeString);
        }
        $safeString = htmlNumericCharRefs($safeString);
        $safeString = str_replace("\r", "", $safeString);
        $safeString = str_replace("\n", "&#xA;", $safeString);
        return $safeString;
}


// Open a connection to the database.
// This will be closed automatically by the framework.
openDatabaseConnection($gCNN_DBS_ORCA, eCNN_DBS_ORCA);

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794

$services = $argv[1];
$actions ='';
$partyIdentifiers = array();
$setIdentifiers = array();

// Get the required NLA party identifiers or the nlaset local registry_object_keys from the database.
if($services=="relatedNLA"){
	//returns a list of all nla identifiers that are related objects to collections, services or activities and are not registry objects
	$partyIdentifiers = getPartyIdentifiers();
}
elseif($services=="partyNLA"){
	//returns a list of all nla identifiers that are party identifiers 	 and are not registry objects
	$partyIdentifiers = getPartyNLAIdentifiers();
}
elseif($services=="setNLA"){
	//returns a list of all parties from the nla party set for harvest
	$setIdentifiers = getSpecialObjectSet("nlaSet","Party");
}

if($partyIdentifiers)
{
		$responseType = 'success';
		$runErrors = null;
		$actions = "";
		$errors = null;
		$startTime = microtime(true);

	foreach($partyIdentifiers as $partyIdentifier){
<<<<<<< HEAD
<<<<<<< HEAD

		$partyId = trim(str_replace("http://nla.gov.au/","",$partyIdentifier["partyIdentifier"]));

		$requestURI =  gNLA_SRU_URI."?query=rec.identifier=%22".$partyId."%22&version=1.1&operation=searchRetrieve&recordSchema=http%3A%2F%2Fands.org.au%2Fstandards%2Frif-cs%2FregistryObjects";

		$get = curl_init();
		curl_setopt($get, CURLOPT_URL, $requestURI);
		curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
		$ch = curl_exec($get);
		$curlinfo = curl_getinfo($get);
		curl_close($get);

=======
	
		$partyId = trim(str_replace("http://nla.gov.au/","",$partyIdentifier["partyIdentifier"]));		
			
=======

		$partyId = trim(str_replace("http://nla.gov.au/","",$partyIdentifier["partyIdentifier"]));

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$requestURI =  gNLA_SRU_URI."?query=rec.identifier=%22".$partyId."%22&version=1.1&operation=searchRetrieve&recordSchema=http%3A%2F%2Fands.org.au%2Fstandards%2Frif-cs%2FregistryObjects";

		$get = curl_init();
		curl_setopt($get, CURLOPT_URL, $requestURI);
		curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
		$ch = curl_exec($get);
		$curlinfo = curl_getinfo($get);
		curl_close($get);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


		// Get the xml data.
		$registryObjects = new DOMDocument();

		$domObjects = explode("recordData>",$ch);
		if(isset($domObjects[1])){
		$result = $registryObjects->loadXML(str_replace("</registryObjects></","</registryObjects>",($domObjects[1])));
		$registryObjects->xinclude();
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$errors = error_get_last();
		if( $errors )
		{
			$runErrors = "Document Load Error: ".$errors['message']."\n";
		}
<<<<<<< HEAD
<<<<<<< HEAD

		if( !$runErrors )
		{
		// run an XSLT transformation
			$registryObjects = transformToRif2($registryObjects);
			if($registryObjects == null)
			{
				$runErrors = "There was an error transforming the document to RIF-CS v1.2";
			}
		}

		if( !$runErrors )
		{

			 // Validate it against the orca schema.
			  // XXX: libxml2.6 workaround (Save to local filesystem before validating)

			  // Create temporary file and save manually created DOMDocument.
			  $tempFile = "/tmp/" . time() . '-' . rand() . '-document.tmp';
			  $registryObjects->save($tempFile);

			  // Create temporary DOMDocument and re-load content from file.
			  $registryObjects = new DOMDocument();
			  $registryObjects->load($tempFile);

=======
	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if( !$runErrors )
		{
		// run an XSLT transformation
			$registryObjects = transformToRif2($registryObjects);
			if($registryObjects == null)
			{
				$runErrors = "There was an error transforming the document to RIF-CS v1.2";
			}
		}

		if( !$runErrors )
		{

			 // Validate it against the orca schema.
			  // XXX: libxml2.6 workaround (Save to local filesystem before validating)

			  // Create temporary file and save manually created DOMDocument.
			  $tempFile = "/tmp/" . time() . '-' . rand() . '-document.tmp';
			  $registryObjects->save($tempFile);

			  // Create temporary DOMDocument and re-load content from file.
			  $registryObjects = new DOMDocument();
			  $registryObjects->load($tempFile);
<<<<<<< HEAD
			  
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			  // Delete temporary file.
			  if (is_file($tempFile))
			  {
			    unlink($tempFile);
			  }
<<<<<<< HEAD
<<<<<<< HEAD

=======
			  
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			// Validate it against the orca schema.
			$result = $registryObjects->schemaValidate(gRIF_SCHEMA_PATH);

			$errors = error_get_last();
			if( $errors )
			{
				$runErrors .= "Document Validation Error: ".$errors['message']."\n";
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD

		if( !$runErrors )
		{
=======
					
		if( !$runErrors )
		{	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		if( !$runErrors )
		{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			// Import the data.
			$runErrors = importRegistryObjects($registryObjects, gDATA_SOURCE, $runResultMessage,'SYSTEM','PUBLISHED');

			if(!$runErrors)
			{
				$actions .= ">>SUCCESS nla party imported with key ".$partyId."\n";
<<<<<<< HEAD
<<<<<<< HEAD
				
			}
		}


=======
			}		
		}

		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				
			}
		}


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if( $runErrors )
		{
			$actions .= ">>ERRORS\n";
			$actions .= $runErrors;
		}

	}
	$timeTaken = substr((string)(microtime(true) - $startTime), 0, 5);
	$actions  .= "Time Taken: $timeTaken seconds\n";
	}
<<<<<<< HEAD
<<<<<<< HEAD
	//echo $actions;
=======
	//echo $actions; 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	//echo $actions;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}
elseif($setIdentifiers)
{
	$startTime = microtime(true);
	$responseType = 'success';
	$runErrors = '';
	$runResultMessage = "";
	$actions = "";
<<<<<<< HEAD
<<<<<<< HEAD
	$errors = null;

=======
	$errors = null;	
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$errors = null;

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	foreach($setIdentifiers as $identifiers)
	{
		//this time we are querying NLA to see if a record has been matched. ie we are looking for an NLA record that has our local key as an identifier
		$requestURI =  gNLA_SRU_URI."?query=cql.anywhere+%3D+%22".urlencode($identifiers["registry_object_key"])."%22&version=1.1&operation=searchRetrieve&recordSchema=http%3A%2F%2Fands.org.au%2Fstandards%2Frif-cs%2FregistryObjects";
<<<<<<< HEAD
<<<<<<< HEAD

		$get = curl_init();
		curl_setopt($get, CURLOPT_URL, $requestURI);
		curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
		$ch = curl_exec($get);
		$curlinfo = curl_getinfo($get);
		curl_close($get);

		$numrecords = explode("numberOfRecords",$ch);
		$recordNum = str_replace("</","",str_replace(">","",$numrecords[1]));
		// Lets find out if there is a match made
		if($recordNum!="0"){
			// "we have found an NLA record with our local identifier we now need to see of it exists as a party record in our registry with the nla identifier as the key<br />";



			$returnObject = new DOMDocument();
			$object = $returnObject->loadXML($ch);

=======
		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$get = curl_init();
		curl_setopt($get, CURLOPT_URL, $requestURI);
		curl_setopt($get, CURLOPT_RETURNTRANSFER, true);
		$ch = curl_exec($get);
		$curlinfo = curl_getinfo($get);
		curl_close($get);

		$numrecords = explode("numberOfRecords",$ch);
		$recordNum = str_replace("</","",str_replace(">","",$numrecords[1]));
		// Lets find out if there is a match made
		if($recordNum!="0"){
			// "we have found an NLA record with our local identifier we now need to see of it exists as a party record in our registry with the nla identifier as the key<br />";



			$returnObject = new DOMDocument();
			$object = $returnObject->loadXML($ch);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			// Get the xml data.
			$registryObjects = new DOMDocument();

			$domObjects = explode("recordData>",$ch);

			$result = $registryObjects->loadXML(str_replace("</registryObjects></","</registryObjects>",($domObjects[1])));

			$errors = error_get_last();
			if( $errors )
			{
				$runErrors .= "Document Load Error: ".$errors['message']."\n";
			}
<<<<<<< HEAD
<<<<<<< HEAD

			if( !$runErrors )
			{
			// run an XSLT transformation
				$registryObjects = transformToRif2($registryObjects);
				if($registryObjects == null)
				{
					$runErrors = "There was an error transforming the document to RIF-CS v1.2";
				}
			}

=======
	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( !$runErrors )
			{
			// run an XSLT transformation
				$registryObjects = transformToRif2($registryObjects);
				if($registryObjects == null)
				{
					$runErrors = "There was an error transforming the document to RIF-CS v1.2";
				}
			}
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( !$runErrors )
			{
			  // Validate it against the orca schema.
			  // XXX: libxml2.6 workaround (Save to local filesystem before validating)
<<<<<<< HEAD
<<<<<<< HEAD

			  // Create temporary file and save manually created DOMDocument.
			  $tempFile = "/tmp/" . time() . '-' . rand() . '-document.tmp';
			  $registryObjects->save($tempFile);

			  // Create temporary DOMDocument and re-load content from file.
			  $registryObjects = new DOMDocument();
			  $registryObjects->load($tempFile);

=======
			  
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			  // Create temporary file and save manually created DOMDocument.
			  $tempFile = "/tmp/" . time() . '-' . rand() . '-document.tmp';
			  $registryObjects->save($tempFile);

			  // Create temporary DOMDocument and re-load content from file.
			  $registryObjects = new DOMDocument();
			  $registryObjects->load($tempFile);
<<<<<<< HEAD
			  
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			  // Delete temporary file.
			  if (is_file($tempFile))
			  {
			    unlink($tempFile);
<<<<<<< HEAD
<<<<<<< HEAD
			  }
=======
			  }			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			  }
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			// Validate it against the orca schema.
				$result = $registryObjects->schemaValidate(gRIF_SCHEMA_PATH);
				$errors = error_get_last();
				if( $errors )
				{
					$runErrors .= "Document Validation Error: ".$errors['message']."\n";
				}
			}
<<<<<<< HEAD
<<<<<<< HEAD

			if( !$runErrors )
			{

=======
					
			if( !$runErrors )
			{	
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

			if( !$runErrors )
			{

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$key = $registryObjects->getElementsByTagName("key")->item(0)->nodeValue;
				//check if this nla identifier is already imported as a part record
				$isthere = getRegistryObject($key);
				//if its not there already then lets import it
<<<<<<< HEAD
<<<<<<< HEAD
				if(!$isthere){
					$runErrors = importRegistryObjects($registryObjects, 'NLA', $runResultMessage,'SYSTEM','PUBLISHED');
					if(!$runErrors)
					{
						$actions .= ">>SUCCESS nla party imported with key".$key."\n";
					}
				}
			}

=======
				if(!$isthere){	
					$runErrors = importRegistryObjects($registryObjects, 'NLA', $runResultMessage,'SYSTEM','PUBLISHED');	
=======
				if(!$isthere){
					$runErrors = importRegistryObjects($registryObjects, 'NLA', $runResultMessage,'SYSTEM','PUBLISHED');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					if(!$runErrors)
					{
						$actions .= ">>SUCCESS nla party imported with key".$key."\n";
					}
				}
			}
<<<<<<< HEAD
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $runErrors )
			{
				$actions .= ">>ERRORS\n";
				$actions .= $runErrors;
			}

		}
	}
	$timeTaken = substr((string)(microtime(true) - $startTime), 0, 5);
	$actions  .= "Time Taken: $timeTaken seconds\n";
}
else
{
<<<<<<< HEAD
<<<<<<< HEAD
	$actions = "No ".str_replace("NLA"," NLA",$services)." Party identifiers to insert \n";
}
date_default_timezone_set('Antarctica/Macquarie');
$actions .= date("d/m/Y h:m:s")."\n";
queueSyncDataSource('NLA_PARTY');
=======
	$actions = "No ".str_replace("NLA"," NLA",$services)." Party identifiers to insert \n";	
}
date_default_timezone_set('Antarctica/Macquarie');
$actions .= date("d/m/Y h:m:s")."\n";
exec("wget 'https://services.ands.org.au/home/orca/services/getRegistryObjectsSOLR.php?dataSourceKey=NLA_PARTY&solrUrl=yep' -q");
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$actions = "No ".str_replace("NLA"," NLA",$services)." Party identifiers to insert \n";
}
date_default_timezone_set('Antarctica/Macquarie');
$actions .= date("d/m/Y h:m:s")."\n";
queueSyncDataSource('NLA_PARTY');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
mail("lizwoods.ands@gmail.com","NLA Party imports",$actions);
//echo $actions;
// END: XML Response
// =============================================================================
//require '../../_includes/finish.php';
?>