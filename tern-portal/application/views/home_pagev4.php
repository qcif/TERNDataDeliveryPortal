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

 * *******************************************************************************
  $Date: 2011-09-06 11:35:57 +1000 (Tue, 06 Sep 2011) $
  $Revision: 1 $
 * **************************************************************************
 *
 * */
?>

<?php

$this->load->view('tpl/header');
$home = 1;
?>


<?php $this->load->view('tpl/mid'); ?>

<div id="homeContent">
 <div id="page_name" class="hide">Home</div>


<!--   
    <div id="ui-layout-center" class="ui-layout-center ">
        <div id="dialog-confirm" title="Confirm search" class="hide">No search term entered. Do you want to see ALL records?</div>
        


               <div id="random"></div>
             
                   

                    <div id="carousel">
                        <div class="clearfix">
                     <div class="prev browse left"></div>
                        <div id="scrollable">  
                           <div class="items" id="items" style="left: 0px; ">                               
                                <img id="auscover" src="../img/auscover.png" height="102" width="194" />
                                <img id="ozflux" src="../img/ozflux.png" height="102" width="194" />
                                <img id="mspn" src="../img/mspn.png" height="102" width="194" />
                                <img id="ausplot" src="../img/ausplot.png" height="102" width="194"/>
                                <img id="ltern" src="../img/ltern.png" height="102" width="194" />
                                <img id="supersite" src="../img/supersite.png" height="102" width="194" />
                                <img id="soil" src="../img/soil.png" height="102" width="194" />
                                <img id="acef" src="../img/acef.png" height="102" width="194" />
                                <img id="aekos" src="../img/aekos.png" height="102" width="194" />
                                <img id="emast" src="../img/emast.png" height="102" width="194" />
                                <img id="aceas" src="../img/aceas.png" height="102" width="194" />
                          </div>
                          </div>
                          <div class="next browse right"></div>
                      </div>
                      </div>  
                    
    </div>
 --> 
    </div>
<div id="facilitiesAndDatasets">
     <div id="dialog-confirm" title="Confirm search" class="hide">No search term entered. Do you want to see ALL records?</div>
    <h1>Browse<br>TERN facilities & datasets</h1>
    <a id="carouselprev" class="prev" href="javascript:void(0);"></a>
    <div id="carouselContainer">
 
 
          <ul>
            <?php 
                if($json && $json->{'response'}->{'docs'}){	
                    foreach($json->{'response'}->{'docs'} as $d)
                    {
                        if($d->{'key'}!="tddp")
                        {
                           echo '<li>';
                            echo          '<img alt="'.$d->{'key'}.'" src="'.$d->{'description_value'}[0].'" id="'.$d->{'key'}.'"/>';
                            echo '</li>';
                        }
                    }	
            } 
            ?>
          </ul>

 
    </div>
    <a id="carouselnext" class="next" href="javascript:void(0);"></a>
</div>

<?php $this->load->view('tpl/footer'); ?>



