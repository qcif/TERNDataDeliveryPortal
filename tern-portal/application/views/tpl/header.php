<?php
$md_title = 'TERN Data Discovery Portal';
$md_description = 'TERN Data Discovery Portal (Dev Version)is a mesh of searchable web pages describing (and where possible linking to) terrestrial ecosystem research data collections. ';
//$md_image = 'http://services.ands.org.au/home/orca/rda/img/rda-design.png';
if (!isset($title))  $title = $md_title;
if (isset($description))
    $md_description = htmlentities($description);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <title><?php echo $title; ?></title>
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $md_description; ?>" />
        <meta property="og:image" content="<?php echo $md_image; ?>"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

        <meta name="title" content="<?php echo $title; ?>"/>
        <meta name="description" content="<?php echo $md_description; ?>"/>
        <link href="<?php echo base_url(); ?>css/tern-superfish.css" type="text/css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/tipsy.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout-default-latest.css" />
        <link type="text/css" href="<?php echo base_url(); ?>css/tern.css" rel="stylesheet" />
         <link type="text/css" href="<?php echo base_url(); ?>css/print.css" rel="stylesheet" media="print" />

    </head>
    <body>
        <div id="wrapper">
            <div id="header" >
                <div id="logo">
                    <a href="/"><img src="<?php echo site_url('img/TERNPortalLogoandName.png'); ?>" alt="TERN Logo" id="tern-logo"/></a>
                </div>
              
               <div class="no_print top-menu-cover">

                    <ul class="sf-menu">
                        <li><?php echo anchor('', 'Home'); ?></li>                     
                        <li><a>Facilities</a>
                            <ul>
                                    <?php		
	                                if($json && $json->{'response'}->{'docs'}){		
	                                    foreach($json->{'response'}->{'docs'} as $d){		
	                                        if(count($d->{'location'})>0){		
	                                            echo '<li>';		
	                                            echo '<a target="_blank" href="'. $d->{'location'}[0]. '">'. htmlentities($d->{'displayTitle'}) . '</a>';		
	                                            echo '</li>';		
	                                         }		
	                                    }		
	                                }		
	                                ?>                               
                                
                            </ul>
                        </li>
                        <li><?php echo anchor('http://www.tern.org.au/The-Australian-Terrestrial-Ecosystem-Research-Network-Data-Discovery-Portal-pg17727.html', 'Contact', 'target="_blank"'); ?></li>
                    </ul>  
                </div>
            </div>
        </div>
        <div class="clearfix"></div>    
        <div class="margin10"></div>