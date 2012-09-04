<?php $this->load->view('tpl/header'); ?>      
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
</style>
<div id="container" class="ui-corner-all clearfix">
                    <div id="loading"  ><p><img src="/img/ajax-loader.gif" alt="Please wait.." /> Please wait.. </p></div>
            
            <div id="search-panel" class="">    
                <div id="accordion" class="accordion">
                    <h2 id="basicSearchH2"><a href="#">Basic Search</a></h2>
                    <?php $this->load->view('tab/widgets/basicsearch');?>               
                    <h2 id="advSearchH2"><a href="#">Advanced Search</a></h2>
                    <div id="advSearch-frame" class="padding5">
                     
                    <?php if($widget_keyword) { ?> 
                     <?php $this->load->view('tab/widgets/keyword');?>
                 
                    <?php } ?>
                    <?php if($widget_facilities) { ?>
                     <?php $this->load->view('tab/widgets/facility');?>
                   
                    <?php } ?>
                    <?php if($widget_temporal) { ?>
                     <?php $this->load->view('tab/widgets/temporal');?>
                     <?php }?>
                     
                    <?php if($widget_for){  ?>
                     <?php $this->load->view('tab/widgets/researchfield');?>              
                    <?php } ?>
                          <?php $this->load->view('tab/widgets/buttonsearch');?>
                      </div>
                    <h2 id="facetH2"><a href="#">Refine</a></h2>
                    <div id="facet-frame" ><div id="facet-accordion" class="accordion"></div></div>         
                 </div>
            </div> 
            <div id="result-panel" class="ui-layout-center ">
                   <div id="no-result" class="ui-corner-all"><div><h3>Please use the search tool</h3></div></div>
                   <div id="head-toolbar" class="toolbar clearfix hide"></div>                                
                         
                   <div class="selectrecord">
                       <b>View</b><select id="viewrecord">				
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>				
                            <option value="100">100</option>			
                        </select><b>records</b> 
                   </div> 
                   
                 <div id="ui-layout-facetmap">  
                            <div id="map-toolbar" class="ui-widget-header clearfix "> 
                                <div class="left margin10"> Pan <br/><div  id="drag" class="olControlDragFeatureItemActive" title="To Pan"></div></div>
                                <div class="left margin10"> Coordinates <br/> <a href="#" id="latlong">Longitude<br/> & Latitude</a>
                                    </div>
                                <div class="left margin10"> Select regions then Update<br/>      <div id="panel" class="olControlEditingToolbar">
                                        <?php if($widget_map_drawtoolbar){ ?> 
                                            <div  id="box" class="olControlDrawFeatureBoxItemInactive" title="To draw a region: click in the map and drag the mouse to get a rectangle. Release the mouse to finish."></div>
                                            <!--div  id="poly" class="olControlDrawFeaturePolyItemInactive" title="To move the region: Click and drag the box around the map"></div-->
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
                                </div>    
                            <div id="spatialmap" class=""></div>
                            <div id="featurename"></div>
                              
              
                 </div>
            <?php// $this->load->view('search/loadmore');?>


                <div id="search-result" class="ui-layout-search-results"></div>

            
            </div>
        </div> 

<?php $this->load->view('tpl/footer');?>