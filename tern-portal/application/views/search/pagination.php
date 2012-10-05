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
	
        if($row > 0 ){
            $totalPage = ceil($numFound / $row);
            $currentPage = ceil($start / $row)+1;
        }
	$range = 2;
?>
<?php
        echo '<div id="right_pagination" class="pagination right">';
        echo        '<div class="currentPageText">';
        echo            'Page:';
        echo            '<span class="currentPage">'.$currentPage.'</span>';
        echo            'of';
        echo            '<span class="totalPages">'.$totalPage.'</span>';
        echo        '</div>';
        
        echo '<a href="javascript:void(0);" id="1" class="firstBtn gotoPage">First</a>';
        if($currentPage > 1)
        {
            echo '<a href="javascript:void(0);" id="prev" class="prevBtn">Previous</a>';
        }
        	for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) 
                {
                    if (($x > 0) && ($x <= $totalPage)) 
                    { //if it's valid
                            if($x==$currentPage){//if we're on currentPage
                                    //echo '<a class="pagination-page pagination-currentPage">'.$x.'</a>';//don't make a link
                                echo '<span class="currentPageNum">'.$x.'</span>';//don't make a link
                            }else{//not CurrentPage
                                    echo '<a href="javascript:void(0);" class="gotoPage" id="'.$x.'">'.$x.'</a>';
                            }
                    }              
                 }
        if($currentPage < $totalPage)
        {                 
            echo '<a href="javascript:void(0);" id="next" class="nextBtn">Next</a>'; 
        }
        
	echo '<a href="javascript:void(0);" id="'.$totalPage.'" class=" lastBtn gotoPage">Last</a>';        
        echo '</div>';
/*
	echo '<div id="right_pagination" class="pagination right">';

	
	echo '<div class="pagination-currentPageInfo pagination-currentPage">Page: '.$currentPage.' of '.$totalPage.'</div> |  ';
	
	//if not on page 1, show Previous
	echo '<a href="javascript:void(0);" id="1" class="gotoPage">First </a>';
	if($currentPage > 1){
		echo '<a href="javascript:void(0);" id="prev" class="pagination-page"> &lt;</a>';
	}
	
	for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
		if (($x > 0) && ($x <= $totalPage)) 
                { //if it's valid
			if($x==$currentPage){//if we're on currentPage
				//echo '<a class="pagination-page pagination-currentPage">'.$x.'</a>';//don't make a link
                            echo '<b>'.$x.'</b>';//don't make a link
			}else{//not CurrentPage
				echo '<a href="javascript:void(0);" class="pagination-page gotoPage" id="'.$x.'">'.$x.'</a>';
			}
		}                   
                
	}
	
	//if not on last page, show Next
	if($currentPage < $totalPage){
		echo '<a href="javascript:void(0);" id="next" class="pagination-page">&gt;</a>';
	}
	
	echo '<a href="javascript:void(0);" id="'.$totalPage.'" class="gotoPage">Last</a>';
	
	//echo '<a href="javascript:void(0);" id="prev">Previous Page</a> <a href="javascript:void(0);" id="next">Next Page</a>';
	echo '</div>';
 
 */
?>