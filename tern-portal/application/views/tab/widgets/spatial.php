<div id="ui-layout-map" > 
    <?php if($widget_map_drawtoolbar){ ?> 
    
    <div class="blackGradient" id="map-toolbar"> 
            <ul>
            	<li class="heading">Map Tools</li>
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
               <li>Help<br><a id="map-help"  class="helpBtn" ></a></li>
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
                            <!--div id="map-toolbar" class="blackGradient" >                              
                                    <div class="left margin8"> <span class="toolbartitle">Pan</span> <br/><div  id="drag" class="olControlDragFeatureItemActive tooltip" title="<?php echo $this->lang->line('map_pan'); ?>"></div></div>
                                    <div class="left margin8"> <span class="toolbartitle">Coordinates</span> <br/> <a  class="tooltip topmargin5" id="latlong" title="<?php echo $this->lang->line('map_coords'); ?>">Longitude<br/> &amp; Latitude</a>
                                        </div>
                                    <div class="left margin8"> <span class="toolbartitle">Draw and Update</span><br/>      <div id="panel" class="olControlEditingToolbar">

                                                <div  id="box" class="olControlDrawFeatureBoxItemInactive tooltip" title="<?php echo $this->lang->line('map_box'); ?>"></div>

                                                 <!--div  id="poly" class="olControlDrawFeaturePolyItemInactive" title="To move the region: Click and drag the box around the map"></div
               
                                                 <div  id="del" class="margin10 olControlDeleteFeatureBoxItemInactive tooltip" title="<?php //echo $this->lang->line('map_del'); ?>"></div>
                                                <input type="button" value="Update"/>

                                        </div>
                                    </div>
                                    <div class="left margin8"> <span class="toolbartitle">Place Name</span> <br/> <input id="geocode"  class="tooltip topmargin5" type="text" size="30" title="<?php //echo $this->lang->line('map_placename'); ?>"/></div>
                                    <div class="left margin8" id="map-view-selector"> <span class="toolbartitle">Map view</span> <br/> <a href="#" id="gmap" class="tooltip topmargin5" title="<?php //echo $this->lang->line('map_mapview'); ?>">Map</a><a href="#" id="ghyb" class="tooltip topmargin5" title="<?php echo $this->lang->line('map_mapview'); ?>" ">Hybrid</a><a href="#" id="gsat" title="<?php echo $this->lang->line('map_mapview'); ?>" class="tooltip topmargin5">Satellite</a><a href="#" id="gphy" title="<?php echo $this->lang->line('map_mapview'); ?>" class="tooltip topmargin5">Terrain</a></div>
                                    <div class="left margin8" id="map-help" > <span class="toolbartitle" >Help</span><br/><a class="tooltip topmargin5" >?</a></div> 
                                    <div id="map-hide"><span class="toolbartitle">Hide</span> </div>
                                </div>
    
                                                 
                            <div id="coords" class="padding5 hide ui-widget-header" >
                                <table border="0" cellspacing="0" cellpadding="0" style="margin:auto;">
                                    <tr>
                                        <td></td>
                                        <td><label class="spatial-label">N:</label><input class="search-input-mini" id="spatial-north" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                                        <td></td>                
                                    </tr>
                                    <tr>
                                        <td><label class="spatial-label">W:</label><input class="search-input-mini" id="spatial-west" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                                        <td></td>
                                        <td><label class="spatial-label">E:</label><input class="search-input-mini" id="spatial-east" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><label class="spatial-label">S:</label><input class="search-input-mini" id="spatial-south" type="text" value="" onkeyup="checkForInvalid(this)"/></td>
                                        <td></td> 
                                    </tr> 
                                    <tr>
                                        <td colspan="3">
                                            <input type="button" value="Update" disabled="disabled"/>
                                        </td>
                                    </tr>
                                </table>
                                </div>    --> 
                          <?php } ?>   
                              
</div>

<div id="spatialmap" class=""></div>
<div id="map-help-text" title="<?php echo $this->lang->line('map_helptitle');?>" class="hide" ><?php echo $this->lang->line('map_helptext');?></div>

