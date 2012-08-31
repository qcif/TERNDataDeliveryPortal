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
<div class="accordion">
<?php
foreach($json->{'response'}->{'docs'} as $r)
{
<<<<<<< HEAD
<<<<<<< HEAD
	$autoLink = '';
=======
	$autoLink = '';	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$autoLink = '';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	if($externalKeys)
		{
			for($j=0;$j<count($externalKeys);$j++)
			{
				if($r->{'key'}==$externalKeys[$j])
				$autoLink = '<span class="faded">(Automatic link)</span>';
			}
		}
<<<<<<< HEAD
<<<<<<< HEAD
	echo '<h3><a href="#">'.$r->{'list_title'}.' '.$autoLink.'</a></h3>';
=======
	echo '<h3><a href="#">'.$r->{'listTitle'}.' '.$autoLink.'</a></h3>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	echo '<h3><a href="#">'.$r->{'list_title'}.' '.$autoLink.'</a></h3>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$something = '';
	$logostr = '';
	echo '<div>';
	if(isset($r->{'description_type'})){
		foreach($r->{'description_type'} as $index=>$description_type){
			if($description_type=='logo')
			{
				$logostr = '<div><img id="party_logo"  style="max-width:130px;max-height:63px;" src="'.$r->{'description_value'}[$index].'"/></div>';
<<<<<<< HEAD
<<<<<<< HEAD
			}
			if($something==''){

=======
			}						
			if($something==''){
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
			}
			if($something==''){

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
				if(($description_type!='rights') && ($description_type!='logo')){
					$something = $r->{'description_value'}[$index];
				}

			}
		}
		echo $logostr.$something;
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
		echo anchor($r->{'url_slug'},'View Record', array('class'=>'button'));
	}
	else
	{
		echo anchor('view/?key='.urlencode($r->{'key'}),'View Record', array('class'=>'button'));
	}
<<<<<<< HEAD
	echo '</div>';

=======
	
	echo anchor('view/?key='.urlencode($r->{'key'}),'View Record', array('class'=>'button'));
	echo '</div>';
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	echo '</div>';

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
}
echo '</div>';
echo '<div class="hide">';

<<<<<<< HEAD
<<<<<<< HEAD
	$numFound = $json->{'response'}->{'numFound'};
=======
	$numFound = $json->{'response'}->{'numFound'};	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$numFound = $json->{'response'}->{'numFound'};
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};

	$start = $json->{'responseHeader'}->{'params'}->{'start'};
<<<<<<< HEAD
<<<<<<< HEAD

	$end = $start + $row;

=======
	
	$end = $start + $row;
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

	$end = $start + $row;

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row) + 1;
	echo '<div id="connectionsTotalPage">'.$totalPage.'</div>';
	echo '<div id="connectionsCurrentPage">'.$currentPage.'</div>';
?>
</div>
