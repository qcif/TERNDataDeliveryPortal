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
	
	$numFound = $json->{'response'}->{'numFound'};
	$timeTaken = $json->{'responseHeader'}->{'QTime'};
	$timeTaken = $timeTaken / 1000;
	
	$row = $json->{'responseHeader'}->{'params'}->{'rows'};
	$start = $json->{'responseHeader'}->{'params'}->{'start'};
	//$query = $json->{'responseHeader'}->{'params'}->{'q'};
	$end = $start + $row;
	
	$h_start = $start + 1;
	$h_end = $end + 1;
	
	if ($h_end > $numFound) $h_end = $numFound;
	
	$totalPage = ceil($numFound / $row);
	$currentPage = ceil($start / $row)+1;
<<<<<<< HEAD
<<<<<<< HEAD
	$nextPage = $currentPage + 1;
	$prevPage = $currentPage - 1;

=======
	
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
	$nextPage = $currentPage + 1;
	$prevPage = $currentPage - 1;

>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	$range = 3;
?>
<?php
	echo '<div class="pagination">';
			//echo '<a href="javascript:void(0);" id="prev">Previous Page</a> <a href="javascript:void(0);" id="next">Next Page</a>';
			//echo '<p>Searching for \'<b>'.$query.'</b>\' - Results '.$h_start.' to '.$h_end.' of '.$numFound.' (Took '.$timeTaken.' seconds) Current Page: '.$currentPage.' out of '.$totalPage.' pages</p>';
			//echo '<p> Query = '.$query.' classFilter= '.$classFilter.' typeFilter= '.$typeFilter.' groupFilter= '.$groupFilter.'</p>';
	
	echo 'Page: '.$currentPage.'/'.$totalPage.'   |  ';
	
	//if not on page 1, show Previous
	echo '<a href="javascript:void(0);" id="1" class="gotoPage">First</a>';
	if($currentPage > 1){
<<<<<<< HEAD
<<<<<<< HEAD
		echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$prevPage.'"> &lt;</a>';
=======
		echo '<a href="javascript:void(0);" id="prev" class="pagination-page"> &lt;</a>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$prevPage.'"> &lt;</a>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	
	for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
		if (($x > 0) && ($x <= $totalPage)) { //if it's valid
			if($x==$currentPage){//if we're on currentPage
				echo '<a class="pagination-page pagination-currentPage">'.$x.'</a>';//don't make a link
			}else{//not CurrentPage
				echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$x.'">'.$x.'</a>';
			}
		}
	}
	
	//if not on last page, show Next
	if($currentPage < $totalPage){
<<<<<<< HEAD
<<<<<<< HEAD
		echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$nextPage.'">&gt;</a>';
=======
		echo '<a href="javascript:void(0);" id="next" class="pagination-page">&gt;</a>';
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
=======
		echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$nextPage.'">&gt;</a>';
>>>>>>> ef76189ad3c78fcd6a06e682eda24debb302212f
	}
	
	echo '<a href="javascript:void(0);" id="'.$totalPage.'" class="gotoPage">Last</a>';
	
	//echo '<a href="javascript:void(0);" id="prev">Previous Page</a> <a href="javascript:void(0);" id="next">Next Page</a>';
	echo '</div>';
?>