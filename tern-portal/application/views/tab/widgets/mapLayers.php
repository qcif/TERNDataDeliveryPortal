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
                background-image: url('/img/editing_tool_bar.png');
            }
            #advance-spatial { 
                width: 430px;
            }
</style>
<div class="borderMe collapsiblePanel">  
<h3 class="head ui-widget-header lefttext">Location</h3>
<div class="padding5 centertext">
<input type="button" id="openMap" class="margin10" value="Draw a region on map"/><br/>
<div id="overlaymap" title="Draw a region on the map">
    <div id="spatialmap" class=""></div>
    <div id="advance-spatial">
        <div class="ui-widget-header clearfix ">
            <div id="panel" class="olControlEditingToolbar">
                <?php if($widget_map_drawtoolbar){ ?> 
                    <div  id="box" class="olControlDrawFeatureBoxItemInactive" title=""></div>
                    <div  id="drag" class="olControlDragFeatureBoxItemInactive" ></div>
                <?php } ?>

            </div>

        </div> 
    </div>
</div>  

<?php if($widget_map_coords){ ?>              
      
         <div id="coords" class="padding5" >
             <h4> Coordinates</h4>
         <table border="0" cellspacing="0" cellpadding="0">
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