<footer>   
     <a class="left" href="#">
        <img width="236" height="50" alt="Australian Government - Department of Industry, Innovation, Science, Research and Tertiary Education" src="/img/logos/logo-diisrte.png">
    </a>
    <p class="center">
        <small>TERN is supported by the Australian Government through the National Collaborative Research Infrastructure Strategy and the Super Science Initiative.</small>
    </p>
    <p class="right">
        <small>
            Copyright © TERN 2012. All Rights Reserved.
                <br>
             <?php echo anchor('home/terms', 'Terms of use',''); ?>
                |
            <?php echo anchor('home/contact', 'Contact', ''); ?>
        </small>
        </p>
</footer>  
  
        	<script type="text/javascript">
  		var base_url = "<?php echo base_url(); ?>";
  		var secure_base_url = "<?php echo getHTTPs(base_url());?>";
		var service_url = "<?php echo service_url();?>";
	</script>
	
	 
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script> <!-- jQuery UI-->
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.tools.min.js"></script> <!-- jQuery UI-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tipsy.js"></script> <!-- jQuery Tipsy-->	
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.ba-hashchange.min.js"></script> <!-- Monitoring on Hash Change-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cookie.js"></script> <!-- jQuery Cookie-->  
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.infinite-carousel.js"></script> 
        <script type="text/javascript" src="<?php echo base_url();?>js/hoverIntent.js"></script>  
                        
        <script type="text/javascript" src="<?php echo base_url();?>js/misc.js"></script>  
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.treeview.js"></script> <!-- jQuery treeview -->        
      
        <?php if($widget_temporal) { ?>
        <script type="text/javascript" src="<?php echo base_url();?>js/TemporalWidget.js"></script> <!-- WIDGET TEMPORAL-->
                
        <?php } ?>
        <?php if($widget_map) { ?>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
        <script  type="text/javascript" src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/MapWidget.js"></script> <!-- WIDGET MAP -->        
        <?php } ?>
        <?php if($infrastructure_map) { ?> 
              <script type="text/javascript" src="<?php echo base_url();?>js/mapProto_service.js"></script> <!-- Infrastructure MAP -->
        <?php } ?>
        <?php if($load_license_js) { ?> 
              <script type="text/javascript" src="<?php echo base_url();?>js/licensing.js"></script> <!-- Licensing Scripts -->
         <?php }?>
         <?php if ($this->config->item('GA_enabled')): ?>

            <script type="text/javascript">
                        
                var _gaq = _gaq || [];
                _gaq.push(['_setAccount', '<?php echo $this->config->item('GA_code'); ?>']);
                _gaq.push(['_setDomainName', '<?php echo $this->config->item('GA_domain_name'); ?>']);
                _gaq.push(['_trackPageview']);
            	
                (function() {
                    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                })();
            </script>

        <?php endif; ?>

        <script type="text/javascript" src="<?php echo base_url();?>js/main.js"></script> <!-- Main Script call -->
        </div>
    </body>
</html>
