var map, drawControls;
// World Geodetic System 1984 projection (lon/lat)
var WGS84 = new OpenLayers.Projection("EPSG:4326");

// WGS84 Google Mercator projection (meters)
var WGS84_google_mercator = new OpenLayers.Projection("EPSG:900913");
   
function loadDrawOpenLayersMap(){
    $('#spatial-north').val('');
    $('#spatial-west').val('');
    $('#spatial-south').val('');
    $('#spatial-east').val(''); 
    
    var options = {
        units : 'm',
        numZoomLevels : 12,
        maxExtent : new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
        maxResolution:'auto',
        projection: WGS84_google_mercator,
        displayProjection: WGS84
    };
        
    //Base Layer
    map = new OpenLayers.Map('openlayers-spatialmap', options);
    var gphy = new OpenLayers.Layer.Google("Google", 
    {
        type: google.maps.MapTypeId.HYBRID, 
        sphericalMercator: true, 
        minZoomLevel: 3, 
        maxZoomLevel: 15, 
        wrapDateLine:false, 
        maxExtent : new OpenLayers.Bounds(12537508.34,-5537508.34,18037508.34,-937508.34)
    });	
            
    //GeoJSON Test
    /*
        var url = "http://demo/api/output.json";

        var p = new OpenLayers.Format.GeoJSON();
        var size = new OpenLayers.Size(21,25);
                var offset = new OpenLayers.Pixel(-(size.w/2), -size.h);
        var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
        var s = new OpenLayers.Style({
            'pointRadius': 10,
            'externalGraphic': icon
            });
        var style = new OpenLayers.StyleMap(s);
        var vector_layer = new OpenLayers.Layer.Vector("Schools"); 
        OpenLayers.loadURL(url, {}, null, function (response) {
            var gformat = new OpenLayers.Format.GeoJSON(); 
        // gg = '{"type":"FeatureCollection", "features":' +
            //   response.responseText + '}';
            var feats = gformat.read(response.responseText);

            vector_layer.addFeatures(feats);
            alert('here');
        });
                                   
       
       
        var size = new OpenLayers.Size(21,25);
        var offset = new OpenLayers.Pixel(-(size.w/2), -size.h); 
        var icon = new OpenLayers.Icon('http://www.openlayers.org/dev/img/marker.png',size,offset);
        var s = new OpenLayers.Style({   
            'externalGraphic': icon
        });
        var sm = new OpenLayers.StyleMap(s);
         var lookup = {
             "Point":  {  'externalGraphic': 'http://www.openlayers.org/dev/img/marker-blue.png', 'graphicWidth': '21', 'graphicHeight': '25', 'graphicXOffset': -10, 'graphicYOffset': -25,  'graphicOpacity': 1 },
             "Line": {strokeWidth: 3},
             "Polygon": {fillColor: '#ee9900', fillOpacity: '0.4', strokeColor: '#ee9900', strokeWidth: '1'}
            }
             var lookupS = {
             "Point":  {  'externalGraphic': 'http://www.openlayers.org/dev/img/marker.png', 'graphicWidth': '21', 'graphicHeight': '25', 'graphicXOffset': -10, 'graphicYOffset': -25,  'graphicOpacity': 1 },
             "Line": {strokeWidth: 3},
             "Polygon": {fillColor: '#ff0000', fillOpacity: '0.4', strokeColor: '#ff0000', strokeWidth: '1'}
              }
        var style = new OpenLayers.StyleMap();
        style.addUniqueValueRules("default", "type", lookup);
        style.addUniqueValueRules("select", "type", lookupS);
        var featurecollection = {
              "type": "FeatureCollection", 
              "features": [
                {"geometry": {
                    "type": "GeometryCollection", 
                    "geometries": [
                        
                        {
                            "type": "Polygon", 
                            "coordinates": 
                                [[[127.550781,-34.397467], 
                                  [130.011719,-22.694698], 
                                  [146.710938,-29.017348], 
                                  [131.593750,-36.403231], 
                                  [127.550781,-34.397467]]]
                   
                        }
                        
                    ]
                }, 
                "type": "Feature", 
                "properties": {"type" : "Polygon"}},
            {"geometry": {
                    "type": "GeometryCollection", 
                    "geometries": [
                      
                        {
                            "type":"Point", 
                            "coordinates":[127.550781,-30.397467]
                        }
                        
                    ]
                }, 
                "type": "Feature", 
                "properties": {"type" : "Point"}}
             
              ]
           };
           var geojson_format = new OpenLayers.Format.GeoJSON({
                        'externalProjection': WGS84, 
                        'internalProjection': WGS84_google_mercator});
           var vector_layer = new OpenLayers.Layer.Vector("Sites", {
                 projection: WGS84,
                 styleMap: style
                });  
           vector_layer.addFeatures(geojson_format.read(featurecollection));
            map.addLayer(vector_layer);
         
              */  
    //KML Test
    /* 
    var kmltest = new OpenLayers.Layer.Vector("KML", {
                    projection: map.displayProjection,
                    strategies: [new OpenLayers.Strategy.Fixed()],
                    protocol: new OpenLayers.Protocol.HTTP({
                        url: "/js/GroundwaterTransitionalPlans.kmz",
                        format: new OpenLayers.Format.KML({
                            extractStyles: true,
                            extractAttributes: true
                        })
                    })
                });

    */
                        
    // Layer for features
    var boxLayer = new OpenLayers.Layer.Vector("Spatial search");
    boxLayer.events.register('beforefeatureadded',boxLayer,function(feature){
        if(boxLayer.features.length > 0) {
            boxLayer.removeAllFeatures();
          
        }
    });
   
    //Select the features
    /* var selectFeature = new OpenLayers.Control.SelectFeature([vector_layer],{
                        clickout: false, toggle: false,
                        multiple: false, hover: false,
                        toggleKey: "ctrlKey", // ctrl key removes from selection
                        multipleKey: "shiftKey", // shift key adds to selection
                        box: true});
   */
    /*
    vector_layer,
    {
        onSelect: function(){            
            alert("selected");
        }
    }
    );
   
     map.addControl(selectFeature);
     selectFeature.activate();*/
    // Drag the feature around
    //map.addControl(dragFeature);
    //dragFeature.activate();


    //draw box controls
    drawControls = {
        box: new OpenLayers.Control.DrawFeature(boxLayer,
            OpenLayers.Handler.RegularPolygon, {
                handlerOptions: {
                    sides: 4,
                    irregular: true
                },
                featureAdded: updateCoordinates
            }),
        drag: new OpenLayers.Control.DragFeature(boxLayer, {
            onComplete:updateCoordinates
        })  
           
    };
    for(var key in drawControls) {
        map.addControl(drawControls[key]);
    }

    map.addLayers([gphy,boxLayer]);

    map.addControl(new OpenLayers.Control.LayerSwitcher());
    
     
    if (!map.getCenter()) map.zoomToExtent(new OpenLayers.Bounds(13237508.34,-5537508.34,16037508.34,-937508.34));
   
   // allow users to click "Show Coordinates"
   enableCoordsClick();
}

function enableCoordsClick(){
    
      $('#showCoords').click(function(e){
        $('#coords').toggle('fast');
    });

}
function updateCoordinates(event){
    var bounds = event.geometry.getBounds();
    bounds.transform(WGS84_google_mercator, WGS84);
    $('#spatial-north').val(Math.round(bounds.top*100)/100);
    $('#spatial-west').val(Math.round(bounds.left*100)/100);
    $('#spatial-south').val(Math.round(bounds.bottom*100)/100);
    $('#spatial-east').val(Math.round(bounds.right*100)/100); 
  

   
}
function deactivateDrawBox(){
    for(var key in drawControls) {
        var control = drawControls[key];
        document.getElementById(key).setAttribute("class","olControlDrawFeatureBoxItemInactive");
        control.deactivate();
    }
   
}

function toggleControl(element) {
    for(key in drawControls) {
        var control = drawControls[key];
        if(element.id == key) {
            if(key=='box'){
                if(control.active){
                    control.deactivate();
                    control.layer.removeAllFeatures();
                    element.setAttribute("class","olControlDrawFeatureBoxItemInactive");
                            
                }
                else{
                    control.activate();
                    element.setAttribute("class","olControlDrawFeatureBoxItemActive");
                }
            }else{
                if(control.active){
                    control.deactivate();
                    element.setAttribute("class","olControlDragFeatureBoxItemInactive");
                }else{
                    control.activate();
                    element.setAttribute("class","olControlDragFeatureBoxItemActive");
                }                            
            }
        } 
    }
}

    