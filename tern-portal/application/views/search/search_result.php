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


	<?php if($json):?>
	
	<?php if(($spatial_included_ids!='') && ($this->input->cookie('spatial-info')=='unread')):?>
	<div class="info-message shadow-and-corner" id="spatial-info">
		<p>
			<ul style="text-align:left">
				<li>Spatial search results will be displayed in the results list and on the interactive map.</li>
				<li>Only those objects which have geospatial information associated with them will be returned as results from a Spatial search. Not all metadata Providers include geospatial information with their objects.</li>
				<li>Only the objects that are listed in the current search results view will appear on the map. Choose a results page number or click on '>' to move further down the results list.</li>
			</ul>
		<p><a href="javascript:void(0);" class="disable-info">Don't show this message again</a></p>
	</div>
	<?php endif;?>
	
	<div id="top-tab">
		<div class="clearfix"></div>
	</div>	
	<div id="bottom-content">
		<div id="search-left">
               
			<div>
			<?php $this->load->view('search/facet');?>
			</div>
		</div>

		<div id="search-center" class="shadow-and-corner">
			<div id="search-top">
				<ul id="search-tabs">
	                <?php $this->load->view('search/tabs');?>
				</ul>
				<span id="customise-icon">
					<a href="javascript:void(0);" title="Customise Your Search Results" id="customise-dialog"><img src="<?php echo site_url('img/customise.png');?>" /></a>
				</span>
			</div> 

			<div id="search-result-content" class="bottom-corner">
				<?php $this->load->view('search/content');?>
			</div> 

		
            
		     <?php if($classFilter == 'collection' || $classFilter == 'service' ) { ?>
               
			<?php $this->load->view('search/map');?>
			
                    <?php } ?>
             </div>
		<div class="clearfix"></div>
	</div>
	<?php endif;?>