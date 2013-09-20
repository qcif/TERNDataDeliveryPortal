/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var term=TERNData.getTerm();
var temporal=TERNData.getTemporal();
var geo=TERNData.getGeo();
var bbox=TERNData.getBBox();
var fac=TERNData.getFac();

var base_url='http://130.102.154.167/api/search';
//var base_url='http://portal.tern.org.au/ternapi/search';
//var base_url='http://tern9.qern.qcif.edu.au/ternapi/search';

$(document).ready(function() 
{ 
   // console.log(term);
   var str="";
   if(term!=undefined)
      str="term="+term+"&";
   
   if (temporal!=undefined)
       str=str+"temporal="+temporal+"&";
   
   if(geo!=undefined)
      str=str+"g="+geo+"&";
   
   if(bbox!=undefined)
       str=str+"b="+bbox+"&";          
   if (fac!=undefined)
       str=str+"fac="+fac+"&";

   $.ajax({
            type:'GET',
           // url:base_url+"?term="+term+"&format=json&w=1&count=10&callback=?",
            url:base_url+"?"+str+"format=json&w=1&count=10&callback=?",
            dataType:"jsonp",
            success:function(data){
                if(data.response!=null)
                {
                    TERNData.serverResponse(data.response.item);
                }else
                {
                    TERNData.serverResponse(data);
                }              
            },
            error:function(msg){  
  		
            }
    });
    
}); 


        



