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

                    <div id="searchFeatures">
                        <span id="slogan">Delivering open access to Australia's terrestrial ecosystem data</span>
                        <input class="rounded" id ="search-box" title="Search ecosystem data" type="text" name="query" placeholder="Search ecosystem data" >
                        <a id="searchBtn" class="orangeGradient roundedCorners">
                            <img alt="Search" src="img/icons/icon-search.png"> 
                            Search
                        </a>
                        <!--img id="orImg" alt="Or" src="img/home/or.png"-->        
                        <div id="orImg" style="width:74px;"></div>
                        <div id="mapBasedSearchTxt">
                            <span id="mapBasedSearchTitle">Map Based Search</span>
                            <span id="mapBasedSearchDescription">Use our map interface to search for data</span>
                        </div>
                        <a id="mapSearchBtn" class="greenGradient roundedCorners">
                            <img alt="Map Search" src="img/icons/icon-australia.png">
                            Map Search
                        </a>
                                    
		</div>

                <?php } ?> 
