/*      !!!!CONFIGURE DATA SOURCES FOR EXTERNAL LAYERS HERE!!!!
 *         
 */

function getURL(keyword, matrixIds){     
    var URLList = {
        "dummy" : base_url + 'api/output.json',
        "nr:regions" : 'http://' +  window.location.hostname + '/geoserver/wms', 
        "intersectPt":  base_url + 'regions/r/intersectPt/'          
    }
    return URLList[keyword];

}

/*      !!!!END OF EXTERNAL DATA CONFIGURATION!!!!
 *         
 */

 
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

/* Openlayers hack for IE*/
 OpenLayers.Renderer.VML.prototype.drawText = function(featureId, style, location) {
        var label = this.nodeFactory(featureId + this.LABEL_ID_SUFFIX, "olv:rect");
        var textbox = this.nodeFactory(featureId + this.LABEL_ID_SUFFIX + "_textbox", "olv:textbox");
        
        var resolution = this.getResolution();
        label.style.left = ((location.x/resolution - this.offset.x) | 0) + "px";
        label.style.top = ((location.y/resolution - this.offset.y) | 0) + "px";
        label.style.flip = "y";

        textbox.innerText = style.label;

        if (style.cursor != "inherit" && style.cursor != null) {
            textbox.style.cursor = style.cursor;
        }
        if (style.fontColor) {
            textbox.style.color = style.fontColor;
        }
        if (style.fontOpacity) {
            textbox.style.filter = 'alpha(opacity=' + (style.fontOpacity * 100) + ')';
        }
        if (style.fontFamily) {
            textbox.style.fontFamily = style.fontFamily;
        }
        if (style.fontSize) {
            textbox.style.fontSize = style.fontSize;
        }
        if (style.fontWeight) {
            textbox.style.fontWeight = style.fontWeight;
        }
        if (style.fontStyle) {
            textbox.style.fontStyle = style.fontStyle;
        }
        if(style.labelSelect === true) {
            label._featureId = featureId;
            textbox._featureId = featureId;
            textbox._geometry = location;
            textbox._geometryClass = location.CLASS_NAME;
        }
        textbox.style.whiteSpace = "nowrap";
        // fun with IE: IE7 in standards compliant mode does not display any
        // text with a left inset of 0. So we set this to 1px and subtract one
        // pixel later when we set label.style.left
        textbox.inset = "1px,0px,0px,0px";

            label.appendChild(textbox);
            this.textRoot.appendChild(label);
       
        var align = style.labelAlign || "cm";
        if (align.length == 1) {
            align += "m";
        }
        var xshift = textbox.clientWidth *
            (OpenLayers.Renderer.VML.LABEL_SHIFT[align.substr(0,1)]);
        var yshift = textbox.clientHeight *
            (OpenLayers.Renderer.VML.LABEL_SHIFT[align.substr(1,1)]);
        label.style.left = parseInt(label.style.left)-xshift-1+"px";
        label.style.top = parseInt(label.style.top)+yshift+"px";
        
    }
    
/*       MAIN WIDGET CLASS 
 *       Where the map is created  
 *      mapId is the div ID name to load the map in. Note that this is not a selector so should not have a '#' in front
 *      overviewMap true means the overviewMap will be displayed at the right bottom screenn
 *      options for now is only used when sending a customised array of base layers to list as options . for example 
 *          options.layer = [new OpenLayers.Layer.Google(
                "Google Physical",
                {type: google.maps.MapTypeId.TERRAIN}
             )]; 
 */

function MapWidget(mapId, overviewMap, options){

    this.map = '';
    this.drawControls = '';
    this.overviewMap = true;
    this.overviewMap = overviewMap;
    
    var options = options || {};
      // World Geodetic System 1984 projection (lon/lat)
    this.WGS84 = new OpenLayers.Projection("EPSG:4326");

    // WGS84 Google Mercator projection (meters)
    this.WGS84_google_mercator = new OpenLayers.Projection("EPSG:900913");

    //Store all layers in an array
    this.extLayers = new Array();
    this.selectLayers = new Array();
    this.selectFeature = '';
    this.mapBounds = new OpenLayers.Bounds(-20037508.34, -20037508.34, 20037508.34, 20037508.34);
    //   this.mapBounds = new OpenLayers.Bounds(12234012.036478, -5761139.9444121, 17537272.577131, -5761139.9444121);
   
    /*  ------------------------------------------------------------  
     *    CREATE MAP OBJECT 
     *
     *  ------------------------------------------------------------
     */
    this.navControl = new OpenLayers.Control.Navigation({zoomWheelEnabled: false}); 
    this.options = {
        units : 'm',
        numZoomLevels : 12,
        minZoomLevel: 4,
        maxExtent : this.mapBounds,
        maxResolution:'auto', 
        projection: this.WGS84_google_mercator,
        displayProjection: this.WGS84,
        controls: [ this.navControl]        
    };
    this.map = new OpenLayers.Map(mapId, this.options);
     


    /* Override pan bar */
    function customZoom(options){
    var panZoomBar = new OpenLayers.Control.PanZoomBar(options);
    OpenLayers.Util.extend(panZoomBar,{
        _addButton:function(id, img, xy, sz) {
        var imgLocation = img;
        var btn = OpenLayers.Util.createAlphaImageDiv(
                                    this.id + "_" + id,
                                    xy, sz, imgLocation, "absolute");
        btn.style.cursor = "pointer";
        //we want to add the outer div
        this.div.appendChild(btn);

        OpenLayers.Event.observe(btn, "mousedown",
            OpenLayers.Function.bindAsEventListener(this.buttonDown, btn));
        OpenLayers.Event.observe(btn, "dblclick",
            OpenLayers.Function.bindAsEventListener(this.doubleClick, btn));
        OpenLayers.Event.observe(btn, "click",
            OpenLayers.Function.bindAsEventListener(this.doubleClick, btn));
        btn.action = id;
        btn.map = this.map;
    
        if(!this.slideRatio){
            var slideFactorPixels = this.slideFactor;
            var getSlideFactor = function() {
                return slideFactorPixels;
            };
        } else {
            var slideRatio = this.slideRatio;
            var getSlideFactor = function(dim) {
                return this.map.getSize()[dim] * slideRatio;
            };
        }

        btn.getSlideFactor = getSlideFactor;

        //we want to remember/reference the outer div
        this.buttons.push(btn);
        return btn;
         },
          _addZoomBar:function(centered) {
        var imgLocation = base_url;//OpenLayers.Util.getImagesLocation();        
        var id = this.id + "_" + this.map.id;
        var zoomsToEnd = this.map.getNumZoomLevels() - 1 - this.map.getZoom();
        var slider = OpenLayers.Util.createAlphaImageDiv(id,
                       centered.add(-1, zoomsToEnd * this.zoomStopHeight),
                       new OpenLayers.Size(20,16), // this was changed to our img dimensions
                       imgLocation+"img/buttons/map-tools/map-tools-zoom-handle-normal-btn.png", // this was changed to our img path
                       "absolute");
        slider.style.cursor = "move";
        this.slider = slider;
        
        this.sliderEvents = new OpenLayers.Events(this, slider, null, true,
                                            {includeXY: true});
        this.sliderEvents.on({
            "touchstart": this.zoomBarDown,
            "touchmove": this.zoomBarDrag,
            "touchend": this.zoomBarUp,
            "mousedown": this.zoomBarDown,
            "mousemove": this.zoomBarDrag,
            "mouseup": this.zoomBarUp,
            "dblclick": this.doubleClick,
            "click": this.doubleClick
        });
        
        var sz = new OpenLayers.Size();
        sz.h = this.zoomStopHeight * this.map.getNumZoomLevels();
        sz.w = this.zoomStopWidth;
        var div = null;
        
        if (OpenLayers.Util.alphaHack()) {
            var id = this.id + "_" + this.map.id;
            div = OpenLayers.Util.createAlphaImageDiv(id, centered,
                                      new OpenLayers.Size(sz.w,
                                              this.zoomStopHeight),
                                      imgLocation + "/img/buttons/map-tools/map-tools-zoom-bar.png", // changed to our img path
                                      "absolute", null, "crop");
            div.style.height = sz.h + "px";
        } else {
            div = OpenLayers.Util.createDiv(
                        'OpenLayers_Control_PanZoomBar_Zoombar' + this.map.id,
                        centered,
                        sz,
                        imgLocation+ "/img/buttons/map-tools/map-tools-zoom-bar.png"); // changed to our img path
        }
        div.style.cursor = "pointer";
        this.zoombarDiv = div;
        
        this.divEvents = new OpenLayers.Events(this, div, null, true,
                                                {includeXY: true});
        this.divEvents.on({
            "touchmove": this.passEventToSlider,
            "mousedown": this.divClick,
            "mousemove": this.passEventToSlider,
            "dblclick": this.doubleClick,
            "click": this.doubleClick
        });
        
        this.div.appendChild(div);

        this.startTop = parseInt(div.style.top);
        this.div.appendChild(slider);

        this.map.events.register("zoomend", this, this.moveZoomBar);

        centered = centered.add(0,
            this.zoomStopHeight * this.map.getNumZoomLevels());
        return centered;
    },
          draw: function(px) {
        // initialize our internal div
        OpenLayers.Control.prototype.draw.apply(this, arguments);
        px = this.position.clone();

        // place the controls
        this.buttons = [];

        var sz = new OpenLayers.Size(34,34);
        if (this.panIcons) {
            var centered = new OpenLayers.Pixel(px.x+sz.w/2, px.y);
            var wposition = sz.w;

            if (this.zoomWorldIcon) {
                centered = new OpenLayers.Pixel(px.x+sz.w, px.y);
            }

            this._addButton("panup", '/img/buttons/map-tools/map-tools-pan-north-normal-btn.png', centered, sz); // changed to our img path
            px.y = centered.y+sz.h;
            this._addButton("panleft", '/img/buttons/map-tools/map-tools-pan-west-normal-btn.png', px, sz);// changed to our img path
            if (this.zoomWorldIcon) {
                this._addButton("zoomworld", "zoom-world-mini.png", px.add(sz.w, 0), sz);

                wposition *= 2;
            }
            this._addButton("panright", '/img/buttons/map-tools/map-tools-pan-east-normal-btn.png', px.add(wposition, 0), sz);// changed to our img path
            this._addButton("pandown", '/img/buttons/map-tools/map-tools-pan-south-normal-btn.png', centered.add(0, sz.h*2), sz);// changed to our img path
            this._addButton("zoomin", '/img/buttons/map-tools/map-tools-zoom-in-normal-btn.png', centered.add(0, sz.h*3+5), sz);// changed to our img path
            centered = this._addZoomBar(centered.add(8, sz.h*4 + 5)); // changed to our img size adjustment
            this._addButton("zoomout", '/img/buttons/map-tools/map-tools-zoom-out-normal-btn.png', centered.add(-8,0), sz);// changed to our img path
        }
        else {
            this._addButton("zoomin", "/img/buttons/map-tools/map-tools-zoom-in-normal-btn.png", px, sz);// changed to our img path
            centered = this._addZoomBar(px.add(0, sz.h));
            this._addButton("zoomout", "/img/buttons/map-tools/map-tools-zoom-out-normal-btn.png", centered, sz);// changed to our img path
            if (this.zoomWorldIcon) {
                centered = centered.add(0, sz.h+3);
                this._addButton("zoomworld", "zoom-world-mini.png", centered, sz);// changed to our img path
            }
        }
        return this.div;
    }   
    });
        return panZoomBar;
    }
     this.map.addControl(new customZoom());

/*  ------------------------------------------------------------  
     *    ADD GOOGLE BASE MAP LAYER
     *
     *  ------------------------------------------------------------
     */
  
      
    this.gphy = new OpenLayers.Layer.Google(
        "Google Physical",
        {type: google.maps.MapTypeId.TERRAIN}
    );
    this.gmap = new OpenLayers.Layer.Google(
        "Google Streets", // the default
        {numZoomLevels: 20}
    );
    this.ghyb = new OpenLayers.Layer.Google(
        "Google Hybrid",
        {type: google.maps.MapTypeId.HYBRID, numZoomLevels: 20}
    );
    this.gsat = new OpenLayers.Layer.Google(
        "Google Satellite",
        {type: google.maps.MapTypeId.SATELLITE, numZoomLevels: 22}
    );
    var layers = options.layer || [this.gphy, this.gmap, this.ghyb, this.gsat]; 
    this.zoomRefine = false;
    
    this.map.addLayers(layers);
          
   
    //Enable switch layers (that + button on the map) 
    //this.map.addControl(new OpenLayers.Control.LayerSwitcher());
    
    //Enable Overview Map
    if(this.overviewMap){
        var options = { 
            mapOptions: {numZoomLevels: 1,  
                maxExtent : this.mapBounds,           
                projection: this.WGS84_google_mercator,
                displayProjection: this.WGS84,
                minZoomLevel: 2
        },        
          minRatio: this.map.getResolution()/this.map.getResolutionForZoom(5), 
           // isSuitableOverview: function() {return true;},         
           //  units: "m",
           maximized: true,
           //  numZoomLevels: 1,
            maxRatio: this.map.getResolution()/this.map.getResolutionForZoom(5),//Number.POSITIVE_INFINITY, 
            autoPan: true
        };
        this.map.addControl(new OpenLayers.Control.OverviewMap( options));
    }
    
    // look at Australia !
    if (!this.map.getCenter()) this.map.zoomToExtent(new OpenLayers.Bounds( 11548635,-5889094,18604187,-597430));
      
     
}

/*  ------------------------------------------------------------  
 *    registerClickRegions()  
 *    Register click event listener to map 
 *    When clicked, sends parameters to handleMapClick
 *  ------------------------------------------------------------
 */

MapWidget.prototype.registerClickRegions = function(layers,callback){
    var obj = this;
    this.map.events.register('click', this.map, function(e){           
        obj.handleMapClickRegions(e,layers,callback);   
       
    });    
     
}

/*  ------------------------------------------------------------  
 *    registerMoveEnd()  
 *    Register Move End listener to map
 *    When moved, call the function
 *  ------------------------------------------------------------
 */

MapWidget.prototype.registerMoveEnd = function(callback){
    var obj = this;
    this.map.events.register("moveend",this.map,function(){
        callback(obj);
    });
}
    
/*  ------------------------------------------------------------  
 *    registerClickInfo()  
 *    Register click event listener to map 
 *    When clicked, sends parameters to handleWMSGetInfo
 *  ------------------------------------------------------------
 */

MapWidget.prototype.registerClickInfo = function(options,callback){
    var obj = this;
    obj.handleWMSGetInfo(options,callback);   
      
      
}
/*  ------------------------------------------------------------  
 *    getSelectedId()  
 *    Returns the selected region ID combined with the layer Id
 *    
 *  ------------------------------------------------------------
 */

MapWidget.prototype.getSelectedId = function(){
   if(this.selectedFeatureId){
        return (this.selectedFeatureLayer + ":" + this.selectedFeatureId);
   }else{
       return false;
   }
}

/*  ------------------------------------------------------------  
 *    setSelectedId()  
 *    Set the selected region ID 
 *    
 *  ------------------------------------------------------------
 */

MapWidget.prototype.setSelectedId = function(selectedFeatureLayer, selectedFeatureId, selectedFeatureName){
   this.selectedFeatureLayer = selectedFeatureLayer;
   this.selectedFeatureId = selectedFeatureId;
   this.selectedFeatureName = selectedFeatureName;
   
}

/*
 *
 *
 */
function onRegionClick(){
       
        info = new OpenLayers.Control.WMSGetFeatureInfo({
            url: getURL(url), 
            title: 'Identify features by clicking',
            infoFormat: 'application/vnd.ogc.gml', 
            queryVisible: true,
            eventListeners: {
                getfeatureinfo: function(event) {
                    var text = '';
                    for (var i = 0; i < event.features.length; i++) {
                        var feature = event.features[i];
                        var attributes = feature.attributes;
                        text += ',' + feature.fid;
                    } //Get feature id from the feature list
                    if(text!=""){
                        if (!this.highlightLayer) {    
                            this.highlightLayer = new OpenLayers.Layer.WMS("Highlight Layer",getURL(url),{
                                //height: '512',
                                //width: '242',  
                                layers: url,
                                styles: 'polygon', 
                                featureid: text,
                                srs: 'EPSG:900913',
                                format: 'image/png',
                                //tiled: 'true',
                                transparent: true
                            }, {
                                buffer:0, 
                                displayOutsideMaxExtent: false,
                                displayInLayerSwitcher: false,
                                isBaseLayer: false
                            });
                            this.map.addLayer(this.highlightLayer);
                        }else { 
                    
                            this.highlightLayer.mergeNewParams({
                                featureid: text
                            });
             
                        }
                    }
                }
            }
        });
        
        this.map.addControl(info);
        info.activate();
            
}

/*  ------------------------------------------------------------  
 *    function handleWMSGetInfo(e, callback)
 *    e: event 
 *    callback: callback to run after complete   
 *    Runs a WMS Get Info request with the event to retrieve html 
 *  ------------------------------------------------------------
 */

MapWidget.prototype.handleWMSGetInfo = function(options,callback){
    var options = options || {};
    var url = options.url || false;
    var layers = options.layers;
    var arrLayer = [];
     for(var j=0;j<layers.length; j++){
        for(var i=0;i<this.extLayers.length; i++){
                if(this.extLayers[i].name == layers[j]) { 
                     arrLayer.push(this.extLayers[i]);}                     
        }
     }
    this.info = new OpenLayers.Control.WMSGetFeatureInfo({
            url: url, 
            title: 'Identify features by clicking',
            infoFormat: 'text/html', 
            queryVisible: true, 
            layers: arrLayer,
            eventListeners: {
                getfeatureinfo: function(event) {     
                    var length = event.text.length;
                     while( this.map.popups.length ) {
                        this.map.removePopup(this.map.popups[0]);
                    }
                    var offset = {'size':new OpenLayers.Size(0,0),'offset':new OpenLayers.Pixel(10,-30)};
     
                    CustomFramedCloudPopupClass = OpenLayers.Class(OpenLayers.Popup.Anchored, {
                        'backgroundColor': '#FFFFFF', 
                        'border': '1px solid black',
                        'displayClass' : 'popupGroup',
                        'contentDisplayClass' : 'popupContentScroll',
                        'padding' : new OpenLayers.Bounds(0,0,10,0),                       
                        'autoSize' : true
                    });   

                    if(length > 687){
                        var html = event.text; // +  "<img class=\"mapArrow\" src=\"/img/buttons/map-tools/map_arrow_white.png\"/>"
                        var popup = new CustomFramedCloudPopupClass("chicken",
                                this.map.getLonLatFromPixel(event.xy),
                                null, html, offset, true);    
       
                            popup.minSize = new OpenLayers.Size(490,100);        
                            popup.maxSize = new OpenLayers.Size(490,200);
                            popup.calculateRelativePosition = function () {
                                return 'br';
                            }          
                            popup.panMapIfOutOfView = true;
                    this.map.addPopup(popup);
                    }
                }
            }
                
         });
         this.map.addControl(this.info);
         this.info.activate();   
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
    var allowMultiple = options.allowMultiple || false;
    var afterDraw = options.afterDraw || null; 
    
      
    //Box Layer declaration
    var boxLayer = new OpenLayers.Layer.Vector("Box");

    boxLayer.events.register('beforefeatureadded',boxLayer, (function(feature){ 
        if(!allowMultiple){   // No multiple boxes yet
            if(boxLayer.features.length > 0) {
                boxLayer.removeAllFeatures();       
            }
        }
        // set other layers to hide when drawing starts
        if(this.extLayers){       
            for(var layer in this.extLayers){
                if(typeof this.extLayers[layer] == "[object]" )  this.extLayers[layer].setVisibility(false);
            }       
        }
     
       
    }).bind(this));
    
     /*
    //poly Layer declaration
    var polyLayer = new OpenLayers.Layer.Vector("Poly");

    polyLayer.events.register('beforefeatureadded',polyLayer, (function(feature){ 
        if(!allowMultiple){   // No multiple polygons
            if(polyLayer.features.length > 0) {
                polyLayer.removeAllFeatures();       
            }
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
    
    */
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    
   
        var handlerOptions = {
            sides: 4, 
            irregular: true
        };
   
       
    this.drawControls = {
        box: new OpenLayers.Control.DrawFeature(boxLayer,
        OpenLayers.Handler.RegularPolygon, {                
            handlerOptions: handlerOptions,
            featureAdded:  function(e){
                afterDraw(e,WGS84, WGS84_google_mercator);
                
            }
        })
        /*poly: new OpenLayers.Control.DrawFeature(polyLayer,
                        OpenLayers.Handler.Polygon)*/
                        
        /*drag: new OpenLayers.Control.DragFeature(boxLayer, {
            onComplete:function(e){
                       
                afterDrag(e,WGS84, WGS84_google_mercator);
                
            }*/
        };
    //Add controls to map
    for(var key in this.drawControls) {
        this.map.addControl(this.drawControls[key]);
    }

  
    
    this.map.addLayers([boxLayer]); 
    //make sure this layer is on top.
    this.map.raiseLayer(boxLayer,this.map.layers.length);
  //  this.map.raiseLayer(polyLayer,this.map.layers.length);
    
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
    var layerName = options.layerName || url;
    var geoLayer = options.geoLayer;
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    var tempLayer = '';
    var visibility = options.visibility || false;
    var styleM = getStyle(style);

    OpenLayers.ProxyHost= base_url + "api/geoproxy.php?url=";
    
    // what is the protocol? 
    switch(protocol){
        case "WFS": { // this is currently unused, the code is kept in case functionality will be required
                if(layerName!='supersites'){
                    tempLayer =  new OpenLayers.Layer.Vector(layerName.capitalize(), {
                        styleMap: styleM
                    });
                }else{
                    tempLayer =  new OpenLayers.Layer.Vector(layerName.capitalize(), {
                        styleMap: styleM, 
                        preFeatureInsert: function(feature) {
                            feature.geometry.transform(WGS84,WGS84_google_mercator);
                        }
                    });       
                }
                getWFS(layerName,tempLayer);  
            };        
            break;
        case "WMS": {
                switch(layerName){
                  
                    default: {
                            tempLayer = new OpenLayers.Layer.WMS(layerName,url,{
                                //   height: '512',
                                //   width: '242', 
                                layers: geoLayer,
                                styles: '',
                                srs: 'EPSG:900913',
                                format: 'image/png',
                                // tiled: 'true',
                                transparent: 'true'
                            },
                            {
                                buffer:0, 
                                isBaseLayer: false
                            });
                        };
            
                        break;
            
                }
            };
    
            break;
        case "GEOJSON": { // this is currently unused, the code is kept in case functionality will be required
                tempLayer =  new OpenLayers.Layer.Vector(layerName.capitalize(), {
                    projection: WGS84
                });   
                var p = new OpenLayers.Format.GeoJSON({
                    'externalProjection': WGS84, 
                    'internalProjection': WGS84_google_mercator
                });

                OpenLayers.Request.GET({ 
                    url: getURL(layerName), 
                    callback: function (response) {
                        var gformat = new OpenLayers.Format.GeoJSON({
                            'externalProjection': WGS84, 
                            'internalProjection': WGS84_google_mercator
                        }); 
                
                        var features = gformat.read(response.responseText);

                        tempLayer.addFeatures(features);

                    }
                });

            }
    }
    if(!visibility){tempLayer.setVisibility(visibility);}
    this.map.addLayer(tempLayer);
    this.extLayers.push(tempLayer);

    
    /*  ------------------------------------------------------------  
     *    SETUP SELECT FEATURE CONTROL
     *    allow user to select from any existing features on layers 
     *
     *  ------------------------------------------------------------
     */
    if(protocol != 'WMS' && afterSelect){
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
                onSelect: function(e){
                    afterSelect(e,WGS84,WGS84_google_mercator)
                } ,
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
 *    setHighlightLayer(r_id)
 *    r_id : region id being highlighted
 *    creates a MapWidget.highlightLayer object and displays
 *    the highlighted region through WMS request
 *  ------------------------------------------------------------
 */

MapWidget.prototype.setHighlightLayer = function(r_id,options){
    var options = options || {};
    var style_name = options.style_name || "polygon";
    if (!this.highlightLayer) {    
        this.highlightLayer = new OpenLayers.Layer.WMS("Highlight Layer",getURL('nr:regions'),{ //nr:regions is the geoserver layer name that corresponds to table regions in tern_spatial database
            layers: 'nr:regions',
            styles: style_name, 
            featureid: r_id,
            srs: 'EPSG:900913',
            format: 'image/png',
            tiled: 'true',
            transparent: true
        }, {
            buffer:0, 
            displayOutsideMaxExtent: false,
            displayInLayerSwitcher: false,
            isBaseLayer: false
        });
        this.map.addLayer(this.highlightLayer);
    }else { 

        this.highlightLayer.mergeNewParams({
            featureid: r_id,
            styles: style_name
        });
        this.highlightLayer.setVisibility(true);
    }    
    //this.map.raiseLayer(this.highlightLayer,this.map.layers.length-1);
     
   
}


/*  ------------------------------------------------------------  
 *    getZoomRefine
 *    Functionality currently not used
 *    
 *  ------------------------------------------------------------
 */

MapWidget.prototype.getZoomRefine = function(){
    return this.zoomRefine; 
}


/*  ------------------------------------------------------------  
 *    setZoomRefine
 *    Functionality currently not used
 *    enables searching results based on zoom levels
 *  ------------------------------------------------------------
 */


MapWidget.prototype.setZoomRefine = function(){
    if(this.zoomRefine == true){
        this.zoomRefine = false;
        
    }else{
        this.zoomRefine = true;
    } 
}

/*  ------------------------------------------------------------  
 *    toggleNavControl
 *    Functionality currently not used
 *    enables turning on and off zoom wheel for the map. By default it is set false in MapWidget constructor  
 *  ------------------------------------------------------------
 */
MapWidget.prototype.toggleNavControl = function(element){
    if(this.navControl.zoomWheelEnabled == true){
        this.navControl.disableZoomWheel();     
    }else{
        this.navControl.enableZoomWheel();      
    } 
}

/*  ------------------------------------------------------------  
 *    getFeatureCoordinates()
 *    returns the coordinates for a feature
 *    
 *  ------------------------------------------------------------
 */

MapWidget.prototype.getFeatureCoordinates = function(){
    var geom = [];
    var verticesNative;
         for(var i=0;i<this.map.layers.length;i++){
            for(var key in this.drawControls) {
                if(this.map.layers[i].name == key.capitalize()){
                     if(this.map.layers[i].features.length == 1) { // only supports one feature for now. 
                     verticesNative = this.map.layers[i].features[0].geometry.getVertices();
                     
                      for (var x in verticesNative) {
                            geom.push(verticesNative[x].clone().transform(this.WGS84_google_mercator, this.WGS84));
                            
                      }
                      break;
                }
            }
            }
         }
        return geom;
}

/*  ------------------------------------------------------------  
 *    getExtentCoords()
 *    returns the coordinates for the map extent as a bounds object 
 *    
 *  ------------------------------------------------------------
 */

MapWidget.prototype.getExtentCoords = function(){
        return coords = this.map.getExtent().transform(this.WGS84_google_mercator, this.WGS84);       
}

/*  ------------------------------------------------------------  
 *    handleMapClickRegions(e,  layers, callback)
 *    e : Click Event
 *    layers: Layers list from the regions.json
 *    Callback function to call after completed 
 *    Function will find the region ID being clicked by the user
 *  ------------------------------------------------------------
 */

MapWidget.prototype.handleMapClickRegions = function(e, layers, callback){
   var lonlat = this.map.getLonLatFromViewPortPx(e.xy);
    var layer,l_id;
    for(var i=0;i<this.extLayers.length;i++){
        if(this.extLayers[i].visibility == true){           
            layer = this.extLayers[i].name;
            $.each(layers,function(key,val){
                if(val.l_id == layer){
                    l_id = val.l_id;                      
                }
            });
            if(l_id){
                var obj = this;  
                lonlat.transform( this.map.projection, this.map.displayProjection);
                $.getJSON(getURL("intersectPt") + lonlat.lon + '/' + lonlat.lat + '/' + l_id,function(data){
                            
                    $.each(data,function(key,val){
                        obj.selectedFeatureName = val.r_name;
                        obj.selectedFeatureId = val.r_id;
                        obj.selectedFeatureLayer = val.l_id;
                        obj.setHighlightLayer(val.r_id, {style_name: 'PolyHighlight'});
                               
                        if(typeof(callback) == 'function') callback(e, obj);
                        return(false);
                    });

                });           
            }

        }

    }  
}
/*  ------------------------------------------------------------  
 *    setBaseLayer(id)  
 *    Change base layer displayed
 *    id = id of base layer
 *    
 *  ------------------------------------------------------------
 */
MapWidget.prototype.setBaseLayer = function(id) {
    this.map.baseLayerId = id;
    this.map.setBaseLayer(this[id]);
    $("#map-view-selector a").attr("class","");
    $("#map-view-selector #" + id).attr("class","current");
    
     
}
/*  ------------------------------------------------------------  
 *    deactivateAllControls()  
 *    Deactivate all drawing controls
 *    
 *    
 *  ------------------------------------------------------------
 */
MapWidget.prototype.deactivateAllControls = function() {
      for(var key in this.drawControls) {
            var control = this.drawControls[key];
            if(control.active){
                this.toggleControl($("#" + key).get(0));
                break;
            }            
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
  
        for(var key in this.drawControls) {
            var control = this.drawControls[key];
             if(element.id == key) {               
                 if(control.active){
                        control.deactivate();
                        element.setAttribute("class", key + "Btn");  
                          $("#drag").attr("class","panBtnActive"); 
                    }
                    else{
                        control.activate();  
                        control.map.raiseLayer(control.layer,control.map.layers.length-1);
                        element.setAttribute("class", key + "BtnActive");
                        $("#drag").attr("class","panBtn");
                    }
               
            }else{
                if(element.id=='del'){ // user is trying to delete a feature
                    control.layer.removeAllFeatures();
                    control.deactivate();
                    var elem = $("#" + key); 
                    elem.attr("class", key + "Btn");  
                     resetCoordinates();
                }
            } 
           
        }  
}


/*  ------------------------------------------------------------  
 *    addDataLayer(coordinateSelector)  
 *    Display coordinates in coordinateSelector as markers on map
 *    clickInfo enables clicking on the markers 
 *    style style 'id' to grab the correct style from getStyle
 *    clustering true enables clustering markers near each other to a single marker with + sign
 *  ------------------------------------------------------------
 */
MapWidget.prototype.addDataLayer = function(clickInfo,style,clustering) {
    var self = this;
    var styleM = getStyle(style);
    if(clustering){
      
        this.strategy = new OpenLayers.Strategy.Cluster({
            distance: 30, 
            threshold: 2
        });
        this.dataLayer = new OpenLayers.Layer.Vector( "Data Markers", {
            styleMap: styleM, 
            strategies: [this.strategy]           
        });
    }else{ 
        this.dataLayer = new OpenLayers.Layer.Vector( "Data Markers", {
            styleMap: styleM
        });
    }
    this.map.addLayer(this.dataLayer);  
    
    // coverageLayer is the layer that show the data spatial coverage  on hover
    this.coverageLayer = new OpenLayers.Layer.Vector("Data Boundaries", { 
            styleMap: getStyle('coverage')
        });
    this.map.addLayer(this.coverageLayer);
    if(clickInfo){ // if features are selectable, declare hover and click to handle hover on regular computers and clicks on tablets
        this.selectControl = new OpenLayers.Control.SelectFeature(this.dataLayer,
        {
            onSelect: function(e) {   
                self.onFeatureSelect(e);
            },
           
            hover:true
        });
        this.map.addControl(this.selectControl);
        this.selectControl.activate();
        
       this.clickControl = new OpenLayers.Control.SelectFeature(this.dataLayer,
        {
            onSelect: function(e) {   
                self.onFeatureSelect(e);
            }
           
            
        });
        this.map.addControl(this.clickControl);
        this.clickControl.activate();
        
    }
}

/*  ------------------------------------------------------------  
 *    addVectortoDataLayer(coordinateSelector, clickinfo)  
 *    For every coordinateSelector, create a marker    
 *    If clickInfo is true, try to find the info within the search table results and create HTML popup
 *    
 *  ------------------------------------------------------------
 */
MapWidget.prototype.addVectortoDataLayer = function(coordinateSelector,clickInfo){
    var dataLayer =  this.dataLayer;
    var centers = $(coordinateSelector);
    
    var WGS84 = this.WGS84; 
    var WGS84_google_mercator = this.WGS84_google_mercator;
    var number,numberPin;
    var html ='';
    var title = '';
    var vectors = Array();
    var coverage = Array();
    if(typeof clickInfo == "undefined") clickInfo = false;
    $.each(centers, function(){  
            
        if(clickInfo){
             html ='';
             title = ''; 
             coverage = Array();  
             var link = $(this).closest('tr').find('#metabutton a').attr('href');            
             title = "<a href=\"" + link + "\" class=\"title\" target=\"_blank\" style=\" vertical-align:middle\">" + $(this).closest('tr').children('td:nth-child(2)').children('h2').children('a').html()  + "</a>"  ; 
             var date = $(this).closest('tr').children('td:nth-child(3)').children('p').html();
             var button =  $('<p>').append($(this).closest('tr').find('#metabutton a.viewmeta').clone()).remove().html();
            
             number = $(this).closest('tr').children('td:nth-child(1)').children('a').html();
             numberPin = $('<p>').append($(this).closest('tr').children('td:nth-child(1)').children('a').clone()).remove().html();
             html  = numberPin +  "<strong>" + title + "</strong> <br/> Release date: " + date  + "&nbsp; "+ button ; 
           
             $.each($(this).parent().children('.spatial').children('li'), function(){ //get coverage coordinates 
                  coverage.push( $(this).text());
             });
            
        }else {
            number = ''
        }
        if($(this).html().indexOf(' ') != -1){  // if we should draw polygons
            vectors.push(addVector($(this).html(), WGS84,WGS84_google_mercator, html,number, numberPin, title));    
        }else{ //if we should draw marker vectors
            vectors.push(addMarker($(this).html(), WGS84,WGS84_google_mercator, html,number, numberPin, title,coverage));
        }

    }); 
    dataLayer.addFeatures(vectors);
    this.dataLayer.setVisibility(true); 
    this.map.raiseLayer(this.dataLayer,this.map.layers.length-1); //set the layer on top of all the other layers
    /* Script to zoom into markers. Commented out because currently unneeded feature.
    var bounds = dataLayer.getDataExtent();
    if(bounds)  this.map.zoomToExtent(bounds); 
    if(this.map.zoom > 5) this.map.zoomTo(5);
    */
   
}
 
 /*  ------------------------------------------------------------  
 *    removeAllFeatures 
 *    Remove all popups, and then destroy features in dataLayer and coverageLayer
 *  ------------------------------------------------------------
 */
MapWidget.prototype.removeAllFeatures = function(){
    for (var i=0; i<this.map.popups.length; i++) 
    { 
        this.map.removePopup(this.map.popups[i]); 
    } 
    this.dataLayer.destroyFeatures();
    this.strategy.clusters=[];
    this.strategy.features=[];
    this.coverageLayer.destroyFeatures();
   
}

 /*  ------------------------------------------------------------  
 *    removeHighlightFeatures 
 *    Remove features from highlightLayer
 *  ------------------------------------------------------------
 */
MapWidget.prototype.removeHighlightFeatures = function(){    
    this.highlightLayer.setVisibility(false);      
}

 /*  ------------------------------------------------------------  
 *    toggleExtLayer(layer_id,visibility)
 *    Just to toggle visibility for one layer 
 *    layer_id, the layer we want to toggle
 *    visibility, whether we want to show or hide the layer. TRUE is show
 *    This is currently unused, just there to have if needed
 *  ------------------------------------------------------------
 */

MapWidget.prototype.toggleExtLayer = function(layer_id, visibility){
    for(var i=0;i<this.extLayers.length; i++){
         if(this.extLayers[i].name == layer_id){this.extLayers[i].setVisibility(visibility);
                if(visibility) this.map.raiseLayer(this.extLayers[i],this.map.layers.length-1);
         } 
         
    }
}



 /*  ------------------------------------------------------------  
 *    switchLayer(layer_id)
 *    Have the layer_id layer visible, but turn all other layers off
 *  ------------------------------------------------------------
 */
MapWidget.prototype.switchLayer = function(layer_id, options){
     OpenLayers.ProxyHost= base_url + "api/geoproxy.php?url=";
   
    var options = options || {};
    var turn_data_off = options.turn_data_off || false;
    var enable_click = options.enable_click || true;
    
    for(var i=0;i<this.extLayers.length; i++){
        if(this.extLayers[i].name != layer_id) {this.extLayers[i].setVisibility(false); 
            
        }
        else {
            
            this.extLayers[i].setVisibility(true);       
        }
    }
    
    if(this.highlightLayer){
        this.highlightLayer.setVisibility(false);
        this.selectedFeatureName = '';
        this.selectedFeatureId = '';
    }
     if(turn_data_off && this.dataLayer){
       this.dataLayer.setVisibility(false); 
       this.coverageLayer.setVisibility(false);
       while( this.map.popups.length ) {
            this.map.removePopup(this.map.popups[0]);
        }
    }
    
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
 *    Region Select 
 *
 *  ------------------------------------------------------------
 */

MapWidget.prototype.onRegionSelect = function(region){
     
}
/*  ------------------------------------------------------------  
 *    Feature Select methods
 *
 *  ------------------------------------------------------------
 */

MapWidget.prototype.onFeatureSelect = function(feature){
    selectedFeature = feature; 
    var mapWidgetObj = this;
    if(this.popup!=null) this.onPopupClose(this.popup);
    this.coverageLayer.removeAllFeatures();
     var offset = {'size':new OpenLayers.Size(0,0),'offset':new OpenLayers.Pixel(10,-30)};
       CustomFramedCloudPopupClass = OpenLayers.Class(OpenLayers.Popup.Anchored, {
           'backgroundColor': '#FFFFFF', 
           'border': '1px solid black',
           'displayClass' : 'popupGroup',
           'contentDisplayClass' : 'popupContent',
           'autosize' : true 
       });   
    if(!feature.cluster){
       this.popup = new CustomFramedCloudPopupClass("chicken",
            feature.geometry.getBounds().getCenterLonLat(),
            null, feature.data.popupHTML, offset, true, function(e){
                  
                    mapWidgetObj.onPopupClose(this);
                    OpenLayers.Event.stop(e);
        });    
        this.popup.calculateRelativePosition = function () {
            return 'br';
        }
        this.popup.minSize = new OpenLayers.Size(400,80);
        this.popup.maxSize = new OpenLayers.Size(400,180);
         var vectors = Array();
         
        $.each(feature.data.coverage,function(){
             var coverage = addVector(this,mapWidgetObj.WGS84,mapWidgetObj.WGS84_google_mercator,feature.data.title,feature.data.number,feature.data.html);
             vectors.push(coverage);
        });
        this.coverageLayer.addFeatures(vectors);
        this.coverageLayer.setVisibility(true);
        this.map.raiseLayer(this.coverageLayer,this.map.layers.length-1);
    }else{
       
        var html = "<ul>";
        var count = 0;
        $.each(feature.cluster,function(){
            html = html + "<li class=\"clearfix\"><strong>" +  this.data.numberPin +  this.data.title  + "</strong><div class=\"hide popup_coverage\"><ul>";
           $.each(this.data.coverage,function(){
                html = html  + "<li>" + this +  "</li>";
                count++;
            });
      
            html =  html+ "</ul></div></li>";
        }); 
         var html2 = '<h2 class="h2color">Multiple matches (' + count+ '): </h2>';
        html = html2 + html+ "</ul>"; 
        this.popup = new CustomFramedCloudPopupClass("chicken",
                    feature.geometry.getBounds().getCenterLonLat(),
                    null, html, offset, true, function(e){             
                    mapWidgetObj.onPopupClose(this);
                    OpenLayers.Event.stop(e);
        });
         this.popup.calculateRelativePosition = function () {
            return 'br';
        }
         
  
       this.popup.minSize = new OpenLayers.Size(400,100);
       this.popup.maxSize = new OpenLayers.Size(400,180);
    
      
    }
    this.popup.displayClass = 'displayClass';
    this.popup.panMapIfOutOfView = true;
    this.popup.autoSize = true;
  //  this.popup.setBorder('1px solid black');
        
    feature.popup = this.popup;   
    this.map.addPopup(feature.popup);     
    $(".popupContent ul li").hover(function(){
        mapWidgetObj.coverageLayer.removeAllFeatures();
        var vectors = Array();
        var coverages =  $(this).find('.popup_coverage ul li');
        $.each(coverages, function(){
            var coverage = addVector($(this).text(),mapWidgetObj.WGS84,mapWidgetObj.WGS84_google_mercator,'','','');
            vectors.push(coverage); 
        });

      this.coverageLayer.addFeatures(vectors);
      this.coverageLayer.setVisibility(true);

    });        
} 

MapWidget.prototype.onPopupClose = function(popup){
   popup.destroy();
   this.coverageLayer.removeAllFeatures();
   this.selectControl.unselectAll();  
   this.popup = null;
}
                  
MapWidget.prototype.onPopupRegionClose = function(popup){
   popup.destroy();
   this.highlightLayer.setVisibility(false);
   this.popup = null;

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
       case "default" : { //used to show markers on search result map
                style = {
                    graphicWidth: 40,
                    graphicHeight: 42,      
                    pointRadius: 20,
                    externalGraphic: '${imageicon}', 
                    fillColor: '${bgcolor}', 
                    fontColor: "#FFF",
                    fillOpacity: '1', 
                    strokeColor: '#000000', 
                    strokeWidth: '1',
                    graphicYOffset: -30,
                    label: "${count}",
                    fontWeight: "Bold",
                    labelAlign: 'cb',
                    labelYOffset: 12,
                    labelXOffset: -4,
                    labelSelect: true
                };
               
                styleSelected = {
                    fillColor: '#ff0000', 
                    externalGraphic: '${imageiconselect}', 
                    strokeColor: '#000000',
                    fontColor: "#FFFFFF",
                   fontWeight: "Bold"
              
                };      
                  
                context =  {
                    imageicon: function(feature){
                        if(feature.attributes.count > 1) {
                            return '/img/icons/map-pin-multiple-normal-bg.png';
                        }else{
                           return '/img/icons/map-pin-single-normal-bg.png';
                        }
                    }, 
                    imageiconselect: function(feature){
                        if(feature.attributes.count > 1) {
                            return '/img/icons/map-pin-multiple-hover-bg.png';
                        }else{
                           return '/img/icons/map-pin-single-hover-bg.png';
                        }
                    }, 
                    bgcolor: function(feature){
                        if(feature.attributes.count > 1) {
                            return "#FFFF00";
                        }else{
                            return "#48D1CC";
                        }
                    },
                    
                    count: function(feature){
                        if(feature.attributes.count > 1) {
                           return '';
                        }else{
                            return feature.attributes.number;
                        }
                    }
                };
            };      
            break;
            
       
        case "coverage" : { //used to show boundaries on search result map
                style = {                   
                    fillColor: '#FFFF00', 
                    fillOpacity: '0.5', 
                    strokeColor: '#000000', 
                    strokeWidth: '1'
                };
                styleSelected = {
                     fillColor: '#FFFF00', 
                    fillOpacity: '0.5', 
                    strokeColor: '#000000', 
                    strokeWidth: '1'
                };
            };       
            break;
        case "transparent" : {  //used in view metadata 
                style = {
                    pointRadius: 9, 
                    fillColor: '#48D1CC', 
                    fillOpacity: '0.7', 
                    strokeColor: '#000000', 
                    strokeWidth: '1',
                    label: "${number}",
                    labelSelect: true

                };
                styleSelected = {

                    pointRadius: 9,
                    fillColor: '#ff0000', 
                    fillOpacity: '0.7', 
                    strokeColor: '#000000', 
                    strokeWidth: '1',
                    label: "${number}",
                    labelSelect: true
                };
            };  
            break;
    }
    // Styling Site Layers
    
    var styleM = new OpenLayers.StyleMap({
        "default" : new OpenLayers.Style(style,{
            context:context
        }), 
        "select" : new OpenLayers.Style(styleSelected,{
            context:context
        })
    });
  
    return styleM;
}
    

/*  ------------------------------------------------------------  
 *    Bind changes to coordinates textbox 
 *    Show the GO button on the lat long box if all the textboxes are filled
 *    Update the vector
 *  ------------------------------------------------------------
 */
function enableCoordsChange(map){
   
    $("#coordsOverlay input").change(function(){
        var coordStr = '';
        coordStr += $('#spatial-west').val() +  "," + $('#spatial-south').val() + "," +
            $('#spatial-east').val() + "," + $('#spatial-north').val();
        if($('#spatial-west').val() != '' && $('#spatial-south').val() !='' &&  $('#spatial-east').val() != '' && $('#spatial-north').val() !=''){
            $('#coordsOverlay .mapGoBtn').show();
        }else{
             $('#coordsOverlay .mapGoBtn').hide();
        }
        map.updateDrawing(map,coordStr);
    });
}

/*  ------------------------------------------------------------  
 *    Unbind click to toolbar "panel" buttons div 
 *
 *  ------------------------------------------------------------
 */
function disableToolbarClick(map){
    $("#regionPanel a").each(function(){
        $(this).unbind('click');
    });
}
/*  ------------------------------------------------------------  
 *    Bind click to toolbar "panel" buttons div 
 *
 *  ------------------------------------------------------------
 */
function enableToolbarClick(map){
    $("#regionPanel a").each(function(){
        $(this).click(function(){            
            map.toggleControl(this);
        });
    });
    $("#drag").click(function(){        
     if($(this).attr('class') == 'panBtn'){
        //this.attr('class','olControlDragFeatureItemActive');
        for(var key in map.drawControls) {
            var control = map.drawControls[key];
            if(control.active){
                map.toggleControl($("#" + key).get(0));
                break;
            }            
         }
     }
    });
}

/*  ------------------------------------------------------------  
 *    Bind click to "coords" div 
 *
 *  ------------------------------------------------------------
 */
function enableCoordsClick(){
    
    $('#latlong').click(function(e){
        $('#coordsOverlay').toggle('fast');
          if($('#spatial-west').val() != '' && $('#spatial-south').val() !='' &&  $('#spatial-east').val() != '' && $('#spatial-north').val() !=''){
            $('#coordsOverlay .mapGoBtn').show();
        }
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
     $('#coordsOverlay .mapGoBtn').show();
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
 



function pausecomp(ms) {
ms += new Date().getTime();
while (new Date() < ms){}
} 

/*  ------------------------------------------------------------  
 *    addMarker
 *    lonlat : longitude latitude coordinates to add marker to
 *    WGS84 projection : object
 *    WGS84_google_mercator : 900913 projection object
 *    html : content of the popup 
 *    number: the number in the search result list
 *    numberPin: the number as an image 
 *    title: the record title
 *    coverage: coordinates of the record coverage
 *  ------------------------------------------------------------
 */

 function addMarker(lonlat,WGS84,WGS84_google_mercator,html, number, numberPin, title, coverage){
        var word = lonlat.split(',');
        var point = new OpenLayers.Geometry.Point(word[0],word[1]);
        point.transform(WGS84, WGS84_google_mercator);
        var attributes = {
            popupHTML: html, 
            title: title, 
            type: "point", 
            number: number,
            numberPin:numberPin,
            coverage: coverage
        }
        var feature = new OpenLayers.Feature.Vector(point, attributes);

        return feature;
   } 
    /*  ------------------------------------------------------------  
 *    addVector
 *    coordinates : a set of lat lon string pairs seperated by space 
 *    WGS84 projection : object
 *    WGS84_google_mercator : 900913 projection object
 *    html : content of the popup 
 *    number: the number in the search result list
 *    numberPin: the number as an image 
 *    title: the record title
 *  ------------------------------------------------------------
 */
    function addVector(coordinates,WGS84,WGS84_google_mercator,html, number, numberPin, title){
        var points = coordinates.split(' ');
        var vector_points = Array();
        $.each(points, function(i, s){
            var word = s.split(',');
            var point = new OpenLayers.Geometry.Point(word[0],word[1]);
            point.transform(WGS84, WGS84_google_mercator);
            vector_points.push(point);
        });
           
        var linear_ring = new OpenLayers.Geometry.LinearRing(vector_points);
        var attributes = {
            popupHTML: html,
            title: title,  
            type: "polygon", 
            number: number,
            numberPin:numberPin
        }
        var feature = new OpenLayers.Feature.Vector(
        new OpenLayers.Geometry.Polygon([linear_ring]),attributes);          

        return feature;
    }
   
   /* Function to show region name and button when user click on a predefined region
    * 
    */
function showInfo(event, mapWidget){
        var text = '';
        if(mapWidget.selectedFeatureLayer != ''){
        ternRegionFilter = mapWidget.selectedFeatureLayer + "\\\\:" + mapWidget.selectedFeatureId;
              
        text = "<strong>" + mapWidget.selectedFeatureName + "</strong><br/><a class=\"greenGradient smallRoundedCorners\" onClick=\"$('#visible-region #" + ternRegionFilter + "').trigger('click');\">Search records in this area";
        while( mapWidget.map.popups.length ) {
            mapWidget.map.removePopup(mapWidget.map.popups[0]);
        }   
         var offset = {'size':new OpenLayers.Size(0,0),'offset':new OpenLayers.Pixel(10,-30)};
    
        CustomFramedCloudPopupClass = OpenLayers.Class(OpenLayers.Popup.Anchored, {
            'backgroundColor': '#FFFFFF', 
            'border': '1px solid black',
            'displayClass' : 'popupGroup',
            'contentDisplayClass' : 'popupContentScroll',
            'padding' : new OpenLayers.Bounds(0,0,10,0),                                             
            'autoSize' : true 
        });    
        var popup = new CustomFramedCloudPopupClass(
            "chicken", 
            mapWidget.map.getLonLatFromPixel(event.xy),
            null,
            text,
            offset,
            true,
            function(e){                  
                    mapWidget.onPopupRegionClose(this);    
                    OpenLayers.Event.stop(e);
            });
            
          
        popup.minSize = new OpenLayers.Size(200,70);        
        popup.maxSize = new OpenLayers.Size(200,200);
        mapWidget.map.addPopup(popup);
        }
}