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
<?php //print_r($json);?>
<?php if($json):?>
<?php
<<<<<<< HEAD
<<<<<<< HEAD

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//$numFound = $json->{'response'}->{'numFound'};
	$numFound = $json->{'response'}->{'numFound'};
	$timeTaken = $json->{'responseHeader'}->{'QTime'};
	$timeTaken = $timeTaken / 1000;
<<<<<<< HEAD
<<<<<<< HEAD

	//print_r($json->{'responseHeader'}->{'params'});

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;

	$h_start = $start + 1;//human start
	$h_end = $end + 1;//human end

	if ($h_end > $numFound) $h_end = $numFound;

=======
	
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	//print_r($json->{'responseHeader'}->{'params'});

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;

	$h_start = $start + 1;//human start
	$h_end = $end + 1;//human end

	if ($h_end > $numFound) $h_end = $numFound;
<<<<<<< HEAD
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row)+1;
	$orca = $this->config->item('orca');
?>
<div>
	<?php if($numFound >0 ):?>
	<div class="resultListHeader">
		<?php echo ''.$numFound.' results ('.$timeTaken.' seconds)';?>
	</div>
	<div class="resultListFooter">
	<?php $this->load->view('search/pagination');?>
	</div>
<<<<<<< HEAD
<<<<<<< HEAD
	<?php
=======
	<?php 
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	<?php
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	foreach($json->{'response'}->{'docs'} as $r)
	{
		//print_r($r);
		$type = $r->{'type'};
		$ro_key = $r->{'key'};
<<<<<<< HEAD
<<<<<<< HEAD
		$name = $r->{'list_title'};
=======
		$name = $r->{'listTitle'};
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		$name = $r->{'list_title'};
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$class = $r->{'class'};
		$group = $r->{'group'};
		$status = $r->{'status'};
		$ds = $r->{'data_source_key'};
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		echo '<a href="'.$this->config->item('orca_view_point').'?key='.urlencode($ro_key).'">'.$name.'</a> <br/>';
		echo '<span class="resultListItemLabel">Status: </span><span style="color: #ffffff; background-color: #32CD32; border: 1px solid #888888; padding-left: 2px; padding-right: 2px;">'.$status.' </span><br/>';
		//echo '<span class="resultListItemLabel">Class: </span>'.$class.' <br/>';
		echo '<span class="resultListItemLabel">Type: </span>'.$type.' <br/>';
		echo '<span class="resultListItemLabel">Data Source Key: </span>'.$ds.' <br/>';
		echo '<span class="resultListItemLabel">Group: </span>'.$group.' <br/>';
<<<<<<< HEAD
<<<<<<< HEAD

		$descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
		$description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};

=======
		
		$descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
		$description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

		$descriptions = array();if(isset($r->{'description_value'})) $descriptions = $r->{'description_value'};
		$description_type=array();if(isset($r->{'description_type'})) $description_type = $r->{'description_type'};

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$relations = array();
		if(isset($r->{'relatedObject_relation'})){
			$relations = $r->{'relatedObject_relation'};
			$related_name = $r->{'relatedObject_relatedObjectListTitle'};
			$related_key = $r->{'relatedObject_key'};
			echo '<span class="resultListItemLabel">Relations: </span> ';
			foreach($relations as $key=>$relation){
				echo '<a href="'.$orca.'view.php?key='.urlencode($related_key[$key]).'">'.$related_name[$key].'</a> | ';
			}
			echo '<br/>';
		}
<<<<<<< HEAD
<<<<<<< HEAD

=======
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		$subjects=array();$subjects_type=array();
		if(isset($r->{'subject_value'})){
			$subjects = $r->{'subject_value'};
			$subjects_type = $r->{'subject_type'};
			echo '<span class="resultListItemLabel">Subjects: </span> ';
			foreach($subjects_type as $key=>$t){
				echo '<span class="attribute">'.$t.'</span> '.'<a href="#" class="subjectFilter" name="'.$subjects[$key].'">'.$subjects[$key].'</a> ';
			}
			echo '<br/>';
		}
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f


		echo '<span class="resultListItemLabel">Descriptions: </span>';

<<<<<<< HEAD
		foreach($description_type as $key=>$t){
			echo '<span class="attribute">'.$t.'</span>:'.strip_tags(htmlspecialchars_decode(($descriptions[$key]))).'<br/>';
		}

=======
		
		
		echo '<span class="resultListItemLabel">Descriptions: </span>';		
		
		foreach($description_type as $key=>$t){
			echo '<span class="attribute">'.$t.'</span>:'.strip_tags(htmlspecialchars_decode(($descriptions[$key]))).'<br/>';
		}
		
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		foreach($description_type as $key=>$t){
			echo '<span class="attribute">'.$t.'</span>:'.strip_tags(htmlspecialchars_decode(($descriptions[$key]))).'<br/>';
		}

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
		echo '<hr/>';
	}
	?>
	<div class="resultListFooter">
	<?php $this->load->view('search/pagination');?>
	</div>
	<?php else:?>
	<div class="resultListHeader">
<<<<<<< HEAD
<<<<<<< HEAD
		No results found!
=======
		No result found!
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		No results found!
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	</div>
	<?php endif;?>
</div>
<?php endif;?>