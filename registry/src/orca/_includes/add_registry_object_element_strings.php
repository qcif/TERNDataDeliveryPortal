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

/* Define the form content for Registry Object Add tabs */
$_strings = array();

/*
 * HTML elements used in tabs/forms for Registry Object Add:
 *
 * // Metadata Guidance Notes
 * $_strings['']
 *
 * $_strings['*'] // default content
 *
 */

// Default content string
$_strings['*'] = "Element content not available";


$eAPP_ROOT = eAPP_ROOT;
if (!isset($has_fragment))
{
	$has_fragment = (isset($_GET['fr']) ? $_GET['fr'] : '');
}


/*********************************************
 * COLLECTION METADATA GUIDANCE NOTES
 *********************************************/

// Blank Cache - these items will be called by traverse, but dont return anything!
$_strings['*_relatedObject_key'] = ' ';
$_strings['*_location_address_electronic_value'] = ' ';
$_strings['*_relatedObject_relation_url'] = ' ';
$_strings['*_relatedObject_relation_description'] = ' ';
$_strings['*_relatedInfo_title'] = ' ';
$_strings['*_relatedInfo_identifier'] = ' ';
$_strings['*_relatedInfo_notes'] = ' ';
$_strings['*_citationInfo_citationMetadata_identifier'] = ' ';
$_strings['*_citationInfo_citationMetadata_title'] = ' ';
$_strings['*_citationInfo_citationMetadata_edition'] = ' ';
$_strings['*_citationInfo_citationMetadata_publisher'] = ' ';
$_strings['*_citationInfo_citationMetadata_placePublished'] = ' ';
$_strings['*_citationInfo_citationMetadata_url'] = ' ';
$_strings['*_citationInfo_citationMetadata_context'] = ' ';

$_strings['*_existenceDates_startDate'] = ' ';
$_strings['*_existenceDates_endDate'] = ' ';
$_strings['*_rights_rightsStatement'] = ' ';
$_strings['*_rights_licence'] = ' ';
$_strings['*_rights_accessRights'] = ' ';


// Local strings (to be interpolated below)
$dateFormatInfoString = <<<STREND
Typically provided in W3CDTF (ISO 8601) format. Valid dates might include:<br/><br/>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
   Year:<br/>
   &nbsp;&nbsp;&nbsp;YYYY (eg 1997)<br/>
   Year and month:<br/>
   &nbsp;&nbsp;&nbsp;YYYY-MM (eg 1997-07)<br/>
   Complete date:<br/>
   &nbsp;&nbsp;&nbsp;YYYY-MM-DD (eg 1997-07-16)<br/>
   Complete date plus hours and minutes:<br/>
   &nbsp;&nbsp;&nbsp;YYYY-MM-DDThh:mmTZD (eg 1997-07-16T19:20+01:00)<br/>
   Complete date plus hours, minutes and seconds:<br/>
   &nbsp;&nbsp;&nbsp;YYYY-MM-DDThh:mm:ssTZD (eg 1997-07-16T19:20:30+01:00)<br/>
   Complete date plus hours, minutes, seconds and a decimal fraction of a
second<br/>
   &nbsp;&nbsp;&nbsp;YYYY-MM-DDThh:mm:ss.sTZD (eg 1997-07-16T19:20:30.45+01:00)<br/><br/>
<<<<<<< HEAD
<<<<<<< HEAD

STREND;


//
=======
   
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
STREND;

<<<<<<< HEAD
// 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

//
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
// Mandatory Information
//
$_strings['collection_mandatoryInformation_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_mandatoryInformation">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_mandatoryInformation" class="guideNotes" style="display:none;">
										<li>
											You must specify a Type, Data Source, Group and unique Key as Mandatory Information
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgcollection.html" target="_blank">Collection Records (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['party_mandatoryInformation_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_mandatoryInformation">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_mandatoryInformation" class="guideNotes" style="display:none;">
										<li>
											You must specify a Type, Data Source, Group and unique Key as Mandatory Information
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgparty.html" target="_blank">Party Records (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;
$_strings['activity_mandatoryInformation_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_mandatoryInformation">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_mandatoryInformation" class="guideNotes" style="display:none;">
										<li>
											You must specify a Type, Data Source, Group and unique Key as Mandatory Information
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgactivity.html" target="_blank">Activity Records (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;
$_strings['service_mandatoryInformation_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_mandatoryInformation">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_mandatoryInformation" class="guideNotes" style="display:none;">
										<li>
											You must specify a Type, Data Source, Group and unique Key as Mandatory Information
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgservice.html" target="_blank">Service Records (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

HTMLEND;

//
=======
										</ul>	
										
HTMLEND;

// 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

HTMLEND;

//
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
// Names
//
$_strings['*_name_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_name">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_name" class="guideNotes" style="display:none;">
										<li>
											At least one primary name is required for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgname.html" target="_blank">Name Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['service_name_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_name">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_name" class="guideNotes" style="display:none;">
										<li>
											At least one primary name is required for the Service record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgname.html" target="_blank">Name Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

HTMLEND;

//
=======
										</ul>	
										
HTMLEND;

// 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

HTMLEND;

//
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
// Identifiers
//
$_strings['*_identifier_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_identifier">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_identifier" class="guideNotes" style="display:none;">
										<li>
											At least one identifier is recommended for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgidentifiers.html" target="_blank">Identifier Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['activity_identifier_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_identifier">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_identifier" class="guideNotes" style="display:none;">
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgidentifiers.html" target="_blank">Identifier Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['service_identifier_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_identifier">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_identifier" class="guideNotes" style="display:none;">
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgidentifiers.html" target="_blank">Identifier Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


//
// Locations
//

$_strings['*_location_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_location">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_location" class="guideNotes" style="display:none;">
										<li>
											At least one location address is required for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpglocationintro.html" target="_blank">Location Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['service_location_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_location">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_location" class="guideNotes" style="display:none;">
										<li>
											At least one electronic address is required for the Service if available
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpglocationintro.html" target="_blank">Location Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['activity_location_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_location">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_location" class="guideNotes" style="display:none;">
										<li>
											At least one location address is recommended for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpglocationintro.html" target="_blank">Location Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['party_location_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_location">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_location" class="guideNotes" style="display:none;">
										<li>
											At least one location address is recommended for this record.
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpglocationintro.html" target="_blank">Location Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

//
// Related Objects
//

$_strings['*_relatedObject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedObject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedObject" class="guideNotes" style="display:none;">
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['collection_relatedObject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedObject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedObject" class="guideNotes" style="display:none;">
										<li>
											The Collection must be related to at least one Party record
										</li>
										<li>
											The Collection must be related to at least one Activity record where possible
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['party_relatedObject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedObject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedObject" class="guideNotes" style="display:none;">
										<li>
											The Party must be related to at least one Collection record.
<<<<<<< HEAD
<<<<<<< HEAD
										</li>

=======
										</li>										
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</li>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<li>
											It is recommended that this record be related to at least one Activity record
										</li>

										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['activity_relatedObject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedObject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedObject" class="guideNotes" style="display:none;">
										<li>
											The Activity must be related to at least one Party record
										</li>
										<li>
											The Activity must be related to at least one Collection record if available.
<<<<<<< HEAD
<<<<<<< HEAD
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
										</ul>

=======
										</li>										
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['service_relatedObject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedObject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedObject" class="guideNotes" style="display:none;">
										<li>
											It is recommended that the Service be related to at least one Party record
										</li>
										<li>
											The Service must be related to at least one Collection record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedobject.html" target="_blank">Related Object Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;



//
// Subjects
//

$_strings['*_subject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_subject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_subject" class="guideNotes" style="display:none;">
										<li>
											At least one subject (e.g. anzsrc-for code) is recommended for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgsubject.html" target="_blank">Subject Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['service_subject_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_subject">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_subject" class="guideNotes" style="display:none;">
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgsubject.html" target="_blank">Subject Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


//
// Descriptions
//

$_strings['collection_description_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_description">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_description" class="guideNotes" style="display:none;">
										<li>
<<<<<<< HEAD
<<<<<<< HEAD
											At least one description (brief and/or full) is required for this record.
										</li>
										<li>
											At least one right or one description (access or accessRights) is required for the Collection.
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgdescription.html" target="_blank">Description Element (Content Providers Guide)</a>
										</li>
										</ul>

=======
											At least one description (brief and/or full) is required for this record. The description must be longer than 9 characters.
=======
											At least one description (brief and/or full) is required for this record.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</li>
										<li>
											At least one right or one description (access or accessRights) is required for the Collection.
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgdescription.html" target="_blank">Description Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;

$_strings['*_description_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_description">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_description" class="guideNotes" style="display:none;">
										<li>
<<<<<<< HEAD
<<<<<<< HEAD
											At least one description (brief and/or full) is recommended for the record.
=======
											At least one description (brief and/or full) is recommended for the record. The description must be longer than 9 characters
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											At least one description (brief and/or full) is recommended for the record.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgdescription.html" target="_blank">Description Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;



//
// Coverages
//

$_strings['*_coverage_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_coverage">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_coverage" class="guideNotes" style="display:none;">
										<li>
											At least one spatial coverage is recommended for this record
										</li>
										<li>
											At least one temporal coverage entry is recommended for this record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgcoverage.html" target="_blank">Coverage Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


//
// Citations
//

$_strings['*_citationInfo_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_citationInfo">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_citationInfo" class="guideNotes" style="display:none;">
										<li>
											Citation data for the collection is recommended.
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgcitation.html" target="_blank">Citation Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


//
// Related Info
//

$_strings['*_relatedInfo_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_relatedInfo">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_relatedInfo" class="guideNotes" style="display:none;">
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgrelatedinfo.html" target="_blank">Related Information Element (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

HTMLEND;

//
=======
										</ul>	
										
HTMLEND;

// 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

HTMLEND;

//
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
// Existence Dates
//

$_strings['*_existenceDates_metadata_guidance'] = <<<HTMLEND
										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_existenceDates">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_existenceDates" class="guideNotes" style="display:none;">
<<<<<<< HEAD
<<<<<<< HEAD

										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
=======
									
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>
										
										</ul>	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f



HTMLEND;

$_strings['party_existenceDates_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_existenceDates">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_existenceDates" class="guideNotes" style="display:none;">
										<li>
											Existence dates are recommended for the Party.
<<<<<<< HEAD
<<<<<<< HEAD
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
=======
										</li>										
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>
										
										</ul>	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;
$_strings['activity_existenceDates_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_existenceDates">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_existenceDates" class="guideNotes" style="display:none;">
										<li>
											Existence dates are recommended for the Activity.
<<<<<<< HEAD
<<<<<<< HEAD
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
=======
										</li>										
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>
										
										</ul>	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgexistencedates.html" target="_blank">Existence Dates Element (Content Providers Guide)</a>
										</li>

										</ul>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;

//
// Access Policy (Service ONLY)
//

$_strings['service_accessPolicy_metadata_guidance'] = <<<HTMLEND

										<a href="javascript:toggleMetaGuide();" class="guideNotesPrompt" id="guideNotesPrompt_accessPolicy">+ Show Metadata Content Guidance Notes</a>
										<ul id="guideNotes_accessPolicy" class="guideNotes" style="display:none;">
										<li>
											Access policy for services is described by recording a URL that points to a resource describing service access policies. This could be a web site, or, for example, an XACML resource. XACML is eXtensible Access Control Markup Language, a declarative access control policy language. The access policy need not be machine-readable.
										</li>
										<li>
											At least one Access Policy URL is recommended for the Service record
										</li>
										<li>
											See also: <a href="http://ands.org.au/guides/cpguide/cpgservice.html" target="_blank">Service Record (Content Providers Guide)</a>
										</li>
<<<<<<< HEAD
<<<<<<< HEAD
										</ul>

=======
										</ul>	
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</ul>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;




/*********************************************
 * COLLECTION TABLE ELEMENTS
 *********************************************/
$ds_string = "";
if (isset($_GET['cache_set']) || (isset($_GET['tag']) && (strpos($_GET['tag'], "mandatoryInformation") !== FALSE || strpos($_GET['tag'], "relatedObject") !== FALSE))) {
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

	// Execute the search.
	$rawResults = getDataSources(null, null);
	$searchResults = array();
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if (userIsORCA_ADMIN())
	{
		$rawResults[] = array(
								'data_source_key' => 'PUBLISH_MY_DATA',
								'title' => 'PUBLISH MY DATA (ORCA Admin View)',
								'qa_flag' => 't',
								'auto_publish' => 'f',
<<<<<<< HEAD
<<<<<<< HEAD
		);
	}

=======
		);	
	}
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		);
	}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Check the record owners.
	if( $rawResults )
	{
		foreach( $rawResults as $dataSource )
		{
			if( (userIsORCA_ADMIN() || userIsDataSourceRecordOwner($dataSource['record_owner'])) )
			{
				$searchResults[] = $dataSource;
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
	}
	if (isset($_GET['data_source']))
	{
		$ourDataSource = str_replace("+"," ", rawurldecode($_GET['data_source']));
	}
	else
	{
		$ourDataSource = '';
	}

	/*
	if (isset($_GET['key']) && $key_obj = getDraftRegistryObject(rawurldecode($_GET['key']), rawurldecode($_GET['data_source'])) ) {
		var_dump($key_obj);
		$ourDataSource = $key_obj[0]["registry_object_data_source"];
	} elseif (isset($_GET['key']) && $key_obj = getRegistryObject(rawurldecode($_GET['key']))) {
		var_dump($key_obj);
		$ourDataSource = $key_obj[0]["data_source_key"];
	}
	*/
	$ds_string = '<option value=""> </option>';
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	for( $i=0; $i < count($searchResults); $i++ )
	{
		$ds_string .= '<option value="'.$searchResults[$i]['data_source_key'].'"'.($searchResults[$i]['data_source_key'] == $ourDataSource ? ' selected' : '').'>'.$searchResults[$i]['title'].'</option>';
	}
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Alert the user if there are no datasources as
	// they will not be able to edit the record.
	$ds_script = '';
	if (count($searchResults) == 0)
	{
<<<<<<< HEAD
<<<<<<< HEAD
		$ds_script = "alert('You are not able to access any Data Sources and will therefore be unable to add or edit this record. " .
									"Contact your organisation Data Source Administrator or " . eCONTACT_EMAIL . " for more information.');";
	}

=======
		$ds_script = "alert('You are not able to access any Data Sources and will therefore be unable to add or edit this record. " .  
									"Contact your organisation Data Source Administrator or " . eCONTACT_EMAIL . " for more information.');";
	}
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$ds_script = "alert('You are not able to access any Data Sources and will therefore be unable to add or edit this record. " .
									"Contact your organisation Data Source Administrator or " . eCONTACT_EMAIL . " for more information.');";
	}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$email_script = "var adminEmail = '" . eCONTACT_EMAIL ."';";

$originatingSource = eORIGSOURCE_REGISTER_MY_DATA;

}

if (isset($_GET['tag']) && (strpos($_GET['tag'], "mandatoryInformation") !== FALSE || strpos($_GET['tag'], "relatedObject") !== FALSE))
{
<<<<<<< HEAD
<<<<<<< HEAD

$_strings['*_mandatoryInformation'] = <<<HTMLEND

											<table class="formTable" style="border:none;">

											<tbody class="formFields">

=======
	
$_strings['*_mandatoryInformation'] = <<<HTMLEND

											<table class="formTable" style="border:none;"> 
											
											<tbody class="formFields"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

$_strings['*_mandatoryInformation'] = <<<HTMLEND

											<table class="formTable" style="border:none;">

											<tbody class="formFields">

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td><label for="collection_type" class="mandatory">Type:</label></td>
													<td style="font-size:0.9em;" onclick="getHelpText('collection_type');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" id="object_mandatoryInformation_type" name="object.mandatoryInformation.type" maxlength="32" size="27" /><img id="button_mandatoryInformation_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div name="errors_mandatoryInformation_type" class="fieldError"></div></td>
												</tr>
												<tr>
<<<<<<< HEAD
<<<<<<< HEAD
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td>
=======
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td onclick="getHelpText('collection_data_source');">
														<select onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" name="object.mandatoryInformation.dataSource" id="object_mandatoryInformation_dataSource" style="width:280px;">
															{$ds_string}
														</select>
														<input type="hidden" id="object_mandatoryInformation_originatingSource" name="object.mandatoryInformation.originatingSource" value="{$originatingSource}" />
<<<<<<< HEAD
<<<<<<< HEAD
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dataSource"></div></td>
												</tr>

												<tr>
													<td><label for="object.mandatoryInformation.group" class="mandatory">Group:</label></td>
													<td onclick="getHelpText('collection_group');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_group" name="object.mandatoryInformation.group" maxlength="512" size="27" /><img id="button_mandatoryInformation_group" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_group"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_key" class="mandatory">Key:</label></td>
													<td onclick="getHelpText('collection_key');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_key" name="object.mandatoryInformation.key" class="input_filter_trim_spaces" maxlength="255" size="30" />
														<br/>
														<span class="inputFormat">Key must be unique and is case-sensitive</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_key"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateModified">Date Modified:</label> </td>
													<td onclick="getHelpText('collection_date_modified');">
														<input type="text" value="" id="object_mandatoryInformation_dateModified" name="object.mandatoryInformation.dateModified" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec('object_mandatoryInformation_dateModified', 'YYYY-MM-DDThh:mm:00Z', 'collection_date_modified_dctImage');</script>&nbsp;<span id="collection_date_modified_dctImage">&nbsp;</span>&nbsp;<span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateModified"></div></td>
												</tr>
											</tbody>

										</table>
										<br/><br/>

										<script>
											{$ds_script}
											{$email_script}
=======
													</td> 
=======
													</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_mandatoryInformation_dataSource"></div></td>
												</tr>

												<tr>
													<td><label for="object.mandatoryInformation.group" class="mandatory">Group:</label></td>
													<td onclick="getHelpText('collection_group');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_group" name="object.mandatoryInformation.group" maxlength="512" size="27" /><img id="button_mandatoryInformation_group" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_group"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_key" class="mandatory">Key:</label></td>
													<td onclick="getHelpText('collection_key');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_key" name="object.mandatoryInformation.key" class="input_filter_trim_spaces" maxlength="255" size="30" />
														<br/>
														<span class="inputFormat">Key must be unique and is case-sensitive</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_key"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateModified">Date Modified:</label> </td>
													<td onclick="getHelpText('collection_date_modified');">
														<input type="text" value="" id="object_mandatoryInformation_dateModified" name="object.mandatoryInformation.dateModified" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec('object_mandatoryInformation_dateModified', 'YYYY-MM-DDThh:mm:00Z', 'collection_date_modified_dctImage');</script>&nbsp;<span id="collection_date_modified_dctImage">&nbsp;</span>&nbsp;<span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateModified"></div></td>
												</tr>
											</tbody>

										</table>
										<br/><br/>

										<script>
<<<<<<< HEAD
											{$ds_script}	
											{$email_script}										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											{$ds_script}
											{$email_script}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											addVocabComplete('object_mandatoryInformation_type','RIFCS' + $("#elementCategory").attr("value").charAt(0).toUpperCase() + $("#elementCategory").attr("value").slice(1) + 'Type');
											addGroupAutocomplete('#object_mandatoryInformation_group');
										</script>

HTMLEND;

$_strings['collection_mandatoryInformation'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table class="formTable" style="border:none;">

											<tbody class="formFields">

<<<<<<< HEAD
=======
											<table class="formTable" style="border:none;"> 
											
											<tbody class="formFields"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td><label for="collectname="errors_on_type" class="mandatory">Type:</label></td>
													<td style="font-size:0.9em;" onclick="getHelpText('collection_type');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" id="object_mandatoryInformation_type" name="object.mandatoryInformation.type" maxlength="32" size="27" /><img id="button_mandatoryInformation_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div name="errors_mandatoryInformation_type" class="fieldError"></div></td>
												</tr>
												<tr>
<<<<<<< HEAD
<<<<<<< HEAD
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td>
=======
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													<td><label for="object.mandatoryInformation.dataSource" class="mandatory">Data Source:</label></td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td onclick="getHelpText('collection_data_source');">
														<select onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" name="object.mandatoryInformation.dataSource" id="object_mandatoryInformation_dataSource" style="width:280px;">
															{$ds_string}
														</select>
														<input type="hidden" id="object_mandatoryInformation_originatingSource" name="object.mandatoryInformation.originatingSource" value="{$originatingSource}" />
<<<<<<< HEAD
<<<<<<< HEAD
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dataSource"></div></td>
												</tr>

												<tr>
													<td><label for="object.mandatoryInformation.group" class="mandatory">Group:</label></td>
													<td onclick="getHelpText('collection_group');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_group" name="object.mandatoryInformation.group" maxlength="512" size="27" /><img id="button_mandatoryInformation_group" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_group"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_key" class="mandatory">Key</label></td>
													<td onclick="getHelpText('collection_key');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_key" name="object.mandatoryInformation.key" maxlength="512" size="30" />
														<br/>
														<span class="inputFormat">Key must be unique and is case-sensitive</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_key"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateAccessioned">Date Accessioned: </label></td>
													<td onclick="getHelpText('collection_date_accessioned');">
														<input type="text" value="" id="object_mandatoryInformation_dateAccessioned" name="object.mandatoryInformation.dateAccessioned" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec("object_mandatoryInformation_dateAccessioned", "YYYY-MM-DDThh:mm:00Z", "collection_date_accessioned_dctImage"); </script>&nbsp;<span id="collection_date_accessioned_dctImage">&nbsp;</span>&nbsp;  <span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateAccessioned"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateModified">Date Modified:</label> </td>
													<td onclick="getHelpText('collection_date_modified');">
														<input type="text" value="" id="object_mandatoryInformation_dateModified" name="object.mandatoryInformation.dateModified" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec('object_mandatoryInformation_dateModified', 'YYYY-MM-DDThh:mm:00Z', 'collection_date_modified_dctImage');</script>&nbsp;<span id="collection_date_modified_dctImage">&nbsp;</span>&nbsp;<span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateModified"></div></td>
												</tr>
											</tbody>

										</table>
										<br/><br/>

										<script>
											{$ds_script}
											{$email_script}
											addVocabComplete('object_mandatoryInformation_type','RIFCS' + $("#elementCategory").attr("value").charAt(0).toUpperCase() + $("#elementCategory").attr("value").slice(1) + 'Type');
											addGroupAutocomplete('#object_mandatoryInformation_group');

=======
													</td> 
=======
													</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_mandatoryInformation_dataSource"></div></td>
												</tr>

												<tr>
													<td><label for="object.mandatoryInformation.group" class="mandatory">Group:</label></td>
													<td onclick="getHelpText('collection_group');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_group" name="object.mandatoryInformation.group" maxlength="512" size="27" /><img id="button_mandatoryInformation_group" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_group"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_key" class="mandatory">Key</label></td>
													<td onclick="getHelpText('collection_key');">
														<input onKeyUp="checkMandatoryFields(this.id)" onChange="checkMandatoryFields(this.id)" type="text" value="" id="object_mandatoryInformation_key" name="object.mandatoryInformation.key" maxlength="512" size="30" />
														<br/>
														<span class="inputFormat">Key must be unique and is case-sensitive</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_key"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateAccessioned">Date Accessioned: </label></td>
													<td onclick="getHelpText('collection_date_accessioned');">
														<input type="text" value="" id="object_mandatoryInformation_dateAccessioned" name="object.mandatoryInformation.dateAccessioned" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec("object_mandatoryInformation_dateAccessioned", "YYYY-MM-DDThh:mm:00Z", "collection_date_accessioned_dctImage"); </script>&nbsp;<span id="collection_date_accessioned_dctImage">&nbsp;</span>&nbsp;  <span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateAccessioned"></div></td>
												</tr>
												<tr>
													<td><label for="object_mandatoryInformation_dateModified">Date Modified:</label> </td>
													<td onclick="getHelpText('collection_date_modified');">
														<input type="text" value="" id="object_mandatoryInformation_dateModified" name="object.mandatoryInformation.dateModified" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="20" />
														<script type="text/javascript">dctGetDateTimeControlSpec('object_mandatoryInformation_dateModified', 'YYYY-MM-DDThh:mm:00Z', 'collection_date_modified_dctImage');</script>&nbsp;<span id="collection_date_modified_dctImage">&nbsp;</span>&nbsp;<span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
													</td>
													<td><div class="fieldError" name="errors_mandatoryInformation_dateModified"></div></td>
												</tr>
											</tbody>

										</table>
										<br/><br/>

										<script>
											{$ds_script}
											{$email_script}
											addVocabComplete('object_mandatoryInformation_type','RIFCS' + $("#elementCategory").attr("value").charAt(0).toUpperCase() + $("#elementCategory").attr("value").slice(1) + 'Type');
											addGroupAutocomplete('#object_mandatoryInformation_group');
<<<<<<< HEAD
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</script>

HTMLEND;

<<<<<<< HEAD
<<<<<<< HEAD
}

$_strings['*_name'] = <<<HTMLEND

										<table id="table_name_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

												<tr>
													<td width="39px" style="font-weight:normal;"><label for="object_name_%%SEQNUM1%%_type">Type:</label></td>
													<td style="font-size:0.9em;" width="300px" onclick="getHelpText('collection_name_type');">

=======
}											
											
=======
}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
$_strings['*_name'] = <<<HTMLEND

										<table id="table_name_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

												<tr>
													<td width="39px" style="font-weight:normal;"><label for="object_name_%%SEQNUM1%%_type">Type:</label></td>
													<td style="font-size:0.9em;" width="300px" onclick="getHelpText('collection_name_type');">
<<<<<<< HEAD
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<input type="text" id="object_name_%%SEQNUM1%%_type" name="object.name[%%SEQNUM1%%].type" maxlength="512" size="27" /><img id="button_name_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
														<input type="hidden" id="object_name_%%SEQNUM1%%_lang" name="object.name[%%SEQNUM1%%].lang" maxlength="64" />
													<td><div class="fieldError" name="errors_name_%%SEQNUM1%%_type" style=""></div></td>
													<td width="100%">
														<input type="button" class="buttonSmall" name="btn_name_%%SEQNUM1%%_remove" value="Remove this Name" onClick="decCount('object.name'); $('#table_name_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
													</td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Name Parts:</div>
														<div name="errors_name_%%SEQNUM1%%_namePart" class="error_notification" style="display:none;"></div>
														<div id="object.name_%%SEQNUM1%%_namePart_container">&nbsp;</div>
													</td>
												</tr>

=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Name Parts:</div>
														<div name="errors_name_%%SEQNUM1%%_namePart" class="error_notification" style="display:none;"></div>
														<div id="object.name_%%SEQNUM1%%_namePart_container">&nbsp;</div>
													</td>
<<<<<<< HEAD
												</tr> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;">
														<input type="button" name="btn_name_%%SEQNUM1%%_addnamePart" value="Add new Name Part" onClick="getElement('namePart', [], 'object.name[%%SEQNUM1%%].', null, getNextSeq('name_%%SEQNUM1%%_namePart'));" style="float:right;" />
														<br/>
													</td>
												</tr>

<<<<<<< HEAD
<<<<<<< HEAD
											</tbody>

										</table>

										<script>

=======
											</tbody> 
=======
											</tbody>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										</table>

										<script>
<<<<<<< HEAD
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											addVocabComplete('object_name_%%SEQNUM1%%_type','RIFCSNameType');
											if ({$has_fragment} == false) {
												getElement('namePart', [], 'object.name[%%SEQNUM1%%].', null, getNextSeq('name_%%SEQNUM1%%_namePart'));
											}
<<<<<<< HEAD
<<<<<<< HEAD

=======
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</script>


HTMLEND;


$_strings['*_name_namePart'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">

<<<<<<< HEAD
																<tr>
																	<td width="39px" style="text-align:right;"><label class="mandatory" for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_namePart_value');">
=======
														<table id="table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
																
																<tr>
																	<td width="39px" style="text-align:right;"><label class="mandatory" for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value">Value:</label></td> 
																	<td onclick="getHelpText('collection_namePart_value');"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																<tr>
																	<td width="39px" style="text-align:right;"><label class="mandatory" for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_namePart_value');">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		<input type="text" value="" name="object.name[%%SEQNUM1%%].namePart[%%SEQNUM2%%].value" id="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" maxlength="512" size="40" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value"></div></td>
																	<td>
<<<<<<< HEAD
<<<<<<< HEAD
																		<input type="button" name="btn_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_remove" value="Remove this Name Part" onClick="decCount('object.name[%%SEQNUM1%%].namePart'); $('#table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%').remove();" style="float:right;" />
																	</td>
																</tr>

=======
																		<input type="button" name="btn_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_remove" value="Remove this Name Part" onClick="decCount('object.name[%%SEQNUM1%%].namePart'); $('#table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%').remove();" style="float:right;" />									
																	</td>
																</tr>
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																		<input type="button" name="btn_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_remove" value="Remove this Name Part" onClick="decCount('object.name[%%SEQNUM1%%].namePart'); $('#table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%').remove();" style="float:right;" />
																	</td>
																</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr id="row_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" style="display:none;">
																	<td width="39px" style="text-align:right;"><label for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type">Type:</label></td>
																	<td onclick="getHelpText('collection_namePart_type');" width="260px">
																		<input type="text" id="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" name="object.name[%%SEQNUM1%%].namePart[%%SEQNUM2%%].type" maxlength="512" size="27" /><img id="button_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:16px; width:16px;" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type"></div></td>
																	<td>
<<<<<<< HEAD
<<<<<<< HEAD

																	</td>
																</tr>


															</tbody>

														</table>

=======
																		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	</td>
																</tr>


															</tbody>

														</table>
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<script>
															$("#object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type").change( function() {
															  if ($('#' + this.id).val() != '') { $('#row_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type').attr("style",""); }
															});
															//addVocabComplete('object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type','RIFCSNamePartType');
<<<<<<< HEAD
<<<<<<< HEAD

=======
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</script>

HTMLEND;

$_strings['party_name_namePart'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
														<table id="table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">

																<tr>
																	<td style="text-align:right;"><label for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_namePart_value');">
																		<input type="text" value="" name="object.name[%%SEQNUM1%%].namePart[%%SEQNUM2%%].value" id="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" maxlength="512" size="40" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" style="font-size:1.05em;"></div></td>
=======
														<table id="table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
=======
														<table id="table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

																<tr>
																	<td style="text-align:right;"><label for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_namePart_value');">
																		<input type="text" value="" name="object.name[%%SEQNUM1%%].namePart[%%SEQNUM2%%].value" id="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" maxlength="512" size="40" />
																	</td>
<<<<<<< HEAD
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" style="font-size:1.05em;"></div></td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_value" style="font-size:1.05em;"></div></td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<td rowspan="2" align="right">
																		<input type="button" name="btn_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_remove" value="Remove this Name Part" onClick="decCount('object.name[%%SEQNUM1%%].namePart'); $('#table_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%').remove();"  /><br/>
																	</td>
																</tr>

<<<<<<< HEAD
<<<<<<< HEAD

=======
																												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label for="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type">Type:</label></td>
																	<td onclick="getHelpText('collection_namePart_type');" width="260px">
																		<input type="text" id="object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" name="object.name[%%SEQNUM1%%].namePart[%%SEQNUM2%%].type" maxlength="512" size="27" /><img id="button_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:16px; width:16px;" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type" style="font-size:1.05em;"></div></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD


															</tbody>

														</table>

														<script>

															addVocabComplete('object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type','RIFCSNamePartType');

=======
																
																
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															</tbody>

														</table>

														<script>

															addVocabComplete('object_name_%%SEQNUM1%%_namePart_%%SEQNUM2%%_type','RIFCSNamePartType');
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</script>

HTMLEND;


$ds_string = str_replace("<option value=\"\"> </option>", '', $ds_string);
$_strings['*_relatedObject'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_relatedObject_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
												<tr>
													<td width="39px" style="font-weight:normal;"><label class="mandatory" for="object_relatedObject_%%SEQNUM1%%_key_1_value">Key:</label></td>
													<td style="font-size:0.9em;" width="300px" onclick="getHelpText('collection_related_object_key');">
															<input class="relatedObjectKey input_filter_trim_spaces" type="text" onKeyUp="getRelatedObjectClass(this.id); testRelatedKey(this.id);" onChange="getRelatedObjectClass(this.id); testRelatedKey(this.id);" id="object_relatedObject_%%SEQNUM1%%_key_1_value" name="object.relatedObject[%%SEQNUM1%%].key[1].value" maxlength="512" size="30" style="display:inline;" /><img name="relatedImg" src="{$eAPP_ROOT}orca/_images/preview.png" onClick='showSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");' style="cursor:pointer; display:inline; margin-left:8px; vertical-align:bottom; height:16px; width:16px;" />
															<input type="hidden" id="object_relatedObject_%%SEQNUM1%%_key_1_roclass" name="object.relatedObject[%%SEQNUM1%%].key[1].roclass" value=""/>
=======
											<table id="table_relatedObject_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
												
												<tr>
													<td width="39px" style="font-weight:normal;"><label class="mandatory" for="object_relatedObject_%%SEQNUM1%%_key_1_value">Key:</label></td>
													<td style="font-size:0.9em;" width="300px" onclick="getHelpText('collection_related_object_key');">
															<input class="relatedObjectKey input_filter_trim_spaces" type="text" onKeyUp="getRelatedObjectClass(this.id); testRelatedKey(this.id);" onChange="getRelatedObjectClass(this.id); testRelatedKey(this.id);" id="object_relatedObject_%%SEQNUM1%%_key_1_value" name="object.relatedObject[%%SEQNUM1%%].key[1].value" maxlength="512" size="30" style="display:inline;" /><img name="relatedImg" src="{$eAPP_ROOT}orca/_images/preview.png" onClick='showSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");' style="cursor:pointer; display:inline; margin-left:8px; vertical-align:bottom; height:16px; width:16px;" />	
															<input type="hidden" id="object_relatedObject_%%SEQNUM1%%_key_1_roclass" name="object.relatedObject[%%SEQNUM1%%].key[1].roclass" value=""/>													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												<tr>
													<td width="39px" style="font-weight:normal;"><label class="mandatory" for="object_relatedObject_%%SEQNUM1%%_key_1_value">Key:</label></td>
													<td style="font-size:0.9em;" width="300px" onclick="getHelpText('collection_related_object_key');">
															<input class="relatedObjectKey input_filter_trim_spaces" type="text" onKeyUp="getRelatedObjectClass(this.id); testRelatedKey(this.id);" onChange="getRelatedObjectClass(this.id); testRelatedKey(this.id);" id="object_relatedObject_%%SEQNUM1%%_key_1_value" name="object.relatedObject[%%SEQNUM1%%].key[1].value" maxlength="512" size="30" style="display:inline;" /><img name="relatedImg" src="{$eAPP_ROOT}orca/_images/preview.png" onClick='showSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");' style="cursor:pointer; display:inline; margin-left:8px; vertical-align:bottom; height:16px; width:16px;" />
															<input type="hidden" id="object_relatedObject_%%SEQNUM1%%_key_1_roclass" name="object.relatedObject[%%SEQNUM1%%].key[1].roclass" value=""/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
													<td><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_key_1_value" style=""></div></td>
													<td>
														<input type="button" class="buttonSmall" name="btn_relatedObject_%%SEQNUM1%%_remove" value="Remove this Related Object" onClick="decCount('object.relatedObject'); $('#table_relatedObject_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
													</td>
<<<<<<< HEAD
<<<<<<< HEAD

=======
													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												</tr>
												<tr><td colspan="4"><div class="ro_preview"></div></td></tr>
												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Relations:</div>
														<div name="errors_relatedObject_%%SEQNUM1%%_relation" class="error_notification" style="display:none;"></div>
<<<<<<< HEAD
<<<<<<< HEAD
														<div id="object.relatedObject_%%SEQNUM1%%_relation_container">&nbsp;</div>
														<input type="button" name="btn_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_add" value="Add new Relation" onClick="getElement('relation', [], 'object.relatedObject[%%SEQNUM1%%].', null, getNextSeq('relatedObject_%%SEQNUM1%%_relation'));" style="float:right;" /><br/>
													</td>
												</tr>

											</tbody>

										</table>
											<div id="searchDialog_object_relatedObject_%%SEQNUM1%%_key_1" class="window">
											<img src="{$eAPP_ROOT}orca/_images/error_icon.png" onClick='closeSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");' style="cursor:pointer; position:absolute; top:5px; right:5px; width:16px;" />


=======
														<div id="object.relatedObject_%%SEQNUM1%%_relation_container">&nbsp;</div>	
														<input type="button" name="btn_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_add" value="Add new Relation" onClick="getElement('relation', [], 'object.relatedObject[%%SEQNUM1%%].', null, getNextSeq('relatedObject_%%SEQNUM1%%_relation'));" style="float:right;" /><br/>											
=======
														<div id="object.relatedObject_%%SEQNUM1%%_relation_container">&nbsp;</div>
														<input type="button" name="btn_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_add" value="Add new Relation" onClick="getElement('relation', [], 'object.relatedObject[%%SEQNUM1%%].', null, getNextSeq('relatedObject_%%SEQNUM1%%_relation'));" style="float:right;" /><br/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
												</tr>

											</tbody>

										</table>
											<div id="searchDialog_object_relatedObject_%%SEQNUM1%%_key_1" class="window">
											<img src="{$eAPP_ROOT}orca/_images/error_icon.png" onClick='closeSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");' style="cursor:pointer; position:absolute; top:5px; right:5px; width:16px;" />
<<<<<<< HEAD
											
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<p><label>Search by Name/Title: </label><input type="text" class="searchTextBox" id="object_relatedObject_%%SEQNUM1%%_key_1_search"/></p>
												<p>
												<select id="select_object_relatedObject_%%SEQNUM1%%_key_1_class">
												<option value="Collection">Collection</option>
												<option value="Party" selected="selected">Party</option>
												<option value="Activity">Activity</option>
												<option value="Service">Service</option>
												</select>
												<select id="select_object_relatedObject_%%SEQNUM1%%_key_1_dataSource" style="width:280px;">
													<option value=''>All Data Sources</option>
													{$ds_string}
												</select>
												<a href="javascript:void(0);" id="object_relatedObject_%%SEQNUM1%%_key_1_button">Search</a></p>
												<div class="relatedObject_result" id="object_relatedObject_%%SEQNUM1%%_key_1_result"></div>
<<<<<<< HEAD
<<<<<<< HEAD


											</div>
											<div class="mask" onclick="closeSearchModal('object_relatedObject_%%SEQNUM1%%_key_1')" id="mask_object_relatedObject_%%SEQNUM1%%_key_1"></div>



										<script>

											if ({$has_fragment} == false) {
												getElement('relation', [], 'object.relatedObject[%%SEQNUM1%%].', null, getNextSeq('relatedObject_%%SEQNUM1%%_relation'));

												//showSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");
											}
											addRelatedObjectSearch('object_relatedObject_%%SEQNUM1%%_key_1');
												//addRelatedObjectAutocomplete('object_relatedObject_%%SEQNUM1%%_key_1_name');

=======
												
												
											</div>  
=======


											</div>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<div class="mask" onclick="closeSearchModal('object_relatedObject_%%SEQNUM1%%_key_1')" id="mask_object_relatedObject_%%SEQNUM1%%_key_1"></div>



										<script>

											if ({$has_fragment} == false) {
												getElement('relation', [], 'object.relatedObject[%%SEQNUM1%%].', null, getNextSeq('relatedObject_%%SEQNUM1%%_relation'));

												//showSearchModal("object_relatedObject_%%SEQNUM1%%_key_1");
											}
											addRelatedObjectSearch('object_relatedObject_%%SEQNUM1%%_key_1');
<<<<<<< HEAD
												//addRelatedObjectAutocomplete('object_relatedObject_%%SEQNUM1%%_key_1_name');		
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												//addRelatedObjectAutocomplete('object_relatedObject_%%SEQNUM1%%_key_1_name');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</script>


HTMLEND;



$_strings['*_relatedObject_relation'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">

<<<<<<< HEAD
=======
														<table id="table_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label class="mandatory" for="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type">Type:</label></td>
																	<td onclick="getHelpText('collection_relation_type');" width="260px">
																		<div name="errors_relatedObject_%%SEQNUM1%%_relation" class="error_notification" style="display:none;"></div>
<<<<<<< HEAD
<<<<<<< HEAD
																		<input type="text" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].type" maxlength="512" size="30" />
=======
																		<input type="text" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].type" maxlength="512" size="30" />		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																		<input type="text" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].type" maxlength="512" size="30" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		<img id="button_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick="addVocabComplete('object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type','RIFCS'+ $('#elementCategory').val().charAt(0).toUpperCase() + $('#elementCategory').val().slice(1)+'RelationType');toggleDropdown(this.id);" class='cursorimg' style="vertical-align:bottom; height:16px; width:16px;" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type" style="font-size:1.05em;"></div></td>
																	<td rowspan="3" align="right" width="100%">
																		<input type="button" name="btn_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_remove" value="Remove this Relation" onClick="decCount('object.relatedObject[%%SEQNUM1%%].relation'); $('#table_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%').remove();"  /><br/>
																	</td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

																<tr>

																	<td style="text-align:right;"><label for="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value">Description:</label></td>
																	<td onclick="getHelpText('collection_relation_description');">
																		<input type="text" value="" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].description[1].value" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value" maxlength="512" size="40" />
																		<input type="hidden" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_lang" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].description[1].lang" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value"></div></td>

																</tr>

																<tr>

																	<td style="text-align:right;"><label for="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value">URL:</label></td>
																	<td onclick="getHelpText('collection_relation_url');">
																		<input type="text" value="" onChange="testAnyURI(this.id);" class="validUri" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].url[1].value" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value" maxlength="512" size="40" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value"></div></td>

																</tr>

															</tbody>


=======
																
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>

																	<td style="text-align:right;"><label for="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value">Description:</label></td>
																	<td onclick="getHelpText('collection_relation_description');">
																		<input type="text" value="" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].description[1].value" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value" maxlength="512" size="40" />
																		<input type="hidden" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_lang" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].description[1].lang" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_description_1_value"></div></td>

																</tr>

																<tr>

																	<td style="text-align:right;"><label for="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value">URL:</label></td>
																	<td onclick="getHelpText('collection_relation_url');">
																		<input type="text" value="" onChange="testAnyURI(this.id);" class="validUri" name="object.relatedObject[%%SEQNUM1%%].relation[%%SEQNUM2%%].url[1].value" id="object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value" maxlength="512" size="40" />
																	</td>
																	<td width="100%"><div class="fieldError" name="errors_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_url_1_value"></div></td>

																</tr>

															</tbody>

<<<<<<< HEAD
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</table>
														<script>
															addVocabComplete('object_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_type');
															removeButtonIfLast('btn_relatedObject_%%SEQNUM1%%_relation_%%SEQNUM2%%_remove');
														</script>

HTMLEND;


$_strings['*_identifier'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_identifier_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label class="mandatory" for="object_identifier_%%SEQNUM1%%_value">Value:</label></td>
													<td onclick="getHelpText('collection_identifier_value');" width="300px">
														<input type="text" value="" name="object.identifier[%%SEQNUM1%%].value" id="object_identifier_%%SEQNUM1%%_value" maxlength="512" size="40" />
													</td>
=======
											<table id="table_identifier_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																												
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label class="mandatory" for="object_identifier_%%SEQNUM1%%_value">Value:</label></td>
													<td onclick="getHelpText('collection_identifier_value');" width="300px">
														<input type="text" value="" name="object.identifier[%%SEQNUM1%%].value" id="object_identifier_%%SEQNUM1%%_value" maxlength="512" size="40" />
<<<<<<< HEAD
													</td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_identifier_%%SEQNUM1%%_value"></div></td>
													<td>
														<input type="button" class="buttonSmall" name="btn_identifier_%%SEQNUM1%%_remove" value="Remove this Identifier" onClick="decCount('object.identifier'); $('#table_identifier_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
													</td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label class="mandatory" for="object_identifier_%%SEQNUM1%%_type">Type:</label></td>
													<td style="font-size:0.9em;">
														<input type="text" value="" name="object.identifier[%%SEQNUM1%%].type" id="object_identifier_%%SEQNUM1%%_type" maxlength="512" size="35" /> <img id="button_identifier_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_identifier_%%SEQNUM1%%_type"></div></td>
													<td width="100%"></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

											</tbody>

										</table>

										<script>

											addVocabComplete('object_identifier_%%SEQNUM1%%_type','RIFCSIdentifierType');

=======
												
											</tbody> 
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

											</tbody>

										</table>

										<script>

											addVocabComplete('object_identifier_%%SEQNUM1%%_type','RIFCSIdentifierType');
<<<<<<< HEAD
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										</script>

HTMLEND;

$_strings['*_description'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_description_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;"><label class="mandatory" for="object_description_%%SEQNUM1%%_value">Value:</label></td>
													<td>
														<textarea name="object.description[%%SEQNUM1%%].value" id="object_description_%%SEQNUM1%%_value" class="ckeditor_text"></textarea>
																							<script>
														CKEDITOR.replace('object_description_%%SEQNUM1%%_value',{ toolbar: 'Basic'});

										</script>
														</td>
=======
											<table id="table_description_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																												
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;"><label class="mandatory" for="object_description_%%SEQNUM1%%_value">Value:</label></td>
													<td>
														<textarea name="object.description[%%SEQNUM1%%].value" id="object_description_%%SEQNUM1%%_value" class="ckeditor_text"></textarea>
<<<<<<< HEAD
																							<script>										
														CKEDITOR.replace('object_description_%%SEQNUM1%%_value',{ toolbar: 'Basic'}); 
										
										</script>	
														</td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																							<script>
														CKEDITOR.replace('object_description_%%SEQNUM1%%_value',{ toolbar: 'Basic'});

										</script>
														</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_description_%%SEQNUM1%%_value"></div></td>
													<td>
														<input type="button" class="buttonSmall" name="btn_description_%%SEQNUM1%%_remove" value="Remove this Description" onClick="decCount('object.description'); $('#table_description_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
														<input type="hidden" name="object.description[%%SEQNUM1%%].lang" id="object_description_%%SEQNUM1%%_lang" maxlength="64" />
													</td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label class="mandatory" for="object.description_%%SEQNUM1%%.type">Type:</label></td>
													<td style="font-size:0.9em;">
														<input type="text" name="object.description[%%SEQNUM1%%].type" id="object_description_%%SEQNUM1%%_type" size="37" maxlength="512" />
														<img id="button_description_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_description_%%SEQNUM1%%_type"></div></td>
													<td width="100%"></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

											</tbody>
=======
												
											</tbody> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

											</tbody>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										</table>

										<script>
<<<<<<< HEAD
<<<<<<< HEAD

											addVocabComplete('object_description_%%SEQNUM1%%_type','RIFCSDescriptionType');
										</script>

=======
										
											addVocabComplete('object_description_%%SEQNUM1%%_type','RIFCSDescriptionType');
										</script>
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

											addVocabComplete('object_description_%%SEQNUM1%%_type','RIFCSDescriptionType');
										</script>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

HTMLEND;

$_strings['*_rights'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_rights_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
=======
											<table id="table_rights_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>

													<td style="text-align:left; font-weight:normal; padding-left:8px; padding-top:8px;">
													<b>Rights Statement</b>
													<input type="button" class="buttonSmall" name="btn_rights_%%SEQNUM1%%_remove" value="Remove this Rights" onClick="decCount('object.rights'); $('#table_rights_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

														<table id="table_rights_%%SEQNUM1%%_rightsStatement_1" class="formTable rmdElementContainer">

															<tbody class="formFields andsorange">

<<<<<<< HEAD
=======
													
														<table id="table_rights_%%SEQNUM1%%_rightsStatement_1" class="formTable rmdElementContainer"> 
															
															<tbody class="formFields andsorange"> 
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_rightsStatement_1_value">Value:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_rightStatement');">
																			<textarea name="object.rights[%%SEQNUM1%%].rightsStatement[1].value" id="object_rights_%%SEQNUM1%%_rightsStatement_1_value" rows="3" cols="38"></textarea>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_rightsStatement_1_value"></div></td>
																		<td width="100%"></td>
																	</tr>

																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_rightsStatement_1_rightsUri">Rights URI:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_rightStatement_rightsUri');">
																			<input class="validUri" type="text" value="" name="object.rights[%%SEQNUM1%%].rightsStatement[1].rightsUri" id="object_rights_%%SEQNUM1%%_rightsStatement_1_rightsUri" maxlength="512" size="37" onChange="testAnyURI('object_rights_%%SEQNUM1%%_rightsStatement_1_rightsUri');"/>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_rightsStatement_1_rightsUri"></div></td>
																		<td width="100%"></td>
																	</tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f



															</tbody>

														</table>

													</td>

<<<<<<< HEAD
=======
																	
																
				
															</tbody> 
				
														</table> 
													
													</td>
													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												</tr>

												<tr>

													<td style="text-align:left; font-weight:normal; padding-left:8px; padding-top:8px;">
													<b>Licence</b>

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_rights_%%SEQNUM1%%_licence_1" class="formTable rmdElementContainer">

															<tbody class="formFields andsorange">
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_licence_1_type">Type:</label></td>
																		<td style="font-size:0.9em;">
																		<input type="text" name="object.rights[%%SEQNUM1%%].licence[1].type" id="object_rights_%%SEQNUM1%%_licence_1_type" size="37" maxlength="512"/>
																		<img id="button_rights_%%SEQNUM1%%_licence_1_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
																	</td>
																	<td></td>
																	<td width="100%"></td>
																	</tr>
																	<script>
																				addVocabComplete('object_rights_%%SEQNUM1%%_licence_1_type','RIFCSLicenceType');
																	</script>
<<<<<<< HEAD
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_licence_1_value">Value:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_licence');">
																			<textarea name="object.rights[%%SEQNUM1%%].licence[1].value" id="object_rights_%%SEQNUM1%%_licence_1_value" rows="3" cols="38" onclick="checkTypeValue('object_rights_%%SEQNUM1%%_licence_1_type');"></textarea>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_licence_1_value"></div><div  name="errors_rights_%%SEQNUM1%%_licence_1_type" id="errors_rights_%%SEQNUM1%%_licence_1_type"></div></td>
																		<td width="100%"></td>
																	</tr>


=======
														<table id="table_rights_%%SEQNUM1%%_licence_1" class="formTable rmdElementContainer"> 
															
															<tbody class="formFields andsorange"> 
														
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_licence_1_value">Value:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_licence');">
																			<textarea name="object.rights[%%SEQNUM1%%].licence[1].value" id="object_rights_%%SEQNUM1%%_licence_1_value" rows="3" cols="38" onclick="checkTypeValue('object_rights_%%SEQNUM1%%_licence_1_type');"></textarea>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_licence_1_value"></div><div  name="errors_rights_%%SEQNUM1%%_licence_1_type" id="errors_rights_%%SEQNUM1%%_licence_1_type"></div></td>
																		<td width="100%"></td>
																	</tr>

<<<<<<< HEAD
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_licence_1_rightsUri">Rights URI:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_licence_rightsUri');">
																			<input class="validUri" type="text" value="" name="object.rights[%%SEQNUM1%%].licence[1].rightsUri" id="object_rights_%%SEQNUM1%%_licence_1_rightsUri" maxlength="512" size="37" onChange="testAnyURI('object_rights_%%SEQNUM1%%_licence_1_rightsUri');"/>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_licence_1_rightsUri"></div></td>
																		<td width="100%"></td>
																	</tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

															</tbody>

														</table>

<<<<<<< HEAD
													</td>

=======
				
															</tbody> 
				
														</table> 
													
													</td>
													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													</td>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												</tr>

												<tr>

													<td style="text-align:left; font-weight:normal; padding-left:8px; padding-top:8px;">
													<b>Access Rights</b>

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_rights_%%SEQNUM1%%_accessRights_1" class="formTable rmdElementContainer">

															<tbody class="formFields andsorange">

<<<<<<< HEAD
=======
														<table id="table_rights_%%SEQNUM1%%_accessRights_1" class="formTable rmdElementContainer"> 
															
															<tbody class="formFields andsorange"> 
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_accessRights_1_value">Value:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_accessrights');">
																			<textarea name="object.rights[%%SEQNUM1%%].accessRights[1].value" id="object_rights_%%SEQNUM1%%_accessRights_1_value" rows="3" cols="38"></textarea>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_accessRights_1_value"></div></td>
																		<td width="100%"></td>
																	</tr>

																	<tr>
																		<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_rights_%%SEQNUM1%%_accessRights_1_rightsUri">Rights URI:</label></td>
																		<td style="font-size:0.9em;" onclick="getHelpText('collection_rights_accessRights_rightsUri');">
																			<input class="validUri" type="text" value="" name="object.rights[%%SEQNUM1%%].accessRights[1].rightsUri" id="object_rights_%%SEQNUM1%%_accessRights_1_rightsUri" maxlength="512" size="37" onChange="testAnyURI('object_rights_%%SEQNUM1%%_accessRights_1_rightsUri');"/>
																		</td>
																		<td><div class="fieldError" name="errors_rights_%%SEQNUM1%%_accessRights_1_rightsUri"></div></td>
																		<td width="100%"></td>
																	</tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

															</tbody>

														</table>

<<<<<<< HEAD
													</td>

												</tr>


											</tbody>
=======
				
															</tbody> 
				
														</table> 
													
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>

												</tr>
<<<<<<< HEAD
												
												
											</tbody> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


											</tbody>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										</table>

HTMLEND;


$_strings['*_subject'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_subject_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">


<<<<<<< HEAD
												<tr>
													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label class="mandatory" for="object_subject_%%SEQNUM1%%_value">Value:</label></td>
													<td onclick="getHelpText('collection_subject_value');" width="310px">
														<input type="text" value="" name="object.subject[%%SEQNUM1%%].value" id="object_subject_%%SEQNUM1%%_value" maxlength="512" size="36" />
														<img id="button_subject_%%SEQNUM1%%_value" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
														<input type="hidden" name="object.subject[%%SEQNUM1%%].lang" id="object_subject_%%SEQNUM1%%_lang" />
													</td>
=======
											<table id="table_subject_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																												
																											
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label class="mandatory" for="object_subject_%%SEQNUM1%%_value">Value:</label></td>
													<td onclick="getHelpText('collection_subject_value');" width="310px">
														<input type="text" value="" name="object.subject[%%SEQNUM1%%].value" id="object_subject_%%SEQNUM1%%_value" maxlength="512" size="36" />
														<img id="button_subject_%%SEQNUM1%%_value" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
														<input type="hidden" name="object.subject[%%SEQNUM1%%].lang" id="object_subject_%%SEQNUM1%%_lang" />
<<<<<<< HEAD
													</td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_subject_%%SEQNUM1%%_value"></div></td>
													<td>
														<input type="button" class="buttonSmall" name="btn_subject_%%SEQNUM1%%_remove" value="Remove this Subject" onClick="decCount('object.subject');$('#table_subject_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
													</td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td width="39px" style="font-weight:normal; padding-left:8px; padding-top:8px;"><label class="mandatory" for="object_subject_%%SEQNUM1%%_type">Type:</label></td>
													<td style="font-size:0.9em;" onclick="getHelpText('collection_subject_type');">
														<input type="text" value="" name="object.subject[%%SEQNUM1%%].type" id="object_subject_%%SEQNUM1%%_type" maxlength="512" size="37" />
														<img id="button_subject_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_subject_%%SEQNUM1%%_type"></div></td>
													<td width="100%"></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label for="object_subject_%%SEQNUM1%%_termIdentifier">Term Identifier:</label></td>
													<td onclick="getHelpText('collection_subject_termIdentifier');" width="310px">
														<input type="text" value="" name="object.subject[%%SEQNUM1%%].termIdentifier" id="object_subject_%%SEQNUM1%%_termIdentifier" maxlength="512" size="36" />
													</td>
													<td><div class="fieldError" name="errors_subject_%%SEQNUM1%%_termIdentifier"></div></td>
													<td width="100%"></td>
												</tr>

											</tbody>

										</table>

=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;">
													<label for="object_subject_%%SEQNUM1%%_termIdentifier">Term Identifier:</label></td>
													<td onclick="getHelpText('collection_subject_termIdentifier');" width="310px">
														<input type="text" value="" name="object.subject[%%SEQNUM1%%].termIdentifier" id="object_subject_%%SEQNUM1%%_termIdentifier" maxlength="512" size="36" />
													</td>
													<td><div class="fieldError" name="errors_subject_%%SEQNUM1%%_termIdentifier"></div></td>
													<td width="100%"></td>
												</tr>

<<<<<<< HEAD
										</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											</tbody>

										</table>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script>
											addVocabComplete('object_subject_%%SEQNUM1%%_type','RIFCSSubjectType');
											addSubjectVocabComplete('object_subject_%%SEQNUM1%%_value');
										</script>
HTMLEND;


/* Old RIFCS 1.0 Location Type
 * 												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label for="object.location[%%SEQNUM1%%].type">Type:</label></td>
													<td onclick="getHelpText('collection_location_type');" style="vertical-align:middle;">
														<input type="text" name="object.location[%%SEQNUM1%%].type" id="object_location_%%SEQNUM1%%_type" size="37" />
														<img id="button_location_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_type" style="font-size:1.05em;"></div></td>
													<td align="right">
<<<<<<< HEAD
<<<<<<< HEAD

														<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_removelocation" value="Remove this Location" onClick="$('#table_location_%%SEQNUM1%%').remove();" style="float:right;" /><br/>

													</td>
												</tr>

 */
$_strings['*_location'] = <<<HTMLEND
											<table id="table_location_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal;">

														<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

														{$dateFormatInfoString}

														</span></span>&nbsp;&nbsp;

														<label for="object_location_%%SEQNUM1%%_dateFrom">Date From:</label>

=======
													
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_removelocation" value="Remove this Location" onClick="$('#table_location_%%SEQNUM1%%').remove();" style="float:right;" /><br/>

													</td>
												</tr>

 */
$_strings['*_location'] = <<<HTMLEND
											<table id="table_location_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal;">

														<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

														{$dateFormatInfoString}

														</span></span>&nbsp;&nbsp;

														<label for="object_location_%%SEQNUM1%%_dateFrom">Date From:</label>
<<<<<<< HEAD
													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
													<td onclick="getHelpText('collection_location_date_from');" style="vertical-align:middle;">
														<input type="text" value="" id="object_location_%%SEQNUM1%%_dateFrom" name="object.location[%%SEQNUM1%%].dateFrom" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="60" style="width:230px;" /> &nbsp;<span id="location_%%SEQNUM1%%_date_from_dctImage">&nbsp;</span>
													</td>
													<td><div class="fieldError" id="errors_location_%%SEQNUM1%%_dateFrom" name="errors_location_%%SEQNUM1%%_dateFrom"></div></td>
													<td>
														<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_remove" value="Remove this Location" onClick="decCount('object.location');$('#table_location_%%SEQNUM1%%').remove();" style="float:right;" />
													</td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal;">
														<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

														{$dateFormatInfoString}

														</span></span>&nbsp;&nbsp;
=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal;">
														<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

														{$dateFormatInfoString}

<<<<<<< HEAD
														</span></span>&nbsp;&nbsp; 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
														</span></span>&nbsp;&nbsp;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<label for="object_location_%%SEQNUM1%%_dateTo">Date To:</label>
													</td>
													<td onclick="getHelpText('collection_location_dateTo');" style="vertical-align:middle;">
														<input type="text" value="" id="object_location_%%SEQNUM1%%_dateTo" name="object.location[%%SEQNUM1%%].dateTo" onchange="checkDTF(this.id);"  class="dateTimeField" maxlength="32" size="60" style="width:230px;" /> &nbsp;<span id="location_%%SEQNUM1%%_date_to_dctImage">&nbsp;</span>
													</td>
													<td width="100px;" colspan="2"><div class="fieldError" id="errors_location_%%SEQNUM1%%_dateTo" name="errors_location_%%SEQNUM1%%_dateTo"></div></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<div style="padding:4px;">Addresses:</div>
														<div id="object.location_%%SEQNUM1%%_address_container">&nbsp;</div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addaddress" value="Add new Address" onClick="getElement('address', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_address'));" style="float:left; font-size:0.8em;" />
													</td>
												</tr>
=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<div style="padding:4px;">Addresses:</div>
														<div id="object.location_%%SEQNUM1%%_address_container">&nbsp;</div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addaddress" value="Add new Address" onClick="getElement('address', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_address'));" style="float:left; font-size:0.8em;" />
													</td>
<<<<<<< HEAD
												</tr> 											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												</tr>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<div style="padding:4px;">Spatial:</div>
<<<<<<< HEAD
<<<<<<< HEAD
														<div id="object.location_%%SEQNUM1%%_spatial_container">&nbsp;</div>
														<input type="button" name="btn_location_%%SEQNUM1%%_addspatial" value="Add new Spatial Location" onClick="getElement('spatial', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_spatial'));" style="float:left; font-size:0.8em;" />
														&nbsp;&nbsp;<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">Do not describe collection coverage here. Please use the Coverage tab instead.</span></span>
													</td>
												</tr>
											</tbody>
										</table>

=======
														<div id="object.location_%%SEQNUM1%%_spatial_container">&nbsp;</div>			
														<input type="button" name="btn_location_%%SEQNUM1%%_addspatial" value="Add new Spatial Location" onClick="getElement('spatial', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_spatial'));" style="float:left; font-size:0.8em;" />
														&nbsp;&nbsp;<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">Do not describe collection coverage here. Please use the Coverage tab instead.</span></span>
													</td>
												</tr> 																						
											</tbody> 
										</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
														<div id="object.location_%%SEQNUM1%%_spatial_container">&nbsp;</div>
														<input type="button" name="btn_location_%%SEQNUM1%%_addspatial" value="Add new Spatial Location" onClick="getElement('spatial', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_spatial'));" style="float:left; font-size:0.8em;" />
														&nbsp;&nbsp;<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">Do not describe collection coverage here. Please use the Coverage tab instead.</span></span>
													</td>
												</tr>
											</tbody>
										</table>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script type="text/javascript">
											// Initialise the date/time controls (on timeout delay)
											setTimeout('dctGetDateTimeControlSpec("object_location_%%SEQNUM1%%_dateFrom", "YYYY-MM-DDThh:mm:00Z", "location_%%SEQNUM1%%_date_from_dctImage");',250);
											setTimeout('dctGetDateTimeControlSpec("object_location_%%SEQNUM1%%_dateTo", "YYYY-MM-DDThh:mm:00Z", "location_%%SEQNUM1%%_date_to_dctImage");',250);
											// Get parts
											if ({$has_fragment} == false) {
												getElement('address', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_address'));
												//getElement('spatial', [], 'object.location[%%SEQNUM1%%].', null, getNextSeq('location_%%SEQNUM1%%_spatial'));
											}
<<<<<<< HEAD
<<<<<<< HEAD

											//addVocabComplete('object_location_%%SEQNUM1%%_type','RIFCSLocationType');

										</script>

=======
																					
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											//addVocabComplete('object_location_%%SEQNUM1%%_type','RIFCSLocationType');

										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;


$_strings['*_location_address'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsorange">

<<<<<<< HEAD
												<tr style="display:none;" id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row">
													<td style="text-align:left;width:100%;">
														<div style="padding:4px;">Electronic:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_container"></div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic" value="Add Electronic Address (e.g. email/URL)" onClick="getElement('electronic', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic'));" style="float:left; display:none;" />
													</td>
												</tr>

												<tr style="display:none;" id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row">
													<td style="text-align:left;width:100%;">
														<div style="padding:4px;">Physical:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_container"></div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical" value="Add Physical Address (e.g.  phone number/street/postal)" onClick="getElement('physical', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical'));" style="float:left; display:none;" />
													</td>
												</tr>

=======
										<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsorange"> 
										
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr style="display:none;" id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row">
													<td style="text-align:left;width:100%;">
														<div style="padding:4px;">Electronic:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_container"></div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic" value="Add Electronic Address (e.g. email/URL)" onClick="getElement('electronic', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic'));" style="float:left; display:none;" />
													</td>
												</tr>

												<tr style="display:none;" id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row">
													<td style="text-align:left;width:100%;">
														<div style="padding:4px;">Physical:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_container"></div>
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical" value="Add Physical Address (e.g.  phone number/street/postal)" onClick="getElement('physical', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical'));" style="float:left; display:none;" />
													</td>
<<<<<<< HEAD
												</tr> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_choice_row">
													<td style="text-align:left;width:100%;">
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic_temp" value="Add Electronic Address (e.g. email/URL)" onClick="getElement('electronic', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic'));$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row').show();" style="float:left;" />
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical_temp" value="Add Physical Address (e.g. phone number/street/postal)" onClick="getElement('physical', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical'));$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row').show();" style="float:left;" />
														<input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_removeaddress" value="Remove this Address" onClick="decCount('object.location[%%SEQNUM1%%].address'); $('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%').remove();" style="float:right;" />
													</td>
<<<<<<< HEAD
<<<<<<< HEAD
												</tr>


											</tbody>

										</table>

=======
												</tr> 
												
=======
												</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

											</tbody>

										</table>

<<<<<<< HEAD
										</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script type="text/javascript">
											// Hide the remove button on first element
											//if (%%SEQNUM2%% == 1) {
											//	getElementByName('btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_removeaddress').style.display = "none";
											//}
<<<<<<< HEAD
<<<<<<< HEAD

											// Get parts
											if ({$has_fragment} == false) {

=======
											
											// Get parts
											if ({$has_fragment} == false) {
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

											// Get parts
											if ({$has_fragment} == false) {

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											} else {
												$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row').show();
												$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row').show();
											}
<<<<<<< HEAD
<<<<<<< HEAD

										</script>

=======
											
										</script>
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

										</script>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;

$_strings['*_location_address_electronic'] = <<<HTMLEND
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgrey" style="font-size:1.2em;">

<<<<<<< HEAD

												<tr>
													<td style="text-align:right; vertical-align:middle;font-weight:normal;"  width="15px"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">

															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />

=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgrey" style="font-size:1.2em;"> 
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												<tr>
													<td style="text-align:right; vertical-align:middle;font-weight:normal;"  width="15px"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">
<<<<<<< HEAD
																	
															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />	
																	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" style="font-size:1.05em;"></div></td>
													<td width="100%"><input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_removeelectronic" value="Remove this Electronic Address" onClick="$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%').remove();" style="float:right; font-size:0.8em;" /></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:15px;"><label for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_type');" style="vertical-align:middle;">
														<input onChange="testAnyURI('button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value');" type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" size="37" maxlength="512" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" style="font-size:1.05em;"></div></td>
													<td></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD


												<tr>
													<td style="text-align:left;width:100%;" colspan="4">
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_container"></div>
													</td>
												</tr>


											</tbody>

										</table>

										<input type="hidden" name="location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count" value="1" />

=======
												
												
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:left;width:100%;" colspan="4">
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_container"></div>
													</td>
												</tr>


											</tbody>

										</table>

										<input type="hidden" name="location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count" value="1" />
<<<<<<< HEAD
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script type="text/javascript">
											// Hide the remove button on first element
											//if (%%SEQNUM3%% == 1) {
											//	getElementByName('btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_removeelectronic').style.display = "none";
											//}
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Get parts
											if ({$has_fragment} == false) {
												getElement('arg', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg'));

											}
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type','RIFCSElectronicAddressType');
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Enable appropriate buttons, disable initial selection bar
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic"]').show();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic_temp"]').hide();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical"]').show();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical_temp"]').hide();
											$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row').show();
											$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row').show();
<<<<<<< HEAD
<<<<<<< HEAD

											// Get sub-elements
											//getRemoteElement("#location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arguments_container", "locations_address_electronic_argument_table", '%%SEQNUM1%%:%%SEQNUM2%%:%%SEQNUM3%%:' + getValByName('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count'));
										</script>

=======
											
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Get sub-elements
											//getRemoteElement("#location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arguments_container", "locations_address_electronic_argument_table", '%%SEQNUM1%%:%%SEQNUM2%%:%%SEQNUM3%%:' + getValByName('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count'));
										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;

$_strings['service_location_address_electronic'] = <<<HTMLEND
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgrey" style="font-size:1.2em;">

<<<<<<< HEAD
												<tr>
													<td style="text-align:right; vertical-align:middle;font-weight:normal;"  width="15px"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">

															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />

=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgrey" style="font-size:1.2em;"> 
												
												<tr>
													<td style="text-align:right; vertical-align:middle;font-weight:normal;"  width="15px"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">
																	
															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />	
																	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												<tr>
													<td style="text-align:right; vertical-align:middle;font-weight:normal;"  width="15px"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">

															<input class="validUri" type="text" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" onChange="testAnyURI(this.id);" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].value[1].value" maxlength="512" size="60" style="width:240px;" />

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value" style="font-size:1.05em;"></div></td>
													<td width="100%"><input type="button" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_removeelectronic" value="Remove this Electronic Address" onClick="$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%').remove();" style="float:right; font-size:0.8em;" /></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:15px;"><label for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_type');" style="vertical-align:middle;">
														<input onChange="testAnyURI('button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_value_1_value');" type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" maxlength="512" size="37" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type" style="font-size:1.05em;"></div></td>
													<td></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td style="text-align:left;width:100%;" colspan="4">
														<div style="padding:4px;">Arguments:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_container">&nbsp;</div>
														<input type="button" class="button" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_newarg" value="Add Electronic Argument" onClick="getElement('arg', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg'));$(this.id).attr('value','Add new Electronic Argument');" style="float:left;" />
													</td>
												</tr>


											</tbody>

										</table>

										<input type="hidden" name="location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count" value="1" />

=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:left;width:100%;" colspan="4">
														<div style="padding:4px;">Arguments:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_container">&nbsp;</div>
														<input type="button" class="button" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_newarg" value="Add Electronic Argument" onClick="getElement('arg', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg'));$(this.id).attr('value','Add new Electronic Argument');" style="float:left;" />
													</td>
												</tr>


											</tbody>

										</table>

										<input type="hidden" name="location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count" value="1" />
<<<<<<< HEAD
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script type="text/javascript">
											// Hide the remove button on first element
											//if (%%SEQNUM3%% == 1) {
											//	getElementByName('btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_removeelectronic').style.display = "none";
											//}
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Get parts
											if ({$has_fragment} == false) {
												getElement('arg', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg'));

											}
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_type','RIFCSElectronicAddressType');
<<<<<<< HEAD
<<<<<<< HEAD

											// Get sub-elements
											//getRemoteElement("#location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arguments_container", "locations_address_electronic_argument_table", '%%SEQNUM1%%:%%SEQNUM2%%:%%SEQNUM3%%:' + getValByName('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count'));
										</script>

=======
											
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Get sub-elements
											//getRemoteElement("#location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arguments_container", "locations_address_electronic_argument_table", '%%SEQNUM1%%:%%SEQNUM2%%:%%SEQNUM3%%:' + getValByName('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_count'));
										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;

$_strings['service_location_address_electronic_arg'] = <<<HTMLEND
<<<<<<< HEAD
<<<<<<< HEAD
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%" class="formTable rmdElementContainer">

											<tbody class="formFields andswhite" style="font-size:1.4em;">
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andswhite" style="font-size:1.4em;"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%" class="formTable rmdElementContainer">

											<tbody class="formFields andswhite" style="font-size:1.4em;">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_name');" style="vertical-align:middle; width:270px;">
<<<<<<< HEAD
<<<<<<< HEAD

														<input type="text" value="" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].value" maxlength="512" size="60" style="width:240px;" />


													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" style="font-size:1.05em;"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].required">Required:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_required');" style="vertical-align:middle;">
														<select name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].required" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required">
															<option></option>
															<option>true</option>
															<option>false</option>
														</select>
													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_type');" style="vertical-align:middle;">

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" size="37" maxlength="512" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" style="font-size:1.05em;"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use">Use:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_use');" style="vertical-align:middle;">

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].use" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" maxlength="512" size="37" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

													</td>

													<td style="text-align:left;">
														<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_removearg" value="Remove this Argument" onClick="decCount('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg');  if (getCount('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg') == 0) { $('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_newarg').show(); } $('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%').remove();" style="float:right;" />

=======
														
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<input type="text" value="" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].value" maxlength="512" size="60" style="width:240px;" />


													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" style="font-size:1.05em;"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].required">Required:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_required');" style="vertical-align:middle;">
														<select name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].required" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required">
															<option></option>
															<option>true</option>
															<option>false</option>
														</select>
													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_type');" style="vertical-align:middle;">

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" size="37" maxlength="512" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" style="font-size:1.05em;"></div></td>
												</tr>

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use">Use:</label></td>
													<td onclick="getHelpText('collection_location_electronic_argument_use');" style="vertical-align:middle;">

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].use" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" maxlength="512" size="37" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

													</td>

													<td style="text-align:left;">
														<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_removearg" value="Remove this Argument" onClick="decCount('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg');  if (getCount('location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg') == 0) { $('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_newarg').show(); } $('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%').remove();" style="float:right;" />
<<<<<<< HEAD
												 	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
												</tr>
												<tr>
													<td colspan="2">&nbsp;</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" style="font-size:1.05em;"></div></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD
											</tbody>

										</table>
=======
											</tbody> 

										</table> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											</tbody>

										</table>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										<script type="text/javascript">
											// Hide the remove button on first element
											//if (%%SEQNUM4%% == 1) {
											//	getElementByName('btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_argument_%%SEQNUM4%%_removeargument').style.display = "none";
											//}
<<<<<<< HEAD
<<<<<<< HEAD

											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type','RIFCSArgType');
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use','RIFCSArgUse');

										</script>

=======
											
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type','RIFCSArgType');
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use','RIFCSArgUse');

										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;


$_strings['*_location_address_electronic_arg'] = <<<HTMLEND

											<input type="hidden" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].required" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required" />
											<input type="hidden" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" />
											<input type="hidden" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].value" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" />
											<input type="hidden" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].electronic[%%SEQNUM3%%].arg[%%SEQNUM4%%].use" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" />
<<<<<<< HEAD
<<<<<<< HEAD


=======
											
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_required" style="font-size:1.05em;"></div>
											<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_type" style="font-size:1.05em;"></div>
											<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_value" style="font-size:1.05em;"></div>
											<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_%%SEQNUM3%%_arg_%%SEQNUM4%%_use" style="font-size:1.05em;"></div>
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['*_location_address_physical'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgrey" style="font-size:1.2em;">
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgrey" style="font-size:1.2em;"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgrey" style="font-size:1.2em;">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:15px;"><label for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_address_physical_type');" style="vertical-align:middle;">
<<<<<<< HEAD
<<<<<<< HEAD

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" maxlength="512" size="37" />
														<input type="hidden" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_lang" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].lang" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

=======
														
														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" maxlength="512" size="37" />
														<input type="hidden" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_lang" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].lang" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" maxlength="512" size="37" />
														<input type="hidden" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_lang" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].lang" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
													<td width="100px;"><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type" style="font-size:1.05em;"></div></td>
													<td width="100%" colspan="2"><input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_removephysical" value="Remove this Physical Address" onClick="decCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical'); $('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%').remove();" style="float:right;" /></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td style="text-align:left;width:100%;" colspan="5">
														<div style="padding:4px;"><label class="mandatory"/>Address Parts:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_container"></div>
														<input type="button" class="button" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_newaddressPart" value="Add Address Part" style="float:left;" />
													</td>
													<td>
														<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%" style="font-size:1.05em;"></div>
													</td>
												</tr>



											</tbody>

										</table>

=======
												
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td style="text-align:left;width:100%;" colspan="5">
														<div style="padding:4px;"><label class="mandatory"/>Address Parts:</div>
														<div id="object.location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_container"></div>
														<input type="button" class="button" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_newaddressPart" value="Add Address Part" style="float:left;" />
													</td>
													<td>
														<div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%" style="font-size:1.05em;"></div>
													</td>
												</tr>


<<<<<<< HEAD
										</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

											</tbody>

										</table>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										<script type="text/javascript">
											//
											// Click Callbacks
											//
											// New Address Part button
											$('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_newaddressPart').click(function() {
<<<<<<< HEAD
<<<<<<< HEAD
												getElement('addressPart', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart'));
												$('#' + this.id).attr("value", "Add new Address Part");
											});

=======
												getElement('addressPart', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart')); 
												$('#' + this.id).attr("value", "Add new Address Part");
											});
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												getElement('addressPart', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart'));
												$('#' + this.id).attr("value", "Add new Address Part");
											});

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											//
											// Visual Initialisation
											//
											// Add autocomplete(s)
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_type','RIFCSPhysicalAddressType');
											// Get parts
											if ({$has_fragment} == false) {
												getElement('addressPart', [], 'object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].', null, getNextSeq('location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart'));
												//$('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_newaddressPart').hide();
											}
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											// Enable appropriate buttons, disable initial selection bar
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical"]').show();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addphysical_temp"]').hide();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic"]').show();
											$('[name="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_addelectronic_temp"]').hide();
											$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_row').show();
											$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_electronic_row').show();
										</script>
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;


$_strings['*_location_address_physical_addressPart'] = <<<HTMLEND
<<<<<<< HEAD
<<<<<<< HEAD
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%" class="formTable rmdElementContainer">

											<tbody class="formFields andswhite" style="font-size:1.4em;">
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andswhite" style="font-size:1.4em;"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											<table id="table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%" class="formTable rmdElementContainer">

											<tbody class="formFields andswhite" style="font-size:1.4em;">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart[%%SEQNUM4%%].value">Value:</label></td>
													<td onclick="getHelpText('collection_location_physical_address_part_type');" style="vertical-align:middle; width:270px;">
<<<<<<< HEAD
<<<<<<< HEAD

=======
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

														<textarea id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_value" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart[%%SEQNUM4%%].value"  onChange="testAnyURI(this.id);" class="ckeditor_text"></textarea>

														<script>CKEDITOR.replace('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_value',{ toolbar: 'Basic'}); </script>
													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_value" style="font-size:1.05em;"></div></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_address_physical_addressPart_type');" style="vertical-align:middle;">

=======
												
												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_address_physical_addressPart_type');" style="vertical-align:middle;">
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

												<tr>
													<td style="text-align:right; vertical-align:middle; font-weight:normal; width:20px;"><label class="mandatory" for="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_location_address_physical_addressPart_type');" style="vertical-align:middle;">

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<input type="text" name="object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart[%%SEQNUM4%%].type" id="object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type" maxlength="512" size="37" />
														<img id="button_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />

													</td>
													<td><div class="fieldError" name="errors_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type" style="font-size:1.05em;"></div></td>
												</tr>
<<<<<<< HEAD
<<<<<<< HEAD


												<tr>
													<td colspan="2">
														&nbsp;
													</td>
													<td style="text-align:left;">
														<input type="button" class="buttonSmall" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_removeaddressPart" value="Remove this Address Part" style="float:right;" />

													</td>
												</tr>

											</tbody>

										</table>

										<script type="text/javascript">
											$('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_removeaddressPart').click(function() {
												decCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart');
												if (getCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart') == 0)
=======
										
												
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="2">
														&nbsp;
													</td>
													<td style="text-align:left;">
														<input type="button" class="buttonSmall" id="btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_removeaddressPart" value="Remove this Address Part" style="float:right;" />

													</td>
												</tr>

											</tbody>

										</table>

										<script type="text/javascript">
											$('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_removeaddressPart').click(function() {
<<<<<<< HEAD
												decCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart'); 
												if (getCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart') == 0) 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												decCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart');
												if (getCount('object.location[%%SEQNUM1%%].address[%%SEQNUM2%%].physical[%%SEQNUM3%%].addressPart') == 0)
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												{
													$('#btn_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_newaddressPart').show();
												}
												$('#table_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%').remove();
											});
<<<<<<< HEAD
<<<<<<< HEAD

=======
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

											//
											// Visual Initialisation
											//
											// Add autocomplete(s)
											addVocabComplete('object_location_%%SEQNUM1%%_address_%%SEQNUM2%%_physical_%%SEQNUM3%%_addressPart_%%SEQNUM4%%_type', 'RIFCSPhysicalAddressPartType');
										</script>
<<<<<<< HEAD
<<<<<<< HEAD

=======
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;



$_strings['*_location_spatial'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange" style="font-weight:normal;">

<<<<<<< HEAD
																<tr id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow">
																	<td height="30px" align="left" style="padding:8px;"><label for="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value">Value:</label></td>
																	<td align="left" style="padding:8px;width:325px;" onclick="getHelpText('collection_location_spatial_value');">
																		<input style="vertical-align:top;" align="left" type="text" value="" name="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value" id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" maxlength="512" size="40" />
																		<a href="javascript:rmd_showMap('object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%');" onclick="$('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type').val('kmlPolyCoords'); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_typerow').hide(); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow').hide(); $('[name=btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial_map]').show(); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_maprow').show(); this.style.display='none';" title="Use Map"><img src="{$eAPP_ROOT}orca/_images/usemap.png" alt="Use Map" /></a>

=======
														<table id="table_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange" style="font-weight:normal;"> 
												
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow">
																	<td height="30px" align="left" style="padding:8px;"><label for="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value">Value:</label></td>
																	<td align="left" style="padding:8px;width:325px;" onclick="getHelpText('collection_location_spatial_value');">
																		<input style="vertical-align:top;" align="left" type="text" value="" name="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value" id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" maxlength="512" size="40" />
																		<a href="javascript:rmd_showMap('object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%');" onclick="$('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type').val('kmlPolyCoords'); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_typerow').hide(); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow').hide(); $('[name=btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial_map]').show(); $('#object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_maprow').show(); this.style.display='none';" title="Use Map"><img src="{$eAPP_ROOT}orca/_images/usemap.png" alt="Use Map" /></a>
<<<<<<< HEAD
																		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	</td>
																	<td align="left">
																		<div class="fieldError" name="errors_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" style="font-size:1.05em;"></div>
																	</td>
																	<td>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial" value="Remove this Spatial Location" onClick="decCount('object.location[%%SEQNUM1%%].spatial'); $('#table_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%').remove();" style="float:right;" />
																	</td>
																</tr>
																<tr id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_typerow">
																<td align="left" style="width:40px;padding:8px;">
																		<label class="mandatory" for="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type">Type:</label>
																	</td>
																	<td align="left" style="padding:8px;" onclick="getHelpText('collection_location_spatial_type');">
																		<input type="text" name="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].type" id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type" maxlength="512" size="37" />
																		<input type="hidden" id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_lang" name="object.location[%%SEQNUM1%%].spatial[%%SEQNUM2%%].lang" maxlength="64" />
																		<img id="button_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
																	</td>
																	<td style="vertical-align:bottom">
																		<div class="fieldError" name="errors_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type" style="font-size:1.05em;"></div>
																	</td>
																	<td></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr id="object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_maprow" style="display:none;">
																	<td colspan="4">
																		<input type="button" class="buttonSmall" name="btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial_map" value="Remove this Spatial Location" onClick="decCount('object.location[%%SEQNUM1%%].spatial'); $('#table_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%').remove();" style="float:right; display:none;" />
																		<div style="width:440px; display:none;" id="container_object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%">
																			<div id="mct_control_object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" class="mct_control" style="width:440px;"></div>
																		</div>
																		<div class="fieldError" name="errors_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" style="font-size:1.05em;"></div>
																	</td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD



															</tbody>

														</table>

														<script type="text/javascript">
															//if (%%SEQNUM2%% == 1) {
															//	getElementByName('btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial').style.display = "none";
															//}
															addVocabComplete('object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');
=======
																
															
															
=======



>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															</tbody>

														</table>

														<script type="text/javascript">
															//if (%%SEQNUM2%% == 1) {
															//	getElementByName('btn_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial').style.display = "none";
<<<<<<< HEAD
															//}			
															addVocabComplete('object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
															//}
															addVocabComplete('object_location_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</script>

HTMLEND;


$_strings['*_coverage'] = <<<HTMLEND
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_coverage_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<input type="button" class="button" name="btn_coverage_%%SEQNUM1%%_removecoverage" value="Remove this Coverage" onClick="decCount('object.coverage'); $('#table_coverage_%%SEQNUM1%%').remove();" style="float:right;" />
														<div style="padding:4px;">Temporal:</div>
														<div id="object.coverage_%%SEQNUM1%%_temporal_container">&nbsp;</div>
														<input type="button" name="btn_coverage_%%SEQNUM1%%_addtemporal" value="Add new Temporal Coverage" onClick="getElement('temporal', [], 'object.coverage[%%SEQNUM1%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal'));" style="float:left; font-size:0.8em;" />
													</td>
												</tr>

												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<div style="padding:4px;">Spatial:</div>
														<div id="object.coverage_%%SEQNUM1%%_spatial_container">&nbsp;</div>
														<input type="button" name="btn_coverage_%%SEQNUM1%%_addspatial" value="Add new Spatial Coverage" onClick="getElement('spatial', [], 'object.coverage[%%SEQNUM1%%].', null, getNextSeq('coverage_%%SEQNUM1%%_spatial'));" style="float:left; font-size:0.8em;" />
													</td>
												</tr>

											</tbody>

										</table>

										<script type="text/javascript">
										</script>

=======
											<table id="table_coverage_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																							
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<input type="button" class="button" name="btn_coverage_%%SEQNUM1%%_removecoverage" value="Remove this Coverage" onClick="decCount('object.coverage'); $('#table_coverage_%%SEQNUM1%%').remove();" style="float:right;" />
														<div style="padding:4px;">Temporal:</div>
														<div id="object.coverage_%%SEQNUM1%%_temporal_container">&nbsp;</div>
														<input type="button" name="btn_coverage_%%SEQNUM1%%_addtemporal" value="Add new Temporal Coverage" onClick="getElement('temporal', [], 'object.coverage[%%SEQNUM1%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal'));" style="float:left; font-size:0.8em;" />
													</td>
												</tr>

												<tr>
													<td colspan="4" style="text-align:left;width:100%;">
														<div style="padding:4px;">Spatial:</div>
														<div id="object.coverage_%%SEQNUM1%%_spatial_container">&nbsp;</div>
														<input type="button" name="btn_coverage_%%SEQNUM1%%_addspatial" value="Add new Spatial Coverage" onClick="getElement('spatial', [], 'object.coverage[%%SEQNUM1%%].', null, getNextSeq('coverage_%%SEQNUM1%%_spatial'));" style="float:left; font-size:0.8em;" />
													</td>
												</tr>

											</tbody>

										</table>

										<script type="text/javascript">
										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


HTMLEND;


$_strings['*_coverage_spatial'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange" style="font-weight:normal;">

<<<<<<< HEAD
=======
														<table id="table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange" style="font-weight:normal;"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr id="table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow">
																	<td height="30px" align="left" style="padding:8px;" width="40px"><label for="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value">Value:</label></td>
																	<td align="left" style="padding:8px;width:325px;" onclick="getHelpText('collection_coverage_spatial_value');">
																		<input style="vertical-align:top;" align="left" type="text" value="" name="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].value" id="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" maxlength="512" size="40" />
<<<<<<< HEAD
<<<<<<< HEAD
																		<input type="hidden" name="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].lang" id="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_lang" maxlength="64" />
=======
																		<input type="hidden" name="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].lang" id="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_lang" maxlength="64" /> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																		<input type="hidden" name="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].lang" id="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_lang" maxlength="64" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		<a href="javascript:rmd_showMap('object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%');" onclick="$('#object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type').val('kmlPolyCoords');  $('#object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type').attr('readonly','readonly'); $('#button_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type').hide(); this.style.display='none'; $('[name=btn_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial_temp]').show(); $('#table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_typerow').hide(); $('#table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_valuerow').hide(); $('#table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_maprow').show();" title="Use Map"><img src="{$eAPP_ROOT}orca/_images/usemap.png" alt="Use Map" /></a>
																	</td>
																	<td align="left">
																		<div class="fieldError" name="errors_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" style="font-size:1.05em;"></div>
																	</td>
																	<td><input type="button" class="buttonSmall" name="btn_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial" value="Remove this Spatial Coverage" onClick="decCount('object.coverage[%%SEQNUM1%%].spatial'); $('#table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%').remove();" style="float:right;" /></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD


=======
																
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr id="table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_typerow">
																	<td align="left" style="width:40px;padding:8px;">
																		<label class="mandatory" for="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type">Type:</label>
																	</td>
																	<td align="left" style="padding:8px;" onclick="getHelpText('collection_coverage_spatial_type');">
																		<input type="text" name="object.coverage[%%SEQNUM1%%].spatial[%%SEQNUM2%%].type" id="object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type"  maxlength="512" size="37" />
																		<img id="button_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
																	</td>
																	<td>
																		<div class="fieldError" name="errors_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type" style="font-size:1.05em;"></div>
																	</td>
																	<td></td>
<<<<<<< HEAD
<<<<<<< HEAD
																</tr>
=======
																</tr>			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																</tr>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

																<tr id="table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_maprow" style="display:none;">
																	<td colspan="3">
																		<div style="width:440px; display:none;" id="container_object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%">
																			<div id="mct_control_object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" class="mct_control" style="width:440px;"></div>
																		</div>
																		<div class="fieldError" name="errors_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_value" style="font-size:1.05em;"></div>
																	</td>
																	<td width="100%"><input type="button" class="buttonSmall" name="btn_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_removespatial_temp" value="Remove this Spatial Coverage" onClick="decCount('object.coverage[%%SEQNUM1%%].spatial'); $('#table_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%').remove();" style="float:right; display:none;" /></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

															</tbody>

														</table>

														<script>
															addVocabComplete('object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');
=======
															
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															</tbody>

														</table>

														<script>
<<<<<<< HEAD
															addVocabComplete('object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
															addVocabComplete('object_coverage_%%SEQNUM1%%_spatial_%%SEQNUM2%%_type','RIFCSSpatialType');
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</script>
HTMLEND;

$_strings['*_coverage_temporal'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">

<<<<<<< HEAD
=======
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td colspan="6" style="text-align:left;">
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_removetemporal" value="Remove this Temporal Coverage" onClick="decCount('object.coverage[%%SEQNUM1%%].temporal'); $('#table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%').remove();"  style="float:right;" />
																		<div style="padding:4px;"><b>Date:</b></div>
<<<<<<< HEAD
<<<<<<< HEAD
																		<div id="object.coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_container">&nbsp;</div>
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_adddate" value="Add new Date" onClick="getElement('date', [], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date'));"  />
																	</td>
																</tr>

																<tr>
																	<td colspan="6" style="text-align:left;">
																		<div style="padding:4px;"><b>Text:</b></div>
																		<div id="object.coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_container">&nbsp;</div>
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_addtext" value="Add new Text" onClick="getElement('text', [], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text'));"  />
																	</td>
																</tr>

															</tbody>

														</table>

														<script type="text/javascript">
=======
																		<div id="object.coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_container">&nbsp;</div>			
=======
																		<div id="object.coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_container">&nbsp;</div>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_adddate" value="Add new Date" onClick="getElement('date', [], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date'));"  />
																	</td>
																</tr>

																<tr>
																	<td colspan="6" style="text-align:left;">
																		<div style="padding:4px;"><b>Text:</b></div>
																		<div id="object.coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_container">&nbsp;</div>
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_addtext" value="Add new Text" onClick="getElement('text', [], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text'));"  />
																	</td>
																</tr>

															</tbody>

														</table>
<<<<<<< HEAD
														
														<script type="text/javascript">	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

														<script type="text/javascript">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															if ({$has_fragment} == false) {
																getElement('date', [{id:'#object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[1].type',value:'dateFrom'}], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date'));
																getElement('date', [{id:'#object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[2].type',value:'dateTo'}], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date'));
																getElement('text', [], 'object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].', null, getNextSeq('coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text'));
<<<<<<< HEAD
<<<<<<< HEAD
															}
=======
															}												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
															}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</script>

HTMLEND;


$_strings['*_coverage_temporal_text'] = <<<HTMLEND

<<<<<<< HEAD
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">

																<tr>
																	<td style="text-align:right; vertical-align:middle;"  width="80px"><label for="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">

																		<input type="text" value="" id="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_value" name="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].text[%%SEQNUM3%%].value" maxlength="512" size="60" style="width:240px;" />

																	</td>
																	<td><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text[%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td>
																	<td align="left" style="text-align:left;">
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_removetext" style="float:right;" value="Remove this Text" onClick="decCount('object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].text'); $('#table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%').remove();"  />
																	</td>
																</tr>


															</tbody>

														</table>

														<script type="text/javascript">
														</script>

<<<<<<< HEAD
=======
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsgrey"> 
												
=======
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right; vertical-align:middle;"  width="80px"><label for="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_coverage_temporal_text_value');" width="260px" style="vertical-align:middle;">

																		<input type="text" value="" id="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_value" name="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].text[%%SEQNUM3%%].value" maxlength="512" size="60" style="width:240px;" />

																	</td>
																	<td><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text[%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td>
																	<td align="left" style="text-align:left;">
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%_removetext" style="float:right;" value="Remove this Text" onClick="decCount('object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].text'); $('#table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_text_%%SEQNUM3%%').remove();"  />
																	</td>
																</tr>


															</tbody>

														</table>

														<script type="text/javascript">
														</script>
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

HTMLEND;

$_strings['*_coverage_temporal_date'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">

<<<<<<< HEAD
=======
														<table id="table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsgrey"> 
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right; vertical-align:middle;" width="80px"><label for="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_coverage_temporal_date_value');" width="260px" style="vertical-align:middle;">
																		<input type="text" value="" id="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value" name="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[%%SEQNUM3%%].value" class="dateTimeField" maxlength="512" size="60" style="width:230px;" /> &nbsp;<span id="coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value_dctImage" onClick="$('#object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat').val('W3CDTF');">&nbsp;</span><span class="inputFormat"> YYYY-MM-DDThh:mm:ssZ</span>
																	</td>
																	<td colspan="2"><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right; vertical-align:middle;" width="40px;"><label class="mandatory" for="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[%%SEQNUM3%%].type">Type:</label></td>
																	<td onclick="getHelpText('collection_coverage_temporal_date_type');" width="260px" style="vertical-align:middle;">
																		<input type="text" name="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[%%SEQNUM3%%].type" id="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_type" maxlength="512" size="36" />
																		<img id="button_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
																	</td>
																	<td colspan="2"><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_type" style="font-size:1.05em;"></div></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right; vertical-align:middle;" width="40px;"><label class="mandatory" for="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[%%SEQNUM3%%].dateFormat">Date Format:</label></td>
																	<td onclick="getHelpText('collection_coverage_temporal_date_value');" width="260px" style="vertical-align:middle;">
																		<input type="text" name="object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date[%%SEQNUM3%%].dateFormat" id="object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat"  maxlength="512" size="36" />
<<<<<<< HEAD
<<<<<<< HEAD
																		<img id="button_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
																	</td>
																	<td><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat" style="font-size:1.05em;"></div></td>
																	<td align="left" style="text-align:left;">
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_removedate" style="float:right;" value="Remove this Date" onClick="decCount('object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date'); $('#table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%').remove();"  />
																	</td>
																</tr>


															</tbody>

														</table>

=======
																		<img id="button_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />											
=======
																		<img id="button_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	</td>
																	<td><div class="fieldError" name="errors_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat" style="font-size:1.05em;"></div></td>
																	<td align="left" style="text-align:left;">
																		<input type="button" name="btn_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_removedate" style="float:right;" value="Remove this Date" onClick="decCount('object.coverage[%%SEQNUM1%%].temporal[%%SEQNUM2%%].date'); $('#table_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%').remove();"  />
																	</td>
																</tr>


															</tbody>

														</table>
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<script type="text/javascript">
														  	setTimeout('dctGetDateTimeControlSpec("object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value", "YYYY-MM-DDThh:mm:00Z", "coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_value_dctImage");',250);
														  	addVocabComplete('object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_type','RIFCSTemporalCoverageDateType');
														  	addVocabComplete('object_coverage_%%SEQNUM1%%_temporal_%%SEQNUM2%%_date_%%SEQNUM3%%_dateFormat','RIFCSTemporalCoverageDateFormat');
<<<<<<< HEAD
<<<<<<< HEAD


														</script>

=======
														  	
														  	
														</script>
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


														</script>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

HTMLEND;




$_strings['*_relatedInfo'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_relatedInfo_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
=======
											<table id="table_relatedInfo_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td width="39px" style="font-weight:normal;"><label for="object_relatedInfo_%%SEQNUM1%%_type">Type:</label></td>
													<td onclick="getHelpText('collection_relatedInfo_type');">
														<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].type" id="object_relatedInfo_%%SEQNUM1%%_type" maxlength="64" size="37" /><img id="button_relatedInfo_%%SEQNUM1%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
													</td>
													<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_type"></div></td>
													<td width="100%"><input type="button" class="buttonSmall" name="btn_relatedInfo_%%SEQNUM1%%_remove" value="Remove this Related Info" onClick="decCount('object.relatedInfo'); $('#table_relatedInfo_%%SEQNUM1%%').remove();" style="float:right;" /><br/></td>
												</tr>
												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Identifier:</div>
														<div id="relatedInfo_%%SEQNUM1%%_identifier_container">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

														<table id="table_elatedInfo_%%SEQNUM1%%_identifier" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">


<<<<<<< HEAD
																<tr>
																	<td style="text-align:right;"><label class="mandatory" for="object_relatedInfo_%%SEQNUM1%%_identifier_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_identifier_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].identifier[1].value" id="object_relatedInfo_%%SEQNUM1%%_identifier_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_identifier_1_value"></div></td>
																	<td width="100%"></td>
																</tr>

=======
														
														<table id="table_elatedInfo_%%SEQNUM1%%_identifier" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
												
															
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label class="mandatory" for="object_relatedInfo_%%SEQNUM1%%_identifier_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_identifier_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].identifier[1].value" id="object_relatedInfo_%%SEQNUM1%%_identifier_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_identifier_1_value"></div></td>
																	<td width="100%"></td>
																</tr>
<<<<<<< HEAD
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;" width="40px"><label class="mandatory" for="object_relatedInfo_%%SEQNUM1%%_identifier_1_type">Type:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_identifier_type');" width="260px">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].identifier[1].type" id="object_relatedInfo_%%SEQNUM1%%_identifier_1_type" maxlength="512" size="37" /><img id="button_relatedInfo_%%SEQNUM1%%_identifier_1_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_identifier_1_type"></div></td>
																	<td></td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD


															</tbody>

														</table>


														</div>
													</td>
												</tr>
=======
																
															
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															</tbody>

														</table>


														</div>
													</td>
<<<<<<< HEAD
												</tr> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												</tr>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Title:</div>
														<div id="relatedInfo_%%SEQNUM1%%_title_container">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

														<table id="table_relatedInfo_%%SEQNUM1%%_title" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">
<<<<<<< HEAD

																<tr>

																	<td style="text-align:right;"><label for="object_relatedInfo_%%SEQNUM1%%_title_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_title_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].title[1].value" id="object_relatedInfo_%%SEQNUM1%%_title_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_title_1_value"></div></td>
																	<td width="100%"></td>
																</tr>

															</tbody>

														</table>

														</div>
													</td>
												</tr>
=======
														
														<table id="table_relatedInfo_%%SEQNUM1%%_title" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

																<tr>

																	<td style="text-align:right;"><label for="object_relatedInfo_%%SEQNUM1%%_title_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_title_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].title[1].value" id="object_relatedInfo_%%SEQNUM1%%_title_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_title_1_value"></div></td>
																	<td width="100%"></td>
																</tr>

															</tbody>

														</table>

														</div>
													</td>
<<<<<<< HEAD
												</tr> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
												</tr>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>
													<td colspan="4" style="text-align:left;">
														<div style="padding:4px;">Notes:</div>
														<div id="relatedInfo_%%SEQNUM1%%_notes_container">
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

														<table id="table_relatedInfo_%%SEQNUM1%%_notes" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsorange">
<<<<<<< HEAD

																<tr>

																	<td style="text-align:right;"><label for="object_relatedInfo_%%SEQNUM1%%_notes_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_title_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].notes[1].value" id="object_relatedInfo_%%SEQNUM1%%_notes_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_notes_1_value"></div></td>
																	<td width="100%"></td>
																</tr>

															</tbody>

														</table>


														</div>
													</td>
												</tr>

											</tbody>

										</table>

=======
														
														<table id="table_relatedInfo_%%SEQNUM1%%_notes" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsorange"> 
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

																<tr>

																	<td style="text-align:right;"><label for="object_relatedInfo_%%SEQNUM1%%_notes_1_value">Value:</label></td>
																	<td onclick="getHelpText('collection_relatedInfo_title_value');">
																		<input type="text" value="" name="object.relatedInfo[%%SEQNUM1%%].notes[1].value" id="object_relatedInfo_%%SEQNUM1%%_notes_1_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_relatedInfo_%%SEQNUM1%%_notes_1_value"></div></td>
																	<td width="100%"></td>
																</tr>

															</tbody>

														</table>


														</div>
													</td>
												</tr>

											</tbody>

										</table>

<<<<<<< HEAD
										</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script>
											addVocabComplete('object_relatedInfo_%%SEQNUM1%%_type','RIFCSRelatedInformationType');
											addVocabComplete('object_relatedInfo_%%SEQNUM1%%_identifier_1_type','RIFCSRelatedInformationIdentifierType');
										</script>

HTMLEND;



$_strings['*_citationInfo'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_citationInfo_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
=======
											<table id="table_citationInfo_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr id="citation_%%SEQNUM1%%_choice_row">
													<td>
														<input type="button" id="btn_citationInfo_%%SEQNUM1%%_addfullCitation" value="Add Full Citation" onClick="getElement('fullCitation', [], 'object.citationInfo[%%SEQNUM1%%].', null, 1);$('#citation_%%SEQNUM1%%_fullCitation_row').show();$(this.id).hide();" style="float:left;" />
														<input type="button" id="btn_citationInfo_%%SEQNUM1%%_addcitationMetadata" value="Add Citation Metadata" onClick="getElement('citationMetadata', [], 'object.citationInfo[%%SEQNUM1%%].', null, 1);$('#citation_%%SEQNUM1%%_citationMetadata_row').show();$(this.id).hide();" style="float:left;" />
													</td>
												</tr>
												<tr id="citation_%%SEQNUM1%%_fullCitation_row" style="display:none;">
													<td style="text-align:left;">
														<input type="button" name="btn_citation_info_%%SEQNUM1%%_removecitationInfo" value="Remove this Citation" onClick="decCount('object.citationInfo'); $('#table_citationInfo_%%SEQNUM1%%').remove();" style="float:right;" />
														<div style="padding:4px;">Full Citation:</div>
														<div id="object.citationInfo_%%SEQNUM1%%_fullCitation_container">
<<<<<<< HEAD
<<<<<<< HEAD
														</div>
													</td>
												</tr>
=======
														</div>			
													</td>
												</tr> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
														</div>
													</td>
												</tr>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr id="citation_%%SEQNUM1%%_citationMetadata_row" style="display:none;">
													<td style="text-align:left;">
														<input type="button" name="btn_citation_info_%%SEQNUM1%%_removecitationInfo" value="Remove this Citation" onClick="decCount('object.citationInfo'); $('#table_citationInfo_%%SEQNUM1%%').remove();" style="float:right;" />
														<div style="padding:4px;">Citation Metadata:</div>
<<<<<<< HEAD
<<<<<<< HEAD
														<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_container">
														</div>
													</td>
												</tr>

											</tbody>

										</table>
=======
														<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_container">													
														</div>			
=======
														<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_container">
														</div>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													</td>
												</tr>

											</tbody>

<<<<<<< HEAD
										</table> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
										</table>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['*_citationInfo_fullCitation'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<table id="table_citation_%%SEQNUM1%%_fullCitation" class="rmdElementContainer" style="font-weight:normal;">

				<tbody class="formFields andsorange">

<<<<<<< HEAD
=======
			<table id="table_citation_%%SEQNUM1%%_fullCitation" class="rmdElementContainer" style="font-weight:normal;"> 
															
				<tbody class="formFields andsorange"> 
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					<tr>
						<td style="text-align:right;" width="40px"><label for="object_citationInfo_%%SEQNUM1%%_fullCitation_1_value">Value:</label></td>
						<td onclick="getHelpText('collection_citation_fullCitation');" width="260px">
							<textarea name="object.citationInfo[%%SEQNUM1%%].fullCitation[1].value" id="object_citationInfo_%%SEQNUM1%%_fullCitation_1_value" rows="6" cols="37"></textarea>
						</td>
						<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_fullCitation_1_value" style="font-size:1.05em;"></div></td>
					</tr>
<<<<<<< HEAD
<<<<<<< HEAD

					<tr>

						<td style="text-align:right;"><label for="object_citationInfo_%%SEQNUM1%%_fullCitation_1_style">Style:</label></td>
						<td onclick="getHelpText('collection_citationInfo_fullCitation_style');">
							<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].fullCitation[1].style" id="object_citationInfo_%%SEQNUM1%%_fullCitation_1_style" maxlength="512" size="37" />
							<img id="button_citationInfo_%%SEQNUM1%%_fullCitation_1_style" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
						</td>
						<td colspan="2"><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_fullCitation_1_style" style="font-size:1.05em;"></div></td>

					</tr>

				</tbody>

			</table>

=======
					
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					<tr>

						<td style="text-align:right;"><label for="object_citationInfo_%%SEQNUM1%%_fullCitation_1_style">Style:</label></td>
						<td onclick="getHelpText('collection_citationInfo_fullCitation_style');">
							<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].fullCitation[1].style" id="object_citationInfo_%%SEQNUM1%%_fullCitation_1_style" maxlength="512" size="37" />
							<img id="button_citationInfo_%%SEQNUM1%%_fullCitation_1_style" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
						</td>
						<td colspan="2"><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_fullCitation_1_style" style="font-size:1.05em;"></div></td>

					</tr>

				</tbody>

			</table>
<<<<<<< HEAD
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<script>
				addVocabComplete('object_citationInfo_%%SEQNUM1%%_fullCitation_1_style','RIFCSCitationStyle');
				$('#citation_%%SEQNUM1%%_fullCitation_row').show();
				$('#citation_%%SEQNUM1%%_choice_row').hide();
			</script>
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['*_citationInfo_citationMetadata'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata" class="rmdElementContainer" style="font-weight:normal;">


		<tbody class="formFields andsorange">
<<<<<<< HEAD
=======
	<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata" class="rmdElementContainer" style="font-weight:normal;"> 
		
		
		<tbody class="formFields andsorange"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

			<tr>
				<td align="right"><br/>Identifier:</td>
				<td colspan="2">
					<table>
<<<<<<< HEAD
<<<<<<< HEAD
						<tbody class="formFields andsgrey">

=======
						<tbody class="formFields andsgrey"> 
													
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						<tbody class="formFields andsgrey">

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							<tr>
								<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_value">Value:</label></td>
								<td onclick="getHelpText('');" width="260px">
									<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].identifier[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_value" maxlength="512" size="40" />
								</td>
								<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_value" style="font-size:1.05em;"></div></td>
							</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							<tr>
								<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_type">Type:</label></td>
								<td onclick="getHelpText('');" width="260px">
									<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].identifier[1].type" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_type" maxlength="512" size="35" />
									<img id="button_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
								</td>
								<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_type" style="font-size:1.05em;"></div></td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
			 	<td align="right">
			 		<label class="mandatory"/>Contributors:
			 	</td>
				<td colspan="2">
					<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_container">
					</div>
					<input type="button" class="buttonSmall" name="btn_citation_%%SEQNUM1%%_addcitation_date" value="Add new Contributor" onClick="getElement('contributor', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[1].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor'));"  />
					<div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1" style="font-size:1.05em;"></div>
				</td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
						
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_title_1_value">Title:</label></td>
				<td onclick="getHelpText('collection_citationInfo_citationMetadata_title');" width="260px">
					<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].title[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_title_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_title_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_edition_1_value">Edition:</label></td>
				<td onclick="getHelpText('collection_citationInfo_citationMetadata_edition');" width="260px">
					<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].edition[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_edition_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_edition_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_publisher_1_value">Publisher:</label></td>
				<td onclick="getHelpText('collection_citationInfo_citationMetadata_publisher');" width="260px">
					<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].publisher[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_publisher_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_publisher_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_placePublished_1_value">Place Published:</label></td>
				<td onclick="getHelpText('collection_citationInfo_citationMetadata_placePublished');" width="260px">
					<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].placePublished[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_placePublished_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_placePublished_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
			 	<td align="right">
			 		Dates:
			 	</td>
				<td colspan="2">
					<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_1_date_container">
					</div>
					<input type="button" class="buttonSmall" name="btn_citation_%%SEQNUM1%%_addcitation_date" value="Add new Date" onClick="getElement('date', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[1].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_1_date'));"  />
				</td>
<<<<<<< HEAD
<<<<<<< HEAD

			</tr>

=======
				
			</tr>
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

			</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_url_1_value">URL:</label></td>
				<td onclick="getHelpText('collection_citation_full_citation');" width="260px">
					<input type="text" value="" onChange="testAnyURI(this.id);" class="validUri" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].url[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_url_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_url_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			<tr>
				<td style="text-align:right;" width="40px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_context_1_value">Context:</label></td>
				<td onclick="getHelpText('collection_citation_full_citation');" width="260px">
					<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].context[1].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_context_1_value" maxlength="512" size="40" />
				</td>
				<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_context_1_value" style="font-size:1.05em;"></div></td>
			</tr>
<<<<<<< HEAD
<<<<<<< HEAD

		</tbody>

	</table>

=======
		
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		</tbody>

	</table>
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	<script>
		addVocabComplete('object_citationInfo_%%SEQNUM1%%_citationMetadata_1_identifier_1_type','RIFCSCitationIdentifierType');
		$('#citation_%%SEQNUM1%%_citationMetadata_row').show();
		$('#citation_%%SEQNUM1%%_choice_row').hide();
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if ({$has_fragment} == false) {
			getElement('date', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[1].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_1_date'));
			getElement('contributor', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[1].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor'));
		}
	</script>


HTMLEND;


$_strings['*_citationInfo_citationMetadata_date'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">
																<tr>
																	<td style="text-align:right;"><label for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_citationInfo_citationMetadata_date');">
																		<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].date[%%SEQNUM3%%].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td>
=======
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsgrey"> 
=======
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM2%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value">Value:</label></td>
																	<td onclick="getHelpText('collection_citationInfo_citationMetadata_date');">
																		<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].date[%%SEQNUM3%%].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value" maxlength="512" size="40" />
																	</td>
<<<<<<< HEAD
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_value" style="font-size:1.05em;"></div></td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<td rowspan="2" align="right">
																		<input type="button" class="buttonSmall" name="btn_citation_%%SEQNUM1%%_date_%%SEQNUM2%%_removecitation_date" value="Remove this Date" onClick="decCount('object.citationInfo[%%SEQNUM1%%].citationMetadata[1].date'); $('#table_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM2%%').remove();"  /><br/>
																	</td>
																</tr>
																<tr>
																	<td style="text-align:right;" width="30px"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type">Type:</label></td>
																	<td onclick="getHelpText('collection_citationInfo_citationMetadata_date_type');" width="260px">
																		<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].date[%%SEQNUM3%%].type" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type" maxlength="512" size="37" />
																		<img id="button_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
																	</td>
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type" style="font-size:1.05em;"></div></td>
																</tr>
															</tbody>
<<<<<<< HEAD
<<<<<<< HEAD

														</table>

														<script type="text/javascript">
															addVocabComplete('object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type','RIFCSCitationDateType');
														</script>

=======
															
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</table>

														<script type="text/javascript">
															addVocabComplete('object_citationInfo_%%SEQNUM1%%_citationMetadata_1_date_%%SEQNUM3%%_type','RIFCSCitationDateType');
														</script>
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['*_citationInfo_citationMetadata_contributor'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">
=======
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andsgrey"> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andsgrey">
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;" width="30px"><label for="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%_seq">Seq:</label></td>
																	<td onclick="getHelpText('');" width="260px">
																		<input type="text" value="%%SEQNUM3%%" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[1].contributor[%%SEQNUM3%%].seq" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%_seq" maxlength="8" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%_seq" style="font-size:1.05em;"></div></td>
																	<td align="right">
																		<input type="button" name="btn_citation_%%SEQNUM1%%_contributor_%%SEQNUM3%%_removecitation_contributor" value="Remove this Contributor" onClick="decCount('object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor'); $('#table_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%').remove();"  />
																	</td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
																
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>

																	<td align="right">
																 		<label class="mandatory"/>Name Parts:
																 	</td>
																	<td colspan="3">
																		<div id="object.citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_container">
																		</div>
																		<input type="button" name="btn_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_addnamePart" value="Add new Name Part" onClick="getElement('namePart', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%'));"  />
																		<div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_1_contributor_%%SEQNUM3%%" style="font-size:1.05em;"></div>
																	</td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

															</tbody>

														</table>

														<script type="text/javascript">

															if ({$has_fragment} == false) {
																getElement('namePart', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%'));
															}

														</script>

=======
															
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
															</tbody>

														</table>

														<script type="text/javascript">

															if ({$has_fragment} == false) {
																getElement('namePart', [], 'object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].', null, getNextSeq('citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%'));
															}

														</script>
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
HTMLEND;


$_strings['*_citationInfo_citationMetadata_contributor_namePart'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%" class="rmdElementContainer" style="font-weight:normal;">

															<tbody class="formFields andswhite">

<<<<<<< HEAD
=======
														<table id="table_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%" class="rmdElementContainer" style="font-weight:normal;"> 
															
															<tbody class="formFields andswhite"> 
												
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label class="mandatory" for="object_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_value">Value:</label></td>
																	<td onclick="getHelpText('');" width="260px">
																		<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].namePart[%%SEQNUM4%%].value" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_value" maxlength="512" size="40" />
																	</td>
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_value" style="font-size:1.05em;"></div></td>
																	<td rowspan="2" align="right">
																		<input type="button" name="btn_citation_%%SEQNUM1%%_contributor_%%SEQNUM2%%_namepart_%%SEQNUM3%%_removenamepart" value="Remove this Name Part" onClick="decCount('object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].namePart');$('#table_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%').remove();"  /><br/>
																	</td>
																</tr>
<<<<<<< HEAD
<<<<<<< HEAD

=======
															
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																<tr>
																	<td style="text-align:right;"><label for="object_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_type">Type:</label></td>
																	<td onclick="getHelpText('');" width="260px">
																		<input type="text" value="" name="object.citationInfo[%%SEQNUM1%%].citationMetadata[%%SEQNUM2%%].contributor[%%SEQNUM3%%].namePart[%%SEQNUM4%%].type" id="object_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_type" maxlength="512" size="37" />
																		<img id="button_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_type" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:18px; width:18px;" />
																	</td>
																	<td><div class="fieldError" name="errors_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_type" style="font-size:1.05em;"></div></td>
<<<<<<< HEAD
<<<<<<< HEAD

																</tr>

															</tbody>

														</table>

=======
																	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																</tr>

															</tbody>

														</table>
<<<<<<< HEAD
														
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														<script type="text/javascript">
															addVocabComplete('object_citationInfo_%%SEQNUM1%%_citationMetadata_%%SEQNUM2%%_contributor_%%SEQNUM3%%_namePart_%%SEQNUM4%%_type','RIFCSNamePartType');
														</script>

HTMLEND;


$_strings['service_accessPolicy'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											<table id="table_accessPolicy_%%SEQNUM1%%" class="formTable rmdElementContainer">

											<tbody class="formFields andsgreen">

<<<<<<< HEAD
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_accessPolicy_%%SEQNUM1%%_value">Value:</label></td>
													<td width="300px">
													<input type="text" name="object.accessPolicy[%%SEQNUM1%%].value" id="object_accessPolicy_%%SEQNUM1%%_value" class="validUri" size="40" maxlength="512" onchange="testAnyURI(this.id);" />
													</td>
=======
											<table id="table_accessPolicy_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
											<tbody class="formFields andsgreen"> 
																												
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
												<tr>

													<td style="text-align:right; font-weight:normal; padding-left:8px; padding-top:8px;"><label for="object_accessPolicy_%%SEQNUM1%%_value">Value:</label></td>
													<td width="300px">
													<input type="text" name="object.accessPolicy[%%SEQNUM1%%].value" id="object_accessPolicy_%%SEQNUM1%%_value" class="validUri" size="40" maxlength="512" onchange="testAnyURI(this.id);" />
<<<<<<< HEAD
													</td> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
													</td>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<td><div class="fieldError" name="errors_accessPolicy_%%SEQNUM1%%_value"></div></td>
													<td width="100%">
														<input type="button" class="buttonSmall" name="btn_accessPolicy_%%SEQNUM1%%_remove" value="Remove this Access Policy" onClick="decCount('object.accessPolicy'); $('#table_accessPolicy_%%SEQNUM1%%').remove();" style="float:right;" /><br/>
													</td>
												</tr>

<<<<<<< HEAD
<<<<<<< HEAD
											</tbody>
=======
											</tbody> 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											</tbody>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

										</table>

HTMLEND;


$_strings['*_existenceDates'] = <<<HTMLEND

<<<<<<< HEAD
<<<<<<< HEAD
											<table id="table_existenceDates_%%SEQNUM1%%" class="formTable rmdElementContainer">

												<tbody class="formFields andsgreen">

													<tr>
														<td style="text-align:left;width:100%;">

															<div style="padding:4px;">Start Date:</div>
=======
											<table id="table_existenceDates_%%SEQNUM1%%" class="formTable rmdElementContainer"> 
											
												<tbody class="formFields andsgreen"> 

													<tr>
														<td style="text-align:left;width:100%;">
														
															<div style="padding:4px;">Start Date:</div>	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
											<table id="table_existenceDates_%%SEQNUM1%%" class="formTable rmdElementContainer">

												<tbody class="formFields andsgreen">

													<tr>
														<td style="text-align:left;width:100%;">

															<div style="padding:4px;">Start Date:</div>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</td>
														<td>
															<input type="button" class="buttonSmall" name="btn_existenceDates_%%SEQNUM1%%_remove" value="Remove this Existence Date" onClick="decCount('object.existenceDates');$('#table_existenceDates_%%SEQNUM1%%').remove();" style="float:right;" />
														</td>
													</tr>
<<<<<<< HEAD
<<<<<<< HEAD

													<tr>
														<td colspan="2" style="text-align:left;width:100%;">
															<table class="formTable rmdElementContainer">
																<tbody class="andsorange">
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;">
																			<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

																			{$dateFormatInfoString}

																			</span></span>&nbsp;&nbsp;
=======
													
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
													<tr>
														<td colspan="2" style="text-align:left;width:100%;">
															<table class="formTable rmdElementContainer">
																<tbody class="andsorange">
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;">
																			<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

																			{$dateFormatInfoString}

<<<<<<< HEAD
																			</span></span>&nbsp;&nbsp; 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																			</span></span>&nbsp;&nbsp;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																			<label for="object_existenceDates_%%SEQNUM1%%_startDate_1_value">Value:</label>
																		</td>
																		<td onclick="getHelpText('existenceDates_startDate');" style="vertical-align:middle;">
																			<input type="text" value="" id="object_existenceDates_%%SEQNUM1%%_startDate_1_value" name="object.existenceDates[%%SEQNUM1%%].startDate[1].value" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="60" style="width:230px;" /> &nbsp;<span id="existenceDates_%%SEQNUM1%%_startDate_1_value_dctImage" onClick="$('#object_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat').val('W3CDTF');">&nbsp;</span>&nbsp;
																		</td>
<<<<<<< HEAD
<<<<<<< HEAD
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_startDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_startDate_1_value"></div></td>
																	</tr>

=======
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_startDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_startDate_1_value"></div></td>													
																	</tr>
																	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_startDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_startDate_1_value"></div></td>
																	</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;" width="40px;"><label class="mandatory" for="object_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat">Date Format:</label></td>
																		<td onclick="getHelpText('collection_coverage_temporal_date_value');" width="260px" style="vertical-align:middle;">
																			<input type="text" name="object.existenceDates[%%SEQNUM1%%].startDate[1].dateFormat" id="object_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat"  maxlength="512" size="36" />
<<<<<<< HEAD
<<<<<<< HEAD
																			<img id="button_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
=======
																			<img id="button_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																			<img id="button_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		</td>
																		<td width="100%"><div class="fieldError" name="errors_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat" style="font-size:1.05em;"></div></td>
																	</tr>
																</tbody>
															</table>
<<<<<<< HEAD
<<<<<<< HEAD

														</td>
													</tr>


													<tr>
														<td colspan="2" style="text-align:left;width:100%;">

															<div style="padding:4px;">End Date:</div>
														</td>
													</tr>

													<tr>
														<td colspan="2" style="text-align:left;width:100%;">
															<table class="formTable rmdElementContainer">
																<tbody class="andsorange">
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;">

																			<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

																			{$dateFormatInfoString}

																			</span></span>&nbsp;&nbsp;

																			<label for="object_existenceDates_%%SEQNUM1%%_endDate_1_value">Value:</label>

=======
															
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
														</td>
													</tr>


													<tr>
														<td colspan="2" style="text-align:left;width:100%;">

															<div style="padding:4px;">End Date:</div>
														</td>
													</tr>

													<tr>
														<td colspan="2" style="text-align:left;width:100%;">
															<table class="formTable rmdElementContainer">
																<tbody class="andsorange">
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;">

																			<span class="infoControl"><img id="infoIcon" alt="More information" src="../_images/info_control_icon.gif"/><span class="infoSpan">

																			{$dateFormatInfoString}

																			</span></span>&nbsp;&nbsp;

																			<label for="object_existenceDates_%%SEQNUM1%%_endDate_1_value">Value:</label>
<<<<<<< HEAD
																			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		</td>
																		<td onclick="getHelpText('existenceDates_endDate');" style="vertical-align:middle;">
																			<input type="text" value="" id="object_existenceDates_%%SEQNUM1%%_endDate_1_value" name="object.existenceDates[%%SEQNUM1%%].endDate[1].value" onchange="checkDTF(this.id);" class="dateTimeField" maxlength="32" size="60" style="width:230px;" /> &nbsp;<span id="existenceDates_%%SEQNUM1%%_endDate_1_value_dctImage" onClick="$('#object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat').val('W3CDTF');">&nbsp;</span>
																		</td>
<<<<<<< HEAD
<<<<<<< HEAD
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_endDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_endDate_1_value"></div></td>
																	</tr>

=======
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_endDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_endDate_1_value"></div></td>													
																	</tr>
																	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																		<td width="100%"><div class="fieldError" id="errors_existenceDates_%%SEQNUM1%%_endDate_1_value" name="errors_existenceDates_%%SEQNUM1%%_endDate_1_value"></div></td>
																	</tr>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																	<tr>
																		<td style="text-align:right; vertical-align:middle; font-weight:normal;" width="40px;"><label class="mandatory" for="object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat">Date Format:</label></td>
																		<td onclick="getHelpText('collection_coverage_temporal_date_value');" width="260px" style="vertical-align:middle;">
																			<input type="text" name="object.existenceDates[%%SEQNUM1%%].endDate[1].dateFormat" id="object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat"  maxlength="512" size="36" />
<<<<<<< HEAD
<<<<<<< HEAD
																			<img id="button_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
=======
																			<img id="button_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />											
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
																			<img id="button_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat" src="{$eAPP_ROOT}orca/_images/buttons/dropdown_in.png" onClick='toggleDropdown(this.id);' class='cursorimg' style="vertical-align:bottom; height:21px; width:21px;" />
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
																		</td>
																		<td><div class="fieldError" name="errors_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat"></div></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

												</tbody>
											</table>

<<<<<<< HEAD
=======
																
												</tbody> 
											</table> 
										
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
										<script type="text/javascript">
											// Initialise the date/time controls (on timeout delay)
											setTimeout('dctGetDateTimeControlSpec("object_existenceDates_%%SEQNUM1%%_startDate_1_value", "YYYY-MM-DDThh:mm:00Z", "existenceDates_%%SEQNUM1%%_startDate_1_value_dctImage");',250);
											setTimeout('dctGetDateTimeControlSpec("object_existenceDates_%%SEQNUM1%%_endDate_1_value", "YYYY-MM-DDThh:mm:00Z", "existenceDates_%%SEQNUM1%%_endDate_1_value_dctImage");',250);

											addVocabComplete('object_existenceDates_%%SEQNUM1%%_startDate_1_dateFormat','RIFCSTemporalCoverageDateFormat');
<<<<<<< HEAD
<<<<<<< HEAD
											addVocabComplete('object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat','RIFCSTemporalCoverageDateFormat');

											//addVocabComplete('object_location_%%SEQNUM1%%_type','RIFCSLocationType');

										</script>

=======
											addVocabComplete('object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat','RIFCSTemporalCoverageDateFormat');	
																				
=======
											addVocabComplete('object_existenceDates_%%SEQNUM1%%_endDate_1_dateFormat','RIFCSTemporalCoverageDateFormat');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
											//addVocabComplete('object_location_%%SEQNUM1%%_type','RIFCSLocationType');

										</script>
<<<<<<< HEAD
									
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

HTMLEND;


/*******************************************
 * MISC ELEMENTS
 */

$_strings['*_buttons'] = <<<HTMLEND

					<table class="formTable" style="width:100%;">
						<tbody>
							<tr>
								<td class="rmdButtonContainer">
									<input type="button" id="backButton" name="backButton" value="Previous Tab" />&nbsp;
									<input type="button" id="nextButton" name="nextButton" value="Next Tab" />&nbsp;
									<input type="button" id="cancelButton" name="cancelButton" value="Cancel Record" onclick="showClearAlert()"/>&nbsp;
									<input type="button" id="finishButton" name="finishButton" value="Save Draft" />
								</td>
							</tr>
							<tr>
								<td class="formNotes" id="rmb_formNotes">
									Fields marked <label class="mandatory"></label>are <b>mandatory</b>.<br />
									Data captured through this system will be validated against the <a class="colorGrey" target="_blank" href="http://ands.org.au/resource/rif-cs.html">RIF-CS 1.3.0 Schema</a> and <a class="colorGrey" target="_blank" href="http://ands.org.au/resource/metadata-content-requirements.html">Metadata Content Requirements</a>.<br />
								</td>
							</tr>
						</tbody>
<<<<<<< HEAD
<<<<<<< HEAD
					</table>

					<script type="text/javascript">
						updateButtonStatus();


						$("#finishButton").click(function() { activeTab = "#preview"; activateTab(activeTab); updateButtonStatus(); });

=======
					</table>	
													
=======
					</table>

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					<script type="text/javascript">
						updateButtonStatus();


						$("#finishButton").click(function() { activeTab = "#preview"; activateTab(activeTab); updateButtonStatus(); });
<<<<<<< HEAD
					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						// =============================================================================
						// NEXT BUTTON functionality
						// ----
						$("#nextButton").click(function() {
<<<<<<< HEAD
<<<<<<< HEAD

							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active");

=======
							
							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active"); 
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active");

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// Move to next tab and load content
							activeTab = "#" + $(activeTab + '_tab').next().attr("id").replace("_tab","");
							$(activeTab + "_tab").addClass("active");
							loadTabUI(activeTab);
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

							// Get help text for new tab
							//getHelpText(activeTab.substring(1));

<<<<<<< HEAD
							// Update buttons to prevent the possibility
							// of clicking past the end of the tab list
							updateButtonStatus();
							//getHelpText();
							$( 'html, body' ).animate( { scrollTop: 0 } );

							return false;
						});


=======
					
							// Get help text for new tab 
							//getHelpText(activeTab.substring(1)); 
							
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// Update buttons to prevent the possibility
							// of clicking past the end of the tab list
							updateButtonStatus();
							//getHelpText();
							$( 'html, body' ).animate( { scrollTop: 0 } );

							return false;
						});
<<<<<<< HEAD
					
						
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						// =============================================================================
						// BACK BUTTON functionality
						// ----
						$("#backButton").click(function() {
<<<<<<< HEAD
<<<<<<< HEAD

							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active");

=======
					
							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active"); 
					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

							// Deactivate the currently active tab
							$(activeTab + "_tab").removeClass("active");

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// Move to previous tab and load content
							activeTab = "#" + $(activeTab + '_tab').prev().attr("id").replace("_tab","");
							loadTabUI(activeTab);
							$(activeTab + "_tab").addClass("active");
<<<<<<< HEAD
<<<<<<< HEAD

							// Get help text for new tab
							//getHelpText(activeTab.substring(1));

=======
					
							// Get help text for new tab 
							//getHelpText(activeTab.substring(1));
							
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

							// Get help text for new tab
							//getHelpText(activeTab.substring(1));

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							// Update buttons to prevent the possibility
							// of clicking before the first tab of the list
							updateButtonStatus();
							getHelpText();
							$( 'html, body' ).animate( { scrollTop: 0 } );
<<<<<<< HEAD
<<<<<<< HEAD

							return false;
						});

=======
							
							return false;
						});
					
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

							return false;
						});

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					</script>

HTMLEND;

