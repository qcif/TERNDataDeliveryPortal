<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form id="advancedsrch">
  <div id="advance-keyword-widget" class="hp-left"><?php $this->load->view('tab/widgets/keyword');?></div>
 
  <div id="advance-facility-widget" style="float:right; width:50%"><?php $this->load->view('tab/widgets/facility');?></div>  
 
  <div id="advance-temporal" style="float:left; width:50%"><?php $this->load->view('tab/widgets/temporal');?></div>
  <div id="advance-spatial" style="float:right; width:50%"><?php $this->load->view('tab/widgets/spatial');?></div>
  <div id="advance-researcher-widget" style="float:left; width:50%"><?php $this->load->view('tab/widgets/researcher');?></div>
  <div id="advance-researchfield" style="float:right; width:50%"><?php $this->load->view('tab/widgets/researchfield');?></div>
  <div id="advance-researchtype" style="float:left; width:50%"><?php $this->load->view('tab/widgets/researchtype');?></div>

                    <div id="buttonSearch" >
			<p>
				<button id="search_advanced_a" role="button" aria-disabled="false">Search</button>
				<a href="javascript:void(0);" id="clear_advanced_a">Clear Search</a>
			</p>
                    </div>
 </form>