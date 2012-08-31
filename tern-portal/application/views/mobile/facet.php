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
<div data-role="collapsible-set" data-theme="c" data-content-theme="d">
<?php 
if(($spatial_included_ids!='') || ($temporal!='All') || ($typeFilter!='All') || ($groupFilter!='All')||($subjectFilter!='All') || $forFilter!='All')
{
	/*echo '<div class="right-box" data-role="collapsible" >';
	echo '<h2>Selected</h2>';
	echo '<div class="facet-content" >';
		echo '<ul>';
		
		if($typeFilter!='All') displaySelectedFacet4Mobile('type',$typeFilter,$json);
		if($groupFilter!='All') displaySelectedFacet4Mobile('group',$groupFilter,$json);
		if($subjectFilter!='All') displaySelectedFacet4Mobile('subject_value',$subjectFilter,$json);
		echo '</ul>';
	echo '</div>';
	echo '</div>';
         
         */
}

?>

<?php
	/*
	echo '<pre>';
	print_r($json->{'facet_counts'}->{'facet_fields'}->{'group'});
	echo '</pre>';
	
	displayFacet4Mobile('type', $typeFilter, $json, $classFilter, $this);
	displayFacet4Mobile('group', $groupFilter, $json, $classFilter, $this);
	displayFacet4Mobile('subject_value', $subjectFilter, $json, $classFilter, $this);
    	displayFacet4Mobile('for_value_four', $forFilter, $json, $classFilter, $this);
         * 
         */
?>
</div>