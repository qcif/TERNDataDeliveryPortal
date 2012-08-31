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
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

********************************************************************************
$Date: 2011-11-25 14:26:15 +1100 (Fri, 25 Nov 2011) $
$Revision: 1633 $
<<<<<<< HEAD
*******************************************************************************/
$vocabBroaderTerms = Array();
$vocabByLabels = Array();
function getRegistryObjectXML($registryObjectKey, $forSOLR = false, $includeRelated = false)
{


	if (!eCACHE_ENABLED)
	{
		return getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR, $includeRelated);
	}



	$data_source_key = getRegistryObjectDataSourceKey($registryObjectKey);

	// Registry key probably doesn't exist?
	if (!$data_source_key) return FALSE;

	// Get the result from cache as extended rifcs (hopefully!)
	$result = getCacheItems($data_source_key, $registryObjectKey, eCACHE_CURRENT_NAME, $forSOLR);

	// No luck? Well, lets try and index it then...
	if ($result === FALSE)
	{
		writeCache($data_source_key, $registryObjectKey, generateExtendedRIFCS($registryObjectKey));
	}
	$result = getCacheItems($data_source_key, $registryObjectKey, eCACHE_CURRENT_NAME, $forSOLR);

	// Still no luck? Fall back to getRegistryObjectXMLforSOLR and build from DB XXX: Temporary
	if ($result !== FALSE)
	{
		return $result;
	}
	else
	{
		// go ahead and rebuild by hand (fallback)
		return getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR, $includeRelated);
	}
}

function getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR = false, $includeRelated = false)
{
	// go ahead and rebuild by hand (fallback)
	$xml = '';
	
	$registryObject = getRegistryObject($registryObjectKey);

	

	if ($forSOLR)
	{
		$dataSourceKey = $registryObject[0]["data_source_key"];
		$registryObjectStatus = $registryObject[0]["status"];
		$dataSource = getDataSources($dataSourceKey, null);
		$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
		$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
	}
	

=======
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
*******************************************************************************/
$vocabBroaderTerms = Array();
$vocabByLabels = Array();
function getRegistryObjectXML($registryObjectKey, $forSOLR = false, $includeRelated = false)
{


	if (!eCACHE_ENABLED)
	{
		return getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR, $includeRelated);
	}



	$data_source_key = getRegistryObjectDataSourceKey($registryObjectKey);

	// Registry key probably doesn't exist?
	if (!$data_source_key) return FALSE;

	// Get the result from cache as extended rifcs (hopefully!)
	$result = getCacheItems($data_source_key, $registryObjectKey, eCACHE_CURRENT_NAME, $forSOLR);

	// No luck? Well, lets try and index it then...
	if ($result === FALSE)
	{
		writeCache($data_source_key, $registryObjectKey, generateExtendedRIFCS($registryObjectKey));
	}
	$result = getCacheItems($data_source_key, $registryObjectKey, eCACHE_CURRENT_NAME, $forSOLR);

	// Still no luck? Fall back to getRegistryObjectXMLforSOLR and build from DB XXX: Temporary
	if ($result !== FALSE)
	{
		return $result;
	}
	else
	{
		// go ahead and rebuild by hand (fallback)
		return getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR, $includeRelated);
	}
}

function getRegistryObjectXMLFromDB($registryObjectKey, $forSOLR = false, $includeRelated = false)
{
	// go ahead and rebuild by hand (fallback)
	$xml = '';
	
	$registryObject = getRegistryObject($registryObjectKey);

	

	if ($forSOLR)
	{
		$dataSourceKey = $registryObject[0]["data_source_key"];
		$registryObjectStatus = $registryObject[0]["status"];
		$dataSource = getDataSources($dataSourceKey, null);
		$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
		$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
	}
	
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $registryObject )
	{
		// Registry Object
		// =====================================================================
		$group= esc($registryObject[0]['object_group']);
		$xml .= "  <registryObject group=\"$group\">\n";
<<<<<<< HEAD
<<<<<<< HEAD

		// Registry Object Key
		// =====================================================================
		$xml .= "    <key>".esc($registryObjectKey)."</key>\n";


		if ($forSOLR)
		{



			$xml .= "    <extRif:extendedMetadata>\n";

			// url_slug
			// -------------------------------------------------------------
			$xml .= '      <extRif:urlSlug>'.esc(trim(getRegistryObjectURLSlug($registryObjectKey))).'</extRif:urlSlug>'."\n";

			$hash = getRegistryObjectHash($registryObjectKey);
			if ($hash)
			{
				$xml .= "      <extRif:keyHash>".esc($hash)."</extRif:keyHash>\n";
			}

			$hash = getDataSourceHash($dataSourceKey);
			if ($hash)
			{
				$xml .= "      <extRif:dataSourceKeyHash>".esc($hash)."</extRif:dataSourceKeyHash>\n";
			}
			$xml .= "      <extRif:status>".esc($registryObjectStatus)."</extRif:status>\n";
			$xml .= "      <extRif:dataSourceKey>".esc($dataSourceKey)."</extRif:dataSourceKey>\n";
			$reverseLinks = 'NONE';
			$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
			$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
			if($allow_reverse_internal_links == 't' && $allow_reverse_external_links == 't')
			{
				$reverseLinks = 'BOTH';
			}
			else if($allow_reverse_internal_links == 't')
			{
				$reverseLinks = 'INT';

			}
			else if($allow_reverse_external_links == 't')
			{
				$reverseLinks = 'EXT';
			}
			$xml .= "      <extRif:reverseLinks>".$reverseLinks."</extRif:reverseLinks>\n";


			// Get registry date modified
			if (!($registryDateModified =  getRegistryObjectStatusModified($registryObjectKey)))
			{
					$registryDateModified = time(); // default to now
			}
			else 
			{
				$registryDateModified = strtotime($registryDateModified); // parse the SQL timestamp
			}
			// SOLR requires the date in ISO8601, restricted to zulu time (why, I don't know...)
			$xml .= "      <extRif:registryDateModified>".gmdate('Y-m-d\TH:i:s\Z',$registryDateModified)."</extRif:registryDateModified>\n";



			// displayTitle
			// -------------------------------------------------------------
			$xml .= '      <extRif:displayTitle>'.esc(trim($registryObject[0]['display_title'])).'</extRif:displayTitle>'."\n";
			$logo = '';
			$logoStr = getDescriptionLogo($registryObjectKey);
			if ($logoStr !== false)
			{
				$xml .= '      <extRif:displayLogo>'.strip_tags(esc($logoStr)).'</extRif:displayLogo>'."\n";
			}

			// listTitle
			// -------------------------------------------------------------
			$xml .= '      <extRif:listTitle>'.esc(trim($registryObject[0]['list_title'])).'</extRif:listTitle>'."\n";

			// searchBaseScore (base "boost" used to adjust search rankings)
			$baseScore = getSearchBaseScore($registryObjectKey);


			$xml .= "      <extRif:searchBaseScore>$baseScore</extRif:searchBaseScore>\n";
			$xml .= '      <extRif:flag>'.($registryObject[0]['flag'] == 'f' ? '0' : '1').'</extRif:flag>'."\n";
			$xml .= '      <extRif:warning_count>'.esc(trim($registryObject[0]['warning_count'])).'</extRif:warning_count>'."\n";
			$xml .= '      <extRif:error_count>'.esc(trim($registryObject[0]['error_count'])).'</extRif:error_count>'."\n";
			$xml .= '      <extRif:url_slug>'.esc(trim($registryObject[0]['url_slug'])).'</extRif:url_slug>'."\n";
			$xml .= '      <extRif:manually_assessed_flag>'.esc(trim($registryObject[0]['manually_assessed_flag'])).'</extRif:manually_assessed_flag>'."\n";
			$xml .= '      <extRif:gold_status_flag>'.esc(trim($registryObject[0]['gold_status_flag'])).'</extRif:gold_status_flag>'."\n";
			$xml .= '      <extRif:quality_level>'.esc(trim($registryObject[0]['quality_level'])).'</extRif:quality_level>'."\n";
			$owner = ($registryObject[0]['created_who'] == 'SYSTEM' ? 'harvest' : 'manual');
			$xml .= '      <extRif:feedType>'.$owner.'</extRif:feedType>'."\n";
			$xml .= '      <extRif:lastModifiedBy>'.$registryObject[0]['created_who'].'</extRif:lastModifiedBy>'."\n";
			if($contributorPage = getGroupPage($group))
			{
				$contributorPageTitle = getRegistryObject($contributorPage[0]['registry_object_key'], $overridePermissions = true);
				$xml .= '      <extRif:contributorPage>'.rawurlencode($contributorPage[0]['registry_object_key']).'</extRif:contributorPage>'."\n";
				$contributorLogoStr = getDescriptionLogo($contributorPage[0]['registry_object_key']);
				if ($contributorLogoStr !== false)
				{
					$xml .= '      <extRif:contributorDisplayLogo>'.strip_tags(esc($contributorLogoStr)).'</extRif:contributorDisplayLogo>'."\n";
				}		
			}
			$xml .= "    </extRif:extendedMetadata>\n";
		}

=======
		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Registry Object Key
		// =====================================================================
		$xml .= "    <key>".esc($registryObjectKey)."</key>\n";


		if ($forSOLR)
		{



			$xml .= "    <extRif:extendedMetadata>\n";

			// url_slug
			// -------------------------------------------------------------
			$xml .= '      <extRif:urlSlug>'.esc(trim(getRegistryObjectURLSlug($registryObjectKey))).'</extRif:urlSlug>'."\n";

			$hash = getRegistryObjectHash($registryObjectKey);
			if ($hash)
			{
				$xml .= "      <extRif:keyHash>".esc($hash)."</extRif:keyHash>\n";
			}

			$hash = getDataSourceHash($dataSourceKey);
			if ($hash)
			{
				$xml .= "      <extRif:dataSourceKeyHash>".esc($hash)."</extRif:dataSourceKeyHash>\n";
			}
			$xml .= "      <extRif:status>".esc($registryObjectStatus)."</extRif:status>\n";
			$xml .= "      <extRif:dataSourceKey>".esc($dataSourceKey)."</extRif:dataSourceKey>\n";
			$reverseLinks = 'NONE';
			$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
			$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
			if($allow_reverse_internal_links == 't' && $allow_reverse_external_links == 't')
			{
				$reverseLinks = 'BOTH';
			}
			else if($allow_reverse_internal_links == 't')
			{
				$reverseLinks = 'INT';

			}
			else if($allow_reverse_external_links == 't')
			{
				$reverseLinks = 'EXT';
			}
			$xml .= "      <extRif:reverseLinks>".$reverseLinks."</extRif:reverseLinks>\n";


			// Get registry date modified
			if (!($registryDateModified =  getRegistryObjectStatusModified($registryObjectKey)))
			{
					$registryDateModified = time(); // default to now
			}
			else 
			{
				$registryDateModified = strtotime($registryDateModified); // parse the SQL timestamp
			}
			// SOLR requires the date in ISO8601, restricted to zulu time (why, I don't know...)
			$xml .= "      <extRif:registryDateModified>".gmdate('Y-m-d\TH:i:s\Z',$registryDateModified)."</extRif:registryDateModified>\n";



			// displayTitle
			// -------------------------------------------------------------
			$xml .= '      <extRif:displayTitle>'.esc(trim($registryObject[0]['display_title'])).'</extRif:displayTitle>'."\n";
			$logo = '';
			$logoStr = getDescriptionLogo($registryObjectKey);
			if ($logoStr !== false)
			{
				$xml .= '      <extRif:displayLogo>'.strip_tags(esc($logoStr)).'</extRif:displayLogo>'."\n";
			}

			// listTitle
			// -------------------------------------------------------------
			$xml .= '      <extRif:listTitle>'.esc(trim($registryObject[0]['list_title'])).'</extRif:listTitle>'."\n";

			// searchBaseScore (base "boost" used to adjust search rankings)
			$baseScore = getSearchBaseScore($registryObjectKey);


			$xml .= "      <extRif:searchBaseScore>$baseScore</extRif:searchBaseScore>\n";
			$xml .= '      <extRif:flag>'.($registryObject[0]['flag'] == 'f' ? '0' : '1').'</extRif:flag>'."\n";
			$xml .= '      <extRif:warning_count>'.esc(trim($registryObject[0]['warning_count'])).'</extRif:warning_count>'."\n";
			$xml .= '      <extRif:error_count>'.esc(trim($registryObject[0]['error_count'])).'</extRif:error_count>'."\n";
			$xml .= '      <extRif:url_slug>'.esc(trim($registryObject[0]['url_slug'])).'</extRif:url_slug>'."\n";
			$xml .= '      <extRif:manually_assessed_flag>'.esc(trim($registryObject[0]['manually_assessed_flag'])).'</extRif:manually_assessed_flag>'."\n";
			$xml .= '      <extRif:gold_status_flag>'.esc(trim($registryObject[0]['gold_status_flag'])).'</extRif:gold_status_flag>'."\n";
			$xml .= '      <extRif:quality_level>'.esc(trim($registryObject[0]['quality_level'])).'</extRif:quality_level>'."\n";
			$owner = ($registryObject[0]['created_who'] == 'SYSTEM' ? 'harvest' : 'manual');
			$xml .= '      <extRif:feedType>'.$owner.'</extRif:feedType>'."\n";
			$xml .= '      <extRif:lastModifiedBy>'.$registryObject[0]['created_who'].'</extRif:lastModifiedBy>'."\n";
			if($contributorPage = getGroupPage($group))
			{
				$contributorPageTitle = getRegistryObject($contributorPage[0]['registry_object_key'], $overridePermissions = true);
				if($contributorPageTitle)
				{
					$xml .= '      <extRif:contributorPage>'.rawurlencode($contributorPage[0]['registry_object_key']).'</extRif:contributorPage>'."\n";
					$contributorLogoStr = getDescriptionLogo($contributorPage[0]['registry_object_key']);
					if ($contributorLogoStr !== false)
					{
						$xml .= '      <extRif:contributorDisplayLogo>'.strip_tags(esc($contributorLogoStr)).'</extRif:contributorDisplayLogo>'."\n";
					}
				}		
			}
			$xml .= "    </extRif:extendedMetadata>\n";
		}
<<<<<<< HEAD
		
		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		
		// Registry Object Class
		// =====================================================================
		$registryObjectClass = strtolower($registryObject[0]['registry_object_class']);
		$dataSource = $registryObject[0]['data_source_key'];
		$type = esc(strtolower($registryObject[0]['type']));
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$dateAccessioned = '';
		if( $registryObject[0]['date_accessioned'] && $registryObjectClass == 'collection' )
		{
			$dateAccessioned = ' dateAccessioned="'.esc(getXMLDateTime($registryObject[0]['date_accessioned'])).'"';
		}
<<<<<<< HEAD
<<<<<<< HEAD

		$dateModified = '';
		if( $registryObject[0]['status_modified_when'] )
		{
			$dateModified = ' dateModified="'.esc(getXMLDateTime($registryObject[0]['status_modified_when'])).'"';
		}


		// Registry Object Originating Source
		// =====================================================================
		$originatingSource = esc($registryObject[0]['originating_source']);
		$originatingSourceType = '';
		if( $registryObject[0]['originating_source_type'] )
		{
			$originatingSourceType = ' type="'.esc($registryObject[0]['originating_source_type']).'"';
		}

		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";


		// To prevent empty XML elements, we append to blank string and check that it actually
		// contains data
		$internalxml = "";

		// identifier
		// -------------------------------------------------------------
		$internalxml .= getIdentifierTypesXML($registryObjectKey, 'identifier');

		// name
		// -------------------------------------------------------------
		$internalxml .= getComplexNameTypesXML($registryObjectKey, 'name', $registryObjectClass, $forSOLR);

		// location
		// -------------------------------------------------------------
		$internalxml .= getLocationTypesXML($registryObjectKey, 'location', $forSOLR);


		if($forSOLR && $includeRelated)
		{
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXML($registryObjectKey, $dataSourceKey, $registryObjectClass, 'relatedObject', $forSOLR);
		}
		else if (!$forSOLR)
		{
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXML($registryObjectKey, $dataSource, $registryObjectClass,'relatedObject', $forSOLR);
		}

		// subject
		// -------------------------------------------------------------
		$internalxml .= getSubjectTypesXML($registryObjectKey, 'subject', $forSOLR); 

		// description
		// -------------------------------------------------------------
		$internalxml .= getDescriptionTypesXML($registryObjectKey, 'description', $forSOLR);

		// coverage
		// -------------------------------------------------------------
		$internalxml .= getCoverageTypesXML($registryObjectKey, 'coverage', $forSOLR);


		// relatedInfo
		// -------------------------------------------------------------
		$internalxml .= getRelatedInfoTypesXML($registryObjectKey, 'relatedInfo');

		// rights
		// -------------------------------------------------------------
		$internalxml .= getRightsTypesXML($registryObjectKey, 'rights', $forSOLR);

		// existenceDates
		// -------------------------------------------------------------
		$internalxml .= getExistenceDateTypesXML($registryObjectKey, 'existenceDates');

=======
		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$dateModified = '';
		if( $registryObject[0]['status_modified_when'] )
		{
			$dateModified = ' dateModified="'.esc(getXMLDateTime($registryObject[0]['status_modified_when'])).'"';
		}


		// Registry Object Originating Source
		// =====================================================================
		$originatingSource = esc($registryObject[0]['originating_source']);
		$originatingSourceType = '';
		if( $registryObject[0]['originating_source_type'] )
		{
			$originatingSourceType = ' type="'.esc($registryObject[0]['originating_source_type']).'"';
		}

		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";


		// To prevent empty XML elements, we append to blank string and check that it actually
		// contains data
		$internalxml = "";

		// identifier
		// -------------------------------------------------------------
		$internalxml .= getIdentifierTypesXML($registryObjectKey, 'identifier');

		// name
		// -------------------------------------------------------------
		$internalxml .= getComplexNameTypesXML($registryObjectKey, 'name', $registryObjectClass, $forSOLR);

		// location
		// -------------------------------------------------------------
		$internalxml .= getLocationTypesXML($registryObjectKey, 'location', $forSOLR);


		if($forSOLR && $includeRelated)
		{
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXML($registryObjectKey, $dataSourceKey, $registryObjectClass, 'relatedObject', $forSOLR);
		}
		else if (!$forSOLR)
		{
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXML($registryObjectKey, $dataSource, $registryObjectClass,'relatedObject', $forSOLR);
		}

		// subject
		// -------------------------------------------------------------
		$internalxml .= getSubjectTypesXML($registryObjectKey, 'subject', $forSOLR);

		// description
		// -------------------------------------------------------------
		$internalxml .= getDescriptionTypesXML($registryObjectKey, 'description', $forSOLR);

		// coverage
		// -------------------------------------------------------------
		$internalxml .= getCoverageTypesXML($registryObjectKey, 'coverage', $forSOLR);


		// relatedInfo
		// -------------------------------------------------------------
		$internalxml .= getRelatedInfoTypesXML($registryObjectKey, 'relatedInfo');
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		// rights
		// -------------------------------------------------------------
		$internalxml .= getRightsTypesXML($registryObjectKey, 'rights', $forSOLR);

		// existenceDates
		// -------------------------------------------------------------
		$internalxml .= getExistenceDateTypesXML($registryObjectKey, 'existenceDates');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		//citationInfo
		// -------------------------------------------------------------
		$internalxml .= getCitationInformationTypeXML($registryObjectKey, 'citationInfo');

<<<<<<< HEAD
<<<<<<< HEAD

		if($registryObjectClass  == 'service')
		{
			// accessPolicy
			// -------------------------------------------------------------
			$internalxml .= getAccessPolicyTypesXML($registryObjectKey, 'accessPolicy');
		}

=======
		if (strlen($internalxml) > 0)
		{
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified.">\n";
			$xml .= $internalxml;
			$xml .= "    </$registryObjectClass>\n";
		} else {
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified."/>\n";
		}
		
		$xml .= "  </registryObject>\n";
	}
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

		if($registryObjectClass  == 'service')
		{
			// accessPolicy
			// -------------------------------------------------------------
			$internalxml .= getAccessPolicyTypesXML($registryObjectKey, 'accessPolicy');
		}
<<<<<<< HEAD
		
		$dateModified = '';
		if( $registryObject[0]['date_modified'] )
		{
			$dateModified = ' dateModified="'.esc(getXMLDateTime($registryObject[0]['date_modified'])).'"';
		}	
		
		$internalxml = "";
		// identifier
		// -------------------------------------------------------------
		$internalxml .= getIdentifierTypesXML($registryObjectKey, 'identifier');
		// existenceDates
		// -------------------------------------------------------------
		$internalxml .= getExistenceDateTypesXMLSolr($registryObjectKey, 'existenceDates');				
		// relatedObject
		// -------------------------------------------------------------
		$internalxml .= getRelatedObjectTypesXMLforSolr($registryObjectKey, $registryObjectClass,$dataSourceKey,'relatedObject');
		
		// reverse links
		// -------------------------------------------------------------		
		$internalxml .= getReverseLinkTypesXMLforSolr($registryObjectKey,$dataSourceKey, $registryObjectClass, 'relatedObject');
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if (strlen($internalxml) > 0)
		{
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified.">\n";
			$xml .= $internalxml;
			$xml .= "    </$registryObjectClass>\n";
		} else {
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified."/>\n";
		}
<<<<<<< HEAD
<<<<<<< HEAD

		$xml .= "  </registryObject>\n";

	}
	return $xml;
}


function getRegistryObjectXMLforSOLR($registryObjectKey,$includeRelated=false)
{
	return getRegistryObjectXML($registryObjectKey, true, $includeRelated);
	/*
=======
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$xml .= "  </registryObject>\n";

	}

	return $xml;
}


function getRegistryObjectXMLforSOLR($registryObjectKey,$includeRelated=false)
{
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	return getRegistryObjectXML($registryObjectKey, true, $includeRelated);
	/*
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$xml = '';
	$registryObject = getRegistryObject($registryObjectKey);
	$dataSourceKey = $registryObject[0]["data_source_key"];
	$registryObjectStatus = $registryObject[0]["status"];
	$dataSource = getDataSources($dataSourceKey, null);
	$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
	$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $registryObject )
	{
		// Registry Object
		// =====================================================================
		$group= esc($registryObject[0]['object_group']);
		$xml .= "  <registryObject group=\"$group\">\n";
<<<<<<< HEAD
<<<<<<< HEAD

		// Registry Object Key
		// =====================================================================
		$xml .= "    <key>".esc($registryObjectKey)."</key>\n";
		$xml .= "    <extRif:status>".esc($registryObjectStatus)."</extRif:status>\n";
		$xml .= "    <extRif:dataSourceKey>".esc($dataSourceKey)."</extRif:dataSourceKey>\n";
=======
		
		// Registry Object Key
		// =====================================================================
		$xml .= "    <key>".esc($registryObjectKey)."</key>\n";
		$xml .= "    <status>".esc($registryObjectStatus)."</status>\n";
		$xml .= "    <dataSourceKey>".esc($dataSourceKey)."</dataSourceKey>\n";		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		// Registry Object Key
		// =====================================================================
		$xml .= "    <key>".esc($registryObjectKey)."</key>\n";
		$xml .= "    <extRif:status>".esc($registryObjectStatus)."</extRif:status>\n";
		$xml .= "    <extRif:dataSourceKey>".esc($dataSourceKey)."</extRif:dataSourceKey>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$reverseLinks = 'NONE';
		$allow_reverse_internal_links = $dataSource[0]['allow_reverse_internal_links'];
		$allow_reverse_external_links = $dataSource[0]['allow_reverse_external_links'];
		if($allow_reverse_internal_links == 't' && $allow_reverse_external_links == 't')
		{
			$reverseLinks = 'BOTH';
		}
		else if($allow_reverse_internal_links == 't')
		{
			$reverseLinks = 'INT';
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
		else if($allow_reverse_external_links == 't')
		{
			$reverseLinks = 'EXT';
		}
<<<<<<< HEAD
<<<<<<< HEAD
		$xml .= "    <extRif:reverseLinks>".$reverseLinks."</extRif:reverseLinks>\n";
=======
		$xml .= "    <reverseLinks>".$reverseLinks."</reverseLinks>\n";
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$xml .= "    <extRif:reverseLinks>".$reverseLinks."</extRif:reverseLinks>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Registry Object Originating Source
		// =====================================================================
		$originatingSource = esc($registryObject[0]['originating_source']);
		$originatingSourceType = '';
		if( $registryObject[0]['originating_source_type'] )
		{
			$originatingSourceType = ' type="'.esc($registryObject[0]['originating_source_type']).'"';
		}
<<<<<<< HEAD
<<<<<<< HEAD

		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";

=======
		
		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		$xml .= "    <originatingSource$originatingSourceType>$originatingSource</originatingSource>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Registry Object Class
		// =====================================================================
		$registryObjectClass = strtolower($registryObject[0]['registry_object_class']);
		$type = esc(strtolower($registryObject[0]['type']));
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$dateAccessioned = '';
		if( $registryObject[0]['date_accessioned'] && $registryObjectClass == 'collection' )
		{
			$dateAccessioned = ' dateAccessioned="'.esc(getXMLDateTime($registryObject[0]['date_accessioned'])).'"';
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$dateModified = '';
		if( $registryObject[0]['date_modified'] )
		{
			$dateModified = ' dateModified="'.esc(getXMLDateTime($registryObject[0]['date_modified'])).'"';
<<<<<<< HEAD
<<<<<<< HEAD
		}

		// To prevent empty XML elements, we append to blank string and check that it actually
		// contains data
		$internalxml = "";

		// identifier
		// -------------------------------------------------------------
		$internalxml .= getIdentifierTypesXML($registryObjectKey, 'identifier');

		// displayTitle
		// -------------------------------------------------------------
		$internalxml .= '<extRif:displayTitle>'.esc(trim($registryObject[0]['display_title'])).'</extRif:displayTitle>';
=======
		}	
			
=======
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// To prevent empty XML elements, we append to blank string and check that it actually
		// contains data
		$internalxml = "";

		// identifier
		// -------------------------------------------------------------
		$internalxml .= getIdentifierTypesXML($registryObjectKey, 'identifier');

		// displayTitle
		// -------------------------------------------------------------
<<<<<<< HEAD
		$internalxml .= '<displayTitle>'.esc(trim($registryObject[0]['display_title'])).'</displayTitle>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$internalxml .= '<extRif:displayTitle>'.esc(trim($registryObject[0]['display_title'])).'</extRif:displayTitle>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$logo = '';
	//if ($registryObjectClass == 'Party')
	//{
		$logoStr = getDescriptionLogo($registryObjectKey);
		if ($logoStr !== false)
		{
<<<<<<< HEAD
<<<<<<< HEAD

			$internalxml .= '<extRif:displayLogo>'.$logoStr.'</extRif:displayLogo>';
			$logo = <<<HTML
=======
			
			$internalxml .= '<displayLogo>'.$logoStr.'</displayLogo>';
		/*	$logo = <<<HTML
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

			$internalxml .= '<extRif:displayLogo>'.$logoStr.'</extRif:displayLogo>';
			$logo = <<<HTML
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					<span style="position:relative;float:right;"><img id="party_logo" style="right:0; top:0;position:absolute; float:right;" src="{$logoStr}"/></span>
					<script type="text/javascript">
					testLogo('party_logo', '{$logoStr}');
					</script>
<<<<<<< HEAD
<<<<<<< HEAD
HTML;

		}
	//}

		// listTitle
		// -------------------------------------------------------------
		$internalxml .= '<extRif:listTitle>'.esc(trim($registryObject[0]['list_title'])).'</extRif:listTitle>';

		// name
		// -------------------------------------------------------------
		$internalxml .= getComplexNameTypesXMLforSOLR($registryObjectKey, 'name', $registryObjectClass);

=======
HTML; */
			
		} 
=======
HTML;

		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//}

		// listTitle
		// -------------------------------------------------------------
		$internalxml .= '<extRif:listTitle>'.esc(trim($registryObject[0]['list_title'])).'</extRif:listTitle>';

		// name
		// -------------------------------------------------------------
		$internalxml .= getComplexNameTypesXMLforSOLR($registryObjectKey, 'name', $registryObjectClass);
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// location
		// -------------------------------------------------------------
		$internalxml .= getLocationTypesXMLforSOLR($registryObjectKey, 'location');

		// coverage
		// -------------------------------------------------------------
<<<<<<< HEAD
<<<<<<< HEAD
		$internalxml .= getCoverageTypesXMLforSOLR($registryObjectKey, 'coverage');

		if($includeRelated){
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXMLforSolr($registryObjectKey, $registryObjectClass,$dataSourceKey,'relatedObject');

=======
		$internalxml .= getCoverageTypesXMLforSOLR($registryObjectKey, 'coverage');	
			
		if($includeRelated){
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXMLforSolr($registryObjectKey, $registryObjectClass,$dataSourceKey,'relatedObject');		
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$internalxml .= getCoverageTypesXMLforSOLR($registryObjectKey, 'coverage');

		if($includeRelated){
			// relatedObject
			// -------------------------------------------------------------
			$internalxml .= getRelatedObjectTypesXMLforSolr($registryObjectKey, $registryObjectClass,$dataSourceKey,'relatedObject');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
		// subject
		// -------------------------------------------------------------
		$internalxml .= getSubjectTypesXMLforSOLR($registryObjectKey, 'subject');
<<<<<<< HEAD
<<<<<<< HEAD

		// description
		// -------------------------------------------------------------
		$internalxml .= getDescriptionTypesXMLforSOLR($registryObjectKey, 'description');

		if($registryObjectClass  == 'service')
		{
			// accessPolicy
			// -------------------------------------------------------------
			$internalxml .= getAccessPolicyTypesXML($registryObjectKey, 'accessPolicy');
		}
=======
		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// description
		// -------------------------------------------------------------
		$internalxml .= getDescriptionTypesXMLforSOLR($registryObjectKey, 'description');

		if($registryObjectClass  == 'service')
		{
			// accessPolicy
			// -------------------------------------------------------------
			$internalxml .= getAccessPolicyTypesXML($registryObjectKey, 'accessPolicy');
<<<<<<< HEAD
		}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// relatedInfo
		// -------------------------------------------------------------
		$internalxml .= getRelatedInfoTypesXML($registryObjectKey, 'relatedInfo');
		// existenceDates
		// -------------------------------------------------------------
		$internalxml .= getExistenceDateTypesXMLSolr($registryObjectKey, 'existenceDates');
		// rights
		// -------------------------------------------------------------
		$internalxml .= getRightsTypesXMLforSOLR($registryObjectKey, 'rights');
<<<<<<< HEAD
<<<<<<< HEAD

		//citationInfo
		// -------------------------------------------------------------
		$internalxml .= getCitationInformationTypeXML($registryObjectKey, 'citationInfo');

=======
		
		//citationInfo
		// -------------------------------------------------------------
		$internalxml .= getCitationInformationTypeXML($registryObjectKey, 'citationInfo');
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		//citationInfo
		// -------------------------------------------------------------
		$internalxml .= getCitationInformationTypeXML($registryObjectKey, 'citationInfo');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if (strlen($internalxml) > 0)
		{
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified.">\n";
			$xml .= $internalxml;
			$xml .= "    </$registryObjectClass>\n";
		} else {
			$xml .= "    <$registryObjectClass type=\"$type\"".$dateAccessioned.$dateModified."/>\n";
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$xml .= "  </registryObject>\n";
	}

	return $xml;
<<<<<<< HEAD
<<<<<<< HEAD
	*/
=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	*/
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}


// Datatype handlers
// =============================================================================
function getXMLDateTime($datetime)
{
	return formatDateTimeWithMask($datetime, eDCT_FORMAT_ISO8601_DATETIMESEC_UTC);
}

function getIdentifierTypesXML($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getIdentifiers($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$value = esc($element['value']);
			$xml .= "      <$elementName$type>$value</$elementName>\n";
		}
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD


function getComplexNameTypesXML($registryObjectKey, $elementName, $registryObjectClass, $forSOLR = false)
=======
function getComplexNameTypesXMLforSOLR($registryObjectKey, $elementName, $registryObjectClass)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


function getComplexNameTypesXML($registryObjectKey, $elementName, $registryObjectClass, $forSOLR = false)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getComplexNames($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $dateFrom = $element['date_from'] )
			{
				$dateFrom = ' dateFrom="'.getXMLDateTime($dateFrom).'"';
			}
			if( $dateTo = $element['date_to'] )
			{
				$dateTo = ' dateTo="'.getXMLDateTime($dateTo).'"';
			}
<<<<<<< HEAD
=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
<<<<<<< HEAD
<<<<<<< HEAD
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			if ($forSOLR)
			{
				if($element['type'] == 'alternative')
				{
					$xml .= "      <extRif:$elementName$type>\n";
					$xml .= getNamePartsXMLforSOLR($element['complex_name_id'], $registryObjectClass);
					$xml .= "      </extRif:$elementName>\n";
				}
			}

			$xml .= "      <$elementName$dateFrom$dateTo$type$lang>\n";
			$xml .= getNamePartsXML($element['complex_name_id']);
			$xml .= "      </$elementName>\n";

=======
			if($element['type'] == 'alternative')
=======
			if( $lang = $element['lang'] )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			if ($forSOLR)
			{
				if($element['type'] == 'alternative')
				{
					$xml .= "      <extRif:$elementName$type>\n";
					$xml .= getNamePartsXMLforSOLR($element['complex_name_id'], $registryObjectClass);
					$xml .= "      </extRif:$elementName>\n";
				}
			}
<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

			$xml .= "      <$elementName$dateFrom$dateTo$type$lang>\n";
			$xml .= getNamePartsXML($element['complex_name_id']);
			$xml .= "      </$elementName>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
	}
	return $xml;
}

function getNamePartsXMLforSOLR($complex_name_id,$registryObjectClass)
{
	$display_title = '';
	$list_title = '';
<<<<<<< HEAD
<<<<<<< HEAD

	$nameParts = getNameParts($complex_name_id);
=======
	
	$nameParts = getNameParts($complex_name_id);		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	$nameParts = getNameParts($complex_name_id);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if (!is_array($nameParts) || count($nameParts) == 0)
		{
			$display_title = "(no name/title)";
			$list_title = "(no name/title)";
		}
		else if(count($nameParts) == 1)
		{
			$display_title = trim($nameParts[0]['value']);
			$list_title = trim($nameParts[0]['value']);
		}
<<<<<<< HEAD
<<<<<<< HEAD
		else
=======
		else 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		else
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		{
			if ($registryObjectClass == 'party')
			{
				$partyNameParts = array();
				$partyNameParts['title'] = array();
				$partyNameParts['suffix'] = array();
				$partyNameParts['initial'] = array();
				$partyNameParts['given'] = array();
				$partyNameParts['family'] = array();
				$partyNameParts['user_specified_type'] = array();
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				foreach ($nameParts AS $namePart)
				{
					if (in_array(strtolower($namePart['type']), array_keys($partyNameParts)))
					{
						$partyNameParts[strtolower($namePart['type'])][] = trim($namePart['value']);
<<<<<<< HEAD
<<<<<<< HEAD
					}
					else
=======
					} 
					else 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					}
					else
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					{
						$partyNameParts['user_specified_type'][] = trim($namePart['value']);
					}
				}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					$display_title = 	(count($partyNameParts['title']) > 0 ? implode(" ", $partyNameParts['title']) . " " : "") .
										(count($partyNameParts['given']) > 0 ? implode(" ", $partyNameParts['given']) . " " : "") .
										(count($partyNameParts['initial']) > 0 ? implode(" ", $partyNameParts['initial']) . " " : "") .
										(count($partyNameParts['family']) > 0 ? implode(" ", $partyNameParts['family']) . " " : "") .
										(count($partyNameParts['suffix']) > 0 ? implode(" ", $partyNameParts['suffix']) . " " : "") .
										(count($partyNameParts['user_specified_type']) > 0 ? implode(" ", $partyNameParts['user_specified_type']) . " " : "");
<<<<<<< HEAD
=======
					$display_title = 	(count($partyNameParts['title']) > 0 ? implode(" ", $partyNameParts['title']) . " " : "") . 
										(count($partyNameParts['given']) > 0 ? implode(" ", $partyNameParts['given']) . " " : "") . 
										(count($partyNameParts['initial']) > 0 ? implode(" ", $partyNameParts['initial']) . " " : "") . 
										(count($partyNameParts['family']) > 0 ? implode(" ", $partyNameParts['family']) . " " : "") . 
										(count($partyNameParts['suffix']) > 0 ? implode(" ", $partyNameParts['suffix']) . " " : "") . 
										(count($partyNameParts['user_specified_type']) > 0 ? implode(" ", $partyNameParts['user_specified_type']) . " " : ""); 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

					foreach ($partyNameParts['given'] AS &$givenName)
					{
						$givenName = (strlen($givenName) == 1 ? $givenName . "." : $givenName);
					}
<<<<<<< HEAD
<<<<<<< HEAD

=======
					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					foreach ($partyNameParts['initial'] AS &$initial)
					{
						$initial = $initial . ".";
					}
<<<<<<< HEAD
<<<<<<< HEAD

					$list_title = 	(count($partyNameParts['family']) > 0 ? implode(" ", $partyNameParts['family']) : "") .
										(count($partyNameParts['given']) > 0 ? ", " . implode(" ", $partyNameParts['given']) : "") .
										(count($partyNameParts['initial']) > 0 ? " " . implode(" ", $partyNameParts['initial']) : "") .
										(count($partyNameParts['title']) > 0 ? ", " . implode(" ", $partyNameParts['title']) : "") .
										(count($partyNameParts['suffix']) > 0 ? ", " . implode(" ", $partyNameParts['suffix']) : "") .
										(count($partyNameParts['user_specified_type']) > 0 ? " " . implode(" ", $partyNameParts['user_specified_type']) . " " : "");

=======
					
					$list_title = 	(count($partyNameParts['family']) > 0 ? implode(" ", $partyNameParts['family']) : "") .
										(count($partyNameParts['given']) > 0 ? ", " . implode(" ", $partyNameParts['given']) : "") . 
										(count($partyNameParts['initial']) > 0 ? " " . implode(" ", $partyNameParts['initial']) : "") . 
										(count($partyNameParts['title']) > 0 ? ", " . implode(" ", $partyNameParts['title']) : "") . 
										(count($partyNameParts['suffix']) > 0 ? ", " . implode(" ", $partyNameParts['suffix']) : "") . 
										(count($partyNameParts['user_specified_type']) > 0 ? " " . implode(" ", $partyNameParts['user_specified_type']) . " " : ""); 
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

					$list_title = 	(count($partyNameParts['family']) > 0 ? implode(" ", $partyNameParts['family']) : "") .
										(count($partyNameParts['given']) > 0 ? ", " . implode(" ", $partyNameParts['given']) : "") .
										(count($partyNameParts['initial']) > 0 ? " " . implode(" ", $partyNameParts['initial']) : "") .
										(count($partyNameParts['title']) > 0 ? ", " . implode(" ", $partyNameParts['title']) : "") .
										(count($partyNameParts['suffix']) > 0 ? ", " . implode(" ", $partyNameParts['suffix']) : "") .
										(count($partyNameParts['user_specified_type']) > 0 ? " " . implode(" ", $partyNameParts['user_specified_type']) . " " : "");

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			else
			{
				$np = array();
				foreach ($nameParts as $namePart)
				{
					$np[] = trim($namePart['value']);
				}
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$display_title = implode(" ", $np);
				$list_title = implode(" ", $np);
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD

	if($list_title) {$names = "<extRif:listTitle>".esc($list_title)."</extRif:listTitle>\n";}else{$names='';}
	$names .= "<extRif:displayTitle>".esc($display_title)."</extRif:displayTitle>\n";
	return $names;
}

=======
			
	if($list_title) {$names = "<listTitle>".esc($list_title)."</listTitle>\n";}else{$names='';}	
	$names .= "<displayTitle>".esc($display_title)."</displayTitle>\n";
	return $names;
}
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

	if($list_title) {$names = "<extRif:listTitle>".esc($list_title)."</extRif:listTitle>\n";}else{$names='';}
	$names .= "<extRif:displayTitle>".esc($display_title)."</extRif:displayTitle>\n";
	return $names;
}

>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
function getNamePartsXML($complex_name_id)
{
	$xml = '';
	$list = getNameParts($complex_name_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <namePart$type>$value</namePart>\n";
		}
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD
function getLocationTypesXML($registryObjectKey, $elementName, $forSOLR)

=======

function getLocationTypesXMLforSOLR($registryObjectKey, $elementName)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function getLocationTypesXML($registryObjectKey, $elementName, $forSOLR)

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getLocations($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$dateFrom='';
			$dateTo='';
			if( $dateFromValue = $element['date_from'] )

			{
				$dateFrom = ' dateFrom="'.getXMLDateTime($dateFromValue).'"';
				if ($forSOLR)
				{
					$dateFrom .= ' extRif:dateFrom="'.formatDateTime($dateFromValue, gDATE).'"';
				}
			}
			if( $dateToValue = $element['date_to'] )
			{
				$dateTo = ' dateTo="'.getXMLDateTime($dateToValue).'"';
				if ($forSOLR)
				{
					$dateTo .= ' extRif:dateTo="'.formatDateTime($dateToValue, gDATE).'"';
				}

=======
			if( $dateFrom = $element['date_from'] )
			{
				$dateFrom = ' dateFrom="'.formatDateTime($dateFrom, gDATE).'"';
			}
			if( $dateTo = $element['date_to'] )
			{
				$dateTo = ' dateTo="'.formatDateTime($dateTo, gDATE).'"';
			}
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$xml .= "      <$elementName$dateFrom$dateTo$type>\n";
			$xml .= getAddressXMLforSOLR($element['location_id']);
			$xml .= getSpatialTypesXMLforSOLR($element['location_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
=======
			$dateFrom='';
			$dateTo='';
			if( $dateFromValue = $element['date_from'] )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

			{
				$dateFrom = ' dateFrom="'.getXMLDateTime($dateFromValue).'"';
				if ($forSOLR)
				{
					$dateFrom .= ' extRif:dateFrom="'.formatDateTime($dateFromValue, gDATE).'"';
				}
			}
			if( $dateToValue = $element['date_to'] )
			{
<<<<<<< HEAD
				$dateTo = ' dateTo="'.getXMLDateTime($dateTo).'"';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$dateTo = ' dateTo="'.getXMLDateTime($dateToValue).'"';
				if ($forSOLR)
				{
					$dateTo .= ' extRif:dateTo="'.formatDateTime($dateToValue, gDATE).'"';
				}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$xml .= "      <$elementName$dateFrom$dateTo$type>\n";
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getAddressXML($element['location_id'], $forSOLR);
			$xml .= getSpatialTypesXML($element['location_id'], $forSOLR);
=======
			$xml .= getAddressXML($element['location_id']);
			$xml .= getSpatialTypesXML($element['location_id']);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= getAddressXML($element['location_id'], $forSOLR);
			$xml .= getSpatialTypesXML($element['location_id'], $forSOLR);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD
function getCoverageTypesXML($registryObjectKey, $elementName, $forSOLR)

=======


function getCoverageTypesXMLforSOLR($registryObjectKey, $elementName)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function getCoverageTypesXML($registryObjectKey, $elementName, $forSOLR)

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getCoverage($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
<<<<<<< HEAD
<<<<<<< HEAD

			$xml .= "      <$elementName>\n";
			$xml .= getSpatialCoverageXML($element['coverage_id'], $forSOLR);
			$xml .= getTemporalCoverageXML($element['coverage_id'], $forSOLR);
=======
			$xml .= "      <$elementName>\n";
			$xml .= getSpatialCoverageXMLforSOLR($element['coverage_id']);
			$xml .= getTemporalCoverageXMLforSOLR($element['coverage_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

			$xml .= "      <$elementName>\n";
<<<<<<< HEAD
			$xml .= getSpatialCoverageXML($element['coverage_id']);
			$xml .= getTemporalCoverageXML($element['coverage_id']);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= getSpatialCoverageXML($element['coverage_id'], $forSOLR);
			$xml .= getTemporalCoverageXML($element['coverage_id'], $forSOLR);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}


<<<<<<< HEAD
<<<<<<< HEAD
function getSpatialCoverageXML($coverage_id, $forSOLR)
{
	$xml = '';
=======


function getSpatialCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$centre = '';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function getSpatialCoverageXML($coverage_id, $forSOLR)
{
	$xml = '';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$list = getSpatialCoverage($coverage_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
<<<<<<< HEAD
<<<<<<< HEAD
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <spatial$type$lang>$value</spatial>\n";

			if ($forSOLR)
			{

				$xml .= "        <extRif:spatial$type$lang>\n";
				$centre = '';
				if($element['type'] == 'iso19139dcmiBox')
				{
					$valueString =  strtolower(esc($element['value'])).';';
					$matches = array();
					preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
					$north = (float)$matches[1];
					preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
					$south = (float)$matches[1];
					preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
					$west = (float)$matches[1];
					preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
					$east = (float)$matches[1];
					$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "          <extRif:coords>$west,$north $east,$north $east,$south $west,$south $west,$north</extRif:coords>\n";
				}
				else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
				{
					$coordinates = trim(esc($element['value']));
					$coordinates = preg_replace("/\s+/", " ", $coordinates);

					if( validKmlPolyCoords($coordinates) )
					{
						// Build the coordinates string for the centre.
						$points = explode(' ', $coordinates);
						if( count($points) > 0 )
						{
							$north = -90.0;
							$south = 90.0;
							$west = 180.0;
							$east = -180.0;
							foreach( $points as $point )
							{
								$P = explode(',', $point); // lon,lat
								if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
								if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
								if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
								if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
							}
						}
						$centre = (($east+$west)/2).','.(($north+$south)/2);
						$xml .= "          <extRif:coords>$coordinates</extRif:coords>\n";
					}
				}
				else 
				{
					$xml .= $value;
				}
		        if($centre != '')
		        {
		        	$xml .= "          <extRif:center>$centre</extRif:center>\n";
		        }
				$xml .= "        </extRif:spatial>\n";

			}


=======
						
			if($element['type'] == 'iso19139dcmiBox')
=======
			if( $lang = $element['lang'] )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <spatial$type$lang>$value</spatial>\n";

			if ($forSOLR)
			{

				$xml .= "        <extRif:spatial$type$lang>\n";
				$centre = '';
				if($element['type'] == 'iso19139dcmiBox')
				{
					$valueString =  strtolower(esc($element['value'])).';';
					$matches = array();
					preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
					$north = (float)$matches[1];
					preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
					$south = (float)$matches[1];
					preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
					$west = (float)$matches[1];
					preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
					$east = (float)$matches[1];
					$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "          <extRif:coords>$west,$north $east,$north $east,$south $west,$south $west,$north</extRif:coords>\n";
				}
				else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
				{
					$coordinates = trim(esc($element['value']));
					$coordinates = preg_replace("/\s+/", " ", $coordinates);

					if( validKmlPolyCoords($coordinates) )
					{
						// Build the coordinates string for the centre.
						$points = explode(' ', $coordinates);
						if( count($points) > 0 )
						{
							$north = -90.0;
							$south = 90.0;
							$west = 180.0;
							$east = -180.0;
							foreach( $points as $point )
							{
								$P = explode(',', $point); // lon,lat
								if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
								if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
								if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
								if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
							}
						}
						$centre = (($east+$west)/2).','.(($north+$south)/2);
						$xml .= "          <extRif:coords>$coordinates</extRif:coords>\n";
					}
				}
				else 
				{
					$xml .= $value;
				}
		        if($centre != '')
		        {
		        	$xml .= "          <extRif:center>$centre</extRif:center>\n";
		        }
				$xml .= "        </extRif:spatial>\n";

			}


<<<<<<< HEAD
function getSpatialCoverageXML($coverage_id)
{
	$xml = '';
	$list = getSpatialCoverage($coverage_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <spatial$type$lang>$value</spatial>\n";
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD


function getTemporalCoverageXML($coverage_id, $forSOLR)

=======
function getTemporalCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$list = getTemporalCoverage($coverage_id);

	if($list)
	{
		foreach( $list as $element )
		{
			$dateArray = getTemporalCoverageDate($element['temporal_coverage_id']);
			if($dateArray)
			{
				$xml .= '<temporal>';
				asort($dateArray);
				foreach( $dateArray as $row )
				{
					$type = ' type="'.esc($row['type']).'"';	
					$dateFormat = ' dateFormat="'.esc($row['date_format']).'"';
					$value = esc($row['value']);
					if (preg_match('/\b\d{4}\b/', $value, $matches)) 
					{
	    				$year = $matches[0];
						$xml .= "            <date$type$dateFormat>$year</date>\n";
					}
					}
				$xml .= '</temporal>';	
			}
		}	
	}
	return $xml;
}
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


function getTemporalCoverageXML($coverage_id, $forSOLR)

<<<<<<< HEAD
function getTemporalCoverageXML($coverage_id)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$list = getTemporalCoverage($coverage_id);

	if($list)
	{
<<<<<<< HEAD
<<<<<<< HEAD
	$xml .= "        <temporal>\n";
		foreach( $list as $element )
		{

=======
	$xml .= '<temporal>';
		foreach( $list as $element )
		{
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$xml .= "        <temporal>\n";
		foreach( $list as $element )
		{

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$textArray = getTemporalCoverageText($element['temporal_coverage_id']);
			$dateArray = getTemporalCoverageDate($element['temporal_coverage_id']);
			if($textArray)
			{
				asort($textArray);
				foreach( $textArray  as $row )
				{
					if($value = $row['value'])
					{
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= "          <text>".esc($value)."</text>\n";
					}
				}
=======
					$xml .= '<text>'.esc($value).'</text>';
					}
				}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= "          <text>".esc($value)."</text>\n";
					}
				}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			if($dateArray)
			{
				asort($dateArray);
				foreach( $dateArray as $row )
				{
<<<<<<< HEAD
<<<<<<< HEAD
					$type = ' type="'.esc($row['type']).'"';
					$dateFormat = ' dateFormat="'.esc($row['date_format']).'"';
					$value = esc($row['value']);
					$xml .= "          <date$type$dateFormat>$value</date>\n";

					if ($forSOLR && preg_match('/\b\d{4}\b/', $value, $matches))
					{
						$year = $matches[0];
						$xml .= "          <extRif:date$type$dateFormat>$year</extRif:date>\n";
					}
				}
			}
		}

	$xml .= "        </temporal>\n";
=======
					$type = ' type="'.esc($row['type']).'"';	
=======
					$type = ' type="'.esc($row['type']).'"';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					$dateFormat = ' dateFormat="'.esc($row['date_format']).'"';
					$value = esc($row['value']);
					$xml .= "          <date$type$dateFormat>$value</date>\n";

					if ($forSOLR && preg_match('/\b\d{4}\b/', $value, $matches))
					{
						$year = $matches[0];
						$xml .= "          <extRif:date$type$dateFormat>$year</extRif:date>\n";
					}
				}
			}
		}
<<<<<<< HEAD
	$xml .= '</temporal>';	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	$xml .= "        </temporal>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	return $xml;
}


function getCitationInformationTypeXML($registryObjectKey, $elementName)
{
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$xml = '';
	$citationInfo = '';
	if($array = getCitationInformation($registryObjectKey))
	{
		foreach( $array as $row )
		{
			$xml .= "	<".esc($elementName).">\n";
			$xml .= drawCitationInfoXML($row['citation_info_id'], $row);
			$xml .= "	</".esc($elementName).">\n";
		}
	}
	return $xml;
}


function drawCitationInfoXML($citation_info_id, $row)
{
	$xml = '';
	if($row['full_citation'] != '' || $row['style'] != '')
	{
<<<<<<< HEAD
<<<<<<< HEAD
		$style = ' style="'.esc($row['style']).'"';
=======
		$style = ' style="'.esc($row['style']).'"';	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$style = ' style="'.esc($row['style']).'"';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$value = esc($row['full_citation']);
		$xml .= "	<fullCitation$style>$value</fullCitation>\n";
	}
	else if($row['metadata_identifier'] != '')
	{
		$xml .= "	<citationMetadata>\n";
<<<<<<< HEAD
<<<<<<< HEAD
		$xml .= "		<identifier type=\"".esc($row['metadata_type'])."\">".esc($row['metadata_identifier'])."</identifier>\n";
		$xml .= getCitationContributorsXML($citation_info_id);
		$xml .= "		<title>".esc($row['metadata_title'])."</title>\n";
		$xml .= "		<edition>".esc($row['metadata_edition'])."</edition>\n";
		if($row['metadata_publisher']){$xml .= "		<publisher>".esc($row['metadata_publisher'])."</publisher>\n";}
		$xml .= "		<placePublished>".esc($row['metadata_place_published'])."</placePublished>\n";
		$xml .= getCitationDatesXML($citation_info_id);
		$xml .= "		<url>".esc($row['metadata_url'])."</url>\n";
		$xml .= "		<context>".esc($row['metadata_context'])."</context>\n";
		$xml .= "	</citationMetadata>\n";
	}
	return $xml;

}
=======
		$xml .= "		<identifier type=\"".esc($row['metadata_type'])."\">".esc($row['metadata_identifier'])."</identifier>\n";		
		$xml .= getCitationContributorsXML($citation_info_id);		
=======
		$xml .= "		<identifier type=\"".esc($row['metadata_type'])."\">".esc($row['metadata_identifier'])."</identifier>\n";
		$xml .= getCitationContributorsXML($citation_info_id);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$xml .= "		<title>".esc($row['metadata_title'])."</title>\n";
		$xml .= "		<edition>".esc($row['metadata_edition'])."</edition>\n";
		if($row['metadata_publisher']){$xml .= "		<publisher>".esc($row['metadata_publisher'])."</publisher>\n";}
		$xml .= "		<placePublished>".esc($row['metadata_place_published'])."</placePublished>\n";
		$xml .= getCitationDatesXML($citation_info_id);
		$xml .= "		<url>".esc($row['metadata_url'])."</url>\n";
		$xml .= "		<context>".esc($row['metadata_context'])."</context>\n";
		$xml .= "	</citationMetadata>\n";
	}
	return $xml;
<<<<<<< HEAD
		
}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


function getCitationContributorsXML($citation_info_id)
{
	$xml = '';
	if($array = getCitationContributors($citation_info_id))
	{
		foreach( $array as $row )
		{
			$seq = '';
		    if( $seq = $row['seq'] )
			{
				$seq = ' seq="'.esc($seq).'"';
<<<<<<< HEAD
<<<<<<< HEAD
			}
=======
			}			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "		<contributor$seq>\n";
			$xml .=	getContributorNamePartsXML($row['citation_contributor_id'], $row);
			$xml .= "		</contributor>\n";
		}
	}
	return $xml;
}

function getContributorNamePartsXML($id, $row=null)
{
	$xml = '';
	if($array = getCitationContributorNameParts($id))
	{
	foreach( $array as $row )
		{
			if( $type = $row['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$value = esc($row['value']);
			$xml .= "			<namePart$type>$value</namePart>\n";
		}
	}
	return $xml;
}

function getCitationDatesXML($citation_info_id)
{
	$xml = '';
	if($array = getCitationDates($citation_info_id))
<<<<<<< HEAD
<<<<<<< HEAD
	{
=======
	{	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		foreach( $array as $row )
		{
			$type = ' type="'.esc($row['type']).'"';
			$dateValue = esc($row['date']);
			$xml .= "		<date$type>$dateValue</date>\n";
		}
	}
	return $xml;
}


<<<<<<< HEAD
<<<<<<< HEAD
function getAddressXML($location_id, $forSOLR)
=======
function getAddressXML($location_id)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
{
	$xml = '';
	$list = getAddressLocations($location_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "        <address>\n";
			$xml .= getElectronicAddressTypesXML($element['address_id']);
<<<<<<< HEAD
			$xml .= getPhysicalAddressTypesXML($element['address_id'], $forSOLR);
=======
			$xml .= getPhysicalAddressTypesXML($element['address_id']);
			$xml .= "        </address>\n";
		}
	}
	return $xml;
}
function getAddressXMLforSOLR($location_id)
=======
function getAddressXML($location_id, $forSOLR)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$list = getAddressLocations($location_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "        <address>\n";
			$xml .= getElectronicAddressTypesXML($element['address_id']);
<<<<<<< HEAD
			$xml .= getPhysicalAddressTypesXMLforSOLR($element['address_id']);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= getPhysicalAddressTypesXML($element['address_id'], $forSOLR);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "        </address>\n";
		}
	}
	return $xml;
}
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
function getElectronicAddressTypesXML($address_id)
{
	$xml = '';
	$list = getElectronicAddresses($address_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $value = $element['value'] )
			{
				$value = "            <value>".esc(trim($value))."</value>\n";
<<<<<<< HEAD
<<<<<<< HEAD
			}
			$xml .= "          <electronic$type>\n$value";
			$xml .= getElectronicAddressArgsXML($element['electronic_address_id']);
			$xml .= "          </electronic>\n";
		}
=======
			}			
			$xml .= "          <electronic$type>\n$value";
			$xml .= getElectronicAddressArgsXML($element['electronic_address_id']);
			$xml .= "          </electronic>\n";
		}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			}
			$xml .= "          <electronic$type>\n$value";
			$xml .= getElectronicAddressArgsXML($element['electronic_address_id']);
			$xml .= "          </electronic>\n";
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	return $xml;
}

function getElectronicAddressArgsXML($electronic_address_id)
{
	$xml = '';
	$list = getElectronicAddressArgs($electronic_address_id);
	if( $list )
	{
		foreach( $list as $element )
<<<<<<< HEAD
<<<<<<< HEAD
		{
=======
		{			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$required = "false";
			if( pgsqlBool($element['required']) )
			{
				$required = "true";
			}
			$required = ' required="'.esc($required).'"';
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $use = $element['use'] )
			{
				$use = ' use="'.esc($use).'"';
			}
			$value = esc($element['name']);
			$xml .= "            <arg$required$type$use>$value</arg>\n";
<<<<<<< HEAD
<<<<<<< HEAD
		}
=======
		}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD
function getPhysicalAddressTypesXML($address_id, $forSOLR)
=======
function getPhysicalAddressTypesXML($address_id)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function getPhysicalAddressTypesXML($address_id, $forSOLR)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$list = getPhysicalAddresses($address_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$xml .= "          <physical$type$lang>\n";
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getAddressPartsXML($element['physical_address_id'], $forSOLR);
			$xml .= "          </physical>\n";
		}
	}
	return $xml;
}


function getAddressPartsXML($physical_address_id, $forSOLR)
{
	$xml = '';
	$list = getAddressParts($physical_address_id);
=======
			$xml .= getAddressPartsXML($element['physical_address_id']);	
=======
			$xml .= getAddressPartsXML($element['physical_address_id'], $forSOLR);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "          </physical>\n";
		}
	}
	return $xml;
}


function getAddressPartsXML($physical_address_id, $forSOLR)
{
	$xml = '';
<<<<<<< HEAD
	$list = getPhysicalAddresses($address_id);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$list = getAddressParts($physical_address_id);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$value = esc($element['value']);
			$xml .= "            <addressPart$type>$value</addressPart>\n";

			if ($forSOLR)
<<<<<<< HEAD
			{
				$value = htmlspecialchars_decode($value);
				$value = purify($value);
				$value = htmlspecialchars($value);
				$xml .= "            <extRif:addressPart$type>$value</extRif:addressPart>\n";
			}
		}
=======
			if( $lang = $element['lang'] )
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			{
				$value = htmlspecialchars_decode($value);
				$value = purify($value);
				$value = htmlspecialchars($value);
				$xml .= "            <extRif:addressPart$type>$value</extRif:addressPart>\n";
			}
<<<<<<< HEAD
			$xml .= "          <physical$type$lang>\n";
			$xml .= getAddressPartsXMLforSOLR($element['physical_address_id']);	
			$xml .= "          </physical>\n";
		}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

function getSpatialTypesXML($location_id, $forSOLR)
{
	$xml = '';
	$list = getSpatialLocations($location_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <spatial$type$lang>$value</spatial>\n";
<<<<<<< HEAD

			if ($forSOLR)
			{
				$centre = '';
				$xml .= "        <extRif:spatial>";
				if($element['type'] == 'iso19139dcmiBox')
				{
					$valueString = strtolower(esc($element['value'])).';';
					$matches = array();
					preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
					$north = (float)$matches[1];
					preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
					$south = (float)$matches[1];
					preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
					$west = (float)$matches[1];
					preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
					$east = (float)$matches[1];
					$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "          <extRif:coords>$west,$north $east,$north $east,$south $west,$south $west,$north</extRif:coords>\n";


				}
				else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
				{
					$coordinates = trim(esc($element['value']));
					$coordinates = preg_replace("/\s+/", " ", $coordinates);
					$xml .= "          <extRif:isValidCoords>".validKmlPolyCoords($coordinates)."---".$coordinates."</extRif:isValidCoords>\n";
					//if( validKmlPolyCoords($coordinates) )
					//{
						// Build the coordinates string for the centre.
						$points = explode(' ', $coordinates);
						if( count($points) > 0 )
						{
							$north = -90.0;
							$south = 90.0;
							$west = 180.0;
							$east = -180.0;
							foreach( $points as $point )
							{
								$P = explode(',', $point); // lon,lat
								if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
								if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
								if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
								if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
							}
						}
						$centre = (($east+$west)/2).','.(($north+$south)/2);
					    $xml .= "          <extRif:coords>$coordinates</extRif:coords>\n";

					//}
				}



		        if($centre != '')
		        {
		        	$xml .= "          <extRif:center>$centre</extRif:center>\n";

		        }
		        $xml .= "        </extRif:spatial>";

			}

		}
=======
function getAddressPartsXMLforSOLR($physical_address_id)
=======

			if ($forSOLR)
			{
				$centre = '';
				$xml .= "        <extRif:spatial>";
				if($element['type'] == 'iso19139dcmiBox')
				{
					$valueString = strtolower(esc($element['value'])).';';
					$matches = array();
					preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
					$north = (float)$matches[1];
					preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
					$south = (float)$matches[1];
					preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
					$west = (float)$matches[1];
					preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
					$east = (float)$matches[1];
					$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "          <extRif:coords>$west,$north $east,$north $east,$south $west,$south $west,$north</extRif:coords>\n";


				}
				else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
				{
					$coordinates = trim(esc($element['value']));
					$coordinates = preg_replace("/\s+/", " ", $coordinates);
					$xml .= "          <extRif:isValidCoords>".validKmlPolyCoords($coordinates)."---".$coordinates."</extRif:isValidCoords>\n";
					//if( validKmlPolyCoords($coordinates) )
					//{
						// Build the coordinates string for the centre.
						$points = explode(' ', $coordinates);
						if( count($points) > 0 )
						{
							$north = -90.0;
							$south = 90.0;
							$west = 180.0;
							$east = -180.0;
							foreach( $points as $point )
							{
								$P = explode(',', $point); // lon,lat
								if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
								if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
								if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
								if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
							}
						}
						$centre = (($east+$west)/2).','.(($north+$south)/2);
					    $xml .= "          <extRif:coords>$coordinates</extRif:coords>\n";

					//}
				}



		        if($centre != '')
		        {
		        	$xml .= "          <extRif:center>$centre</extRif:center>\n";

		        }
		        $xml .= "        </extRif:spatial>";

			}

		}
	}
	return $xml;
}

function getRelatedObjectTypesXML($registryObjectKey, $dataSourceKey, $registryObjectClass, $elementName, $forSOLR = false)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	global $typeArray;


	$xml = '';
	$elementName = esc($elementName);

	//we need to check if this has related primary keys
	$dataSource = getDataSources($dataSourceKey, null);
	$create_primary_relationships = $dataSource[0]['create_primary_relationships'];
	$connectionsNum = array();
	$connectionsNum['person']= 0;
	$connectionsNum['group']= 0;
	$connectionsNum['activity']= 0;
	$connectionsNum['service']= 0;
	$connectionsNum['collection']= 0;

	
	$pkey1 = '';
	$pkey2 = '';

	//we do not want to add the related primary objects if we are pasing the rifcs to te manual entry screens
	$caller = explode('/',$_SERVER['PHP_SELF']);
	$thecaller = $caller[count($caller)-1];

	if(($dataSource[0]['create_primary_relationships']=='t'||$dataSource[0]['create_primary_relationships']=='1') && $thecaller != 'process_registry_object.php')
	{
<<<<<<< HEAD
		asort($list);
		foreach( $list as $element )
		{			
			if( $type = $element['type'] )
			{
				$type = ' type="'.strtolower(esc($type)).'"';
			}
			$value = ($element['value']);
			$value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);
			$xml .= "            <addressPart$type>$value</addressPart>\n";
		}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	return $xml;
}

<<<<<<< HEAD
function getRelatedObjectTypesXML($registryObjectKey, $dataSourceKey, $registryObjectClass, $elementName, $forSOLR = false)
{
	global $typeArray;
=======
		$primary_key_1 =  $dataSource[0]['primary_key_1'];
		$primary_key_2 =  $dataSource[0]['primary_key_2'];

		if(trim($dataSource[0]['primary_key_1'])!='' && trim($dataSource[0]['primary_key_1'])!=$registryObjectKey)
		{

			$pkey1 = esc($dataSource[0]["primary_key_1"]);
			$relatedObject = getRegistryObject($pkey1,true);
			$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
			$relation_logo = false;

			if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']])
			{
				$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']].'"';
			}else{
				$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1'].'"';
			}
			if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
			{
				$relation_logo = getDescriptionLogo($key);
			}

			$type = ' type="'.$dataSource[0][$registryObjectClass.'_rel_1'].'"';
			$xml .= "      <$elementName>\n";
			$xml .= "        <key>".$pkey1."</key>\n";
			$xml .= "        <relation$type></relation>\n";
			if ($forSOLR)
			{
				
				if(strtolower($relatedObject[0]['type'])=='person') $connectionsNum['person']++;
				elseif(strtolower($relatedObject[0]['type'])=='group') $connectionsNum['group']++;
				else $connectionsNum[strtolower($relatedObject[0]['registry_object_class'])]++;					
				$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
				$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
				$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
				$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
				$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";				
				if($relation_logo)
					$xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
			}
			$xml .= "      </$elementName>\n";
		}
		if(trim($dataSource[0]['primary_key_2'])!='' && trim($dataSource[0]['primary_key_2'])!=$registryObjectKey)
		{
			$pkey2 = esc($dataSource[0]["primary_key_2"]);
			$relatedObject = getRegistryObject($pkey2,true);
			$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
			$relation_logo = false;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

			if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']])
			{
				$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']].'"';
			}else{
				$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2'].'"';
			}
			if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
			{
				$relation_logo = getDescriptionLogo($key);
			}

<<<<<<< HEAD
	$xml = '';
	$elementName = esc($elementName);

	//we need to check if this has related primary keys
	$dataSource = getDataSources($dataSourceKey, null);
	$create_primary_relationships = $dataSource[0]['create_primary_relationships'];
	$connectionsNum = array();
	$connectionsNum['person']= 0;
	$connectionsNum['group']= 0;
	$connectionsNum['activity']= 0;
	$connectionsNum['service']= 0;
	$connectionsNum['collection']= 0;

	
	$pkey1 = '';
	$pkey2 = '';

	//we do not want to add the related primary objects if we are pasing the rifcs to te manual entry screens
	$caller = explode('/',$_SERVER['PHP_SELF']);
	$thecaller = $caller[count($caller)-1];

	if(($dataSource[0]['create_primary_relationships']=='t'||$dataSource[0]['create_primary_relationships']=='1') && $thecaller != 'process_registry_object.php')
	{
		$primary_key_1 =  $dataSource[0]['primary_key_1'];
		$primary_key_2 =  $dataSource[0]['primary_key_2'];

		if(trim($dataSource[0]['primary_key_1'])!='' && trim($dataSource[0]['primary_key_1'])!=$registryObjectKey)
		{

			$pkey1 = esc($dataSource[0]["primary_key_1"]);
			$relatedObject = getRegistryObject($pkey1,true);
			$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
			$relation_logo = false;

			if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']])
			{
				$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']].'"';
			}else{
				$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1'].'"';
			}
			if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
			{
				$relation_logo = getDescriptionLogo($key);
=======
			$type = ' type="'.$dataSource[0][$registryObjectClass.'_rel_2'].'"';
			$xml .= "      <$elementName>\n";
			$xml .= "        <key>".$pkey2."</key>\n";
			$xml .= "        <relation$type></relation>\n";
			if ($forSOLR)
			{
				if(strtolower($relatedObject[0]['type'])=='person') $connectionsNum['person']++;
				elseif(strtolower($relatedObject[0]['type'])=='group') $connectionsNum['group']++;
				else $connectionsNum[strtolower($relatedObject[0]['registry_object_class'])]++;				
				$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
				$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
				$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
				$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
				$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";				
				if($relation_logo)
					$xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
			}
			$xml .= "      </$elementName>\n";
		}
	}
	$list = getRelatedObjects($registryObjectKey);
	$repeatList = array();
	if( $list )
	{
	foreach( $list as $element )
		{
			$key = esc($element['related_registry_object_key']);
			$repeatKey =false;
			foreach($repeatList as $keyseen)
			{
				if($keyseen==$key) {$repeatKey = true;}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			$repeatList[]=$key;
			if($key!=$pkey1 && $key!=$pkey2)
			{
				$relatedObject = getRegistryObject($element['related_registry_object_key'],true);
				$relation_logo = false;
				$relationType = getRelationType($element['relation_id']);
				if(isset($relatedObject[0]['type']) && strtolower($relatedObject[0]['registry_object_class'])!=''){
					$relatedObject[0]['registry_object_class'] = strtolower($relatedObject[0]['registry_object_class']);
					if(strtolower($relatedObject[0]['type'])=='person') { $connectionsNum['person']++; }
					elseif(strtolower($relatedObject[0]['type'])=='group') { $connectionsNum['group']++;}
					elseif(isset($relatedObject[0]['registry_object_class'])) {$connectionsNum[$relatedObject[0]['registry_object_class']]++;}	
				}
											
				if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
				{
					$relation_logo = getDescriptionLogo($key);
				}
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

<<<<<<< HEAD
			$type = ' type="'.$dataSource[0][$registryObjectClass.'_rel_1'].'"';
			$xml .= "      <$elementName>\n";
			$xml .= "        <key>".$pkey1."</key>\n";
			$xml .= "        <relation$type></relation>\n";
			if ($forSOLR)
			{
				
				if(strtolower($relatedObject[0]['type'])=='person') $connectionsNum['person']++;
				elseif(strtolower($relatedObject[0]['type'])=='group') $connectionsNum['group']++;
				else $connectionsNum[strtolower($relatedObject[0]['registry_object_class'])]++;					
				$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
				$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
				$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
				$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
				$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";				
				if($relation_logo)
					$xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
			}
			$xml .= "      </$elementName>\n";
		}
		if(trim($dataSource[0]['primary_key_2'])!='' && trim($dataSource[0]['primary_key_2'])!=$registryObjectKey)
		{
			$pkey2 = esc($dataSource[0]["primary_key_2"]);
			$relatedObject = getRegistryObject($pkey2,true);
			$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
			$relation_logo = false;

			if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']])
			{
				$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']].'"';
			}else{
				$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2'].'"';
			}
			if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
			{
				$relation_logo = getDescriptionLogo($key);
			}

			$type = ' type="'.$dataSource[0][$registryObjectClass.'_rel_2'].'"';
			$xml .= "      <$elementName>\n";
			$xml .= "        <key>".$pkey2."</key>\n";
			$xml .= "        <relation$type></relation>\n";
			if ($forSOLR)
			{
				if(strtolower($relatedObject[0]['type'])=='person') $connectionsNum['person']++;
				elseif(strtolower($relatedObject[0]['type'])=='group') $connectionsNum['group']++;
				else $connectionsNum[strtolower($relatedObject[0]['registry_object_class'])]++;				
				$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
				$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
				$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
				$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
				$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";				
				if($relation_logo)
					$xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
			}
			$xml .= "      </$elementName>\n";
		}
	}
	$list = getRelatedObjects($registryObjectKey);
	$repeatList = array();
	if( $list )
	{
	foreach( $list as $element )
		{
			$key = esc($element['related_registry_object_key']);
			$repeatKey =false;
			foreach($repeatList as $keyseen)
			{
				if($keyseen==$key) {$repeatKey = true;}
			}
			$repeatList[]=$key;
			if($key!=$pkey1 && $key!=$pkey2)
			{
				$relatedObject = getRegistryObject($element['related_registry_object_key'],true);
				$relation_logo = false;
				$relationType = getRelationType($element['relation_id']);
				if(isset($relatedObject[0]['type']) && strtolower($relatedObject[0]['registry_object_class'])!=''){
					$relatedObject[0]['registry_object_class'] = strtolower($relatedObject[0]['registry_object_class']);
					if(strtolower($relatedObject[0]['type'])=='person') { $connectionsNum['person']++; }
					elseif(strtolower($relatedObject[0]['type'])=='group') { $connectionsNum['group']++;}
					elseif(isset($relatedObject[0]['registry_object_class'])) {$connectionsNum[$relatedObject[0]['registry_object_class']]++;}	
				}
											
				if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
				{
					$relation_logo = getDescriptionLogo($key);
				}
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$key</key>\n";
				$xml .= getRelationsXML($element['relation_id'], $typeArray[$registryObjectClass],$forSOLR);
				if($forSOLR && ! $repeatKey)
				{
					$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
					$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
					$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
					$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
					$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";					
					if($relation_logo) $xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
				}
				$xml .= "      </$elementName>\n";
			}
		}
	}
	
	$listInt = getInternalReverseRelatedObjects($registryObjectKey, $dataSourceKey);
	if( $listInt && $forSOLR)
	{
	foreach( $listInt as $element )
		{
			$key = esc($element['registry_object_key']);
			$notAlreadyGot = false;
			if($list){
				foreach($list as $alreadyGot)
				{
					if($alreadyGot['related_registry_object_key']==$key) {$notAlreadyGot = true;}
				}
			}
			$repeatKey =false;
			foreach($repeatList as $keyseen)
			{
				if($keyseen==$key) {$repeatKey = true;}
			}
			$repeatList[]=$key;
			if($key!=$pkey1 && $key!=$pkey2 && !$notAlreadyGot)
			{
=======
				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$key</key>\n";
				$xml .= getRelationsXML($element['relation_id'], $typeArray[$registryObjectClass],$forSOLR);
				if($forSOLR && ! $repeatKey)
				{
					$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
					$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
					$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
					$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
					$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";					
					if($relation_logo) $xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
				}
				$xml .= "      </$elementName>\n";
			}
		}
	}
	
	$listInt = getInternalReverseRelatedObjects($registryObjectKey, $dataSourceKey);
	if( $listInt && $forSOLR)
	{
	foreach( $listInt as $element )
		{
			$key = esc($element['registry_object_key']);
			$notAlreadyGot = false;
			if($list){
				foreach($list as $alreadyGot)
				{
					if($alreadyGot['related_registry_object_key']==$key) {$notAlreadyGot = true;}
				}
			}
			$repeatKey =false;
			foreach($repeatList as $keyseen)
			{
				if($keyseen==$key) {$repeatKey = true;}
			}
			$repeatList[]=$key;
			if($key!=$pkey1 && $key!=$pkey2 && !$notAlreadyGot)
			{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$relatedObject = getRegistryObject($element['registry_object_key'],true);
				$relation_logo = false;
				$addThisRelation = true;
			
					$relationType = getRelationType($element['relation_id']);
					if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
					{
						$relation_logo = getDescriptionLogo($key);
					}
		
					$xml .= "      <$elementName>\n";
					$xml .= "        <key>$key</key>\n";
					//$xml .= getRelationsXML($element['relation_id'],$typeArray[$registryObjectClass], $forSOLR);
					$xml .= getRelationsXML($element['relation_id'], $typeArray[$registryObjectClass],$forSOLR,$getReverse=true);
					if($forSOLR && !$repeatKey)
					{
					$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
					$relatedObject[0]['registry_object_class'] = strtolower($relatedObject[0]['registry_object_class']);
					if(strtolower($relatedObject[0]['type'])=='person') { $connectionsNum['person']++; if($connectionsNum['person']>6) $addThisRelation = false;}
					elseif(strtolower($relatedObject[0]['type'])=='group') { $connectionsNum['group']++; if($connectionsNum['group']>6) $addThisRelation = false;}
					elseif(isset($relatedObject[0]['registry_object_class'])) {$connectionsNum[$relatedObject[0]['registry_object_class']]++;	 if($connectionsNum[$relatedObject[0]['registry_object_class']]>6) $addThisRelation = false;}		
						$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
						$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
						$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
						$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
						$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";						
						$xml .= "        <extRif:relatedObjectReverseType>INTERNAL</extRif:relatedObjectReverseType>\n";							
						if($relation_logo) $xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
					}
					$xml .= "      </$elementName>\n";
		
			}
		}
	} 
	$listExt = getExternalReverseRelatedObjects($registryObjectKey, $dataSourceKey);
	if( $listExt && $forSOLR)
	{
	foreach( $listExt as $element )
		{
			$key = esc($element['registry_object_key']);
			$repeatKey =false;
			foreach($repeatList as $keyseen)
			{
				if($keyseen==$key) {$repeatKey = true;}
			}
			$repeatList[]=$key;
			if($key!=$pkey1 && $key!=$pkey2)
			{
					$relatedObject = getRegistryObject($element['registry_object_key'],true);
					$relation_logo = false;
					$addThisRelation = true;
					if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
					{
						$relation_logo = getDescriptionLogo($key);
					}
					$relatedclass= strtolower($relatedObject[0]['registry_object_class']);
<<<<<<< HEAD

					$xml .= "      <$elementName>\n";
					$xml .= "        <key>$key</key>\n";
					$xml .= getRelationsXML($element['relation_id'],$typeArray[$registryObjectClass], $forSOLR, $getReverse=true);
					if($forSOLR&& !$repeatKey)
					{
						$relatedObject[0]['registry_object_class'] = strtolower($relatedObject[0]['registry_object_class']);
						if(strtolower($relatedObject[0]['type'])=='person') { $connectionsNum['person']++; if($connectionsNum['person']>6) $addThisRelation = false;}
						elseif(strtolower($relatedObject[0]['type'])=='group') { $connectionsNum['group']++; if($connectionsNum['group']>6) $addThisRelation = false;}
						elseif(isset($relatedObject[0]['registry_object_class'])) {$connectionsNum[$relatedObject[0]['registry_object_class']]++;	 if($connectionsNum[$relatedObject[0]['registry_object_class']]>6) $addThisRelation = false;}				
						$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
						$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
						$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
						$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
						$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";						
						$xml .= "        <extRif:relatedObjectReverseType>EXTERNAL</extRif:relatedObjectReverseType>\n";										
						if($relation_logo) $xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
					}
					$xml .= "      </$elementName>\n";
		
			}
		}
	} 
	if($forSOLR){
		$xml .= "<extRif:relatedObjectPersonCount>".$connectionsNum['person']."</extRif:relatedObjectPersonCount>";
		$xml .= "<extRif:relatedObjectGroupCount>".$connectionsNum['group']."</extRif:relatedObjectGroupCount>";	
		$xml .= "<extRif:relatedObjectCollectionCount>".$connectionsNum['collection']."</extRif:relatedObjectCollectionCount>";
		$xml .= "<extRif:relatedObjectServiceCount>".$connectionsNum['service']."</extRif:relatedObjectServiceCount>";
		$xml .= "<extRif:relatedObjectActivityCount>".$connectionsNum['activity']."</extRif:relatedObjectActivityCount>";	
	}		
	return $xml;
} 

function getRelationType($relation_id)
{
	$list = getRelationDescriptions($relation_id);
	$type = '';
=======
function getAddressPartsXML($physical_address_id)
{
	$xml = '';
	$list = getAddressParts($physical_address_id);
	if( $list )
	{
		foreach( $list as $element )
		{			
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$value = esc($element['value']);
			$xml .= "            <addressPart$type>$value</addressPart>\n";
		}		
	}
	return $xml;
}



function getSpatialTypesXMLforSOLR($location_id)
{
	$xml = '';
	$list = getSpatialLocations($location_id);
	$centre = '';
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}

			if($element['type'] == 'iso19139dcmiBox')
			{
				$valueString = strtolower(esc($element['value'])).';';
				$matches = array();
				preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
				$north = (float)$matches[1];
				preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
				$south = (float)$matches[1];
				preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
				$west = (float)$matches[1];
				preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
				$east = (float)$matches[1];	
				$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";		
				$centre = (($east+$west)/2).','.(($north+$south)/2);
				$xml .= "        <spatial>$west,$north $east,$north $east,$south $west,$south $west,$north</spatial>\n";
				
			}
			else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
			{
				$coordinates = trim(esc($element['value']));
				$coordinates = preg_replace("/\s+/", " ", $coordinates);
				
				if( validKmlPolyCoords($coordinates) )
				{
					// Build the coordinates string for the centre.
					$points = explode(' ', $coordinates);
					if( count($points) > 0 )
					{
						$north = -90.0;
						$south = 90.0;
						$west = 180.0;
						$east = -180.0;
						foreach( $points as $point )
						{
							$P = explode(',', $point); // lon,lat
							if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
							if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
							if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
							if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
						}
					}
					$centre = (($east+$west)/2).','.(($north+$south)/2);
				    $xml .= "        <spatial>$coordinates</spatial>\n";
					
				}
			}else{
				
					if( $type = $element['type'] )
					{
						$type = ' type="'.esc($type).'"';
					}
					if( $lang = $element['lang'] )
					{
						$lang = ' xml:lang="'.esc($lang).'"';
					}
					$value = esc($element['value']);
					$xml .= "        <spatial$type$lang>$value</spatial>\n";
				
			}
	        if($centre != '')
	        {
	        	$xml .= "        <center>$centre</center>\n";
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

					$xml .= "      <$elementName>\n";
					$xml .= "        <key>$key</key>\n";
					$xml .= getRelationsXML($element['relation_id'],$typeArray[$registryObjectClass], $forSOLR, $getReverse=true);
					if($forSOLR&& !$repeatKey)
					{
						$relatedObject[0]['registry_object_class'] = strtolower($relatedObject[0]['registry_object_class']);
						if(strtolower($relatedObject[0]['type'])=='person') { $connectionsNum['person']++; if($connectionsNum['person']>6) $addThisRelation = false;}
						elseif(strtolower($relatedObject[0]['type'])=='group') { $connectionsNum['group']++; if($connectionsNum['group']>6) $addThisRelation = false;}
						elseif(isset($relatedObject[0]['registry_object_class'])) {$connectionsNum[$relatedObject[0]['registry_object_class']]++;	 if($connectionsNum[$relatedObject[0]['registry_object_class']]>6) $addThisRelation = false;}				
						$xml .= "        <extRif:relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</extRif:relatedObjectClass>\n";
						$xml .= "        <extRif:relatedObjectType>".strtolower($relatedObject[0]['type'])."</extRif:relatedObjectType>\n";
						$xml .= "        <extRif:relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</extRif:relatedObjectListTitle>\n";
						$xml .= "        <extRif:relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</extRif:relatedObjectDisplayTitle>\n";
						$xml .= "        <extRif:relatedObjectSlug>".esc($relatedObject[0]['url_slug'])."</extRif:relatedObjectSlug>\n";						
						$xml .= "        <extRif:relatedObjectReverseType>EXTERNAL</extRif:relatedObjectReverseType>\n";										
						if($relation_logo) $xml .= "        <extRif:relatedObjectLogo>".esc($relation_logo)."</extRif:relatedObjectLogo>\n";
					}
					$xml .= "      </$elementName>\n";
		
			}
		}
	} 
	if($forSOLR){
		$xml .= "<extRif:relatedObjectPersonCount>".$connectionsNum['person']."</extRif:relatedObjectPersonCount>";
		$xml .= "<extRif:relatedObjectGroupCount>".$connectionsNum['group']."</extRif:relatedObjectGroupCount>";	
		$xml .= "<extRif:relatedObjectCollectionCount>".$connectionsNum['collection']."</extRif:relatedObjectCollectionCount>";
		$xml .= "<extRif:relatedObjectServiceCount>".$connectionsNum['service']."</extRif:relatedObjectServiceCount>";
		$xml .= "<extRif:relatedObjectActivityCount>".$connectionsNum['activity']."</extRif:relatedObjectActivityCount>";	
	}		
	return $xml;
} 

function getRelationType($relation_id)
{
<<<<<<< HEAD
	$xml = '';
	$list = getSpatialLocations($location_id);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$list = getRelationDescriptions($relation_id);
	$type = '';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
<<<<<<< HEAD
<<<<<<< HEAD
				return $type;
			}

		}
	}
	return $type;
}
function getRelationsXML($relation_id, $typeArray, $forSOLR = false, $getReverse = false)
{

	$xml = '';

	$list = getRelationDescriptions($relation_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$type ='';
			if( $etype = $element['type'] )
			{

				if ($forSOLR && !$getReverse)
				{
					if( array_key_exists($etype, $typeArray) )
					{
						$type .= ' extRif:type="'.$typeArray[$etype][0].'"';
					}
					else
					{
						$type .= ' extRif:type="'.changeFromCamelCase($etype).'"';
					}
				}
				if ($forSOLR && $getReverse)
				{
					if( array_key_exists($etype, $typeArray) )
					{
						$type .= ' extRif:type="'.$typeArray[$etype][1].'"';
					}
					else
					{
						$type .= ' extRif:type="'.changeFromCamelCase($etype).'"';
					}
				}
				$type .= ' type="'.esc($etype).'"';

			}
			if( $description = $element['description'] )
			{
				if( $lang = $element['lang'] )
				{
					$lang = ' xml:lang="'.esc($lang).'"';
				}
				$description = "          <description$lang>".esc($element['description'])."</description>\n";
			}
			if( $url = $element['url'] )
			{
				$url = "          <url>".esc($element['url'])."</url>\n";
			}
			$xml .= "        <relation$type>$description$url</relation>\n";
=======
				return $type;
			}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

		}
	}
	return $type;
}
<<<<<<< HEAD


function getSubjectTypesXML($registryObjectKey, $elementName, $forSOLR=false)
{
	global $gVOCAB_RESOLVER_SERVICE;
	global $gVOCAB_RESOLVER_RESULTS;
	$localBroaderTerms = array();
	$xml = '';
	$elementName = esc($elementName);
	$list = getSubjects($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{

			$vocabType = esc($element['type']);
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			if( $termId = $element['termIdentifier'] )
			{
				$termId = ' termIdentifier="'.esc($termId).'"';
			}
			$rawvalue = trim(esc($element['value']));
			$value = $rawvalue;
			$term = '';
			if ($forSOLR)
			{
				// If we are generating extended RIFCS, lets query the vocabulary service (if available)
				$resourceUrlComp = 'resource.json?uri=';
				
				$resolvedName = $rawvalue; // the resolved name (default to the value of the subject)
				$vocabUri = 'null'; // the URI of the concept (if identified)
				
				// Check whether we have a resolver defined for this subject type
				if(array_key_exists($vocabType, $gVOCAB_RESOLVER_SERVICE))
				{
					$resolvingService = $gVOCAB_RESOLVER_SERVICE[$vocabType]['resolvingService'];
					$uriprefix = $gVOCAB_RESOLVER_SERVICE[$vocabType]['uriprefix'];
					$vocabType = strtolower($vocabType);
					
					// Check if we already have a cached result for this type-value pair, no need for any further search! :-)			
					if(isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]) && $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['vocabUri'] != 'null')
					{
						$resolvedName = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['resolvedLabel'];
						$rawvalue = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['notation'];
						$vocabUri = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['vocabUri'];
			
						// Fill up our localBroaderTerms array
						$localBroaderTerms[$vocabUri] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
 						$localBroaderTerms[$vocabUri]['vocabType'] = $vocabType;
						
						if(isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms']))
						{
							foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] AS $broaderTerm) {
								rollUpBroaderTerms($broaderTerm, $vocabType, $localBroaderTerms);
							}
						}
					}
					
					else if (!isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]))
					{
						// If its a Field of Research Code and numeric, just append the value to determine URI (naive assumption, but save one service call)
						if(is_numeric($rawvalue) && $vocabType=='anzsrc-for')
						{
							$vocabUri = $uriprefix.$rawvalue;
							// Hit the vocab service once to try and resolve the vocab according to its URI
							$resolved_by_label_array = resolveVocabByURI($resolvingService, $vocabUri);
						}
						else if ($vocabUri == 'null')
						{
							// Hit the vocab service once to try and resolve the vocab according to its label
							$resolved_by_label_array = resolveVocabByLabel($resolvingService, $rawvalue);
						}
						
						// Vocab service returned a match
						if (isset($resolved_by_label_array['vocabUri']) && $resolved_by_label_array['vocabUri'] != 'null')
						{
								$vocabUri = $resolved_by_label_array['vocabUri'];

								$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri] = $resolved_by_label_array;
								$gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue] = &$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
								$resolvedName = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['resolvedLabel'];
								$rawvalue = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['notation'];
								
								if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'])) {
									// Populate these broader terms!
									populateBroaderTerms($vocabUri, $resolvingService, $vocabType);
									
									// Roll anything broader up into $localBroaderTerms
									$localBroaderTerms[$vocabUri] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
 									$localBroaderTerms[$vocabUri]['vocabType'] = $vocabType;
 									foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] AS $broaderTerm)
									{
 										// Roll anything broader up into $localBroaderTerms
										rollUpBroaderTerms($broaderTerm, $vocabType, $localBroaderTerms);
									}
									
								}
						}
						else
						{
							// No match found, lets instantiate this cached result to null
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue] = array('vocabUri' => 'null');
						}
						unset($resolved_by_label_array);
					}
				}
				$term = " extRif:resolvedValue=\"" . $resolvedName . "\" extRif:vocabUri=\"" . $vocabUri . "\"";
				
			}
			$xml .= "      <$elementName$type$lang$term>$rawvalue</$elementName>\n";
		}
		//var_dump($registryObjectKey)
		//var_dump($localBroaderTerms);
		if ($forSOLR)
		{
			$xml .= broaderTermsXML('extRif:broaderSubject', $localBroaderTerms);
		}
	}

	return $xml;
}

function resolveVocabByLabel($resolvingService, $rawvalue)
{
	$resolved_vocab = array('vocabUri' => 'null');
	
	$resourcePrefLabelComp = 'concept.json?anylabel=';
	$uri = $resolvingService.$resourcePrefLabelComp.urlencode($rawvalue);
	$header = get_headers($uri);
	if($header[0]=='HTTP/1.1 200 OK')
	{
		$data = json_decode(file_get_contents($uri), true);

		if (isset($data['result']['items']))
		{
		
			foreach($data['result']['items'] AS $item)
			{
				$resolved_vocab = array(
									'vocabUri' => $item['_about'], 
									'resolvedLabel' => $item['prefLabel']['_value'],
									'notation' => $item['notation'],
									);
				
				// This is a string now, not an array??
				if (isset($item['broader']))
				{
					
					if (is_array($item['broader']))
					{
						$resolved_vocab['broaderTerms'] = array();
						foreach($item['broader'] AS $k => $b)
						{
							if (is_array($b))
							{
								$resolved_vocab['broaderTerms'][] = $b['_about'];
							}
							else if ($k == "_about") 
							{
								$resolved_vocab['broaderTerms'][] = $b;
							}
						}	
					}
					else
					{
						$resolved_vocab['broaderTerms'] = array($item['broader']);
					}
				}
			}
		
		}
		
	}

	return $resolved_vocab;
}


function resolveVocabByURI($resolvingService, $rawvalue)
{
	$resolved_vocab = array('vocabUri' => 'null');
	
	$resourcePrefLabelComp = 'resource.json?uri=';
	$uri = $resolvingService.$resourcePrefLabelComp.urlencode($rawvalue);
	$header = get_headers($uri);
	if($header[0]=='HTTP/1.1 200 OK')
	{
		$data = json_decode(file_get_contents($uri), true);

		if (isset($data['result']['primaryTopic']))
		{
			$item = $data['result']['primaryTopic'];
			
			$resolved_vocab = array(
								'vocabUri' => $item['_about'], 
								'resolvedLabel' => $item['prefLabel']['_value'],
								'notation' => $item['notation'],
								);
			
			// This is a string now, not an array??
			if (isset($item['broader']))
			{
				if (is_array($item['broader']))
				{
					$resolved_vocab['broaderTerms'] = array();
					foreach($item['broader'] AS $k => $b)
					{
						if (is_array($b))
						{
							$resolved_vocab['broaderTerms'][] = $b['_about'];
						}
						else if ($k == "_about") 
						{
							$resolved_vocab['broaderTerms'][] = $b;
						}
					}	
				}
				else
				{
					$resolved_vocab['broaderTerms'] = array($item['broader']);
				}
			}
		
		}
		
	}
	return $resolved_vocab;
}


function populateBroaderTerms($broaderTerm, $resolvingService, $vocabType)
{
	global $gVOCAB_RESOLVER_RESULTS;
	$resourceUrlComp = 'allBroader.json?uri=';
	if(array_key_exists($broaderTerm, $gVOCAB_RESOLVER_RESULTS[$vocabType]))
	{
		
		$uri = $resolvingService.$resourceUrlComp.$broaderTerm;
		$header = get_headers($uri);
		if($header[0]=='HTTP/1.1 200 OK')
		{
			$data = json_decode(file_get_contents($uri), true);
			
			if (isset($data['result']['items']))
			{
				foreach($data['result']['items'] AS $item)
				{
					// Populate global array
					$vocabUri = $item['_about'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri] = array();
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['resolvedLabel'] = $item['prefLabel']['_value'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['notation'] = $item['notation'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['vocabUri'] = $vocabUri;
					
					// If there are broader terms listed, add their URIs to the broaderTerms for this item
					if (isset($item['broader']))
					{
						$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array();
						
						if (is_array($item['broader']))
						{
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array();
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'][] = $item['broader']['_about'];

						}
						else
						{
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array($item['broader']);
						}
					}
				}
			}
		
		}
		else
		{
			// Nullify this vocab item
			$gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm] = array("vocabUri" => 'null');
		}
	}
}

function rollUpBroaderTerms($targetTerm, $vocabType, &$localBroaderTerms)
{
	global $gVOCAB_RESOLVER_RESULTS;
	$localBroaderTerms[$targetTerm] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm];
 	$localBroaderTerms[$targetTerm]['vocabType'] = $vocabType;
	
	if (!isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm]['broaderTerms']))
	{
		return;
	}
	
	foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm]['broaderTerms'] AS $broaderTerm)
	{
		// Add the broader term to our localBroaderTerms array
		if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm]))
		{
			$localBroaderTerms[$broaderTerm] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm];
			$localBroaderTerms[$broaderTerm]['vocabType'] = $vocabType;
		} 
		else 
		{
			echo "Error...rolling up subjects through an unfinished tree...";	
		}
		
		// Recurse into this subject's broader terms again if there are any
		if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm]['broaderTerms']))
		{
			foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm] AS $furtherBroaderTerms)
			{
				rollUpBroaderTerms($targetTerm, $vocabType, $localBroaderTerms);
			}
		}
	}
}

function broaderTermsXML($elementName, $localBroaderTerms)
{
	$xml = "";
	foreach( $localBroaderTerms as $term )
	{
		$type = ' type="'.$term['vocabType'].'"';
		$eTerm = " extRif:resolvedValue=\"" . $term['resolvedLabel'] . "\" extRif:vocabUri=\"" . $term['vocabUri'] . "\"";
		$xml .= "      <$elementName$type$eTerm>".$term['notation']."</$elementName>\n";
=======
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = esc($element['value']);
			$xml .= "        <spatial$type$lang>$value</spatial>\n";
		}
	}
	return $xml;
}

function getRelatedObjectTypesXMLforSolr($registryObjectKey,$registryObjectClass, $dataSourceKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$datasource = null;
	$dataSource = getDataSources($dataSourceKey, null);	
	$create_primary_relationships = $dataSource[0]['create_primary_relationships'];
	$typeArray['collection'] = array(
		"describes" => "Describes",
		"hasAssociationWith" => "Associated with",
		"hasDerivedCollection" => "Derived collection",
		"hasCollector" => "Aggregated by",
		"hasPart" => "Contains",
		"isDerivedFrom" => "Derived from",	
		"isDescribedBy" => "Described by",
		"isLocatedIn" => "Located in",
		"isLocationFor" => "Location for",
		"isEnrichedBy" => "Enriched by",
		"isManagedBy" => "Managed by",
		"isOutputOf" => "Output of",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"supports" => "Supports",
		"isAvailableThrough" => "Available through",	
		"isProducedBy" => "Produced by",	
		"isPresentedBy" => "Presented by",	
		"isOperatedOnBy" => "Operated on by",	
		"hasValueAddedBy" => "Value added by"	
			
	);
	$typeArray['party'] = array(
		"hasAssociationWith" => "Associated with",
		"hasMember" => "Has member",
		"hasPart" => "Has part",
		"isCollectorOf" => "Collector of",
		"enriches" => "Enriches",	
		"isFundedBy" => "Funded by",
		"isFunderOf" => "Funds",
		"isManagedBy" => "Managed by",
		"isManagerOf" => "Manages",
		"isMemberOf" => "Member of",
		"isOwnedBy" => "Owned by",
		"isOwnerOf" => "Owner of",
		"isParticipantIn" => "Participant in",
		"isPartOf" => "Part of"
		
	);
	$typeArray['service'] = array(
		"hasAssociationWith" => "Associated with",
		"hasPart" => "Includes",
		"isManagedBy" => "Managed by",
		"isMemberOf" => "Member of",	
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"isOutputOf" => "Output of",	
		"isSupportedBy" => "Supported by",
		"makesAvailable" => "Makes available",
		"produces" => "Produces",		
		"presents" => "Presents",	
		"operatesOn" => "Operates on",
		"adddsValueTo" => "Adds value to"			
	);
	$typeArray['activity'] = array(
		"hasAssociationWith" => "Associated with",
		"hasOutput" => "Produces",
		"hasPart" => "Includes",
		"hasParticipant" => "Undertaken by",
		"isFundedBy" => "Funded by",
		"isManagedBy" => "Managed by",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of"
	);	
=======
function getRelationsXML($relation_id, $typeArray, $forSOLR = false, $getReverse = false)
{

	$xml = '';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

	$list = getRelationDescriptions($relation_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$type ='';
			if( $etype = $element['type'] )
			{

				if ($forSOLR && !$getReverse)
				{
					if( array_key_exists($etype, $typeArray) )
					{
						$type .= ' extRif:type="'.$typeArray[$etype][0].'"';
					}
					else
					{
						$type .= ' extRif:type="'.changeFromCamelCase($etype).'"';
					}
				}
				if ($forSOLR && $getReverse)
				{
					if( array_key_exists($etype, $typeArray) )
					{
						$type .= ' extRif:type="'.$typeArray[$etype][1].'"';
					}
					else
					{
						$type .= ' extRif:type="'.changeFromCamelCase($etype).'"';
					}
				}
				$type .= ' type="'.esc($etype).'"';

			}
			if( $description = $element['description'] )
			{
				if( $lang = $element['lang'] )
				{
					$lang = ' xml:lang="'.esc($lang).'"';
				}
				$description = "          <description$lang>".esc($element['description'])."</description>\n";
			}
			if( $url = $element['url'] )
			{
				$url = "          <url>".esc($element['url'])."</url>\n";
			}
			$xml .= "        <relation$type>$description$url</relation>\n";

		}
	}
	return $xml;
}


function getSubjectTypesXML($registryObjectKey, $elementName, $forSOLR=false)
{
	global $gVOCAB_RESOLVER_SERVICE;
	global $gVOCAB_RESOLVER_RESULTS;
	$localBroaderTerms = array();
	$xml = '';
	$elementName = esc($elementName);
	$list = getSubjects($registryObjectKey);
	if( $list )
	{

		foreach( $list as $element )
		{
			$vocabType = esc($element['type']);
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			if( $termId = $element['termIdentifier'] )
			{
				$termId = ' termIdentifier="'.esc($termId).'"';
			}
			$rawvalue = trim(esc($element['value']));
			$value = $rawvalue;
			$term = '';
			if ($forSOLR)
			{
				// If we are generating extended RIFCS, lets query the vocabulary service (if available)
				$resourceUrlComp = 'resource.json?uri=';
				
				$resolvedName = $rawvalue; // the resolved name (default to the value of the subject)
				$vocabUri = 'null'; // the URI of the concept (if identified)
				
				// Check whether we have a resolver defined for this subject type
				if(array_key_exists($vocabType, $gVOCAB_RESOLVER_SERVICE))
				{
					$resolvingService = $gVOCAB_RESOLVER_SERVICE[$vocabType]['resolvingService'];
					$uriprefix = $gVOCAB_RESOLVER_SERVICE[$vocabType]['uriprefix'];
					$vocabType = strtolower($vocabType);
					
					// Check if we already have a cached result for this type-value pair, no need for any further search! :-)			
					if(isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]) && $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['vocabUri'] != 'null')
					{
						$resolvedName = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['resolvedLabel'];
						$rawvalue = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['notation'];
						$vocabUri = $gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]['vocabUri'];
			
						// Fill up our localBroaderTerms array
						$localBroaderTerms[$vocabUri] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
 						$localBroaderTerms[$vocabUri]['vocabType'] = $vocabType;
						
						if(isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms']))
						{
							foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] AS $broaderTerm) {
								rollUpBroaderTerms($broaderTerm, $vocabType, $localBroaderTerms);
							}
						}
					}
					
					else if (!isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue]))
					{
						// If its a Field of Research Code and numeric, just append the value to determine URI (naive assumption, but save one service call)
						if(is_numeric($rawvalue) && $vocabType=='anzsrc-for')
						{
							$vocabUri = $uriprefix.$rawvalue;
							// Hit the vocab service once to try and resolve the vocab according to its URI
							$resolved_by_label_array = resolveVocabByURI($resolvingService, $vocabUri);
						}
						else if ($vocabUri == 'null')
						{
							// Hit the vocab service once to try and resolve the vocab according to its label
							$resolved_by_label_array = resolveVocabByLabel($resolvingService, $rawvalue);
						}
						
						// Vocab service returned a match
						if (isset($resolved_by_label_array['vocabUri']) && $resolved_by_label_array['vocabUri'] != 'null')
						{
								$vocabUri = $resolved_by_label_array['vocabUri'];

								$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri] = $resolved_by_label_array;
								$gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue] = &$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
								$resolvedName = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['resolvedLabel'];
								$rawvalue = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['notation'];
								
								if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'])) {
									// Populate these broader terms!
									populateBroaderTerms($vocabUri, $resolvingService, $vocabType);
									
									// Roll anything broader up into $localBroaderTerms
									$localBroaderTerms[$vocabUri] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri];
 									$localBroaderTerms[$vocabUri]['vocabType'] = $vocabType;
 									foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] AS $broaderTerm)
									{
 										// Roll anything broader up into $localBroaderTerms
										rollUpBroaderTerms($broaderTerm, $vocabType, $localBroaderTerms);
									}
									
								}
						}
						else
						{
							// No match found, lets instantiate this cached result to null
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$rawvalue] = array('vocabUri' => 'null');
						}
						unset($resolved_by_label_array);
					}
				}
				$term = " extRif:resolvedValue=\"" . $resolvedName . "\" extRif:vocabUri=\"" . $vocabUri . "\"";
				
			}
			$xml .= "      <$elementName$type$lang$term>$rawvalue</$elementName>\n";
		}
		//var_dump($registryObjectKey)
		//var_dump($localBroaderTerms);
		if ($forSOLR)
		{
			$xml .= broaderTermsXML('extRif:broaderSubject', $localBroaderTerms);
		}
	}
	return $xml;
}

function resolveVocabByLabel($resolvingService, $rawvalue)
{
	$resolved_vocab = array('vocabUri' => 'null');
	
	$resourcePrefLabelComp = 'concept.json?anylabel=';
	$uri = $resolvingService.$resourcePrefLabelComp.urlencode($rawvalue);
	$header = get_headers($uri);
	if($header[0]=='HTTP/1.1 200 OK')
	{
		$data = json_decode(file_get_contents($uri), true);

		if (isset($data['result']['items']))
		{
		
			foreach($data['result']['items'] AS $item)
			{
				$resolved_vocab = array(
									'vocabUri' => $item['_about'], 
									'resolvedLabel' => $item['prefLabel']['_value'],
									'notation' => $item['notation'],
									);
				
				// This is a string now, not an array??
				if (isset($item['broader']))
				{
					
					if (is_array($item['broader']))
					{
						$resolved_vocab['broaderTerms'] = array();
						foreach($item['broader'] AS $k => $b)
						{
							if (is_array($b))
							{
								$resolved_vocab['broaderTerms'][] = $b['_about'];
							}
							else if ($k == "_about") 
							{
								$resolved_vocab['broaderTerms'][] = $b;
							}
						}	
					}
					else
					{
						$resolved_vocab['broaderTerms'] = array($item['broader']);
					}
				}
			}
		
		}
		
	}

	return $resolved_vocab;
}


function resolveVocabByURI($resolvingService, $rawvalue)
{
	$resolved_vocab = array('vocabUri' => 'null');
	
	$resourcePrefLabelComp = 'resource.json?uri=';
	$uri = $resolvingService.$resourcePrefLabelComp.urlencode($rawvalue);
	$header = get_headers($uri);
	if($header[0]=='HTTP/1.1 200 OK')
	{
		$data = json_decode(file_get_contents($uri), true);

		if (isset($data['result']['primaryTopic']))
		{
			$item = $data['result']['primaryTopic'];
			
			$resolved_vocab = array(
								'vocabUri' => $item['_about'], 
								'resolvedLabel' => $item['prefLabel']['_value'],
								'notation' => $item['notation'],
								);
			
			// This is a string now, not an array??
			if (isset($item['broader']))
			{
				if (is_array($item['broader']))
				{
					$resolved_vocab['broaderTerms'] = array();
					foreach($item['broader'] AS $k => $b)
					{
						if (is_array($b))
						{
							$resolved_vocab['broaderTerms'][] = $b['_about'];
						}
						else if ($k == "_about") 
						{
							$resolved_vocab['broaderTerms'][] = $b;
						}
					}	
				}
				else
				{
					$resolved_vocab['broaderTerms'] = array($item['broader']);
				}
			}
		
		}
		
	}
	return $resolved_vocab;
}


function populateBroaderTerms($broaderTerm, $resolvingService, $vocabType)
{
	global $gVOCAB_RESOLVER_RESULTS;
	$resourceUrlComp = 'allBroader.json?uri=';
	if(array_key_exists($broaderTerm, $gVOCAB_RESOLVER_RESULTS[$vocabType]))
	{
		
		$uri = $resolvingService.$resourceUrlComp.$broaderTerm;
		$header = get_headers($uri);
		if($header[0]=='HTTP/1.1 200 OK')
		{
			$data = json_decode(file_get_contents($uri), true);
			
			if (isset($data['result']['items']))
			{
				foreach($data['result']['items'] AS $item)
				{
					// Populate global array
					$vocabUri = $item['_about'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri] = array();
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['resolvedLabel'] = $item['prefLabel']['_value'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['notation'] = $item['notation'];
					$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['vocabUri'] = $vocabUri;
					
					// If there are broader terms listed, add their URIs to the broaderTerms for this item
					if (isset($item['broader']))
					{
						$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array();
						
						if (is_array($item['broader']))
						{
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array();
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'][] = $item['broader']['_about'];

						}
						else
						{
							$gVOCAB_RESOLVER_RESULTS[$vocabType][$vocabUri]['broaderTerms'] = array($item['broader']);
						}
					}
				}
			}
		
		}
		else
		{
			// Nullify this vocab item
			$gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm] = array("vocabUri" => 'null');
		}
	}
}

function rollUpBroaderTerms($targetTerm, $vocabType, &$localBroaderTerms)
{
	global $gVOCAB_RESOLVER_RESULTS;
	$localBroaderTerms[$targetTerm] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm];
 	$localBroaderTerms[$targetTerm]['vocabType'] = $vocabType;
	
	if (!isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm]['broaderTerms']))
	{
		return;
	}
	
	foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$targetTerm]['broaderTerms'] AS $broaderTerm)
	{
		// Add the broader term to our localBroaderTerms array
		if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm]))
		{
<<<<<<< HEAD
			//var_dump($element['type']);
			$value = esc(trim($element['value']));
//merge YS
/*
			$resolvedName = '';
			if(($value != '') && (strlen($value) < 7) && is_numeric($value))
			{
				$valueLength = strlen($value);
				if($valueLength < 6){
					for($i = 0; $i < (6 - $valueLength) ; $i++){
						$value .= '0';
					}				
				}
				$resolvedName = getTermsForVocabByIdentifier(null, $value);
			}
			if($resolvedName && $resolvedName[0]['name'] != '')
			{
				$term = $resolvedName[0]['name'];
			}
			else 
=======
			$localBroaderTerms[$broaderTerm] = $gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm];
			$localBroaderTerms[$broaderTerm]['vocabType'] = $vocabType;
		} 
		else 
		{
			echo "Error...rolling up subjects through an unfinished tree...";	
		}
		
		// Recurse into this subject's broader terms again if there are any
		if (isset($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm]['broaderTerms']))
		{
			foreach ($gVOCAB_RESOLVER_RESULTS[$vocabType][$broaderTerm] AS $furtherBroaderTerms)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			{
				rollUpBroaderTerms($targetTerm, $vocabType, $localBroaderTerms);
			}
<<<<<<< HEAD
			$type = ' type="'.esc($element['type']).'"';
*/
if($value != '')
			{
                                $code='';
				$type = $element['type'];
				$resolvedName = '';
				if($type!='')
				{				
					$upperCase = strtoupper($type);
					//echo $upperCase.' ';
					
					
					if($upperCase=='RFCD'){
						$resolvedName = getTermsForVocabByIdentifier('rfcd', $value);
					}elseif($upperCase=='ANZSRC-FOR'){
						$valueLength = strlen($value);
						if($valueLength < 6){
							for($i = 0; $i < (6 - $valueLength) ; $i++){
								$value .= '0';
							}				
						}
						$resolvedName = getTermsForVocabByIdentifier("ANZSRC-FOR", $value);
						//echo $value;
						$resolvedName = $resolvedName[0]['name'];
						$code = ' code="'.esc($value).'"';
						//$resolvedName="ANZFOR";
					}elseif($upperCase=='ANZSRC-SEO'){
										$valueLength = strlen($value);
						if($valueLength < 6){
							for($i = 0; $i < (6 - $valueLength) ; $i++){
								$value .= '0';
							}				
						}
						$resolvedName = getTermsForVocabByIdentifier('ANZSRC-SEO', $value);
						$resolvedName = $resolvedName[0]['name'];
					}elseif($upperCase=='ANZSRC-TOA'){
										$valueLength = strlen($value);
						if($valueLength < 6){
							for($i = 0; $i < (6 - $valueLength) ; $i++){
								$value .= '0';
							}				
						}
						$resolvedName = getTermsForVocabByIdentifier('ANZSRC-TOA', $value);
						$resolvedName = $resolvedName[0]['name'];
					}elseif($upperCase=='TERN'){
										$valueLength = strlen($value);
						if($valueLength < 6){
							for($i = 0; $i < (6 - $valueLength) ; $i++){
								$value .= '0';
							}
						}
						$resolvedName = getTermsForVocabByIdentifier('TERN', $value);
						$resolvedName = $resolvedName[0]['name'];
					}else{
						$resolvedName = $value;
					}
					
				}
				if( $lang = $element['lang'] )
				{
					$lang = ' xml:lang="'.esc($lang).'"';
				}
				if($resolvedName != '')
				{
					$term = $resolvedName;				
				}
				else {
					$term = $value;
				}
				$type = ' type="'.esc($type).'"';
                               
			$xml .= "      <$elementName$type$code>$term</$elementName>\n";
		}
	}
     }
	return $xml;
=======
		}
	}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function broaderTermsXML($elementName, $localBroaderTerms)
{
	$xml = "";
	foreach( $localBroaderTerms as $term )
	{
<<<<<<< HEAD
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
				
			$value = $element['value'];
			
			if(str_replace("/>","",$value)==$value&&str_replace("</","",$value)==$value)
			{
			$value =  nl2br(str_replace("\t", "&#xA0;&#xA0;&#xA0;&#xA0;", $value));
 			}
			$value = (trim($value));
			
                        $value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);
			
			$xml .= "      <$elementName$type$lang>$value</$elementName>\n";
		}
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$type = ' type="'.$term['vocabType'].'"';
		$eTerm = " extRif:resolvedValue=\"" . $term['resolvedLabel'] . "\" extRif:vocabUri=\"" . $term['vocabUri'] . "\"";
		$xml .= "      <$elementName$type$eTerm>".$term['notation']."</$elementName>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	return $xml;
}

<<<<<<< HEAD
<<<<<<< HEAD
function purify($dirty_html){
	global $runningInBackgroundTask;
	if($runningInBackgroundTask)
	{
	    global $cosi_root;
	    require_once $cosi_root."/orca/htmlpurifier/library/HTMLPurifier.auto.php";
	}
	else
	{
		require_once "../htmlpurifier/library/HTMLPurifier.auto.php";
	}

=======

function purify($dirty_html){
	require_once "../htmlpurifier/library/HTMLPurifier.auto.php";
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function purify($dirty_html){
	global $runningInBackgroundTask;
	if($runningInBackgroundTask)
	{
	    global $cosi_root;
	    require_once $cosi_root."/orca/htmlpurifier/library/HTMLPurifier.auto.php";
	}
	else
	{
		require_once "../htmlpurifier/library/HTMLPurifier.auto.php";
	}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Allowed Elements in HTML
	$HTML_Allowed_Elms = 'a, abbr, acronym, b, blockquote, br, caption, cite, code, dd, del, dfn, div, dl, dt, em, h1, h2, h3, h4, h5, h6, i, img, ins, kbd, li, ol, p, pre, s, span, strike, strong, sub, sup, table, tbody, td, tfoot, th, thead, tr, tt, u, ul, var';

	// Allowed Element Attributes in HTML, element must also be allowed in Allowed Elements for these attributes to work.
	$HTML_Allowed_Attr = 'a.href, a.rev, a.title, a.target, a.rel, abbr.title, acronym.title, blockquote.cite, div.align, div.class, div.id, img.src, img.alt, img.title, img.class, img.align, span.class, span.id, table.class, table.id, table.border, table.cellpadding, table.cellspacing, table.width, td.abbr, td.align, td.class, td.id, td.colspan, td.rowspan, td.valign, tr.align, tr.class, tr.id, tr.valign, th.abbr, th.align, th.class, th.id, th.colspan, th.rowspan, th.valign, img.width, img.height, img.style';
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$config = HTMLPurifier_Config::createDefault();
	$config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
	$config->set('HTML.Doctype', 'XHTML 1.0 Transitional'); // replace with your doctype
	//$config->set('Cache.SerializerPath', '/tmp/htmlfilter/');
	$config->set('HTML.AllowedElements', $HTML_Allowed_Elms); // sets allowed html elements that can be used.
	$config->set('HTML.AllowedAttributes', $HTML_Allowed_Attr); // sets allowed html attributes that can be used.
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$config->set('Cache.DefinitionImpl', null); // disable caching, who cares about performance



<<<<<<< HEAD
=======
	
	
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//$def->removeAttribute('p','font');
    $purifier = new HTMLPurifier($config);
    $clean_html = $purifier->purify($dirty_html);
    return $clean_html;
}
<<<<<<< HEAD
<<<<<<< HEAD
function getDescriptionTypesXML($registryObjectKey, $elementName, $forSOLR)
=======
function getDescriptionTypesXML($registryObjectKey, $elementName)
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function getDescriptionTypesXML($registryObjectKey, $elementName, $forSOLR)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$value = trim($element['value']);
			//if($type = ' type="logo"') $value=strip_tags($value);
			$xml .= "      <$elementName$type$lang>".esc($value)."</$elementName>\n";

			if ($forSOLR)
			{
				$value = htmlspecialchars_decode($value);
				$value = purify($value);
				$value = htmlspecialchars($value);

				$xml .= "      <extRif:$elementName$type$lang>$value</extRif:$elementName>\n";
			}
<<<<<<< HEAD
=======
			$value = esc($element['value']);
			$xml .= "      <$elementName$type$lang>$value</$elementName>\n";
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
	}
	return $xml;
}
function getAccessPolicyTypesXML($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getAccessPolicies($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			$value = esc($element['value']);
			$xml .= "      <$elementName>$value</$elementName>\n";
		}
	}
	return $xml;
}


function getRelatedInfoTypesXML($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getRelatedInfo($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if($value = esc($element['value']))
			{
				$xml .= "	<$elementName>\n";
				$xml .= "		<identifier type=\"uri\">$value</identifier>\n";
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= "	</$elementName>\n";
=======
				$xml .= "	</$elementName>\n";				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= "	</$elementName>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			else
			{
				if($type = $element['info_type'])
				{
				$type = ' type="'.esc($type).'" ';
				}
				$xml .= "<$elementName$type>\n";
				$value = esc($element['identifier']);
				$xml .= "		<identifier type=\"".esc($element['identifier_type'])."\">$value</identifier>\n";
				if($notes = $element['title'])
				{
				$xml .= "		<title>".esc($notes)."</title>\n";
				}
				if($notes = $element['notes'])
				{
				$xml .= "		<notes>".esc($notes)."</notes>\n";
				}
				$xml .= "</$elementName>\n";
			}
		}
	}
	return $xml;
}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

function getRightsTypesXML($registryObjectKey, $elementName, $forSOLR)
{
	$xml = '';
	$elementName = esc($elementName);

	if ($forSOLR)
	{
		$list = getDescriptions($registryObjectKey);
		if( $list )
		{
			foreach( $list as $element )
			{
				if( $type = $element['type'] && ($element['type']=='rights' || $element['type']=='accessRights'))
				{
					$type = ' type="'.esc($element['type']).'"';

				$test = $element['type'];
				$value = esc($element['value']);
				$licence_group = '';
				if($group = checkRightsText($value))
				{
					$licence_group=' licence_group="'.$group.'"';
				}
				$xml .= "      <extRif:$elementName$type$licence_group>$value</extRif:$elementName>\n";
				$type = '';
				}
<<<<<<< HEAD
			}
		}
	}

	$list = getRights($registryObjectKey);
=======
function getRightsTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] && ($element['type']=='rights' || $element['type']=='accessRights'))
			{
				$type = ' type="'.esc($element['type']).'"';
		
			$test = $element['type'];
			$value = esc($element['value']);
			$xml .= "      <$elementName$type>$value</$elementName>\n";
			$type = '';
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
		}
	}

	$list = getRights($registryObjectKey);
<<<<<<< HEAD
	//echo $registryObjectKey;
	//print_r($list);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $list )
	{
		foreach( $list as $element )
		{
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= "      <$elementName>";
			if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
			{
				$subType = 'accessRights';
=======
			if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
			{
				$type = ' type="accessRights"';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= "      <$elementName>";
			if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
			{
				$subType = 'accessRights';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($uri = $element['access_rights_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['access_rights']);
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= "      <$subType$uri>$value</$subType>\n";

			}

			if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
			{
				$subType = 'rightsStatement';
=======
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";				
=======
				$xml .= "      <$subType$uri>$value</$subType>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}

			if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
			{
<<<<<<< HEAD
				$type = ' type="rights"';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$subType = 'rightsStatement';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($uri = $element['rights_statement_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['rights_statement']);
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= "      <$subType$uri>$value</$subType>\n";
			}

			if( $type = $element['licence'] || $type = $element['licence_uri']||$type = $element['licence_type'])
			{
				$type= '';
				$subType = 'licence';
=======
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";								
=======
				$xml .= "      <$subType$uri>$value</$subType>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}

			if( $type = $element['licence'] || $type = $element['licence_uri']||$type = $element['licence_type'])
			{
<<<<<<< HEAD
				$type = ' type="licence"';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$type= '';
				$subType = 'licence';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($uri = $element['licence_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($licence_type = $element['licence_type'])
				{
					$type = ' type = "'.esc($licence_type).'"';
				}else{$type=' type = "Unknown"';}
<<<<<<< HEAD
				$value = esc($element['licence']);
				$xml .= "      <$subType$uri$type>$value</$subType>\n";
			}
			$xml .= "      </$elementName>\n";


			if ($forSOLR)
			{
				$elementName2 = "extRif:rights";

				if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
				{
					$type = ' type="accessRights"';
					if($uri = $element['access_rights_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					$value = esc($element['access_rights']);
					$xml .= "      <$elementName2$type$uri>$value</$elementName2>\n";
				}

				if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
				{
					$type = ' type="rights"';
					if($uri = $element['rights_statement_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					$value = esc($element['rights_statement']);
					$xml .= "      <$elementName2$type$uri>$value</$elementName2>\n";
				}
				$licence_group='';
				if( $type = $element['licence'] || $type = $element['licence_uri']|| $type = $element['licence_type'])
				{
					$type = ' type="licence"';
					if($uri = $element['licence_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					if($licence_type = $element['licence_type'])
					{
						$licence_type = ' licence_type="'.esc($licence_type).'"';
						if($licence_group = getParentType($element['licence_type'])){
							$licence_group = ' licence_group="'.esc($licence_group).'"';
						}else{
							$licence_group=' licence_group="Unknown"';
						}
					}else{
						$licence_group=' licence_group="Unknown"';
					}
					$value = esc($element['licence']);
					$xml .= "      <$elementName2$type$uri$licence_type$licence_group>$value</$elementName2>\n";
				}

			}
		}
	}
	return $xml;
=======
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$value = esc($element['licence']);
				$xml .= "      <$subType$uri$type>$value</$subType>\n";
			}
			$xml .= "      </$elementName>\n";


			if ($forSOLR)
			{
				$elementName2 = "extRif:rights";

				if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
				{
					$type = ' type="accessRights"';
					if($uri = $element['access_rights_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					$value = esc($element['access_rights']);
					$xml .= "      <$elementName2$type$uri>$value</$elementName2>\n";
				}

				if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
				{
					$type = ' type="rights"';
					if($uri = $element['rights_statement_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					$value = esc($element['rights_statement']);
					$xml .= "      <$elementName2$type$uri>$value</$elementName2>\n";
				}
				$licence_group='';
				if( $type = $element['licence'] || $type = $element['licence_uri']|| $type = $element['licence_type'])
				{
					$type = ' type="licence"';
					if($uri = $element['licence_uri'])
					{
						$uri = ' rightsUri = "'.esc($uri).'"';
					}
					if($licence_type = $element['licence_type'])
					{
						$licence_type = ' licence_type="'.esc($licence_type).'"';
						if($licence_group = getParentType($element['licence_type'])){
							$licence_group = ' licence_group="'.esc($licence_group).'"';
						}else{
							$licence_group=' licence_group="Unknown"';
						}
					}else{
						$licence_group=' licence_group="Unknown"';
					}
					$value = esc($element['licence']);
					$xml .= "      <$elementName2$type$uri$licence_type$licence_group>$value</$elementName2>\n";
				}

			}
<<<<<<< HEAD
			$xml .= "      </$elementName>\n";							
		}	
	}	
	return $xml;			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}
	}
	return $xml;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function getExistenceDateTypesXML($registryObjectKey, $elementName)
{
	$xml = '';
	$startdate = '';
	$enddate = '';
	$elementName = esc($elementName);
	$list = getExistenceDate($registryObjectKey);
	if( $list )
<<<<<<< HEAD
<<<<<<< HEAD
	{
=======
	{	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		foreach( $list as $element )
		{
			$xml .=	"		<$elementName>";
			if($startdate = $element['start_date'])
			{
				if($startDateFormat = $element['start_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<startDate$dateFormat>$startdate</startDate>";
			}
			if($enddate = $element['end_date'])
			{
				if($startDateFormat = $element['end_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<endDate$dateFormat>$enddate</endDate>";
<<<<<<< HEAD
<<<<<<< HEAD
			}
=======
			}			
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
function getExistenceDateTypesXMLSolr($registryObjectKey, $elementName)
{
	$xml = '';
	$startdate = '';
	$enddate = '';
	$elementName = esc($elementName);
	$list = getExistenceDate($registryObjectKey);
	if( $list )
	{	
		foreach( $list as $element )
		{
			$xml .=	"		<$elementName>";
			if($startdate = $element['start_date'])
			{
				$startdate1 = FormatDateTime(esc($startdate), gDATE);
				//echo $startdate;
				if($startDateFormat = $element['start_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<startDate$dateFormat>$startdate1</startDate>";
			}
			if($enddate = $element['end_date'])
			{
				$enddate1 = FormatDateTime(esc($enddate), gDATE);				
				if($startDateFormat = $element['end_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<endDate$dateFormat>$enddate1</endDate>";
			}			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
<<<<<<< HEAD
<<<<<<< HEAD

=======
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
function getRegistryObjectKML($registryObjectKey)
{
	$kml = "";
	$locations = getLocations($registryObjectKey);
	$spatialLocations = null;
	$placemarks = array();
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $locations )
	{
		foreach( $locations as $location )
		{
			$locationId = $location['location_id'];
			$locationType = $location['type'];
			$locationDateFrom = $location['date_from'];
			$locationDateTo = $location['date_to'];
<<<<<<< HEAD
<<<<<<< HEAD
			//switch( $locationType )
=======
			//switch( $locationType ) 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			//switch( $locationType )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			//{
				// coverage
			//	case 'coverage':
					if( $spatialLocations = getSpatialLocations($locationId) )
					{
						foreach( $spatialLocations as $spatialLocation )
						{
							$spatialLocationId = $spatialLocation['spatial_location_id'];
							$spatialLocationType = $spatialLocation['type'];
<<<<<<< HEAD
<<<<<<< HEAD
							switch( $spatialLocationType )
=======
							switch( $spatialLocationType ) 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
							switch( $spatialLocationType )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							{
								// -----------------------------------------------------
								// iso19139dcmiBox
								// -----------------------------------------------------
								case 'iso19139dcmiBox':
									// Parse the value and turn it into the KML coordinates string.
									//northlimit=28; southlimit=-70; westlimit=20; eastLimit=127;
									$valueString = $spatialLocation['value'];
									$matches = array();
									preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
									$north = (float)$matches[1];
									preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
									$south = (float)$matches[1];
									preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
									$west = (float)$matches[1];
									preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
<<<<<<< HEAD
<<<<<<< HEAD
									$east = (float)$matches[1];
									// Build the coordinates string.
									$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";

									// Build the coordinates string for the centre.
									$centre = (($east+$west)/2).','.(($north+$south)/2);

									//TODO: Set the style for the marker. regionMarkerStyle_2
=======
									$east = (float)$matches[1];	
=======
									$east = (float)$matches[1];
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Build the coordinates string.
									$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";

									// Build the coordinates string for the centre.
									$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
								
									//TODO: Set the style for the marker. regionMarkerStyle_2 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

									//TODO: Set the style for the marker. regionMarkerStyle_2
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									$markerStyle = 'regionMarkerStyle';
									if( $north === $south && $east === $west )
									{
										$markerStyle = 'pointMarkerStyle';
									}
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Put the entry in the placemarks list.
									$placemarks[] = array( 'name'         => 'Location: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
														   'coordinates'  => $coordinates,
														   'centre'       => $centre,
														   'marker_style' => $markerStyle,
														   'begin'        => $locationDateFrom,
														   'end'          => $locationDateTo
														 );
									break;
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// -----------------------------------------------------
								// gmlKmlPolyCoords
								// -----------------------------------------------------
								case 'gmlKmlPolyCoords':
									// Build the coordinates string.
									$coordinates = trim($spatialLocation['value']);
<<<<<<< HEAD
<<<<<<< HEAD

									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", $coordinates);

=======
								
									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", $coordinates);
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", $coordinates);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									if( validKmlPolyCoords($coordinates) )
									{
										// Build the coordinates string for the centre.
										$points = explode(' ', $coordinates);
										if( count($points) > 0 )
										{
											$north = -90.0;
											$south = 90.0;
											$west = 180.0;
											$east = -180.0;
											foreach( $points as $point )
											{
												$P = explode(',', $point); // lon,lat
												if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
												if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
												if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
												if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
											}
										}
										$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										// Set the style for the marker.
										$markerStyle = 'regionMarkerStyle';
										if( $north === $south && $east === $west )
										{
											$markerStyle = 'pointMarkerStyle';
										}
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										// Put the entry in the placemarks list.
										$placemarks[] = array( 'name'         => 'Location: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
															   'coordinates'  => $coordinates,
															   'centre'       => $centre,
															   'marker_style' => $markerStyle,
															   'begin'        => $locationDateFrom,
															   'end'          => $locationDateTo
															 );
									}
									break;
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// -----------------------------------------------------
								// kmlPolyCoords
								// -----------------------------------------------------
								case 'kmlPolyCoords':
									// Build the coordinates string.
									$coordinates = trim($spatialLocation['value']);
<<<<<<< HEAD
<<<<<<< HEAD

									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", trim($coordinates));

=======
								
									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", trim($coordinates));
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

									// Rationalise whitespace to spaces for the explode in the next step.
									$coordinates = preg_replace("/\s+/", " ", trim($coordinates));

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									if( validKmlPolyCoords($coordinates) )
									{
										// Build the coordinates string for the centre.
										$points = explode(' ', $coordinates);
										if( count($points) > 0 )
										{
											$north = -90.0;
											$south = 90.0;
											$west = 180.0;
											$east = -180.0;
											foreach( $points as $point )
											{
												$P = explode(',', $point); // lon,lat
												if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
												if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
												if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
												if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
											}
										}
										$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										// Set the style for the marker.
										$markerStyle = 'regionMarkerStyle';
										if( $north === $south && $east === $west )
										{
											$markerStyle = 'pointMarkerStyle';
										}
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										// Put the entry in the placemarks list.
										$placemarks[] = array( 'name'         => 'Location: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
															   'coordinates'  => $coordinates,
															   'centre'       => $centre,
															   'marker_style' => $markerStyle,
															   'begin'        => $locationDateFrom,
															   'end'          => $locationDateTo
															 );
<<<<<<< HEAD
<<<<<<< HEAD
									}
									break;

=======
									}			 
									break;
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
									}
									break;

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// -----------------------------------------------------
								default:
									break;
							}
						}
			//		break;
			//		}
			//	default:
			//		break;
			}
		}
	}
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$coverageList = getCoverage($registryObjectKey);
	if( $coverageList )
	{
		foreach( $coverageList  as $coverage )
		{
			$spatialList = getSpatialCoverage($coverage['coverage_id']);
			$temporaLlist = getTemporalCoverage($coverage['coverage_id']);
			$locationDateFrom = '';
			$locationDateTo = '';
			$locationType = 'Coverage';
			//get the dateFrom and dateTo for this spatial coverage
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if($temporaLlist)
			{
				foreach( $temporaLlist as $element )
				{
					$dateArray = getTemporalCoverageDate($element['temporal_coverage_id']);
					if($dateArray)
					{
						foreach( $dateArray as $row )
						{
							if($row['type'] == 'dateFrom')
							{
								$locationDateFrom = esc($row['value']);
							}
							if($row['type'] == 'dateTo')
							{
<<<<<<< HEAD
<<<<<<< HEAD
								$locationDateTo = esc($row['value']);
							}
						}
					}
				}
			}
			if($spatialList)
			{
=======
								$locationDateTo = esc($row['value']);						
=======
								$locationDateTo = esc($row['value']);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							}
						}
					}
				}
			}
			if($spatialList)
<<<<<<< HEAD
			{			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			foreach( $spatialList as $spatialLocation )
					{
						$spatialLocationId = $spatialLocation['spatial_location_id'];
						$spatialLocationType = $spatialLocation['type'];
<<<<<<< HEAD
<<<<<<< HEAD
						switch( $spatialLocationType )
=======
						switch( $spatialLocationType ) 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						switch( $spatialLocationType )
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						{
							// -----------------------------------------------------
							// iso19139dcmiBox
							// -----------------------------------------------------
							case 'iso19139dcmiBox':
								// Parse the value and turn it into the KML coordinates string.
								//northlimit=28; southlimit=-70; westlimit=20; eastLimit=127;
								$valueString = $spatialLocation['value'];
								$matches = array();
								preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
								$north = (float)$matches[1];
								preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
								$south = (float)$matches[1];
								preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
								$west = (float)$matches[1];
								preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
<<<<<<< HEAD
<<<<<<< HEAD
								$east = (float)$matches[1];
								// Build the coordinates string.
								$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";

								// Build the coordinates string for the centre.
								$centre = (($east+$west)/2).','.(($north+$south)/2);

=======
								$east = (float)$matches[1];	
=======
								$east = (float)$matches[1];
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// Build the coordinates string.
								$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";

								// Build the coordinates string for the centre.
								$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// Set the style for the marker.
								$markerStyle = 'regionMarkerStyle';
								if( $north === $south && $east === $west )
								{
									$markerStyle = 'pointMarkerStyle';
								}
<<<<<<< HEAD
<<<<<<< HEAD

=======
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								// Put the entry in the placemarks list.
								$placemarks[] = array( 'name'         => 'Coverage: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
													   'coordinates'  => $coordinates,
													   'centre'       => $centre,
													   'marker_style' => $markerStyle,
													   'begin'        => $locationDateFrom,
													   'end'          => $locationDateTo
													 );
								break;
<<<<<<< HEAD
<<<<<<< HEAD

=======
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// -----------------------------------------------------
							// gmlKmlPolyCoords
							// -----------------------------------------------------
							case 'gmlKmlPolyCoords':
								// Build the coordinates string.
								$coordinates = trim($spatialLocation['value']);
<<<<<<< HEAD
<<<<<<< HEAD

								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", $coordinates);

=======
							
								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", $coordinates);
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", $coordinates);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								if( validKmlPolyCoords($coordinates) )
								{
									// Build the coordinates string for the centre.
									$points = explode(' ', $coordinates);
									if( count($points) > 0 )
									{
										$north = -90.0;
										$south = 90.0;
										$west = 180.0;
										$east = -180.0;
										foreach( $points as $point )
										{
											$P = explode(',', $point); // lon,lat
											if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
											if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
											if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
											if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
										}
									}
									$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Set the style for the marker.
									$markerStyle = 'regionMarkerStyle';
									if( $north === $south && $east === $west )
									{
										$markerStyle = 'pointMarkerStyle';
									}
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Put the entry in the placemarks list.
									$placemarks[] = array( 'name'         => 'Coverage: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
														   'coordinates'  => $coordinates,
														   'centre'       => $centre,
														   'marker_style' => $markerStyle,
														   'begin'        => $locationDateFrom,
														   'end'          => $locationDateTo
														 );
								}
								break;
<<<<<<< HEAD
<<<<<<< HEAD

=======
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// -----------------------------------------------------
							// kmlPolyCoords
							// -----------------------------------------------------
							case 'kmlPolyCoords':
								// Build the coordinates string.
								$coordinates = trim($spatialLocation['value']);
<<<<<<< HEAD
<<<<<<< HEAD

								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", trim($coordinates));

=======
							
								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", trim($coordinates));
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

								// Rationalise whitespace to spaces for the explode in the next step.
								$coordinates = preg_replace("/\s+/", " ", trim($coordinates));

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								if( validKmlPolyCoords($coordinates) )
								{
									// Build the coordinates string for the centre.
									$points = explode(' ', $coordinates);
									if( count($points) > 0 )
									{
										$north = -90.0;
										$south = 90.0;
										$west = 180.0;
										$east = -180.0;
										foreach( $points as $point )
										{
											$P = explode(',', $point); // lon,lat
											if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
											if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
											if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
											if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
										}
									}
									$centre = (($east+$west)/2).','.(($north+$south)/2);
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Set the style for the marker.
									$markerStyle = 'regionMarkerStyle';
									if( $north === $south && $east === $west )
									{
										$markerStyle = 'pointMarkerStyle';
									}
<<<<<<< HEAD
<<<<<<< HEAD

=======
								
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
									// Put the entry in the placemarks list.
									$placemarks[] = array( 'name'         => 'Coverage: '.$locationType.gCHAR_EMDASH.$spatialLocationType,
														   'coordinates'  => $coordinates,
														   'centre'       => $centre,
														   'marker_style' => $markerStyle,
														   'begin'        => $locationDateFrom,
														   'end'          => $locationDateTo
														 );
<<<<<<< HEAD
<<<<<<< HEAD
								}
								break;

=======
								}			 
								break;
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
								}
								break;

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// -----------------------------------------------------
							default:
								break;
						}
<<<<<<< HEAD
<<<<<<< HEAD
					}//END FOR EACH COVERAGE
				}
			}
	}

=======
					}//END FOR EACH COVERAGE	
				}		
			}
	}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					}//END FOR EACH COVERAGE
				}
			}
	}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( count($placemarks) > 0 )
	{
		$name = getNameHTML($registryObjectKey);
		if( $name == '' )
		{
			$name = $registryObjectKey;
		}
		$kml .= '	<Folder>'."\n";
		$kml .= '		<name>'.esc($name).'</name>'."\n";
		$kml .= '		<open>1</open>'."\n";
		foreach( $placemarks as $placemark )
		{
			$kml .= '		<Folder>'."\n";
			$kml .= '			<name>'.esc($placemark['name']).'</name>'."\n";
			$kml .= '			<open>0</open>'."\n";
			if( $placemark['centre'] != '' )
			{
				$kml .= '			<Placemark>'."\n";
				$kml .= '				<name>'.esc($name.' ['.$placemark['name'].']').'</name>'."\n";
				$kml .= '				<styleUrl>#'.esc($placemark['marker_style']).'</styleUrl>'."\n";
				if( $placemark['begin'] || $placemark['end'] )
				{
					$kml .= '				<TimeSpan>'."\n";
					if( $placemark['begin'] )
					{
						$kml .= '				  <begin>'.esc(getXMLDateTime($placemark['begin'])).'</begin>'."\n";
					}
					if( $placemark['end'] )
					{
						$kml .= '				  <end>'.esc(getXMLDateTime($placemark['end'])).'</end>'."\n";
					}
					$kml .= '				</TimeSpan>'."\n";
				}
				$kml .= '				<Point>'."\n";
	        	$kml .= '					<coordinates>'.esc($placemark['centre']).'</coordinates>'."\n";
				$kml .= '				</Point>'."\n";
				$kml .= '				<description><![CDATA[';
				$kml .= '<p>'.esc($placemark['name']).': '.esc($placemark['coordinates']).'</p>'."\n";
				$kml .= '<p>'.getDescriptionsHTML($registryObjectKey, gORCA_HTML_TABLE).'</p>'."\n";
				$kml .= '<p><a href="'.eAPP_ROOT.'orca/view.php?key='.esc(urlencode($registryObjectKey)).'">View the complete record in the ANDS Collection Registry.</a></p>'."\n";
				$kml .= ']]></description>'."\n";
				$kml .= '			</Placemark>'."\n";
			}
			if( $placemark['coordinates'] != '' )
			{
				$kml .= '			<Placemark>'."\n";
				if($placemark['marker_style'] == 'regionMarkerStyle_2')
				{
<<<<<<< HEAD
<<<<<<< HEAD
					$regionStyle = 'regionStyle_2';
				}
				else
				{
					$regionStyle = 'regionStyle';
=======
					$regionStyle = 'regionStyle_2';				
				}
				else
				{
					$regionStyle = 'regionStyle';						
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$regionStyle = 'regionStyle_2';
				}
				else
				{
					$regionStyle = 'regionStyle';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
				//$kml .= '				<name>'.esc($placemark['name']).'</name>'."\n";
				$kml .= '				<styleUrl>#'.$regionStyle.'</styleUrl>'."\n";
				if( $placemark['begin'] || $placemark['end'] )
				{
					$kml .= '				<TimeSpan>'."\n";
					if( $placemark['begin'] )
					{
						$kml .= '			 	 <begin>'.esc(getXMLDateTime($placemark['begin'])).'</begin>'."\n";
					}
					if( $placemark['end'] )
					{
						$kml .= '				  <end>'.esc(getXMLDateTime($placemark['end'])).'</end>'."\n";
					}
					$kml .= '				</TimeSpan>'."\n";
				}
				$kml .= '				<Polygon>'."\n";
				$kml .= '					<outerBoundaryIs>'."\n";
				$kml .= '						<LinearRing>'."\n";
				$kml .= '							<tessellate>1</tessellate>'."\n";
				$kml .= '							<extrude>1</extrude>'."\n";
				$kml .= '							<coordinates>'.esc($placemark['coordinates']).'</coordinates>'."\n";
				$kml .= '						</LinearRing>'."\n";
				$kml .= '					</outerBoundaryIs>'."\n";
				$kml .= '				</Polygon>'."\n";
				$kml .= '			</Placemark>'."\n";
			}
		$kml .= '		</Folder>'."\n";
		}
		$kml .= '	</Folder>'."\n";
	}
	return $kml;
}

function validKmlPolyCoords($coords)
{
	$valid = false;
	$coordinates = preg_replace("/\s+/", " ", trim($coords));
	if( preg_match('/^(\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?)( (\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?))*$/', $coordinates) )
	{
		$valid = true;
	}
	return $valid;
}

function getKMLStyles()
{
	$kml = '';
	$kml .= '	<Style id="regionMarkerStyle">'."\n";
	$kml .= '		<IconStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<Icon><href>'.esc('http://'.eHOST.'/'.eROOT_DIR.'/orca/_images/region_marker.png').'</href></Icon>'."\n";
	$kml .= '			<hotSpot x="0.5" y="0.5" xunits="fraction" yunits="fraction"/>'."\n";
	$kml .= '		</IconStyle>'."\n";
	$kml .= '		<LabelStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<color>66FFFFFF</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</LabelStyle>'."\n";
=======
	$kml .= '		</LabelStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</LabelStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="pointMarkerStyle">'."\n";
	$kml .= '		<IconStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<Icon><href>'.esc('http://'.eHOST.'/'.eROOT_DIR.'/orca/_images/point_marker.png').'</href></Icon>'."\n";
	$kml .= '			<hotSpot x="0.5" y="0.5" xunits="fraction" yunits="fraction"/>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</IconStyle>'."\n";
=======
	$kml .= '		</IconStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</IconStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '		<LabelStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<color>66FFFFFF</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</LabelStyle>'."\n";
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="regionStyle">'."\n";
	$kml .= '		<LineStyle>'."\n";
	$kml .= '			<color>AA3B51FF</color>'."\n";
	$kml .= '			<width>1</width>'."\n";
	$kml .= '		</LineStyle>'."\n";
=======
	$kml .= '		</LabelStyle>'."\n";	
=======
	$kml .= '		</LabelStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="regionStyle">'."\n";
	$kml .= '		<LineStyle>'."\n";
	$kml .= '			<color>AA3B51FF</color>'."\n";
	$kml .= '			<width>1</width>'."\n";
<<<<<<< HEAD
	$kml .= '		</LineStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</LineStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '		<PolyStyle>'."\n";
	$kml .= '			<color>2F3B51FF</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
	$kml .= '		</PolyStyle>'."\n";
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="regionMarkerStyle_2">'."\n";
	$kml .= '		<IconStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<Icon><href>'.esc('http://'.eHOST.'/'.eROOT_DIR.'/orca/_images/region_marker_2.png').'</href></Icon>'."\n";
	$kml .= '			<hotSpot x="0.5" y="0.5" xunits="fraction" yunits="fraction"/>'."\n";
	$kml .= '		</IconStyle>'."\n";
	$kml .= '		<LabelStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<color>66FFFFFF</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</LabelStyle>'."\n";
=======
	$kml .= '		</LabelStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</LabelStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="pointMarkerStyle_2">'."\n";
	$kml .= '		<IconStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<Icon><href>'.esc('http://'.eHOST.'/'.eROOT_DIR.'/orca/_images/point_marker_2.png').'</href></Icon>'."\n";
	$kml .= '			<hotSpot x="0.5" y="0.5" xunits="fraction" yunits="fraction"/>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</IconStyle>'."\n";
=======
	$kml .= '		</IconStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</IconStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '		<LabelStyle>'."\n";
	$kml .= '			<scale>1.0</scale>'."\n";
	$kml .= '			<color>66FFFFFF</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
<<<<<<< HEAD
<<<<<<< HEAD
	$kml .= '		</LabelStyle>'."\n";
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="regionStyle_2">'."\n";
	$kml .= '		<LineStyle>'."\n";
	$kml .= '			<color>FF782878</color>'."\n";
	$kml .= '			<width>1</width>'."\n";
	$kml .= '		</LineStyle>'."\n";
=======
	$kml .= '		</LabelStyle>'."\n";	
=======
	$kml .= '		</LabelStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '	</Style>'."\n";
	$kml .= '	<Style id="regionStyle_2">'."\n";
	$kml .= '		<LineStyle>'."\n";
	$kml .= '			<color>FF782878</color>'."\n";
	$kml .= '			<width>1</width>'."\n";
<<<<<<< HEAD
	$kml .= '		</LineStyle>'."\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$kml .= '		</LineStyle>'."\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$kml .= '		<PolyStyle>'."\n";
	$kml .= '			<color>2D782878</color>'."\n";
	$kml .= '			<colorMode>normal</colorMode>'."\n";
	$kml .= '		</PolyStyle>'."\n";
	$kml .= '	</Style>'."\n";
	return $kml;
}

function hasSpatialKMLData($registryObjectKey , $forType)
{
	$mappedCoverageTypes = array('iso19139dcmiBox', 'gmlKmlPolyCoords', 'kmlPolyCoords');
	if($forType == 'location')
	{
	$locationArray = getLocations($registryObjectKey);
	foreach( $locationArray as $location  )
		{
			if( $spatialArray = getSpatialLocations($location['location_id']) )
			{
				foreach( $spatialArray as $row )
<<<<<<< HEAD
<<<<<<< HEAD
				{
=======
				{					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					if( in_array($row['type'], $mappedCoverageTypes) )
					{
						return true;
					}
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
	}
	if($forType == 'coverage')
	{
	$coverageList = getCoverage($registryObjectKey);

=======
	}	
	if($forType == 'coverage')
	{
	$coverageList = getCoverage($registryObjectKey);
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	}
	if($forType == 'coverage')
	{
	$coverageList = getCoverage($registryObjectKey);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $coverageList )
	{
		foreach( $coverageList  as $coverage )
		{
			$spatialList = getSpatialCoverage($coverage['coverage_id']);
			if($spatialList)
<<<<<<< HEAD
<<<<<<< HEAD
			{
=======
			{			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				foreach( $spatialList as $spatialLocation )
				{
					if( in_array($spatialLocation['type'], $mappedCoverageTypes) )
					{
						return true;
					}
				}
			}
		}
	}
	}
	return false;
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function addSolrIndex($registryObjectKey, $commit=true)
{
<<<<<<< HEAD
<<<<<<< HEAD
		$result = '';
		$rifcsContent = getRegistryObjectXMLforSOLR($registryObjectKey,true);

		$rifcsContent = wrapRegistryObjects($rifcsContent);
		$rifcs = transformToSolr($rifcsContent);
=======

		$result = '';
		$rifcsContent = getRegistryObjectXMLforSOLR($registryObjectKey,true);
		$rifcs = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
		$rifcs .='<registryObjects xmlns="http://ands.org.au/standards/rif-cs/registryObjects" '."\n";
		$rifcs .='                 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
		$rifcs .='                 xsi:schemaLocation="http://ands.org.au/standards/rif-cs/registryObjects '.gRIF_SCHEMA_URI.'">'."\n";	
		$rifcs .= $rifcsContent;			
		$rifcs .= "</registryObjects>\n";	
		$rifcs = transformToSolr($rifcs);									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$result = '';
		$rifcsContent = getRegistryObjectXMLforSOLR($registryObjectKey,true);

		$rifcsContent = wrapRegistryObjects($rifcsContent);
		$rifcs = transformToSolr($rifcsContent);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$result .= curl_post(gSOLR_UPDATE_URL, $rifcs);
		if($commit)
		{
			$result .= curl_post(gSOLR_UPDATE_URL.'?commit=true', '<commit waitFlush="false" waitSearcher="false"/>');
			$result .= curl_post(gSOLR_UPDATE_URL.'?optimize=true', '<optimize waitFlush="false" waitSearcher="false"/>');
		}
<<<<<<< HEAD
<<<<<<< HEAD
		return $result;
=======
		return $result;	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		return $result;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function addKeysToSolrIndex($keys, $commit=true)
{
		$result = '';
<<<<<<< HEAD
<<<<<<< HEAD
		$rifcs = '';

		foreach ($keys as $registryObjectKey)
		{
		  $result = addPublishedToSolrIndex($registryObjectKey);
		}
		return $result;
=======
		$rifcs = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
		$rifcs .='<registryObjects xmlns="http://ands.org.au/standards/rif-cs/registryObjects" '."\n";
		$rifcs .='                 xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
		$rifcs .='                 xsi:schemaLocation="http://ands.org.au/standards/rif-cs/registryObjects '.gRIF_SCHEMA_URI.'">'."\n";	
=======
		$rifcs = '';

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		foreach ($keys as $registryObjectKey)
		{
		  $result = addPublishedToSolrIndex($registryObjectKey);
		}
<<<<<<< HEAD
		return $result;	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		return $result;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}




function optimiseSolrIndex()
{
	$result = curl_post(gSOLR_UPDATE_URL.'?commit=true', '<commit waitFlush="false" waitSearcher="false"/>');
	$result .= curl_post(gSOLR_UPDATE_URL.'?optimize=true', '<optimize waitFlush="false" waitSearcher="false"/>');
<<<<<<< HEAD
<<<<<<< HEAD
	return $result;
=======
	return $result;	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	return $result;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function deleteSolrIndex($registryObjectkey)
{
	$result = curl_post(gSOLR_UPDATE_URL.'?commit=true', '<delete><id>'.$registryObjectkey.'</id></delete>');
	$result .= optimiseSolrIndex();
<<<<<<< HEAD
<<<<<<< HEAD
	return $result;
=======
	return $result;		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	return $result;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

function clearSolrIndex()
{
<<<<<<< HEAD
<<<<<<< HEAD
	$result = curl_post(gSOLR_UPDATE_URL.'?commit=true', '<delete><query>*:*</query></delete>');
	$result .= curl_post(gSOLR_UPDATE_URL.'?commit=true', '<commit waitFlush="false" waitSearcher="false"/>');
	$result .= curl_post(gSOLR_UPDATE_URL.'?optimize=true', '<optimize waitFlush="false" waitSearcher="false"/>');
	return $result;
}

function curl_post($url, $post)
{
=======
	$result = curl_post(gSOLR_UPDATE_URL.'?commit=true', '<delete><query>*:*</query></delete>');	
=======
	$result = curl_post(gSOLR_UPDATE_URL.'?commit=true', '<delete><query>*:*</query></delete>');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$result .= curl_post(gSOLR_UPDATE_URL.'?commit=true', '<commit waitFlush="false" waitSearcher="false"/>');
	$result .= curl_post(gSOLR_UPDATE_URL.'?optimize=true', '<optimize waitFlush="false" waitSearcher="false"/>');
	return $result;
}

<<<<<<< HEAD
function curl_post($url, $post) 
{ 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
function curl_post($url, $post)
{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

        $header = array("Content-type:text/xml; charset=utf-8");

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

        $data = curl_exec($ch);
		return $data;
		/*
        if (curl_errno($ch)) {
           print "curl_error:" . curl_error($ch);
        } else {
           curl_close($ch);
           print "curl exited okay\n";
           echo "Data returned...\n";
           echo "------------------------------------\n";
           echo $data;
           echo "------------------------------------\n";
        } */
<<<<<<< HEAD
<<<<<<< HEAD
}
function changeFromCamelCase($camelCaseString)
{
	$output = '';

	$output = preg_replace('/([A-Z])/', ' $1', $camelCaseString);
	$output = strtolower($output);
	$output = substr_replace($output, substr(strtoupper($output), 0, 1), 0, 1);

=======
} 
=======
}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
function changeFromCamelCase($camelCaseString)
{
	$output = '';

	$output = preg_replace('/([A-Z])/', ' $1', $camelCaseString);
	$output = strtolower($output);
	$output = substr_replace($output, substr(strtoupper($output), 0, 1), 0, 1);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	return $output;
}
function send_email($to, $subject, $message, $headers='')
{
<<<<<<< HEAD
<<<<<<< HEAD
	$headers .= 'From: "ANDS Services" <services@ands.org.au>' . "\r\n" .
	    'Reply-To: "ANDS Services" <services@ands.org.au>' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	@mail($to, $subject, $message, $headers);
}

/*
function DIEDIEDIEgetSpatialTypesXMLforSOLR($location_id)
{
	$xml = '';
	$list = getSpatialLocations($location_id);
	$centre = '';
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}

			if($element['type'] == 'iso19139dcmiBox')
			{
				$valueString = strtolower(esc($element['value'])).';';
				$matches = array();
				preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
				$north = (float)$matches[1];
				preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
				$south = (float)$matches[1];
				preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
				$west = (float)$matches[1];
				preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
				$east = (float)$matches[1];
				$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
				$centre = (($east+$west)/2).','.(($north+$south)/2);
				$xml .= "        <spatial>$west,$north $east,$north $east,$south $west,$south $west,$north</spatial>\n";

			}
			else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
			{
				$coordinates = trim(esc($element['value']));
				$coordinates = preg_replace("/\s+/", " ", $coordinates);

				if( validKmlPolyCoords($coordinates) )
				{
					// Build the coordinates string for the centre.
					$points = explode(' ', $coordinates);
					if( count($points) > 0 )
					{
						$north = -90.0;
						$south = 90.0;
						$west = 180.0;
						$east = -180.0;
						foreach( $points as $point )
						{
							$P = explode(',', $point); // lon,lat
							if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
							if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
							if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
							if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
						}
					}
					$centre = (($east+$west)/2).','.(($north+$south)/2);
				    $xml .= "        <spatial>$coordinates</spatial>\n";

				}
			}
	        if($centre != '')
	        {
	        	$xml .= "        <center>$centre</center>\n";

	        }



		}
	}
	return $xml;
}*/

/*
function DIEDIEDIEgetComplexNameTypesXMLforSOLR($registryObjectKey, $elementName, $registryObjectClass)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getComplexNames($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if($element['type'] == 'alternative')
			{
				$xml .= "      <$elementName$type>\n";
				$xml .= getNamePartsXMLforSOLR($element['complex_name_id'], $registryObjectClass);
				$xml .= "      </$elementName>\n";
			}
		}
	}
	return $xml;
}*/


/*
function getLocationTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getLocations($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $dateFrom = $element['date_from'] )
			{
				$dateFrom = ' dateFrom="'.formatDateTime($dateFrom, gDATE).'"';
			}
			if( $dateTo = $element['date_to'] )
			{
				$dateTo = ' dateTo="'.formatDateTime($dateTo, gDATE).'"';
			}
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$xml .= "      <$elementName$dateFrom$dateTo$type>\n";
			$xml .= getAddressXMLforSOLR($element['location_id']);
			$xml .= getSpatialTypesXMLforSOLR($element['location_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}*/


/*
function getCoverageTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getCoverage($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "      <$elementName>\n";
			$xml .= getSpatialCoverageXMLforSOLR($element['coverage_id']);
			$xml .= getTemporalCoverageXMLforSOLR($element['coverage_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
*/


/*
function getSpatialCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$centre = '';
	$list = getSpatialCoverage($coverage_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}

			if($element['type'] == 'iso19139dcmiBox')
			{
				$valueString =  strtolower(esc($element['value'])).';';
				$matches = array();
				preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
				$north = (float)$matches[1];
				preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
				$south = (float)$matches[1];
				preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
				$west = (float)$matches[1];
				preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
				$east = (float)$matches[1];
				$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
				$centre = (($east+$west)/2).','.(($north+$south)/2);
				$xml .= "        <spatial>$west,$north $east,$north $east,$south $west,$south $west,$north</spatial>\n";
			}
			else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
			{
				$coordinates = trim(esc($element['value']));
				$coordinates = preg_replace("/\s+/", " ", $coordinates);

				if( validKmlPolyCoords($coordinates) )
				{
					// Build the coordinates string for the centre.
					$points = explode(' ', $coordinates);
					if( count($points) > 0 )
					{
						$north = -90.0;
						$south = 90.0;
						$west = 180.0;
						$east = -180.0;
						foreach( $points as $point )
						{
							$P = explode(',', $point); // lon,lat
							if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
							if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
							if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
							if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
						}
					}
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "        <spatial>$coordinates</spatial>\n";
				}
			}
	        if($centre != '')
	        {strpos($mystring, $findme)
	        	$xml .= "        <center>$centre</center>\n";
	        }
		}
	}
	return $xml;
}*/


/*
function getTemporalCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$list = getTemporalCoverage($coverage_id);


	if($list)
	{
		foreach( $list as $element )
		{
			$dateArray = getTemporalCoverageDate($element['temporal_coverage_id']);
			if($dateArray)
			{
				$xml .= '<temporal>';
				asort($dateArray);
				foreach( $dateArray as $row )
				{
					$type = ' type="'.esc($row['type']).'"';
					$dateFormat = ' dateFormat="'.esc($row['date_format']).'"';
					$value = FormatDateTime(esc($row['value']), gDATE);
					$xml .= "            <date$type$dateFormat>$value</date>\n";
				}
				$xml .= '</temporal>';
			}
		}
	}
	return $xml;
}
*/


/*function getAddressXMLforSOLR($location_id)
{
	$xml = '';
	$list = getAddressLocations($location_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "        <address>\n";
			$xml .= getElectronicAddressTypesXML($element['address_id']);
			$xml .= getPhysicalAddressTypesXMLforSOLR($element['address_id']);
			$xml .= "        </address>\n";
		}
	}
	return $xml;
}*/


/*function getPhysicalAddressTypesXMLforSOLR($address_id)
{
	$xml = '';
	$list = getPhysicalAddresses($address_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$xml .= "          <physical$type$lang>\n";
			$xml .= getAddressPartsXMLforSOLR($element['physical_address_id']);
			$xml .= "          </physical>\n";
		}
	}
	return $xml;
}
*/
/*function DIEDIEDIEgetAddressPartsXMLforSOLR($physical_address_id)
{
	$xml = '';
	$list = getAddressParts($physical_address_id);
	if( $list )
	{
		asort($list);
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.strtolower(esc($type)).'"';
			}
			$value = ($element['value']);
			$value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);
			$xml .= "            <addressPart$type>$value</addressPart>\n";
		}
	}
	return $xml;
}*/



/*function DIEDIEDIEgetRelatedObjectTypesXMLforSolr($registryObjectKey,$registryObjectClass, $dataSourceKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$datasource = null;
	$dataSource = getDataSources($dataSourceKey, null);
	$create_primary_relationships = $dataSource[0]['create_primary_relationships'];
	$typeArray['collection'] = array(
		"describes" => "Describes",
		"hasAssociationWith" => "Associated with",
		"hasCollector" => "Aggregated by",
		"hasPart" => "Contains",
		"isDescribedBy" => "Described by",
		"isLocatedIn" => "Located in",
		"isLocationFor" => "Location for",
		"isManagedBy" => "Managed by",
		"isOutputOf" => "Output of",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"supports" => "Supports"
	);
	$typeArray['party'] = array(
		"hasAssociationWith" => "Associated with",
		"hasMember" => "Has member",
		"hasPart" => "Has part",
		"isCollectorOf" => "Collector of",
		"isFundedBy" => "Funded by",
		"isFunderOf" => "Funds",
		"isManagedBy" => "Managed by",
		"isManagerOf" => "Manages",
		"isMemberOf" => "Member of",
		"isOwnedBy" => "Owned by",
		"isOwnerOf" => "Owner of",
		"isParticipantIn" => "Participant in",
		"isPartOf" => "Part of",
	);
	$typeArray['service'] = array(
		"hasAssociationWith" => "Associated with",
		"hasPart" => "Includes",
		"isManagedBy" => "Managed by",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"isSupportedBy" => "Supported by",strpos($mystring, $findme)
	);
	$typeArray['activity'] = array(
		"hasAssociationWith" => "Associated with",
		"hasOutput" => "Produces",
		"hasPart" => "Includes",
		"hasParticipant" => "Undertaken by",
		"isFundedBy" => "Funded by",
		"isManagedBy" => "Managed by",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
	);

	//we need to check if this datasource has primary relationships set up.
	$pkey1 = '';
	$pkey2 = '';
	if($create_primary_relationships == 't'||$create_primary_relationships == '1')
		{
			$primary_key_1 =  $dataSource[0]['primary_key_1'];
			$primary_key_2 =  $dataSource[0]['primary_key_2'];
			if($primary_key_1!='' && $primary_key_1!=$registryObjectKey)
			{

				$pkey1 = esc($primary_key_1);
				$relatedObject = getRegistryObject($pkey1,true);
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$relation_logo = false;
				if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']])
				{
					$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']].'"';
				}else{
					$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1'].'"';
				}
				if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
				{
					$relation_logo = getDescriptionLogo($key);
				}

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$pkey1</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .=   "<relation$type>\n</relation>";
				$xml .= "      </$elementName>\n";

			}
			if($primary_key_2!='' && $primary_key_2!=$registryObjectKey)
			{

				$pkey2 = esc($primary_key_2);
				$relatedObject = getRegistryObject($pkey2,true);
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$relation_logo = false;
				if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']])
				{
					$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']].'"';
				}else{
					$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2'].'"';
				}
				if ($relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
				{
					$relation_logo = getDescriptionLogo($key);
				}

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$pkey2</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .=   "<relation$type>\n</relation>";
				$xml .= "      </$elementName>\n";
			}

		}
	$list = getRelatedObjects($registryObjectKey);

	if( $list )
	{
		foreach( $list as $element )
		{
			$key = esc($element['related_registry_object_key']);
			if($key!=$pkey1 && $key!=$pkey2)
			{
				$relatedObject = getRegistryObject($element['related_registry_object_key'],true);
				$relation_logo = false;
				$relationType = getRelationType($element['relation_id']);
				if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
				{
					$relation_logo = getDescriptionLogo($key);
				}
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$key</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .= getRelationsXMLSOLR($element['relation_id'],$typeArray[$registryObjectClass]);
				$xml .= "      </$elementName>\n";
			}
		}
	}
	return $xml;


}
*/


/*
function DIEDIEDIEgetRelationsXMLSOLR($relation_id,$typeArray)
{
	$xml = '';
	$list = getRelationDescriptions($relation_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				if( array_key_exists($type, $typeArray) )
				{
					$type = ' type="'.$typeArray[$type].'"';
				}
				else
				{
					$type = ' type="'.changeFromCamelCase($type).'"';
				}

			}
			if( $description = $element['description'] )
			{
				if( $lang = $element['lang'] )
				{
					$lang = ' xml:lang="'.esc($lang).'"';
				}
				$description = "          <description$lang>".esc($element['description'])."</description>\n";
			}
			if( $url = $element['url'] )
			{
				$url = "          <url>".esc($element['url'])."</url>\n";
			}
			$xml .= "        <relation$type>\n$description$url        </relation>\n";
		}
	}
	return $xml;
}*/

/*function DIEDIEDIEgetSubjectTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$resolvedName = '';
	$list = getSubjects($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			//var_dump($element['type']);
			$value = esc(trim($element['value']));
			$resolvedName = '';
			if(($value != '') && (strlen($value) < 7) && is_numeric($value))
			{
				$valueLength = strlen($value);
				if($valueLength < 6){
					for($i = 0; $i < (6 - $valueLength) ; $i++){
						$value .= '0';
					}
				}
				$resolvedName = getTermsForVocabByIdentifier(null, $value);
			}
			if($resolvedName && $resolvedName[0]['name'] != '')
			{
				$term = $resolvedName[0]['name'];
			}
			else
			{
				$term = $value;
			}
			$type = ' type="'.esc($element['type']).'"';
			$xml .= "      <$elementName$type>$term</$elementName>\n";
		}
	}
	return $xml;
}*/
/*
function getDescriptionTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = (trim($element['value']));

			$value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);

			$xml .= "      <$elementName$type$lang>$value</$elementName>\n";
		}
	}
	return $xml;
}
*/

/*
function getRightsTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] && ($element['type']=='rights' || $element['type']=='accessRights'))
			{
				$type = ' type="'.esc($element['type']).'"';

			$test = $element['type'];
			$value = esc($element['value']);
			$xml .= "      <$elementName$type>$value</$elementName>\n";
			$type = '';
			}
		}
	}
	$list = getRights($registryObjectKey);
	//echo $registryObjectKey;
	//print_r($list);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
			{
				$type = ' type="accessRights"';
				if($uri = $element['access_rights_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['access_rights']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}

			if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
			{
				$type = ' type="rights"';
				if($uri = $element['rights_statement_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['rights_statement']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}

			if( $type = $element['licence'] || $type = $element['licence_uri'])
			{
				$type = ' type="licence"';
				if($uri = $element['licence_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['licence']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}
		}
	}
	return $xml;
}
*/

/*function DIEDIEDIEgetExistenceDateTypesXMLSolr($registryObjectKey, $elementName)
{
	$xml = '';
	$startdate = '';
	$enddate = '';
	$elementName = esc($elementName);
	$list = getExistenceDate($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .=	"		<$elementName>";
			if($startdate = $element['start_date'])
			{
				$startdate1 = FormatDateTime(esc($startdate), gDATE);
				//echo $startdate;
				if($startDateFormat = $element['start_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<startDate$dateFormat>$startdate1</startDate>";
			}
			if($enddate = $element['end_date'])
			{
				$enddate1 = FormatDateTime(esc($enddate), gDATE);
				if($startDateFormat = $element['end_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<endDate$dateFormat>$enddate1</endDate>";
			}
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}*/
function checkRightsText($value)
{

	if((str_replace("http://creativecommons.org/licenses/by/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-sa/","",$value)!=$value))
	{
		return "Open Licence";
	}
	elseif((str_replace("http://creativecommons.org/licenses/by-nc/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-nc-sa/","",$value)!=$value))
	{
		return "Non-Commercial Licence";
	}
	elseif((str_replace("http://creativecommons.org/licenses/by-nd/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-nc-nd/","",$value)!=$value))
	{
		return "Non-Derivative Licence";
	}
	else
	{
		return false;
	}
}

function getSearchBaseScore($registry_object_key)
{
	
	$baseScore = eBOOST_DEFAULT_BASE + getRelatedObjectSearchBaseScoreAdjustment($registry_object_key);
	return $baseScore;
	/* performance enhancement...
	// number of related objects:
	$number_of_related_objects = (int) getRelatedObjectCount($registry_object_key);
	$number_of_related_objects -= (int) getMinorImpactRelatedObjectCount($registry_object_key); //remove close relationships ("hasPart")
	$baseScore += eBOOST_RELATED_OBJECT_ADJUSTMENT * $number_of_related_objects;

	// number of INCOMING related objects (objects that relate to us):
	$number_of_related_objects = getIncomingRelatedObjectCount($registry_object_key);
	$number_of_related_objects -= (int) getMinorImpactInboundRelatedObjectCount($registry_object_key); //remove close relationships ("isPartOf")
	$baseScore += eBOOST_INCOMING_RELATED_OBJECT_ADJUSTMENT * (int) $number_of_related_objects;
	*/

}

=======
	//$to = "ben.greenwood@anu.edu.au";
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$headers .= 'From: "ANDS Services" <services@ands.org.au>' . "\r\n" .
	    'Reply-To: "ANDS Services" <services@ands.org.au>' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	@mail($to, $subject, $message, $headers);
}

<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
/*
function DIEDIEDIEgetSpatialTypesXMLforSOLR($location_id)
{
	$xml = '';
	$list = getSpatialLocations($location_id);
	$centre = '';
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}

			if($element['type'] == 'iso19139dcmiBox')
			{
				$valueString = strtolower(esc($element['value'])).';';
				$matches = array();
				preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
				$north = (float)$matches[1];
				preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
				$south = (float)$matches[1];
				preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
				$west = (float)$matches[1];
				preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
				$east = (float)$matches[1];
				$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
				$centre = (($east+$west)/2).','.(($north+$south)/2);
				$xml .= "        <spatial>$west,$north $east,$north $east,$south $west,$south $west,$north</spatial>\n";

			}
			else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
			{
				$coordinates = trim(esc($element['value']));
				$coordinates = preg_replace("/\s+/", " ", $coordinates);

				if( validKmlPolyCoords($coordinates) )
				{
					// Build the coordinates string for the centre.
					$points = explode(' ', $coordinates);
					if( count($points) > 0 )
					{
						$north = -90.0;
						$south = 90.0;
						$west = 180.0;
						$east = -180.0;
						foreach( $points as $point )
						{
							$P = explode(',', $point); // lon,lat
							if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
							if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
							if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
							if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
						}
					}
					$centre = (($east+$west)/2).','.(($north+$south)/2);
				    $xml .= "        <spatial>$coordinates</spatial>\n";

				}
			}
	        if($centre != '')
	        {
	        	$xml .= "        <center>$centre</center>\n";

	        }



		}
	}
	return $xml;
}*/

/*
function DIEDIEDIEgetComplexNameTypesXMLforSOLR($registryObjectKey, $elementName, $registryObjectClass)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getComplexNames($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if($element['type'] == 'alternative')
			{
				$xml .= "      <$elementName$type>\n";
				$xml .= getNamePartsXMLforSOLR($element['complex_name_id'], $registryObjectClass);
				$xml .= "      </$elementName>\n";
			}
		}
	}
	return $xml;
}*/


/*
function getLocationTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getLocations($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $dateFrom = $element['date_from'] )
			{
				$dateFrom = ' dateFrom="'.formatDateTime($dateFrom, gDATE).'"';
			}
			if( $dateTo = $element['date_to'] )
			{
				$dateTo = ' dateTo="'.formatDateTime($dateTo, gDATE).'"';
			}
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			$xml .= "      <$elementName$dateFrom$dateTo$type>\n";
			$xml .= getAddressXMLforSOLR($element['location_id']);
			$xml .= getSpatialTypesXMLforSOLR($element['location_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}*/


/*
function getCoverageTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getCoverage($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "      <$elementName>\n";
			$xml .= getSpatialCoverageXMLforSOLR($element['coverage_id']);
			$xml .= getTemporalCoverageXMLforSOLR($element['coverage_id']);
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}
*/


/*
function getSpatialCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$centre = '';
	$list = getSpatialCoverage($coverage_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}

			if($element['type'] == 'iso19139dcmiBox')
			{
				$valueString =  strtolower(esc($element['value'])).';';
				$matches = array();
				preg_match('/northlimit=([^;]*);/i', $valueString, $matches);
				$north = (float)$matches[1];
				preg_match('/southlimit=([^;]*);/i', $valueString, $matches);
				$south = (float)$matches[1];
				preg_match('/westlimit=([^;]*);/i', $valueString, $matches);
				$west = (float)$matches[1];
				preg_match('/eastlimit=([^;]*);/i', $valueString, $matches);
				$east = (float)$matches[1];
				$coordinates = "$west,$north $east,$north $east,$south $west,$south $west,$north";
				$centre = (($east+$west)/2).','.(($north+$south)/2);
				$xml .= "        <spatial>$west,$north $east,$north $east,$south $west,$south $west,$north</spatial>\n";
			}
			else if($element['type'] ==  'gmlKmlPolyCoords' || $element['type'] == 'kmlPolyCoords')
			{
				$coordinates = trim(esc($element['value']));
				$coordinates = preg_replace("/\s+/", " ", $coordinates);

				if( validKmlPolyCoords($coordinates) )
				{
					// Build the coordinates string for the centre.
					$points = explode(' ', $coordinates);
					if( count($points) > 0 )
					{
						$north = -90.0;
						$south = 90.0;
						$west = 180.0;
						$east = -180.0;
						foreach( $points as $point )
						{
							$P = explode(',', $point); // lon,lat
							if( (float)$P[0] >= $east ){ $east = (float)$P[0]; }
							if( (float)$P[0] <= $west ){ $west = (float)$P[0]; }
							if( (float)$P[1] >= $north ){ $north = (float)$P[1]; }
							if( (float)$P[1] <= $south ){ $south = (float)$P[1]; }
						}
					}
					$centre = (($east+$west)/2).','.(($north+$south)/2);
					$xml .= "        <spatial>$coordinates</spatial>\n";
				}
			}
	        if($centre != '')
	        {strpos($mystring, $findme)
	        	$xml .= "        <center>$centre</center>\n";
	        }
		}
	}
	return $xml;
}*/


/*
function getTemporalCoverageXMLforSOLR($coverage_id)
{
	$xml = '';
	$list = getTemporalCoverage($coverage_id);


	if($list)
	{
		foreach( $list as $element )
		{
			$dateArray = getTemporalCoverageDate($element['temporal_coverage_id']);
			if($dateArray)
			{
				$xml .= '<temporal>';
				asort($dateArray);
				foreach( $dateArray as $row )
				{
					$type = ' type="'.esc($row['type']).'"';
					$dateFormat = ' dateFormat="'.esc($row['date_format']).'"';
					$value = FormatDateTime(esc($row['value']), gDATE);
					$xml .= "            <date$type$dateFormat>$value</date>\n";
				}
				$xml .= '</temporal>';
			}
		}
	}
	return $xml;
}
*/


/*function getAddressXMLforSOLR($location_id)
{
	$xml = '';
	$list = getAddressLocations($location_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .= "        <address>\n";
			$xml .= getElectronicAddressTypesXML($element['address_id']);
			$xml .= getPhysicalAddressTypesXMLforSOLR($element['address_id']);
			$xml .= "        </address>\n";
		}
	}
	return $xml;
}*/


/*function getPhysicalAddressTypesXMLforSOLR($address_id)
{
	$xml = '';
	$list = getPhysicalAddresses($address_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$xml .= "          <physical$type$lang>\n";
			$xml .= getAddressPartsXMLforSOLR($element['physical_address_id']);
			$xml .= "          </physical>\n";
		}
	}
	return $xml;
}
*/
/*function DIEDIEDIEgetAddressPartsXMLforSOLR($physical_address_id)
{
	$xml = '';
	$list = getAddressParts($physical_address_id);
	if( $list )
	{
		asort($list);
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.strtolower(esc($type)).'"';
			}
			$value = ($element['value']);
			$value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);
			$xml .= "            <addressPart$type>$value</addressPart>\n";
		}
	}
	return $xml;
}*/



/*function DIEDIEDIEgetRelatedObjectTypesXMLforSolr($registryObjectKey,$registryObjectClass, $dataSourceKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$datasource = null;
	$dataSource = getDataSources($dataSourceKey, null);
	$create_primary_relationships = $dataSource[0]['create_primary_relationships'];
	$typeArray['collection'] = array(
		"describes" => "Describes",
		"hasAssociationWith" => "Associated with",
		"hasCollector" => "Aggregated by",
		"hasPart" => "Contains",
		"isDescribedBy" => "Described by",
		"isLocatedIn" => "Located in",
		"isLocationFor" => "Location for",
		"isManagedBy" => "Managed by",
		"isOutputOf" => "Output of",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"supports" => "Supports"
	);
	$typeArray['party'] = array(
		"hasAssociationWith" => "Associated with",
		"hasMember" => "Has member",
		"hasPart" => "Has part",
		"isCollectorOf" => "Collector of",
		"isFundedBy" => "Funded by",
		"isFunderOf" => "Funds",
		"isManagedBy" => "Managed by",
		"isManagerOf" => "Manages",
		"isMemberOf" => "Member of",
		"isOwnedBy" => "Owned by",
		"isOwnerOf" => "Owner of",
		"isParticipantIn" => "Participant in",
		"isPartOf" => "Part of",
	);
	$typeArray['service'] = array(
		"hasAssociationWith" => "Associated with",
		"hasPart" => "Includes",
		"isManagedBy" => "Managed by",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
		"isSupportedBy" => "Supported by",strpos($mystring, $findme)
	);
	$typeArray['activity'] = array(
		"hasAssociationWith" => "Associated with",
		"hasOutput" => "Produces",
		"hasPart" => "Includes",
		"hasParticipant" => "Undertaken by",
		"isFundedBy" => "Funded by",
		"isManagedBy" => "Managed by",
		"isOwnedBy" => "Owned by",
		"isPartOf" => "Part of",
	);

	//we need to check if this datasource has primary relationships set up.
	$pkey1 = '';
	$pkey2 = '';
	if($create_primary_relationships == 't'||$create_primary_relationships == '1')
		{
			$primary_key_1 =  $dataSource[0]['primary_key_1'];
			$primary_key_2 =  $dataSource[0]['primary_key_2'];
			if($primary_key_1!='' && $primary_key_1!=$registryObjectKey)
			{

				$pkey1 = esc($primary_key_1);
				$relatedObject = getRegistryObject($pkey1,true);
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$relation_logo = false;
				if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']])
				{
					$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1']].'"';
				}else{
					$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_1'].'"';
				}
				if (isset($row) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
				{
					$relation_logo = getDescriptionLogo($key);
				}

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$pkey1</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .=   "<relation$type>\n</relation>";
				$xml .= "      </$elementName>\n";

			}
			if($primary_key_2!='' && $primary_key_2!=$registryObjectKey)
			{

				$pkey2 = esc($primary_key_2);
				$relatedObject = getRegistryObject($pkey2,true);
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$relation_logo = false;
				if($typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']])
				{
					$type = ' type="'.$typeArray[$relatedclass][$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2']].'"';
				}else{
					$type = ' type="'.$dataSource[0][strtolower($relatedObject[0]['registry_object_class']).'_rel_2'].'"';
				}
				if ($relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person')
				{
					$relation_logo = getDescriptionLogo($key);
				}

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$pkey2</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .=   "<relation$type>\n</relation>";
				$xml .= "      </$elementName>\n";
			}

		}
	$list = getRelatedObjects($registryObjectKey);

	if( $list )
	{
		foreach( $list as $element )
		{
			$key = esc($element['related_registry_object_key']);
			if($key!=$pkey1 && $key!=$pkey2)
			{
				$relatedObject = getRegistryObject($element['related_registry_object_key'],true);
				$relation_logo = false;
				$relationType = getRelationType($element['relation_id']);
				if (isset($element) &&	$relatedObject[0]['registry_object_class'] == 'Party' && strtolower($relatedObject[0]['type']) != 'person' )
				{
					$relation_logo = getDescriptionLogo($key);
				}
				$relatedclass= strtolower($relatedObject[0]['registry_object_class']);

				$xml .= "      <$elementName>\n";
				$xml .= "        <key>$key</key>\n";
				$xml .= "		 <relatedObjectClass>".strtolower($relatedObject[0]['registry_object_class'])."</relatedObjectClass>";
				$xml .= "		 <relatedObjectType>".strtolower($relatedObject[0]['type'])."</relatedObjectType>";
				$xml .= "		 <relatedObjectListTitle>".esc($relatedObject[0]['list_title'])."</relatedObjectListTitle>";
				$xml .= "		 <relatedObjectDisplayTitle>".esc($relatedObject[0]['display_title'])."</relatedObjectDisplayTitle>";
				if($relation_logo) $xml .= "		 <relatedObjectLogo>".esc($relation_logo)."</relatedObjectLogo>";
				$xml .= getRelationsXMLSOLR($element['relation_id'],$typeArray[$registryObjectClass]);
				$xml .= "      </$elementName>\n";
			}
		}
	}
	return $xml;


}
*/


/*
function DIEDIEDIEgetRelationsXMLSOLR($relation_id,$typeArray)
{
	$xml = '';
	$list = getRelationDescriptions($relation_id);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				if( array_key_exists($type, $typeArray) )
				{
					$type = ' type="'.$typeArray[$type].'"';
				}
				else
				{
					$type = ' type="'.changeFromCamelCase($type).'"';
				}

			}
			if( $description = $element['description'] )
			{
				if( $lang = $element['lang'] )
				{
					$lang = ' xml:lang="'.esc($lang).'"';
				}
				$description = "          <description$lang>".esc($element['description'])."</description>\n";
			}
			if( $url = $element['url'] )
			{
				$url = "          <url>".esc($element['url'])."</url>\n";
			}
			$xml .= "        <relation$type>\n$description$url        </relation>\n";
		}
	}
	return $xml;
}*/

/*function DIEDIEDIEgetSubjectTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$resolvedName = '';
	$list = getSubjects($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			//var_dump($element['type']);
			$value = esc(trim($element['value']));
			$resolvedName = '';
			if(($value != '') && (strlen($value) < 7) && is_numeric($value))
			{
				$valueLength = strlen($value);
				if($valueLength < 6){
					for($i = 0; $i < (6 - $valueLength) ; $i++){
						$value .= '0';
					}
				}
				$resolvedName = getTermsForVocabByIdentifier(null, $value);
			}
			if($resolvedName && $resolvedName[0]['name'] != '')
			{
				$term = $resolvedName[0]['name'];
			}
			else
			{
				$term = $value;
			}
			$type = ' type="'.esc($element['type']).'"';
			$xml .= "      <$elementName$type>$term</$elementName>\n";
		}
	}
	return $xml;
}*/
/*
function getDescriptionTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] )
			{
				$type = ' type="'.esc($type).'"';
			}
			if( $lang = $element['lang'] )
			{
				$lang = ' xml:lang="'.esc($lang).'"';
			}
			$value = (trim($element['value']));

			$value = htmlspecialchars_decode($value);
			$value = purify($value);
			$value = htmlspecialchars($value);

			$xml .= "      <$elementName$type$lang>$value</$elementName>\n";
		}
	}
	return $xml;
}
*/

/*
function getRightsTypesXMLforSOLR($registryObjectKey, $elementName)
{
	$xml = '';
	$elementName = esc($elementName);
	$list = getDescriptions($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['type'] && ($element['type']=='rights' || $element['type']=='accessRights'))
			{
				$type = ' type="'.esc($element['type']).'"';

			$test = $element['type'];
			$value = esc($element['value']);
			$xml .= "      <$elementName$type>$value</$elementName>\n";
			$type = '';
			}
		}
	}
	$list = getRights($registryObjectKey);
	//echo $registryObjectKey;
	//print_r($list);
	if( $list )
	{
		foreach( $list as $element )
		{
			if( $type = $element['access_rights'] || $type = $element['access_rights_uri'])
			{
				$type = ' type="accessRights"';
				if($uri = $element['access_rights_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['access_rights']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}

			if( $type = $element['rights_statement'] || $type = $element['rights_statement_uri'])
			{
				$type = ' type="rights"';
				if($uri = $element['rights_statement_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['rights_statement']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}

			if( $type = $element['licence'] || $type = $element['licence_uri'])
			{
				$type = ' type="licence"';
				if($uri = $element['licence_uri'])
				{
					$uri = ' rightsUri = "'.esc($uri).'"';
				}
				$value = esc($element['licence']);
				$xml .= "      <$elementName$type$uri>$value</$elementName>\n";
			}
		}
	}
	return $xml;
}
*/

/*function DIEDIEDIEgetExistenceDateTypesXMLSolr($registryObjectKey, $elementName)
{
	$xml = '';
	$startdate = '';
	$enddate = '';
	$elementName = esc($elementName);
	$list = getExistenceDate($registryObjectKey);
	if( $list )
	{
		foreach( $list as $element )
		{
			$xml .=	"		<$elementName>";
			if($startdate = $element['start_date'])
			{
				$startdate1 = FormatDateTime(esc($startdate), gDATE);
				//echo $startdate;
				if($startDateFormat = $element['start_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<startDate$dateFormat>$startdate1</startDate>";
			}
			if($enddate = $element['end_date'])
			{
				$enddate1 = FormatDateTime(esc($enddate), gDATE);
				if($startDateFormat = $element['end_date_format'])
				{
					$dateFormat = ' dateFormat="'.$startDateFormat.'"';
				}
				$xml .= "			<endDate$dateFormat>$enddate1</endDate>";
			}
			$xml .= "      </$elementName>\n";
		}
	}
	return $xml;
}*/
function checkRightsText($value)
{

	if((str_replace("http://creativecommons.org/licenses/by/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-sa/","",$value)!=$value))
	{
		return "Open Licence";
	}
	elseif((str_replace("http://creativecommons.org/licenses/by-nc/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-nc-sa/","",$value)!=$value))
	{
		return "Non-Commercial Licence";
	}
	elseif((str_replace("http://creativecommons.org/licenses/by-nd/","",$value)!=$value)||(str_replace("http://creativecommons.org/licenses/by-nc-nd/","",$value)!=$value))
	{
		return "Non-Derivative Licence";
	}
	else
	{
		return false;
	}
}

function getSearchBaseScore($registry_object_key)
{
	
	$baseScore = eBOOST_DEFAULT_BASE + getRelatedObjectSearchBaseScoreAdjustment($registry_object_key);
	return $baseScore;
	/* performance enhancement...
	// number of related objects:
	$number_of_related_objects = (int) getRelatedObjectCount($registry_object_key);
	$number_of_related_objects -= (int) getMinorImpactRelatedObjectCount($registry_object_key); //remove close relationships ("hasPart")
	$baseScore += eBOOST_RELATED_OBJECT_ADJUSTMENT * $number_of_related_objects;

	// number of INCOMING related objects (objects that relate to us):
	$number_of_related_objects = getIncomingRelatedObjectCount($registry_object_key);
	$number_of_related_objects -= (int) getMinorImpactInboundRelatedObjectCount($registry_object_key); //remove close relationships ("isPartOf")
	$baseScore += eBOOST_INCOMING_RELATED_OBJECT_ADJUSTMENT * (int) $number_of_related_objects;
	*/

}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
