<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">  
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
        <link type="text/css" href="<?php echo base_url(); ?>css_old/tern.css" rel="stylesheet" />
        <link type="text/css" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
         <style>
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
            </style> 
  </head>
    <body>
        <div id="left">	<a onClick="removeFeatures();">Remove Features</a>
        <div id="regionSelect"><?php
            for($i=0;$i<count($regions);$i++){
                 ?>
                <h3 id="<?php echo $regions[$i]->l_id;?>"><a href="#" id="<?php echo $regions[$i]->geo_name;?>"><?php echo $regions[$i]->l_name;?></a></h3>
                <div> <ul>
                        <?php foreach($regions[$i]->features as $feature){ ?>
                        <li><a href="#" id="<?php echo $feature->r_id;?>" class="regionlink"><?php echo $feature->r_name; ?></a></li>
                        <?php } ?>
                    </ul></div>
                                <?php

                            }

        ?>
        </div>
            <div style="width: 200px; margin: 0 auto" ><button  name="Submit">Search records</button></div>   
        </div>
<!--select id="regionTypeSelect"><?php
            for($i=0;$i<count($regions);$i++){
                 ?>
<option id="<?php echo $regions[$i]->l_id;?>" value="<?php echo $i;?>" ><?php echo $regions[$i]->l_name;?></option>
<?php } ?>
</select>
            
 <?php   for($i=0;$i<count($regions);$i++){?>
            <div id="regionSelect<?php echo $i?>" style="visibility:hidden;height:0px;">
            <select  multiple="multiple" >
            <?php  foreach($regions[$i]->features as $feature){ ?>            
                <option id="<?php echo $feature->r_id;?>" value="<?php echo $feature->r_name;?>" ><?php echo $feature->r_name;?></option>
            <?php }?> 
            </select>
            </div>
 <?php } ?>
<div id="regionSelect" >       </div>
            
            
        </div-->
<?php $widget_map_drawtoolbar = true;?>

  
<div id="overlaymap" style="width:700px;margin:auto;float:left">
    <!--div id="map-toolbar" class="ui-widget-header clearfix "> 
        <div class="left margin10"> Pan <br/><div  id="drag" class="olControlDragFeatureItemActive" title="To Pan"></div></div>
        <div class="left margin10"> Coordinates <br/> <a href="#" id="latlong">Longitude<br/> & Latitude</a>
            </div>
        <div class="left margin10"> Select regions then Update<br/>      <div id="panel" class="olControlEditingToolbar">
                <?php if($widget_map_drawtoolbar){ ?> 
                    <div  id="box" class="olControlDrawFeatureBoxItemInactive" title="To draw a region: click in the map and drag the mouse to get a rectangle. Release the mouse to finish."></div>
                    <!--div  id="poly" class="olControlDrawFeaturePolyItemInactive" title="To move the region: Click and drag the box around the map"></div
                    <div  id="del" class="margin10 olControlDeleteFeatureBoxItemInactive" title="To move the region: Click and drag the box around the map"></div>
                    <input type="button" value="Update"/>
                <?php } ?>
            </div>
        </div>
         <div class="left margin10"> Place Name <br/> <input id="geocode" type="text" size="25"/></div>
        <div class="left margin10" id="mapViewSelector"> Map view <br/> <a href="#" id="gmap">Map</a> | <a href="#" id="ghyb">Hybrid</a> | <a href="#" id="gsat">Satellite</a> | <a href="#" id="gphy">Terrain</a></div>
        <div class="left margin10"> Help</div>
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
                      <input type="button" value="Update"/>
                  </td>
              </tr>
        </table>
           
         </div-->    
    <div id="spatialmap" class=""></div>
    <div id="featurename"></div>
    
</div>

        <div style="clear:both"></div>
         
        <div id="results"></div>
        <script type="text/javascript">
  		var base_url = "<?php echo base_url(); ?>";
  		var secure_base_url = "<?php echo getHTTPs(base_url());?>";
		var service_url = "<?php echo service_url();?>";
	</script>
        
   <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.2.min.js"></script> <!-- jQuery -->
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery-ui-1.8.20.custom.min.js"></script> <!-- jQuery UI-->
    	<script type="text/javascript" src="<?php echo base_url();?>js/ui.dropdownchecklist-1.4-min.js"></script>
      <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
        <script  type="text/javascript" src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
         <script type="text/javascript" src="<?php echo base_url();?>js/mapProto.js"></script>  
       <script type="text/javascript" src="<?php echo base_url();?>js/MapWidget.js"></script> <!-- WIDGET MAP -->
       
       </body>
</html>
