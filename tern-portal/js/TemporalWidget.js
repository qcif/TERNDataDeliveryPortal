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
        //console.log(parseInt(word[1]));
        if(this.temporal!='All'){
            var word = this.temporal.split('-');
        }else{
            var word = [min_year,max_year];
        }
        $('#show-temporal-search').attr('checked','checked');
        $('#dateFrom').val(word[0]).removeAttr('disabled');
        $('#dateTo').val(word[1]).removeAttr('disabled');	

    }else{
        $('#dateFrom').attr('disabled','true');
        $('#dateTo').attr('disabled','true');		 
        $('#show-temporal-search').removeAttr('checked');	
    }
}

/*      GET TEMPORAL VALUES FROM INPUT       */
TemporalWidget.prototype.getTemporalValues = function(){       
    if(this.doTemporalSearch){
        this.temporal = $('#dateFrom').val() + '-' + $('#dateTo').val();
    }else this.temporal = 'All';

    return this.temporal;
}

