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

********************************************************************************
$Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Sep 2011) $
$Revision: 1 $
***************************************************************************
*
**/ 
?>
<?php 
if($mapsearch==0 && ($spatial_included_ids=='') && ($temporal=='All') && ($typeFilter=='All') && ($groupFilter=='All')&&($subjectFilter=='All')&&($fortwoFilter=='All')&&($forfourFilter=='All')&&($forsixFilter=='All') && $ternRegionFilter=='All' && $query=='All Records')
{
        echo '<div id="currentSearchBox" class="box">';
        echo    '<h1 class="orangeGradient">Current Search</h1>';
        echo    '<div class="content">';
        echo        '<ul>';
        echo            '<li class="limit">            
                        <span class="searchTerm"><label class="clearFilter classTerm" id="All Records">'.'All Records'.'</label></span>
                        </li>';
        echo        '</ul>';
        echo        '<div class="buttons">';
        echo            '<a id="clearSearchBtn" class="greyGradient smallRoundedCorners" href="#">Clear Search</a>';
        echo        '</div>';        
        echo    '</div>';
        echo '</div>';
/*    	
        echo '<h5><a href="#">Current Search</a></h5>'; 
	echo '<div id="current-search"  class="facet-list">';
        echo '<ul>';
                 echo '<li class="limit">
                    <label " 
                        class="clearFilter classTerm" id="All Records">'.'All Records'.'</label></li>';
        echo '</ul>';
                echo '<button id="clearall" class="ui-button ui-widget ui-state-default ui-corner-all srchButton ui-button-text-only" role="button" aria-disabled="false">Clear all</button>';
        echo '</div>';  
*/        
             
}
else if(($spatial_included_ids!='') || ($temporal!='All') || ($typeFilter!='All') || ($groupFilter!='All')||($subjectFilter!='All')||($fortwoFilter!='All')||($forfourFilter!='All')||($forsixFilter!='All') || $ternRegionFilter!='All' ||$query!='All Records')    
{
        echo '<div id="currentSearchBox" class="box">';
        echo    '<h1 class="orangeGradient">Current Search</h1>';
        echo    '<div class="content">';
        
        if ($query!='All Records') displaySelectedTerm ($query, $json);
        if($temporal!='All')
        {
            echo '<h2>Dates:</h2>';
            echo '<ul>';
            echo '<li>'.$temporal.'</li>';
            echo '</ul>';
        }
        if($spatial_included_ids!='')
        {
            echo '<h2>Dates:</h2>';
            echo '<ul>';
            echo '<li>Clear Spatial</li>';
            echo '</ul>';
        }
        if($groupFilter!='All') displaySelectedFacet('group',$groupFilter,$json);
        if($ternRegionFilter!='All') displaySelectedRegionFacet('tern_region',$ternRegionFilter,$json,$regionsName);
        if($fortwoFilter!='All') displaySelectedFacet('for_value_two',$fortwoFilter,$json);
        if($forfourFilter!='All') displaySelectedFacet('for_value_four',$forfourFilter,$json);
        echo        '<div class="buttons">';
        echo            '<a id="clearSearchBtn" class="greyGradient smallRoundedCorners" href="#">Clear Search</a>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';
/*    
	echo '<h5><a href="#">Current Search</a></h5>'; 
	echo '<div id="current-search"  class="facet-list">';
		echo '<ul>';
                    if($temporal!='All'){
                            echo '<li><a href="javascript:void(0);" id="" class="clearTemporal clearFilter" title="Search results are restricted to this timeline, Click to remove this filter">'.$temporal.'</a></li>';
                    }
                    if($spatial_included_ids!=''){
                            echo '<li><a href="javascript:void(0);" id="" class="clearSpatial clearFilter" title="Search results are restricted to spatial, Click to remove this filter">Clear Spatial</a></li>';
                    }
                    //if($typeFilter!='All') displaySelectedFacet('type',$typeFilter,$json);
                    if($groupFilter!='All') displaySelectedFacet('group',$groupFilter,$json);

                    //if($subjectFilter!='All') displaySelectedFacet('subject_value',$subjectFilter,$json);
                    if($subjectFilter!='All') displaySelectedFacet('subject_value_resolved',$subjectFilter,$json);
                    if($ternRegionFilter!='All') displaySelectedRegionFacet('tern_region',$ternRegionFilter,$json,$regionsName);

                    if($fortwoFilter!='All') displaySelectedFacet('for_value_two',$fortwoFilter,$json);

                    if($forfourFilter!='All') displaySelectedFacet('for_value_four',$forfourFilter,$json);

                   if($query!='All Records')displaySelectedTerm($query,$json);  

                //   if($forsixFilter!='All') displaySelectedFacet('for_value_six',$forsixFilter,$json);

                echo '</ul>';
                echo '<button id="clearall" class="ui-button ui-widget ui-state-default ui-corner-all srchButton ui-button-text-only" role="button" aria-disabled="false">Clear all</button>';
        echo '</div>';
*/  
}


?>

<?php

    echo '<div id="refineSearchBox" class="box">';
    echo '<h1 class="greenGradient">Search</h1>';
    echo        '<div class="content">';
    echo            '<ul>';
                         $this->load->view('tab/widgets/basicsearch');
         
                         $this->load->view('tab/widgets/temporal');

                         displayRegionFacet('tern_region', $ternRegionFilter, $json, $ternRegionFilter,$regionsName,$help->language['region_helptitle'],$help->language['region_helptext']);
       
                         displayFORFacet('for_value_two','for_value_four','for_value_six',$forfourFilter,$fortwoFilter,$json, $classFilter, $this,$help->language['for_helptitle'],$help->language['for_helptext']);      

                         displayFacilitiesFacet('group', $groupFilter, $json, $classFilter,$help->language['facility_helptitle'],$help->language['facility_helptext']);
    echo            '</ul>'     ;
    echo         '</div>';     
    echo '</div>';
	  
       
?>
