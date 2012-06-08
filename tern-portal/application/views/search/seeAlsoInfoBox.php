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
<?php //echo '<pre>';
	//print_r($json);
	//echo '</pre>';?>

<div class="accordion">
<?php
foreach($json->{'response'}->{'docs'} as $r)
{
	echo '<h3><a href="#">'.$r->{'listTitle'}.'</a></h3>';
	$something = '';
	echo '<div>';
	if(isset($r->{'description_type'})){
		foreach($r->{'description_type'} as $index=>$description_type){
 
			if($something==''){
				if(($description_type=='brief') || ($description_type=='full')){
					$something = $r->{'description_value'}[$index];
				}
			}
		}
		echo $something;
		echo '<hr/>';
	}
	
	if(isset($r->{'subject_type'})){
		echo '<h4>Keywords</h4><ul class="subjects">';
                if(is_array($r->{'for_value_six'})){
		 foreach($r->{'for_value_six'} as $index=>$for_value){
			echo '<li>'.$for_value.'</a></li>';
                        if($index == 9) { echo '<li>...</li>'; break;  }
                }
                }
		foreach($r->{'subject_type'} as $index2=>$subject_type){
                        if($index == 9) { 
                            break;
                        }else{
                            echo '<li>'.$r->{'subject_value'}[$index2].'</a></li>';
                             if(($index + $index2) == 7) { echo '<li>...</li>'; break;  }
                    }
		}
		echo '</ul>';
		echo '<hr/>';
	}
	echo '<a href="'.base_url().'view/dataview?key='.urlencode($r->{'key'}).'" class="button" target="_blank">View Record</a>';
	//echo anchor('view/?key='.$r->{'key'},'View Record', array('class'=>'button'));
	echo '</div>';
	
}
echo '</div>';
echo '<div class="hide">';
	//$numFound = $json->{'response'}->{'numFound'};
	$numFound = $json->{'response'}->{'numFound'};	
	//print_r($json->{'responseHeader'}->{'params'});
	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	$end = $start + $row;
		
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row)+1;
	echo '<div id="seeAlsoTotalPage">'.$totalPage.'</div>';
	echo '<div id="seeAlsoCurrentPage">'.$currentPage.'</div>';
?>
</div>
