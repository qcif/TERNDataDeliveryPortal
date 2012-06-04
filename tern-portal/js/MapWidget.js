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
        maxExtent : new OpenLayers.Bounds(11548635,-5889094,18604187,-597430),
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
        maxExtent : new OpenLayers.Bounds(11548635,-5889094,18604187,-597430),
        zoomWheelEnabled: true
    });	
   
   this.map.addLayer(gphy);          
   //this.layers.push(gphy); 
    
    //Enable switch layers (that + button on the map)
    this.map.addControl(new OpenLayers.Control.LayerSwitcher());
     //Enable Overview Map
    this.map.addControl(new OpenLayers.Control.OverviewMap({maximized: true, mapOptions: OpenLayers.Util.extend(this.options)}));   
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
    this.drawControls["box"].activate();
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
MapWidget.prototype.addDataLayer = function(clickInfo,style,clustering) {
    var self = this;
    var styleM = getStyle(style);
    var strategy;
    if(clustering){
         /*var style = new OpenLayers.Style({
                    pointRadius: "${radius}",
                    fillColor: "#ffcc66",
                    fillOpacity: 0.8,
                    strokeColor: "#cc6633",
                    strokeWidth: 2,
                    strokeOpacity: 0.8
                }, {
                    context: {
                        radius: function(feature) {
                            return Math.min(feature.attributes.count, 7) + 3;
                        }
                    }
                });
        var styleM = new OpenLayers.StyleMap({
                        "default": style,
                        "select": {
                            fillColor: "#8aeeef",
                            strokeColor: "#32a8a9"
                        }});
                        */
        strategy = new OpenLayers.Strategy.Cluster({distance: 15, threshold: 2});
        this.dataLayer = new OpenLayers.Layer.Vector( "Data Markers", { styleMap: styleM, strategies: [strategy]});
    }else{
        this.dataLayer = new OpenLayers.Layer.Vector( "Data Markers", {styleMap: styleM});
    }
    this.map.addLayer(this.dataLayer);  
    if(clickInfo){
         this.selectControl = new OpenLayers.Control.SelectFeature(this.dataLayer,
                {onSelect: function(e) {                          
                        self.onFeatureSelect(e,this.map,self); },
                onUnselect: function(e) { 
                    this.map.removePopup(e.popup);
                    self.onFeatureUnselect(e,this.map);
                           
                }});
         this.map.addControl(this.selectControl);
         this.selectControl.activate();
    }
}

    /*  ------------------------------------------------------------  
     *    addMarkersDataLayer(coordinateSelector)  
     *    For every coordinateSelector, create a marker
     *    If clickInfo is true, try to find the info and create HTML popup
     *    
     *  ------------------------------------------------------------
     */
MapWidget.prototype.addVectortoDataLayer = function(coordinateSelector,clickInfo){
    var centers = $(coordinateSelector);
    var dataLayer  = this.dataLayer;
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    var number;

    var vectors = Array();
    if(typeof clickInfo == "undefined") clickInfo = false;
    $.each(centers, function(){
            
            if(clickInfo){
                var html ='';
               var title = '';
                 var desc = trimwords($(this).parent().children('p').html(),50);
                if(desc.length>0)
                {
                                        
                    if (desc.length <  $(this).parent().children('p').html().length) desc += "...";
                    var link = $(this).parent().children('h2').children('a').clone().attr('onClick','handleRecordPopup($(this));');
                    title = $('<div>').append(link).html();
                    html  = "<strong>" + $(this).parent().children('h2').children('span.count').html() + title   + "</strong><p>" + desc + "</p>";
                    
                    number = $(this).parent().children('h2').children('span.count').html().replace(".",""); 
                }
             
            }else { number = ''}
            if($(this).html().indexOf(' ') != -1){ 
             vectors.push(addVector($(this).html(), dataLayer, WGS84,WGS84_google_mercator, html,number, title));    
            }else{
             vectors.push(addMarker($(this).html(), dataLayer, WGS84,WGS84_google_mercator, html,number,title));
            }

    }); 
    dataLayer.addFeatures(vectors);
    var bounds = dataLayer.getDataExtent();
    if(bounds)  this.map.zoomToExtent(bounds); 
    if(this.map.zoom > 5) this.map.zoomTo(5);
    
    function addMarker(lonlat,dataLayer,WGS84,WGS84_google_mercator,html, number, title){
            var word = lonlat.split(',');
            var point = new OpenLayers.Geometry.Point(word[0],word[1]);
            point.transform(WGS84, WGS84_google_mercator);
            var attributes = {popupHTML: html, title: title, type: "point", number: number}
            var feature = new OpenLayers.Feature.Vector(point, attributes);
            /*if(html != ''){
            AutoSizeAnchored = OpenLayers.Class(OpenLayers.Popup.Anchored, {
                'autoSize': true,
                'maxSize': new OpenLayers.Size(500,150)
            });

            feature.closeBox = true;
            feature.data.popupContentHTML = html;
            feature.popupClass = AutoSizeAnchored;
            feature.data.overflow = "auto";
                var markerClick = function(evt){
                    this.createPopup(this.closeBox);
                    markers.map.addPopup(this.popup);
                    this.popup.show();
                };
            }
            var marker = feature.createMarker();
           
            if(html!= ''){
                marker.events.register("click",feature,markerClick);
            }*/ 
        return feature;
            //dataLayer.addFeatures([feature]);
    } 
    
    function addVector(coordinates,dataLayer,WGS84,WGS84_google_mercator,html,title){
            var points = coordinates.split(' ');
            var vector_points = Array();
            $.each(points, function(i, s){
                 var word = s.split(',');
                 var point = new OpenLayers.Geometry.Point(word[0],word[1]);
                 point.transform(WGS84, WGS84_google_mercator);
                 vector_points.push(point);
            });
           
            var linear_ring = new OpenLayers.Geometry.LinearRing(vector_points);
            var attributes = {popupHTML: html,title: title,  type: "polygon", number: number}
            var feature = new OpenLayers.Feature.Vector(
                        new OpenLayers.Geometry.Polygon([linear_ring]),attributes);          

            return feature;
      }
}
 
MapWidget.prototype.removeAllFeatures = function(){
    this.dataLayer.removeAllFeatures();
    for (var i=0; i<this.map.popups.length; ++i) 
    { 
        this.map.removePopup(this.map.popups[i]); 
    }; 
    
}

/* Use coordStr to update Map Vector*/
MapWidget.prototype.updateDrawing = function(map,coordStr){
    var control = this.drawControls['box'];
     control.layer.removeAllFeatures();
     var bounds = OpenLayers.Bounds.fromString(coordStr);
     
     var box = new OpenLayers.Feature.Vector(bounds.toGeometry().transform(this.WGS84,this.WGS84_google_mercator));
     control.layer.addFeatures(box);
}


      /*  ------------------------------------------------------------  
       *    Feature Select methods
       *
       *  ------------------------------------------------------------
       */
MapWidget.prototype.onFeatureSelect = function(feature,map,mapWidgetObj){
    selectedFeature = feature; 
    if(!feature.cluster){
        popup = new OpenLayers.Popup.Anchored("chicken",
            feature.geometry.getBounds().getCenterLonLat(),
            null, feature.data.popupHTML, null, true, function(){ mapWidgetObj.onPopupClose(mapWidgetObj);});
        popup.maxSize = new OpenLayers.Size(480,150);
        popup.panMapIfOutOfView = true;
        popup.autoSize = true;
      
    }else{
        var html = '';
        $.each(feature.cluster,function(){
            html = html + "<strong>" + this.data.number + ". " +  this.data.title  + "</strong><br/>";
         });
            popup = new OpenLayers.Popup.Anchored("chicken",
            feature.geometry.getBounds().getCenterLonLat(),
            null, html, null, true, function(){ mapWidgetObj.onPopupClose(mapWidgetObj);});
            popup.maxSize = new OpenLayers.Size(440,180);
            popup.panMapIfOutOfView = true;
            popup.autoSize = true;
    }
     feature.popup = popup;   
     map.addPopup(feature.popup);     
            
}

MapWidget.prototype.onPopupClose = function(mapWidgetObj){
    mapWidgetObj.selectControl.unselectAll();
}

MapWidget.prototype.onFeatureUnselect = function(feature,map){
    map.removePopup(feature.popup);
    feature.popup.destroy();
    feature.popup=null;    
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
    var context = {};
      switch(styleName){
          case "default" : {
                style = {
                        pointRadius: "${radius}", 
                        fillColor: '${bgcolor}', 
                        fillOpacity: '0.7', 
                        strokeColor: '#000000', 
                        strokeWidth: '1',
                        label: "${count}",
                        labelSelect: true   
                };
               
                styleSelected = {
                         fillColor: '#ff0000', 
                         strokeColor: '#000000'
                  }      
                  
               context =  {
                    bgcolor: function(feature){
                        if(feature.attributes.count > 1) {
                            return "#FFFF00";
                        }else{
                            return "#48D1CC";
                        }
                    },
                    radius: function(feature){
                        if(feature.attributes.count > 1) {
                            return Math.min(feature.attributes.count,9) + 9;
                        }else{
                            return 9;
                        }
                    },
                    count: function(feature){
                        if(feature.attributes.count > 1) {
                            return feature.cluster[0].attributes.number  + "+";
                        }else{
                            return feature.attributes.number;
                        }
                    }
                };
          };break;
          case "red" : {
                  style = {
                    pointRadius: 9,
                        fillColor: '#FFFF00', 
                        fillOpacity: '1', 
                        strokeColor: '#000000', 
                        strokeWidth: '1',
                        label: "${number}",
                        labelSelect: true

                };
                styleSelected = {
                     pointRadius: 9,
                        fillColor: '#ff0000', 
                        fillOpacity: '1',  
                        strokeColor: '#000000', 
                        strokeWidth: '1',
                        label: "${number}",
                        labelSelect: true
                };
          };break;
          case "transparent" : {
                       style = {
                        pointRadius: 9, 
                        fillColor: '#48D1CC', 
                        fillOpacity: '0.7', 
                        strokeColor: '#000000', 
                        strokeWidth: '1',
                        label: "${number}",
                        labelSelect: true

                }
                styleSelected = {

                        pointRadius: 9,
                        fillColor: '#ff0000', 
                        fillOpacity: '0.7', 
                        strokeColor: '#000000', 
                        strokeWidth: '1',
                        label: "${number}",
                        labelSelect: true
                }
          };break;
      }
    // Styling Site Layers
    
    var styleM = new OpenLayers.StyleMap({ "default" : new OpenLayers.Style(style,{context:context}), "select" : new OpenLayers.Style(styleSelected,{context:context})});
  //  styleM.addUniqueValueRules("default", "type", style);
  //  styleM.addUniqueValueRules("select", "type", styleSelected);
 
    return styleM;
}
    

      /*  ------------------------------------------------------------  
       *    Bind changes to coordinates textbox 
       *
       *  ------------------------------------------------------------
       */
function enableCoordsChange(map){
   
      $("#coords input").change(function(){
           var coordStr = '';
          coordStr += $('#spatial-west').val() +  "," + $('#spatial-south').val() + "," +
              $('#spatial-east').val() + "," + $('#spatial-north').val();
          
         map.updateDrawing(map,coordStr);
     });
}

      /*  ------------------------------------------------------------  
       *    Bind click to toolbar "panel" buttons div 
       *
       *  ------------------------------------------------------------
       */
function enableToolbarClick(map){
      $("#panel div").each(function(){
            $(this).click(function(){
             map.toggleControl(this);
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
