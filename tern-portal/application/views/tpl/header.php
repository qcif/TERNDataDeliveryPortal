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
<html>
<head>
	<title>TERN Data Discovery Portal (Test Version)</title>
	<meta property="og:title" content="TERN Data Discovery Portal (Test Version)" />
	<meta property="og:description" content=" " />
	<meta property="og:image" content="http://services.ands.org.au/home/orca/rda/img/rda-design.png"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="title" content="TERN Data Portal"/>
	<meta name="description" content=" "/>
	
	<link href="<?php echo base_url();?>css/tern-superfish.css" media="screen" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/reset.css" media="reset" type="text/css" rel="stylesheet">
	<link type="text/css" href="<?php echo base_url();?>css/smoothness/jquery-ui-1.8.14.custom.css" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url();?>css/tipsy.css" rel="stylesheet" />
	<link href="<?php echo base_url();?>css/tern.css" type="text/css" rel="stylesheet">
	<link href="<?php echo base_url();?>css/print.css" media="print" type="text/css" rel="stylesheet">	
	
	<?php if ($user_agent=='Internet Explorer'):?>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/ie.screen.css" />
	<?php endif;?>

	<?php if($this->config->item('GA_enabled')):?>
	<script type="text/javascript">
            /*
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-8380487-7']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();*/
	</script>
               
	<?php endif;?>
	 <?php if($tabs==1){ ?>
                 <link href="<?php echo base_url();?>css/jquery.ui.theme.css" media="print" type="text/css" rel="stylesheet">


        <?php } ?>
</head>

<body>   
<div class="hide">TERN Data Discovery Portal (Test Version)</div>
<div id="wrapper">
	<div id="container">
		
		<div id="header" class="no_print">
                    <div id="logo">
			<a href="/"><img src="<?php echo site_url('img/logo.png');?>" id="tern-logo"/></a>
                        
                    </div>
                    
                    <div class="top-menu-cover">

			<ul class="sf-menu">
				<li><?php echo anchor('','Home');?></li>
                                <li><?php echo anchor('http://www.tern.org.au/About-Tern-pg17674.html','About');?></li>
                                <li><?php echo anchor('http://tern.org.au/tern_data_portal_terms_of_use-pg21208.html','Terms of use');?></li>
                                <li><?php echo anchor('http://www.tern.org.au/How-TERN-fits-together-pg17726.html','Facilities');?></li>
				<li><?php echo anchor('http://www.tern.org.au/The-Australian-Terrestrial-Ecosystem-Research-Network-Data-Discovery-Portal-pg17727.html','Contact');?></li>
			</ul>  
                    </div>
                    <br><br><br><br><br><br>
                    <div style="clear:right;text-align: center;"><h1>TERN Data Discovery Portal (Test Version)</h1></div>
		</div>
            
		<div id="customise-dialog-box" class="clearfix hide">
			<p>Show Subjects <?php displayCustomiseOptions('show_subjects');?></p>
			<p>Show Icons <?php displayCustomiseOptions('show_icons');?></p>
			<p>Show Facets <?php displayCustomiseOptions('facets');?></p>
		</div>

