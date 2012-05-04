/*       MAIN TEMPORAL WIDGET CLASS 
 *       
 */
function TemporalWidget(){

    /*                  TEMPORAL SEARCH CHECKBOX  
                 * 
                 * 
                 */
    this.doTemporalSearch = false; // toggle true/false to enable widget drop downs
    this.temporal = 'All'; // the filter value
                         
    this.refreshTemporalSearch();

             
}   

/*  ------------------------------------------------------------  
*    Bind click to Temporal checkbox image
*
*  ------------------------------------------------------------
*/
function enableToggleTemporal(div_id, temporalWidgetObj){
    $(div_id).click(function(){   
           
        if(temporalWidgetObj.doTemporalSearch){
            temporalWidgetObj.doTemporalSearch=false;
        }else temporalWidgetObj.doTemporalSearch = true;
        temporalWidgetObj.refreshTemporalSearch();
    }).tipsy({
        gravity: 'w'
    });
}


/*       TOGGLE TEMPORAL CHECK IMAGE       */
TemporalWidget.prototype.refreshTemporalSearch = function(){       
    var min_year = parseInt($('#min_year').html());
    var max_year = parseInt($('#max_year').html());
    if(this.doTemporalSearch){
        $('#show-temporal-search').attr('src',base_url+'img/yes.png');
        //console.log(parseInt(word[1]));
        if(this.temporal!='All'){
            var word = this.temporal.split('-');
        }else{
            var word = [min_year,max_year];
        }

        $('#dateFrom').val(word[0]).attr('disabled','');
        $('#dateTo').val(word[1]).attr('disabled','');	

    }else{
        $('#show-temporal-search').attr('src',base_url+'img/no.png');
        $('#dateFrom').attr('disabled','true');
        $('#dateTo').attr('disabled','true');			
    }
}
        
TemporalWidget.prototype.setTemporalValue = function(temporal){
    this.temporal = temporal;  
}          

TemporalWidget.prototype.getTemporalValue = function(temporal){
    return this.temporal;  
}          
