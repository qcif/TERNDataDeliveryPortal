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

<div id="container">
    <div id="ui-layout-center" class="ui-layout-center ">

        <div id="tab" class="firstcolumn">
          
            <div id="random" class="clearfix">
                <?php $this->load->view('tab/random'); ?>

            </div>
        </div>
         <div id="tab2"  class="secondcolumn" >
            <ul>
                <li><a href="#random">Facilities Rollover</a></li>

            </ul>
            <div id="random" class="clearfix">
              
            </div>
        </div>
    </div>
    <div class="ui-layout-west hidden">  Some exciting facilities list to come  
    </div>
    <div class="ui-layout-east hidden"> Some exciting logos to be found here   
    </div>
</div>

<?php $this->load->view('tpl/footer'); ?>



