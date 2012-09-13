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
        <link href="<?php echo base_url(); ?>css/tern-superfish.css" type="text/css" rel="stylesheet"/>
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/tipsy.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout-default-latest.css" />
        <link type="text/css" href="<?php echo base_url(); ?>css/tern.css" rel="stylesheet" />
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
        <div id="wrapper">
            <div id="header" >
           
                <div id="logo">
                    <a href="/"><img src="<?php echo site_url('img/PortalLogoandName.png'); ?>" alt="TERN Logo" id="tern-logo"/></a>
                </div>
              
               <div class="no_print top-menu-cover">

                    <ul class="sf-menu">
                        <li><?php echo anchor('', 'Home'); ?></li>                     
                        <li><a>Capabilities</a>
                            <ul>
                                    <?php		
	                                if($json && $json->{'response'}->{'docs'}){		
	                                    foreach($json->{'response'}->{'docs'} as $d){		
	                                        if(count($d->{'location'})>0){		
	                                            echo '<li>';		

	                                           // echo '<a target="_blank" href="'. $d->{'location'}[0]. '">'. htmlentities($d->{'displayTitle'}) . '</a>';	 //commented 8.1
                                                    echo '<a target="_blank" href="'. $d->{'location'}[0]. '">'. htmlentities($d->{'display_title'}) . '</a>';   //added 8.1

	                                            echo '</li>';		
	                                         }		
	                                    }		
	                                }		
	                                ?>                               
                                
                            </ul>
                        </li>
                        <li><?php echo anchor('http://www.tern.org.au/Portal_contactus-pg22075.html', 'Contact', 'target="_blank"'); ?></li>
                        <li><?php echo anchor('https://www.surveymonkey.com/s/TDDP', 'Feedback', 'target="_blank"'); ?></li>
                    </ul>  
                </div>
            </div>
        </div>
                                     <div class="tmptitle"> <?php echo $md_sub ?></div>
        <div class="clearfix"></div>    
        <div class="margin10"></div>