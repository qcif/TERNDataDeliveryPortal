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
    
define("RDFAPI_INCLUDE_DIR", "rdfapi/");
include(RDFAPI_INCLUDE_DIR . "RdfAPI.php");

error_reporting(1);
ini_set('memory_limit', '-1');

define("FOR_PREFIX","http://purl.org/asc/1297.0/2008/for/");
define("SKOS_PREFIX","http://www.w3.org/2004/02/skos/core#");
define("GCMD","http://gcmdservices.gsfc.nasa.gov/kms/concept/");
define("GCMDBASE","sciencekeywords.rdf");

function displayFacilitiesFacet($facet_name, $facetFilter, $json, $ro_class,$help_title,$help_content){
	
	$clear ='';$name = '';$class='';
	
	if($facet_name=="group")
        {
           $clear = 'clearGroup';
           $name='Facilities';
           $class="groupFilter";
        }           

        $words=explode(';',$facetFilter);
        $g=array();
 
        foreach($words as $w)
        {
            $g[]=urldecode($w);
        }

	$object_type="";
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};

        if(count($object_type)>0){
     
            echo '<li id="facfacet">';
           // echo '<div class="facet-list facet-content collapsiblePanel">';
            echo '<div class="content expand collapsiblePanel">';
            echo '<h2 class="head"><a class="hide">'.$name . '</a>';
            echo '</h2>';
            echo '<div>';
            //echo '<ul style="display:inline" id="'.$facet_name.'-facet">';
            echo '<ul id="'.$facet_name.'-facet">';


            //print the others
            for($i=0;$i< sizeof($object_type)-1 ;$i=$i+2){
                    if($object_type[$i+1]>0){
                        if(count($g)==1 &&$g[0]=="All")
                        {
                            //if($object_type[$i]!=$facetFilter)
                            //{
                                echo '<li>
					<input type="checkbox" 
						name="facchkbox"
                                                value="'.$object_type[$i].'" 
						class="groupFilter'.'" id="'.$object_type[$i].'"/> '.$object_type[$i].' ('.number_format($object_type[$i+1]).')</li>';         
                            //} 
                        }else
                        {                         

                            if(!checkInFilter($object_type[$i],$g))
                            {
                                echo '<li>
					<input type="checkbox" 
						name="facchkbox"
                                                value="'.$object_type[$i].'" 
						class="groupFilter'.'" id="'.$object_type[$i].'"/> '.$object_type[$i].'</li>';         
                            }                      
                        } 
                    }
            } 
            echo '</ul>';
           // echo '<button id="facbutton" class="buttonSearch srchButton ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">Search</span></button>';
             echo '<a href="javascript:void(0);" id="facbutton" class="greenGradient smallRoundedCorners">GO</a> ';
            echo '</div>'; 
            echo '</div>';
            echo '<div id="facility-help-text" title="'.$help_title.'" class="hide" >'.$help_content.'</div>';
            echo '</li>';
           
        }
}

/* displayRegionFacet
 * 
 * facet_name : the SOLR field name, e.g. tern_region
 * facetFilter : The facet currently selected by user
 * json : SOLR json search result with facet
 * ro_class : currently unused, used to differentiate Collections/Activities.etc
 * regionsName: an array with region layers and regions name list for each of them
 * help_title: help dialog popup title
 * help_text: text for dialog popup 
 */

function displayRegionFacet($facet_name, $facetFilter, $json, $ro_class, $regionsName,$help_title,$help_text){
    
	$clear ='clearTernRegion';$name = 'Region';$class='ternRegionFilter';
        
	$object_type="";
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
        if(count($object_type)>0 ){
          echo '<li>'  ;
          echo '<div id="facet-region" class="content expand collapsiblePanel">';
          
            echo '<h2 > <a class="hide">'.$name . '</a>';
            echo '</h2>';
            echo '<div>';
            if($facetFilter != 'All'){
                echo 'Selecting a region will replace your current region search';
            }
                 // echo '<div  id="facet-region" class="facet-list facet-content">';
            echo '<select id="region-select" class="facetDropDown">';
            echo '<option value="">Please select a region type</option>';
           
             foreach($regionsName as $key=>$regionsList){ // looping through the regions configuration in regions.json to build the drop down
                 if(is_array($regionsList))
                 echo '<option value="'. $key . '">'. $regionsList['l_name'] . "</option>";                                 
             }
            echo '</select><br/><div id="visible-region"> </div>'; // the empty div will be filled by the JS everytime the drop down changes
            
           foreach($regionsName as $key=>$regionsList){ //build each list for each regions type
               if(is_array($regionsList)){ 
               $firstRun=true;
                 for($k=0;$k<count($regionsList);$k++){  // for every regions in regions type
                      for($i=0;$i< sizeof($object_type)-1 ;$i=$i+2){ // for every region in facet 
                        if($object_type[$i+1]>0 && (strpos($object_type[$i],$key)!==false)){   // check that the current facet is > 0 
                            if($firstRun){ // print opening tags
                                 echo '<div id="' . $key . '" class="hide">';
                                 echo '<ul class="facetContainer" >';
                                 $firstRun=false;
                            }
                            list($l_id, $r_id) = explode(':',$object_type[$i]); // get the layer id, and the region id
                            if($regionsList[$k]->r_id == $r_id && $object_type[$i]!=$facetFilter){   // compare the facet ID and the ID from the regionsName region list and whether it's the facet already selected by the user
                                    echo '<li>
                                    <a href="javascript:void(0);"                                                        
                                            class="'.$class.'" id="'.$object_type[$i].'">'.$regionsList[$k]->r_name .'</a></li>';
                            }
                        }
                                              
                     }
                                           
                 }                           
                if($firstRun==false) { // closing tags
                    echo '</ul>';
                   echo '</div>';
                }
               }
             }
         
          echo '</div>';
           echo '</div>';
            echo '<div id="region-help-text" title="'.$help_title.'" class="hide" >'.$help_text.'</div>';
         
           echo '</li>';
                   
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
 * displaySelectedRegionFacet
 * Used in facet view
 */ 
function displaySelectedRegionFacet($facet_name, $facetFilter, $json,$regionsName){
  
	$clear ='clearTernRegion';$name = 'Region';$class='ternRegionFilter';
	
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
        // handle it if facetFilter is an array 
        $facetFilter = explode(";",$facetFilter);
        //print the selected 
        
        for($i=0; $i<count($facetFilter); $i++){
            $idx = false;
            array_walk($object_type, 'trim');
            $idx = array_search($facetFilter[$i],$object_type, true);
         
            if($idx !== false){
                list($l_id,$r_id) = explode(':', $facetFilter[$i]);
                foreach($regionsName as $key=>$regionsList){
                     if($key == $l_id){
                          for($k=0;$k<count($regionsList);$k++){
                              if($regionsList[$k]->r_id == $r_id)
                              {
                                echo '<li>
                                        <span class="clearFilter '.$clear.'" id="'.$object_type[$i].'">'.$regionsList['l_name'] . ": ".$regionsList[$k]->r_name .' ('.number_format($object_type[$idx+1]).')'.'</span>';
                                echo '</li>';  
                                break;
                                }
                        }
                     }
                }
            }
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

                case "gcmd":$clear ='clearGCMD'; $name='GCMD'; $class="gcmdFilter";break;
		//case "subject_value":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;
                case "subject_value_resolved":$clear = 'clearSubjects';$name="Subjects";$class="subjectFilter";break;

                case "for_value_two":$clear = 'clearFortwo';$name="Field of Research";$class="fortwoFilter";break;
                case "for_value_four":$clear = 'clearForfour';$name="Field of Research";$class="forfourFilter";break;
                case "for_value_six":$clear = 'clearForsix';$name="Field of Research";$class="forsixFilter";break;
	}
	$object_type = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
        // handle it if facetFilter is an array 
        $facetFilter = explode(";",$facetFilter);
        //print the selected 
   
        echo '<h2>'.$name.'</h2>';
        echo '<ul>';
        for($i=0; $i<count($facetFilter); $i++){
            $idx = false;
            array_walk($object_type, 'trim');
            $idx = array_search($facetFilter[$i],$object_type, true);
         
            if($idx !== false){
                 echo '<li>
		       <span class="clearFilter '.$clear.'" id="'.$object_type[$idx].'">'.$object_type[$idx].' ('. $object_type[$idx+1].')'.'</span>';
                 echo '</li>';
                
            }
        }
        echo '</ul>'; 
}       

function displaySelectedTerm($query, $json){

	$clear ='';$name = '';$class='';
     
        $clear = 'clearTerm';$name='Term';$class="termF";

        $query=str_replace("(","",$query);
        $query=str_replace(")","",$query);
        $rawquery=explode(" ",$query);
        $bool_op=array('AND','OR','NOT');
        $rawquery_no_op=explode( $bool_op[0], str_replace($bool_op, $bool_op[0], $query) );

       // $op=array_diff($bool_op,$rawquery);
        //print_r($op);
        $op=array();
        $op[]="";
        $n=0;
        
        while($n<count($rawquery))
        {
            if($rawquery[$n]=="AND" || $rawquery[$n]=="NOT" || $rawquery[$n]=="OR")
            {
                $op[]=$rawquery[$n];

            }
            $n=$n+1;
        }
        
        echo  '<h2>Search Term:</h2>';
        echo  '<ul>';
        for($m=0;$m<count($rawquery_no_op);$m++)
        {            
                 echo '<li>';
                 echo '<span class="searchTerm">';
                 echo '   <label class="clearFilter '.$clear.'" id="'.rtrim(ltrim($op[$m])).' ('.escapeSolrValue(rtrim(ltrim($rawquery_no_op[$m]))).')">'.$op[$m].'('.$rawquery_no_op[$m].')</label>';
                 echo '</span>';    
                 echo '</li>';
              
  
        }
        echo '</ul>';            
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
                
                case 'gcmd':$str='+gcmd:(';break;
		//case 'subject_value':$str='+subject_value:(';break;
                case 'subject_value_resolved':$str='+subject_value_resolved:(';break;

                case 'subject_code': $str='+subject_code:(';break;
		case 'status':$str='+status:(';break;
               // case 'for_value_two':$str='+for_value_two:(';break;
               // case 'for_value_four':$str='+for_value_four:(';break;
               // case 'for_value_six':$str='+for_value_six:(';break;
                case 'tern_region': $str='+tern_region:(';break;
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

function constructFORQuery($class,$forvalues)
{
    $str='';
    $forField='';
    if($class=='for_value_two')
    {
        $forField="for_value_two";
    }else if ($class=='for_value_four')
    {
       $forField="for_value_four";
    }else
    {
        $forField="for_value_six";
    }
    $words=explode(';',$forvalues);
    $first=true;
    foreach($words as $w)
    {
        if($first)
        {
            $str.=$forField.':('.'"'.escapeSolrValue($w).'"'.')';
        }else
        {
            $str.=' OR '.$forField.':("'.escapeSolrValue($w).'"'.')';
            
        }
        $first=false;
    }
    //$str.=')';

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
    $replace = array('\\\\','\\&', '\\|', '\\!', '\\(', '\\)', '\\{', '\\}', '\\[', '\\]', '\\^', '\\~', '\\*', '\\?', '\\:', '\\"', '\\;');
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

		//case "subject_value":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;
                case "subject_value_resolved":$clear = 'clearSubjects';$name="Keywords";$class="subjectFilter";break;

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

function displayFORFacet($facettwo,$facetfour,$facetsix,$facetfourFilter,$facettwoFilter, $json, $ro_class, $obj,$help_title,$help_text)
{

    $words=explode(';',$facetfourFilter);
    $four=array();

    foreach($words as $w)
    {
       $four[]=$w;

    }
    
    $wordstwo=explode(';',$facettwoFilter);
    $two=array();

    foreach($wordstwo as $wt)
    {
       $two[]=$wt;

    }

//code        
        $code2 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_two'};
        $code4 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_four'};
        $code6 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_six'};
//values
	$object_type2 = $json->{'facet_counts'}->{'facet_fields'}->{$facettwo};
        $object_type4 = $json->{'facet_counts'}->{'facet_fields'}->{$facetfour};
        $object_type6 = $json->{'facet_counts'}->{'facet_fields'}->{$facetsix};
        
    //copy code arrays
    for($j=0;$j<count($code2);$j=$j+2)
    {
        $out_code2[$code2[$j]]=$code2[$j+1];
    }      
        //  print_r($out_code2);
    for($j=0;$j<count($code4);$j=$j+2)
    {
        $out_code4[$code4[$j]]=$code4[$j+1];
    } 

    //copy text value to array      
    for($j=0;$j<count($object_type2);$j=$j+2)
    {
        $out2[$object_type2[$j]]=$object_type2[$j+1];
    }

    //print_r($out2);

    for($j=0;$j<count($object_type4);$j=$j+2)
    {
        $out4[$object_type4[$j]]=$object_type4[$j+1];
    }
    
    if(count($out2)>0)    
    {
            echo '<li id="forfacet">';
            echo '<div class="content expand collapsiblePanel">';
            echo '<h2><a class="hide">Field of Research</a>';
            echo '</h2>';
            echo '<div>';

    //build FOR tree	
            echo '<ul class="facetTree treeview-red" id="fortree">'; 
                   $out_keys4=array_keys($out4);
                   $out_keys2=array_keys($out2);

                   $out_code_keys4=array_keys($out_code4);

                   $out_code_keys2=array_keys($out_code2);

                    for($i=0;$i< count($out_keys2);$i=$i+1)
                    {  
                        if($out2[$out_keys2[$i]]>0)
                        {
                            if($out_keys2[$i]!=null)
                            {             
                                $index=findFORChildFour($out_code_keys2[$i],$out_code_keys4);

                                if(!checkInFilter($out_keys2[$i],$two))
                                {
                                    //print_r(count($index));
                                    if(count($index)==0)//no child node under 2 digits FOR
                                    { 
                                        echo '<li>
                                                <input type="checkbox" 
                                                        name="twoFOR"
                                                        value="'.$out_keys2[$i].'" 
                                                        class="fortwoFilter'.'" id="'.$out_keys2[$i].'"/><span> '.$out_keys2[$i].' ('.number_format($out2[$out_keys2[$i]]).')'.'</span></li>';
                                    }else//found child
                                    {
                                            echo '<li>
                                                    <input type="checkbox"
                                                            name="twoFOR"
                                                            value="'.$out_keys2[$i].'" 
                                                            class="fortwoFilter'.'" id="'.$out_keys2[$i].'"/><span> '.$out_keys2[$i].' ('.number_format($out2[$out_keys2[$i]]).')</span>';

                                            echo    '<ul>';

                                                        for($k=0;$k<count($index);$k++)
                                                        {

                                                            if(!checkInFilter($out_keys4[$index[$k]],$four)&& $out4[$out_keys4[$index[$k]]]>0)
                                                            {
                                                                echo '<li>

                                                                    <input type="checkbox"
                                                                        name="fourFOR"
                                                                        value="'.$out_keys4[$index[$k]].'" 
                                                                        class="forfourFilter'.'" id="'.$out_keys4[$index[$k]].'"/><span> '.$out_keys4[$index[$k]].' ('.number_format($out4[$out_keys4[$index[$k]]]).')'.'</span>';
                                                                echo '</li>';
                                                            }

                                                        }
                                            echo    '</ul>'; 

                                            echo '</li>'; 
                                        //}
                                    }
                                }
                            }
                        }
                    }

            echo '</ul>';
    //end FOR tree
            //echo '<button id="forbutton" class="buttonSearch srchButton ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">Search</span></button>';
            echo '<a href="javascript:void(0);" id="forbutton" class="greenGradient smallRoundedCorners" >GO</a>';
            echo '</div>';
            echo '</div>';
            echo '<div id="for-help-text" title="'.$help_title.'" class="hide" >'.$help_text.'</div>';
            echo '</li>';

    }

}

function findFORChildFour($twocode,$code_arr4)
{
    $idx=array();
    
    for ($n=0;$n<count($code_arr4);$n++)
    {        
        if((substr($twocode,0,2)==substr($code_arr4[$n],0,2))&& ($twocode!=$code_arr4[$n]))
        {

            $idx[]=$n;
        }
    }

    return $idx;
}

function checkInFilter($word,$filter)
{    
    $r=false;
    for ($n=0;$n<count($filter);$n=$n+2)
    {
        if($word==rtrim($filter[$n],"0"))
        {     
            $r=true;
            return true;
        }
    }
     return $r;
}

function displayPagination($currentPage,$totalPage,$num)
{
        for ($x = $currentPage-1; $x < ($currentPage + $num); $x++) 
        {
            if (($x > 0) && ($x <= $totalPage)) 
            { //if it's valid
                    if($x==$currentPage){//if we're on currentPage
                            //echo '<a class="pagination-page pagination-currentPage">'.$x.'</a>';//don't make a link
                        echo '<span class="currentPageNum">'.$x.'</span>';//don't make a link
                    }else{//not CurrentPage
                            echo '<a href="javascript:void(0);" class="gotoPage" id="'.$x.'">'.$x.'</a>';
                    }
            }              
         }
}

function displayPaginationBackward($currentPage,$totalPage,$num)
{
        for ($x = ($currentPage-$num); $x <=$totalPage; $x++) 
        {
            if (($x > 0) && ($x <= $totalPage)) 
            { //if it's valid
                    if($x==$currentPage){//if we're on currentPage
                            //echo '<a class="pagination-page pagination-currentPage">'.$x.'</a>';//don't make a link
                        echo '<span class="currentPageNum">'.$x.'</span>';//don't make a link
                    }else{//not CurrentPage
                            echo '<a href="javascript:void(0);" class="gotoPage" id="'.$x.'">'.$x.'</a>';
                    }
            }              
         }
}   

function displayFOR($facettwo,$facetfour,$facetsix,$facetfourFilter,$facettwoFilter,$facetsixFilter, $json, $ro_class, $obj,$help_title,$help_text)
{   
    $words=explode(';',$facetfourFilter);
    $four=array();

    foreach($words as $w)
    {
       $four[]=$w;
    }
    
    $wordstwo=explode(';',$facettwoFilter);
    $two=array();

    foreach($wordstwo as $wt)
    {
       $two[]=$wt;
    }
    
    $wordsix=explode(';',$facetsixFilter);
    $six=array();

    foreach($wordsix as $ws)
    {
       $six[]=$ws;
    }    
//code        
        $code2 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_two'};
        $code4 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_four'};
        $code6 = $json->{'facet_counts'}->{'facet_fields'}->{'for_code_six'};
//values
	$object_type2 = $json->{'facet_counts'}->{'facet_fields'}->{$facettwo};
        $object_type4 = $json->{'facet_counts'}->{'facet_fields'}->{$facetfour};
        $object_type6 = $json->{'facet_counts'}->{'facet_fields'}->{$facetsix};

    $base="for08.rdf";

    // Create a new MemModel
    $model = ModelFactory::getDefaultModel();

    // Load and parse document
    $model->load($base);

    $for2=array();//key value pairs for FOR2
    $for4=array();//key value pairs for FOR4
    $for6=array();//key value pairs for FOR6

    $obj2=new Resource(FOR_PREFIX.'FOR2');
    $obj4=new Resource(FOR_PREFIX.'FOR4');
    $obj6=new Resource(FOR_PREFIX.'FOR6');

    $result2=$model->find(NULL,NULL,$obj2);
    $result4=$model->find(NULL,NULL,$obj4);
    $result6=$model->find(NULL,NULL,$obj6);

    //create key/value pairs for FoR2,FoR4 and FoR6
    $for2=buildFoRMap($result2,$model);
    $for4=buildFoRMap($result4,$model);
    $for6=buildFoRMap($result6,$model);

    $forall=array_merge($for2,$for4,$for6);

    echo '<li id="forfacet">';
    echo '<div class="content expand collapsiblePanel">';
    echo '<h2><a class="hide">Field of Research</a>';
    echo '</h2>';
    echo '<div>';
        
    $keys2=array_keys($for2);
    $keys4=array_keys($for4);
    $keys6=array_keys($for6);
    
    echo '<ul class="facetTree treeview-red treeview" id="fortree">';

    for($i=0;$i<count($for2);$i++)
    {          
      $idx=array_search(substr($keys2[$i],strrpos($keys2[$i],'/')+1).'0000',$code2);
 
      if (checkInFilter(substr($keys2[$i],strrpos($keys2[$i],'/')+1),$code2)&& number_format($code2[$idx+1])>0)
      {     
            echo '<li>
                     <input type="checkbox" 
                            name="twoFOR"
                            value="'.mb_strtoupper($for2[$keys2[$i]]).'" 
                            class="fortwoFilter'.'" id="'.$for2[$keys2[$i]].'"/><span> '.mb_strtoupper($for2[$keys2[$i]]).'('.$code2[$idx+1].')</span>';
            findChild($keys2[$i],$model,$forall,'fourFOR','forfourFilter',$keys4,$code4,$keys6,$code6);

            echo '</li>' ;
      }
    }

    echo '</ul>';
    
    echo '<a href="javascript:void(0);" id="forbutton" class="greenGradient smallRoundedCorners" >GO</a>';
    echo '</div>';
    echo '</div>';
    echo '<div id="for-help-text" title="'.$help_title.'" class="hide" >'.$help_text.'</div>';
    echo '</li>'; 
}

function displayGCMD($facet_name, $facetFilter, $json, $ro_class,$help_title,$help_content)
{   
    $words=explode(';',$facetFilter);
    $gcmd=array();

    foreach($words as $w)
    {
       $gcmd[]=$w;
    }    
    
    $gcmd_value = $json->{'facet_counts'}->{'facet_fields'}->{$facet_name};
      
    $tree= array();
    foreach ($gcmd_value as $val)
    {
        $valuePart=explode('-',$val);      
        $subTree=array(array_pop($valuePart));
        foreach (array_reverse($valuePart)as $d)
        {
            $subTree=array($d=>$subTree);
        }
        $tree=array_merge_recursive($tree,$subTree);
    }
    
    foreach($tree as $key=>$value)
    {
        if(is_int($key))
        {
            unset($tree[$key]);
        }
    }
    
    echo '<li id="gcmdfacet">';
    echo '<div class="content expand collapsiblePanel">';
    echo '<h2><a id="testa" class="hide">GCMD</a>';
    echo '</h2>';
    echo '<div>';    
 
    echo '<ul id="gcmdtree"  class="facetTree treeview-red treeview">';

    generateTree($tree,$gcmd_value);
    
    echo '</ul>';
    
    echo '<a href="javascript:void(0);" id="gcmdbutton" class="greenGradient smallRoundedCorners" >GO</a>';
    echo '</div>';
    echo '</div>';
    echo '<div id="gcmd-help-text" title="'.$help_title.'" class="hide" >'.$help_text.'</div>';
    echo '</li>';

 }

 function generateTree($tree,$gcmd_value) 
 {    
     
     $keys=array_keys($tree);
     
     for($s=0;$s<count($keys);$s++)
     {
         echo   '<li>'.
                          '<input type="checkbox" 
                                        name="'.$keys[$s].'"
                                        value="'.$keys[$s].'" 
                                        class="gcmdFilter" id="'.$keys[$s].'"/><span>'.ucwords(strtolower($keys[$s])).'</span>';

         if (count($tree[$keys[$s]])>0)
         {

                createChild($tree[$keys[$s]],$keys[$s],$gcmd_value);

         }         
         echo    '</li>';
     }

 }
 
 function createChild($p,$parent,$gcmd_value)
 {
     echo '<ul>';          
    
     $tmpkey=array_keys($p);
     for($b=0;$b<count($tmpkey);$b++)
     {
         if(is_int($tmpkey[$b]))
         {
             $x=$parent.'-'.$p[$tmpkey[$b]];
             $c=findCount($x,$gcmd_value);
                echo   '<li>'.
                '<input type="checkbox" 
                     name="'.$p[$tmpkey[$b]].'"
                     value="'.$parent.'-'.$p[$tmpkey[$b]].'" 
                      class="gcmdFilter" id="'.$parent.'-'.$p[$tmpkey[$b]].'"/><span>'.ucwords(strtolower($p[$tmpkey[$b]])).'('.$c.')</span>';          
                
                createChild($p[$tmpkey[$b]],$parent.'-'.$p[$tmpkey[$b]],$gcmd_value);
            echo '</li>';
         }else
         {
             //$z=$parent.'-'.$tmpkey[$b];
            // $cnt=findCount($z,$gcmd_value);
            echo   '<li>'.
                '<input type="checkbox" 
                     name="'.$tmpkey[$b].'"
                     value="'.$parent.'-'.$tmpkey[$b].'" 
                     class="gcmdFilter" id="'.$parent.'-'.$tmpkey[$b].'"/><span>'.ucwords(strtolower($tmpkey[$b])).'</span>';
          
                createChild($p[$tmpkey[$b]],$parent.'-'.$tmpkey[$b],$gcmd_value);
            echo '</li>';
         }
          
     }

     echo '</ul>';
 }
 
 function findCount($x,$gcmd_value)
 {
     $key=array_search($x,$gcmd_value);
     
     return $gcmd_value[$key+1];;
 }
//find FoR label by subject uri
function findLabel($model,$subj)
{
    $r=SKOS_PREFIX.'prefLabel';
    $pred=new Resource($r);    

    $result=$model->find($subj,$pred,NULL);
    
    $it = $result->getStatementIterator();
    $l='';
    
    if($it->hasNext())
    {
      $stat=$it->next();
      $l=$stat->getLabelObject();
    }

    return $l;
}

function buildFoRMap($r,$model)
{
    $for=array();
    $it = $r->getStatementIterator();

    while ($it->hasNext()) 
    {
        $statement = $it->next();
        $s=new Resource($statement->getLabelSubject());

        $lbl=findLabel($model,$s);

        $for[$statement->getLabelSubject()]=$lbl;
     }

     return $for;
}

function findChild($sub,$model,$forall,$name,$class,$k,$code,$k6=null,$c6=null)
{
    $res=new Resource($sub);
    $pred=new Resource(SKOS_PREFIX.'narrower');
    $n=$model->find($res,$pred,NULL);

    $iterator=$n->getStatementIterator();
    
        echo '<ul class="forchild">';
    
        while($iterator->hasNext())
        {
            $statement=$iterator->next();
            $ol=$forall[$statement->getLabelObject()];
            
            if($class=='forsixFilter')
            {
                $idx=array_search(substr($statement->getLabelObject(),strrpos($statement->getLabelObject(),'/')+1),$code);
            }
            else if($class=='forfourFilter')
            {
                $idx=array_search(substr($statement->getLabelObject(),strrpos($statement->getLabelObject(),'/')+1).'00',$code);
            }
            
            if (checkInFilter(substr($statement->getLabelObject(),strrpos($statement->getLabelObject(),'/')+1),$code)&& number_format($code[$idx+1])>0)
            {           
                if($class=='forsixFilter')
                {
                     echo '<li> <input type="checkbox" 
                                name="'.$name.'"
                                value="'.$ol.'" 
                                class="'.$class.'" id="'.$ol.'"/><span> '.$ol.'('.$code[$idx+1].')</span>';
                
                     echo '</li>';
                }else
                {
                    echo '<li> <input type="checkbox" 
                                name="'.$name.'"
                                value="'.strtoupper($ol).'" 
                                class="'.$class.'" id="'.$ol.'"/><span> '.$ol.'('.$code[$idx+1].')</span>';
                    findChild($statement->getLabelObject(),$model,$forall,'sixFOR','forsixFilter',$k6,$c6);
                    echo '</li>';
                }
            }
        }
    
       echo'</ul>';    
}

function checkGCMD($gcmd,$gcmdAll)
{
    $flag=false;
   
    $l=count($gcmdAll);
    for($m=0;$m<$l;$m++)
    {
            if(strtoupper(trim($gcmd))==strtoupper(trim($gcmdAll[$m])))
            {
               $flag=true;
            }     
    }    
    return $flag;
}

function findChildGCMD($p,$model)
{
    $pr=new Resource(GCMD.$p);
    $pred=new Resource(SKOS_PREFIX.'narrower');

    $children=$model->find($pr,$pred,NULL);
    $iter=$children->getStatementIterator();
    
    echo '<ul>';
    
    while($iter->hasNext())
    {
        $statement=$iter->next();
        $t=new Resource($statement->getLabelObject());
        
        $temp=$statement->getLabelObject();
        $id=substr($temp,strrpos($temp,'/')+1);

        echo '<li id="'.$id.'" class="gcmdkeyword">';
        echo   '<a>'.findLabel($model, $t).'</a>';
        echo '</li>';
    }

    echo '</ul>';
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