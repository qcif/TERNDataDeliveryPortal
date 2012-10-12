<div id="ui-layout-map" > 
    <?php if($widget_map_drawtoolbar){ ?> 
    
    <div class="blackGradient" id="map-toolbar"> 
            <ul>
            	<li class="heading first-child">Map Tools</li>
                <li>Pan<br><a title="To Pan" id="drag" class="panBtn" title="<?php echo $this->lang->line('map_pan'); ?>"></a></li>
            	<li>Coordinates<br><a id="latlong" class="latLongBtn" >Longitude &amp; Latitude</a></li>
            	<li>Select region then 'GO'<br>
                  <div id="regionPanel">
                     <a title="To draw a region: click in the map and drag the mouse to get a rectangle. Release the mouse to finish." id="box" class="boxBtn"></a>
                     <!--<a href="#" id="selectPolyBtn" title="To move the region: Click and drag the box around the map"></a>-->
                     <a class="mapGoBtn" ></a>
                     <a title="Clear selected region" id="del" class="delBtn" ></a>
                  </div>
            	</li>
               <li>Show locations on map<br><input type="text" placeholder="Place Name" size="20" id="geocode"><a id="searchGeocodeBtn" ></a></li>
            	<li>Map View<br><div id="map-view-selector" class="mapViewSelector"><a class="current" id="gmap" >Map</a><a id="ghyb" >Hybrid</a><a id="gsat" >Satellite</a><a id="gphy" >Terrain</a></div></li>
               <li>Help<br><a id="map-help"  class="helpBtn last-child" ></a></li>
            </ul>
            <a class="hide" >Hide</a>
         </div>
         <div id="coordsOverlay">
            <div id="spatialNorth"><label for="spatial-north">N:</label><input type="text" value="" id="spatial-north"></div>
            <div id="spatialWest"><label for="spatial-west">W:</label><input type="text" value="" id="spatial-west"></div>
            <div id="spatialEast"><label for="spatial-east">E:</label><input type="text"   value="" id="spatial-east"></div>
            <div id="spatialSouth"><label for="spatial-south">S:</label><input type="text"  value="" id="spatial-south"></div>
            <a class="mapGoBtn collapse" ></a>
         </div>
                            
     <?php } ?>   
                              
</div>

<div id="spatialmap" class=""></div>
<div id="map-help-text" title="<?php echo $this->lang->line('map_helptitle');?>" class="hide" ><?php echo $this->lang->line('map_helptext');?></div>

