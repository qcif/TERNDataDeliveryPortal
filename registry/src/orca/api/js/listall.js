/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var base_url="http://portal-dev.tern.org.au/admin/orca/api/search";
//var base_url="http://demo/admin/orca/api/search";
var term=TERNData.getTerm();

$(document).ready(function() 
{ 
    console.log(term);
    $.ajax({
            type:'GET',
            url:base_url+"?term="+term+"&format=json&w=1&count=1000&callback=?",
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

        



