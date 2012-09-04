    var n = '';
    var e = '';
    var s='';
    var w='';
    var spatial_included_ids;
 function trimwords(theString, numWords) {
    
    if(theString!=null)
    {
            expString = theString.split(/\s+/,numWords);
            theNewString=expString.join(" ");
            return theNewString;
    }else
    {
            return '';
    }
    
}   
    
function updateSelectedFeature(name){
    if(name !=''){    
        $("#featurename").text("Selected region: " + name);        
    }
    else{
        $("#featurename").text("");    
    }
}
    function refreshResults(mapWidget){
        if(mapWidget.getZoomRefine()){
           var coords = mapWidget.getExtentCoords();
            n = Math.round(coords.top*100) / 100;
            w = Math.round(coords.left*100) / 100;
            s = Math.round(coords.bottom*100) /100;
            e = Math.round(coords.right*100) /100; 
            $.ajax({
                    type:"POST",
                    url: base_url+"/search/spatial/",
                    data:"north="+n+"&south="+s+"&east="+e+"&west="+w,

                    success:function(msg)
                    {
                        spatial_included_ids = msg;
                         if(spatial_included_ids && spatial_included_ids != ''){
                                $.ajax({
                                    type:"POST",
                                    url: base_url+"/search/filter/",
                                    data:"q=&classFilter=All&typeFilter=All&groupFilter=All&subjectFilter=All&fortwoFilter=All&forfourFilter=All&forsixFilter=All&page=1&temporal=All&adv=0&ternRegionFilter=All&num=100&spatial_included_ids="+spatial_included_ids,            
                                    success: function(msg,textStatus){
                                        var divs = $(msg).filter(function(){return $(this).is('div')});
                                        divs.each(function() {

                                                if($(this).attr('id') != 'facet-content') {        
                                                    $('#results').html($(this).html());
                                                 
                                                       mapWidget.addVectortoDataLayer(".spatial_center",true);

                                                }

                                            });         

                                    }
                                    ,
                                    error:function(msg){
                                        console.log('error');

                                    }
                                });
                                }
                         
                    },
                    error:function(msg)
                    {
                       console.log("error" + msg);
                    }
  		});
              
            
        }
         return true;
    }
    
function initMapProto(){
            
    var mapWidget = new MapWidget('spatialmap',true);
    resetCoordinates();
    mapWidget.addDataLayer(true,"default",true);      
    /*$.getJSON('/api/regions.json',function(data){
       $.each(data.layers,function(key,val){
            if(key == 0){
                visibility = true;
            }else visibility = false;
            mapWidget.addExtLayer({
                url: val.geo_url,
                protocol: "WMS",
                geoLayer: val.geo_name,
                layerName: val.l_name,
                visibility: visibility
            });
                      
             
                 
        });
        mapWidget.registerClick(data.layers,updateSelectedFeature);   
    });
    */
          mapWidget.addDrawLayer({
                geometry: "box", 
                allowMultiple: false, 
                afterDraw: updateCoordinates
            });
            /* if(n!='') {
                mapWidget.updateDrawing(mapWidget,w + "," + s+ "," + e + "," + n);
          }
            */
            //enable clicking button controllers
            enableToolbarClick(mapWidget);
                 
            //changing coordinates on textbox should change the map appearance
            enableCoordsChange(mapWidget);  
            
            mapWidget.registerMoveEnd(refreshResults);
            $("#latlong").bind('click',function() {
                 $("#coords").toggle(); 
            });
            
            /*$("#zoomrefine").bind('click',function(){ 
                 mapWidget.setZoomRefine();
                 mapWidget.toggleControl($("#del").get(0));
                 refreshResults(mapWidget);
            });
    */
    
            $("#mapViewSelector a").bind('click',function(element){
                mapWidget.setBaseLayer($(this).attr("id")); 
            });
   
    return mapWidget;
}
   
function switchLayer(e,i,mapWidget){
    var active = $("#regionSelect").accordion('option','active');
    var active_id = $("#regionSelect h3 a:eq(" + active + ")").text();
    mapWidget.switchLayer(active_id);
    updateSelectedFeature('');
}

$(document).ready(function() {
  /*$("#regionTypeSelect").change(function(){
      $('#regionSelect').dropdownchecklist("destroy");
      $('#regionSelect').html($("#regionSelect" + $(this).val()).html());
       $('#regionSelect select').dropdownchecklist();
           
       });*/
  
    var mapWidget = initMapProto();
   
    $("#regionSelect").accordion({
        autoHeight: false, 
        fillSpace: true,
        change: function(e,i){
            switchLayer(e,i,mapWidget);
        }
    });
    
    
    $(".regionlink").bind('click',function(){
        var id  = $(this).attr("id");
        var l_id = $("#regionSelect h3.ui-state-active").attr("id");
        mapWidget.setSelectedId(l_id, id, $(this).text());        
        mapWidget.setHighlightLayer(id);
        updateSelectedFeature($(this).text());
    });
    $("input[value='Update']").bind('click',function(){
      //  var geometry = mapWidget.getFeatureCoordinates();
         //update spatial coordinates from textboxes
                var nl=document.getElementById("spatial-north");
                var sl=document.getElementById("spatial-south");
                var el=document.getElementById("spatial-east");
                var wl=document.getElementById("spatial-west");
                   
                n=nl.value;
                s=sl.value;
                e=el.value;
                w=wl.value;  
                
                spatial_included_ids='';
                if(n!=''){
                 $.ajax({
                    type:"POST",
                    url: base_url+"/search/spatial/",
                    data:"north="+n+"&south="+s+"&east="+e+"&west="+w,

                    success:function(msg)
                    {
                        spatial_included_ids = msg;
                         if(spatial_included_ids && spatial_included_ids != ''){
                                $.ajax({
                                    type:"POST",
                                    url: base_url+"/search/filter/",
                                    data:"q=&classFilter=All&typeFilter=All&groupFilter=All&subjectFilter=All&fortwoFilter=All&forfourFilter=All&forsixFilter=All&page=1&temporal=All&adv=0&ternRegionFilter=All&num=100&spatial_included_ids="+spatial_included_ids,            
                                    success: function(msg,textStatus){
                                        var divs = $(msg).filter(function(){return $(this).is('div')});
                                        divs.each(function() {

                                                if($(this).attr('id') != 'facet-content') {        
                                                    $('#results').html($(this).html());
                                                 
                                                       mapWidget.addVectortoDataLayer(".spatial_center",true);
                                                       mapWidget.deactivateAllControls();
                                                }

                                            });         

                                    }
                                    ,
                                    error:function(msg){
                                        console.log('error');

                                    }
                                });
                                }
                         
                    },
                    error:function(msg)
                    {
                       console.log("error" + msg);
                    }
  		});
                
                } else {
                    $('#results').html('');
                }
    });
    
    
    $("button").bind('click', function() {
        if(mapWidget.getSelectedId()!=""){ 
            
            $.ajax({
                type:"POST",
                url: base_url+"/search/filter/",
                data:"q=&classFilter=All&typeFilter=All&groupFilter=All&subjectFilter=All&fortwoFilter=All&forfourFilter=All&forsixFilter=All&page=1&temporal=All&adv=0&ternRegionFilter="+ mapWidget.getSelectedId()  +"&num=100",            
                success: function(msg,textStatus){
                    var divs = $(msg).filter(function(){return $(this).is('div')});
                    divs.each(function() {
                           
                            if($(this).attr('id') != 'facet-content') {        
                                $('#results').html($(this).html());
                                  mapWidget.addVectortoDataLayer(".spatial_center",true);
                                  mapWidget.deactivateAllControls();
                            }
                          
                        });         

                   
                }
                ,
                error:function(msg){
                    console.log('error');

                }
            });
            } else{
                alert("Please select a region first!");
            }
    });
    
    var placename = document.getElementById('geocode');
    var options = {
        componentRestrictions: {country: 'au'}
    };
    var autocomplete = new google.maps.places.Autocomplete(placename,options);
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (place.geometry.viewport) {
                var viewportPlace = place.geometry.viewport;
                var viewportSW = viewportPlace.getSouthWest();
                var viewportNE = viewportPlace.getNorthEast(); 
                var newBounds = new OpenLayers.Bounds(viewportSW.lng(), viewportSW.lat(), viewportNE.lng(), viewportNE.lat())
                newBounds.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));   
                mapWidget.map.zoomToExtent(newBounds);
            } else {
                var location = place.geometry.location;
                var lonlat = new OpenLayers.LonLat(location.lng(),location.lat());
                lonlat.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));
                mapWidget.map.setCenter(lonlat,11,false,false);
                
            }     
            });

    
});