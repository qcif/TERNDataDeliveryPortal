<!DOCTYPE html><?php
$md_title = 'TERN Data Discovery Portal (Beta Version)';
$md_sub = 'Beta Version - For TERN community use only';
$md_description = 'TERN Data Discovery Portal (Dev Version)is a mesh of searchable web pages describing (and where possible linking to) terrestrial ecosystem research data collections. ';
//$md_image = 'http://services.ands.org.au/home/orca/rda/img/rda-design.png';
if (!isset($title))  $title = $md_title;
if (isset($description))
    $md_description = htmlentities($description);
$number = mt_rand(1,3);
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="description" content="<?php echo $md_description; ?>">    
       
         <link rel="icon" href="<?php echo base_url(); ?>/img/favicon.png"/>
       <script type="text/javascript" src="<?php echo base_url();?>js/modernizr.custom.87481.js"></script> 
          
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/css-reset.css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/main.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/print.css" rel="stylesheet" media="print" />
         <link type="text/css" href="<?php echo base_url(); ?>css/treeview.css" rel="stylesheet"/>         
    </head>
    <body>
        <div id="backgroundImage<?php echo $number;?>"></div> 
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
                                    <li class="last-child"><?php echo anchor('home/infrastructure', 'Research Infrastructure', ''); ?></li> 
                                </ul> 
                            </div>
                        </li>  
                        <li class="last-child"><?php echo anchor('contact', 'Contact', ''); ?>
                            
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
             <img id="dataDiscoveryPortalLogo" alt="Data Discovery Portal" src="/img/logos/logo-datadiscoveryportal-beta.png"/>

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
            <?php 
                $protocol = strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
                $host     = $_SERVER['HTTP_HOST'];
                $script   = $_SERVER['REQUEST_URI']; 
                $params   = $_SERVER['QUERY_STRING'];
                $currentUrl = $protocol . '://' . $host . $script;
                if($params) $currentUrl.= '?' . $params;
                echo $currentUrl;
        ?>
       </div>
  <!--      <div class="tmptitle"> <?php //echo $md_sub ?></div>-->
        <div class="wrapper">
        <!--<div class="clearfix"></div>    -->
        <!--<div class="margin10"></div>-->