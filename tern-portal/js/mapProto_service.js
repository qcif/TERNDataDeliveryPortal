function addCheckbox(name) {
   var container = $('#facilities');
   var inputs = container.find('input');
   var id = inputs.length+1;

   var html = '<input type="checkbox" id="cb'+id+'" value="'+name+'" /> <label for="cb'+id+'">'+name+'</label><br/>';
   container.append($(html));
}


function initMapProto(){
            
    var mapWidget = new MapWidget('spatialmap',true);          
            
            $.getJSON('/api/facilities.infrastructure.json',function(data){
            var layers = Array();
                $.each(data.facilities,function(key,val){
                    var visibility = false;
                        mapWidget.addExtLayer({
                            url: val.geo_url,
                            protocol: "WMS",
                            geoLayer: val.geo_name,
                            layerName: val.name,
                            visibility: visibility
                        });
                    layers.push(val.name);       
                    addCheckbox(val.name);
                });
                
             mapWidget.registerClickInfo({url: 'http://demo:8080/geoserver/wms', layers: layers}, null);
               $("#facilities input").click(function(){
                   if($(this).prop("checked")){ 
                        mapWidget.toggleExtLayer($(this).val(),true);   
                   } else{
                       mapWidget.toggleExtLayer($(this).val(),false);   
                   }
                });
        });                       
        
  
}
   
$(document).ready(function() {
   
     initMapProto();
    
});