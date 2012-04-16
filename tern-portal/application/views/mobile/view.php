<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php $this->load->view('mobile/tpl/header');?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> <!--Google Map v3 from Google-->
<script type="text/javascript" src="<?php echo base_url();?>js/mobile.js"></script>
<?php
print_r($content);
?> 
<?php $this->load->view('mobile/tpl/footer');?>