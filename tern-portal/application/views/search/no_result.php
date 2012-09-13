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
<div style="padding:10px;">
<?php
	$didyoumean = getDidYouMean($query);

	echo '<p>There is no result for: <b>'.$query.'</b> ';
	if($classFilter!='All')	echo 'with class: <b>'.$classFilter.'</b> ';
	if($typeFilter!='All') echo ' type: <b>'.$typeFilter.'</b> ';
	if($groupFilter!='All') echo ' research group: <b>'.$groupFilter.'</b> ';
	
	echo '</p>';
	
	echo '<p><b>Did You Mean: '.anchor('search#!/q='.$didyoumean.'', $didyoumean).'</b></p>';
	echo '<p>Suggestions:</p>';
	
	/*echo '<pre>';
	print_r($json_tab->{'facet_counts'}->{'facet_fields'}->{'class'});
	echo '</pre>';*/
	
	$object_class = $json_tab->{'facet_counts'}->{'facet_fields'}->{'class'};
                 
  
    $classes = array();// array to stores the class
	for($i=0;$i<sizeof($object_class)-1 ;$i=$i+2){
	    $classes[$object_class[$i]] = $object_class[$i+1];
	}
	//print_r($classes);
?>
<ul>
	<li>Try different keywords</li>
	<li>Make sure all words are spelled correctly</li>
	
</ul>
</div>