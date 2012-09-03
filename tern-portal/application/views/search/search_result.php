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
            <?php $this->load->view('search/facet');?> 
        </div>
         <?php  $realNumFound = $json->{'response'}->{'numFound'}; 
                echo '<div id="head-toolbar-content" class="toolbar clearfix">';

                echo '<div id="realNumFound" class="hide">'.($realNumFound).'</div>';


                //echo $this->input->cookie('facets');

                $class='';
                if($this->input->cookie('facets')!=''){
                        if($this->input->cookie('facets')=='yes'){
                                $class='ui-icon-arrowthickstop-1-w';
                        }else{
                                $class='ui-icon-arrowthickstop-1-e';
                        }
                }else{
                        $class='ui-icon-arrowthickstop-1-w';
                }

                echo '<div class="result">';
                echo ''.number_format($realNumFound).' results';
                echo '</div>';
             
                $this->load->view('search/pagination');
       
                echo '</div>';

                ?>          
        <div id="search-results-content" >


                <?php $this->load->view('search/content');?>        

        <?php $this->load->view('tab/widgets/recordpopup');?>
<?php endif;?>