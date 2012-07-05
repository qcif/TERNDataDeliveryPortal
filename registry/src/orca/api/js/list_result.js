/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var term=TERNData.getTerm();

$(document).ready(function() 
{ 
    console.log(term);
    $.ajax({
            type:'GET',
            url:BASE_URL+"?term="+term+"&format=json&w=1&count=10&callback=?",
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


        



