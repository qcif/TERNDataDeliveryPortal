<?php
$md_title = 'TERN Data Discovery Portal (Beta Version)';
$md_sub = 'Beta Version - For TERN community use only';
$md_description = 'TERN Data Discovery Portal (Dev Version)is a mesh of searchable web pages describing (and where possible linking to) terrestrial ecosystem research data collections. ';
//$md_image = 'http://services.ands.org.au/home/orca/rda/img/rda-design.png';
if (!isset($title))  $title = $md_title;
if (isset($description))
    $md_description = htmlentities($description);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $md_description; ?>" />
        <meta property="og:image" content="<?php echo $md_image; ?>"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <meta http-equiv="x-ua-compatible" content="IE=8"/>
        <meta name="title" content="<?php echo $title; ?>"/>
        <meta name="description" content="<?php echo $md_description; ?>"/>
         
         <link type="text/css" href="<?php //echo base_url(); ?>css/tipsy.css" rel="stylesheet" />
    <!--   <link href="<?php echo base_url(); ?>css/tern-superfish.css" type="text/css" rel="stylesheet"/>
          <link type="text/css" href="<?php //echo base_url(); ?>css/tern.css" rel="stylesheet" />-->
    
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/css-reset.css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/print.css" rel="stylesheet" media="print" />
         <link type="text/css" href="<?php //echo base_url(); ?>css/treeview.css" rel="stylesheet"/>
         
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
                    <a href="#"> 
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
                                    <li><?php echo anchor('home/accessdata', 'Access data', 'target="_blank"'); ?></li>
                                    <li><?php echo anchor('home/submitdata', 'Submit data', 'target="_blank"'); ?></li>
                                    <li><?php echo anchor('home/licencing', 'Data licensing', 'target="_blank"'); ?></li>                      

                                </ul> 
                            </div>
                        </li>  
                        <li><?php echo anchor('contact', 'Contact', ' target="_blank"'); ?>
                            
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
  <!--      <div class="tmptitle"> <?php echo $md_sub ?></div>-->
        <div class="wrapper">
        <!--<div class="clearfix"></div>    -->
        <!--<div class="margin10"></div>-->