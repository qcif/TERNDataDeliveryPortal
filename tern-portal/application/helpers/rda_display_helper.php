<?php
/** 
Copyright 2011 The Australian National University
Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
***************************************************************************
*
**/ 
?>
<?php

/*
 * displayFacet
 * function prints out HTML
 * used in facet view
 */
function displayFacet($facet_name, $facetFilter, $json, $ro_class){
	
	$clear ='';$name = '';$class='';
	
	switch($facet_name){
		case "type":$clear = 'clearType';
			if($ro_class!='All'){ 
				$name=ucfirst($ro_class).' Types';
			}else $name = 'Types';				
			$class="typeFilter";break;
		case "group":$clear = 'clearGroup';$name='Facilities';$class="groupFilter";break;
		case "subject_value":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;
           
	}
	$object_type="";
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
        if(count($object_type)>0){
            
            echo '<h5 ><a href="#">'.$name;
            echo '</a></h5>';
            echo '<div class="facet-list facet-content">';

            echo '<ul class="more" id="'.$facet_name.'-facet">';

            //print the others
            for($i=0;$i< sizeof($object_type)-1 ;$i=$i+2){
                    if($object_type[$i+1]>0){
                            if($object_type[$i]!=$facetFilter){
                                    echo '<li class="limit">
                                            <a href="javascript:void(0);" 
                                                    title="'.$object_type[$i].' ('.number_format($object_type[$i+1]).''.' results)" 
                                                    class="'.$class.'" id="'.$object_type[$i].'">'.$object_type[$i].' ('.number_format($object_type[$i+1]).')'.'</a></li>';
                            } 
                    }
            }
            echo '</ul>';
            echo '</div>';
        }
}

/*
 * displayCustomiseOptions
 * Used in the display customise dialog box
 */ 
function displayCustomiseOptions($cookie){
	$CI =& get_instance();
	if($CI->input->cookie($cookie)!=''){
		if($CI->input->cookie('show_subjects')=='yes'){
			echo '<img id="'.$cookie.'" class="customise-option" src="'.base_url().'img/yes.png">';
		}else{
			echo '<img id="'.$cookie.'" class="customise-option" src="'.base_url().'img/no.png">';
		}
	}else{
		echo '<img id="'.$cookie.'" class="customise-option" src="'.base_url().'img/no.png">';
	}
}

/*
 * displaySelectedFacet
 * Used in facet view
 */ 
function displaySelectedFacet($facet_name, $facetFilter, $json){
  
	$clear ='';$name = '';$class='';
	switch($facet_name){
		case "type":$clear = 'clearType';$name='Types';$class="typeFilter";break;
		case "group":$clear = 'clearGroup';$name='Facilities';$class="groupFilter";break;
		case "subject_value":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;
                case "for_value_two":$clear = 'clearFortwo';$name="FOR";$class="fortwoFilter";break;
                case "for_value_four":$clear = 'clearForfour';$name="FOR";$class="forfourFilter";break;
                case "for_value_six":$clear = 'clearForsix';$name="FOR";$class="forsixFilter";break;
	}
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
        // handle it if facetFilter is an array 
        $facetFilter = explode(";",$facetFilter);
        //print the selected 
        for($i=0; $i<count($facetFilter); $i++){
            $idx = false;
            array_walk($object_type, 'trim');
            $idx = array_search($facetFilter[$i],$object_type, true);
         
            if($idx !== false){
                 echo '<li class="limit">
		       <a href="javascript:void(0);" 
						class="clearFilter '.$clear.'" id="'.$object_type[$idx].'">'.$object_type[$idx].' ('. $object_type[$idx+1].')'.'</a></li>';
                
            }
        }
}       

/*
 * Construct a SOLR based filter query
 * Used in SOLR model
 */ 
function constructFilterQuery($class, $groups){
	$str='';
	switch($class){
		case 'class':$str='+class:(';break;
		case 'type':$str='+type:(';break;
		case 'group':$str='+group:(';break;
		case 'subject_value':$str='+subject_value:(';break;
                case 'subject_code': $str='+subject_code:(';break;
		case 'status':$str='+status:(';break;
                case 'for_value_two':$str='+for_value_two:(';break;
                case 'for_value_four':$str='+for_value_four:(';break;
                case 'for_value_six':$str='+for_value_six:(';break;
	}
	
	$classes = explode(';',$groups);
	$first = true;
	foreach($classes as $c){
		if(!$first){
                        if($class=='subject_code') $str.=' OR '. $c .'*';
			else $str.=' OR "'.escapeSolrValue($c).'"';
		}else{
			if($class=='subject_code') $str.=''. $c .'*';
                        else $str.= '"'.escapeSolrValue($c).'"';
			$first = false;
		}
	}
	$str .=')';
    return $str;
}

/*
 * escapeSolrValue
 * escaping sensitive items in a solr query
 * encode afterwards (need check)
 */ 
function escapeSolrValue($string){
	//$string = urldecode($string);
    $match = array('\\','&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '"', ';');
    $replace = array('\\\\','&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;');
        $string = str_replace($match, $replace, $string);
        return urlencode($string);
    }

/*
 * getDidYouMean
 * given a term, spits out didyoumean term
 * Used when no search result is being returned
 */ 
function getDidYouMean($term){
	$CI =& get_instance();
	$CI->load->model('Registryobjects', 'ro');
	return $CI->ro->didYouMean($term);
}

/*
 * array_to_json
 * Spits out a json object given a php array
 * Used in search suggestion
 */ 
/* following function obtained from http://jqueryui.com */
function  array_to_json( $array ){
  if( !is_array( $array ) ){
      return false;
  }
  $associative = count( array_diff( array_keys($array), array_keys( array_keys( $array )) ));
  if( $associative ){
        $construct = array();
        foreach( $array as $key => $value ){
            // We first copy each key/value pair into a staging array,
            // formatting each key and value properly as we go.
            // Format the key:
            if( is_numeric($key) ){
                $key = "key_$key";
            }
            $key = "\"".addslashes($key)."\"";
            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "\"".addslashes($value)."\"";
            }
            // Add to staging array:
            $construct[] = "$key: $value";
        }
        // Then we collapse the staging array into the JSON form:
        $result = "{ " . implode( ", ", $construct ) . " }";
    } else { // If the array is a vector (not associative):
        $construct = array();
        foreach( $array as $value ){
            // Format the value:
            if( is_array( $value )){
                $value = array_to_json( $value );
            } else if( !is_numeric( $value ) || is_string( $value ) ){
                $value = "'".addslashes($value)."'";
            }
            // Add to staging array:
            $construct[] = $value;
        }
        // Then we collapse the staging array into the JSON form:
        $result = "[ " . implode( ", ", $construct ) . " ]";
    }
    return $result;
}


 /*
 * getHTTPs
 * takes in a URL and spits out https form
 * Basically replace http with https
 */
function getHTTPs($uri){
	return str_replace('http', 'https', $uri);
}
/*
 * service_url
 * gives the ORCA service url that view page will use to get extended RIFCS
 * Basically returns a string
 */
function service_url(){
	$ci =& get_instance();
	$orca = $ci->config->item('orca_url');
   
	$orca_service = $ci->config->item('orca_service_point');
	//return getHTTPs($orca).$orca_service;
	return $orca.$orca_service;
}

/*
 * view_url
 * gives the ORCA view url that the view page will link to
 * Basically returns a string
 */
function view_url(){
	$ci =& get_instance();
	return getHTTPs($ci->config->item('orca_url')).$ci->config->item('orca_view_point');
}


/*Get response from a http request*/
function get_http_response_code($url) {
	$headers = get_headers($url);
	return substr($headers[0], 9, 3);
	}

        
function showBrief($str, $length) {
  $str = strip_tags($str);
  $str = explode(" ", $str);
  return implode(" " , array_slice($str, 0, $length));
}

function displayFacet4Mobile($facet_name, $facetFilter, $json, $ro_class, $obj){

	$clear ='';$name = '';$class='';

	switch($facet_name){
		case "type":$clear = 'clearType';
			if($ro_class!='All'){
				$name=ucfirst($obj->lang->line($ro_class)).' Types';
			}else $name = 'Types';
			$class="typeFilter";break;
		case "group":$clear = 'clearGroup';$name='Facilities';$class="groupFilter";break;
		case "subject_value":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;
	}



	echo '<div class="right-box" data-role="collapsible">';


	echo '<h2>'.$name;
	echo '</h2>';
	echo '<div class="facet-content">';


	echo '<ul class="more">';
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
	//print the others
	for($i=0;$i< sizeof($object_type)-1 ;$i=$i+2){
		if($object_type[$i+1]>0){
			if($object_type[$i]!=$facetFilter){
				echo '<li class="limit">
					<a href="javascript:void(0);"
						title="'.$object_type[$i].' ('.number_format($object_type[$i+1]).''.' results)"
						class="'.$class.'" id="'.$object_type[$i].'">'.$object_type[$i].' ('.number_format($object_type[$i+1]).')'.'</a></li>';
			}
		}
	}
	echo '</ul>';
	echo '</div>';
	echo '</div>';
}

function stripFORString($str)
{
    $pos=strpos($str,'-');
    $result=substr($str,$pos+1);
    return $result;
}

function displayFORFacet($facettwo,$facetfour,$facetsix,$facetFilter, $json, $ro_class, $obj)
{
	$clear =$facetName;$class=$facetFilter;
 

	$object_type2 = $json->{'facet_counts'}->{'facet_fields'}->{$facettwo};
        $object_type4 = $json->{'facet_counts'}->{'facet_fields'}->{$facetfour};
        $object_type6 = $json->{'facet_counts'}->{'facet_fields'}->{$facetsix};
//print_r($object_type2);
/*       
for($j=0;$j<count($object_type2);$j=$j+2)
{
    $out[$object_type2[$j]]=$object_type2[$j+1];
}
 * 
 */
for($j=0;$j<count($object_type4);$j=$j+2)
{
    $out[$object_type4[$j]]=$object_type4[$j+1];
}
/*
for($j=0;$j<count($object_type6);$j=$j+2)
{
    $out[$object_type6[$j]]=$object_type6[$j+1];
}
  */

//print_r($out);
                     // print_r($prevObj);
/*        
        if($prevObj!=null)
        {        
            print_r($object_type);
            $object=array_diff($object_type,array_intersect($prevObj,$object_type));

//print_r($object);
                for($i=0;$i< sizeof($object)-1 ;$i=$i+2)
                {               
                    
                    if($object[$i+1]>0){
                    
			if($object[$i]!=$facetFilter){
                            
				echo '<li class="limit">
					<a href="javascript:void(0);" 
						title="'.$object[$i].' ('.number_format($object[$i+1]).''.' results)" 
						class="'.$class.'" id="'.$object[$i].'">'.$object[$i].' ('.number_format($object[$i+1]).')'.'</a></li>';
                            } 
                    }
                }
              
                return array_merge($object,(array)$prevObj);
        }else
        {
 */ 
 
	echo '<h5><a href="#">Field of Research';
	echo '</a></h5>';
	echo '<div class="facet-list" >';
	
	
	echo '<ul class="more">';
               $out_keys=array_keys($out);
              //print_r($out_keys);
              // print_r(count($out_keys));
                for($i=0;$i< count($out_keys);$i=$i+1)
                {  
                    if($out[$out_keys[$i]]>0)
                    {
                        if($out_keys[$i]!=$facetFilter[$i])
                        {                  
				echo '<li class="limit">
					<a href="javascript:void(0);" 
						title="'.$out_keys[$i].' ('.number_format($out[$out_keys[$i]]).''.' results)" 
						class="forfourFilter'.'" id="'.$out_keys[$i].'">'.$out_keys[$i].' ('.number_format($out[$out_keys[$i]]).')'.'</a></li>';

                        }
                    }
                }
               // return $object_type;
  //      }

       	echo '</ul>';
	echo '</div>';

 
}

/*
// is this still being used? 
function escapeSolrValueNoEncode($string){
		//$string = urldecode($string);
        $match = array('\\', '+', '-', '&', '|', '!', '(', ')', '{', '}', '[', ']', '^', '~', '*', '?', ':', '"', ';', ' ');
        $replace = array('\\\\', '\\+', '\\-', '&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;', '\\ ');
        $string = str_replace($match, $replace, $string);
        return ($string);
    }


function formatDateTime($datetime, $type=gDATETIME){
	date_default_timezone_set('Australia/Brisbane');
	global $eDateFormat;
	global $eTimeFormat;
	global $eDateTimeFormat;

	$formatDate = "";
	if( $datetime != "" && $datetime != null )
	{
		date_create($datetime);
		if( error_get_last() )
		{
			$formatDate = $datetime;
		}
		else
		{
			switch( $type )
			{
				case gDATE:
					$mask = $eDateFormat;
					break;
				case gTIME:
					$mask = $eTimeFormat;
					break;
				default:
					$mask = $eDateTimeFormat;
					break;
			}
			$formatDate = formatDateTimeWithMask($datetime, $mask);
		}
	}
	return $formatDate;
}

function formatDateTimeWithMask($datetime, $mask){
	$formatDate = "";
	
	if( $datetime != "" && $datetime != null )
	{
		date_create($datetime);
		if( error_get_last() )
		{
			$formatDate = $datetime;
		}
		else
		{
			$maskFragments = array("YYYY", "MM", "DD", "hh", "mm", "ss", "OOOO", "AM");
			
			// Default to 24 hour time.
			$hoursFormat = 'H';
			
			if( strpos($mask, "AM") > 0 ){
				// Use 12 hour time.
				$hoursFormat = 'h';
			}

			// Get the local timezone as set in application_env.php.
			$timezone = new DateTimeZone(date_default_timezone_get());
			
			// Parse the string into a date.
			// If no timezone offset is supplied in the datetime string
			// then the local timezone will be used by the function (as set in the previous step).
			// Otherwise, if the datetime string includes a timezone offset, then the local timezone will be ignored and overridden.
			$objDate = new DateTime($datetime, $timezone);
			
			// If the mask has a "Z" in it, then the output will be representing a UTC/GMT date, 
			// and we need to convert the date to UTC. 
			// The conversion will be done by setting the timezone so...
			if( strpos($mask, "Z") > 0 )
			{
				$timezone = new DateTimeZone('UTC');
			}
			// Setting the timezone will convert the date.
			// So, we now set the timezone to convert the date to local time,
			// or to UTC, as has been determined in the previous steps.
			$objDate->setTimezone($timezone);
			
			// Get the values for each component of the date.
			$fragmentValues = array($objDate->format("Y"), $objDate->format("m"), $objDate->format("d"), $objDate->format($hoursFormat), $objDate->format("i"), $objDate->format("s"), $objDate->format("O"), $objDate->format("A"));
			
			// Replace all of the fragments in the mask with the values for each fragment that we calculated in the last step.
			$formatDate = str_replace($maskFragments, $fragmentValues, $mask);
		}
	}
	return $formatDate;
}

function getRelationship($keyList, $relationshipList){
		$typeArray = array(
		"Describes" => "Described by",
		"Associated with" => "Associated with",
		"Aggregated by" => "Collector of",
		"Has member" => "Member of",
		"Produces" => "Output of",
		"Includes" => "Includes",
		"Undertaken by" => "Undertaken by",
		"Collector of" => "Aggregated by",
		"Described by" => "Describes",
		"Funded by" => "Funds",
		"Funds" => "Funded by",
		"Located in" => "Location for",
		"Location for" => "Located in",
		"Managed by" => "Manages",
		"Manages" => "Managed by",
		"Member of" => "Has member",
		"Output of" => "Produces",
		"Owned by" => "Owner of",
		"Owned Of" => "Owned by",
		"Participant in" => "Part of",
		"Part of" => "Participant in",
		"Supported by" => "Supports",
		"Supports" => "Supported by"
		);

		for($i=0;$i<count($keyList);$i++)
		{
			if($keyList[$i]==$key) $relationship = $relationshipList[$i];
		}

		if( array_key_exists($relationship, $typeArray) )
		{
			return  $typeArray[$relationship];
		}
		else
		{
			return   $relationship;
		}
}
 * 
 */
?>