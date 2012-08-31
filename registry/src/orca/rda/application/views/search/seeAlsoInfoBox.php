<?php
<<<<<<< HEAD
<<<<<<< HEAD
/**
=======
/** 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
/**
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
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
<<<<<<< HEAD
<<<<<<< HEAD
**/
=======
**/ 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
**/
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
?>
<?php //echo '<pre>';
	//print_r($json);
	//echo '</pre>';?>

<div class="accordion">
<?php
foreach($json->{'response'}->{'docs'} as $r)
{
<<<<<<< HEAD
<<<<<<< HEAD
	echo '<h3><a href="#">'.$r->{'list_title'}.'</a></h3>';
=======
	echo '<h3><a href="#">'.$r->{'listTitle'}.'</a></h3>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	echo '<h3><a href="#">'.$r->{'list_title'}.'</a></h3>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$something = '';
	echo '<div>';
	if(isset($r->{'description_type'})){
		foreach($r->{'description_type'} as $index=>$description_type){
			if($something==''){
				if(($description_type!='rights') && ($description_type!='logo')){
					$something = $r->{'description_value'}[$index];
				}
			}
		}
		echo $something;
		echo '<hr/>';
	}
<<<<<<< HEAD
<<<<<<< HEAD



	if(isset($r->{'subject_type'})){
		echo '<ul class="subjects">';
		foreach($r->{'subject_type'} as $index=>$subject_type){
			echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value_resolved'}[$index].'">'.$r->{'subject_value_resolved'}[$index].'</a></li>';
=======
	
	
	
	if(isset($r->{'subject_type'})){
		echo '<ul class="subjects">';
		foreach($r->{'subject_type'} as $index=>$subject_type){
			echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value'}[$index].'">'.$r->{'subject_value'}[$index].'</a></li>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======



	if(isset($r->{'subject_type'})){
		echo '<ul class="subjects">';
		foreach($r->{'subject_type'} as $index=>$subject_type){
			echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value_resolved'}[$index].'">'.$r->{'subject_value_resolved'}[$index].'</a></li>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		}
		echo '</ul>';
		echo '<hr/>';
	}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if ($r->{'url_slug'})
	{
		echo '<a href="'.base_url().$r->{'url_slug'}.'" class="button">View Record</a>';
	}
	else
	{
		echo '<a href="'.base_url().'view?key='.urlencode($r->{'key'}).'" class="button">View Record</a>';
	}
<<<<<<< HEAD
	//echo anchor('view/?key='.$r->{'key'},'View Record', array('class'=>'button'));
	echo '</div>';

=======
	echo '<a href="'.base_url().'view?key='.urlencode($r->{'key'}).'" class="button">View Record</a>';
	//echo anchor('view/?key='.$r->{'key'},'View Record', array('class'=>'button'));
	echo '</div>';
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	//echo anchor('view/?key='.$r->{'key'},'View Record', array('class'=>'button'));
	echo '</div>';

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}
echo '</div>';
echo '<div class="hide">';
	//$numFound = $json->{'response'}->{'numFound'};
<<<<<<< HEAD
<<<<<<< HEAD
	$numFound = $json->{'response'}->{'numFound'};
=======
	$numFound = $json->{'response'}->{'numFound'};	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$numFound = $json->{'response'}->{'numFound'};
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//print_r($json->{'responseHeader'}->{'params'});
	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row)+1;
	echo '<div id="seeAlsoTotalPage">'.$totalPage.'</div>';
	echo '<div id="seeAlsoCurrentPage">'.$currentPage.'</div>';
?>
</div>
