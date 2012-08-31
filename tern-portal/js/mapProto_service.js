function updateSelectedFeature(name){
    if(name !=''){    
        $("#featurename").text("Selected region: " + name);        
    }
    else{
        $("#featurename").text("");    
    }
}
function initMapProto(){
            
    var mapWidget = new MapWidget('spatialmap',true);
           
   
<<<<<<< HEAD
            mapWidget.addExtLayer({
                url: 'http://portal-dev.tern.org.au:8080/geoserver/wms',
=======
            
            
            mapWidget.addExtLayer({
                url: 'http://demo:8080/geoserver/wms',
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
                protocol: "WMS",
                geoLayer: "nr:ltern",
                layerName: "LTERN",
                visibility: true
                    
            });
            mapWidget.addExtLayer({
<<<<<<< HEAD
                url: 'http://portal-dev.tern.org.au:8080/geoserver/wms',
=======
                url: 'http://demo:8080/geoserver/wms',
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
                protocol: "WMS",
                geoLayer: "nr:ltern_points",
                layerName: "LTERN Points",
                visibility: true
                    
<<<<<<< HEAD
            });          
            mapWidget.registerClickInfo({url: 'http://portal-dev.tern.org.au:8080/geoserver/wms'}, null);
=======
            });    
            
            mapWidget.registerClickInfo({url: 'http://demo:8080/geoserver/wms', layers: ["LTERN Points","LTERN"]}, null);
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
  
}
   
$(document).ready(function() {
   
     initMapProto();
    
<<<<<<< HEAD
});
=======
});
>>>>>>> c158020c71cc71c72f7d4e30b4e14c2edb498794
