<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php $this->load->view('tpl/header');?>
<?php $this->load->view('tpl/mid');?>

<div class="hp-left">
    <h1>Advanced Search </h1>
  <div id="advance-keyword-widget" style="padding-left:5px;padding-bottom: 5px; margin:5px"><?php $this->load->view('tab/widgets/keyword');?></div>

  <hr width="440"/>
  <div id="advance-temporal" style="padding-left:5px;padding-bottom: 5px; margin:5px"><?php $this->load->view('tab/widgets/temporal');?></div>
  <hr width="440"/>
    <div id="advance-for" style="padding-left:5px;padding-bottom: 5px; margin:5px"><?php $this->load->view('tab/widgets/researchfield');?></div>
  <hr width="440"/>

  <div id="advance-facility-widget" style="padding-left:5px;padding-bottom: 5px; margin:5px" ><?php $this->load->view('tab/widgets/facility');?></div>  
  <hr width="440"/>
  <!--<div id="advance-researcher-widget"><?php //$this->load->view('tab/widgets/researcher');?></div>
  <div id="advance-researchfield"><?php //$this->load->view('tab/widgets/researchfield');?></div>-->
  <!--<div id="advance-researchtype" ><?php //$this->load->view('tab/widgets/researchtype');?></div>-->
  <div  ><?php $this->load->view('tab/widgets/buttonsearch');?></div>
   </div>

<div class="hp-right">
    <?php if($widget_map) { ?> 
     <div id="advanced-location-map" > 
		    <?php $this->load->view('tab/widgets/mapLayers');?>
                </div>
                <div id="spatial-info2" class="hide">
				<ul style="text-align:left">
				<li>To use the spatial search tool, click on 'Start Drawing' at the bottom of the map. Then left-click anywhere on the map, and release your mouse button. Next, drag your mouse and left-click and release again. This will create a rectangular search area on the map.</li>
				<li>You can use the arrow found on the right hand side of the 'Start Drawing' button to expand the map.</li>
				<li>Spatial search results will be displayed in the results list and on the interactive map.</li>
				<li>Only those objects which have geospatial information associated with them will be returned as results from a Spatial search. Not all metadata Providers include geospatial information with their objects.</li>
				<li>Only the objects that are listed in the current search results view will appear on the map. Choose a results page number or click on '>' to move further down the results list.</li>
				</ul>
		</div>
    <?php } ?>
</div>

 <?php $this->load->view('tpl/footer');?>
