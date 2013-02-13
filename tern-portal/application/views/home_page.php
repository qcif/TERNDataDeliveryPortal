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
?><?php

$this->load->view('tpl/header');
$home = 1;
?>


<?php $this->load->view('tpl/mid'); ?>

<div id="homeContent">
 <div id="page_name" class="hide">Home</div>

</div>
<div id="facilitiesAndDatasets">
     <div id="dialog-confirm" title="Confirm search" class="hide">No search term was entered. Do you want to see ALL records?</div>

     <h1>Browse TERN facilities & datasets</h1>

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
                            echo          '<a href="javascript:void(0);"><img alt="'.$d->{'key'}.'" src="'.$d->{'description_value'}[0].'" id="'.$d->{'key'}.'"/></a>';
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



