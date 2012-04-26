<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script tye="text/javascript">
        $(window).bind("load", function() {
        alert('hoi');
        });
</script>
<script src="http://openlayers.org/api/2.11/OpenLayers.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/openLayersMap.js"></script>
<style type="text/css">
            .olControlDrawFeatureBoxItemActive {
            background-position: -26px -24px;
            }
            .olControlDrawFeatureBoxItemInactive {
            background-position: -26px -1px;
            }
            .olControlEditingToolbar div{
                float:left;               
            }
            .olControlDragFeatureBoxItemActive {
            background-position: -103px -24px;
            }
            .olControlDragFeatureBoxItemInactive {
            background-position: -103px -1px;
            }
            #advance-spatial { 
                width: 430px;
            }
        </style>
<div id="openlayers-spatialmap"></div>
       <div id="advance-spatial" >  
            <div class="ui-widget-header clearfix">
                <div id="panel" class="olControlEditingToolbar">
                    <div  id="box" class="olControlDrawFeatureBoxItemInactive" onclick="toggleControl(this);" title=""></div>
                    <div  id="drag" class="olControlDragFeatureBoxItemInactive" onclick="toggleControl(this);" ></div>
                </div>
               
 	</div>
         <br/><a id="showCoords">Show coordinates</a><br/><br/>
         <div id="coords" style="display:none">
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
</div>
       
         