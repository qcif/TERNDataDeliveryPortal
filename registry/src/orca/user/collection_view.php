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
require '../../_includes/init.php';
require '../orca_init.php';
// Page processing
// -----------------------------------------------------------------------------

// Get the record from the database.
$registryObject = getRegistryObject(getQueryValue('key'));

$registryObjectKey = null;
$dataSourceKey = null;
$registryObjectRecordOwner = null;
$registryObjectStatus = null;

if( !$registryObject )
{
	responseRedirect('index.php');
}
else
{
	$registryObjectKey = $registryObject[0]['registry_object_key'];

	// Get the values that we'll need to check for conditional display and access.
	$registryObjectRecordOwner = $registryObject[0]['record_owner'];
	$registryObjectStatus = trim($registryObject[0]['status']);
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	// Check access.
	if( !userIsRegistryObjectRecordOwner($registryObjectRecordOwner) )
	{
		responseRedirect('index.php');
	}
<<<<<<< HEAD

	// Get any action that may have been posted.
	$action = strtoupper(getPostedValue('action'));

=======
	
	// Get any action that may have been posted.
	$action = strtoupper(getPostedValue('action'));
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	// Action the action.
	switch( $action )
	{
		case 'EDIT':
			responseRedirect('collection_edit.php?key='.urlencode(getQueryValue('key')));
			break;
		case 'DELETE':
			responseRedirect('collection_delete.php?key='.urlencode(getQueryValue('key')));
			break;
	}
<<<<<<< HEAD

	$registryObjectClass = $registryObject[0]['registry_object_class'];
	$registryObjectType = $registryObject[0]['type'];

=======
	
	$registryObjectClass = $registryObject[0]['registry_object_class'];
	$registryObjectType = $registryObject[0]['type'];
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	$registryObjectName = getNameHTML($registryObjectKey, '');
	if( trim($registryObjectName) == '' )
	{
		$registryObjectName = esc($registryObjectKey);
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	$pageTitle = $registryObjectClass.' ('.$registryObjectType.'): '.$registryObjectName;
}

// -----------------------------------------------------------------------------
// Begin the XHTML response. Any redirects must occur before this point.
require '../../_includes/header.php';
// BEGIN: Page Content
// =============================================================================


if( $registryObject )
{

	$objectGroup = $registryObject[0]['object_group'];
	$registryObjectClass = $registryObject[0]['registry_object_class'];
	$registryObjectType = $registryObject[0]['type'];
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	$originatingSourceHTML = esc($registryObject[0]['originating_source']);
	if( $registryObject[0]['originating_source_type'] )
	{
		$originatingSourceHTML = '<span class="attribute" title="originating source type">'.esc($registryObject[0]['originating_source_type']).':</span> '.$originatingSourceHTML;
	}

	$objectGroup = $registryObject[0]['object_group'];
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	$createdWhen = formatDateTime($registryObject[0]['created_when']);
	$createdWho = $registryObject[0]['created_who'];

	print('<table class="recordTable" summary="Data Source">'."\n");
<<<<<<< HEAD
	print("	<thead>\n");

	$rdaLink = '';

=======
	print("	<thead>\n"); 
	
	$rdaLink = '';
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if ($registryObjectStatus == APPROVED)
	{
		$registryObjectStatus = SUBMITTED_FOR_ASSESSMENT;
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	// The link to the RDA
	$rdaLinkPrefix = 'View';
	if( $registryObjectStatus != PUBLISHED )
	{
		$rdaLinkPrefix = 'Preview';
	}
<<<<<<< HEAD
	$rdaLink = '<br /><a style="font-size:0.8em; font-weight: normal;" rel="preview" href="http://'.$host.'/'.$rda_root . '/view.php?key='.esc(urlencode($registryObjectKey)).'">'.$rdaLinkPrefix.' this record in Research Data Australia (new window)</a>'."\n";

	drawRecordField("<a href=\"../services/getRegistryObject.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get RIF-CS XML for this record\" src=\"".gORCA_IMAGE_ROOT."rifcs.gif\" alt=\"\" /></a>", esc($registryObjectClass).$rdaLink);

	print("	</thead>\n");
	print('	<tbody class="recordFields">'."\n");

=======
	$rdaLink = '<br /><a style="font-size:0.8em; font-weight: normal;" rel="preview" href="'.eHTTP_APP_ROOT.'orca/rda/view.php?key='.esc(urlencode($registryObjectKey)).'">'.$rdaLinkPrefix.' this record in Research Data Australia (new window)</a>'."\n";
	
	drawRecordField("<a href=\"../services/getRegistryObject.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get RIF-CS XML for this record\" src=\"".gORCA_IMAGE_ROOT."rifcs.gif\" alt=\"\" /></a>", esc($registryObjectClass).$rdaLink);
	
	print("	</thead>\n");
	print('	<tbody class="recordFields">'."\n");
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	drawRecordField("Status:",  getRegistryObjectStatusSpan($registryObjectStatus));
	drawRecordField("Type:",  esc($registryObjectType));
	drawRecordField("Key:",  esc($registryObjectKey));
	drawRecordField("Originating Source:", $originatingSourceHTML);
<<<<<<< HEAD
	drawRecordField("Group:", esc($objectGroup));

=======
	drawRecordField("Group:", esc($objectGroup));	
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getComplexNames($registryObjectKey) )
	{
		print("\n<!-- NAMES -->\n");
		print("		<tr>\n");
		print("			<td>Names:</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawName($row['complex_name_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
<<<<<<< HEAD
	}

=======
	}	
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getLocations($registryObjectKey) )
	{
		print("\n<!-- LOCATIONS -->\n");
		print("		<tr>\n");
		print("			<td>Locations:");
		if( getRegistryObjectKML($registryObjectKey) )
		{
<<<<<<< HEAD
			print("<br /><a href=\"http://".eHOST."/".eROOT_DIR."/orca/services/getRegistryObjectKML.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get any KML that can be derived from coverage information in this record\" src=\"".gORCA_IMAGE_ROOT."kml.gif\" alt=\"\" /></a>");
=======
			print("<br /><a href=\"http://".eHOST."/".eROOT_DIR."/orca/services/getRegistryObjectKML.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get any KML that can be derived from coverage information in this record\" src=\"".gORCA_IMAGE_ROOT."kml.gif\" alt=\"\" /></a>");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		}
		print("</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawLocation($row['location_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getCoverage($registryObjectKey) )
	{
		print("\n<!-- COVERAGE-->\n");
		print("		<tr>\n");
		print("			<td>Coverage:");
		if( hasSpatialKMLData($registryObjectKey, 'coverage') )
		{
<<<<<<< HEAD
			print("<br /><a href=\"http://".eHOST."/".eROOT_DIR."/orca/services/getRegistryObjectKML.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get any KML that can be derived from coverage information in this record\" src=\"".gORCA_IMAGE_ROOT."kml.gif\" alt=\"\" /></a>");
=======
			print("<br /><a href=\"http://".eHOST."/".eROOT_DIR."/orca/services/getRegistryObjectKML.php?key=".esc(urlencode($registryObjectKey))."\"><img title=\"Get any KML that can be derived from coverage information in this record\" src=\"".gORCA_IMAGE_ROOT."kml.gif\" alt=\"\" /></a>");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		}
		print("</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawCoverage($row['coverage_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
	}

	if( $array = getRelatedObjects($registryObjectKey) )
	{
		print("\n<!-- RELATED OBJECTS -->\n");
		print("		<tr>\n");
		print("			<td>Related Objects:</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawRelatedObject($row['relation_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getSubjects($registryObjectKey) )
	{
		print("\n<!-- SUBJECTS -->\n");
		print("		<tr>\n");
		print("			<td>Subjects:</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawSubject($row['subject_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getDescriptions($registryObjectKey) )
	{
		print("\n<!-- DESCRIPTIONS -->\n");
		print("		<tr>\n");
		print("			<td>Descriptions:</td>\n");
		print("			<td>\n");
		asort($array);
		foreach( $array as $row )
		{
			drawDescription($row['description_id'], $row);
		}
		print("			</td>\n");
		print("		</tr>\n");
	}
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if( $array = getCitationInformation($registryObjectKey) )
	{
		print("\n<!-- CITATION INFO -->\n");
		print("		<tr>\n");
		print("			<td>Citation Info:</td>\n");
		print("			<td>\n");
		asort($array);
		print('			<table class="subtable">'."\n");
		foreach( $array as $row )
		{
			drawCitationInfo($row['citation_info_id'], $row);
		}
		print('			</table>'."\n");
		print("			</td>\n");
		print("		</tr>\n");
<<<<<<< HEAD
	}


	drawRecordField("Created When:",  $createdWhen);
	drawRecordField("Created Who:",  $createdWho);

	$statusWhen = formatDateTime($registryObject[0]['status_modified_when']);

=======
	}	

	
	drawRecordField("Created When:",  $createdWhen);
	drawRecordField("Created Who:",  $createdWho);
	
	$statusWhen = formatDateTime($registryObject[0]['status_modified_when']);
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	drawRecordField("Status Set:",  $statusWhen);

	print("	</tbody>\n");

	print("	<tbody>\n");
	print("	  <tr>\n");
	print("	    <td></td>\n");
	print("	    <td>\n");
	print("	      <form action=\"collection_view.php?key=".esc(urlencode(getQueryValue('key')))."\" method=\"post\">\n");
	print("	      <div style=\"margin-bottom: 1em;\">\n");
	print("	      <input type=\"submit\" name=\"action\" value=\"Edit\" />&nbsp;\n");
	print("	      <input type=\"submit\" name=\"action\" value=\"Delete\" />&nbsp;\n");
	print("	      </div>\n");
	print("	      </form>\n");
	print("	    </td>\n");
	print("	  </tr>\n");
<<<<<<< HEAD
	print("	</tbody>\n");

=======
	print("	</tbody>\n");	
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	print("</table>\n");
}

// =============================================================================
// END: Page Content
// Complete the XHTML response.
require '../../_includes/footer.php';
require '../../_includes/finish.php';



function drawName($id, $row=null)
{
	print("\n<!-- NAME -->\n");
	print('<table class="subtable">'."\n");
	if( $value = $row['date_from'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Date From:</td>'."\n");
		print('			<td class="valueAttribute">'.esc(getXMLDateTime($value)).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['date_to'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Date To:</td>'."\n");
		print('			<td class="valueAttribute">'.esc(getXMLDateTime($value)).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $array = getNameParts($id) )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Name Parts:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawNamePart($row['name_part_id'], $row);
		}
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawNamePart($id, $row=null)
{
	print("\n<!-- NAME PART -->\n");
	print('<table class="subtable1">'."\n");
	if( $value = $row['value'] )
	{
		$searchBaseURI = '../search.php?collections=collection&amp;services=service&amp;parties=party&amp;activities=activity&amp;action=Search&amp;search=';
		$link = '<a class="search" title="Search with this name part" href="'.$searchBaseURI.esc(urlencode($value)).'">'.escWithBreaks($value).'</a>';
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.$link.'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawLocation($id, $row=null)
{
	print("\n<!-- LOCATION -->\n");
	print('<table class="subtable">'."\n");
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['date_from'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Date From:</td>'."\n");
		print('			<td class="valueAttribute">'.esc(getXMLDateTime($value)).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['date_to'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Date To:</td>'."\n");
		print('			<td class="valueAttribute">'.esc(getXMLDateTime($value)).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $array = getAddressLocations($id) )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Addresses:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawAddress($row['address_id'], $row);
		}
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
	if( $array = getSpatialLocations($id) )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Spatial:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawSpatial($row['spatial_location_id'], $row);
		}
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawAddress($id, $row=null)
{
	print("\n<!-- ADDRESS -->\n");
	print('<table class="subtable1">'."\n");
	if( $array = getElectronicAddresses($id) )
<<<<<<< HEAD
	{
=======
	{	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		print('		<tr>'."\n");
		print('			<td class="attribute">Electronic:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawElectronicAddress($row['electronic_address_id'], $row);
		}
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawElectronicAddress($id, $row=null)
{
	print("\n<!-- ELECTRONIC ADDRESS -->\n");
	print('<table class="subtable">'."\n");
	if( $value = $row['value'] )
	{
		$electronicAddress = '';
		if( $electronicAddressType = $row['type'] )
		{
			// Do some custom value display for some known types.
			switch( strtoupper($electronicAddressType) )
			{
				case 'URL':
					if( !getElectronicAddressArgs($id) ) // Only display a hyperlink if the address doesn't require args.
					{
						// Fix relative URLs.
						$electronicAddress = $value;
						if( !preg_match('/^[a-zA-Z]{0,5}:\/\/.*/', $electronicAddress) )
						{
							$electronicAddress = 'http://'.$electronicAddress;
						}
						$electronicAddress = '<a href="'.esc($electronicAddress).'" class="external">'.esc($value).'<img class="external" src="'.gORCA_IMAGE_ROOT.'external_link.gif" alt="" /></a>';
					}
					else
					{
						$electronicAddress = esc($value);
					}
					break;
<<<<<<< HEAD

				case 'EMAIL':
					$electronicAddress = '<a href="mailto:'.esc($value).'" class="external">'.esc($value).'</a>';
		    		break;

		    	default:
		    		$electronicAddress = esc($value);
		    		break;
			}
=======
		    		
				case 'EMAIL':
					$electronicAddress = '<a href="mailto:'.esc($value).'" class="external">'.esc($value).'</a>';
		    		break;
				
		    	default:
		    		$electronicAddress = esc($value);
		    		break;
			}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		}
		else
		{
			$electronicAddress = esc($value);
		}
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.$electronicAddress.'</td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
<<<<<<< HEAD
	print('	</table>'."\n");
=======
	print('	</table>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}

function drawSpatial($id, $row=null)
{
	print("\n<!-- SPATIAL LOCATION -->\n");
	print('<table class="subtable1">'."\n");
	if( $value = $row['value'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
<<<<<<< HEAD
	print('	</table>'."\n");
=======
	print('	</table>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}

function drawRelatedObject($id, $row=null)
{
	print("\n<!-- RELATED OBJECT -->\n");
	print('<table class="subtable">'."\n");
	if( $relatedRegistryObjectKey = $row['related_registry_object_key'] )
	{
		$link = '';
		if( getRegistryObject($relatedRegistryObjectKey) )
		{
			// The related object exists in the registry.
			$relationName = getNameHTML($relatedRegistryObjectKey);
			if( $relationName == '' )
			{
				$relationName = $relatedRegistryObjectKey;
			}
			$link = '<a href="../view.php?'.esc("key=".urlencode($relatedRegistryObjectKey)).'" title="View this record">';
			$link .= $relationName;
			$link .= "</a>";
		}
		if( $link )
		{
			print('		<tr>'."\n");
			print('			<td></td><td>'.$link.'</td>'."\n");
<<<<<<< HEAD
			print('		</tr>'."\n");
=======
			print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		}
		print('		<tr>'."\n");
		print('			<td class="attribute">Key:</td>'."\n");
		print('			<td class="value">'.esc($relatedRegistryObjectKey).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $array = getRelationDescriptions($id) )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Relations:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawRelation($row['relation_description_id'], $row);
		}
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawRelation($id, $row=null)
{
	print("\n<!-- RELATION -->\n");
	print('<table class="subtable1">'."\n");
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['description'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Description:</td>'."\n");
		print('			<td class="value">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Description Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['url'] )
	{
		// Fix relative URLs.
		$href = $value;
		if( !preg_match('/^[a-zA-Z]{0,5}:\/\/.*/', $href) )
		{
			$href = 'http://'.$href;
<<<<<<< HEAD
		}
=======
		}					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		$url = '<a href="'.esc($href).'" class="external" title="'.esc($href).'">'.esc($href).'<img class="external" src="'.gORCA_IMAGE_ROOT.'external_link.gif" alt="" /></a>';
		print('		<tr>'."\n");
		print('			<td class="attribute">URL:</td>'."\n");
		print('			<td class="value">'.$url.'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawSubject($id, $row=null)
{
	print("\n<!-- SUBJECT -->\n");
	print('<table class="subtable">'."\n");
	if( $value = $row['value'] )
	{
		$searchBaseURI = '../search.php?collections=collection&amp;services=service&amp;parties=party&amp;activities=activity&amp;action=Search&amp;search=';
		$link = '<a class="search" title="Search with this subject" href="'.$searchBaseURI.esc(urlencode($value)).'">'.escWithBreaks($value).'</a>';
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.$link.'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawDescription($id, $row=null)
{
	print("\n<!-- DESCRIPTION -->\n");
	print('<table class="subtable">'."\n");
	if( $value = $row['value'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.escWithBreaks($value).'</td>'."\n");
		print('		</tr>'."\n");
	}

	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
}

function drawCoverage($id, $row=null)
{
	print("\n<!-- COVERAGE -->\n");
	print('<table class="subtable">'."\n");
	if($array = getSpatialCoverage($id))
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Spatial:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawSpatialCoverage($row['coverage_id'], $row);
		}
		print('         </td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if($array = getTemporalCoverage($id))
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Temporal:</td>'."\n");
		print('			<td>'."\n");
		asort($array);
		foreach( $array as $row )
		{
			drawTemporalCoverage($row['temporal_coverage_id'], $row);
		}
		print('         </td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
	}
	print('	</table>'."\n");
=======
		print('		</tr>'."\n");		
	}
	print('	</table>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}
function drawSpatialCoverage($id, $row=null)
{
print('<table class="subtable1">'."\n");
	if( $value = $row['value'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if( $value = $row['lang'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Lang:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
<<<<<<< HEAD
	print('	</table>'."\n");
=======
	print('	</table>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}

function drawTemporalCoverage($id, $row=null)
{
	print('<table class="subtable1">'."\n");
	if($array = getTemporalCoverageText($id))
	{
		asort($array);
		foreach( $array as $row )
		{
			drawTemporalCoverageText($row['coverage_text_id'], $row);
<<<<<<< HEAD
		}
=======
		}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if($array = getTemporalCoverageDate($id))
	{
		asort($array);
		foreach( $array as $row )
		{
			drawTemporalCoverageDate($row['coverage_date_id'], $row);
<<<<<<< HEAD
		}
	}
	print('	</table>'."\n");
=======
		}	
	}
	print('	</table>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}

function drawTemporalCoverageDate($id, $row=null)
{
	print('		<tr>'."\n");
	print('			<td class="attribute">Date:</td>'."\n");
	print('			<td>'."\n");
	print('		<table class="subtable1">'."\n");

	if( $value = $row['value'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	if( $value = $row['type'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Type:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	if( $value = $row['date_format'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">DateFormat:</td>'."\n");
		print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('		</table>'."\n");
	print('         </td>'."\n");
	print('		</tr>'."\n");
}


function drawTemporalCoverageText($id, $row=null)
{
	print('		<tr>'."\n");
	print('			<td class="attribute">Text:</td>'."\n");
	print('			<td>'."\n");
	print('			<table class="subtable1">'."\n");
	if( $value = $row['value'] )
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($value).'</td>'."\n");
		print('		</tr>'."\n");
	}
	print('			</table>'."\n");
	print('         </td>'."\n");
	print('		</tr>'."\n");
}
function drawCitationInfo($id, $row=null)
{
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	if($row['full_citation'] != '' || $row['style'] != '')
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Full Citation:</td>'."\n");
		print('			<td>'."\n");
<<<<<<< HEAD
		print('			<table class="subtable1">'."\n");
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($row['full_citation']).'</td>'."\n");
		print('		</tr>'."\n");
=======
		print('			<table class="subtable1">'."\n");		
		print('		<tr>'."\n");
		print('			<td class="attribute">Value:</td>'."\n");
		print('			<td class="value">'.esc($row['full_citation']).'</td>'."\n");
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		if( $value = $row['style'] )
		{
			print('		<tr>'."\n");
			print('			<td class="attribute">Style:</td>'."\n");
			print('			<td class="valueAttribute">'.esc($value).'</td>'."\n");
			print('		</tr>'."\n");
		}
		print('		</table>'."\n");
		print('     </td>'."\n");
		print('		</tr>'."\n");
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
	else if($row['metadata_identifier'] != '')
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">Citation Metadata:</td>'."\n");
		print('			<td>'."\n");
		print('			<table class="subtable1">'."\n");
		print('				<tr>'."\n");
		print('				<td class="attribute">Identifier:</td>'."\n");
		print('				<td>'."\n");
		print('					<table class="subtable">'."\n");
		print('						<tr>'."\n");
		print('							<td class="attribute">Value:</td>'."\n");
		print('							<td class="value">'.esc($row['metadata_identifier']).'</td>'."\n");
		print('						</tr>'."\n");
		print('						<tr>'."\n");
		print('							<td class="attribute">Type:</td>'."\n");
		print('							<td class="valueAttribute">'.esc($row['metadata_type']).'</td>'."\n");
		print('						</tr>'."\n");
		print('					</table>'."\n");
		print('     		</td>'."\n");
		print('				</tr>'."\n");
		print('		<tr>'."\n");
		print('			<td class="attribute">Contributor(s):</td>'."\n");
<<<<<<< HEAD
		print('			<td>'."\n");
=======
		print('			<td>'."\n");			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		print('				<table class="subtable">'."\n");
		if($array2 = getCitationContributors($row['citation_info_id']))
		{
			foreach( $array2 as $row2 )
			{
				if( $seq = $row2['seq'] )
				{
					print('						<tr>'."\n");
					print('							<td class="attribute">Sequence No.:</td>'."\n");
					print('							<td class="valueAttribute">'.esc($seq).'</td>'."\n");
					print('						</tr>'."\n");
<<<<<<< HEAD
				}
=======
				}				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
				drawContributorNameParts($row2['citation_contributor_id'], $row2);
			}
		}
		print('				</table>'."\n");
<<<<<<< HEAD
		print('     		</td>'."\n");
=======
		print('     		</td>'."\n");		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		print('				<tr>'."\n");
		print('					<td class="attribute">Title:</td>'."\n");
		print('					<td class="value">'.esc($row['metadata_title']).'</td>'."\n");
		print('				</tr>'."\n");
		print('				<tr>'."\n");
		print('					<td class="attribute">Edition:</td>'."\n");
		print('					<td class="value">'.esc($row['metadata_edition']).'</td>'."\n");
		print('				</tr>'."\n");
		print('				<tr>'."\n");
		print('					<td class="attribute">URL:</td>'."\n");
		print('					<td class="value">'.esc($row['metadata_url']).'</td>'."\n");
		print('				</tr>'."\n");
		print('				<tr>'."\n");
		print('					<td class="attribute">Place Published:</td>'."\n");
		print('					<td class="value">'.esc($row['metadata_place_published']).'</td>'."\n");
		print('				</tr>'."\n");
		print('				<tr>'."\n");
		print('					<td class="attribute">Context:</td>'."\n");
		print('					<td class="value">'.esc($row['metadata_context']).'</td>'."\n");
		print('				</tr>'."\n");
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		if($array = getCitationDates($row['citation_info_id']))
		{
			print('				<tr>'."\n");
			print('				<td class="attribute">Date(s):</td>'."\n");
			print('				<td>'."\n");
<<<<<<< HEAD
			print('				<table class="subtable">'."\n");
=======
			print('				<table class="subtable">'."\n");		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
			foreach( $array as $row )
			{
				print('				<tr>'."\n");
				print('					<td class="attribute">Value:</td>'."\n");
				print('					<td class="value">'.esc($row['date']).'</td>'."\n");
				print('				</tr>'."\n");
				print('				<tr>'."\n");
				print('					<td class="attribute">Type:</td>'."\n");
				print('					<td class="valueAttribute">'.esc($row['type']).'</td>'."\n");
				print('				</tr>'."\n");
<<<<<<< HEAD
			}
=======
			}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
			print('				</table>'."\n");
			print('     		</td>'."\n");
			print('				</tr>'."\n");
		}
<<<<<<< HEAD

		print('			</table>'."\n");
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}
=======
		
		print('			</table>'."\n");
		print('         </td>'."\n");
		print('		</tr>'."\n");
	}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
}

function drawContributorNameParts($id, $row=null)
{
	if($array = getCitationContributorNameParts($id))
	{
		print('		<tr>'."\n");
		print('			<td class="attribute">NamePart(s):</td>'."\n");
<<<<<<< HEAD
		print('				<td>'."\n");
=======
		print('				<td>'."\n");			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
		print('					<table class="subtable1">'."\n");
		foreach( $array as $row )
				{
					print('				<tr>'."\n");
					print('					<td class="attribute">Value:</td>'."\n");
					print('					<td class="value">'.esc($row['value']).'</td>'."\n");
<<<<<<< HEAD
					print('				</tr>'."\n");
=======
					print('				</tr>'."\n");					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
					if( $type = $row['type'] )
					{
						print('				<tr>'."\n");
						print('					<td class="attribute">Type:</td>'."\n");
						print('					<td class="valueAttribute">'.esc($type).'</td>'."\n");
						print('				</tr>'."\n");
				}
				}
		print('					</table>'."\n");
		print('     	</td>'."\n");
<<<<<<< HEAD
		print('		</tr>'."\n");
=======
		print('		</tr>'."\n");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	}
}

?>
