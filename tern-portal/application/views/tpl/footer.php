        <div id="sponsor" class="no_print">
            <div class="new-footer">
            <div id="phone">
                <?php echo anchor('http://tern.org.au/tern_data_portal_terms_of_use-pg21208.html', 'Terms of use'); ?>
                </div></div>

            <div id="info">TERN is supported by the Australian Government through the National<br>Collaborative Research Infrastructure Strategy and the Super Science Initiative.</div>
            <div id="australian_government"></div>
            </div>

        </div>


        <div id="footer" class="no_print">
            <div id="footer_padding">
                <div id="copyright"><a href="#">&copy; 2012 Terrestrial Ecosystem Research Network</a></div>

            </div>
        </div>
        
        	<script type="text/javascript">
  		var base_url = "<?php echo base_url(); ?>";
  		var secure_base_url = "<?php echo getHTTPs(base_url());?>";
		var service_url = "<?php echo service_url();?>";
	</script>
	
	

	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script> <!-- jQuery UI-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.layout-latest.js"></script> <!-- jQuery Multi Column-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tipsy.js"></script> <!-- jQuery Tipsy-->	
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.ba-hashchange.min.js"></script> <!-- Monitoring on Hash Change-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.6&amp;sensor=false"></script> <!--Google Map v3 from Google-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cookie.js"></script> <!-- jQuery Cookie-->  
        <script type="text/javascript" src="<?php echo base_url();?>js/hoverIntent.js"></script> <!-- jQuery Cookie-->  
       <script type="text/javascript" src="<?php echo base_url();?>js/superfish.js"></script> <!-- jQuery Cookie-->  
      
        <script type="text/javascript" src="<?php echo base_url();?>js/misc.js"></script>  
        <script type="text/javascript" src="<?php echo base_url();?>js/Layout.js"></script> <!-- WIDGET MAP -->
        <?php if($widget_temporal) { ?>
        <script type="text/javascript" src="<?php echo base_url();?>js/TemporalWidget.js"></script> <!-- WIDGET TEMPORAL-->
        <?php } ?>
        <?php if($widget_map) { ?>
        <script src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/MapWidget.js"></script> <!-- WIDGET MAP -->
        <?php } ?>
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
    </body>
</html>
