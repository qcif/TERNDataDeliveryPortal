<style type="text/css">
             #regionSelect{
                width: 400px;
                float: left;
               
            }
            #left{
                height: 400px;
             
            }
            #regionSelect ul{
                list-style: none;
                padding:0; 
            }
            #spatialmap { height: 500px !important; width: 700px !important;}
            
            .olControlDrawFeatureBoxItemActive {
            background-position: -153px -24px;
            }
            .olControlDrawFeatureBoxItemInactive {
            background-position: -153px -1px;
            }
            .olControlDrawFeaturePolyItemInactive {
             background-position: -25px -1px;
            }            
            .olControlDrawFeaturePolyItemActive {
             background-position: -25px -24px;
            }
            
            .olControlEditingToolbar div{
                float:left !important;      
            }
            .olControlDragFeatureItemActive {
                background-image: url("/img/editing_tool_bar.png");
                background-position: -103px -24px;
                height:22px;
                width: 24px;
                margin: 5px 0 5px 5px;
            }
            .olControlDragFeatureItemInactive {
                 background-image: url("/img/editing_tool_bar.png");
            background-position: -103px -1px;
             height:22px;
            width: 24px;
            margin: 5px 0 5px 5px;
            }
             .olControlDeleteFeatureBoxItemActive {
            background-position: -203px -24px;
            }
            .olControlDeleteFeatureBoxItemInactive {
            background-position: -203px -1px;
            }
            .olControlNavToolbar div, .olControlEditingToolbar div {
                background-image: url('/img/editing_tool_bar.png') ! important;
            }
            .olControlDrawFeatureActive{
                cursor: pointer;
            }
            #advance-spatial { 
                width: 430px;
            }
            #map-toolbar{
                font-size:10px;
                text-align:center;
            }
            .left{
                float:left;
            }
            .margin10{
                margin-right: 10px;
            }
            #coords{
                position:absolute;
                width:200px;
                z-index: 10000; 
            }
            .toolbartitle{
                font-weight:bold;
                font-size: 12px;
            }
</style>
<div id="ui-layout-facetmap"> 
    <?php if($widget_map_drawtoolbar){ ?> 
                            <div id="map-toolbar" class="ui-widget-header clearfix "> 
                                <div class="left margin10"> <span class="toolbartitle">Pan</span> <br/><div  id="drag" class="olControlDragFeatureItemActive tooltip" title="<?php echo $this->lang->line('map_pan'); ?>"></div></div>
                                <div class="left margin10"> <span class="toolbartitle">Coordinates</span> <br/> <a href="#" class="tooltip" id="latlong" title="<?php echo $this->lang->line('map_coords'); ?>">Longitude<br/> & Latitude</a>
                                    </div>
                                <div class="left margin10"> <span class="toolbartitle">Select regions then Update</span><br/>      <div id="panel" class="olControlEditingToolbar">
                                        
                                            <div  id="box" class="olControlDrawFeatureBoxItemInactive tooltip" title="<?php echo $this->lang->line('map_box'); ?>"></div>
                                            <!--div  id="poly" class="olControlDrawFeaturePolyItemInactive" title="To move the region: Click and drag the box around the map"></div-->
                                            <div  id="del" class="margin10 olControlDeleteFeatureBoxItemInactive tooltip" title="<?php echo $this->lang->line('map_del'); ?>"></div>
                                            <input type="button" value="Update"/>
                                      
                                    </div>
                                </div>
                                <div class="left margin10"> <span class="toolbartitle">Place Name</span> <br/> <input id="geocode"  class="tooltip" type="text" size="30" title="<?php echo $this->lang->line('map_placename'); ?>"/></div>
                                <div class="left margin10" id="mapViewSelector"> <span class="toolbartitle">Map view</span> <br/> <a href="#" id="gmap" class="tooltip" title="<?php echo $this->lang->line('map_mapview'); ?>">Map</a> | <a href="#" id="ghyb" class="tooltip" title="<?php echo $this->lang->line('map_mapview'); ?>" title="<?php echo $this->lang->line('map_mapview'); ?>">Hybrid</a> | <a href="#" id="gsat" title="<?php echo $this->lang->line('map_mapview'); ?>" class="tooltip">Satellite</a> | <a href="#" id="gphy" title="<?php echo $this->lang->line('map_mapview'); ?>" class="tooltip">Terrain</a></div>
                                <div class="left margin10" > <span class="toolbartitle">Help</span><br/><span class="tooltip" title="<?php echo $this->lang->line('map_help'); ?>">?</span></div>
                                    </div> 
      <?php } ?>
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
                                            <input type="button" value="Update"/>
                                        </td>
                                    </tr>
                                </table>
                                </div>    
                            <div id="spatialmap" class=""></div>
                        
              
                 </div>