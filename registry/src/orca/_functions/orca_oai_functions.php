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
// OAI_PMH Settings

// Set the size of result sets for ListRecords and ListIdentifiers that will be
// handled with resumptionTokens.
define("OAI_LIST_SIZE", 100);

define("OAI_RT_EXPIRES_MINUTES", 10);

define("OAI_RT_LATEST",   0);
define("OAI_RT_PREVIOUS", 1);
<<<<<<< HEAD
<<<<<<< HEAD

=======
                           
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
// OAI-PMH error codes.
define('OAIbadArgument'             , 'badArgument');
define('OAIbadResumptionToken'      , 'badResumptionToken');
define('OAIbadVerb'                 , 'badVerb');
define('OAIcannotDisseminateFormat' , 'cannotDisseminateFormat');
define('OAIidDoesNotExist'          , 'idDoesNotExist');
define('OAInoRecordsMatch'          , 'noRecordsMatch');
define('OAInoMetaDataFormats'       , 'noMetaDataFormats');
define('OAInoSetHierachy'           , 'noSetHierachy');

// Generic OAI-PMH error descriptions.
$aoiErrors = array(
	OAIbadArgument             => 'The request includes illegal arguments, is missing required arguments, or values for arguments have an illegal syntax.',
	OAIbadResumptionToken      => 'The value of the resumptionToken argument is invalid or expired.',
	OAIbadVerb                 => 'The value of the verb argument is not a legal OAI-PMH verb, or the verb argument is missing.',
	OAIcannotDisseminateFormat => 'The metadata format identified by the value given for the metadataPrefix argument is not supported by the item or by the repository.',
	OAIidDoesNotExist          => 'The value of the identifier argument is unknown or illegal in this repository.',
	OAInoRecordsMatch          => 'The combination of the values of the from, until, set and metadataPrefix arguments results in an empty list.',
	OAInoMetaDataFormats       => 'There are no metadata formats available for the specified item.',
	OAInoSetHierachy           => 'The repository does not support sets.'
);

// OAI-PMH metadata prefixes.
define('OAI_SCHEMA_URI', 0);
define('OAI_NAMESPACE', 1);

define('OAI_DC_METADATA_PREFIX', 'oai_dc');
define('OAI_RIF_METADATA_PREFIX', 'rif');

$gORCA_OAI_METADATA_PREFIXES = array(
<<<<<<< HEAD
<<<<<<< HEAD
	      OAI_DC_METADATA_PREFIX  => array( OAI_SCHEMA_URI => 'http://www.openarchives.org/OAI/2.0/oai_dc.xsd',
	                                        OAI_NAMESPACE  => 'http://www.openarchives.org/OAI/2.0/oai_dc/'
	                                       ),
	      OAI_RIF_METADATA_PREFIX => array( OAI_SCHEMA_URI => gRIF_SCHEMA_URI,
=======
	      OAI_DC_METADATA_PREFIX  => array( OAI_SCHEMA_URI => 'http://www.openarchives.org/OAI/2.0/oai_dc.xsd', 
	                                        OAI_NAMESPACE  => 'http://www.openarchives.org/OAI/2.0/oai_dc/'
	                                       ),
	      OAI_RIF_METADATA_PREFIX => array( OAI_SCHEMA_URI => gRIF_SCHEMA_URI, 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	      OAI_DC_METADATA_PREFIX  => array( OAI_SCHEMA_URI => 'http://www.openarchives.org/OAI/2.0/oai_dc.xsd',
	                                        OAI_NAMESPACE  => 'http://www.openarchives.org/OAI/2.0/oai_dc/'
	                                       ),
	      OAI_RIF_METADATA_PREFIX => array( OAI_SCHEMA_URI => gRIF_SCHEMA_URI,
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	                                        OAI_NAMESPACE  => 'http://ands.org.au/standards/rif-cs/registryObjects'
	                                      )
                                    );

function getArgValue($argName, $args)
{
	$value = '';
	if( isset($args[$argName]) )
	{
		$value = $args[$argName];
	}
	return $value;
}

function getOAIBaseURL()
{
	global $gActivities;
<<<<<<< HEAD
<<<<<<< HEAD

	$activity = getObject($gActivities, 'aORCA_SERVICE_OAI_DATA_PROVIDER');

=======
	
	$activity = getObject($gActivities, 'aORCA_SERVICE_OAI_DATA_PROVIDER');
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	$activity = getObject($gActivities, 'aORCA_SERVICE_OAI_DATA_PROVIDER');

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	return esc($activity->path);
}

function getEarliestDateStamp()
{
	$earliestDateStamp = getXMLDateTime(getMinCreatedWhen());
	if( !$earliestDateStamp )
	{
		// An earliestDatestamp is required by the protocol so if there are no records then...
		$earliestDateStamp = getXMLDateTime(date("Y-m-d H:i:s"));
	}
	return $earliestDateStamp;
}

function getOAIDateGranularityMask($datetime)
{
	$mask = eDCT_FORMAT_ISO8601_DATE;
	if( strpos($datetime, "T") )
	{
		$mask = eDCT_FORMAT_ISO8601_DATETIMESEC_UTC;
	}
	return $mask;
}

function printOAIHeader()
{
	// OAI-PMH Specification  3.2.1
	print('<?xml version="1.0" encoding="UTF-8"?>'."\n");
	// OAI-PMH Specification  3.2.2
	print('<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/"'."\n");
	print('         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"'."\n");
	print('         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/'."\n");
	print('         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">'."\n");
	// OAI-PMH Specification  3.2.3
	print('  <responseDate>'.getXMLDateTime(date("Y-m-d H:i:s")).'</responseDate>'."\n");
}

function printOAIFooter()
{
	print("</OAI-PMH>\n");
}

function printOAIRequestAttributes($requestAttributes)
{
	print("  <request$requestAttributes>".getOAIBaseURL().'</request>'."\n");
}

// OAI-PMH Specification 4.1 GetRecord
// =============================================================================
function printOAIGetRecordXML($args, $requestAttributes)
{
	global $gORCA_OAI_METADATA_PREFIXES;
	$errors = false;
	$xml = '';
	$registryObject = null;

	// Check for the required identifier argument.
	// -------------------------------------------------------------------------
	$identifier = getArgValue('identifier', $args);
	if( !$identifier )
	{
		$requestAttributes = "";
		$errors = true;
		$xml .= getOAIErrorXML(OAIbadArgument, "Missing argument 'identifier'");
	}
	else
	{
		// Check to see if we can get a record for this identifier.
		$registryObject = getRegistryObject($identifier);
		if( !$registryObject )
		{
			$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");
		}
	}

=======
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");			
		}
	}
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");
		}
	}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Check for the required metadataPrefix argument.
	// -------------------------------------------------------------------------
	$metadataPrefix = getArgValue('metadataPrefix', $args);
	if( !$metadataPrefix )
	{
		$requestAttributes = "";
		$errors = true;
		$xml .= getOAIErrorXML(OAIbadArgument, "Missing argument 'metadataPrefix'");
	}
	else
	{
		// Check that we support this metadata format.
		// Note that we don't need to check at the object level, because this
		// characteristic is the same across all objects in the ORCA Registry.
		if( !isset($gORCA_OAI_METADATA_PREFIXES[$metadataPrefix]) )
		{
			$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);

=======
			$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");	
=======
			$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Generate the ouput.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		$dateStamp = getXMLDateTime($registryObject[0]['created_when']);
		$class = 'class:'.strtolower($registryObject[0]['registry_object_class']);
		$group = 'group:'.encodeOAISetSpec($registryObject[0]['object_group']);
		$source = 'dataSource:'.encodeOAISetSpec($registryObject[0]['data_source_key']);

		print "  <GetRecord>\n";
		print "    <record>\n";
		print "      <header>\n";
		print "        <identifier>".esc($identifier)."</identifier>\n";
		print "        <datestamp>".esc($dateStamp)."</datestamp>\n";
		print "        <setSpec>".esc($class)."</setSpec>\n";
		print "        <setSpec>".esc($group)."</setSpec>\n";
		print "        <setSpec>".esc($source)."</setSpec>\n";
		print "      </header>\n";
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if( $metadataPrefix == OAI_RIF_METADATA_PREFIX )
		{
			print "      <metadata>\n";
			print '        <registryObjects xmlns="http://ands.org.au/standards/rif-cs/registryObjects" '."\n";
			print '                         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
			print '                         xsi:schemaLocation="http://ands.org.au/standards/rif-cs/registryObjects '.gRIF_SCHEMA_URI.'">'."\n";
			print getRegistryObjectXML($identifier);
<<<<<<< HEAD
<<<<<<< HEAD
			print "        </registryObjects>\n";
			print "      </metadata>\n";
		}

=======
			print "        </registryObjects>\n";	
			print "      </metadata>\n";
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			print "        </registryObjects>\n";
			print "      </metadata>\n";
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		if( $metadataPrefix == OAI_DC_METADATA_PREFIX )
		{
			print "      <metadata>\n";
			print '        <oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" '."\n";
			print '                   xmlns:dc="http://purl.org/dc/elements/1.1/" '."\n";
			print '                   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
			print '                   xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">'."\n";
			print getRegistryObjectOAIDCXMLElements($identifier);
<<<<<<< HEAD
<<<<<<< HEAD
			print "        </oai_dc:dc>\n";
			print "      </metadata>\n";
		}

=======
			print "        </oai_dc:dc>\n";	
			print "      </metadata>\n";
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			print "        </oai_dc:dc>\n";
			print "      </metadata>\n";
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		print "    </record>\n";
		print "  </GetRecord>\n";
	}
}

// OAI-PMH Specification 4.2 Identify
// =============================================================================
function printOAIIdentifyXML($requestAttributes)
{
	printOAIRequestAttributes($requestAttributes);
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$xml  = "  <Identify>\n";
	$xml .= "    <repositoryName>".esc(eINSTANCE_TITLE.' '.eAPP_TITLE)."</repositoryName>\n";
	$xml .= "    <baseURL>".getOAIBaseURL()."</baseURL>\n";
	$xml .= "    <protocolVersion>2.0</protocolVersion>\n";
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$adminEmail = gORCA_INSTANCE_ADMIN_EMAIL;
	// An admin e-mail of some sort is required by the protocol so...
	if( $adminEmail == '' ){ $adminEmail = 'oai@example.com'; }
	$xml .= "    <adminEmail>".esc($adminEmail)."</adminEmail>\n";
<<<<<<< HEAD
<<<<<<< HEAD

	$earliestDateStamp = getEarliestDateStamp();
	$xml .= "    <earliestDatestamp>".esc($earliestDateStamp)."</earliestDatestamp>\n";

=======
	
	$earliestDateStamp = getEarliestDateStamp();
	$xml .= "    <earliestDatestamp>".esc($earliestDateStamp)."</earliestDatestamp>\n";
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	$earliestDateStamp = getEarliestDateStamp();
	$xml .= "    <earliestDatestamp>".esc($earliestDateStamp)."</earliestDatestamp>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$xml .= "    <deletedRecord>no</deletedRecord>\n";
	$xml .= "    <granularity>YYYY-MM-DDThh:mm:ssZ</granularity>\n";
	$xml .= "  </Identify>\n";
	print($xml);
}

// OAI-PMH Specification 4.3 ListIdentifiers
// =============================================================================
function printOAIListIdentifiersXML($args, $requestAttributes)
{
	global $gORCA_OAI_METADATA_PREFIXES;
	$errors = false;
	$xml = '';
	$resumptionTokenXML = '';
<<<<<<< HEAD
<<<<<<< HEAD
	$registryObjects = null;
=======
	$registryObjects = null;		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$registryObjects = null;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$classes = '';
	$dataSourceKey = null;
	$objectGroup = null;
	$createdAfterInclusive = null;
	$createdBeforeInclusive = null;
	$resumptionTokenId = null;
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Check for the exclusive resumptionToken argument.
	// -------------------------------------------------------------------------
	if( isset($args['resumptionToken']) )
	{
		$resumptionTokenId = getArgValue('resumptionToken', $args);
		if( !getResumptionToken($resumptionTokenId, null) )
		{
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadResumptionToken, '[1] The value of the resumptionToken argument is invalid or expired.');
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// If there are other args then resumptionToken isn't exlusive so...
		if( count($args) > 2 )
		{
			$requestAttributes = "";
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadArgument, "resumptionToken is an exclusive argument.");
		}
	}
	else
	{
		// Check for the required metadataPrefix argument.
		// -------------------------------------------------------------------------
		$metadataPrefix = getArgValue('metadataPrefix', $args);
		if( !$metadataPrefix )
		{
			$requestAttributes = "";
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadArgument, "Missing argument 'metadataPrefix'");
		}
		else
		{
<<<<<<< HEAD
<<<<<<< HEAD
			// Check that we support this metadata format.
			if( !isset($gORCA_OAI_METADATA_PREFIXES[$metadataPrefix]) )
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
			}
		}

=======
			// Check that we support this metadata format.		
=======
			// Check that we support this metadata format.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( !isset($gORCA_OAI_METADATA_PREFIXES[$metadataPrefix]) )
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
			}
		}
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional from argument.
		// -------------------------------------------------------------------------
		$from = getArgValue('from', $args);
		$fromMask = '';
		if( $from )
		{
			if( strtotime($from) )
			{
				$fromMask = getOAIDateGranularityMask($from);
				$createdAfterInclusive = formatDateTimeWithMask($from, $fromMask);
				if( $fromMask == eDCT_FORMAT_ISO8601_DATE ){ $createdAfterInclusive .= "T00:00:00Z"; }
			}
			else
			{
				$requestAttributes = "";
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");
			}
		}

=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");	
			}
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");
			}
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional until argument.
		// -------------------------------------------------------------------------
		$until = getArgValue('until', $args);
		$untilMask = '';
		if( $until )
		{
			if( strtotime($until) )
			{
				$untilMask = getOAIDateGranularityMask($until);
<<<<<<< HEAD
<<<<<<< HEAD
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);

=======
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);	
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if( $from && $fromMask != $untilMask )
				{
					$requestAttributes = "";
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");
				}

				if( $untilMask == eDCT_FORMAT_ISO8601_DATE ){ $createdBeforeInclusive .= "T23:59:59Z"; }

=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");	
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}

				if( $untilMask == eDCT_FORMAT_ISO8601_DATE ){ $createdBeforeInclusive .= "T23:59:59Z"; }
<<<<<<< HEAD
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$earliestDateStamp = formatDateTimeWithMask(getEarliestDateStamp(), $untilMask);
				if( strtotime($createdBeforeInclusive) < strtotime($earliestDateStamp) )
				{
					$requestAttributes = "";
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
			}
			else
			{
				$requestAttributes = "";
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");
			}
		}

=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");	
			}
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");
			}
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional set argument.
		// -------------------------------------------------------------------------
		$set = getArgValue('set', $args);
		if( $set )
		{
			$setSpec = explode(":", $set);
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( count($setSpec) == 2 )
			{
				$setKey = $setSpec[0];
				$setValue = $setSpec[1];
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				switch( $setKey )
				{
					case 'class':
						switch( $setValue )
						{
							case 'activity':
								$classes = $setValue;
								break;
<<<<<<< HEAD
<<<<<<< HEAD

							case 'collection':
								$classes = $setValue;
								break;

							case 'party':
								$classes = $setValue;
								break;

							case 'service':
								$classes = $setValue;
								break;

							default:
								$errors = true;
								$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
								break;
						}
						break;

					case 'group':
						$objectGroup = decodeOAISetSpec($setValue);
						break;

					case 'dataSource':
						$dataSourceKey = decodeOAISetSpec($setValue);
						break;

					default:
						$errors = true;
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
=======
								
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							case 'collection':
								$classes = $setValue;
								break;

							case 'party':
								$classes = $setValue;
								break;

							case 'service':
								$classes = $setValue;
								break;

							default:
								$errors = true;
								$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
								break;
						}
						break;

					case 'group':
						$objectGroup = decodeOAISetSpec($setValue);
						break;

					case 'dataSource':
						$dataSourceKey = decodeOAISetSpec($setValue);
						break;

					default:
						$errors = true;
<<<<<<< HEAD
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						break;
				}
			}
			else
			{
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
			}
		}
	} // end no resumptionToken

=======
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");				
=======
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
		}
	} // end no resumptionToken
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Get the records that match the arguments.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		if( $resumptionTokenId )
		{
			// It's a request identifying an incomplete list so
			// get the incomplete list identified by this resumption token.
			$resumptionToken = getResumptionToken($resumptionTokenId, null);
			if( $resumptionToken )
			{
				$completeListId    = $resumptionToken[0]['complete_list_id'];
				$firstRecordNumber = $resumptionToken[0]['first_record_number'];
				$completeListSize  = $resumptionToken[0]['complete_list_size'];
				$status            = $resumptionToken[0]['status'];
				$metadataPrefix    = $resumptionToken[0]['metadata_prefix'];
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);

				if( ($firstRecordNumber + OAI_LIST_SIZE - 1) < $completeListSize )
				{
					// This ISN'T the last incomplete list needed to service the request.
					if( $status == OAI_RT_LATEST )
					{
						// This is a request for the last issued resumptionToken.
						// Delete any existing OAI_RT_PREVIOUS resumptionToken and
						// set the status of this resumptionToken to OAI_RT_PREVIOUS.
						updateResumptionTokens($completeListId);
<<<<<<< HEAD
<<<<<<< HEAD

						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

=======
						
						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);
						
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					}
					// Get the resumptionTokenXML.
					$resumptionTokenXML = getResumptionTokenXML($completeListId);
				}
				else
				{
					// This IS the last incomplete list needed to service the request.
					// Issue an empty resumptionToken.
					$resumptionTokenXML = getResumptionTokenXML(null);
				}
			}
			else
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIbadResumptionToken, '[2] The value of the resumptionToken argument is invalid or expired.');
			}
		}
		else
		{
			// It's a new request.
			$registryObjects = searchRegistry('', $classes, $dataSourceKey, $objectGroup, $createdBeforeInclusive, $createdAfterInclusive);
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $registryObjects && count($registryObjects) > OAI_LIST_SIZE )
			{
				// The list is larger than the incomplete list size so...
				$completeListId = insertCompleteList();
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if( $completeListId )
				{
					// Create a new resumptionToken for the next incomplete list.
					$firstRecordNumber = 1;
					$completeListSize = count($registryObjects);
<<<<<<< HEAD
<<<<<<< HEAD

					$error = insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

					if( !$error )
					{
						// Build the complete list.
=======
					
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					$error = insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

					if( !$error )
					{
<<<<<<< HEAD
						// Build the complete list. 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						// Build the complete list.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						for( $i = 0; $i < $completeListSize; $i++ )
						{
							insertCompleteListRecord($completeListId, $i+1, $registryObjects[$i]['registry_object_key']);
						}
<<<<<<< HEAD
<<<<<<< HEAD

						// Get the first incomplete list.
						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);

=======
				
						// Get the first incomplete list.
						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

						// Get the first incomplete list.
						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						// Get the resumptionTokenXML.
						$resumptionTokenXML = getResumptionTokenXML($completeListId);
					}
					else
					{
						$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					}
				}
				else
				{
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
=======
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
			}
		}
		if( !$registryObjects )
		{
			$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);

=======
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");	
		}			
=======
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Generate the ouput.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		print "  <ListIdentifiers>\n";
		foreach( $registryObjects as $registryObject )
		{
			$identifier = $registryObject['registry_object_key'];
			$dateStamp = getXMLDateTime($registryObject['created_when']);
			$class = 'class:'.strtolower($registryObject['registry_object_class']);
			$group = 'group:'.encodeOAISetSpec($registryObject['object_group']);
			$source = 'dataSource:'.encodeOAISetSpec($registryObject['data_source_key']);
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			print "    <header>\n";
			print "      <identifier>".esc($identifier)."</identifier>\n";
			print "      <datestamp>".esc($dateStamp)."</datestamp>\n";
			print "      <setSpec>".esc($class)."</setSpec>\n";
			print "      <setSpec>".esc($group)."</setSpec>\n";
			print "      <setSpec>".esc($source)."</setSpec>\n";
			print "    </header>\n";
		}
		print "    $resumptionTokenXML\n";
		print "  </ListIdentifiers>\n";
	}
}

// OAI-PMH Specification 4.4 ListMetadataFormats
// =============================================================================
function printOAIListMetadataFormatsXML($args, $requestAttributes)
{
	global $gORCA_OAI_METADATA_PREFIXES;
	$errors = false;
	$xml = '';

	// Check for the optional identifier argument.
<<<<<<< HEAD
<<<<<<< HEAD
	// -------------------------------------------------------------------------
=======
	// -------------------------------------------------------------------------		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	// -------------------------------------------------------------------------
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$identifier = getArgValue('identifier', $args);
	if( $identifier )
	{
		$registryObject = getRegistryObject($identifier);
		if( !$registryObject )
		{
			$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);

	// Generate the ouput.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
=======
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");			
=======
			$xml .= getOAIErrorXML(OAIidDoesNotExist, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);

	// Generate the ouput.
	// -------------------------------------------------------------------------
	if( !$errors )
<<<<<<< HEAD
	{	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		print "  <ListMetadataFormats>\n";
		foreach( $gORCA_OAI_METADATA_PREFIXES as $prefix => $values)
		{
		    $metadataPrefix = $prefix;
		    $schema = $values[OAI_SCHEMA_URI];
		    $metadataNamespace = $values[OAI_NAMESPACE];
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			print "    <metadataFormat>\n";
		    print "      <metadataPrefix>$metadataPrefix</metadataPrefix>\n";
		    print "      <schema>$schema</schema>\n";
		    print "      <metadataNamespace>$metadataNamespace</metadataNamespace>\n";
<<<<<<< HEAD
<<<<<<< HEAD
		    print "    </metadataFormat>\n";
=======
		    print "    </metadataFormat>\n";		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		    print "    </metadataFormat>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
		print "  </ListMetadataFormats>\n";
	}
}

// OAI-PMH Specification 4.5 ListRecords
// =============================================================================
function printOAIListRecordsXML($args, $requestAttributes)
{
	global $gORCA_OAI_METADATA_PREFIXES;
	$errors = false;
	$xml = '';
	$resumptionTokenXML = '';
<<<<<<< HEAD
<<<<<<< HEAD
	$registryObjects = null;
=======
	$registryObjects = null;		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$registryObjects = null;
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$classes = '';
	$dataSourceKey = null;
	$objectGroup = null;
	$createdAfterInclusive = null;
	$createdBeforeInclusive = null;
	$resumptionTokenId = null;
	$nlaSet = null;
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Check for the exclusive resumptionToken argument.
	// -------------------------------------------------------------------------
	if( isset($args['resumptionToken']) )
	{
		$resumptionTokenId = getArgValue('resumptionToken', $args);
		if( !getResumptionToken($resumptionTokenId, null) )
		{
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadResumptionToken, '[1] The value of the resumptionToken argument is invalid or expired.');
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// If there are other args then resumptionToken isn't exlusive so...
		if( count($args) > 2 )
		{
			$requestAttributes = "";
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadArgument, "resumptionToken is an exclusive argument.");
		}
	}
	else
	{
		// Check for the required metadataPrefix argument.
		// -------------------------------------------------------------------------
		$metadataPrefix = getArgValue('metadataPrefix', $args);
		if( !$metadataPrefix )
		{
			$requestAttributes = "";
			$errors = true;
			$xml .= getOAIErrorXML(OAIbadArgument, "Missing argument 'metadataPrefix'");
		}
		else
		{
<<<<<<< HEAD
<<<<<<< HEAD
			// Check that we support this metadata format.
			if( !isset($gORCA_OAI_METADATA_PREFIXES[$metadataPrefix]) )
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
			}
		}

=======
			// Check that we support this metadata format.		
=======
			// Check that we support this metadata format.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( !isset($gORCA_OAI_METADATA_PREFIXES[$metadataPrefix]) )
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIcannotDisseminateFormat, "");
			}
		}
<<<<<<< HEAD
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional from argument.
		// -------------------------------------------------------------------------
		$from = getArgValue('from', $args);
		$fromMask = '';
		if( $from )
		{
			if( strtotime($from) )
			{
				$fromMask = getOAIDateGranularityMask($from);
				$createdAfterInclusive = formatDateTimeWithMask($from, $fromMask);
				if( $fromMask == eDCT_FORMAT_ISO8601_DATE ){ $createdAfterInclusive .= "T00:00:00Z"; }
			}
			else
			{
				$requestAttributes = "";
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");
			}
		}

=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");	
			}
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'from' is not a valid ISO8601 UTC date.");
			}
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional until argument.
		// -------------------------------------------------------------------------
		$until = getArgValue('until', $args);
		$untilMask = '';
		if( $until )
		{
			if( strtotime($until) )
			{
				$untilMask = getOAIDateGranularityMask($until);
<<<<<<< HEAD
<<<<<<< HEAD
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);

=======
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);	
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$createdBeforeInclusive = formatDateTimeWithMask($until, $untilMask);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if( $from && $fromMask != $untilMask )
				{
					$requestAttributes = "";
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");
				}

				if( $untilMask == eDCT_FORMAT_ISO8601_DATE ){ $createdBeforeInclusive .= "T23:59:59Z"; }

=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");	
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not the same granularity as 'from'.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}

				if( $untilMask == eDCT_FORMAT_ISO8601_DATE ){ $createdBeforeInclusive .= "T23:59:59Z"; }
<<<<<<< HEAD
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				$earliestDateStamp = formatDateTimeWithMask(getEarliestDateStamp(), $untilMask);
				if( strtotime($createdBeforeInclusive) < strtotime($earliestDateStamp) )
				{
					$requestAttributes = "";
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is before the earliest datestamp.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
			}
			else
			{
				$requestAttributes = "";
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");
			}
		}

=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");	
			}
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= getOAIErrorXML(OAIbadArgument, "Optional argument 'until' is not a valid ISO8601 UTC date.");
			}
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// Check for the optional set argument.
		// -------------------------------------------------------------------------
		$set = getArgValue('set', $args);
		if( $set )
		{
			$setSpec = explode(":", $set);
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( count($setSpec) == 2 )
			{
				$setKey = $setSpec[0];
				$setValue = $setSpec[1];
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				switch( $setKey )
				{
					case 'class':
						switch( $setValue )
						{
							case 'activity':
								$classes = $setValue;
								break;
<<<<<<< HEAD
<<<<<<< HEAD

							case 'collection':
								$classes = $setValue;
								break;

							case 'party':
								$classes = $setValue;
								break;

							case 'service':
								$classes = $setValue;
								break;

							default:
								$errors = true;
								$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
								break;
						}
						break;

					case 'group':
						$objectGroup = decodeOAISetSpec($setValue);
						break;

					case 'dataSource':
						$dataSourceKey = decodeOAISetSpec($setValue);
						break;

					case 'nlaSet':
						$nlaSet = decodeOAISetSpec($setValue);
						break;

					default:
						$errors = true;
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
=======
								
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
							case 'collection':
								$classes = $setValue;
								break;

							case 'party':
								$classes = $setValue;
								break;

							case 'service':
								$classes = $setValue;
								break;

							default:
								$errors = true;
								$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
								break;
						}
						break;

					case 'group':
						$objectGroup = decodeOAISetSpec($setValue);
						break;

					case 'dataSource':
						$dataSourceKey = decodeOAISetSpec($setValue);
						break;

					case 'nlaSet':
						$nlaSet = decodeOAISetSpec($setValue);
						break;

					default:
						$errors = true;
<<<<<<< HEAD
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						break;
				}
			}
			else
			{
				$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
=======
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
		}
	} // end no resumptionToken

	// Get the records that match the arguments.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		if( $resumptionTokenId )
		{
			// It's a request identifying an incomplete list so
			// get the incomplete list identified by this resumption token.
			$resumptionToken = getResumptionToken($resumptionTokenId, null);
			if( $resumptionToken )
			{
				$completeListId    = $resumptionToken[0]['complete_list_id'];
				$firstRecordNumber = $resumptionToken[0]['first_record_number'];
				$completeListSize  = $resumptionToken[0]['complete_list_size'];
				$status            = $resumptionToken[0]['status'];
				$metadataPrefix    = $resumptionToken[0]['metadata_prefix'];
<<<<<<< HEAD
<<<<<<< HEAD


				//$registryObjects = 	getIncompleteListNLA($completeListId, $firstRecordNumber);
				$registryObjects = 	getIncompleteList($completeListId, $firstRecordNumber);
=======
				

				//$registryObjects = 	getIncompleteListNLA($completeListId, $firstRecordNumber);
				$registryObjects = 	getIncompleteList($completeListId, $firstRecordNumber);			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


				//$registryObjects = 	getIncompleteListNLA($completeListId, $firstRecordNumber);
				$registryObjects = 	getIncompleteList($completeListId, $firstRecordNumber);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

				if( ($firstRecordNumber + OAI_LIST_SIZE - 1) < $completeListSize )
				{
					// This ISN'T the last incomplete list needed to service the request.
					if( $status == OAI_RT_LATEST )
					{
						// This is a request for the last issued resumptionToken.
						// Delete any existing OAI_RT_PREVIOUS resumptionToken and
						// set the status of this resumptionToken to OAI_RT_PREVIOUS.
						updateResumptionTokens($completeListId);
<<<<<<< HEAD
<<<<<<< HEAD

						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

=======
						
						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);
						
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

						// Create a new resumptionToken for the next incomplete list.
						insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					}
					// Get the resumptionTokenXML.
					$resumptionTokenXML = getResumptionTokenXML($completeListId);
				}
				else
				{
					// This IS the last incomplete list needed to service the request.
					// Issue an empty resumptionToken.
					$resumptionTokenXML = getResumptionTokenXML(null);
				}
			}
			else
			{
				$errors = true;
				$xml .= getOAIErrorXML(OAIbadResumptionToken, '[2] The value of the resumptionToken argument is invalid or expired.');
			}
		}
		else
		{
			// It's a new request.
			if($nlaSet==null)
			{
<<<<<<< HEAD
<<<<<<< HEAD
				$registryObjects = searchRegistry('', $classes, $dataSourceKey, $objectGroup, $createdBeforeInclusive, $createdAfterInclusive);
			}
			else
			{
				$registryObjects = getSpecialObjectSet('nlaSet', $nlaSet);
			}

=======
				$registryObjects = searchRegistry('', $classes, $dataSourceKey, $objectGroup, $createdBeforeInclusive, $createdAfterInclusive);	
=======
				$registryObjects = searchRegistry('', $classes, $dataSourceKey, $objectGroup, $createdBeforeInclusive, $createdAfterInclusive);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			}
			else
			{
				$registryObjects = getSpecialObjectSet('nlaSet', $nlaSet);
			}
<<<<<<< HEAD
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $registryObjects && count($registryObjects) > OAI_LIST_SIZE )
			{
				// The list is larger than the incomplete list size so...
				$completeListId = insertCompleteList();
<<<<<<< HEAD
<<<<<<< HEAD

=======
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if( $completeListId )
				{
					// Create a new resumptionToken for the next incomplete list.
					$firstRecordNumber = 1;
					$completeListSize = count($registryObjects);
<<<<<<< HEAD
<<<<<<< HEAD

					$error = insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

					if( !$error )
					{
						// Build the complete list.
=======
					
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					$error = insertResumptionToken($completeListId, $firstRecordNumber+OAI_LIST_SIZE, $completeListSize, $metadataPrefix);

					if( !$error )
					{
<<<<<<< HEAD
						// Build the complete list. 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						// Build the complete list.
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						for( $i = 0; $i < $completeListSize; $i++ )
						{
							insertCompleteListRecord($completeListId, $i+1, $registryObjects[$i]['registry_object_key']);
						}
<<<<<<< HEAD
<<<<<<< HEAD


						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);


=======
				

						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);
						
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======


						$registryObjects = getIncompleteList($completeListId, $firstRecordNumber);


>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
						// Get the resumptionTokenXML.
						$resumptionTokenXML = getResumptionTokenXML($completeListId);
					}
					else
					{
						$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
						$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					}
				}
				else
				{
					$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
=======
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= getOAIErrorXML(OAInoRecordsMatch, "A server error resulted in no records being returned.");
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
			}
		}
		if( !$registryObjects )
		{
			$errors = true;
<<<<<<< HEAD
<<<<<<< HEAD
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
		}
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);

=======
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");	
		}	
=======
			$xml .= getOAIErrorXML(OAInoRecordsMatch, "");
		}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}

	printOAIRequestAttributes($requestAttributes);
	print($xml);
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// Generate the ouput.
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		print "  <ListRecords>\n";
		foreach( $registryObjects as $registryObject )
		{
			$identifier = $registryObject['registry_object_key'];
			$dateStamp = getXMLDateTime($registryObject['created_when']);
			$class = 'class:'.strtolower($registryObject['registry_object_class']);
			$group = 'group:'.encodeOAISetSpec($registryObject['object_group']);
			$source = 'dataSource:'.encodeOAISetSpec($registryObject['data_source_key']);
			if($nlaSet)
			$isil = 'isil:'.$registryObject['isil_value'];
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			print "    <record>\n";
			print "      <header>\n";
			print "        <identifier>".esc($identifier)."</identifier>\n";
			print "        <datestamp>".esc($dateStamp)."</datestamp>\n";
			print "        <setSpec>".esc($class)."</setSpec>\n";
			print "        <setSpec>".esc($group)."</setSpec>\n";
			print "        <setSpec>".esc($source)."</setSpec>\n";
			if($nlaSet){
			print "        <setSpec>".esc($isil)."</setSpec>\n";}
			print "      </header>\n";
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $metadataPrefix == OAI_RIF_METADATA_PREFIX )
			{
				print "      <metadata>\n";
				print '        <registryObjects xmlns="http://ands.org.au/standards/rif-cs/registryObjects" '."\n";
				print '                         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
				print '                         xsi:schemaLocation="http://ands.org.au/standards/rif-cs/registryObjects '.gRIF_SCHEMA_URI.'">'."\n";
				print getRegistryObjectXML($identifier);
<<<<<<< HEAD
<<<<<<< HEAD
				print "        </registryObjects>\n";
				print "      </metadata>\n";
			}

=======
				print "        </registryObjects>\n";	
				print "      </metadata>\n";
			}
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				print "        </registryObjects>\n";
				print "      </metadata>\n";
			}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			if( $metadataPrefix == OAI_DC_METADATA_PREFIX )
			{
				print "      <metadata>\n";
				print '        <oai_dc:dc xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" '."\n";
				print '                   xmlns:dc="http://purl.org/dc/elements/1.1/" '."\n";
				print '                   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" '."\n";
				print '                   xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ http://www.openarchives.org/OAI/2.0/oai_dc.xsd">'."\n";
				print getRegistryObjectOAIDCXMLElements($identifier);
<<<<<<< HEAD
<<<<<<< HEAD
				print "        </oai_dc:dc>\n";
				print "      </metadata>\n";
			}
			print "    </record>\n";
		}
		print "    $resumptionTokenXML\n";
		print "  </ListRecords>\n";
	}
=======
				print "        </oai_dc:dc>\n";	
=======
				print "        </oai_dc:dc>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				print "      </metadata>\n";
			}
			print "    </record>\n";
		}
		print "    $resumptionTokenXML\n";
		print "  </ListRecords>\n";
<<<<<<< HEAD
	}	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}

// OAI-PMH Specification 4.6 ListSets
// =============================================================================
function printOAIListSetsXML($args, $requestAttributes)
{
	global $gORCA_OAI_SET_SPECS;
	$errors = false;
	$xml = '';
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	// We never issue a resumptionToken for ListSets so...
	// -------------------------------------------------------------------------
	if( isset($args['resumptionToken']) )
	{
		$errors = true;
		$xml .= getOAIErrorXML(OAIbadResumptionToken, '[1] The value of the resumptionToken argument is invalid or expired.');
	}
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	printOAIRequestAttributes($requestAttributes);
	print($xml);

	// Generate the ouput.
<<<<<<< HEAD
<<<<<<< HEAD
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		print "  <ListSets>\n";

=======
	// -------------------------------------------------------------------------	
	if( !$errors )
	{
		print "  <ListSets>\n";
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	// -------------------------------------------------------------------------
	if( !$errors )
	{
		print "  <ListSets>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		// The classes of registry object - class:
		print "    <set>\n";
	    print "      <setSpec>class:activity</setSpec>\n";
	    print "      <setName>Activities</setName>\n";
<<<<<<< HEAD
<<<<<<< HEAD
	    print "    </set>\n";
		print "    <set>\n";
	    print "      <setSpec>class:collection</setSpec>\n";
	    print "      <setName>Collections</setName>\n";
	    print "    </set>\n";
		print "    <set>\n";
	    print "      <setSpec>class:party</setSpec>\n";
	    print "      <setName>Parties</setName>\n";
	    print "    </set>\n";
=======
	    print "    </set>\n";		
=======
	    print "    </set>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		print "    <set>\n";
	    print "      <setSpec>class:collection</setSpec>\n";
	    print "      <setName>Collections</setName>\n";
	    print "    </set>\n";
		print "    <set>\n";
	    print "      <setSpec>class:party</setSpec>\n";
	    print "      <setName>Parties</setName>\n";
<<<<<<< HEAD
	    print "    </set>\n";	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	    print "    </set>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		print "    <set>\n";
	    print "      <setSpec>class:service</setSpec>\n";
	    print "      <setName>Services</setName>\n";
	    print "    </set>\n";
<<<<<<< HEAD
<<<<<<< HEAD

=======
	    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	    // Registry Object Groups - group:
	    $groups = getObjectGroups();
	    if( $groups )
	    {
	    	foreach( $groups as $group )
			{
				print "    <set>\n";
			    print "      <setSpec>group:".esc(encodeOAISetSpec($group['object_group']))."</setSpec>\n";
			    print "      <setName>Registry objects in group '".esc($group['object_group'])."'</setName>\n";
			    print "    </set>\n";
			}
	    }

	    // Data Sources - dataSource:
	    $dataSources = getDataSources(null, null);
	    if( $dataSources )
	    {
	    	foreach( $dataSources as $dataSource )
			{
				print "    <set>\n";
			    print "      <setSpec>dataSource:".esc(encodeOAISetSpec($dataSource['data_source_key']))."</setSpec>\n";
			    print "      <setName>Registry objects from data source '".esc($dataSource['title'])."'</setName>\n";
			    print "    </set>\n";
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

		print "  </ListSets>\n";
	}
}
// =============================================================================
function getResumptionTokenXML($completeListId)
{
	$xml = '<resumptionToken';
	if( $completeListId )
	{
		$resumptionToken = getResumptionToken(null, $completeListId);
		$resumptionTokenId = 'ErrorGettingToken';

		if( $resumptionToken )
		{
			$resumptionTokenId = $resumptionToken[0]['resumption_token_id'];
			$firstRecordNumber = $resumptionToken[0]['first_record_number'];
			$expirationDate   = $resumptionToken[0]['expiration_date'];
			$completeListSize  = $resumptionToken[0]['complete_list_size'];
<<<<<<< HEAD
<<<<<<< HEAD

			$cursor = $firstRecordNumber - OAI_LIST_SIZE - 1;

			$xml .= ' expirationDate="'.esc(getXMLDateTime($expirationDate)).'"';
			$xml .= ' completeListSize="'.esc($completeListSize).'"';
			$xml .= ' cursor="'.esc($cursor).'"';
=======
			
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
			$cursor = $firstRecordNumber - OAI_LIST_SIZE - 1;

			$xml .= ' expirationDate="'.esc(getXMLDateTime($expirationDate)).'"';
			$xml .= ' completeListSize="'.esc($completeListSize).'"';
<<<<<<< HEAD
			$xml .= ' cursor="'.esc($cursor).'"';	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			$xml .= ' cursor="'.esc($cursor).'"';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
		$xml .= '>'.esc($resumptionTokenId);
	}
	else
	{
		$xml .= '>';
	}
	$xml .= '</resumptionToken>';
<<<<<<< HEAD
<<<<<<< HEAD

	cleanupCompleteLists();

=======
	
	cleanupCompleteLists();
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	cleanupCompleteLists();

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	return $xml;
}

// =============================================================================
function encodeOAISetSpec($rawSpec)
{
	$encodedSpec = preg_replace('/%([0-9][0-9])/', '0x$1', rawurlencode($rawSpec));
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	return $encodedSpec;
}

function decodeOAISetSpec($encodedSpec)
{
	$rawSpec = rawurldecode(preg_replace('/0x([0-9][0-9])/', '%$1', $encodedSpec));
<<<<<<< HEAD
<<<<<<< HEAD

	return $rawSpec;
}

// =============================================================================
function getOAIErrorXML($code, $description)
{
	global $aoiErrors;

=======
	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	return $rawSpec;
}

// =============================================================================
function getOAIErrorXML($code, $description)
{
	global $aoiErrors;
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( !$description )
	{
		// Get the generic description.
		$description = $aoiErrors[$code];
	}
	$xml = '  <error code="'.esc($code).'">'.esc($description).'</error>'."\n";
	return $xml;
}

// =============================================================================
function getRegistryObjectOAIDCXMLElements($registryObjectKey)
{
<<<<<<< HEAD
<<<<<<< HEAD
	global $host, $rda_root;
	$xml = '';
	$registryObject = getRegistryObject($registryObjectKey);

=======
	$xml = '';
	$registryObject = getRegistryObject($registryObjectKey);
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	global $host, $rda_root;
	$xml = '';
	$registryObject = getRegistryObject($registryObjectKey);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if( $registryObject )
	{
		//<element ref="dc:title"/>
		$names = getComplexNames($registryObjectKey);
		if( $names )
		{
			$xml .= "          <dc:title>";
			foreach( $names as $name )
			{
				$nameParts = getNameParts($name['complex_name_id']);
				if($name["type"]=="primary"||$name["type"]=="abbreviated")
				{
					foreach( $nameParts as $namePart)
					{
						$xml .= esc($namePart['value']);
					}
				}
			}
			$xml .=	"</dc:title>\n";
		}

<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	    //<element ref="dc:identifier"/>
		$electronicAddresses = getRegistryObjectElectronicAddresses($registryObjectKey);
		if($electronicAddresses)
		{
			foreach($electronicAddresses as $electronicAddress)
			{
<<<<<<< HEAD
<<<<<<< HEAD
				// spec: collection/location/address/electronic[@type='url']/value
=======
				// spec: collection/location/address/electronic[@type='url']/value   
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				// spec: collection/location/address/electronic[@type='url']/value
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if (strtolower($electronicAddress['type']) == "url")
				{
					$xml .= "          <dc:identifier>".esc($electronicAddress['value'])."</dc:identifier>\n";
				}
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
		$identifiers = getIdentifiers($registryObjectKey);
		if( $identifiers )
		{
			foreach( $identifiers as $identifier )
			{
				if($identifier['type']=="handle"){
					$xml .= "          <dc:identifier>".str_replace("hdl:","http://hdl.handle.net/102.100.100/14",esc($identifier['value']))."</dc:identifier>\n";
				}
				elseif($identifier['type']=="doi"){
					$xml .= "          <dc:identifier>http://dx.doi.org/".esc($identifier['value'])."</dc:identifier>\n";
				}
				elseif($identifier['type']=="url"||$identifier['type']=="uri"||$identifier['type']=="purl")
				{
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= "          <dc:identifier>".esc($identifier['value'])."</dc:identifier>\n";
				}
				else
				{
					$xml .= "          <dc:identifier>".esc($identifier['value'])." (".esc($identifier['type']).")</dc:identifier>\n";
				}
			}
		}

		$xml .= "          <dc:identifier>http://".$host.'/'.$rda_root . '/view.php?key='.esc(urlencode($registryObjectKey))."</dc:identifier>\n";

=======
					$xml .= "          <dc:identifier>".esc($identifier['value'])."</dc:identifier>\n";					
=======
					$xml .= "          <dc:identifier>".esc($identifier['value'])."</dc:identifier>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
				else
				{
					$xml .= "          <dc:identifier>".esc($identifier['value'])." (".esc($identifier['type']).")</dc:identifier>\n";
				}
			}
		}
<<<<<<< HEAD
		
		$xml .= "          <dc:identifier>".eHTTP_APP_ROOT.'orca/rda/view.php?key='.esc(urlencode($registryObjectKey))."</dc:identifier>\n";			
	    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		$xml .= "          <dc:identifier>http://".$host.'/'.$rda_root . '/view.php?key='.esc(urlencode($registryObjectKey))."</dc:identifier>\n";

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		//<element ref="dc:description"/>
	    //<element ref="dc:rights" />
		$descriptions = getDescriptions($registryObjectKey);
		if( $descriptions )
		{
			foreach( $descriptions as $description )
			{
				if(esc($description['type'])=='rights'||esc($description['type'])=='accessRights')
				{
					$xml .= "          <dc:rights>".esc($description['value'])."</dc:rights>\n";
				}
				else
<<<<<<< HEAD
<<<<<<< HEAD
				{
=======
				{			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				{
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					$xml .= "          <dc:description>".esc($description['value'])."</dc:description>\n";
				}
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
						    
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		//<element ref="dc:subject"/>
		$subjects = getSubjects($registryObjectKey);
		if( $subjects )
		{
			foreach( $subjects as $subject )
			{
				if(strtoupper($subject["type"])=="ANZSRC-FOR"||strtoupper($subject["type"])=="ANZSRC-SEO"||strtoupper($subject["type"])=="ANZSRC-TOA"||strtoupper($subject["type"])=="RFCD")
				{
					switch( strtoupper($subject["type"]) )
					{
					// ---------------------------------------------
					// RFCD
					// ---------------------------------------------
					case 'RFCD':
						$value = getNameForVocabSubject('rfcd',  $subject["value"]);
						break;
<<<<<<< HEAD
<<<<<<< HEAD

					// ---------------------------------------------
					// ANZSRC
					// ---------------------------------------------
					case 'ANZSRC-FOR':
						$value = getNameForVocabSubject('ANZSRC-FOR', $subject["value"]);
						break;

					case 'ANZSRC-SEO':
						$value = getNameForVocabSubject('ANZSRC-SEO', $subject["value"]);
						break;

					case 'ANZSRC-TOA':
						$value = getNameForVocabSubject('ANZSRC-TOA', $subject["value"]);
						break;

		    		default:
		    			break;
					}

					if($value)
					{
						$xml .= "          <dc:subject>".esc($value)."</dc:subject>\n";
					}
=======
		    
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					// ---------------------------------------------
					// ANZSRC
					// ---------------------------------------------
					case 'ANZSRC-FOR':
						$value = getNameForVocabSubject('ANZSRC-FOR', $subject["value"]);
						break;

					case 'ANZSRC-SEO':
						$value = getNameForVocabSubject('ANZSRC-SEO', $subject["value"]);
						break;

					case 'ANZSRC-TOA':
						$value = getNameForVocabSubject('ANZSRC-TOA', $subject["value"]);
						break;

		    		default:
		    			break;
					}

					if($value)
					{
						$xml .= "          <dc:subject>".esc($value)."</dc:subject>\n";
<<<<<<< HEAD
					}		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
					else
					{
						// Monica has asked for this to be removed if it doesn't match a valid code
						//$xml .= "          <dc:subject>".esc($subject["type"]).":".esc($subject["value"])."</dc:subject>\n";
					}
				}else{
					if($subject['value'])$xml .= "          <dc:subject>".esc($subject['value'])."</dc:subject>\n";
				}
			}
		}

<<<<<<< HEAD
<<<<<<< HEAD
		//<element ref="dc:type"/>
		if($registryObject[0]['type']){
				$xml .= "          <dc:type>".esc($registryObject[0]['type'])."</dc:type>\n";
		}

		//<element ref="dc:coverage"/>
=======
		//<element ref="dc:type"/>	
		if($registryObject[0]['type']){
				$xml .= "          <dc:type>".esc($registryObject[0]['type'])."</dc:type>\n";
		}
				
		//<element ref="dc:coverage"/>	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		//<element ref="dc:type"/>
		if($registryObject[0]['type']){
				$xml .= "          <dc:type>".esc($registryObject[0]['type'])."</dc:type>\n";
		}

		//<element ref="dc:coverage"/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$coverages = getCoverage($registryObjectKey);
		if( $coverages )
		{
			foreach( $coverages as $coverage )
			{

<<<<<<< HEAD
<<<<<<< HEAD
				$spatialCoverages = getSpatialCoverage($coverage['coverage_id']);
=======
				$spatialCoverages = getSpatialCoverage($coverage['coverage_id']);	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				$spatialCoverages = getSpatialCoverage($coverage['coverage_id']);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($spatialCoverages)
				{
					foreach($spatialCoverages as $spatialCoverage)
					{
						$xml .= "          <dc:coverage>Spatial:".str_replace("text","",esc($spatialCoverage['type'])).":".esc($spatialCoverage['value'])."</dc:coverage>\n";
					}
				}
<<<<<<< HEAD
<<<<<<< HEAD

				$temporalCoverages = getTemporalCoverage($coverage['coverage_id']);
=======
				
				$temporalCoverages = getTemporalCoverage($coverage['coverage_id']);	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

				$temporalCoverages = getTemporalCoverage($coverage['coverage_id']);
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($temporalCoverages)
				{
					foreach($temporalCoverages as $temporalCoverage)
					{
							$temporalDates = getTemporalCoverageDate($temporalCoverage['temporal_coverage_id']);
							$coverageDates = '';
							foreach($temporalDates as $temporalDate)
							{
<<<<<<< HEAD
<<<<<<< HEAD

								if($temporalDate['type']=='dateFrom')
								{
									$coverageDates .= ' from '.str_replace("T00:00:00Z","",str_replace("T23:59:59Z","",esc($temporalDate['value'])));
								}

								if($temporalDate['type']=='dateTo')
								{
									$coverageDates .= ' to '.str_replace("T00:00:00Z","",str_replace("T23:59:59Z","",esc($temporalDate['value'])));
								}

							}
							$xml .= "          <dc:coverage>Temporal:".$coverageDates."</dc:coverage>\n";

							$temporalTexts = getTemporalCoverageText($temporalCoverage['temporal_coverage_id']);
							if($temporalTexts){
								foreach($temporalTexts as $temporalText)
								{
									$xml .= "          <dc:coverage>Temporal:".esc($temporalText['value'])."</dc:coverage>\n";
								}
							}
					}
				}

			}
		}

		//<element ref="dc:publisher"/>
		if($registryObject[0]['object_group']!='Publish My Data'){
			$xml .= "          <dc:publisher>".$registryObject[0]['object_group']."</dc:publisher>\n";
		}

		//<element ref="dc:contributor"/>
=======
													
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
								if($temporalDate['type']=='dateFrom')
								{
									$coverageDates .= ' from '.str_replace("T00:00:00Z","",str_replace("T23:59:59Z","",esc($temporalDate['value'])));
								}

								if($temporalDate['type']=='dateTo')
								{
									$coverageDates .= ' to '.str_replace("T00:00:00Z","",str_replace("T23:59:59Z","",esc($temporalDate['value'])));
								}

							}
							$xml .= "          <dc:coverage>Temporal:".$coverageDates."</dc:coverage>\n";

							$temporalTexts = getTemporalCoverageText($temporalCoverage['temporal_coverage_id']);
							if($temporalTexts){
								foreach($temporalTexts as $temporalText)
								{
									$xml .= "          <dc:coverage>Temporal:".esc($temporalText['value'])."</dc:coverage>\n";
								}
							}
					}
				}

			}
		}

		//<element ref="dc:publisher"/>
		if($registryObject[0]['object_group']!='Publish My Data'){
			$xml .= "          <dc:publisher>".$registryObject[0]['object_group']."</dc:publisher>\n";
<<<<<<< HEAD
		}				
						
		//<element ref="dc:contributor"/>			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		}

		//<element ref="dc:contributor"/>
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$contributors = getRelatedObjects($registryObjectKey);
		if($contributors)
		{
			foreach($contributors as $contributor)
			{
				$relations = getRelationDescriptions(esc($contributor['relation_id']));
<<<<<<< HEAD
<<<<<<< HEAD

				$Names = getNames($contributor['related_registry_object_key']);

=======
				
				$Names = getNames($contributor['related_registry_object_key']);
				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

				$Names = getNames($contributor['related_registry_object_key']);

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if($Names)
				{
					$contributorName ='';
					foreach($Names as $Name)
					{
						$contributorName .= esc($Name['value']);
					}
				}
<<<<<<< HEAD
<<<<<<< HEAD
				if(trim($contributorName)){
					$xml .= "          <dc:contributor>".$contributorName." (".esc($relations[0]['type']) .")</dc:contributor>\n";
=======
				if(trim($contributorName)){	
					$xml .= "          <dc:contributor>".$contributorName." (".esc($relations[0]['type']) .")</dc:contributor>\n";				
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
				if(trim($contributorName)){
					$xml .= "          <dc:contributor>".$contributorName." (".esc($relations[0]['type']) .")</dc:contributor>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
				$contributorName ='';
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$relatedInfos = getRelatedInfo($registryObjectKey);
		if( $relatedInfos )
		{
			foreach( $relatedInfos as $relatedInfo )
			{
				if($relatedInfo['identifier_type']=="url"||$relatedInfo['identifier_type']=="uri"||$relatedInfo['identifier_type']=="purl"||$relatedInfo['identifier_type']=="handle")
				{
<<<<<<< HEAD
<<<<<<< HEAD
					$xml .= "          <dc:relation>".esc($relatedInfo['identifier'])."</dc:relation>\n";
=======
					$xml .= "          <dc:relation>".esc($relatedInfo['identifier'])."</dc:relation>\n";			
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
					$xml .= "          <dc:relation>".esc($relatedInfo['identifier'])."</dc:relation>\n";
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				}
				else
				{
					if($relatedInfo['identifier_type']){
						$xml .= "          <dc:relation>".esc($relatedInfo['identifier_type']).":".esc($relatedInfo['identifier'])."</dc:relation>\n";
					}
					else {
						$xml .= "          <dc:relation>".($relatedInfo['value'])."</dc:relation>\n";
					}
				}
			}
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
function getNameForVocabSubject($vocabId, $vocabTermId)
{
	$termName = '';
	$term = null;
	$term = getTermsForVocabByIdentifier($vocabId, $vocabTermId);
	if ($term != null)
	{
		$termName = $term[0]['name'];
	}
<<<<<<< HEAD
<<<<<<< HEAD

	return $termName;

}
=======
	
	return $termName;

} 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	return $termName;

}
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
