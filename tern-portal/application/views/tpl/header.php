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
***************************************************************************
*
**/ $md_title = 'TERN Data Discovery Portal (Test Version)';
	$md_description = 'TERN Data Discovery Portal (Test Version)is a mesh of searchable web pages describing (and where possible linking to) terrestrial ecosystem research data collections. ';
	//$md_image = 'http://services.ands.org.au/home/orca/rda/img/rda-design.png';
if(isset($title))$md_title = $title .' - TERN Data Discovery Portal';
	if(isset($description))$md_description = htmlentities($description);
        
?>
<html>
<head>
	<title><?php echo $md_title;?></title>
	<meta property="og:title" content="<?php echo $md_title;?>" />
	<meta property="og:description" content="<?php echo $md_description;?>" />
	<meta property="og:image" content="<?php echo $md_image;?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	
	<meta name="title" content="<?php echo $md_title;?>"/>
	<meta name="description" content="<?php echo $md_description;?>"/>
	
	<link href="<?php echo base_url();?>css/tern-superfish.css" type="text/css" rel="stylesheet"/>
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
            
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', '<?php echo $this->config->item('GA_code');?>']);
            _gaq.push(['_setDomainName', '<?php echo $this->config->item('GA_domain_name');?>']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
               
	<?php endif;?>
	 <?php if($tabs==1){ ?>
                 <link href="<?php echo base_url();?>css/jquery.ui.theme.css" media="print" type="text/css" rel="stylesheet">


        <?php } ?>
</head>

<body>   
<div class="hide"><?php echo $md_title;?></div>
<div id="wrapper">
	<div id="container">
		
		<div id="header" >
                    <div id="logo">
			<a href="/"><img src="<?php echo site_url('img/logo.png');?>" id="tern-logo"/></a>
                        
                    </div>
                    
                    <div class="no_print top-menu-cover">

			<ul class="sf-menu">
				<li><?php echo anchor('','Home');?></li>
                                <li><?php echo anchor('http://www.tern.org.au/About-Tern-pg17674.html','About');?></li>
                                <li><?php echo anchor('http://tern.org.au/tern_data_portal_terms_of_use-pg21208.html','Terms of use');?></li>
                                <li><?php echo anchor('http://www.tern.org.au/How-TERN-fits-together-pg17726.html','Facilities');?></li>
				<li><?php echo anchor('http://www.tern.org.au/The-Australian-Terrestrial-Ecosystem-Research-Network-Data-Discovery-Portal-pg17727.html','Contact');?></li>
			</ul>  
                    </div>
                    <br><br><br><br><br><br>
                    <div ><h1>TERN Data Discovery Portal (Test Version)</h1></div>
		</div>
            
		<div id="customise-dialog-box" class="clearfix hide no_print" >
			<p>Show Subjects <?php displayCustomiseOptions('show_subjects');?></p>
			<p>Show Icons <?php displayCustomiseOptions('show_icons');?></p>
			<p>Show Facets <?php displayCustomiseOptions('facets');?></p>
		</div>

