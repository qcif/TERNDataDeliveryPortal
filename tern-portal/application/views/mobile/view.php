<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php $this->load->view('mobile/tpl/header');?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.6&amp;sensor=false"></script> <!--Google Map v3 from Google-->
<script src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/MapWidget.js"></script> <!-- WIDGET MAP -->
<script type="text/javascript" src="<?php echo base_url();?>js/mobile.js"></script>
<?php
print_r($content);
?> 
<?php $this->load->view('mobile/tpl/footer');?>