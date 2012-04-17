<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form id="advancedsrchform" onsubmit="return false">
     
        
               
                <div id="spatial-info2" class="hide">
				<ul style="text-align:left">
				<li>To use the spatial search tool, click on 'Start Drawing' at the bottom of the map. Then left-click anywhere on the map, and release your mouse button. Next, drag your mouse and left-click and release again. This will create a rectangular search area on the map. You can use the 'Clear Drawing' button to clear your search area and start again.</li>
				<li>You can use the arrow found on the right hand side of the 'Start Drawing' button to expand the map.</li>
				<li>Spatial search results will be displayed in the results list and on the interactive map.</li>
				<li>Only those objects which have geospatial information associated with them will be returned as results from a Spatial search. Not all metadata Providers include geospatial information with their objects.</li>
				<li>Only the objects that are listed in the current search results view will appear on the map. Choose a results page number or click on '>' to move further down the results list.</li>
				</ul>
		</div>
                <div id="tab-location-text" class="hp-left">
                    <p>
                    <div id="temporal-widget"><?php $this->load->view('tab/widgets/temporal');?></div>
                    </p>
                    <br>
                 
                    <hr width="440">
                    <br> Map tools
                    <br>
                    <div >
				<span id="map-stuff">
					<button id="start-drawing">Start Drawing</button>
					<button id="clear-drawing">Clear Drawing</button>
					 Region: <input type="text" id="address"/>
					Help:<button id="map-info">Info</button>
				</span>
                            	<span id="map-help-stuff"></span>
                    </div>
                    <br>
            
                    <div id="spatial-widget"><?php $this->load->view('tab/widgets/spatial');?></div>   
                    <br>
                    <hr width="440">
<!--                    
                    <p>
                    <div id="state-territory-widget"><?php //$this->load->view('tab/widgets/states-territory');?></div>    
                    </p>
                    <br>
                    <hr width="460">
                    <div id="natural-region-widget"><?php //$this->load->view('tab/widgets/naturalregion');?></div>
-->
                    <div id="buttonSearch" style="position:absolute">
			<p>
				<button id="search_advanced" >Search</button>
				<a href="javascript:void(0);" id="clear_advanced">Clear Search</a>
			</p>
                    </div>
                    
                </div>
		 <div id="" class="hp-right">
			<div id="spatialmap"></div>
<!--                        
                        <div >
				<span id="map-stuff">
					<button id="start-drawing">Start Drawing</button>
					<button id="clear-drawing">Clear Drawing</button>

					<input type="text" id="address"/>
					<button id="map-info">Info</button>
				</span>
                            	<span id="map-help-stuff"></span>
			</div>
-->                
                </div>	
         
 </form>