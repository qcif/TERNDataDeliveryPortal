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
if($mapsearch==0 && ($spatial_included_ids=='') && ($temporal=='All') && ($typeFilter=='All') && ($groupFilter=='All')&&($subjectFilter=='All')&&($gcmdFilter=='All')&&($fortwoFilter=='All')&&($forfourFilter=='All')&&($forsixFilter=='All') && $ternRegionFilter=='All' && $query=='All Records')
{
        echo '<div id="currentSearchBox" class="box">';
        echo    '<h1 class="orangeGradient">Current Search</h1>';
        echo    '<div class="content">';
        echo        '<ul>';
        echo            '<li class="limit">            
                        <span class="searchTerm"><label class="classTerm" id="All Records">'.'All Records'.'</label></span> 
                        </li>';
        echo        '</ul>';
        echo        '<div class="buttons">';
        echo            '<a id="saveSearchBtn" class="orangeGradient smallRoundedCorners">Save Search</a>';
        echo            '<a id="clearSearchBtn" class="greyGradient smallRoundedCorners">Clear Search</a>';
        echo        '</div>';        
        echo    '</div>';
        echo '</div>';
      
}
else if(($spatial_included_ids!='') || ($temporal!='All') || ($typeFilter!='All') || ($groupFilter!='All')||($subjectFilter!='All')||($gcmdFilter!='All')||($fortwoFilter!='All')||($forfourFilter!='All')||($forsixFilter!='All') || $ternRegionFilter!='All' ||$query!='All Records')    
{
        echo '<div id="currentSearchBox" class="box">';
        echo    '<h1 class="orangeGradient">Current Search</h1>';
        echo    '<div class="content">';
        
        if ($query!='All Records') displaySelectedTerm ($query, $json);
        if($temporal!='All')
        {
            echo '<h2>Dates:</h2>';
            echo '<ul>';
            echo '<li><span class="clearTemporal clearFilter">'.$temporal.'</span></li>';
            echo '</ul>';
        }
        if($spatial_included_ids!='' || $ternRegionFilter != 'All')
        {
            echo '<h2>Spatial:</h2>';
            echo '<ul>';
            if($spatial_included_ids!='') echo '<li><span class="clearSpatial clearFilter">Spatial search</span></li>';
            if($ternRegionFilter!='All') displaySelectedRegionFacet('tern_region',$ternRegionFilter,$json,$regionsName);
            echo '</ul>';
        }
        if($groupFilter!='All') displaySelectedFacet('group',$groupFilter,$json);
       //display gcmd here
        if($gcmdFilter!='All') displaySelectedFacet('gcmd',$gcmdFilter,$json);
        
        if($fortwoFilter!='All') displaySelectedFacet('for_value_two',$fortwoFilter,$json);
        if($forfourFilter!='All') displaySelectedFacet('for_value_four',$forfourFilter,$json);
        if($forsixFilter!='All') displaySelectedFacet('for_value_six',$forsixFilter,$json);

        echo        '<div class="buttons">';
        echo            '<a id="saveSearchBtn" class="orangeGradient smallRoundedCorners">Save Search</a>&nbsp;';
        echo            '<a id="clearSearchBtn" class="greyGradient smallRoundedCorners">Clear Search</a>';
        echo        '</div>';
        echo    '</div>';
        echo '</div>';

}


?>
<div id="facet-content"> 
<?php


                         $this->load->view('tab/widgets/basicsearch');
         
                         $this->load->view('tab/widgets/temporal');

                         displayRegionFacet('tern_region', $ternRegionFilter, $json, $ternRegionFilter,$regionsName,$help->language['region_helptitle'],$help->language['region_helptext']);
       
//                         displayFORFacet('for_value_two','for_value_four','for_value_six',$forfourFilter,$fortwoFilter,$json, $classFilter, $this,$help->language['for_helptitle'],$help->language['for_helptext']);      
displayFOR('for_value_two','for_value_four','for_value_six',$forfourFilter,$fortwoFilter,$forsixFilter,$json, $classFilter, $this,$help->language['for_helptitle'],$help->language['for_helptext']);
displayGCMD('gcmd',$gcmdFilter,$json,$classFilter,$help->language['facility_helptitle'],$help->language['facility_helptext']);
//      echo '<a id="testa" class="a">GCMD</a>';
displayFacilitiesFacet('group', $groupFilter, $json, $classFilter,$help->language['facility_helptitle'],$help->language['facility_helptext']);
                         
?>
    <div id="gcmdd"></div>
</div>
