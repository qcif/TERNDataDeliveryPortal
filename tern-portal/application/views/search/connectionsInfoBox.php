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
<div class="accordion-seealso">
<?php
foreach($json->{'response'}->{'docs'} as $r)
{
	$autoLink = '';	
	if($externalKeys)
		{
			for($j=0;$j<count($externalKeys);$j++)
			{
				if($r->{'key'}==$externalKeys[$j])
				$autoLink = '<span class="faded">(Automatic link)</span>';
			}
		}
<<<<<<< HEAD
	//echo '<h3><a href="#">'.$r->{'listTitle'}.' '.$autoLink.'</a></h3>';
                echo '<h3><a href="#">'.$r->{'list_title'}.' '.$autoLink.'</a></h3>';
=======
	echo '<h3><a href="#">'.$r->{'listTitle'}.' '.$autoLink.'</a></h3>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
	$something = '';
	$logostr = '';
	echo '<div>';
	if(isset($r->{'description_type'})){
		foreach($r->{'description_type'} as $index=>$description_type){
			if($description_type=='logo')
			{
				$logostr = '<div><img id="party_logo"  style="max-width:130px;max-height:63px;" src="'.$r->{'description_value'}[$index].'"/></div>';
			}						
			if($something==''){
	
				if(($description_type=='brief') || ($description_type=='full')){
					$something = $r->{'description_value'}[$index];
				}

			}
		}
		echo $logostr.$something;
		echo '<hr/>';
	}
	
	
	
	if(isset($r->{'subject_type'})){
		echo '<ul class="subjects">';
                 if(is_array($r->{'for_value_six'})){
		 foreach($r->{'for_value_six'} as $index=>$for_value){
			echo '<li><a  href="javascript:void(0);" class="forfourFilter" id="'.$for_value. '" >'.$for_value.'</a></li>';
                        if($index == 9) { echo '<li>...</li>'; break;  }
                }
                }
		foreach($r->{'subject_type'} as $index2=>$subject_type){
                        if($index == 9) { 
                            break;
                        }else{
<<<<<<< HEAD
                            //echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value'}[$index2].'">'.$r->{'subject_value'}[$index2].'</a></li>';
                            echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value_resolved'}[$index2].'">'.$r->{'subject_value_resolved'}[$index2].'</a></li>';
=======
                            echo '<li><a href="javascript:void(0);" class="subjectFilter" id="'.$r->{'subject_value'}[$index2].'">'.$r->{'subject_value'}[$index2].'</a></li>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
                             if(($index + $index2) == 7) { echo '<li>...</li>'; break;  }
                    }
		}
		echo '</ul>';
		echo '<hr/>';
	}
	
	echo anchor('view/dataview?key='.urlencode($r->{'key'}),'View Record', array('class'=>'button','target' => '_blank'));
	echo '</div>';
	
}
echo '</div>';
echo '<div class="hide">';

	$numFound = $json->{'response'}->{'numFound'};	

	$row = $json->{'responseHeader'}->{'params'}->{'rows'};

	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	
	$end = $start + $row;
		
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row) + 1;
	echo '<div id="connectionsTotalPage">'.$totalPage.'</div>';
	echo '<div id="connectionsCurrentPage">'.$currentPage.'</div>';
?>
</div>
