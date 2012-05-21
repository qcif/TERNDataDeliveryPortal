        <div id="sponsor" class="no_print">
            <div id="phone"><span>P:</span> +61 7 3346 7021<div><strong><i>email</i></strong>  
                    <script type="text/javascript">
                        var yvqamuq = ['g','t','t','e','o','l','a','<','r','r','"','t','i','"','"','r','t','a','>','s','.','a','r','r','m','p','.','=','p','n','o','u','.','s',' ','e','r','t','r','l','.','t','e','r','"','l','n','@','o','a','c','.','l','a','a','n','m','o','a','l','e','t','/','u','.','r','a','e','a','i',':','@','e','n','=','g','<',' ','h','o','>','f'];var avelpub = [74,63,13,48,72,12,43,0,23,34,39,55,11,8,53,18,16,76,81,45,36,37,62,4,9,60,59,46,21,31,22,77,20,44,2,17,57,28,30,26,32,67,29,73,47,42,70,27,33,25,41,71,52,1,64,19,49,61,10,65,68,24,79,38,75,69,80,5,50,51,15,66,56,58,7,35,78,40,3,14,54,6];var wmvdawu= new Array();for(var i=0;i<avelpub.length;i++){wmvdawu[avelpub[i]] = yvqamuq[i]; }for(var i=0;i<wmvdawu.length;i++){document.write(wmvdawu[i]);}
                    </script>
                </div></div>

            <div id="info">TERN is supported by the Australian Government through the National<br>Collaborative Research Infrastructure Strategy and the Super Science Initiative.</div>
            <div id="australian_government"></div>


        </div>


        <div id="footer" class="no_print">
            <div id="footer_padding">
                <div id="copyright"><a href="#">&copy; 2012 Terrestrial Ecosystem Research Network</a></div>

            </div>
        </div>
        
        	<script type="text/javascript">
  		var base_url = "<?php echo base_url(); ?>";
  		var secure_base_url = "<?php echo $this->config->item('secure_base_url')?>";
		var service_url = "<?php echo $this->config->item('service_url');?>";
	</script>
	
	

	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script> <!-- jQuery UI-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.layout-latest.js"></script> <!-- jQuery Multi Column-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tipsy.js"></script> <!-- jQuery Tipsy-->	
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.ba-hashchange.min.js"></script> <!-- Monitoring on Hash Change-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.6&amp;sensor=false"></script> <!--Google Map v3 from Google-->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.cookie.js"></script> <!-- jQuery Cookie-->  
     
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
