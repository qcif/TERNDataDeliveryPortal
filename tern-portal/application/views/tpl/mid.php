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
$Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Se p 2011) $
$Revision: 1 $
***************************************************************************
*
**/ 
?>
		<?php
          
			if(!isset($search_term))
			{
				$search_term='';
			}else{
				$search_term = urldecode(rawurldecode($search_term));
			}
              
		?>
                <?php if($home==1){ ?>
		<div id="mid" class="clearfix">
			
			<div id="search-bar">
				
				<div id="search-wrapper" class="clearfix">
					<div class="ui-widget left-align"><input class="searchbox" id ="search-box" title="Search ecosystem data" type="text" name="query" ></div>
					<button class="searchbox_submit" id="search-button" title="Search Research Data Australia">Search</button>
<!--					
                                        <img src="<?php //echo base_url();?>img/delete.png" id="clearSearch" class="hide" title="Clear Search"/>
					<img src="<?php //echo base_url();?>img/ajax-loader.gif" id="loading" class="hide"/>
-->
				</div>
				
			</div>                  
			<div id="placeholder">				
				<p><?php echo anchor('search','Advanced Search');?></p>
			</div>

		</div>
                <?php } ?> 

<!--
<div id="classSelectDiv" class="hide">
    	<select id="classSelect">
		<option value="collection" selected="selected"></option>
	</select>
</div>
-->		<?php
//			if($this->input->cookie('advanced-search')!=''){
//				if($this->input->cookie('advanced-search')=='open'){
                                 
//					$class='';
//				}else{
//					$class='hide';
//				}
//			}else{
//				$class='hide';
//			}
		?>
 <!-- 
		<div id="advanced" class="clearfix hide">
                  
			<div id="advanced-spatial">
				<div id="spatialmap"></div>
				<div class="ui-widget-header">
				<span id="map-stuff">
					<button id="start-drawing">Start Drawing</button>
					<button id="clear-drawing">Clear Drawing</button>
					<button id="expand">Expand</button>
					<button id="collapse">Collapse</button>
					<input type="text" id="address"/>
					<button id="map-info">Info</button>
				</span>
					
					<span id="map-help-stuff">
						
					</span>
				</div>
			</div>
			<div id="spatial-info2" class="hide">
				<ul style="text-align:left">
				<li>To use the spatial search tool, click on 'Start Drawing' at the bottom of the map. Then left-click anywhere on the map, and release your mouse button. Next, drag your mouse and left-click and release again. This will create a rectangular search area on the map. You can use the 'Clear Drawing' button to clear your search area and start again.</li>
				<li>You can use the arrow found on the right hand side of the 'Start Drawing' button to expand the map.</li>
				<li>Spatial search results will be displayed in the results list and on the interactive map.</li>
				<li>Only those objects which have geospatial information associated with them will be returned as results from a Spatial search. Not all metadata Providers include geospatial information with their objects.</li>
				<li>Only the objects that are listed in the current search results view will appear on the map. Choose a results page number or click on '>' to move further down the results list.</li>
				</ul>
			</div>

-->			
<!--	
			<div id="advanced-text" style="position:absolute">
                            <div id="selectObj" style="position:absolute">

				<p><b>Find </b>
					<select id="classSelect">
						<option value="All" selected="selected">All Records</option>
						<option value="collection">Research Data</option>
						<option value="party">People</option>
						<option value="service">Research Systems</option> 
						<option value="activity">Projects</option>
					</select>
				that have:</p>
                                <img src="<?php //echo base_url();?>img/delete.png" id="close_advanced"/>
                            </div>
-->
<!--	

                            <div id="all" style="position:relative">                                
				<p><label>All of these words:</label><input class="search-input long" id="advanced-all" type="text" value=""/></p>
				<p><label title="You can do this in standard search by surrounding your phrase with quotes">This exact phrase:</label><input class="search-input long" id="advanced-exact" type="text" value=""/></p>
				<p><label title="You do this in standard search by typing OR between your alternate words.">One or more of these words:</label> <input class="search-input short" id="advanced-or1" type="text" value=""/> OR <input class="search-input short" id="advanced-or2" type="text" value=""/> OR <input class="search-input short" id="advanced-or3" type="text" value=""/></p>
				<p><label title="You can do this in standard search by adding a - (minus sign) to the beginning of the word you don't want.">But not these words:</label><input class="search-input long" id="advanced-not" type="text" value=""/></p>
				<p><img src="<?php //echo base_url();?>/img/no.png" id="show-temporal-search" title="toggle to enable/disable temporal search"/> Restrict temporal range</p>
				<div id="temporal-search">
				<p><b>In the range:</b></p>
				<!-- <p>From: <input class="short" id="dateFrom" type="text" value="1544" title="a year from 1544 to 2011"/> To: <input class="short" id="dateTo" type="text" value="2011" title="a year from 1544 to 2011"/></p>-->

<!--
				<p>From: 
				<select id="dateFrom">
					<?php 
						//for($i=$min_year;$i<$max_year;$i++){
						//	echo '<option value="'.$i.'">'.$i.'</option>';
						//}
					?>
				</select>
				To: 
				<select id="dateTo">
					<?php 
						//for($i=$max_year;$i>$min_year;$i--){
						//	echo '<option value="'.$i.'">'.$i.'</option>';
						//}
					?>
				</select>
                                <div id="min_year" class="hide"><?php //echo $min_year;?></div>
                                <div id="max_year" class="hide"><?php //echo $max_year;?></div>
				<div id="date-slider"></div>
				<div class="clearfix"></div>
				</div>
                            </div>   
                            <div id="buttonSearch" style="position:absolute">
				<p>
					<button id="search_advanced" >Search</button>
					<a href="javascript:void(0);" id="clear_advanced">Clear Search</a>
				</p>
                            </div>
			</div>
			 
			<div class="clearfix"></div>


		</div>
-->	


                 <?php //if($tabs==1){ ?>
<!--
<h3>Browse by </h3>
-->
                  <?php //} ?>
<!--
                <div class="border">
   -->   
		<?php
                //if($tabs==1){ ?> 

<!--
                    <div id="content" class="clearfix">
                    <ul>
                        <li><a href="#location">Location & time</a></li>
                        <li><a href="#for">Fields of Research</a></li>
                         <li><a href="#datatype">Data type</a></li>
-->
<!--                        <li><a href="#advancedsrch">Advanced search</a></li> -->
<!--
                    </ul>
  -->            
                 <?php // } else { ?>
   <!--               <div id="content" class="clearfix">-->
                 <?php //} ?>
