<?php

// Include required files and initialisation.
require '../../_includes/init.php';
require '../orca_init.php';
require_once 'xml2json.php';


$executionTimeoutSeconds = 10*60;
ini_set("max_execution_time", "$executionTimeoutSeconds");

$searchString = getQueryValue('term');
$format=  getQueryValue('format');

$cnt=5;

if(getQueryValue('count')>0)
{
    $cnt=  getQueryValue('count');
}

$itemLinkBaseURL = ePROTOCOL.'://'.eHOST.'/view/dataview?key=';

$totalResults = 0;

searchRegistryTERNSolr($searchString, $format, $cnt,$totalResults,$itemLinkBaseURL);


require '../../_includes/finish.php';
 

function buildXMLOutput($totalResults,$searchString,$content,$itemLinkBaseURL)
{

    
    $totalResults= getCount($content);
    
    $tmpc=  buildXMLContent($content,$itemLinkBaseURL);
    
     //==XML response
    $tmp='<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $tmp=$tmp.'<rss version="2.0" xmlns:opensearch="http://a9.com/-/spec/opensearch/1.1/" >'."\n";
    $tmp=$tmp.'  <channel>'."\n";
    $tmp=$tmp.'    <title>'.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE).' Ecosystem registry Search</title>'."\n";
    $tmp=$tmp.'    <link>'.eAPP_ROOT.'orca/api/search.php</link>'."\n";
    $tmp=$tmp.'    <description>Search results for '.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE)." Ecosystem registry Search</description>\n";
    $tmp=$tmp.'    <opensearch:totalResults>'.$totalResults.'</opensearch:totalResults>'."\n";
    $tmp=$tmp.'    <opensearch:Query role="request" searchTerms="'.esc($searchString).'" ></opensearch:Query>'."\n";
   $t='  </channel>'."\n"."</rss>\n";

    return $tmp.$tmpc.$t;
 }
 
function buildJsonOutput($totalResults,$searchString,$content,$itemLinkBaseURL)
{
     $totalResults= getCount($content);
     $jtmp='<?xml version="1.0" encoding="UTF-8"?>'."\n".' <response>'."\n";
     $jtmp=$jtmp.'    <title>'.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE).' Ecosystem registry Search</title>'.'\n';
     $jtmp=$jtmp.'    <link>'.eAPP_ROOT.'orca/api/search.php</link>'."\n";
     $jtmp=$jtmp.'    <description>Search results for '.esc(eINSTANCE_TITLE_SHORT.' '.eAPP_TITLE)." Ecosystem registry Search</description>\n";
     $jtmp=$jtmp.'    <opensearch:totalResults>'.$totalResults.'</opensearch:totalResults>'."\n";
     $jtmp=$jtmp.'    <opensearch:Query role="request" searchTerms="'.esc($searchString).'" />'."\n";     
    
     $jtmpc= buildXMLContent($content,$itemLinkBaseURL);
     
     $jt='  </response>';
     
     if($jtmpc!='')
     {
        $xmlstring=$jtmp.$jtmpc.$jt;
     }else
     {
         $xmlstring=$jtmp.$jt;
     }
     return $xmlstring;
 }
 
function buildXMLContent($content,$itemLinkBaseURL)
{
   
    $docs=simplexml_load_string($content);
   
    $tmp1='';
    if( $docs->result!=null )
    {       
        
        foreach( $docs->result->doc as $doc )  
	{	
       
                $registryObjectKey = $doc->xpath('str[@name="key"]');
                $registryObjectName=$doc->xpath('str[@name="displayTitle"]');
		$registryObjectClass=$doc->xpath('str[@name="class"]');
		$registryObjectType=$doc->xpath('str[@name="type"]');
		$registryObjectDescriptions=$doc->xpath('arr[@name="description_value"]/str');
                
                $location=$doc->xpath('arr[@name="location"]/str');

                $relatedinfo=$doc->xpath('arr[@name="relatedInfo"]/str');

		$tmp1=$tmp1.'    <item>'."\n";
		$tmp1=$tmp1.'      <guid>'.esc($registryObjectKey[0]).'</guid>'."\n";
		$tmp1=$tmp1.'      <title>'.esc($registryObjectName[0]).'</title>'."\n";
		$tmp1=$tmp1.'      <link>'.$itemLinkBaseURL.esc($registryObjectKey[0]).'</link>'."\n";
		$tmp1=$tmp1.'      <category>'.esc("$registryObjectClass[0]:$registryObjectType[0]").'</category>'."\n";
		$tmp1=$tmp1.'      <description>'.esc($registryObjectDescriptions[0]).esc($registryObjectDescriptions[1]).esc($registryObjectDescriptions[2]).'</description>'."\n";
                                                 
                for($j=0;$j<count($location);$j++)
                {

                    $tmp1=$tmp1.'      <location>'.esc($location[$j]).'</location>'."\n";
                }
                
                for($k=0;$k<count($relatedinfo);$k++)
                {
                    $tmp1=$tmp1.'      <relatedInfo>'.esc($relatedinfo[$k]).'</relatedInfo>'."\n";
                }
                
		$tmp1=$tmp1.'    </item>'."\n";             
             
	} 
    }
    

    return $tmp1;
}

function searchRegistryTERNSolr($searchString,$format,$cnt,$totalResults,$itemLinkBaseURL)
{
        $q = $searchString;
        $q = rawurlencode($q);
        $q = str_replace("%5C%22", "\"", $q); //silly encoding
        $start = 0;
        $row = $cnt;     
        
        //$solr_url = "http://demo:8080/orca-solr/";
       $solr_url = "http://portal-dev.tern.org.au:8080/orca-solr/";
        
        $q = urldecode($q);
        
        if ($q != '*:*')
            $q = escapeSolrValueTERN($q);
          
        $q = '(fulltext:(' . $q . ')OR key:(' . $q . ')^50 OR displayTitle:(' . $q . ')^50 OR listTitle:(' . $q . ')^50 OR description_value:(' . $q . ')^5 OR subject_value:(' . $q . ')^10  OR for_value_two:('. $q . ')^10 OR for_value_four:('. $q .')^10 OR for_value_six:('. $q .')^10 OR name_part:(' . $q . ')^30)';
  
        $fields = array(
            'q' => $q, 'version' => '2.2', 'start' => $start, 'rows' => $row, 'wt' => $write_type,
            'fl' => '*,score'
        );
        
        $fields_string = '';
        foreach ($fields as $key => $value)
        {
            $fields_string .= $key . '=' . $value . '&';
        }
        rtrim($fields_string, '&');

       // $fields_string .= $facet; //add the facet bits
        $fields_string = urldecode($fields_string);
        
        
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $solr_url . 'select'); //post to SOLR
        curl_setopt($ch, CURLOPT_POST, count($fields)); //number of POST var
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string); //post the field strings
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //return to variable
        $content = curl_exec($ch); //execute the curl
        curl_close($ch); //close the curl
 
        if ($format == 'json')
        {           
            
                $output= buildJsonOutput($totalResults,$searchString,$content,$itemLinkBaseURL);
                
                $out= xml2json::transformXmlStringToJson($output);
                if(getQueryValue('w')!=null)
                {
                    echo $_GET['callback'].'('.$out.')';
                }else
                {
                    header("Content-Type: application/json; charset=UTF-8", true);
                    echo $out;
                }
             
             
        }
        else// ($format == 'xml')
        {
          $output= buildXMLOutput($totalResults,$searchString,$content,$itemLinkBaseURL);
          header("Content-Type: text/xml; charset=UTF-8", true);
          echo $output;
          
          //echo $content;

        }
}


function escapeSolrValueTERN($string)
{	
    $match = array('\\','&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '"', ';');
    $replace = array('\\\\','&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;');
    $string = str_replace($match, $replace, $string);
 
    return urlencode($string);
}

function getCount($xml)
{
    $dom=new DOMDocument;
    $dom->loadXML($xml);
    
    return $dom->getElementsByTagName('doc')->length;
}

?>

