<?php

// Include required files and initialisation.
require '../../_includes/init.php';
require '../orca_init.php';
require_once 'xml2json.php';

// Increase the execution timeout as we may have to deal with a large amount of data.
$executionTimeoutSeconds = 10*60;
ini_set("max_execution_time", "$executionTimeoutSeconds");

$searchString = getQueryValue('term');
$cnt=0;

if(getQueryValue('count')>0)
{
    $cnt=  getQueryValue('count');
}

$registryObjects = null;

if( $searchString )
{
	$registryObjects = searchRegistryTERN($searchString, '',  null, null, null, null,$cnt);  
    
}

$itemLinkBaseURL = ePROTOCOL.'://'.eHOST.'/view/dataview?key=';

$totalResults = 0;
if( count($registryObjects)>0 )
{
	$totalResults = count($registryObjects);

}

if(getQueryValue('format')=="xml")
{
    // Set the Content-Type header.
    header("Content-Type: text/xml; charset=UTF-8", true);

    print buildXMLOutput($totalResults,$searchString,$registryObjects,$itemLinkBaseURL);    
}
else if(getQueryValue('format')=="json")
{
    // Set the Content-Type header.
    //header("Content-Type: application/json; charset=UTF-8", true);
    $out= buildJsonOutput($registryObjects,$itemLinkBaseURL);    
    
    if(getQueryValue('w')!=null)
    {
        echo $_GET['callback'].'('.$out.')';
    }else
    {
        header("Content-Type: application/json; charset=UTF-8", true);
        echo $out;
    }
}
else
{
    print("Invalid request");
}
//===END xml output

 require '../../_includes/finish.php';
 

 function buildXMLOutput($totalResults,$searchString,$registryObjects,$itemLinkBaseURL)
 {
     //==XML response
    $tmp='<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $tmp=$tmp.'<rss version="2.0" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/">'."\n";
    $tmp=$tmp.'  <channel>'."\n";
    $tmp=$tmp.'    <title>'.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE).' Ecosystem registry Search</title>'.'\n';
    $tmp=$tmp.'    <link>'.eAPP_ROOT.'orca/api/search.php</link>'."\n";
    $tmp=$tmp.'    <description>Search results for '.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE)." Ecosystem registry Search</description>\n";
    $tmp=$tmp.'    <opensearch:totalResults>'.$totalResults.'</opensearch:totalResults>'."\n";
    $tmp=$tmp.'    <opensearch:Query role="request" searchTerms="'.esc($searchString).'" />'."\n";

    $tmpc=  buildXMLContent($registryObjects,$itemLinkBaseURL);

    $t='  </channel>'."\n"."</rss>\n";

    return $tmp.$tmpc.$t;
 }
 
 function buildJsonOutput($registryObjects,$itemLinkBaseURL)
 {
     $jtmp='<?xml version="1.0" encoding="UTF-8"?>'."\n".' <response>'."\n";
     $jtmpc= buildXMLContent($registryObjects,$itemLinkBaseURL);
     $jt='  </response>';
     
     if($jtmpc!='')
     {
        $xmlstring=$jtmp.$jtmpc.$jt;
     }else
     {
         $xmlstring=$jtmp.$jt;
     }

     $o= xml2json::transformXmlStringToJson($xmlstring);

     return $o;
 }
 
// Local presentation functions.
function getNameRSS($registryObjectKey)
{
	$rss = $registryObjectKey;
	$names = getNames($registryObjectKey);
	if( $names )
	{
		$rss = '';
		for( $i = 0; $i < count($names); $i++ )
		{
			{			
				if( $i != 0 )
				{
					$rss .= ' '.gCHAR_MIDDOT.' ';
				}
				$rss .= esc($names[$i]['value']);
			}
		}
	}
	return $rss;
}

function getDescriptionsRSS($registryObjectKey)
{
	$rss = '';
	$descriptions = getDescriptions($registryObjectKey);
	if( $descriptions )
	{
		for( $i = 0; $i < count($descriptions); $i++ )
		{
			$descr = $descriptions[$i]['value'];
			$rss .= strtoupper(esc($descriptions[$i]['type'])).": ";
			$rss .= esc($descr.'&nbsp;&nbsp;&nbsp;&nbsp;');
		}
	}
	return $rss;
}

function buildXMLContent($registryObjects,$itemLinkBaseURL)
{

    $tmp1='';
    if( count($registryObjects)>0 )
    {                            
	foreach( $registryObjects as $registryObject )
  
	{	
 		$registryObjectKey = $registryObject['registry_object_key'];

		$registryObjectName = getNameRSS($registryObjectKey);
		$registryObjectClass = $registryObject['registry_object_class'];
		$registryObjectType = $registryObject['type'];
		$registryObjectDescriptions = getDescriptionsRSS($registryObjectKey);

		$tmp1=$tmp1.'    <item>'."\n";
		$tmp1=$tmp1.'      <guid>'.esc($registryObjectKey).'</guid>'."\n";
		$tmp1=$tmp1.'      <title>'.$registryObjectName.'</title>'."\n";
		$tmp1=$tmp1.'      <link>'.$itemLinkBaseURL.esc($registryObjectKey).'</link>'."\n";
		$tmp1=$tmp1.'      <category>'.esc("$registryObjectClass:$registryObjectType").'</category>'."\n";
		$tmp1=$tmp1.'      <description>'.$registryObjectDescriptions.'</description>'."\n";
		$tmp1=$tmp1.'    </item>'."\n";
	}
    }
    

    return $tmp1;
}


?>

