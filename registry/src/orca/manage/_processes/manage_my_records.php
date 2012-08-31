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


<<<<<<< HEAD
=======

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
// Default response
$response = array("responsecode" => 0, "response" => "No Response");
$data_source_key = getPostedValue('dataSourceKey');
$keys = getPostedValue('keys');

// Check if user is currently logged in
if (!userIsLoggedIn())
{
	$response['response'] = "Not logged in";
	echo json_encode($response);
	die();
}
	
// Check that data source is valid and user has access to it
$rawResults = getDataSources($data_source_key, null);
if ($data_source_key == 'PUBLISH_MY_DATA' && userIsORCA_ADMIN())
{
	$rawResults[] = array('data_source_key'=>'PUBLISH_MY_DATA');
}
if( $rawResults )
{
	
	foreach( $rawResults as $dataSource )
	{
		if( !(userIsORCA_QA() || userIsDataSourceRecordOwner($dataSource['record_owner'])) )
		{
			$response['response'] = "Not logged in";
			echo json_encode($response);
			die();
		}		
	}
}
else
{
	$response['response'] = "Invalid Datasource";
	echo json_encode($response);
	die();
}

// Check we actually have keys to act on
if (count($keys) == 0)
{
	$response['response'] = "Invalid Key Set";
	echo json_encode($response);
	die();
}

// Handle the action
switch(getQueryValue('action'))
{
	
	case "SUBMIT_FOR_ASSESSMENT":
		
		$send_email = true;
		if (getDraftCountByStatus($data_source_key, SUBMITTED_FOR_ASSESSMENT) !== 0)
		{
			$send_email = false;
		}
		/*foreach(getDraftRegistryObject(null, $data_source_key) AS $draft)
		{
			if ($draft['status'] == SUBMITTED_FOR_ASSESSMENT)
			{
				$send_email = false;
			}
		}*/
		
		foreach($keys AS $key)
		{
<<<<<<< HEAD
			$response['response']=updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, SUBMITTED_FOR_ASSESSMENT);
		}
		syncDraftKeys($keys, $data_source_key);
		$target_data_source = getDataSources($data_source_key, null);
		
		$response['responsecode'] = "MT008";

=======
			updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, SUBMITTED_FOR_ASSESSMENT);
		}

		$target_data_source = getDataSources($data_source_key, null);
		
		$response['responsecode'] = "MT008";
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		if ($send_email)
		{			
			if (isset($target_data_source[0]['assessement_notification_email_addr']) && $target_data_source[0]['assessement_notification_email_addr'] != "")
			{
				
				$this_user = $_SESSION['name'];
				
				send_email(
					$target_data_source[0]['assessement_notification_email_addr'],
					"Records from " . $target_data_source[0]['title'] . " are ready for your assessment",
					$target_data_source[0]['title'] . " has submitted " . count($keys) . " record(s) for your assessment" . ($_SESSION['name'] != "" ? " by " .$_SESSION['name'] : ".") . " \n\n" .
					"Your action is required to review these records by visiting the Manage My Records screen or accessing the Data Source directly by the following link:\n" .
					eHTTP_APP_ROOT . "orca/manage/my_records.php?data_source=" . $data_source_key . "\n\n"
				);
				
				$response['responsecode'] = "MT014";
			}
		}

		echo json_encode($response);
		die();
			
	break;
	
	case "START_ASSESSMENT":
		
		foreach($keys AS $key)
		{
			updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, ASSESSMENT_IN_PROGRESS);
		}
<<<<<<< HEAD
		syncDraftKeys($keys, $data_source_key);
=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
	case "MORE_WORK_REQUIRED":
		
		foreach($keys AS $key)
		{
			updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, MORE_WORK_REQUIRED);
		}
<<<<<<< HEAD
		syncDraftKeys($keys, $data_source_key);
=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
	case "BACK_TO_DRAFT":
		
		foreach($keys AS $key)
		{
<<<<<<< HEAD
			updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, DRAFT);			
		}
		syncDraftKeys($keys, $data_source_key);
=======
			updateDraftRegistryObjectStatus(rawurldecode($key), $data_source_key, DRAFT);
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
	case "APPROVE":
<<<<<<< HEAD
		$returnErrors = "";
		deleteSetofSolrDrafts($keys, $data_source_key);
		foreach($keys AS $key)
		{
			$returnErrors .= approveDraft(rawurldecode($key), $data_source_key);			
			$returnErrors .= syncKey(rawurldecode($key), $data_source_key);
		}
		//deleteSolrHashKeys(sha1($key.$data_source_key));//delete the draft
=======
		
		$returnErrors = "";
		foreach($keys AS $key)
		{
			$draft = getDraftRegistryObject(rawurldecode($key), $data_source_key);
			$errorMessages = "";
			if ($draft[0]['error_count'] == 0)
			{
				error_reporting(E_ERROR | E_WARNING | E_PARSE);
				ini_set("display_errors", 1);
				if ($draft = getDraftRegistryObject(rawurldecode($key), $data_source_key)) 
				{
					$rifcs = new DomDocument();
					$rifcs->loadXML($draft[0]['rifcs']);
					$stripFromData = new DomDocument();
					$stripFromData->load('../_xsl/stripFormData.xsl');
					$proc = new XSLTProcessor();
					$proc->importStyleSheet($stripFromData);
					$registryObject = $proc->transformToDoc($rifcs);
					//print_pre($draft);
					$dataSourceKey = $draft[0]['registry_object_data_source'];
					$deleteErrors = "";
			        $errors = error_get_last();
			   
					if( $errors )
					{
						$errorMessages .= "Document Load Error";
						$errorMessages .= "<div style=\"margin-top: 8px; color: #880000; height: 100px; width: 500px; padding: 0px; white-space: pre-wrap; overflow: auto; font-family: courier new, courier, monospace; font-size:9pt;\">";
						$errorMessages .= esc($errors['message']);
						$errorMessages .= "</div>\n";
					}
					
					error_reporting(~E_ALL);
					ini_set("display_errors", 0);
					if( !$errorMessages )
					{
						// Validate it against the orca schema.
					    // libxml2.6 workaround (Save to local filesystem before validating)
					  
					    // Create temporary file and save manually created DOMDocument.
					    $tempFile = "/tmp/" . time() . '-' . rand() . '-document.tmp';
					    $registryObject->save($tempFile);
					 
					    // Create temporary DOMDocument and re-load content from file.
					    $registryObject = new DOMDocument();
					    $registryObject->load($tempFile);
					    
					    // Delete temporary file.
					    if (is_file($tempFile))
					    {
					      unlink($tempFile);
					    }
					  
						$result = $registryObject->schemaValidate(gRIF_SCHEMA_PATH); //xxx
						$errors = error_get_last();
						//print($dataSourceKey);
						//exit;
			
						if( $errors )
						{
							$errorMessages .= "Document Validation Error\n";
							$errorMessages .= esc($errors['message']);
						}
						else
		               	{
							$importErrors = importRegistryObjects($registryObject,$dataSourceKey, $resultMessage, getLoggedInUser(), null, ($draft[0]['draft_owner']==SYSTEM ? SYSTEM : getThisOrcaUserIdentity()), null, true);       
							$importErrors .= runQualityCheckForRegistryObject(rawurldecode($key), $dataSourceKey);
							//addSolrIndex(rawurldecode($key), true);
							if( !$importErrors )
							{
								$deleteErrors = deleteDraftRegistryObject($dataSourceKey , rawurldecode($key));
							}            

							
							if( $deleteErrors || $importErrors )
							{
								$errorMessages .= "$deleteErrors \n\n $importErrors";
							}
							else
							{
								//print("<script>$(window.location).attr('href','".eAPP_ROOT."orca/view.php?key=".esc($_GET['key'])."');</script>");
							}
						}
					}
	
				}
				else
				{       
					$errorMessages .= "This Draft Key does not exist!";
				}
			

			}
			else 
			{
				$errorMessages .= "This record contains errors and cannot be published.";	
			}
			
			
			$returnErrors .= (strlen($errorMessages) > 0 ? 	"\nERROR (key: $key): \n" . 
															"------------------ \n" . 
															$errorMessages . "\n" . 
															"------------------" : "");
		}
		addKeysToSolrIndex($keys, true);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$response['alert'] = $returnErrors;
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
	
	case "PUBLISH":
<<<<<<< HEAD
		deleteSetofSolrDrafts($keys, $data_source_key);
		//var_dump($keys);
		foreach($keys AS $key){
			//is it a draft
			$isDraft = getDraftRegistryObject(rawurldecode($key), $data_source_key);
			if($isDraft){
				//is a draft, have to approve and do all the jazz with it first
				$error = approveDraft($key, $data_source_key);
				//deleteSolrHashKey(sha1($key.$data_source_key));//delete the draft
				$error .= updateRegistryObjectStatus(rawurldecode($key), PUBLISHED);
				$error .= syncKey(rawurldecode($key), $data_source_key);
				$response['responsecode'] = "1";
				$response['alert'] = $error;
				echo json_encode($response);
			}else{
				//is not draft
				updateRegistryObjectStatus(rawurldecode($key), PUBLISHED);
				syncKey(rawurldecode($key), $data_source_key);
				$response['responsecode'] = "1";
				echo json_encode($response);
				if(isContributorPage(rawurldecode($key)))
				{
					$theObject = getRegistryObject(rawurldecode($key), $overridePermissions = true);
					$mailSubject = $theObject[0]['list_title'].' contributor page was published on '.date("d-m-Y h:m:s");						
					$mailBody = eHTTP_APP_ROOT.'orca/view.php?key='.urlencode($key);	
					send_email(eCONTACT_EMAIL,$mailSubject,$mailBody);	
				}
			}
		}
		queueSyncDataSource($data_source_key);
		//syncDraftKeys($keys, $data_source_key);
=======

		foreach($keys AS $key)
		{
			updateRegistryObjectStatus(rawurldecode($key), PUBLISHED);
		}
		addKeysToSolrIndex($keys, true);
		
		$response['responsecode'] = "1";
		echo json_encode($response);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		die();
		
	break;
	
	case "DELETE_RECORD":
		
		foreach($keys AS $key)
		{
<<<<<<< HEAD
			deleteSolrHashKey(sha1($key));//solr
			deleteCacheItem($data_source_key, $key);//cache
			deleteRegistryObject(rawurldecode($key));//db
			queueSyncDataSource($data_source_key);
=======
			deleteRegistryObject(rawurldecode($key));
			deleteSolrIndex(rawurldecode($key));
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		}
		
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
	case "DELETE_DRAFT":
		
		foreach($keys AS $key)
		{
<<<<<<< HEAD
			deleteDraftRegistryObject($data_source_key, rawurldecode($key));//delete from db
			//deleteSolrDraft($key, $data_source_key);//delete from solr
			queueSyncDataSource($data_source_key);
		}
		deleteSetofSolrDrafts($keys, $data_source_key);
=======
			deleteDraftRegistryObject($data_source_key, rawurldecode($key));
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$response['responsecode'] = "1";
		echo json_encode($response);
		die();
		
	break;
	
<<<<<<< HEAD
	case "FLAG_GOLD":
		foreach($keys as $key){
			setRegistryObjectGoldStandardFlag($key,1);
			syncKey($key, $data_source_key);
		}
		$response['responsecode']="1";
		echo json_encode($response);
		die();
		
	case "UNSET_GOLD":
		foreach($keys as $key){
			setRegistryObjectGoldStandardFlag($key,0);
			syncKey($key, $data_source_key);
		}
		$response['responsecode']="1";
		echo json_encode($response);
		die();

=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	// if no action matches
	default:
		$response['response'] = "Invalid Action";
		echo json_encode($response);
		die();
<<<<<<< HEAD
=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}		



echo json_encode($response);
die();