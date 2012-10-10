<!DOCTYPE html><?php
$md_title = 'TERN Data Discovery Portal (Beta Version)';
$md_sub = 'Beta Version - For TERN community use only';
$md_description = 'TERN Data Discovery Portal (Dev Version)is a mesh of searchable web pages describing (and where possible linking to) terrestrial ecosystem research data collections. ';
//$md_image = 'http://services.ands.org.au/home/orca/rda/img/rda-design.png';
if (!isset($title))  $title = $md_title;
if (isset($description))
    $md_description = htmlentities($description);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="<?php echo $md_description; ?>">    
         <script type="text/javascript" src="<?php echo base_url();?>js/modernizr.custom.86191.js"></script> <!-- WIDGET TEMPORAL-->
      
         <link rel="icon" href="<?php echo base_url(); ?>/img/favicon.ico"/>
         
         <link type="text/css" href="<?php echo base_url(); ?>css/tipsy.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/css-reset.css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/print.css" rel="stylesheet" media="print" />
         <link type="text/css" href="<?php echo base_url(); ?>css/treeview.css" rel="stylesheet"/>
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
    </head>
    <body>
        <div id="backgroundImage"></div> 
        <header>
        <div id="wrapper" class="wrapper">
          <!--  <div id="header" >-->
           
             <!--   <div id="logo">-->
             <h1>
                    <a href="http://www.tern.org.au" target="_blank"> 
                        <img src="<?php echo site_url('/img/logos/logo-tern.png'); ?>" alt="TERN Logo" id="tern-logo"/>
                    </a>
             </h1>
             <!--   </div>-->
              <nav id="globalNav">                  
                    <ul class="left sf-menu">
                        <li><?php echo anchor('', 'Home'); ?></li>                     
                        <li><a class="more" href="#">TERN data</a>
                            <div class="subMenu">
                                <ul >
                                    <li><?php echo anchor('home/accessdata', 'Access data', ''); ?></li>
                                    <li><?php echo anchor('home/submitdata', 'Submit data', ''); ?></li>
                                    <li><?php echo anchor('home/licensing', 'Data licensing', ''); ?></li>                      
                                    <li><?php echo anchor('home/infrastructure', 'Infrastructure Locations', ''); ?></li> 
                                </ul> 
                            </div>
                        </li>  
                        <li><?php echo anchor('contact', 'Contact', ''); ?>
                            
                        </li>                       
                    </ul> 
                    <!--ul class="right">
                        <li>
                            <a href="#">
                                <img alt="My Favourites" src="img/icons/icon-my-favourites.png"/>
                                My Favourites
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <img alt="My Searches" src="img/icons/icon-my-favourites.png"/>
                                My Searches
                            </a>
                        </li>
                    </ul-->
              </nav> 
             <img id="dataDiscoveryPortalLogo" alt="Data Discovery Portal" src="/img/logos/logo-datadiscoveryportal.png"/>

         <!--      <div class="no_print top-menu-cover">-->

          <!--      </div>-->
           <!-- </div>-->
        </div>

        </header>    
        <div id="printHeader">
            <h1>
            <a href="#">
            <img src="/img/logos/logo-tern-print.png">
            </a>
            </h1>
            <p>Printed from the TERN Data Discovery portal</p>
       </div>
  <!--      <div class="tmptitle"> <?php //echo $md_sub ?></div>-->
        <div class="wrapper">
        <!--<div class="clearfix"></div>    -->
        <!--<div class="margin10"></div>-->