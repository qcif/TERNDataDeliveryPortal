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
<?php $this->load->view('tpl/header');
$home=1;
?>


    <?php $this->load->view('tpl/mid');?>
<?php
	/*$partners = array();
	$keys = array();
 	foreach($json->{'response'}->{'docs'} as $d){
		$key = $d->{'key'};
		$keys[] = $key;
		foreach($d->{'description_type'} as $index=>$type){
			if($type=='logo') $partners[$key]['logo']=$d->{'description_value'}[$index];
			if($type=='full' || $type=='brief') {
				$partners[$key]['full']='<h3><a href="search#!/q='.str_replace('-','',trim($d->{'displayTitle'})).'/tab=collection">'.$d->{'displayTitle'}.'</a></h3>'
											.'<p><a href="'.trim($d->{'location'}[0]).'" title="Visit Partner Portal">'.$d->{'location'}[0].'</a></p>'
											.$d->{'description_value'}[$index];
			}
			$partners[$key]['url']=$d->{'location'}[0];
		}
	}*/
?>
<div id="infoBox"  class="hide"></div>
<div id="loadingScreen"  class="hide"></div>

<div id="location">

        <?php $this->load->view('tab/coverage');?>

</div>

<div id="for">
  <?php $this->load->view('tab/for');?>
</div>
<!--
<div id="datatype">
  <?php $this->load->view('tab/datatype');?>
</div>


<div id="advancedsrch">

            <?php //$this->load->view('tab/advancedsrch');?>

</div>
-->

<?php $this->load->view('tpl/footer');?>



