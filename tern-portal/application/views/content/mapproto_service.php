<?php


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link type="text/css" href="<?php echo base_url(); ?>css/tern.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <style >
          .olPopup { border : 0 !important;}


            </style> 
  </head>
    <body>
     

<div id="overlaymap" style="width:430px;margin:auto;">

    <div id="spatialmap" class=""></div>
   
</div>
         
         <div id="results"></div>
        <script type="text/javascript">
  		var base_url = "<?php echo base_url(); ?>";
  		var secure_base_url = "<?php echo getHTTPs(base_url());?>";
		var service_url = "<?php echo service_url();?>";
	</script>
   <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script> <!-- jQuery UI-->
    	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.6&amp;sensor=false"></script> <!--Google Map v3 from Google-->
        <script  type="text/javascript" src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>js/mapProto_service.js"></script>  
       <script type="text/javascript" src="<?php echo base_url();?>js/MapWidget.js"></script> <!-- WIDGET MAP -->
       
       </body>
</html>
