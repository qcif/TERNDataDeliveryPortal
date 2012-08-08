<style type="text/css">
            .olControlDrawFeatureBoxItemActive {
            background-position: -153px -24px;
            }
            .olControlDrawFeatureBoxItemInactive {
            background-position: -153px -1px;
            }
            .olControlEditingToolbar div{
                float:left !important;      
            }
            .olControlDragFeatureBoxItemActive {
            background-position: -103px -24px;
            }
            .olControlDragFeatureBoxItemInactive {
            background-position: -103px -1px;
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
</style>
<div class="borderMe collapsiblePanel">  
<h3 class="head ui-widget-header lefttext">Location</h3>
<div class="padding5 centertext">
<input type="button" id="openMap"  value="Draw a region on map"/><br/>
<div id="overlaymap" title="Draw a region on the map">
    <div id="spatialmap" class=""></div>
    <div id="advance-spatial">
        <div class="ui-widget-header clearfix ">
            <div id="panel" class="olControlEditingToolbar">
                <?php if($widget_map_drawtoolbar){ ?> 
                    <div  id="box" class="olControlDrawFeatureBoxItemInactive" title="To draw a region: click in the map and drag the mouse to get a rectangle. Release the mouse to finish."></div>
                    <div  id="drag" class="olControlDragFeatureBoxItemInactive" title="To move the region: Click and drag the box around the map"></div>
                   
                <?php } ?>
            </div>
             <div id="doneMapDiv" class="clearfix"><input type="button" id="doneMap" value="Done" class=""/></div>    
             <div id="instructions">To draw a region click on the box icon. To choose a region, select one of the overlay layers and click on the region.</div>
        </div> 
     
    </div>
</div>  

<?php if($widget_map_coords){ ?>              
<a id="showCoords" title="Click to open / close coordinate textboxes">Coordinates</a>
         <div id="coords" class="padding5 hide" >
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
        </table>
         </div>
<?php } ?> 
   </div>
</div>