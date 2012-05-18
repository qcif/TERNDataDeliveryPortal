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
        <div id="facet-content">
            <h3 class="ui-widget-header"> Facets </h3>
            <?php $this->load->view('search/facet');?> 
        </div>
        <div id="search-results-content" >
                <?php $this->load->view('search/content');?>
        <?php $this->load->view('tab/widgets/recordpopup');?>
<?php endif;?>