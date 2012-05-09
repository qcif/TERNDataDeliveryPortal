/*      !!!!CONFIGURE DATA SOURCES FOR EXTERNAL LAYERS HERE!!!!
 *         
 */

function getURL(keyword){
    var URLList = {
         "dummy" : base_url + 'api/output.json',
         "supersites_wfs" : { 
                    url: 'http://tern-supersites.net.au/knb/wfs',
                    featurePrefix: 'metacat',
                    geometryName: 'the_geom',
                    featureType: ['data_bounds','data_points'],
                    featureNS: "http://knb.ecoinformatics.org/metacat",
                    srsName: "EPSG:4326"
                },
         "aceas_wfs" : {
                    url:  'http://tern-supersites.net.au/geoserver/aceas/wfs',
                    featurePrefix: 'aceas',
                    geometryName: 'geocode',
                    featureType: 'aceas_view',
                    srsName: "EPSG:900913",
                    featureNS: "http://tern-supersites.net.au",
                    version: "1.1.0"
                }
                
    }
   return URLList[keyword];

}

/*      !!!!END OF EXTERNAL DATA CONFIGURATION!!!!
 *         
 */

String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}


/*       MAIN WIDGET CLASS 
 *         
 * 
 * 
 */
function MapWidget(mapId){

    this.map = '';
    this.drawControls = '';

    // World Geodetic System 1984 projection (lon/lat)
    this.WGS84 = new OpenLayers.Projection("EPSG:4326");

    // WGS84 Google Mercator projection (meters)
    this.WGS84_google_mercator = new OpenLayers.Projection("EPSG:900913");

    //Store all layers in an array
    this.extLayers = new Array();
    this.selectLayers = new Array();
    this.selectFeature = '';
    /*  ------------------------------------------------------------  
     *    CREATE MAP OBJECT 
     *
     *  ------------------------------------------------------------
     */
    this.options = {
        units : 'm',
        numZoomLevels : 12,
        maxExtent : new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),
        maxResolution:'auto',
        projection: this.WGS84_google_mercator,
        displayProjection: this.WGS84
    };
     this.map = new OpenLayers.Map(mapId, this.options);
    
       /*  ------------------------------------------------------------  
       *    ADD GOOGLE BASE MAP LAYER
       *
       *  ------------------------------------------------------------
       */
  
    var gphy = new OpenLayers.Layer.Google("Google", 
    {
        type: google.maps.MapTypeId.HYBRID, 
        sphericalMercator: true, 
        minZoomLevel: 3, 
        maxZoomLevel: 15, 
        wrapDateLine:false, 
        maxExtent : new OpenLayers.Bounds(13237508.34,-5537508.34,16037508.34,-937508.34)
    });	
   
   this.map.addLayer(gphy);          
   //this.layers.push(gphy); 
    
    //Enable switch layers (that + button on the map)
    this.map.addControl(new OpenLayers.Control.LayerSwitcher());
    
    // look at Australia 
    if (!this.map.getCenter()) this.map.zoomToExtent(new OpenLayers.Bounds(13237508.34,-5537508.34,16037508.34,-937508.34));

    
}


    /*  ------------------------------------------------------------  
     *    addDrawLayer({options})  
     *    Add control to draw polygon/square on map if activated
     *    This does not draw the toolbar
     *    Also allow the vector drawn to be moved around the map
     *  ------------------------------------------------------------
     */
MapWidget.prototype.addDrawLayer = function(options){
    var options = options || {};
    var geometry = options.geometry || "box";
    var allowMultiple = options.allowMultiple || false;
    var afterDraw = options.afterDraw || null; 
    var afterDrag = options.afterDrag || null; 

      
      //Box Layer declaration
    var boxLayer = new OpenLayers.Layer.Vector("Spatial search");

    boxLayer.events.register('beforefeatureadded',boxLayer, (function(feature){ 
           if(!allowMultiple){   // No multiple boxes yet
               if(boxLayer.features.length > 0) {
                boxLayer.removeAllFeatures();       
            }
           }
        // set other layers to hide when drawing starts
        if(this.extLayers){
       
               for(var layer in this.extLayers){

                    this.extLayers[layer].setVisibility(false);
                }
          
        }
       
    }).bind(this));
    
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    
    if(geometry == 'box'){
        var handlerOptions = { sides: 4, irregular: true};
    }else{
        var handlerOptions = {};
    }
    
    
    this.drawControls = {
        box: new OpenLayers.Control.DrawFeature(boxLayer,
            OpenLayers.Handler.RegularPolygon, {                
                handlerOptions: handlerOptions,
                featureAdded:  function(e){
                   afterDraw(e,WGS84, WGS84_google_mercator);
                
                }
            }),
        drag: new OpenLayers.Control.DragFeature(boxLayer, {
            onComplete:function(e){
                       
                   afterDrag(e,WGS84, WGS84_google_mercator);
                
                }
        })

    };
    //Add controls to map
    for(var key in this.drawControls) {
        this.map.addControl(this.drawControls[key]);
    }

    this.map.addLayer(boxLayer);
    
    //make sure this layer is on top.
    this.map.raiseLayer(boxLayer,this.map.layers.length);
    
}

    /*  ------------------------------------------------------------  
     *    addeExtLayer({options})  
     *    Add layer based on external data sources
     *    also add selectFeature on layer where afterSelect option is not null
     *    
     *  ------------------------------------------------------------
     */
MapWidget.prototype.addExtLayer = function(options){
    var options = options || {};
    var protocol = options.protocol || "WMS";
    var url = options.url || false;
    var multiSelect = options.multiSelect || false; // not used yet
    var afterSelect = options.afterSelect || null;
    var style = options.style || "default";
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    var tempLayer = '';
    var styleM = getStyle(style);
    
    OpenLayers.ProxyHost= base_url + "api/geoproxy.php?url=";
    
    // what is the protocol? 
    switch(protocol){
        case "WFS": {             
                if(url!='supersites'){
                     tempLayer =  new OpenLayers.Layer.Vector(url.capitalize(), { styleMap: styleM });
                }else{
                    tempLayer =  new OpenLayers.Layer.Vector(url.capitalize(), { styleMap: styleM, preFeatureInsert: function(feature) {   feature.geometry.transform(WGS84,WGS84_google_mercator);
                    }});       
                 }
                 getWFS(url,tempLayer);  
        }; break;
        case "WMS": {  // not working for  now
                switch(url){
                        case "supersites" : {
                                tempLayer = new OpenLayers.Layer.TMS("Metacat Doc Points", "http://tern-supersites.net.au/knb/wms?", {
                                    getURL : get_wms_url, layers : ["data_points","data_bounds"], visibility : true, 
                                    type : 'gif', format : "image/gif",
                                    opacity : 1, isBaseLayer : false,	deltaX : 0.00, deltaY : 0.00
                                });                       
                        };break;
                }
        };break;
        case "GEOJSON": { 
                tempLayer =  new OpenLayers.Layer.Vector(url.capitalize(), { projection: WGS84 });   
                var p = new OpenLayers.Format.GeoJSON({
                    'externalProjection': WGS84, 
                    'internalProjection': WGS84_google_mercator
                });

                OpenLayers.Request.GET({ 
                    url: getURL(url), 
                    callback: function (response) {
                              var gformat = new OpenLayers.Format.GeoJSON({
                    'externalProjection': WGS84, 
                    'internalProjection': WGS84_google_mercator
                }); 
                
                var features = gformat.read(response.responseText);

                tempLayer.addFeatures(features);

                }});

      }
    }

    this.map.addLayer(tempLayer);
    this.extLayers.push(tempLayer);
    
      /*  ------------------------------------------------------------  
       *    SETUP SELECT FEATURE CONTROL
       *    allow user to select from any existing features on layers 
       *
       *  ------------------------------------------------------------
       */
    if(protocol != 'wms' && afterSelect){
        this.selectLayers.push(tempLayer);
        //Select the features
        if(this.selectFeature == '' ){
            this.selectFeature = new OpenLayers.Control.SelectFeature(this.selectLayers,{
                clickout: true, 
                toggle: true,
                //  multiple: false, hover: false,
                //  toggleKey: "ctrlKey", // ctrl key removes from selection
                //  multipleKey: "shiftKey", // shift key adds to selection
                //  box: true,
                onSelect: function(e){ afterSelect(e,WGS84,WGS84_google_mercator)} ,
                onUnselect: resetCoordinates 
            });

            this.map.addControl(this.selectFeature);
        }else{
           
            this.selectFeature.setLayer(this.selectLayers);
        }
        this.selectFeature.activate();
    
    }    
}


    /*  ------------------------------------------------------------  
     *    toggleControl({options})  
     *    When toolbar buttons are pressed, turn on / off the control
     *    
     *    
     *  ------------------------------------------------------------
     */
MapWidget.prototype.toggleControl = function(element) {

    for(key in this.drawControls) {
        var control = this.drawControls[key];
        if(element.id == key) {
            if(key=='box'){

                if(control.active){
                    control.deactivate();
                    control.layer.removeAllFeatures();
                    resetCoordinates();
                    element.setAttribute("class","olControlDrawFeatureBoxItemInactive");  
                    element.className='olControlDrawFeatureBoxItemInactive';
                }
                else{
                    control.activate();
                    element.setAttribute("class","olControlDrawFeatureBoxItemActive");
                    element.className='olControlDrawFeatureBoxItemActive';
                }
            }else{
                if(control.active){
                    control.deactivate();
                    element.setAttribute("class","olControlDragFeatureBoxItemInactive");
                    element.className='olControlDragFeatureBoxItemInactive';
                }else{
                    control.activate();
                    element.setAttribute("class","olControlDragFeatureBoxItemActive");
                    element.className='olControlDragFeatureBoxItemActive';
                }                            
            }
        } 
    }
}


    /*  ------------------------------------------------------------  
     *    addDataLayer(coordinateSelector)  
     *    Display coordinates in coordinateSelector as markers on map
     *    
     *    
     *  ------------------------------------------------------------
     */
MapWidget.prototype.addDataLayer = function() {

    this.markers = new OpenLayers.Layer.Markers( "Search Results" );
    this.map.addLayer(this.markers);
}

MapWidget.prototype.addMarkerstoDataLayer = function(coordinateSelector){
    var centers = $(coordinateSelector);
    var markers  = this.markers;
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    $.each(centers, function(){
           addMarker($(this).html(), markers, WGS84,WGS84_google_mercator);
      

    });
    function addMarker(lonlat,markers,WGS84,WGS84_google_mercator){
            var word = lonlat.split(',');
            var coords = new OpenLayers.LonLat(word[0],word[1]).transform(WGS84, WGS84_google_mercator)
            var marker = new OpenLayers.Marker(coords);
            markers.addMarker(marker);
    }
}

MapWidget.prototype.clearMarkers = function(){
    this.markers.clearMarkers();
    
}
/*  ------------------------------------------------------------  
 *   FUNCTION TO GET WFS FEATURES AND ADD TO LAYER
 *
 *  ------------------------------------------------------------
 */
function getWFS(url,vectorLayer){
             var protocolS = new OpenLayers.Protocol.WFS(getURL(url + "_wfs"));  

                protocolS.read({
                    callback:  function(response) {
                            if(response.features.length > 0) {
                                _CallBack(response,vectorLayer);
                            } 
                    }
                    });

       return vectorLayer;
       
       /*  ------------------------------------------------------------  
       *   FUNCTION TO ADD FEATURES FROM WFS REQUEST TO LAYER
       *
       *  ------------------------------------------------------------
       */
  
    //add features from call to layer
    function _CallBack(resp,vectorLayer){
        vectorLayer.addFeatures(resp.features);
    }
}

/*  ------------------------------------------------------------  
 *   FUNCTION TO GET STYLES - CONFIGURE STYLEMAPS 
 *
 *  ------------------------------------------------------------
 */

function getStyle(styleName){
    var style;
    var styleSelected;
      switch(styleName){
          case "default" : {
                style = {
                 /*   "Point":  {
                        'externalGraphic': 'http://www.openlayers.org/dev/img/marker-blue.png', 
                        'graphicWidth': '21', 
                        'graphicHeight': '25', 
                        'graphicXOffset': -10, 
                        'graphicYOffset': -25,  
                        'graphicOpacity': 1
                    },
                    "Line": {
                        strokeWidth: 3
                    },
                    "Polygon": {*/
                        pointRadius: 6, 
                        fillColor: '#48D1CC', 
                        fillOpacity: '0.4', 
                        strokeColor: '#48D1CC', 
                        strokeWidth: '1'
                   // }
                }
                styleSelected = {
                    /*"Point":  {
                        'externalGraphic': 'http://www.openlayers.org/dev/img/marker.png', 
                        'graphicWidth': '21', 
                        'graphicHeight': '25', 
                        'graphicXOffset': -10, 
                        'graphicYOffset': -25,  
                        'graphicOpacity': 1
                    },
                    "Line": {
                        strokeWidth: 3
                    },
                    "Polygon": {*/
                        pointRadius: 6,
                        fillColor: '#ff0000', 
                        fillOpacity: '0.4', 
                        strokeColor: '#ff0000', 
                        strokeWidth: '1'
                   // }
                }
                  
          };break;
          case "red" : {
                  style = {
                 /*   "Point":  {
                        'externalGraphic': 'http://www.openlayers.org/dev/img/marker.png', 
                        'graphicWidth': '21', 
                        'graphicHeight': '25', 
                        'graphicXOffset': -10, 
                        'graphicYOffset': -25,  
                        'graphicOpacity': 1
                    },
                    "Line": {
                        strokeWidth: 3
                    },
                     "Polygon": {*/
                         pointRadius: 6,
                        fillColor: '#FFFF00', 
                        fillOpacity: '0.4', 
                        strokeColor: '#FFFF00', 
                        strokeWidth: '1'
                  // }
                }
                styleSelected = {
                 /*   "Point":  {
                        'externalGraphic': 'http://www.openlayers.org/dev/img/marker-green.png', 
                        'graphicWidth': '21', 
                        'graphicHeight': '25', 
                        'graphicXOffset': -10, 
                        'graphicYOffset': -25,  
                        'graphicOpacity': 1
                    },
                    "Line": {
                        strokeWidth: 3
                    },
                    "Polygon": {*/
                        pointRadius: 6,
                        fillColor: '#ff0000', 
                        fillOpacity: '0.4', 
                        strokeColor: '#ff0000', 
                        strokeWidth: '1'
                   // }
                }
          };break;
      }
    // Styling Site Layers
    
    var styleM = new OpenLayers.StyleMap({ "default" : new OpenLayers.Style(style), "select" : new OpenLayers.Style(styleSelected)});
  //  styleM.addUniqueValueRules("default", "type", style);
  //  styleM.addUniqueValueRules("select", "type", styleSelected);
 
    return styleM;
}
    

      /*  ------------------------------------------------------------  
       *    Bind click to toolbar "panel" buttons div 
       *
       *  ------------------------------------------------------------
       */
function enableToolbarClick(mapAdvanced){
      $("#panel div").each(function(){
            $(this).click(function(){
             mapAdvanced.toggleControl(this);
      });
     });
}

      /*  ------------------------------------------------------------  
       *    Bind click to "coords" div 
       *
       *  ------------------------------------------------------------
       */
function enableCoordsClick(){
    
    $('#showCoords').click(function(e){
        $('#coords').toggle('fast');
    });

}

      /*  ------------------------------------------------------------  
       *    Insert feature bounds to coordinate textboxes
       *
       *  ------------------------------------------------------------
       */
function updateCoordinates(feature,WGS84,WGS84_google_mercator){
    
    var bounds = feature.geometry.getBounds();
    bounds.transform(WGS84_google_mercator, WGS84);
   
    $('#spatial-north').val(Math.round(bounds.top*100)/100);
    $('#spatial-west').val(Math.round(bounds.left*100)/100);
    $('#spatial-south').val(Math.round(bounds.bottom*100)/100);
    $('#spatial-east').val(Math.round(bounds.right*100)/100); 
    bounds.transform(WGS84,WGS84_google_mercator);

}

      /*  ------------------------------------------------------------  
       *    Empty coordinate textboxes 
       *
       *  ------------------------------------------------------------
       */
function resetCoordinates(){
    
    $('#spatial-north').val('');
    $('#spatial-west').val('');
    $('#spatial-south').val('');
    $('#spatial-east').val(''); 
   
   
}

      /*  ------------------------------------------------------------  
       *    Populate coordinate textboxes 
       *
       *  ------------------------------------------------------------
       */
function populateCoordinates(n,w,s,e){
    
    $('#spatial-north').val(n);
    $('#spatial-west').val(w);
    $('#spatial-south').val(s);
    $('#spatial-east').val(e); 
   
   
}
 
 


function get_wms_url(bounds) {
	// recalculate bounds from Google to WGS
	var proj = new OpenLayers.Projection("EPSG:4326");
	bounds.transform(new OpenLayers.Projection("EPSG:900913"), proj);
	
	// this is not necessary for most servers display overlay correctly,
	//but in my case the WMS  has been slightly shifted, so I had to correct this with this delta shift
	bounds.left += this.deltaX;
	bounds.right += this.deltaX;
	bounds.top += this.deltaY;
	bounds.bottom += this.deltaY;
	
	//construct WMS request
	var url = this.url;
	url += "&REQUEST=GetMap";
	url += "&SERVICE=WMS";
	url += "&VERSION=1.1.1";
	url += "&LAYERS=" + this.layers;
	url += "&FORMAT=" + this.format;
	url += "&TRANSPARENT=TRUE";
	url += "&STYLES=&SRS=" + "EPSG:4326";
	url += "&BBOX=" + bounds.toBBOX();
	url += "&WIDTH=" + this.tileSize.w;
	url += "&HEIGHT=" + this.tileSize.h;

	return url;
}
