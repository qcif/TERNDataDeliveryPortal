function urldecode(str) {
   return decodeURIComponent((str+'').replace(/\+/g, '%20'));
}

$(function() {
    // GLOBAL VARIABLES
    var hash = window.location.hash;
    var search_term = '';
    search_term = $('#search-box').val();
    var page = 1;
    var classFilter = 'collection';
    var typeFilter = 'All';
    var groupFilter = 'All';
    var subjectFilter = 'All';
    var adv = 0;     
    var fortwoFilter='All';
    var forfourFilter='All';
    var forsixFilter='All';
    var resultSort = 'score desc';
    var temporal = 'All';        
    var n = '';
    var e = '';
    var s='';
    var w='';
    //var mapAdvanced;
        
        
    // ROUTING 
    function routing(){
        if(window.location.href.indexOf('https://')==0){
            var thisurl = window.location.href;
            thisurl = thisurl.replace('https://','http://');
            window.location.href=thisurl;
        }

        if(window.location.href.indexOf('/view')>=0){
            initViewPage();
            if(window.location.href.indexOf('printview')>=0) initPrintViewPage();
        }else if(window.location.href==secure_base_url){
            window.location.href=base_url;
        }else if(window.location.href.indexOf('search')>=0){
            initSearchPage();
        }else if(window.location.href.indexOf('contact')>=0){
            initContactPage();
        }else if(window.location.href.indexOf('help')>=0){
            initHelpPage();
        }else if(window.location.href.indexOf('preview')>=0){
            initPreviewPage();
        }else {
            initHomePage();
        }
    }
    
    $(window).hashchange(function(){

        var hash = window.location.hash;
        var query = hash.substring(3, hash.length);
        var words = query.split('/');
        //clearFilter();
        $.each(words, function(){
            var string = this.split('=');
            var term = string[0];
            var value = urldecode(string[1]);
            switch(term){
                case 'q':
                    search_term=value;
                    break;
                case 'p':
                    page=value;
                    break;
                case 'tab':
                    classFilter=value;
                    break;
                case 'group':
                    groupFilter=value;
                    break;
                case 'type':
                    typeFilter=value;
                    break;
                case 'subject':
                    subjectFilter=value;
                    break;
                case 'fortwo':
                    fortwoFilter=value;
                    break;
                case 'forfour':
                    forfourFilter=value;
                    break;
                case 'forsix':
                    forsixFilter=value;
                    break;
                case 'temporal':
                    temporal=value;
                    break;
                case 'n':
                    n=value;
                    break;
                case 'e':
                    e=value;
                    break;
                case 's':
                    s=value;
                    break;
                case 'w':
                    w=value;
                    break;
                case 'alltab':
                    alltab=value;
                    break;
                case 'adv':
                    adv = value;
                    break;
            }
        });
        if(classFilter!=$('#classSelect').val()) {
            $('#classSelect').val(classFilter);
        }
        //console.log('term='+search_term+'page='+page+'tab='+classFilter);
 
        search_term = search_term.replace(/ or /g, " OR ");//uppercase the ORs
        search_term = search_term.replace(/ and /g, " AND ");//uppercase the ANDS
  
        doNormalSearch();
    
	
    });
    $(window).hashchange(); //do the hashchange on page load
     routing();    
       
	$('.typeFilter, .groupFilter, .subjectFilter,.fortwoFilter, .forfourFilter, .forsixFilter').live('click', function(event){
		if(event.type=='click'){
			page = 1;
			if($(this).hasClass('typeFilter')){
				typeFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));
			}else if($(this).hasClass('groupFilter')){
				groupFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));
			}else if($(this).hasClass('subjectFilter')){
				subjectFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));
                               
			}else if($(this).hasClass('fortwoFilter')){
				fortwoFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
			}else if($(this).hasClass('forfourFilter')){
				forfourFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
			}else if($(this).hasClass('forsixFilter')){
				forsixFilter = encodeURIComponent($(this).attr('id'));
				changeHashTo(formatSearch(search_term, 1, classFilter));               
                               
			}
			//scrollToTop();
		}
	}); 
     
     $('.clearFilter').each(function(){
		$(this).append('<img class="clearFilterImg" src="'+base_url+'/img/delete.png"/>');
	});
        
       $('.typeFilter, .groupFilter, .subjectFilter, .fortwoFilter, .forfourFilter, .forsixFilter, .ro-icon, .clearFilter, .toggle-facets').tipsy({live:true, gravity:'sw'});

	/*
	 * Clearing filters/facets
	 */
	$('.clearFilter').live('click', function(e){
		if($(this).hasClass('clearType')){
			typeFilter = 'All';
		}else if($(this).hasClass('clearGroup')){
			groupFilter = 'All';
		}else if($(this).hasClass('clearSubjects')){
			subjectFilter = 'All';
		}else if($(this).hasClass('clearFortwo')){
			fortwoFilter = 'All';
		}else if($(this).hasClass('clearForfour')){
			forfourFilter = 'All';
		}else if($(this).hasClass('clearForsix')){
			forsixFilter = 'All';
		}
		changeHashTo(formatSearch(search_term,1,classFilter));
	});
        
    /*Change the Hash Value on the URL*/
    function changeHashTo(location){
        if(window.location.href.indexOf("view") || (window.location.href.indexOf("browse"))){
            window.location.href = base_url+location;
        }else {
            window.location.hash = location;
        }
    }
   
    /*Create Hash URL from search terms and filters*/
    function formatSearch(term, page, classFilter){
        if(term=='') term ='*:*';
        var res = 'search#!/q='+term+'/p='+page;
        res+='/tab='+classFilter;
        if(typeFilter!='All') res+='/type='+(typeFilter);
        if(groupFilter!='All') res+='/group='+(groupFilter);
        if(subjectFilter!='All') res+='/subject='+(subjectFilter);
        if(temporal!='All') res+='/temporal='+(temporal);
        if(fortwoFilter!='All') res+='/fortwo='+(fortwoFilter);
        if(forfourFilter!='All') res+='/forfour='+(forfourFilter);
        if(forsixFilter!='All') res+='/forsix='+(forsixFilter);
        if(n!=''){
            res+='/n='+n+'/e='+e+'/s='+s+'/w='+w;
        }
        res+='/adv=' +(adv);
        //alert(res);
        return res;

    }
        
    /*      Initialize map in overlay
    *       If the map already exists, just open the dialog, otherwise init map
    *      
    */   
    function openMap(mapWidget){
        $('#overlaymap').dialog('open');
        if(typeof mapWidget === 'undefined'){
            mapWidget = new MapWidget('spatialmap');
            //add box drawing
            mapWidget.addDrawLayer({
                geometry: "box", 
                allowMultiple: false, 
                afterDraw: updateCoordinates, 
                afterDrag: updateCoordinates
            });
            //enable clicking button controllers
            enableToolbarClick(mapWidget);
            
        }
        return mapWidget;
    }
   
    /*      Populate Search fields
    *      
    *      
    */
    function populateSearchFields(temporalWidget, search_term){
        if(adv == 1){
            $("#accordion").accordion("activate",parseInt(adv));
            if(search_term != '*:*') {
                var word = search_term.split(' ');

                $('input[name^="keyword"]').each(function(index){
                    $(this).val('');           
                });

                //getting operators
                var ors = [];
                $.each(word, function(index){
                    if(this.toString()=='OR' || this.toString() == "AND" || this.toString() == "-"){
                        if(ors.length < 2) ors.push(index);				
                    }
                });
                ors.push(word.length);
                var start = -1;
                $.each(ors,function(index,value){
                    if(value < word.length)  $('select[name^="operator"]').eq(index).val(word[value]);
                    var keywords = word.slice((start+1),value);
                    //fulltext:searchterm
                    $.each(keywords,function(i,v){
                        var fieldNterm = v.split(':');
                        //fulltext, searchterm
                        $.each(fieldNterm,function(fieldNtermIndex,fieldNtermValue){
                            if(this.toString()=='fulltext' || this.toString() == "displayTitle" || this.toString() == "description" || this.toString() == "subject"){
                                $('select[name^="fields"]').eq(index).val(fieldNtermValue);
                            }else{
                                $('input[name^="keyword"]').eq(index).val(fieldNtermValue);
                            }                            
                        });
                    });
                    start = value;
                });
            }
            
            var group;
            if(groupFilter !="All"){
                    group = groupFilter.split(';');
                    $.each(group,function(i,v){
                        $('input[id^="group"][value="' + urldecode(v) + '"]').attr('checked',true);
                    });            
            }

            if(n!='') {populateCoordinates(n,w,s,e);} 

            if(forfourFilter != "All"){

                $('select[id="forfourFilter"]').val(urldecode(forfourFilter));
            }
            if(temporal!= 'All'){
                temporalWidget.doTemporalSearch = true;
                temporalWidget.refreshTemporalSearch();
            }
        }else{ // it's just basic search
            if(search_term != '*:*' && search_term !="Search ecosystem data") {
            $('input[id="search-box"]').val(search_term);
        }
    }
    }
   
    /*      Initialization function for '/search' urls
    *      Called by ROUTING function
    *      Call widget objects 
    */   
      
    function initSearchPage(){
        setupNestedLayout();
        
        var temporalWidget = new TemporalWidget();
        temporalWidget.temporal = temporal;
        temporalWidget.refreshTemporalSearch();
        enableToggleTemporal("#show-temporal-search",temporalWidget);   
        
        populateSearchFields(temporalWidget,search_term);

        
        // SEARCH MAP
        var mapWidget; 
        
        // Map dialog overlay
        $('#overlaymap').dialog({
            autoOpen: false,
            height: 512,
            width: 454,
            resizable: false,            
            modal: true
        })

        //Open map button
        $('#openMap').click(function(){
            mapWidget = openMap(mapWidget);
        }).button();


        //Reset Button 
        $('#search_reset').click(function(){
            resetAllFields(temporalWidget);
        }).button();
        
        //Submit button
        $('#search_advanced').click(function(){
            //Reset search term
            resetAllSearchVals();
            //check which panel is active 0 is basic, 1 is advanced
            if($( ".accordion" ).accordion( "option", "active" ) == 1 ){  // handle advanced search 
                
                //Advanced search widgets                 
                temporal = temporalWidget.getTemporalValues();
                               
                //update spatial coordinates from textboxes
                var nl=document.getElementById("spatial-north");
                var sl=document.getElementById("spatial-south");
                var el=document.getElementById("spatial-east");
                var wl=document.getElementById("spatial-west");
                   
                n=nl.value;
                s=sl.value;
                e=el.value;
                w=wl.value;               
                           
                //FOR filtering 
                if( document.getElementById("forfourFilter") != null && $('#forfourFilter').val()!='')  forfourFilter = $('#forfourFilter').val();
                //Group filtering
                if( document.getElementById("groupFilter") != null ) {
                    var first = true;
                    $('#groupFilter :checked').each(function(){
                        if(first) {
                            groupFilter = $(this).val();
                            first=false;
                        }
                        else groupFilter +=  ";" + $(this).val();
                    });                  
                }                 
                //Keywords 
                if( $('[name^=fields]').length>0){
                    first = true;
                    var field = '';
                    $("input[name^=keyword]").each(function(index){
                        if($.trim($(this).val())!='') {
                            switch($("[name^=fields]").get(index).value){
                                case 'displayTitle':
                                    field = 'displayTitle';
                                    break;
                                case 'description':
                                    field = 'description_value';
                                    break;
                                case 'subject':
                                    field = 'subject_value' ;
                                    break;
                                default:
                                    field='fulltext';
                                    break;
                            }
                            if(first){
                                search_term = field;
                            }else{
                                if($("[name^=operator]").get(index-1) ){
                                    var operator = $("[name^=operator]").get(index-1).value;
                                    search_term += operator
                                    search_term += ' ';
                                }                            
                                search_term += field;
                            }
                            search_term += ':';
                            search_term += $.trim($(this).val()) + ' ';
                            first = false;                             
                        }
                    }
                    );
                    search_term = $.trim(search_term);
                    adv = 1;              
                }
                page = 1;
            }else{
                search_term = $('#search-box').val();
                adv = 0;
                n = '';
                w = '';
                e = '';
                s = '';
                groupFilter = 'All'
                forfourFilter = 'All';
                temporal = 'All';
                
                
            }   		
	    
            changeHashTo(formatSearch(search_term, 1, classFilter));

        }).button();


    }
    /* Reset all search values */
    function resetAllSearchVals(){
           search_term = '';
           page = 1;
           classFilter = 'collection';
           typeFilter = 'All';
           groupFilter = 'All';
           subjectFilter = 'All';
           adv = 0;     
           fortwoFilter='All';
           forfourFilter='All';
           forsixFilter='All';
           resultSort = 'score desc';
           temporal = 'All';        
           n = '';
           e = '';
           s='';
           w='';
        
    }
    /* Reset all fields in the search pane*/
    function resetAllFields(temporalWidget){
         $('#search-box').val('');
         $('[name^=fields]').val('');
         $('[name^=keyword]').val('');
         $('[name^=keyword]').val('');
         $('[name^=operator]').val('');
         $('#groupFilter :checked').each(function(){
             $(this).removeAttr('checked');
         }); 
         $('#forfourFilter').val('');
         temporalWidget.doTemporalSearch = false;
         temporalWidget.refreshTemporalSearch();
         
         if($('#spatial-north').val() != '') {
             $("#box").trigger('click');
         }
    }
    
    
    function doNormalSearch(){
            spatial_included_ids='';
		$.ajax({
  			type:"POST",
  			url: base_url+"/search/filter/",

  			data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&fortwoFilter="+fortwoFilter+"&forfourFilter="+forfourFilter+"&forsixFilter="+forsixFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1&sort="+ resultSort +"&adv="+adv,

  				success:function(msg){                                      
  					$("#search-result").html(msg);  				
                                        layoutInner();
  					//$('#advanced, #mid').css('opacity','1.0');
  					//$('#map-stuff').show();
  					//$('#map-help-stuff').html('');
  					//initFormat();
  					if($('#realNumFound').html() !='0'){//only update statistic when there is a result
  						//update search statistics
  						$.ajax({
  				  			type:"POST",
  				  			url: base_url+"/search/updateStatistic/",

  				  			data:"q="+search_term+"&classFilter="+classFilter+"&typeFilter="+typeFilter+"&groupFilter="+groupFilter+"&subjectFilter="+subjectFilter+"&page="+page+"&spatial_included_ids="+spatial_included_ids+"&temporal="+temporal+"&alltab=1",

  				  				success:function(msg){},
  				  				error:function(msg){}
  				  			});
  					}
  				},
  				error:function(msg){
  					console.log('error');
  				}
  		});
	}
});